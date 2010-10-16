<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include($phpbb_root_path . 'includes/functions_formel.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/formel');

// Get formel config
$formel_config 			= get_formel_config();
$formel_guests_allowed	= ($formel_config['guest_viewing'] == '1') ? true : false;
$formel_forum_id 		= $formel_config['forum_id'];
$formel_group_id 		= $formel_config['restrict_to'];
$formel_mod_id 			= $formel_config['mod_id'];


//If user is a bot.... redirect to the index.
if ($user->data['is_bot'])
{
	redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
}

// If guest viewing is not allowed... 
if (!$formel_guests_allowed)
{
	// Check if the user ist logged in. 
	if (!$user->data['is_registered'])
	{
		// Not logged in ? Redirect to the loginbox.
		login_box('', $user->lang['LOGIN_INFO']);
	}
}
// At this point we have no bots, only registered user and if guest viewing is allowed we have also guests here.

// Check if user has one of the formular 1 admin permission. 
// If user has one or more of these permissions, he gets also formular 1 moderator permissions.
$is_admin = $auth->acl_gets('a_formel_settings', 'a_formel_drivers', 'a_formel_teams', 'a_formel_races');

//Is the user member of the restricted group?
$is_in_group = group_memberships($formel_group_id, $user->data['user_id'], true);

// Check for : restricted group access - admin access - formular 1 moderator access
if ($formel_group_id <> 0 && !$is_in_group && $is_admin <> 1 && $user->data['user_id'] <> $formel_mod_id)
{
	$auth_msg = sprintf($user->lang['FORMEL_ACCESS_DENIED'], '<a href="' . append_sid("ucp.$phpEx?i=groups") . '" class="gen">', '</a>', '<a href="' . append_sid("index.$phpEx") . '" class="gen">', '</a>');
	trigger_error($auth_msg);
}

// Creating breadcrumps
$template->assign_block_vars('navlinks', array( 
	'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}formel.$phpEx"),
	'FORUM_NAME' 		=> $user->lang['FORMEL_TITLE'],
	)
);

// Salting the form...yumyum ...
add_form_key('formel');


// Start switching the mode...
$mode = request_var('mode', 'standard');

