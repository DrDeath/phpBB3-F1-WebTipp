<?php
/** 
*
* \language\fr\mods\info_acp_formel.php - [Language - Formel 1 WebTipp][French]
*
* @package language
* @version $Id: info_acp_formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
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

// Formel 1 Modul
$lang = array_merge($lang, array(
	'ACP_FORMEL_MANAGEMENT'		=> 'Formel 1 WebTip',
	'ACP_FORMEL_SETTINGS'		=> 'Formel 1 Configurations',
	'ACP_FORMEL_DRIVERS'		=> 'Formel 1 Pilotes',	
	'ACP_FORMEL_TEAMS'			=> 'Formel 1 Ecuries',
	'ACP_FORMEL_RACES'			=> 'Formel 1 Courses',
	'LOG_FORMEL_TIP_GIVEN'			=> 'Formula 1 webtip for race %s added.',
	'LOG_FORMEL_TIP_EDITED'			=> 'Formula 1 webtip for race %s edited.',
	'LOG_FORMEL_TIP_NOT_VALID'		=> 'Formula 1 webtip for race %s not valid. Tip rejected.',
	'LOG_FORMEL_TIP_DELETED'		=> 'Formula 1 webtip for race %s deleted.',
	'LOG_FORMEL_QUALI_DELETED'		=> 'Formula 1 qualifying result for race id %s deleted.',
	'LOG_FORMEL_QUALI_ADDED'		=> 'Formula 1 qualifying result for race id %s added.',
	'LOG_FORMEL_QUALI_NOT_VALID'	=> 'Formula 1 qualifying result for race id %s not valid. Entry rejected.',
	'LOG_FORMEL_RESULT_DELETED'		=> 'Formula 1 race result for race id %s deleted.',
	'LOG_FORMEL_RESULT_ADDED'		=> 'Formula 1 race result for race id %s added.',
	'LOG_FORMEL_RESULT_NOT_VALID'	=> 'Formula 1 race result for race id %s not valid. Entry rejected.',
	'LOG_FORMEL_SETTINGS'			=> 'Formula 1 settings updated.',
	'LOG_FORMEL_RACE_ADDED'			=> 'Formula 1 race added.',
	'LOG_FORMEL_RACE_EDITED'		=> 'Formula 1 race ID %s edited.',
	'LOG_FORMEL_RACE_DELETED'		=> 'Formula 1 race ID %s deleted',
	'LOG_FORMEL_TEAM_ADDED'			=> 'Formula 1 team added.',
	'LOG_FORMEL_TEAM_EDITED'		=> 'Formula 1 team ID %s edited.',
	'LOG_FORMEL_TEAM_DELETED'		=> 'Formula 1 team ID %s deleted.',
	'LOG_FORMEL_DRIVER_ADDED'		=> 'Formula 1 driver added.',
	'LOG_FORMEL_DRIVER_EDITED'		=> 'Formula 1 driver ID %s edited.',
	'LOG_FORMEL_DRIVER_DELETED'		=> 'Formula 1 driver ID %s deleted.',
));

?>