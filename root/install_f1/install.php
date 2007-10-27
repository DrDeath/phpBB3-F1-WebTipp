<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License*
* install_f1/install.php [ Installer File]
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!$user->data['is_registered'])
{
    if ($user->data['is_bot'])
    {
        redirect(append_sid("{$phpbb_root_path}index.$phpEx"));
    }
    login_box('', $user->lang['LOGIN_INFO']);
}
else if ($user->data['user_type'] != USER_FOUNDER)
{
	$message = "<span style=\"color:red;\">You must be logged in as a founder to run this script.</span><br />
				<span style=\"color:red;\">Du musst Gründer Rechte besitzen um dieses Script ausführen zu können.</span><br />
				";
	trigger_error($message);
}

$submit = request_var('install', '');

/**
* split_sql_file will split an uploaded sql file into single sql statements.
* Note: expects trim() to have already been run on $sql.
*/
function split_sql_file($sql, $delimiter)
{
	$sql = str_replace("\r" , '', $sql);
	$data = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);

	$data = array_map('trim', $data);

	// The empty case
	$end_data = end($data);

	if (empty($end_data))
	{
		unset($data[key($data)]);
	}

	return $data;
}

if ($submit == 'continue') 
{
	// What sql_layer should we use?
	switch ($db->sql_layer)
	{
		case 'mysql':
			$db_schema = 'mysql_40';
			$delimiter = ';';
		break;

		case 'mysql4':
			if (version_compare($db->mysql_version, '4.1.3', '>='))
			{
				$db_schema = 'mysql_41';
			}
			else
			{
				$db_schema = 'mysql_40';
			}
			$delimiter = ';';
		break;

		case 'mysqli':
			$db_schema = 'mysql_41';
			$delimiter = ';';
		break;

		case 'mssql':
			$db_schema = 'mssql';
			$delimiter = 'GO';
		break;
		
		case 'postgres':
			$db_schema = 'postgres';
			$delimiter = ';';
		break;
		
		case 'sqlite':
			$db_schema = 'sqlite';
			$delimiter = ';';
		break;
		
		case 'firebird':
			$db_schema = 'firebird';
			$delimiter = ';;';
		break;
		
		case 'oracle':
			$db_schema = 'oracle';
			$delimiter = '/';
		break;

		default:
			trigger_error('Sorry, unsupportet Databases found.');
		break;
	}
	
	//Delete old permission set if exists from prior f1webtipp mod installations
	$sql = 'DELETE FROM '.$table_prefix."acl_options WHERE auth_option = 'a_formel_teams'";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	$sql = 'DELETE FROM '.$table_prefix."acl_options WHERE auth_option = 'a_formel_drivers'";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	$sql = 'DELETE FROM '.$table_prefix."acl_options WHERE auth_option = 'a_formel_settings'";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	$sql = 'DELETE FROM '.$table_prefix."acl_options WHERE auth_option = 'a_formel_races'";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	//Destroy the old permission chache
	$cache->purge();

	// Drop the formel_config table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_config';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Drop the formel_drivers table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_drivers';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Drop the formel_teams table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_teams';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Drop the formel_races table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_races';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Drop the formel_wm table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_wm';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Drop the formel_tipps table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_tipps';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	
	// locate the schema files
	$dbms_schema = 'schemas/_' . $db_schema . '_schema.sql';
	
	// Get the schema file
	$sql_query = @file_get_contents($dbms_schema);
	
	// Replace the default prefix phpbb_ to the actual used prefix
	$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
	
	// Remove all remarks ( # )
	$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
	
	// Splitt all SQL Statements into an array
	$sql_query = split_sql_file($sql_query, $delimiter);

	// Create all needed tables now
	foreach ($sql_query as $sql)
	{
		//$sql = trim(str_replace('|', ';', $sql));
		if (!$db->sql_query($sql))
		{
			$error = $db->sql_error();
			$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
		}
	}
	unset($sql_query);

	// Ok tables have been built, let's fill in the basic information
	$sql_query = file_get_contents('schemas/_schema_data.sql');
	
	// Deal with any special comments
	switch ($db->sql_layer)
	{
		case 'mssql':
		case 'mssql_odbc':
			$sql_query = preg_replace('#\# MSSQL IDENTITY (phpbb_[a-z_]+) (ON|OFF) \##s', 'SET IDENTITY_INSERT \1 \2;', $sql_query);
		break;

		case 'postgres':
			$sql_query = preg_replace('#\# POSTGRES (BEGIN|COMMIT) \##s', '\1; ', $sql_query);
		break;
	}
	
	// Change prefix
	$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);

	// Remove all remarks ( # )
	$sql_query = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql_query));
	
	// Splitt all SQL Statements into an array
	$sql_query = split_sql_file($sql_query, ';');
	
	// Tadaa! Fill all data in ;-)
	foreach ($sql_query as $sql)
	{
		//$sql = trim(str_replace('|', ';', $sql));
		if (!$db->sql_query($sql))
		{
			$error = $db->sql_error();
			$this->p_master->db_error($error['message'], $sql, __LINE__, __FILE__);
		}
	}
	unset($sql_query);
	
	//Destroy the old permission chache again to enable the new set :-)
	$cache->purge();

	$message = '<span style="color:green; font-weight: bold;font-size: 1.5em;">Formula 1 WebTip database successfully installed.</span><br />
				To finish installing this mod, edit all files according to the install.xml, then open templates/prosilver.xml and follow those instructions.<br />
				When you are finished, go to the ACP and purge the cache.<br />
				<br />
				<span style="color:green; font-weight: bold;font-size: 1.5em;">Formel 1 WebTipp Datenbank erfolgreich installiert.</span><br />
				Um die Installation abzuschliessen befolge alle Anweisungen in der Install.xml, danach die templates/prosilver.xml und language/de.xml .<br />
				Wenn Du damit fertig bist, gehe in das ACP und leere den Cache.';
	trigger_error($message);
} 
else 
{
	$message = '<span style="color:green; font-weight: bold;font-size: 1.5em;">Formel 1 WebTipp MOD v0.1.25 (beta)</span><br />
				<br />
				English:<br />
				Script for automated Formula 1 WebTip table generation.<br />
				<br />
				<span style="color:red; font-weight: bold;">This procedure will erase all settings, drivers, teams, races and usertipps of any previous Formel 1 WebTipp installations!</span><br />
				Are you sure you want to continue? If so, then click on "Continue / Weiter"<br />
				<br />
				<br />
				German:<br />
				Script für die automatische Formel 1 WebTipp Tabellen Erstellung.<br />
				<br />
				<span style="color:red; font-weight: bold;">Diese Script wird alle F1 WebTipp Einstellungen, Fahrer, Team, Rennen und abgegebene Benutzer Tipps von vorherigen Installationen löschen!</span><br />
				Bist Du Dir absolut sicher ? Dann klicke auf "Continue / Weiter"<br />
				<br />
				';
	$message .= '%sContinue / Weiter%s ----- %sCancel / Abbrechen%s';
	$message  = sprintf($message, '<a href="'.append_sid("install.$phpEx?install=continue").'" class="gen">', '</a>', '<a href="'.append_sid( $phpbb_root_path . "index.$phpEx").'" class="gen">', '</a>');
	
	trigger_error( $message);
}
?>
</body>
</html>