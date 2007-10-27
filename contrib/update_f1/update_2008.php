<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* contrib/update_f1/update_2008.php - [Updater for saison 2008]
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

$submit = request_var('update', '');

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
	

	// Cleanup the formel_drivers table
	$sql = 'TRUNCATE TABLE '.$table_prefix.'formel_drivers';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Cleanup the formel_teams table
	$sql = 'TRUNCATE TABLE '.$table_prefix.'formel_teams';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Cleanup the formel_races table
	$sql = 'TRUNCATE TABLE '.$table_prefix.'formel_races';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Ok tables are now clean. let's fill in the basic information
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
	

	$message = '<span style="color:green; font-weight: bold;font-size: 1.5em;">Formula 1 WebTip database successfully updated.</span><br />
				Don\'t forget to reset the old saison in ACP!.<br />
				<br />
				<span style="color:green; font-weight: bold;font-size: 1.5em;">Formel 1 WebTipp Datenbank erfolgreich aktualisiert.</span><br />
				Vergiss nicht die Saison im ACP zu resetten!';
	trigger_error($message);
} 
else 
{
	$message = '<span style="color:green; font-weight: bold;font-size: 1.5em;">Update F1 WebTipp Saison 2008 </span><br />
				<br />
				English:<br />
				Script for automated update of Formular 1 Webtip saison 2008.<br />
				<br />
				<span style="color:red; font-weight: bold;">This procedure will update all races, drivers and teams of any previous Formel 1 WebTipp installations!<br />All previous assigned images will be lost!</span><br />
				Are you sure you want to continue? If so, then click on "Continue / Weiter"<br />
				<br />
				<br />
				German:<br />
				Script für automatisches Update der Formel 1 Saison 2008 .<br />
				<br />
				<span style="color:red; font-weight: bold;">Diese Script wird alle F1 WebTipp Rennen, Fahrer und Teams von vorherigen Installationen aktualisieren!<br/>Alle vorher zugewiesenen Bilder gehen dabei verloren!</span><br />
				Bist Du Dir absolut sicher ? Dann klicke auf "Continue / Weiter"<br />
				<br />
				';
	$message .= '%sContinue / Weiter%s ----- %sCancel / Abbrechen%s';
	$message  = sprintf($message, '<a href="'.append_sid("update_2008.$phpEx?update=continue").'" class="gen">', '</a>', '<a href="'.append_sid( $phpbb_root_path . "index.$phpEx").'" class="gen">', '</a>');
	
	trigger_error( $message);
}
?>
</body>
</html>