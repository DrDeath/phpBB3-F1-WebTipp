<?php
/** 
*
* @package phpbb3f1webtipp
* @version $Id: acp_formel.php 1 2007-07-30 13:25:14Z stoffel04 $
* @copyright (c) 2006 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
* includes/acp/info/acp_formel.php
*
*/

/*
 * @ignore 
*/ 
if (!defined('IN_PHPBB')) 
{ 
	exit; 
}

/**
* @package phpbb3f1webtipp
*/
class acp_formel_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_formel',
			'title'		=> 'ACP_FORMEL_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'		=> array('title' => 'ACP_FORMEL_SETTINGS',	'auth' => 'acl_a_formel_settings',	'cat' => array('ACP_FORMEL_MANAGEMENT')),
				'drivers'		=> array('title' => 'ACP_FORMEL_DRIVERS',	'auth' => 'acl_a_formel_drivers',	'cat' => array('ACP_FORMEL_MANAGEMENT')),
				'teams'			=> array('title' => 'ACP_FORMEL_TEAMS',		'auth' => 'acl_a_formel_teams',		'cat' => array('ACP_FORMEL_MANAGEMENT')),
				'races'			=> array('title' => 'ACP_FORMEL_RACES',		'auth' => 'acl_a_formel_races',		'cat' => array('ACP_FORMEL_MANAGEMENT')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}
?>