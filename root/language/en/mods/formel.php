<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/en/mods/formel.php - [Language - English]
*
*/

/**
* DO NOT CHANGE
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
	'FORMEL_RESULTS_DELETED'		=> 'Results deleted<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'FORMEL_RESULTS_ERROR'			=> 'Error while saving. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'FORMEL_RESULTS_DOUBLE'			=> 'You placed a driver twice. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'FORMEL_RESULTS_ACCEPTED'		=> 'Results saved<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
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
	'formel_driver_stats'			=> 'Driver',
	'formel_team_stats'				=> 'Teams',
	'formel_top_more'				=> 'Show all',
	'formel_stats_title'			=> 'Formula 1 statistics',
	'formel_points_won'				=> 'Points',
	'formel_all_points'				=> 'Total points',
	'formel_watching_tipp'			=> 'Tipper',
	'formel_rules_title'			=> "Rules",
	'formel_rules_general'			=> "General",
	'formel_profile_title'			=> 'Formula 1 points',
	'formel_profile_rank'			=> '%s. Place',
	'formel_profile_norank'			=> 'No ranking',
	'formel_profile_tipps'			=> '%s of %s races tipped',
	'formel_rules_gen_exp'			=> "Here you can show other community members whos really owns the Formula 1.<br /><br />For every race you can place a tipp and collect points. If you are away for a long time, you can now enter your tipps for as many races as you want and change it whenever you want. To see the current ranking just visit the statistics page. If you want to know what the other tippers tipped, just click on their usernames on the overview page ( Tipps are only shown if the deadline was reached )",
	'formel_rules_score'			=> "Points",
	'formel_rules_points_exp'		=> "You can place your tipp for the first 8 drivers, such as the fastest lap, such as the count of tired drivers.",
	'formel_rules_mentioned'		=> "For mention a Top8 driver you can get <strong>%s</strong>.",
	'formel_rules_placed'			=> "For placing the exact drivers result you can get <strong>%s</strong>.",
	'formel_rules_fastest'			=> "If you got the fastest driver, you can get <strong>%s</strong>.",
	'formel_rules_tired'			=> "For the right tired count you can get <strong>%s</strong>.",
	'formel_rules_total'			=> "In total you can get <strong>%s</strong>.",
	'formel_rules_point'			=> "Point",
	'formel_rules_points'			=> "Points",
	'formel_define'					=> 'Not placed',
	'formel_access_denied'			=> 'Access denied. You have to be a certain group member to join this tipp.<br /><br />Click %shere%s to ask for membership<br />Click %shere%s to go back to forum',
	'formel_mod_access_denied'		=> 'Access denied. You have to be a moderator or administrator to access the moderation panel.<br /><br />Click %shere%s to go back to Formular 1 Webtipp.<br />Click %shere%s to go back to forum',
	'formel_error_mode' 			=> 'Error ! Unknown Mode !<br /><br />Click %shere%s to go back to Formular 1 Webtipp.<br />Click %shere%s to go back to forum',
	'formel_close_window'			=> 'Close window',
	'formel_hidden'					=> 'Hidden till deadline',
	'formel_countdown_deadline'		=> 'Countdown till deadline',
	'formel_deadline_reached'		=> 'Deadline reached',
));

?>