<?php
/** 
*
* \language\de\mods\info_formel.php - [Language - Formel 1 WebTipp][German]
*
* @package language
* @version $Id: info_acp_formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* DO NOT CHANGE
*/
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
	'ACP_FORMEL_MANAGEMENT'		=> 'Formel 1 WebTipp',
	'ACP_FORMEL_SETTINGS'		=> 'Formel 1 Einstellungen',
	'ACP_FORMEL_DRIVERS'		=> 'Formel 1 Fahrer',	
	'ACP_FORMEL_TEAMS'			=> 'Formel 1 Teams',
	'ACP_FORMEL_RACES'			=> 'Formel 1 Rennen',
));

?>