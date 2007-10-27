<?php
/** 
* 
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* language/de/mods/permissions_formel.php - [Language ACP - Deutsch]
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

// Adding new category
$lang['permission_cat']['formel'] = ' F1 ';

// Adding the permissions
$lang = array_merge($lang, array(
	'acl_a_formel_settings'		=> array('lang' => 'Kann Formel 1 Einstellungen verwalten'	, 'cat' => 'formel'),
	'acl_a_formel_drivers'		=> array('lang' => 'Kann Formel 1 Fahrer verwalten'			, 'cat' => 'formel'),
	'acl_a_formel_teams'		=> array('lang' => 'Kann Formel 1 Teams verwalten'			, 'cat' => 'formel'),
	'acl_a_formel_races'		=> array('lang' => 'Kann Formel 1 Rennen verwalten'			, 'cat' => 'formel'),
));

?>