switch ($mode)
{
	case 'standard':

		// Set template vars
		$page_title 	= $user->lang['FORMEL_TITLE'];
		$template_html 	= 'formel_body.html';

		// Check buttons & data
		$next 			= (isset($_POST['next'])) 			? true : false;
		$prev 			= (isset($_POST['prev'])) 			? true : false;
		$place_my_tipp 	= (isset($_POST['place_my_tipp'])) 	? true : false;
		$edit_my_tipp 	= (isset($_POST['edit_my_tipp'])) 	? true : false;
		$del_tipp 		= (isset($_POST['del_tipp'])) 		? true : false;	
		
		$race_offset 	= request_var('race_offset'	, 0);
		$race_id 		= request_var('race_id'		, 0);
		$user_id 		= $user->data['user_id'];
		$tipp_time 		= request_var('tipp_time'	, 0);
		$tipp_time 		= intval($tipp_time);
		$my_tipp_array 	= array();
		$my_tipp 		= '';

		//Define some vars
		$driver_team_name = $driverteamname = $gfxdrivercar = $gfxdrivercombo = $single_fastest	= $single_tired	= '';

		// Check if the user want to see prev/next race
		if ($next) 
		{
			++$race_offset;
		}
		else if ($prev) 
		{
			--$race_offset;
		}

		// Delete a tip
		if ($del_tipp) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}

			//Ultimate Points MOD enabled for f1 webtipp?
			if ($formel_config['points_enabled'] == true)
			{   
				//Ultimate Points MOD  installed and enabled?
				if (isset($config['points_enable']) && $config['points_enable'] == true)
				{
					$sql = 'SELECT user_points 
							FROM ' . USERS_TABLE . ' 
							WHERE user_id = ' . $user_id; 	
					$result = $db->sql_query($sql);
					$row = $db->sql_fetchrow($result);
					$db->sql_freeresult($result);

					$sql = 'UPDATE ' . USERS_TABLE . ' 
							SET user_points = ' . ($row['user_points'] - $formel_config['points_value']) . ' 
							WHERE user_id = ' . $user_id; 
					$db->sql_query($sql);
				}
			}
			
			add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_DELETED', $race_id);
			
			formel_del_tip($user_id, $race_id);
		}

		// Add or edit a tip
		if (($place_my_tipp || $edit_my_tipp) && $tipp_time - $formel_config['deadline_offset'] >= time()) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			for ($i = 0; $i < 10; ++$i) 
			{
				$value = request_var('place' . ( $i + 1 ), 0);
				
				if (checkarrayforvalue($value, $my_tipp_array)) 
				{
					add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_NOT_VALID', $race_id);
					
					$tipp_msg = sprintf($user->lang['FORMEL_DUBLICATE_VALUES'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
					trigger_error($tipp_msg);
				}
				
				$my_tipp_array[$i] = $value;
			}
			
			$my_tipp_array['10'] 	= request_var('place11', 0); //['10'] --> fastest driver
			$my_tipp_array['11'] 	= request_var('place12', 0); //['11'] --> tired count
			$my_tipp 				= implode(",", $my_tipp_array);

			if ($place_my_tipp) 
			{
				$sql_ary = array(
					'tipp_user'		=> $user_id,
					'tipp_race'		=> $race_id,
					'tipp_result'	=> $my_tipp,
					'tipp_points'	=> 0,
				);

				$db->sql_query('INSERT INTO ' . FORMEL_TIPPS_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
				
				add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_GIVEN', $race_id);
				
				//Ultimate Points MOD enabled for F1 webtipp?
				if ($formel_config['points_enabled'] == true)
				{   
					//Ultimate Points MOD installed and enabled?
					if (isset($config['points_enable']) && $config['points_enable'] == true)
					{
						$sql = 'SELECT user_points 
								FROM ' . USERS_TABLE . ' 
								WHERE user_id = ' . $user_id; 	
						$result = $db->sql_query($sql);
						$row = $db->sql_fetchrow($result);
						$db->sql_freeresult($result);

						$sql = 'UPDATE ' . USERS_TABLE . ' 
								SET user_points = ' . ($row['user_points'] + $formel_config['points_value'])  . ' 
								WHERE user_id = ' . $user_id; 
						$db->sql_query($sql);
					}
				}
			}
			else 
			{
				$sql_ary = array(
					'tipp_result'	=> $my_tipp,
				);

				$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE tipp_user = ' . (int) $user_id . '
						AND tipp_race = ' . (int) $race_id;
				$db->sql_query($sql);
				
				add_log('user', $user->data['user_id'], 'LOG_FORMEL_TIP_EDITED', $race_id);
			}
			
			$tipp_msg = sprintf($user->lang['FORMEL_ACCEPTED_TIPP'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
			trigger_error( $tipp_msg);
		}

		// Get all races
		$races = get_formel_races();
		$current_time = time();

		// Get all teams
		$teams = get_formel_teams();

		// Get all drivers
		$drivers = get_formel_drivers();
		$driver_combodata = get_formel_drivers_data();

		// Get all tips and fill top10
		$sql = 'SELECT sum(tipp_points) AS total_points, tipp_user 
			FROM ' . FORMEL_TIPPS_TABLE . '
			GROUP BY tipp_user
			ORDER BY total_points DESC LIMIT 5';
		$result = $db->sql_query($sql);

		$rank = $real_rank  = 0;
		$previous_points = false;
		
		while ($row = $db->sql_fetchrow($result)) 
		{ 
			++$real_rank;
			
			if ($row['total_points'] <> $previous_points) 
			{ 
				$rank = $real_rank; 
				$previous_points = $row['total_points']; 
			}
			
			$tipp_user_row		= get_formel_userdata($row['tipp_user']);
			$tipp_username_link	= get_username_string('full', $tipp_user_row['user_id'], $tipp_user_row['username'], $tipp_user_row['user_colour']);
			
			$template->assign_block_vars('top_tippers', array(
				'TIPPER_NAME' 	=> $tipp_username_link,
				'RANK'			=> $rank,
				'TIPPER_POINTS' => $row['total_points'],
				)
			);
		}
		
 		$db->sql_freeresult($result);

		//Get all first place winner, count all first places,  grep all gold medals...  Marker for first place: 25 WM Points
		$sql = 'SELECT 	count(wm_driver) as gold_medals, 
						wm_driver
				FROM 	' . FORMEL_WM_TABLE . '
				WHERE 	wm_points = 25
				GROUP BY wm_driver
				ORDER BY gold_medals DESC';
		$result = $db->sql_query($sql);
		
		// Now put the gold medals into the $drivers array
		while ($row = $db->sql_fetchrow($result))
		{
			$drivers[$row['wm_driver']]['gold_medals']	= $row['gold_medals'];
		}
		
		// Get all wm points and fill top10 drivers
		$sql = 'SELECT sum(wm_points) AS total_points, wm_driver 
			FROM ' . FORMEL_WM_TABLE . '
			GROUP BY wm_driver
			ORDER BY total_points DESC';
		$result = $db->sql_query($sql);

		//Stop! we have to recalc the driver WM points... maybe we have some penalty !
		$recalc_drivers = array();
		
		while ($row = $db->sql_fetchrow($result))
		{
			$recalc_drivers[$row['wm_driver']]['total_points'] 	= $row['total_points'] - $drivers[$row['wm_driver']]['driver_penalty'];
			$recalc_drivers[$row['wm_driver']]['gold_medals']	= (isset($drivers[$row['wm_driver']]['gold_medals'])) ? $drivers[$row['wm_driver']]['gold_medals'] : 0;
			$recalc_drivers[$row['wm_driver']]['driver_name']	= $drivers[$row['wm_driver']]['driver_name'];
		}
		
		// re-sort the drivers. Big points first ;-)
		arsort($recalc_drivers);

		$rank = $limit = 0;
		$previous_points = false;
		
		foreach ($recalc_drivers as $driver_id => $driver) 
		{ 
			if ($limit == 5) 
			{
				break;
			}
			
			++$rank; 

			$wm_drivername = $driver['driver_name'];
			
			$template->assign_block_vars('top_drivers', array(
				'RANK'			=> $rank,
				'WM_DRIVERNAME'	=> $wm_drivername,
				'WM_POINTS'		=> $driver['total_points'],
				)
			);
			
			++$limit;
		}
		
		$db->sql_freeresult($result);

		// Get all wm points and fill top10 teams
		$sql = 'SELECT sum(wm_points) AS total_points, wm_team 
			FROM ' . FORMEL_WM_TABLE . '
			GROUP BY wm_team
			ORDER BY total_points DESC';
		$result = $db->sql_query($sql);

		//Stop! we have to recalc the team WM points... maybe we have some penalty !
		$recalc_teams = array();
		
		while ($row = $db->sql_fetchrow($result))
		{
			$recalc_teams[$row['wm_team']]['total_points'] 	= $row['total_points'] - $teams[$row['wm_team']]['team_penalty'];
			$recalc_teams[$row['wm_team']]['team_name']		= $teams[$row['wm_team']]['team_name'];
			$recalc_teams[$row['wm_team']]['team_img']		= $teams[$row['wm_team']]['team_img'];
			$recalc_teams[$row['wm_team']]['team_car']		= $teams[$row['wm_team']]['team_car'];
		}
		
		// re-sort the teams. Big points first ;-)
		arsort($recalc_teams);
		
		$rank = $real_rank = $limit = 0;
		$previous_points = false;
		
		foreach ($recalc_teams as $team_id => $team) 
		{ 
			if ($limit == 5) 
			{
				break;
			}
			
			++$real_rank;
			
			if ($team['total_points'] <> $previous_points) 
			{ 
				$rank = $real_rank; 
				$previous_points = $team['total_points']; 
			}
			
			$wm_teamname = $team['team_name'];
			$template->assign_block_vars('top_teams', array(
				'RANK'			=> $rank,
				'WM_TEAMNAME'	=> $wm_teamname,
				'WM_POINTS'		=> $team['total_points'],
				)
			);
			
			++$limit;
		}
		
		$db->sql_freeresult($result);

		// Find current race
		for ($i = 0; $i < count($races); ++$i) 
		{
			if ($races[$i]['race_time'] > $current_time - $formel_config['event_change']) 
			{
				// Check for a overflow
				$race_offset = ($i + $race_offset == count($races)) ? 0 - $i  : $race_offset;
				$race_offset = ($i + $race_offset < 0) ? count($races) - 1 - $i : $race_offset;

				// Define current race incl. user given offset
				$chosen_race = $i + $race_offset;

				$user_tipp_points = 0;
				$race_id = $races[$chosen_race]['race_id'];
				$user_id = $user->data['user_id'];

				$timezone = $user->data['user_timezone'] *3600;
				$dst = $user->data['user_dst'] * 3600;
				$zone_offset = $timezone - $dst;
				
				//Countdown data
				if ($formel_config['show_countdown'] == 1)
				{
					$event_stop	= date($races[$chosen_race]['race_time'] - $zone_offset - $formel_config['deadline_offset']);
					$b_day		= $user->format_date($event_stop, 'd');
					$b_month	= $user->format_date($event_stop, 'n');
					$b_year		= $user->format_date($event_stop, 'Y');
					$b_hour		= $user->format_date($event_stop, 'H');
					$b_minute	= $user->format_date($event_stop, 'i');
					$b_second	= $user->format_date($event_stop, 's');
					
					switch ($b_month)
					{
						case 1:
								$b_month = 'January';
						break;
							
						case 2:
								$b_month = 'February';
						break;
							
						case 3:
								$b_month = 'March';
						break;
							
						case 4:
								$b_month = 'April';
						break;
							
						case 5:
								$b_month = 'May';
						break;
						
						case 6:
								$b_month = 'June';
						break;
							
						case 7:
								$b_month = 'July';
						break;
							
						case 8:
								$b_month = 'August';
						break;
							
						case 9:
								$b_month = 'September';
						break;
							
						case 10:
								$b_month = 'October';
						break;
							
						case 11:
								$b_month = 'November';
						break;
							
						case 12:
								$b_month = 'December';
						break;
					}

					$stop = $b_month . ' ' . $b_day . ', ' . $b_year . ' ' . $b_hour . ':' . $b_minute . ':' . $b_second;
					
					$countdown = "<script type=\"text/javascript\">
								// <![CDATA[
								var eventdate = new Date('" . $stop . "');
								function toSt(n)
								{
															s=''
															if(n<10) s+='0'
															return s+n.toString();
								}
								function countdown()
								{
									d=new Date();
									count=Math.floor((eventdate.getTime()-d.getTime())/1000);
									if(count<=0)
									{
										var time_event = document.getElementById('time_event');
										var event_time = document.getElementById('event_time');
										time_event.style.display = 'none';
										event_time.style.display = '';
										return;
									}
									secs_count = toSt(count%60);
									count=Math.floor(count/60);
									mins_count = toSt(count%60);
									count=Math.floor(count/60);
									hours_count = toSt(count%24);
									count=Math.floor(count/24);
									days_count = count;
									document.getElementById('countdown').days.value = days_count;
									document.getElementById('countdown').hours.value = hours_count;
									document.getElementById('countdown').mins.value = mins_count;
									document.getElementById('countdown').secs.value = secs_count;
									window.setTimeout('countdown()',500);
								}
								// ]]>
								</script>";
				}
				
				// Get race image and data
				$race_img = $races[$chosen_race]['race_img'];
				$race_img = ($race_img == '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_race_img'] . '" width="' . $formel_config['race_img_width'] . '" height="' . $formel_config['race_img_height'] . '" alt="" />' : '<img src="' . $phpbb_root_path . 'images/formel/' . $race_img . '" width="' . $formel_config['race_img_width'] . '" height="' . $formel_config['race_img_height'] . '" alt="" />';

				$template->assign_block_vars('racerow', array(
					'RACEIMG' 		=> $race_img,
					'RACENAME' 		=> $races[$chosen_race]['race_name'],
					'RACELENGTH' 	=> $races[$chosen_race]['race_length'] . ' km',
					'RACEDEBUT' 	=> $races[$chosen_race]['race_debut'],
					'RACEDISTANCE' 	=> $races[$chosen_race]['race_distance'] . ' km',
					'RACELAPS' 		=> $races[$chosen_race]['race_laps'],
					'RACETIME' 		=> $user->format_date($races[$chosen_race]['race_time']),
					'RACEDEAD' 		=> $user->format_date($races[$chosen_race]['race_time'] - $formel_config['deadline_offset']),
					)
				);

				if ($formel_config['show_gfxr'] == 1)
				{
					$template->assign_block_vars('racerow.racegfx', array());
				}

				// Find current tippers and their points
				// Get tip data
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . ' 
					WHERE tipp_race = ' . (int) $race_id . '
						ORDER BY tipp_points DESC';
				$result = $db->sql_query($sql);

				$tippers_active = $db->sql_affectedrows($result);
				$cur_counter = 1;
				
				while ($row = $db->sql_fetchrow($result)) 
				{
					$current_tippers_userdata 	= get_formel_userdata($row['tipp_user']);
					$current_tipp_id 			= $row['tipp_id'];
					$current_tippers_username 	= get_username_string('username', $row['tipp_user'], $current_tippers_userdata['username'], $current_tippers_userdata['user_colour'] );
					$current_tippers_colour		= get_username_string('colour'  , $row['tipp_user'], $current_tippers_userdata['username'], $current_tippers_userdata['user_colour'] );
					$separator 					= ($cur_counter == $tippers_active) ? '': ', ';
					
					$template->assign_block_vars('tipps_made', array(
						'USERTIPP' 		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=usertipp&amp;tipp=$current_tipp_id&amp;race=$chosen_race"),
						'SEPARATOR' 	=> $separator,
						'USERNAME' 		=> $current_tippers_username . ' (' . $row['tipp_points'] . ')',
						'STYLE'			=> ($current_tippers_colour) ? ' style="color: ' . $current_tippers_colour . '; font-weight: bold;"' : '',
						)
					);
					
					++$cur_counter;
				}
				
				if ($tippers_active == 0) 
				{
					$template->assign_block_vars('no_tipps_made', array());
				}
				
				$db->sql_freeresult($result);

				// Get tip data
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . ' 
					WHERE tipp_race = ' . (int) $race_id . ' 
						AND tipp_user = ' . (int) $user_id;
				$result = $db->sql_query($sql);

				$tipp_active 		= $db->sql_affectedrows($result);
				$delete_button 		= '';
				$tipp_button 		= $user->lang['FORMEL_ADD_TIPP'];
				$tipp_button_name 	= 'place_my_tipp';
				$tipp_data 			= $db->sql_fetchrowset($result);
				
				$db->sql_freeresult($result);

				// Check if a tip has been made before
				if ($tipp_active > 0) 
				{
					$tipp_button		= $user->lang['FORMEL_EDIT_TIPP'];
					$tipp_button_name	= 'edit_my_tipp';
					$delete_button		= '&nbsp;<input class="button1" type="submit" name="del_tipp" value="' . $user->lang['FORMEL_DEL_TIPP'] . '" />';
					$tipp_array			= explode(",", $tipp_data['0']['tipp_result']);
					$user_tipp_points	= $tipp_data['0']['tipp_points'];

					for ($i = 0; $i < count($tipp_array) - 2; ++$i) 
					{
						$results		= explode(",", $races[$chosen_race]['race_result']);
						$position		= ($i == 0) ? $user->lang['FORMEL_RACE_WINNER'] : $i + 1 . '. ' . $user->lang['FORMEL_PLACE'];
						$box_name		= 'place' . ($i + 1);
						$single_points	= '';

						if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
						{
							//Actual race is over
							$driverid 			= (isset($drivers[$tipp_array[$i]]['driver_id']))			?	$drivers[$tipp_array[$i]]['driver_id']			:	'';
							$drivercombo 		= (isset($drivers[$tipp_array[$i]]['driver_name']))			?	$drivers[$tipp_array[$i]]['driver_name']		:	'';
							$driverteamname 	= (isset($drivers[$tipp_array[$i]]['driver_team_name']))	?	$drivers[$tipp_array[$i]]['driver_team_name']	:	'';
							$gfxdrivercar 		= (isset($drivers[$tipp_array[$i]]['driver_car']))			?	$drivers[$tipp_array[$i]]['driver_car']			:	'';
							$gfxdrivercombo 	= (isset($drivers[$tipp_array[$i]]['driver_img']))			?	$drivers[$tipp_array[$i]]['driver_img']			:	'';

							//Recalc tip points for every single placed tip
							if (isset($results[$i]))
							{
								if ($driverid == $results[$i])
								{
									$single_points += $formel_config['points_placed'];
								}
							}
							
							for ($j = 0; $j < count($tipp_array) - 2; ++$j)
							{
								if (isset($results[$j]))
								{
									if ($driverid == $results[$j])
									{
										$single_points += $formel_config['points_mentioned'];
									}
								}
							}
							
							if ($single_points == 0) 
							{
								$single_points='';
							}
							// End recalc
						}
						else 
						{
							//Actual race is not over
							$drivercombo = '<select name="' . $box_name . '" size="1">';
							
							for ($k = 0; $k < count($driver_combodata); ++$k) 
							{
								$this_driver_id 	 = $driver_combodata[$k]['driver_id'];
								$this_driver_name 	 = $driver_combodata[$k]['driver_name'];
								$selected 			 = ($this_driver_id == $tipp_array[$i]) ? 'selected' : '';
								$drivercombo 		.= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
							}
							
							$drivercombo .= '</select>';
						}
						
						if ($formel_config['show_gfx'] == 1)
						{
							//Layout cosmetic
							if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time)
							{
								//Race is over - Show driverimage and so on
								$template->assign_block_vars('gfx_users_tipp', array(
									'L_PLACE'			=>	'&nbsp;' . $position . '<br />',
									'DRIVERCOMBO'		=>	$drivercombo . '<br />',
									'DRIVERTEAMNAME'	=>	'&nbsp;' . $driverteamname,
									'GFXDRIVERCOMBO'	=>	$gfxdrivercombo,
									'GXFDRIVERCAR'		=>	$gfxdrivercar,
									'SINGLE_POINTS'		=>	$single_points,
									)
								);
							}
							else
							{
								// Race is not over - Show position instead of driverimage
								$template->assign_block_vars('gfx_users_tipp', array(
									'L_PLACE'			=>	'',
									'DRIVERCOMBO'		=>	$drivercombo,
									'DRIVERTEAMNAME'	=>	$driverteamname,
									'GFXDRIVERCOMBO'	=>	$position,
									'GXFDRIVERCAR'		=>	$gfxdrivercar,
									'SINGLE_POINTS'		=>	$single_points,
									)
								);
							}
						}
						else
						{
							$template->assign_block_vars('users_tipp', array(
								'L_PLACE'		=>	$position,
								'DRIVERCOMBO'	=>	$drivercombo,
								'SINGLE_POINTS'	=>	$single_points,
								)
							);
						}
					}
					
					if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
					{
						//Actual Race is over
						$single_fastest	= '';
						$single_tired	= '';
						$drivercombo	= (isset($drivers[$tipp_array['10']]['driver_name'])) ? $drivers[$tipp_array['10']]['driver_name'] : '';
						$tiredcombo		= (isset($tipp_array['11'])) ? $tipp_array['11'] : '';

						//Recalc tip points for fastest driver
						if (isset($results['10']) && $results['10'] <> 0)
						{
							if ($tipp_array['10'] == $results['10'])
							{
								$single_fastest += $formel_config['points_fastest'];
							}
						}
						
						//Recalc tip points for tired count
						if (isset($results['11']))
						{
							if ($tipp_array['11'] == $results['11'])
							{
								$single_tired += $formel_config['points_tired'];
							}
						}
					}
					else 
					{
						//Actual Race is not over
						$drivercombo = '<select name="place11" size="1">';
						
						for ($k = 0; $k < count($driver_combodata); ++$k) 
						{
							$this_driver_id		 = $driver_combodata[$k]['driver_id'];
							$this_driver_name	 = $driver_combodata[$k]['driver_name'];
							$selected			 = ($this_driver_id == $tipp_array['10']) ? 'selected' : '';
							$drivercombo		.= '<option value="' . $this_driver_id . '" ' . $selected .'>' . $this_driver_name . '</option>';
						}
						
						$drivercombo .= '</select>';

						$tiredcombo = '<select name="place12" size="1">';
						
						//We have 12 Teams with 2 cars each --> 24 drivers
						for ($k = 0; $k < 25; ++$k) 
						{
							$selected 			 = ($k == $tipp_array['11']) ? 'selected' : '';
							$tiredcombo 		.= '<option value="' . $k . '" ' . $selected . '>' . $k . '</option>';
						}
						
						$tiredcombo .= '</select>';
					}


					if ($formel_config['show_gfx'] == 1)
					{
						$template->assign_block_vars('extended_users_tipp_gfx', array(
							'TIREDCOMBO'		=> $tiredcombo,
							'DRIVERCOMBO'		=> $drivercombo,
							'GFXDRIVERCOMBO'	=> $gfxdrivercombo,
							'SINGLE_FASTEST'	=> $single_fastest,
							'SINGLE_TIRED'		=> $single_tired,
							)
						);
					}
					else
					{
						$template->assign_block_vars('extended_users_tipp', array(
							'TIREDCOMBO'		=> $tiredcombo,
							'DRIVERCOMBO'		=> $drivercombo,
							'GFXDRIVERCOMBO'	=> $gfxdrivercombo,
							'SINGLE_FASTEST'	=> $single_fastest,
							'SINGLE_TIRED'		=> $single_tired,
							)
						);
					}
				}

				// What to do if the user has no tip so far
				else
				{
					//Guests are not allowed to place a tip.
					if ($user->data['is_registered'])
					{
						if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] > $current_time) 
						{
							//Actual Race is not over
							for ($i = 0; $i < 10; ++$i) 
							{
								$position = ($i == 0) ? $user->lang['FORMEL_RACE_WINNER'] : $i + 1 . '. ' . $user->lang['FORMEL_PLACE'];
								$box_name = 'place' . ($i + 1);

								$drivercombo = '<select name="' . $box_name . '" size="1">';
								
								for ($k = 0; $k < count($driver_combodata); ++$k) 
								{
									$this_driver_id		 = $driver_combodata[$k]['driver_id'];
									$this_driver_name	 = $driver_combodata[$k]['driver_name'];
									$drivercombo		.= '<option value="' . $this_driver_id . '">' . $this_driver_name . '</option>';
								}
								
								$drivercombo .= '</select>';

								$template->assign_block_vars('add_tipp', array(
									'L_PLACE'		=> $position,
									'DRIVERCOMBO'	=> $drivercombo,
									)
								);
							}

							$drivercombo = '<select name="place11" size="1">';
							
							for ($k = 0; $k < count($driver_combodata); ++$k) 
							{
								$this_driver_id		 = $driver_combodata[$k]['driver_id'];
								$this_driver_name	 = $driver_combodata[$k]['driver_name'];
								$drivercombo 		.= '<option value="' . $this_driver_id . '">' . $this_driver_name . '</option>';
							}
							
							$drivercombo .= '</select>';

							$tiredcombo = '<select name="place12" size="1">';
							
							//We have 12 Teams with 2 cars each --> 24 drivers
							for ($k = 0; $k < 25; ++$k) 
							{
								$tiredcombo .= '<option value="' . $k . '">' . $k . '</option>';
							}
							
							$tiredcombo .= '</select>';

							$template->assign_block_vars('extended_add_tipp', array(
								'TIREDCOMBO'	=> $tiredcombo,
								'DRIVERCOMBO'	=> $drivercombo,
								)
							);
						}
					}
					else
					{
						$template->assign_block_vars('add_tipp', array(
							'DRIVERCOMBO'	=> '<br /> ' . $user->lang['FORMEL_GUESTS_PLACE_NO_TIP'],
							)
						);
					}
				}

				// Checks for a saved quali
				if ($races[$chosen_race]['race_quali'] <> '0') 
				{
					// Get the driver ids
					$quali = explode(",", $races[$chosen_race]['race_quali']);

					// Start output
					for ($j = 0; $j < count($quali); ++$j) 
					{
						$current_driver_id = $quali[$j];
						$position = ($j == 0) ? $user->lang['FORMEL_POLE'].': ' : $j + 1 . '. ' . $user->lang['FORMEL_PLACE'] . ': ';
						
						if ($formel_config['show_gfx'] == 1)
						{
							$template->assign_block_vars('qualirow_gfx', array(
								'L_PLACE'			=> $position,
								'DRIVERIMG'			=> (isset($drivers[$current_driver_id]['driver_img'])) 			? $drivers[$current_driver_id]['driver_img'] 		: '',
								'DRIVERCAR'			=> (isset($drivers[$current_driver_id]['driver_car'])) 			? $drivers[$current_driver_id]['driver_car'] 		: '',
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) 		? $drivers[$current_driver_id]['driver_name'] 		: '',
								'DRIVERTEAMNAME'	=> (isset($drivers[$current_driver_id]['driver_team_name'])) 	? $drivers[$current_driver_id]['driver_team_name'] 	: '',
								)
							);
						}
						else 
						{
							$template->assign_block_vars('qualirow', array(
								'L_PLACE'			=> $position,
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) 		? $drivers[$current_driver_id]['driver_name'] 		: '',
								)
							);
						}
					}
				}
				else 
				{
					// If no quali was found
					$template->assign_block_vars('no_quali', array());
				}

				// Checks for a saved result
				if ($races[$chosen_race]['race_result'] <> '0') 
				{
					// Get the driver ids
					$results = explode(",", $races[$chosen_race]['race_result']);

					// Start output
					for ($j = 0; $j < count($results) - 2; ++$j) 
					{
						$current_driver_id = $results[$j];
						$position = ($j == 0) ? $user->lang['FORMEL_RACE_WINNER'].': ' : $j + 1 . '. ' . $user->lang['FORMEL_PLACE'] . ': ';
						
						if ($formel_config['show_gfx'] == 1)
						{
							$template->assign_block_vars('resultsrow_gfx', array(
								'L_PLACE'			=> $position,
								'DRIVERIMG'			=> (isset($drivers[$current_driver_id]['driver_img'])) 			? $drivers[$current_driver_id]['driver_img'] 		: '',
								'DRIVERCAR'			=> (isset($drivers[$current_driver_id]['driver_car'])) 			? $drivers[$current_driver_id]['driver_car'] 		: '',
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) 		? $drivers[$current_driver_id]['driver_name'] 		: '',
								'DRIVERTEAMNAME'	=> (isset($drivers[$current_driver_id]['driver_team_name'])) 	? $drivers[$current_driver_id]['driver_team_name'] 	: '',
								)
							);
						}
						else 
						{
							$template->assign_block_vars('resultsrow', array(
								'L_PLACE'			=> $position,
								'DRIVERNAME'		=> (isset($drivers[$current_driver_id]['driver_name'])) 		? $drivers[$current_driver_id]['driver_name'] 		: '',
								)
							);
						}
					}

					if ($formel_config['show_gfx'] == 1)
					{
						$template->assign_block_vars('extended_results_gfx', array(
							'PACE'				=> (isset($drivers[$results['10']]['driver_name']))	? $drivers[$results['10']]['driver_name'] 	: '',
							'TIRED'				=> (isset($results['11'])) 							? $results['11'] 							: '',
							'YOUR_POINTS'		=> $user_tipp_points,
							)	
						);
					}
					else
					{
						$template->assign_block_vars('extended_results', array(
							'PACE'				=> (isset($drivers[$results['10']]['driver_name']))	? $drivers[$results['10']]['driver_name'] 	: '',
							'TIRED'				=> (isset($results['11'])) 							? $results['11'] 							: '',
							'YOUR_POINTS'		=> $user_tipp_points,
							)
						);
					}
				}
				else 
				{
					// If no result was found
					$template->assign_block_vars('no_results', array());
				}

				// Game over
				if ($races[$chosen_race]['race_time'] - $formel_config['deadline_offset'] < $current_time) 
				{
					$template->assign_block_vars('game_over', array());
				}
				else 
				{
					//Check if it is a registered user. Guests are not allowed to place, edit or delete a tip.
					if ($user->data['is_registered'])
					{
						$template->assign_block_vars('place_tipp', array(
							'DELETE_TIPP'	=> $delete_button,
							'L_PLACE_TIPP'	=> $tipp_button,
							'PLACE_TIPP'	=> $tipp_button_name,
							)
						);
					}
				}
				
				break;
			}
		}

		// Forum button
		$discuss_button = '';
		
		if ($formel_forum_id) 
		{
			$formel_forum_url	= append_sid("viewforum.$phpEx?f=$formel_forum_id");
			$formel_forum_name	= $user->lang['FORMEL_FORUM'];
			$discuss_button		= '<input class="button1" type="button" onclick="window.location.href=\'' . $formel_forum_url . '\'" value="' . $formel_forum_name . '" />&nbsp;&nbsp;';
		}

		// Moderator switch and options
		$u_call_mod = append_sid("ucp.$phpEx?i=pm&amp;mode=compose&amp;u=$formel_mod_id");
		$l_call_mod = $user->lang['FORMEL_CALL_MOD'];
		
		// Some debug code to test the $auth
		//echo "<pre>";print_r($auth);echo "</pre>";die();
		
		//Check if user is formel moderator or has admin access
		if ($user_id == $formel_config['mod_id'] || ($is_admin == 1)) 
		{
			$u_call_mod = append_sid("{$phpbb_root_path}formel.$phpEx?mode=results");
			$l_call_mod = $user->lang['FORMEL_MOD_BUTTON_TEXT'];
			
			$template->assign_block_vars('tipp_moderator', array());
		}

		// Show headerbanner ?
		if ($formel_config['show_headbanner'])
		{
			$template->assign_block_vars('head_on', array());
		}

		$chosen_race = (isset($chosen_race)) ? $chosen_race : 0;
		
		$template->assign_vars(array(
			'S_STANDARD'			=> true,
			'S_COUNTDOWN'			=> ($formel_config['show_countdown'] == 1) ? true : false,
			'S_FORM_ACTION'			=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'U_FORMEL'				=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'RACE_OFFSET'			=> $race_offset,
			'HEADER_IMG'			=> $formel_config['headbanner1_img'],
			'HEADER_URL'			=> $formel_config['headbanner1_url'],
			'HEADER_HEIGHT'			=> $formel_config['head_height'],
			'HEADER_WIDTH'			=> $formel_config['head_width'],
			'RACE_ID'				=> (isset($races[$chosen_race]['race_id'])) ? $races[$chosen_race]['race_id'] : 1,
			'RACE_TIME'				=> (isset($races[$chosen_race]['race_time'])) ? $races[$chosen_race]['race_time'] : 1,
			'U_TOP_MORE_USERS'		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats&amp;show_users=1"),
			'U_TOP_MORE_DRIVERS'	=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats&amp;show_drivers=1"),
			'U_TOP_MORE_TEAMS'		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats&amp;show_teams=1"),
			'U_FORMEL_RULES'		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=rules"),
			'U_FORMEL_FORUM'		=> $discuss_button,
			'U_FORMEL_STATISTICS'	=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats"),
			'U_FORMEL_CALL_MOD'		=> $u_call_mod,
			'COUNTDOWN'				=> (isset($countdown)) ? $countdown : '',
			'L_FORMEL_CALL_MOD'		=> $l_call_mod,
			)
		);
		
	break;
		
	case 'results':

		// Set template vars
		$page_title = $user->lang['FORMEL_TITLE'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=results"),
			'FORUM_NAME'	=> $user->lang['FORMEL_RESULTS_TITLE'],
			)
		);
		
		// Check URL hijacker . Access only for formel moderators or admins
		if ($user->data['user_id'] <> $formel_mod_id && $is_admin <> 1)
		{
			$auth_msg = sprintf($user->lang['FORMEL_MOD_ACCESS_DENIED'], '<a href="' . append_sid("formel.$phpEx") . '" class="gen">', '</a>', '<a href="' . append_sid("index.$phpEx") . '" class="gen">', '</a>');
			trigger_error($auth_msg);
		}
		
		// Init some language vars
		$l_edit 	= $user->lang['FORMEL_EDIT'];
		$l_del 		= $user->lang['FORMEL_DELETE'];
		$l_add 		= $user->lang['FORMEL_RESULTS_ADD'];	
		
		// Fetch all races
		$sql = 'SELECT * 
			FROM ' . FORMEL_RACES_TABLE . ' 
			ORDER BY race_time ASC';
		$result = $db->sql_query($sql);
		
		while ($row = $db->sql_fetchrow($result))
		{
			$race_img 			= $row['race_img'];
			$race_id 			= $row['race_id'];
			$race_img 			= ($race_img == '') 				? '' : '<img src="' . $phpbb_root_path . 'images/formel/' . $race_img . '" width="94" height="54" alt="" />';
			$quali_buttons 		= ($row['race_quali'] == '0') 		? '<input class="button1" type="submit" name="quali"  value="' . $l_add . '" />' : '<input class="button1" type="submit" name="editquali"  value="' . $l_edit . '" />&nbsp;&nbsp;<input class="button1" type="submit" name="resetquali"  value="' . $l_del . '" />';
			$result_buttons 	= ($row['race_result'] == '0') 		? '<input class="button1" type="submit" name="result" value="' . $l_add . '" />' : '<input class="button1" type="submit" name="editresult" value="' . $l_edit . '" />&nbsp;&nbsp;<input class="button1" type="submit" name="resetresult" value="' . $l_del . '" />';

			if ($formel_config['show_gfxr'] == 1)
			{
				$template->assign_block_vars('racerow_gfxr', array(
					'RACEIMG'			=> $race_img,
					'QUALI_BUTTONS'		=> $quali_buttons,
					'RESULT_BUTTONS'	=> $result_buttons,
					'RACEID'			=> $race_id,
					'RACENAME'			=> $row['race_name'],
					'RACETIME'			=> $user->format_date($row['race_time']),
					'RACEDEAD'			=> $user->format_date($row['race_time'] - $formel_config['deadline_offset']),
					)
				);
			}
			else 
			{
				$template->assign_block_vars('racerow', array(
					'QUALI_BUTTONS'		=> $quali_buttons,
					'RESULT_BUTTONS'	=> $result_buttons,
					'RACEID'			=> $race_id,
					'RACENAME'			=> $row['race_name'],
					'RACETIME'			=> $user->format_date($row['race_time']),
					'RACEDEAD'			=> $user->format_date($row['race_time'] - $formel_config['deadline_offset']),
					)
				);
			}
		}
		
		$db->sql_freeresult($result);
		
		$template->assign_vars(array(
			'S_RESULTS'						=> true,
			'S_FORM_ACTION'					=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=addresults"),
			'U_FORMEL'						=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'U_FORMEL_RESULTS'				=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=results"),
			)
		);
		
	break;
		
	case 'addresults':

		// Set template vars
		$page_title = $user->lang['FORMEL_TITLE'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'	=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=results"),
			'FORUM_NAME'	=> $user->lang['FORMEL_RESULTS_TITLE'],
			)
		);
		
		// Check URL hijacker . Access only for formel moderators or admins
		if ($user->data['user_id'] <> $formel_mod_id && $is_admin <> 1)
		{
			$auth_msg = sprintf($user->lang['FORMEL_MOD_ACCESS_DENIED'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
			trigger_error($auth_msg);
		}
		
		// Check buttons & data

		$addresult 		= (isset($_POST['addresult'])) 		? true : false;
		$addeditresult 	= (isset($_POST['addeditresult'])) 	? true : false;	
		$editresult 	= (isset($_POST['editresult'])) 	? true : false;

		$addquali 		= (isset($_POST['addquali'])) 		? true : false;
		$editquali	 	= (isset($_POST['editquali'])) 		? true : false;	
		$quali 			= (isset($_POST['quali'])) 			? true : false;
		
		$reset 			= (isset($_POST['reset'])) 			? true : false;
		$resetquali 	= (isset($_POST['resetquali'])) 	? true : false;	
		$resetresult 	= (isset($_POST['resetresult'])) 	? true : false;
		
		$results		= request_var('result'			,	''	);
		$race_abort 	= request_var('race_abort'		,	0	);
		$race_id		= request_var('race_id'			,	0	);

		// Init some vars
		$quali_array	= array();
		$result_array	= array();
		
		// Reset a quali
		if ($resetquali && $race_id <> 0) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			$sql_ary = array(
				'race_quali'		=> 0,
			);

			$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE race_id = ' . (int) $race_id;
			$db->sql_query($sql);
			
			add_log('mod', $user->data['user_id'], 'LOG_FORMEL_QUALI_DELETED', $race_id);
			
			$tipp_msg = sprintf($user->lang['FORMEL_RESULTS_DELETED'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx?mode=results") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
			trigger_error($tipp_msg);
		}
		
		// Reset a result
		if ($resetresult && $race_id <> 0) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			// Delete all WM points for this race
			$sql = 'DELETE 
				FROM ' . FORMEL_WM_TABLE . ' 
				WHERE wm_race = ' . (int) $race_id;
			$db->sql_query($sql);

			// Delete the race result for this race
			$sql_ary = array(
				'race_result'	=> 0,
			);

			$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE race_id = ' . (int) $race_id;
			$db->sql_query($sql);
			
			// Delete all gathered tip points for this race
			$sql_ary = array(
				'tipp_points'	=> 0,
			);

			$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
				SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
				WHERE tipp_race = ' . (int) $race_id;
			$db->sql_query($sql);

			// Pull out a success message
			add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_DELETED', $race_id);
			
			$tipp_msg = sprintf($user->lang['FORMEL_RESULTS_DELETED'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx?mode=results") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
			trigger_error($tipp_msg);
		}

		if (($reset || $resetresult || $resetquali) && $race_id == 0) 
		{
			$reset_msg = sprintf($user->lang['FORMEL_RESULTS_ERROR'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx?mode=results") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
			trigger_error($reset_msg);
		}
		
		// Add a quali
		if ($addquali) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			if ($race_id <> 0) 
			{
				//We have 12 Teams with 2 cars each --> 24 drivers
				for ($i = 0; $i < 24; ++$i) 
				{
					$value = request_var('place' . ( $i + 1 ), 0);
					
					if (checkarrayforvalue($value, $quali_array)) 
					{
						add_log('user', $user->data['user_id'], 'LOG_FORMEL_QUALI_NOT_VALID', $race_id);
						
						$quali_msg = sprintf($user->lang['FORMEL_RESULTS_DOUBLE'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
						trigger_error($quali_msg);
					}
					
					$quali_array[$i] = $value;
				}
				
				$new_quali = implode(",", $quali_array);
				
				$sql_ary = array(
					'race_quali'	=> $new_quali,
				);

				$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE race_id = ' . (int) $race_id;
				$db->sql_query($sql);

				add_log('user', $user->data['user_id'], 'LOG_FORMEL_QUALI_ADDED', $race_id);
				
				$quali_msg = sprintf($user->lang['FORMEL_RESULTS_ACCEPTED'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx?mode=results") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
				trigger_error($quali_msg);
			}
		}
		
		// Add a result
		if ($addresult || $addeditresult) 
		{
			// Check the salt... yumyum
			if (!check_form_key('formel'))
			{
				trigger_error('FORM_INVALID');
			}
			
			if ($race_id <> 0) 
			{
				if ($addeditresult) 
				{
					$sql = 'DELETE 
						FROM ' . FORMEL_WM_TABLE . ' 
						WHERE wm_race = ' . (int) $race_id;
					$db->sql_query($sql);
				}
				
				for ($i = 0; $i < 10; ++$i) 
				{
					$value = request_var('place' . ( $i + 1 ), 0);
					
					if (checkarrayforvalue($value, $result_array)) 
					{
						add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_NOT_VALID', $race_id);
						
						$result_msg = sprintf($user->lang['FORMEL_RESULTS_DOUBLE'], '<a href="javascript:history.back()" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
						trigger_error($result_msg);
					}
					
					$result_array[$i] = $value;
				}
				
				$result_array['10'] = request_var('place11', 0);	//['10'] --> fastest driver
				$result_array['11'] = request_var('place12', 0);	//['11'] --> tired count
				$new_result = implode(",", $result_array);
				
				$sql_ary = array(
					'race_result'	=> $new_result,
				);

				$sql = 'UPDATE ' . FORMEL_RACES_TABLE . ' 
					SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
					WHERE race_id = ' . (int) $race_id;
				$db->sql_query($sql);				
				
				// START points calc
				// Get tipp data and calc user points
				$sql = 'SELECT * 
					FROM ' . FORMEL_TIPPS_TABLE . ' 
					WHERE tipp_race = ' . (int) $race_id;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result)) 
				{
					$user_tipp_points = 0;
					$current_user = $row['tipp_user'];
					$current_tipp_array = explode(',', $row['tipp_result']);
					$temp_results_array = array();
					
					for ($i=0; $i < count($current_tipp_array) - 2; ++$i) 
					{
						$temp_results_array[$i] = $result_array[$i];
					}
					
					for ($i=0; $i < count($current_tipp_array) - 2; ++$i) 
					{
						if ($current_tipp_array[$i] <> '0') 
						{
							if (checkarrayforvalue($current_tipp_array[$i], $temp_results_array)) 
							{
								$user_tipp_points += $formel_config['points_mentioned'];
								
								if ($current_tipp_array[$i] == $result_array[$i]) 
								{
									$user_tipp_points += $formel_config['points_placed'];
								}
							}
						}
					}
					
					if ($current_tipp_array['10'] == $result_array['10'] && $current_tipp_array['10'] <> 0) 
					{
						$user_tipp_points += $formel_config['points_fastest'];
					}
					
					if ($current_tipp_array['11'] == $result_array['11']) 
					{
						$user_tipp_points += $formel_config['points_tired'];
					}
					
					$sql_ary = array(
						'tipp_points'	=> $user_tipp_points,
					);

					$sql = 'UPDATE ' . FORMEL_TIPPS_TABLE . ' 
						SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
						WHERE tipp_race = ' . (int) $race_id . '
						AND tipp_user = ' . (int) $current_user;
					$update = $db->sql_query($sql);
				}
				
				$db->sql_freeresult($result);
				
				// Calc wm points
				// Get drivers data
				$sql = 'SELECT * 
					FROM ' . FORMEL_DRIVERS_TABLE;
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result)) 
				{
					$teams[$row['driver_id']] = $row['driver_team'];
				}
				
				$db->sql_freeresult($result);
				
				if ($race_abort == false)
				{
					// wm points:  25-18-15-12-10-8-6-4-2-1
					$wm = array();
					$wm['0'] = 25;		// first place
					$wm['1'] = 18;		// second place
					$wm['2'] = 15;		// third place
					$wm['3'] = 12;		// forth place
					$wm['4'] = 10;		// fifth place 
					$wm['5'] = 8;		// sixth place
					$wm['6'] = 6;		// seventh place
					$wm['7'] = 4;		// eighth place 
					$wm['8'] = 2;		// ninth place
					$wm['9'] = 1;		// tenth place                
				}
				else
				// the race was aborted, we use now half points
				{
					// wm points:  12.5-9-7.5-6-5-4-3-2-1-0.5
					$wm = array();
					$wm['0'] = 12.5;	// first place
					$wm['1'] = 9;		// second place
					$wm['2'] = 7.5;		// third place
					$wm['3'] = 6;		// forth place
					$wm['4'] = 5;		// fifth place 
					$wm['5'] = 4;		// sixth place
					$wm['6'] = 3;		// seventh place
					$wm['7'] = 2;		// eighth place 
					$wm['8'] = 1;		// ninth place
					$wm['9'] = 0.5;		// tenth place				
				}

				for ($i = 0; $i < count($result_array) - 2; ++$i) 
				{
					$current_driver = $result_array[$i];
					
					if ($current_driver <> '0') 
					{
						$current_team 	= $teams[$current_driver];
						$wm_points 		= $wm[$i];
						$sql_ary = array(
							'wm_race'	=> $race_id,
							'wm_driver'	=> $current_driver,
							'wm_team'	=> $current_team,
							'wm_points'	=> $wm_points,
						);

						$db->sql_query('INSERT INTO ' . FORMEL_WM_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
					}
				}
				// END points calc

				add_log('user', $user->data['user_id'], 'LOG_FORMEL_RESULT_ADDED', $race_id);
				
				$result_msg = sprintf($user->lang['FORMEL_RESULTS_ACCEPTED'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx?mode=results") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
				trigger_error($result_msg);
			}
		}
		
		// Load add/edit quali
		if (($quali || $editquali) && $race_id <> 0) 
		{
			if ($editquali) 
			{
				// Get the race
				$sql = 'SELECT * 
					FROM ' . FORMEL_RACES_TABLE . ' 
						WHERE race_id = ' . (int) $race_id;
				$result = $db->sql_query($sql);

				$row = $db->sql_fetchrow($result);
				$quali_array = explode(',', $row['race_quali']);
				$db->sql_freeresult($result);
			}
			
			// Fetch all drivers
			$sql = 'SELECT * 
				FROM ' . FORMEL_DRIVERS_TABLE . ' 
				ORDER BY driver_name ASC';
			$result = $db->sql_query($sql);

			$counter = 1;
			
			while ($row = $db->sql_fetchrow($result)) 
			{
				$drivers[$counter] = $row;
				++$counter;
			}
			
			$db->sql_freeresult($result);
			
			$drivers['0']['driver_id'] = '0';
			$drivers['0']['driver_name'] = $user->lang['FORMEL_DEFINE'];
			
			//We have 12 Teams with 2 cars each --> 24 drivers
			for ($i = 0; $i < 24; ++$i) 
			{
				$position = ($i == 0) ? $user->lang['FORMEL_POLE'] : $i + 1 . '. ' . $user->lang['FORMEL_PLACE'];
				$box_name = 'place' . ($i + 1);
				
				$drivercombo = '<select name="' . $box_name . '" size="1">';
				
				for ($k = 0; $k < count($drivers); ++$k) 
				{
					$this_driver_id = $drivers[$k]['driver_id'];
					$this_driver_name = $drivers[$k]['driver_name'];
					
					if (isset($quali_array[$i]))
					{
						$selected = ( $this_driver_id == $quali_array[$i]) ? 'selected="selected"' : '';
					}
					else
					{
						$selected = '';
					}
					
					$drivercombo .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
				}
				
				$drivercombo .= '</select>';
				
				$template->assign_block_vars('qualirow', array(
					'L_PLACE'		=> $position,
					'DRIVERCOMBO'	=> $drivercombo,
					)
				);
			}
			
			$template->assign_block_vars('quali', array());
		}	

		// Load add or edit result
		if (($results || $editresult) && $race_id <> 0) 
		{
			if ($editresult) 
			{
				// Get the race
				$sql = 'SELECT * 
					FROM ' . FORMEL_RACES_TABLE . ' 
					WHERE race_id = ' . (int) $race_id;
				$result = $db->sql_query($sql);

				$row = $db->sql_fetchrow($result);
				$result_array = explode(',', $row['race_result']);
				$db->sql_freeresult($result);
			}
			
			// Fetch all drivers
			$sql = 'SELECT * 
				FROM ' . FORMEL_DRIVERS_TABLE . ' 
				ORDER BY driver_name ASC';
			$result = $db->sql_query($sql);

			$counter = 1;
			
			while ($row = $db->sql_fetchrow($result)) 
			{
				$drivers[$counter] = $row;
				++$counter;
			}
			
			$db->sql_freeresult($result);
			
			$drivers['0']['driver_id'] = '0';
			$drivers['0']['driver_name'] = $user->lang['FORMEL_DEFINE'];
			
			for ($i = 0; $i < 10; ++$i) 
			{
				$position = ($i == 0) ? $user->lang['FORMEL_RACE_WINNER'] : $i + 1 . '. ' . $user->lang['FORMEL_PLACE'];
				$box_name = 'place' . ($i + 1);
				
				$drivercombo = '<select name="' . $box_name . '" size="1">';
				
				for ($k = 0; $k < count($drivers); ++$k) 
				{
					$this_driver_id = $drivers[$k]['driver_id'];
					$this_driver_name = $drivers[$k]['driver_name'];
					
					if (isset($result_array[$i]))
					{
						$selected = ($this_driver_id == $result_array[$i]) ? 'selected="selected"' : '';
					}
					else
					{
						$selected = '';
					}
					
					$drivercombo .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
				}
				
				$drivercombo .= '</select>';
				
				$template->assign_block_vars('resultrow', array(
					'L_PLACE' 		=> $position,
					'DRIVERCOMBO' 	=> $drivercombo,
					)
				);
			}
			
			$drivercombo_pace = '<select name="place11" size="1">';
			
			for ($k = 0; $k < count($drivers); ++$k) 
			{
				$this_driver_id = $drivers[$k]['driver_id'];
				$this_driver_name = $drivers[$k]['driver_name'];
				
				if (isset($result_array['10']))
				{
					$selected = ( $this_driver_id == $result_array['10']) ? 'selected="selected"' : '';
				}
				else
				{
					$selected = '';
				}
				
				$drivercombo_pace .= '<option value="' . $this_driver_id . '" ' . $selected . '>' . $this_driver_name . '</option>';
			}
			
			$drivercombo_pace .= '</select>';
			
			$combo_tired = '<select name="place12" size="1">';
			
			//We have 12 Teams with 2 cars each --> 24 drivers
			for ($k = 0; $k < 25; ++$k) 
			{
				if (isset($result_array['11']))
				{
					$selected = ( $k == $result_array['11']) ? 'selected="selected"' : '';
				}
				else
				{
					$selected = '';
				}
				
				$combo_tired .= '<option value="' . $k . '" ' . $selected . '>' . $k . '</option>';
			}
			
			$combo_tired .= '</select>';
			
			$modus = ($editresult) ? 'addeditresult' : 'addresult';
			
			$template->assign_block_vars('result', array(
				'PACECOMBO' 	=> $drivercombo_pace,
				'MODE' 			=> $modus,
				'TIREDCOMBO' 	=> $combo_tired,
				)
			);
		}

		$template->assign_vars(array(
			'S_ADDRESULTS'					=> true,
			'S_FORM_ACTION' 				=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=addresults"),
			'U_FORMEL' 						=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'U_FORMEL_RESULTS' 				=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=results"),
			'RACE_ID' 						=> $race_id,
			)
		);

	break;

	case 'usertipp':

		// Set template vars
		$page_title = $user->lang['FORMEL_TITLE'];
		$template_html = 'formel_body.html';
		
		// Check buttons & data
		$tipp_id = request_var('tipp',	0);
		$race_id = request_var('race',	0);

		// Get current race and time
		$race 			= get_formel_races();
		$results		= explode(",", $race[$race_id]['race_result']);
		$current_time	= time();

		// Get current tip
		$sql = 'SELECT * 
			FROM ' . FORMEL_TIPPS_TABLE . ' 
			WHERE tipp_id = ' . (int) $tipp_id;
		$result = $db->sql_query($sql);

		$tipp_active = $db->sql_affectedrows($result);
		
		// Do the work only if there is a tip
		if ($tipp_active)
		{
			$tippdata = $db->sql_fetchrowset($result);
			$tipp_userdata = get_formel_userdata($tippdata['0']['tipp_user']);
			$db->sql_freeresult($result);

			// Get all drivers
			$sql = 'SELECT * 
				FROM ' . FORMEL_DRIVERS_TABLE . ' 
				ORDER BY driver_id ASC';
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$driver_name[$row['driver_id']] = $row['driver_name'];
			}
			
			$db->sql_freeresult($result);

			// Get all tip points
			$sql = 'SELECT sum(tipp_points) AS total_points 
				FROM ' . FORMEL_TIPPS_TABLE . ' 
				WHERE tipp_user = ' . (int) $tipp_userdata['user_id'];
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$tipper_all_points = $row['total_points'];
			}
			
			$db->sql_freeresult($result);

			// Build output

			$tipp_array 		= array();
			$tipper_name 		= get_username_string('username', $tipp_userdata['user_id'], $tipp_userdata['username'], $tipp_userdata['user_colour']);
			$tipp_user_colour	= get_username_string('colour', $tipp_userdata['user_id'], $tipp_userdata['username'], $tipp_userdata['user_colour']);	
			$tipper_style		= ($tipp_user_colour) ? ' style="color: ' . $tipp_user_colour . '; font-weight: bold;"' : '' ;
			$tipper_link 		= ($tipper_name <> $user->lang['GUEST']) ? '<a href="' . append_sid("{$phpbb_root_path}memberlist.$phpEx", 'mode=viewprofile&amp;u=' . (int) $tipp_userdata['user_id']) . '"' . $tipper_style . ' onclick="window.open(this.href); return false">' . $tipper_name . '</a>' : $tipper_name;
			$tipper_points 		= $tippdata['0']['tipp_points'];
			$tipp_array 		= explode(',', $tippdata['0']['tipp_result']);
			$is_hidden			= ($race[$race_id]['race_time'] - $formel_config['deadline_offset']  <= $current_time ) ? false : true ;		

			for ($i = 0; $i < count($tipp_array) - 2; ++$i)
			{
				$position 		= ($i == 0) ? $user->lang['FORMEL_RACE_WINNER'] : $i + 1 . '. ' . $user->lang['FORMEL_PLACE'];
				$driver_placed 	= (isset($driver_name[$tipp_array[$i]])) ? $driver_name[$tipp_array[$i]] : '';
				$driverid 		= (isset($tipp_array[$i])) ? $tipp_array[$i] : '';

				//Recalc Tipp Points for Place 1 - 10
				$single_points = 0;
				
				if (isset($results[$i]))
				{
					if (($driverid == $results[$i]) && $driverid <> 0)
					{
						$single_points += $formel_config['points_placed'];
					}
				}
				
				for ($j = 0; $j < count($tipp_array) - 2; ++$j)
				{
					if (isset($results[$j]))
					{
						if (($driverid == $results[$j]) && $driverid <> 0)
						{
							$single_points += $formel_config['points_mentioned'];
						}
					}
				}
				
				if ($single_points == 0) 
				{
					$single_points='';
				}

				$template->assign_block_vars('user_drivers', array(
					'DRIVER_PLACED' 	=> ($is_hidden == true && $tipp_userdata['user_id'] <> $user->data['user_id']) ? $user->lang['FORMEL_HIDDEN'] : $driver_placed,
					'POSITION' 			=> $position,
					'SINGLE_POINTS' 	=> $single_points,
					)
				);
			}

			$fastest_driver_name 	= (isset($driver_name[$tipp_array['10']])) ? $driver_name[$tipp_array['10']] : '';
			$tired 					= (isset($tipp_array['11'])) ? $tipp_array['11'] : '';

			//Recalc tip points for fastest driver and tired count
			$single_fastest = '';
			$single_tired = '';
			
			if (isset($results['10']) && $results['10'] <> 0)
			{
				if ($tipp_array['10'] == $results['10'])
				{
					$single_fastest += $formel_config['points_fastest'];
				}
			}
			
			if (isset($results['11']))
			{
				if ($tipp_array['11'] == $results['11'])
				{
					$single_tired += $formel_config['points_tired'];
				}
			}
			
			$template->assign_block_vars('user_tipp', array(
				'TIPPER' 			=> $tipper_link,
				'POINTS' 			=> $tipper_points,
				'ALL_POINTS' 		=> $tipper_all_points,
				'FASTEST_DRIVER' 	=> (isset($fastest_driver_name)) ? ($is_hidden == true && $tipp_userdata['user_id'] <> $user->data['user_id']) ? $user->lang['FORMEL_HIDDEN'] : $fastest_driver_name : '',
				'TIRED' 			=> (isset($tired)) ? ($is_hidden == true && $tipp_userdata['user_id'] <> $user->data['user_id']) ? $user->lang['FORMEL_HIDDEN'] : $tired : '',
				'SINGLE_FASTEST' 	=> (isset($single_fastest)) ? $single_fastest : '',
				'SINGLE_TIRED' 		=> (isset($single_tired)) ? $single_tired : '',
				)
			);
		}
		else
		{
			$template->assign_block_vars('no_tipp', array());
		}

		// Output global values
		$template->assign_vars(array(
			'S_USERTIPP'		=> true,
			)
		);
		
	break;
		
	case 'stats':

		// Set template vars
		$page_title = $user->lang['FORMEL_TITLE'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats"),
			'FORUM_NAME' 		=> $user->lang['FORMEL_STATS_TITLE'],
			)
		);	
		
		// Check buttons & data
		$show_drivers 	= request_var('show_drivers'	, '');
		$show_teams 	= request_var('show_teams'		, '');
		
		// Show teams toplist
		if ($show_teams) 
		{
			$stat_table_title = $user->lang['FORMEL_TEAM_STATS'];

			// Get all teams
			$teams = get_formel_teams();

			// Get all wm points and fill Top10 teams
			$sql = 'SELECT sum(wm_points) AS total_points, wm_team 
				FROM ' . FORMEL_WM_TABLE . '
				GROUP BY wm_team
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);
			
			//Stop! we have to recalc the team WM points... maybe we have some penalty !
			$recalc_teams = array();
			
			while ($row = $db->sql_fetchrow($result))
			{
				$recalc_teams[$row['wm_team']]['total_points'] 	= $row['total_points'] - $teams[$row['wm_team']]['team_penalty'];
				$recalc_teams[$row['wm_team']]['team_name']		= $teams[$row['wm_team']]['team_name'];
				$recalc_teams[$row['wm_team']]['team_img']		= $teams[$row['wm_team']]['team_img'];
				$recalc_teams[$row['wm_team']]['team_car']		= $teams[$row['wm_team']]['team_car'];
			}
			// re-sort the teams. Big points first ;-)
			arsort($recalc_teams);

			$rank = $real_rank  = 0;
			$previous_points = false;
			
			foreach ($recalc_teams as $team_id => $team) 
			{ 
				++$real_rank;
				
				if ($team['total_points'] <> $previous_points) 
				{ 
					$rank = $real_rank; 
					$previous_points = $team['total_points']; 
				}

				$wm_teamname	= $team['team_name'];
				$wm_teamimg 	= $team['team_img'];
				$wm_teamcar 	= $team['team_car'];
				$wm_points		= $team['total_points'];
				$wm_teamimg 	= ( $wm_teamimg == '' ) ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_team_img'] . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />' : '<img src="' . $phpbb_root_path . 'images/formel/' . $wm_teamimg . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />';
				$wm_teamcar 	= ( $wm_teamcar == '' ) ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_car_img']  . '" alt="" width="' . $formel_config['car_img_width']  . '" height="' . $formel_config['car_img_height']  . '" />' : '<img src="' . $phpbb_root_path . 'images/formel/' . $wm_teamcar . '" alt="" width="' . $formel_config['car_img_width']  . '" height="' . $formel_config['car_img_height']  . '" />';

				if ($formel_config['show_gfx'] == 1)
				{
					$template->assign_block_vars('top_teams_gfx', array(
						'RANK' 			=> $rank,
						'WM_TEAMNAME' 	=> $wm_teamname,
						'WM_TEAMIMG' 	=> $wm_teamimg,
						'WM_TEAMCAR' 	=> $wm_teamcar,
						'WM_POINTS' 	=> $wm_points,
						)
					);
				}
				else 
				{
					$template->assign_block_vars('top_teams', array(
						'RANK' 			=> $rank,
						'WM_TEAMNAME' 	=> $wm_teamname,
						'WM_POINTS' 	=> $wm_points,
						)
					);
				}
			}
			
			$db->sql_freeresult($result);
		}
		// Show drivers toplist
		else if ($show_drivers) 
		{
			$stat_table_title = $user->lang['FORMEL_DRIVER_STATS'];

			// Get all data
			$teams 		= get_formel_teams();
			$drivers 	= get_formel_drivers();

			//Get all first place winner, count all first places,  grep all gold medals...  Marker for first place: 25 WM Points
			$sql = 'SELECT 	count(wm_driver) as gold_medals, 
							wm_driver
					FROM 	' . FORMEL_WM_TABLE . '
					WHERE 	wm_points = 25
					GROUP BY wm_driver
					ORDER BY gold_medals DESC';
			$result = $db->sql_query($sql);
			
			// Now put the gold medals into the $drivers array
			while ($row = $db->sql_fetchrow($result))
			{
				$drivers[$row['wm_driver']]['gold_medals']	= $row['gold_medals'];
			}

			// Get all wm points and fill top10 drivers
			$sql = 'SELECT sum(wm_points) AS total_points, wm_driver, wm_team 
				FROM ' . FORMEL_WM_TABLE . '
				GROUP BY wm_driver
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);

			//Stop! we have to recalc the driver WM points... maybe we have some penalty !
			$recalc_drivers = array();
			
			while ($row = $db->sql_fetchrow($result))
			{
				$recalc_drivers[$row['wm_driver']]['total_points'] 	= $row['total_points'] - $drivers[$row['wm_driver']]['driver_penalty'];
				$recalc_drivers[$row['wm_driver']]['gold_medals']	= (isset($drivers[$row['wm_driver']]['gold_medals'])) ? $drivers[$row['wm_driver']]['gold_medals'] : 0;
				$recalc_drivers[$row['wm_driver']]['driver_name']	= $drivers[$row['wm_driver']]['driver_name'];
				$recalc_drivers[$row['wm_driver']]['driver_img']	= $drivers[$row['wm_driver']]['driver_img'];
				$recalc_drivers[$row['wm_driver']]['driver_car']	= $drivers[$row['wm_driver']]['driver_car'];
				$recalc_drivers[$row['wm_driver']]['team_img']		= $teams[$row['wm_team']]['team_img'];
			}
			
			// re-sort the drivers. Big points first ;-)
			arsort($recalc_drivers);			

			$rank = 0;
			$previous_points = false;
			
			foreach ($recalc_drivers as $driver_id => $driver)  
			{ 
				++$rank;
				
				$wm_drivername 	= $driver['driver_name'];
				$wm_driverimg 	= $driver['driver_img'];
				$wm_drivercar 	= $driver['driver_car'];
				$wm_driverteam 	= $driver['team_img'];
				$wm_driverteam 	= ( $wm_driverteam == '' ) ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_team_img'] . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />' : '<img src="' . $phpbb_root_path . 'images/formel/' . $wm_driverteam . '" alt="" width="' . $formel_config['team_img_width'] . '" height="' . $formel_config['team_img_height'] . '" />';

				if ($formel_config['show_gfx'] == 1)
				{
					$template->assign_block_vars('top_drivers_gfx', array(
						'RANK' 				=> $rank,
						'WM_DRIVERNAME' 	=> $wm_drivername,
						'WM_DRIVERIMG' 		=> $wm_driverimg,
						'WM_DRIVERCAR' 		=> $wm_drivercar,
						'WM_DRIVERTEAM' 	=> $wm_driverteam,
						'WM_POINTS' 		=> $driver['total_points'],
						)
					);
				}
				else 
				{
					$template->assign_block_vars('top_drivers', array(
						'RANK' 				=> $rank,
						'WM_DRIVERNAME' 	=> $wm_drivername,
						'WM_POINTS' 		=> $driver['total_points'],
						)
					);
				}
			}
			
			$db->sql_freeresult($result);
		}
		// Show users toplist
		else 
		{
			$stat_table_title = $user->lang['FORMEL_USER_STATS'];

			// Get all tips and fill top10
			$sql = 'SELECT sum(tipp_points) AS total_points, tipp_user 
				FROM ' . FORMEL_TIPPS_TABLE . '
				GROUP BY tipp_user
				ORDER BY total_points DESC';
			$result = $db->sql_query($sql);

			$rank = $real_rank  = 0;
			$previous_points = false;
			$alt = 'USER_AVATAR';
			
			while ($row = $db->sql_fetchrow($result)) 
			{ 
				++$real_rank;
				
				if ($row['total_points'] <> $previous_points) 
				{ 
					$rank = $real_rank; 
					$previous_points = $row['total_points']; 
				}
				
				$tipp_user_row			= get_formel_userdata($row['tipp_user']);
				$tipp_username_link		= get_username_string('full', $tipp_user_row['user_id'], $tipp_user_row['username'], $tipp_user_row['user_colour'] );
				$tipp_user_avatar 		= '';
				$show_avatar_switch 	= false;
				
				if ($formel_config['show_avatar'] == 1)
				{
					if (!empty($tipp_user_row['user_avatar']))
					{
						switch ($tipp_user_row['user_avatar_type'])
						{
							case AVATAR_UPLOAD:
								$tipp_user_avatar = $phpbb_root_path . "download/file.$phpEx?avatar=";
							break;

							case AVATAR_GALLERY:
								$tipp_user_avatar = $phpbb_root_path . $config['avatar_gallery_path'] . '/';
							break;
						}
						
						$tipp_user_avatar .= $tipp_user_row['user_avatar'];

						$tipp_user_avatar = '<img src="' . $tipp_user_avatar . '" width="' . $tipp_user_row['user_avatar_width'] . '" height="' . $tipp_user_row['user_avatar_height'] . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';
					}
					else
					{
						$tipp_user_avatar = '<img src="' . $phpbb_root_path . 'adm/images/no_avatar.gif" width="' . $config['avatar_max_width'] . '" height="' . $config['avatar_max_height'] . '" alt="' . ((!empty($user->lang[$alt])) ? $user->lang[$alt] : $alt) . '" />';				
					}
					
					$show_avatar_switch 	= true;
				}

				$template->assign_block_vars('top_tippers', array(
					'S_AVATAR_SWITCH'		=> $show_avatar_switch,
					'TIPPER_AVATAR'			=> $tipp_user_avatar,
					'TIPPER_AVATAR_WIDTH'	=> $config['avatar_max_width'] + 10,
					'TIPPER_AVATAR_HEIGHT'	=> $config['avatar_max_height'] + 10,
					'TIPPER_NAME'			=> $tipp_username_link,
					'RANK'					=> ($rank == 1 || $rank == 2 || $rank == 3) ? "<b>" . $rank . "</b>" : $rank,
					'TIPPER_POINTS'			=> $row['total_points'],
					)
				);
			}
			
			$db->sql_freeresult($result);
		}

		// Show headerbanner ?
		if ($formel_config['show_headbanner'])
		{
			$template->assign_block_vars('head_on', array());
		}

		$template->assign_vars(array(
			'S_STATS'				=> true,
			'S_FORM_ACTION' 		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats"),
			'U_FORMEL_STATS' 		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=stats"),
			'HEADER_IMG' 			=> $formel_config['headbanner3_img'],
			'HEADER_URL' 			=> $formel_config['headbanner3_url'],
			'HEADER_HEIGHT' 		=> $formel_config['head_height'],
			'HEADER_WIDTH' 			=> $formel_config['head_width'],
			'L_STAT_TABLE_TITLE' 	=> $stat_table_title,
			'U_FORMEL' 				=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'U_BACK_TO_TIPP' 		=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			)
		);
		
	break;
		
	case 'rules':

		// Set template vars
		$page_title = $user->lang['FORMEL_TITLE'];
		$template_html = 'formel_body.html';

		$template->assign_block_vars('navlinks', array( 
			'U_VIEW_FORUM'		=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=rules"),
			'FORUM_NAME' 		=> $user->lang['FORMEL_RULES_TITLE'],
			)
		);	
		
		// Build rules
		$points_mentioned 	= $formel_config['points_mentioned'];
		$points_placed 		= $formel_config['points_placed'];
		$points_fastest 	= $formel_config['points_fastest'];
		$points_tired 		= $formel_config['points_tired'];

		$point 				= $user->lang['FORMEL_RULES_POINT'];
		$points 			= $user->lang['FORMEL_RULES_POINTS'];

		if ($points_mentioned == '1') 
		{
			$points_mentioned .= ' ' . $point;
		}
		else 
		{
			$points_mentioned .= ' ' . $points;
		}

		if ($points_placed == '1') 
		{
			$points_placed .= ' ' . $point;
		}
		else 
		{
			$points_placed .= ' ' . $points;
		}

		if ($points_fastest == '1') 
		{
			$points_fastest .= ' ' . $point;
		}
		else 
		{
			$points_fastest .= ' ' . $points;
		}

		if ($points_tired == '1') 
		{
			$points_tired .= ' ' . $point;
		}
		else 
		{
			$points_tired .= ' ' . $points;
		}

		$points_total = 10 * ($points_mentioned + $points_placed) + $points_fastest + $points_tired;
		
		if ($points_total == '1') 
		{
			$points_total .= ' ' . $point;
		}
		else 
		{
			$points_total .= ' ' . $points;
		}

		$rules_mentioned 	= sprintf($user->lang['FORMEL_RULES_MENTIONED'] 	, $points_mentioned);
		$rules_placed 		= sprintf($user->lang['FORMEL_RULES_PLACED']		, $points_placed);
		$rules_fastest 		= sprintf($user->lang['FORMEL_RULES_FASTEST'] 		, $points_fastest);
		$rules_tired 		= sprintf($user->lang['FORMEL_RULES_TIRED'] 		, $points_tired);
		$rules_total 		= sprintf($user->lang['FORMEL_RULES_TOTAL'] 		, $points_total);

		// Show headerbanner ?
		if ($formel_config['show_headbanner'])
		{
			$template->assign_block_vars('head_on', array());
		}

		$template->assign_vars(array(
			'S_RULES'					=> true,
			'HEADER_IMG' 				=> $formel_config['headbanner2_img'],
			'HEADER_URL' 				=> $formel_config['headbanner2_url'],
			'HEADER_HEIGHT' 			=> $formel_config['head_height'],
			'HEADER_WIDTH' 				=> $formel_config['head_width'],
			'FORMEL_RULES_MENTIONED' 	=> $rules_mentioned,
			'FORMEL_RULES_PLACED' 		=> $rules_placed,
			'FORMEL_RULES_FASTEST' 		=> $rules_fastest,
			'FORMEL_RULES_TIRED' 		=> $rules_tired,
			'FORMEL_RULES_TOTAL' 		=> $rules_total,
			'U_FORMEL' 					=> append_sid("{$phpbb_root_path}formel.$phpEx"),
			'U_FORMEL_RULES' 			=> append_sid("{$phpbb_root_path}formel.$phpEx?mode=rules"),
			)
		);
		
	break;
		
	default:
		$auth_msg = sprintf($user->lang['FORMEL_ERROR_MODE'], '<a href="' . append_sid("{$phpbb_root_path}formel.$phpEx") . '" class="gen">', '</a>', '<a href="' . append_sid("{$phpbb_root_path}index.$phpEx") . '" class="gen">', '</a>');
		trigger_error($auth_msg);
	break;
}

// Output the page
page_header($page_title);

$template->set_filenames(array(
	'body' => $template_html)
);
page_footer();

?>