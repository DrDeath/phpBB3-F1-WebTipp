<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* adm/mods/formel1webtipp_version.php - [Check-File for MOD Version Check by Handyman`]
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package formel1webtipp
*/
class formel1webtipp_version
{
	function version()
	{
		return array(
			'author'	=> 'Dr.Death',
			'title'		=> 'Formel1WebTipp',
			'tag'		=> 'formel1webtipp',
			'version'	=> '1.2013.1',
			'file'		=> array('www.lpi-clan.de', 'updatecheck', 'formel1webtipp.xml'),
		);
	}
}

?>