<?php
/** 
*
* @package phpbb3f1webtipp
* @version $Id: permissions_formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* @copyright (c) 2006 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* language/en/mods/acp_permissions [Permissions English]
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

// Adding new category
$lang['permission_cat']['formel'] = ' F1 ';

// Adding the permissions
$lang = array_merge($lang, array(
'acl_a_formel_settings'	=> array('lang' => 'Can alter Formular 1 settings'	, 'cat' => 'formel'),
'acl_a_formel_drivers'	=> array('lang' => 'Can alter Formular 1 driver'	, 'cat' => 'formel'),
'acl_a_formel_teams'	=> array('lang' => 'Can alter Formular 1 teams'		, 'cat' => 'formel'),
'acl_a_formel_races'	=> array('lang' => 'Can alter Formular 1 races'		, 'cat' => 'formel'),
));

?>
