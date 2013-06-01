<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* cron_formel_mail.php
*
* Cronjob called from index.php
*
* TODO:
* - Edit language files for proper translations
* - French translation for email template
* - Writing update instructions
* - Writing install instructions
* - Extend the install script for database changes on phpbb_formel_races (race_mail)
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}


// Run the cronjob only once a day
if ($config['cron_formel_mail'] > time() - 60*60*24 )
{
	return ;
}

// Update the last run timestamp
set_config('cron_formel_mail', time(), true);

// Setup the language for the f1webtipp
$user->setup('mods/formel');

include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include($phpbb_root_path . 'includes/functions_formel.' . $phpEx);

//Mail Settings
$use_queue 		= false;
$used_method 	= NOTIFY_EMAIL;
$priority 		= MAIL_NORMAL_PRIORITY;

// Get formel config
$formel_config 			= get_formel_config();
$formel_group_id 		= $formel_config['restrict_to'];

// Extra settings for internal test group only ;-)
$formel_group_id		= 114;

// Time slot will be 3 days before the next race starts
$current_time 		= time();
$one_day 			= 86400;
$time_slot 			= $one_day * 3;
$current_time_slot 	=  $current_time + $time_slot;

// Get the race which will start within the next 3 days and mail reminder was not sent
$sql = 'SELECT 		*
		FROM 		' . FORMEL_RACES_TABLE . '
		WHERE 		race_time > ' . $current_time . '
			AND		race_time < ' . $current_time_slot . '
			AND		race_mail = 0
		ORDER BY 	race_time ASC';

$result = $db->sql_query($sql);

$races = $db->sql_fetchrowset($result);
$db->sql_freeresult($result);


// If we found the race, get all data and send the mail
foreach ($races as $race)
{
	$race_id 		= $race['race_id'];

	// Update the race_mail status
	$sql_update = '	UPDATE  	' . FORMEL_RACES_TABLE . '
					SET 		race_mail = 1
					WHERE 		race_id = ' . $race_id ;

	$result_mail = $db->sql_query($sql_update);

	// prepare some variables
	$race_name 		= $race['race_name'];
	$race_time		= $race['race_time'];

	// Get the race f1webtipp deadline.
	// Could have problems if your users live in different timezones.
	// In this case, remove the DEADLINETIME variable in email template
	$event_stop		= date($race_time - $formel_config['deadline_offset']);
	$b_day			= $user->format_date($event_stop, 'd');
	$b_month		= $user->format_date($event_stop, 'm');
	$b_year			= $user->format_date($event_stop, 'Y');
	$b_hour			= $user->format_date($event_stop, 'H');
	$b_minute		= $user->format_date($event_stop, 'i');
	$deadline_date 	= $b_day . '.' . $b_month . '.' . $b_year;
	$deadline_time	= $b_hour . ':' . $b_minute;

	$subject 		= $user->lang['FORMEL_TITLE'] . " - " . $user->lang['FORMEL_CURRENT_RACE']  . " : " . $race_name;
	$usernames 		= '';

	include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);
	include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	$messenger = new messenger($use_queue);
	$errored = false;
	$messenger->headers('X-AntiAbuse: Board servername - ' . $config['server_name']);
	$messenger->headers('X-AntiAbuse: User_id - ' . $user->data['user_id']);
	$messenger->headers('X-AntiAbuse: Username - ' . $user->data['username']);
	$messenger->headers('X-AntiAbuse: User IP - ' . $user->ip);
	$messenger->subject(htmlspecialchars_decode($subject));
	$messenger->set_mail_priority($priority);

	// Get all the f1webtipp user (what user exactly ? All member of the restrict_to group)
	$sql = 'SELECT 		u.user_id,
					 	u.username,
					 	u.user_lang,
					 	u.user_email
    		FROM 		' . USERS_TABLE . ' u , ' . USER_GROUP_TABLE . ' ug
        	WHERE 		ug.group_id = ' . $formel_group_id . '
        		AND 	u.user_id = ug.user_id
        	GROUP BY	u.user_id
        	ORDER BY 	u. username_clean ASC';

    $result = $db->sql_query($sql);

   	while ($row = $db->sql_fetchrow($result))
	{
		// Send the messages
		$used_lang = $row['user_lang'];
		$messenger->to($row['user_email'], $row['username']);
		$messenger->template('cron_formel', $used_lang);

		$messenger->assign_vars(array(
			'USERNAME'		=> $row['username'],
			'RACENAME'		=> $race_name,
			'DEADLINEDATE'	=> $deadline_date,
			'DEADLINETIME'	=> $deadline_time,
			)
		);

		if (!($messenger->send($used_method)))
		{
			$usernames .= (($usernames != '') ? ', ' : '') . $row['username']. '!';
			$message = '<strong>F1 WebTipp - Erinnerungsmail an ' . $row['user_email'] . ' nicht erfolgreich.</strong>';
			add_log('critical', 'LOG_ERROR_EMAIL', $message);
		}
		else
		{
			$usernames .= (($usernames != '') ? ', ' : '') . $row['username'];
		}

	}

	// Only if some emails have already been sent previously.
	if ($usernames <> '')
	{
		$message = 'F1WebTipp Erinnerungs-Mail an: ' . $usernames ;
		add_log('admin', 'LOG_MASS_EMAIL', $message);

		//send admin email
		$used_lang 	= $user->data['user_lang'];
		$subject 	= "ADMIN INFO: " . $user->lang['FORMEL_TITLE'] . " - " . $user->lang['FORMEL_CURRENT_RACE']  . " : " . $race_name;

		$messenger->to($config['board_email'], $config['sitename']);
		$messenger->subject(htmlspecialchars_decode($subject));
		$messenger->template('admin_send_email', $used_lang);
		$messenger->assign_vars(array(
			'CONTACT_EMAIL' => $config['board_contact'],
			'MESSAGE'		=> "Mail wurde an folgende User gesendet: " . $usernames,
			)
		);

		if (!($messenger->send($used_method)))
		{
			$message = '<strong>F1 WebTipp - Erinnerungsmail an ' . $config['board_email'] . ' nicht erfolgreich.</strong>';
			add_log('critical', 'LOG_ERROR_EMAIL', $message);
		}
    }
}

?>