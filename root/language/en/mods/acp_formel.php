<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/en/mods/acp_formel.php - [Language ACP - English]
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

// BBCodes 
// Note to translators: you can translate everything but what's between { and }

$lang = array_merge($lang, array(
	'ACP_F1_MANAGEMENT'								=> 'Formula 1 WebTip',
	'ACP_F1_SETTINGS'								=> 'Formula 1 Settings',
	'ACP_F1_SETTINGS_EXPLAIN'						=> 'Here you can edit your Formula 1 WebTipps settings',
	'ACP_F1_SETTINGS_CONFIG'						=> 'Formula 1 Configuration',
	'ACP_F1_SETTINGS_MODERATOR'						=> 'WebTip moderator',
	'ACP_F1_SETTINGS_MODERATOR_EXPLAIN'				=> 'It must be a member of a moderator group',
	'ACP_F1_SETTINGS_DEACTIVATED'					=> '*** de-activated ***',
	'ACP_F1_SETTINGS_UPDATED'						=> 'Formula 1 Settings succesfully updated',
	'ACP_F1_SETTINGS_ACCESS_GROUP'					=> 'WebTip Group',
	'ACP_F1_SETTINGS_ACCESS_GROUP_EXPLAIN'			=> 'Here you can give permissions to a group for the WebTipp',
	'ACP_F1_SETTINGS_OFFSET'						=> 'Deadline Offset',
	'ACP_F1_SETTINGS_OFFSET_EXPLAIN'				=> 'Here you can set the Deadline. (Time in Seconds before the Race Start)',
	'ACP_F1_SETTINGS_RACEOFFSET'					=> 'Race delay',
	'ACP_F1_SETTINGS_RACEOFFSET_EXPLAIN'			=> 'Here you can set when the "actual race" changed. (Time in Seconds from Race Start)',
	'ACP_F1_SETTINGS_FORUM'							=> 'Forum',
	'ACP_F1_SETTINGS_FORUM_EXPLAIN'					=> 'Set the forum where you discuss the WebTipp',
	'ACP_F1_SETTINGS_SHOW_PROFILE'					=> 'Display in profile',
	'ACP_F1_SETTINGS_SHOW_PROFILE_EXPLAIN'			=> 'Do you want to display information in users profile?',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN'				=> 'Display Countdown',
	'ACP_F1_SETTINGS_SHOW_COUNTDOWN_EXPLAIN'		=> 'Do you want to display countdown till deadline in WebTipp?',
	'ACP_F1_SETTINGS_POINTS'						=> 'Points',
	'ACP_F1_SETTINGS_POINTS_MENTIONED'				=> 'Mentioned',
	'ACP_F1_SETTINGS_POINTS_MENTIONED_EXPLAIN'		=> 'Points for mention a driver in the Top8',
	'ACP_F1_SETTINGS_POINTS_PLACED'					=> 'Placed',
	'ACP_F1_SETTINGS_POINTS_PLACED_EXPLAIN'			=> 'Points for the drivers correct place',
	'ACP_F1_SETTINGS_POINTS_FASTEST'				=> 'Fastest',
	'ACP_F1_SETTINGS_POINTS_FASTEST_EXPLAIN'		=> 'Points for the fastest lap',
	'ACP_F1_SETTINGS_POINTS_TIRED'					=> 'Tired',
	'ACP_F1_SETTINGS_POINTS_TIRED_EXPLAIN'			=> 'Points for the correct count of tired cars',
	'ACP_F1_SETTINGS_SAFETY_CAR'					=> 'Safety Car',
	'ACP_F1_SETTINGS_SAFETY_CAR_EXPLAIN'			=> 'Points for the correct count of safety car deployment',
	'ACP_F1_SETTINGS_PICS'							=> 'Pics',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER'				=> 'Show banner',
	'ACP_F1_SETTINGS_SHOW_HEADBANNER_EXPLAIN'		=> 'Here you can define whether to show the headbanners or not',
	'ACP_F1_SETTINGS_SHOW_AVATAR'					=> 'Show avatar',
	'ACP_F1_SETTINGS_SHOW_AVATAR_EXPLAIN'			=> 'Here you can define whether to show the avatar on users´s statistics or not',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT'			=> 'Banner hight',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_HEIGHT_EXPLAIN'	=> 'Here you can define the <strong>height in px</strong> for the banner',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH'			=> 'Banner width',
	'ACP_F1_SETTINGS_HEADBANNER_IMG_WIDTH_EXPLAIN'	=> 'Here you can define the <strong>width in px</strong> for the banner',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG'				=> 'Banner Webtipp',
	'ACP_F1_SETTINGS_HEADBANNER1_IMG_EXPLAIN'		=> 'Banner for the WebTipp overview page',
	'ACP_F1_SETTINGS_HEADBANNER1_URL'				=> 'Banner WebTipp URL',
	'ACP_F1_SETTINGS_HEADBANNER1_URL_EXPLAIN'		=> 'URL for the banner on the WebTipp overview page',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG'				=> 'Banner rules',
	'ACP_F1_SETTINGS_HEADBANNER2_IMG_EXPLAIN'		=> 'Banner for the WebTipp rules page',
	'ACP_F1_SETTINGS_HEADBANNER2_URL'				=> 'Banner rules URL',
	'ACP_F1_SETTINGS_HEADBANNER2_URL_EXPLAIN'		=> 'URL for the banner on the WebTipp rules page',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG'				=> 'Banner statistics',
	'ACP_F1_SETTINGS_HEADBANNER3_IMG_EXPLAIN'		=> 'Banner for the WebTipp statistics page',
	'ACP_F1_SETTINGS_HEADBANNER3_URL'				=> 'Banner statistics URL',
	'ACP_F1_SETTINGS_HEADBANNER3_URL_EXPLAIN'		=> 'URL for the banner on the WebTipp statistics page',
	'ACP_F1_SETTINGS_SHOW_GFXR'						=> 'Show race images',
	'ACP_F1_SETTINGS_SHOW_GFXR_EXPLAIN'				=> 'Do you want to display the race images?',
	'ACP_F1_SETTINGS_NO_RACE_IMG'					=> 'Standart race image',
	'ACP_F1_SETTINGS_NO_RACE_IMG_EXPLAIN'			=> 'Here you can define the standard image, for an empty race image entry',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT'				=> 'Race image height',
	'ACP_F1_SETTINGS_RACE_IMG_HEIGHT_EXPLAIN'		=> 'Here you can define the <strong>height in px</strong> for the race image',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH'				=> 'Race image width',
	'ACP_F1_SETTINGS_RACE_IMG_WIDTH_EXPLAIN'		=> 'Here you can define the <strong>width in px</strong> for the race image',
	'ACP_F1_SETTINGS_SHOW_GFX'						=> 'Show extended images',
	'ACP_F1_SETTINGS_SHOW_GFX_EXPLAIN'				=> 'Do you want to display driver, team and car images?',
	'ACP_F1_SETTINGS_NO_CAR_IMG'					=> 'Standard car image',
	'ACP_F1_SETTINGS_NO_CAR_IMG_EXPLAIN'			=> 'Here you can define the standard image, for an empty car image entry',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT'				=> 'Car image height',
	'ACP_F1_SETTINGS_CAR_IMG_HEIGHT_EXPLAIN'		=> 'Here you can define the <strong>height in px</strong> for the car image',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH'					=> 'Car image width',
	'ACP_F1_SETTINGS_CAR_IMG_WIDTH_EXPLAIN'			=> 'Here you can define the <strong>width in px</strong> for the car image', 
	'ACP_F1_SETTINGS_NO_DRIVER_IMG'					=> 'Standard driver image',
	'ACP_F1_SETTINGS_NO_DRIVER_IMG_EXPLAIN'			=> 'Here you can define the standard image, for an empty driver image entry',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT'				=> 'Driver image height',
	'ACP_F1_SETTINGS_DRIVER_IMG_HEIGHT_EXPLAIN'		=> 'Here you can define the <strong>height in px</strong> for the driver image',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH'				=> 'Driver image width',
	'ACP_F1_SETTINGS_DRIVER_IMG_WIDTH_EXPLAIN'		=> 'Here you can define the <strong>width in px</strong> for the driver image',
	'ACP_F1_SETTINGS_NO_TEAM_IMG'					=> 'Standard team image',
	'ACP_F1_SETTINGS_NO_TEAM_IMG_EXPLAIN'			=> 'Here you can define the standard image, for an empty team image entry',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT'				=> 'Team image height',
	'ACP_F1_SETTINGS_TEAM_IMG_HEIGHT_EXPLAIN'		=> 'Here you can define the <strong>height in px</strong> for the team image',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH'				=> 'Team image width',
	'ACP_F1_SETTINGS_TEAM_IMG_WIDTH_EXPLAIN'		=> 'Here you can define the <strong>width in px</strong> for the team image',
	'ACP_F1_SETTINGS_SEASON_RESET'					=> 'Reset season',
	'ACP_F1_SETTINGS_SEASON_RESET_EXPLAIN'			=> '<strong>Attention:</strong> If you click the button, all season data will be lost!<br /><br />After resetting the season, you have to update all race start times.',	
	'ACP_F1_SETTINGS_SEASON_RESETTED'				=> 'Season resettet. Update race start times!',
	'ACP_F1_SETTING_GUEST_VIEWING'					=> 'WebTipp visible for guests',
	'ACP_F1_SETTING_GUEST_VIEWING_EXPLAIN'			=> 'Only possible if permission for a <strong>WebTip Group</strong> is <strong>de-activated</strong>.',
	'ACP_F1_SETTINGS_POINTS_ENABLED'				=> 'Activate Ultimate Point support',
	'ACP_F1_SETTINGS_POINTS_ENABLED_EXPLAIN'		=> 'Here you can define whether to enable giving points for WebTipps or not.<br /><strong>Hint: </strong>Only operational if you have installed the Ultimate Points MOD.',
	'ACP_F1_SETTINGS_POINTS_VALUE'					=> 'Points for given WebTipps',
	'ACP_F1_SETTINGS_POINTS_VALUE_EXPLAIN'			=> 'Here you can define how much <strong>Points</strong> a given WebTipp is worth.',
	
	'ACP_F1_DRIVERS'								=> 'Formula 1 Drivers',
	'ACP_F1_DRIVERS_EXPLAIN'						=> 'Here you can add or edit the drivers',
	'ACP_F1_DRIVERS_ADD'							=> 'Send',
	'ACP_F1_DRIVERS_ADD_DRIVER'						=> 'Add driver',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER'				=> 'Add Formula 1 driver',
	'ACP_F1_DRIVERS_TITEL_ADD_DRIVER_EXPLAIN'		=> 'Here you can add a new driver',
	'ACP_F1_DRIVERS_DRIVERNAME'						=> 'Driver name',
	'ACP_F1_DRIVERS_DRIVERIMAGE'					=> 'Driver image',
	'ACP_F1_DRIVERS_DRIVERTEAM'						=> 'Driver team',
	'ACP_F1_DRIVERS_DRIVERPOINTS'					=> 'Driver points',
	'ACP_F1_DRIVERS_EDIT_DRIVER'					=> 'Edit',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER'				=> 'Edit Formula 1 driver',
	'ACP_F1_DRIVERS_TITEL_EDIT_DRIVER_EXPLAIN'		=> 'Here you can edit a Formula 1 driver',
	'ACP_F1_DRIVERS_DELETE_DRIVER'					=> 'Delete',
	'ACP_F1_DRIVERS_DRIVER_DELETED'					=> 'The driver entry was removed',
	'ACP_F1_DRIVERS_DRIVER_UPDATED'					=> 'Driver data updated',
	'ACP_F1_DRIVERS_ERROR_IMAGE'					=> 'Please give a driver pic',
	'ACP_F1_DRIVERS_ERROR_DRIVERNAME'				=> 'Please give a drivername',
	'ACP_F1_DRIVERS_PENALTY'						=> 'Penalty',
	'ACP_F1_DRIVERS_DISABLED'						=> 'Selectable',

	'ACP_F1_TEAMS'									=> 'Formula 1 Teams',
	'ACP_F1_TEAMS_EXPLAIN'							=> 'Here you can add or edit the teams',
	'ACP_F1_TEAMS_ADD_TEAM'							=> 'New Team',
	'ACP_F1_TEAMS_ADDTEAM_TITLE'					=> 'Add Formula 1 Team',
	'ACP_F1_TEAMS_ADDTEAM_TITLE_EXPLAIN'			=> 'Here you can add a new team',
	'ACP_F1_TEAMS_ADDTEAM_TEAMNAME'					=> 'Team Name',
	'ACP_F1_TEAMS_ADDTEAM_TEAMIMAGE'				=> 'Team Logo',
	'ACP_F1_TEAMS_ADDTEAM_TEAMCAR'					=> 'Team Car',
	'ACP_F1_TEAMS_ADD'								=> 'Send',
	'ACP_F1_TEAMS_EDITTEAM_TITLE'					=> 'Edit Formula 1 Team',
	'ACP_F1_TEAMS_EDITTEAM_TITLE_EXPLAIN'			=> 'Here you can edit a Formular 1 Team',
	'ACP_F1_TEAMS_DRIVERTEAM'						=> 'Team',
	'ACP_F1_TEAMS_DRIVERPOINTS'						=> 'WM Points',
	'ACP_F1_TEAMS_EDIT_TEAM'						=> 'Edit',
	'ACP_F1_TEAMS_DELETE_TEAM'						=> 'Delete',
	'ACP_F1_TEAMS_TEAM_UPDATED'						=> 'Team data saved',
	'ACP_F1_TEAMS_TEAM_DELETED'						=> 'Team deleted',
	'ACP_F1_TEAMS_ERROR_TEAMNAME'					=> 'Please give a Teamname',
	'ACP_F1_TEAMS_PENALTY'							=> 'Penalty',

	'ACP_F1_RACES'									=> 'Formula 1 Races',
	'ACP_F1_RACES_EXPLAIN'							=> 'Here you can add or edit Races',
	'ACP_F1_RACES_ADD_RACE'							=> 'New Race',
	'ACP_F1_RACES_TITEL_ADD_RACE'					=> 'Add Formula 1 Race',	
	'ACP_F1_RACES_TITEL_ADD_RACE_EXPLAIN'			=> 'Here you can add a new Race',	
	'ACP_F1_RACES_RACENAME'							=> 'Location',
	'ACP_F1_RACES_RACEIMAGE'						=> 'Logo',
	'ACP_F1_RACES_RACELENGTH'						=> 'Lap Length',
	'ACP_F1_RACES_RACEDISTANCE'						=> 'Distance',
	'ACP_F1_RACES_RACELAPS'							=> 'Laps',
	'ACP_F1_RACES_RACEDEBUT'						=> 'Debut',
	'ACP_F1_RACES_RACETIME'							=> 'Race start',
	'ACP_F1_RACES_RACEDEAD'							=> 'Deadline',
	'ACP_F1_RACES_EDIT_RACE'						=> 'Edit',
	'ACP_F1_RACES_TITEL_EDIT_RACE'					=> 'Edit Formula 1 Race',	
	'ACP_F1_RACES_TITEL_EDIT_RACE_EXPLAIN'			=> 'Here you can edit a Formular 1 Race',	
	'ACP_F1_RACES_DELETE_RACE'						=> 'Delete',
	'ACP_F1_RACES_ADD'								=> 'Send',
	'ACP_F1_RACES_RACE_UPDATED'						=> 'Race data saved',
	'ACP_F1_RACES_RACE_DELETED'						=> 'Race deleted',
	'ACP_F1_RACES_ERROR_RACENAME'					=> 'Please give a Racename',
));

?>