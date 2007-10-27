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
	'formel_title'					=> 'Formula 1 WebTip',
	'formel_headerlink'				=> 'F1-WebTip',
	'formel_current_race'			=> 'Current race',
	'formel_current_quali'			=> 'Qualification',
	'formel_current_result'			=> 'Result',
	'formel_no_quali'				=> 'No qualification found',
	'formel_no_result'				=> 'No result found',
	'formel_racename'				=> 'Location',
	'formel_racelength'				=> 'Lap length',
	'formel_racedistance'			=> 'Race length',
	'formel_racelaps'				=> 'Laps',
	'formel_racedebut'				=> 'First race',
	'formel_racetime'				=> 'Race begins',
	'formel_racedead'				=> 'Deadline',
	'formel_next_race'				=> 'Next',
	'formel_prev_race'				=> 'Previous',
	'formel_place'					=> 'Place',
	'formel_edit'					=> 'Edit',
	'formel_rules'					=> 'Rules',
	'formel_forum'					=> 'Formula 1 Forum',
	'formel_statistics'				=> 'Statistics',
	'formel_call_mod'				=> 'Call moderator',
	'formel_pole'					=> 'Poleposition',
	'formel_race_winner'			=> 'Winner',
	'formel_delete'					=> 'Delete',
	'formel_pace'					=> 'Fastest lap',
	'formel_tired'					=> 'Tired count',
	'formel_tipp_not_found'			=> 'No tipp found',
	'formel_your_tipp'				=> 'Your tipp',
	'formel_your_points'			=> 'Your points',
	'formel_game_over'				=> 'Time is over. No changes possible anymore.',
	'formel_add_tipp'				=> 'Send tipp',
	'formel_del_tipp'				=> 'Delete tipp',
	'formel_edit_tipp'				=> 'Edit tipp',
	'formel_tipp_deleted'			=> 'Tipp was removed<br /><br />Click %shere%s to go back to the tipps overview<br /><br />Click %shere%s to go to forum',
	'formel_doublicate_values'		=> 'Error while sending your tipp: You placed a driver twice<br /><br />Click %shere%s to go back to the overview<br /><br />Click %shere%s to go back to forum',
	'formel_accepted_tipp'			=> 'You tipp was accepted<br /><br />Click %shere%s to place more tipps<br /><br />Click %shere%s to go back to forum',
	'formel_results_title'			=> 'WebTipp moderation',
	'formel_results_title_exp'		=> 'Here you can add or edit every events results',
	'formel_results_reset'			=> 'Delete qualification/result',
	'formel_mod_button_text'		=> 'Moderation',
	'formel_results_deleted'		=> 'Results deleted<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'formel_results_error'			=> 'Error while saving. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'formel_results_double'			=> 'You placed a driver twice. Please try again<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'formel_results_accepted'		=> 'Results saved<br /><br />Click %shere%s to go back to WebTipp moderation<br /><br />Click %shere%s to go back to forum',
	'formel_results_add'			=> 'Add',
	'formel_results_reset'			=> 'Reset',
	'formel_results_qualititle'		=> 'Add qualification',
	'formel_results_resulttitle'	=> 'Edit race results',
	'formel_top_points'				=> 'Points',
	'formel_top_name'				=> 'Top players',
	'formel_top_driver'				=> 'Top drivers',
	'formel_top_teams'				=> 'Top teams',
	'formel_no_players'				=> 'No tipps made',
	'formel_tipps_made'				=> 'Placed tipps: ',
	'formel_back_to_tipp'			=> 'Back to tipp',
	'formel_user_stats'				=> 'User',
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