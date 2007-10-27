<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/de/mods/info_acp_formel.php - [Language ACP - Deutsch]
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
	'ACP_FORMEL_MANAGEMENT'			=> 'Formel 1 WebTipp',
	'ACP_FORMEL_SETTINGS'			=> 'Formel 1 Einstellungen',
	'ACP_FORMEL_DRIVERS'			=> 'Formel 1 Fahrer',	
	'ACP_FORMEL_TEAMS'				=> 'Formel 1 Teams',
	'ACP_FORMEL_RACES'				=> 'Formel 1 Rennen',
	'LOG_FORMEL_TIP_GIVEN'			=> 'F1 WebTipp für Renn-ID %s abgegeben',
	'LOG_FORMEL_TIP_EDITED'			=> 'F1 WebTipp für Renn-ID %s bearbeitet',
	'LOG_FORMEL_TIP_NOT_VALID'		=> 'F1 WebTipp für Renn-ID %s ungültig. Tipp wurde abgewiesen',
	'LOG_FORMEL_TIP_DELETED'		=> 'F1 WebTipp für Renn-ID %s gelöscht',
	'LOG_FORMEL_QUALI_DELETED'		=> 'F1 WebTipp Qualifyingergebnis für Renn-ID %s gelöscht',
	'LOG_FORMEL_QUALI_ADDED'		=> 'F1 WebTipp Qualifyingergebnis für Renn-ID %s eingetragen',
	'LOG_FORMEL_QUALI_NOT_VALID'	=> 'F1 WebTipp Qualifyingergebnis für Renn-ID %s ungültig. Eintragung wurde abgewiesen',
	'LOG_FORMEL_RESULT_DELETED'		=> 'F1 WebTipp Rennergebnis für Renn-ID %s gelöscht',
	'LOG_FORMEL_RESULT_ADDED'		=> 'F1 WebTipp Rennergebnis für Renn-ID %s eingetragen',
	'LOG_FORMEL_RESULT_NOT_VALID'	=> 'F1 WebTipp Rennergebnis für Renn-ID %s ungültig. Eintragung wurde abgewiesen',
	'LOG_FORMEL_SETTINGS'			=> 'F1 WebTipp Einstellungen aktualisiert',
	'LOG_FORMEL_RACE_ADDED'			=> 'F1 WebTipp Rennen hinzugefügt',
	'LOG_FORMEL_RACE_EDITED'		=> 'F1 WebTipp Renn-ID %s bearbeitet',
	'LOG_FORMEL_RACE_DELETED'		=> 'F1 WebTipp Renn-ID %s gelöscht',
	'LOG_FORMEL_TEAM_ADDED'			=> 'F1 WebTipp Team hinzugefügt',
	'LOG_FORMEL_TEAM_EDITED'		=> 'F1 WebTipp Team-ID %s bearbeitet',
	'LOG_FORMEL_TEAM_DELETED'		=> 'F1 WebTipp Team-ID %s gelöscht',
	'LOG_FORMEL_DRIVER_ADDED'		=> 'F1 WebTipp Fahrer hinzugefügt',
	'LOG_FORMEL_DRIVER_EDITED'		=> 'F1 WebTipp Fahrer-ID %s bearbeitet',
	'LOG_FORMEL_DRIVER_DELETED'		=> 'F1 WebTipp Fahrer-ID %s gelöscht',
));

?>