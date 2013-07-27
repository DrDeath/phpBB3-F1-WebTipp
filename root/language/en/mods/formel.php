<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/en/mods/formel.php - [Language - F1 WebTipp][English]
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'FORMEL_TITLE'					=> 'Formula 1 WebTip',
	'FORMEL_CURRENT_RACE'			=> 'Current race',
	'FORMEL_CURRENT_QUALI'			=> 'Qualification',
	'FORMEL_CURRENT_RESULT'			=> 'Result',
	'FORMEL_NO_QUALI'				=> 'No qualification found',
	'FORMEL_NO_RESULTS'				=> 'No result found',
	'FORMEL_RACENAME'				=> 'Location',
	'FORMEL_RACELENGTH'				=> 'Lap length',
	'FORMEL_RACEDISTANCE'			=> 'Race length',
	'FORMEL_RACELAPS'				=> 'Laps',
	'FORMEL_RACEDEBUT'				=> 'First race',
	'FORMEL_RACETIME'				=> 'Race begins',
	'FORMEL_RACEDEAD'				=> 'Deadline',
	'FORMEL_NEXT_RACE'				=> 'Next',
	'FORMEL_PREV_RACE'				=> 'Previous',
	'FORMEL_PLACE'					=> 'Place',
	'FORMEL_EDIT'					=> 'Edit',
	'FORMEL_RULES'					=> 'Rules',
	'FORMEL_FORUM'					=> 'Formula 1 Forum',
	'FORMEL_STATISTICS'				=> 'Statistics',
	'FORMEL_CALL_MOD'				=> 'Call moderator',
	'FORMEL_POLE'					=> 'Poleposition',
	'FORMEL_RACE_WINNER'			=> 'Winner',
	'FORMEL_DELETE'					=> 'Delete',
	'FORMEL_PACE'					=> 'Fastest lap',
	'FORMEL_TIRED'					=> 'Tired count',
	'FORMEL_SAFETYCAR'				=> 'Safety Car deployments',
	'FORMEL_NO_TIPP'				=> 'No tipp found',
	'FORMEL_YOUR_TIPP'				=> 'Your tip',
	'FORMEL_YOUR_POINTS'			=> 'Your points',
	'FORMEL_GAME_OVER'				=> 'Time is over. No changes possible anymore.',
	'FORMEL_ADD_TIPP'				=> 'Send tipp',
	'FORMEL_DEL_TIPP'				=> 'Delete tipp',
	'FORMEL_EDIT_TIPP'				=> 'Edit tipp',
	'FORMEL_TIPP_DELETED'			=> 'Tipp was removed<br /><br />Click %shere%s to go back to the tipps overview<br /><br />Click %shere%s to go to forum',
	'FORMEL_DUBLICATE_VALUES'		=> 'Error while sending your tipp: You placed a driver twice<br /><br />Click %shere%s to go back to the overview<br /><br />Click %shere%s to go back to forum',
	'FORMEL_ACCEPTED_TIPP'			=> 'You tipp was accepted<br /><br />Click %shere%s to place more tipps<br /><br />Click %shere%s to go back to forum',
	'FORMEL_RESULTS_TITLE'			=> 'WebTipp moderation',
	'FORMEL_RESULTS_TITLE_EXP'		=> 'Here you can add or edit every events results',
	'FORMEL_MOD_BUTTON_TEXT'		=> 'Moderation',
	'FORMEL_RESULTS_DELETED'		=> 'Results deleted<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to WebTipp',
	'FORMEL_RESULTS_ERROR'			=> 'Error while saving. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to WebTipp',
	'FORMEL_RESULTS_DOUBLE'			=> 'You placed a driver twice. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to WebTipp',
	'FORMEL_RESULTS_ACCEPTED'		=> 'Results saved<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to WebTipp',
	'FORMEL_RESULTS_ADD'			=> 'Add',
	'FORMEL_RESULTS_QUALI_TITLE'	=> 'Add qualification',
	'FORMEL_RESULTS_RESULT_TITLE'	=> 'Edit race results',
	'FORMEL_TOP_POINTS'				=> 'Points',
	'FORMEL_TOP_NAME'				=> 'Top players',
	'FORMEL_TOP_DRIVER'				=> 'Top drivers',
	'FORMEL_TOP_TEAMS'				=> 'Top teams',
	'FORMEL_NO_TIPPS'				=> 'No tipps made',
	'FORMEL_TIPPS_MADE'				=> 'Placed tipps: ',
	'FORMEL_BACK_TO_TIPP'			=> 'Back to tipp',
	'FORMEL_USER_STATS'				=> 'User',
	'FORMEL_DRIVER_STATS'			=> 'Driver',
	'FORMEL_TEAM_STATS'				=> 'Teams',
	'FORMEL_TOP_MORE'				=> 'Show all',
	'FORMEL_STATS_TITLE'			=> 'Formula 1 statistics',
	'FORMEL_POINTS_WON'				=> 'Points',
	'FORMEL_ALL_POINTS'				=> 'Total points',
	'FORMEL_RULES_TITLE'			=> 'Rules',
	'FORMEL_RULES_GENERAL'			=> 'General',
	'FORMEL_PROFILE_WEBTIPP'		=> 'Formula 1 points',
	'FORMEL_PROFILE_RANK'			=> '%s. Place',
	'FORMEL_PROFILE_NORANK'			=> 'No ranking',
	'FORMEL_PROFILE_TIPSS'			=> '%s of %s races tipped',
	'FORMEL_RULES_GENERAL_EXP'		=> 'Here you can show other community members whos really owns the Formula 1.<br /><br />For every race you can place a tipp and collect points. If you are away for a long time, you can now enter your tipps for as many races as you want and change it whenever you want. To see the current ranking just visit the statistics page. If you want to know what the other tippers tipped, just click on their usernames on the overview page ( Tipps are only shown if the deadline was reached )',
	'FORMEL_RULES_SCORE'			=> 'Points',
	'FORMEL_RULES_SCORE_EXP'		=> 'You can place your tipp for the first 10 drivers, such as the fastest lap, the count of tired drivers and the count of safety car deployments.',
	'FORMEL_RULES_MENTIONED'		=> 'For mention a Top 10 driver you can get <strong>%s</strong>.',
	'FORMEL_RULES_PLACED'			=> 'For placing the exact drivers result you can get <strong>%s</strong>.',
	'FORMEL_RULES_FASTEST'			=> 'If you got the fastest driver, you can get <strong>%s</strong>.',
	'FORMEL_RULES_TIRED'			=> 'For the right tired count you can get <strong>%s</strong>.',
	'FORMEL_RULES_SAFETYCAR'		=> 'For the right count of safety car deployments you can get <strong>%s</strong>.',
	'FORMEL_RULES_TOTAL'			=> 'In total you can get <strong>%s</strong>.',
	'FORMEL_RULES_POINT'			=> 'Point',
	'FORMEL_RULES_POINTS'			=> 'Points',
	'FORMEL_DEFINE'					=> 'Not placed',
	'FORMEL_ACCESS_DENIED'			=> 'Access denied. You have to be a certain group member to join this tipp.<br /><br />Click %shere%s to ask for membership<br />Click %shere%s to go back to forum',
	'FORMEL_MOD_ACCESS_DENIED'		=> 'Access denied. You have to be a moderator or administrator to access the moderation panel.<br /><br />Click %shere%s to go back to Formular 1 Webtipp.<br />Click %shere%s to go back to forum',
	'FORMEL_ERROR_MODE' 			=> 'Error ! Unknown Mode !<br /><br />Click %shere%s to go back to Formular 1 Webtipp.<br />Click %shere%s to go back to forum',
	'FORMEL_CLOSE_WINDOW'			=> 'Close window',
	'FORMEL_HIDDEN'					=> 'Hidden till deadline',
	'FORMEL_COUNTDOWN_DEADLINE'		=> 'Countdown till deadline',
	'FORMEL_DEADLINE_REACHED'		=> 'Deadline reached',

	'INSERT_F1_FIRST_FILL'			=> 'Insert rows into the tables formel_config, formel_drivers, formel_teams and formel_races.',
	'INSERT_F1_CONFIG'				=> 'Insert rows into the tables formel_config.',
	'FORMEL_GUESTS_PLACE_NO_TIP'	=> '<strong>Guests cannot place a tip.</strong><br /><br />In order to place a tip you have to be registered and logged in.<br />',
	'FORMEL_RACE_ABORD'				=> 'Race aborted (half points!)',

	'VIEWING_F1WEBTIPP'				=> 'Viewing Formel 1 WebTipp',

	'FORMEL_MAIL_ADMIN'				=> 'Formula 1 WebTip - Sent reminder mails for race in %1$s',
	'FORMEL_MAIL_ADMIN_MESSAGE'		=> 'Mail was sent to following users: %1$s',
	'FORMEL_LOG'					=> 'Formula 1 WebTip - Reminder mail sent to: %1$s',
	'FORMEL_LOG_ERROR'				=> '<strong>Formula 1 WebTip - Reminder mail to %1$s was not successful.</strong>',
));

?>