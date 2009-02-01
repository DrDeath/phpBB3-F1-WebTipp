<?php

/**
*
*  @package phpbb3f1webtipp -  database updater
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @copyright (c) 2008 Formel1WebTipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* install_f1/install.php
*/

define('IN_PHPBB', true);
$phpbb_root_path = '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/acp/auth.' . $phpEx);
include($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->add_lang('mods/formel');

// Only user with founder type can install this mod!
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
	$message = $user->lang['INSTALL_FORMEL_NO_FOUNDER'];
	trigger_error($message);
}

//define some functions

function drop_tables($table_name)
{
	global $db, $table_prefix;

	if ($db->sql_layer != 'mssql')
	{
		$sql = 'DROP TABLE IF EXISTS ' . $table_prefix . $table_name;
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
	}
	else
	{
		$sql = 'if exists (select * from sysobjects where name = ' . $table_prefix . $table_name . ')
		drop table ' . $table_prefix . $table_name;
		$result = $db->sql_query($sql);
		$db->sql_freeresult($result);
	}
}

function remove_acl_option($acl_option)
{
   global $db, $cache;
   
	// get the acl_options_ids to remove them from the roles
	$sql = 'SELECT auth_option_id
			FROM ' . ACL_OPTIONS_TABLE . "
			WHERE auth_option = '$acl_option'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	$option_id = $row['auth_option_id'];
	
	if(!empty($option_id))
	{
		$sql = 'DELETE 
				FROM ' . ACL_ROLES_DATA_TABLE . '
				WHERE auth_option_id = ' . $option_id;
		$result = $db->sql_query($sql);
	}

	// remove old acl_options
	$sql = 'DELETE 
			FROM ' . ACL_OPTIONS_TABLE . " 
			WHERE auth_option = '$acl_option'";
	$db->sql_query($sql);
}

function module_seek_and_destroy($module_basename)
{
   global $db, $cache;
	// remove the old modules
	$sql = 'SELECT * 
			FROM ' . MODULES_TABLE . "
			WHERE module_basename = '$module_basename'";
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$sql = 'SELECT * 
				FROM ' . MODULES_TABLE . ' 
				WHERE module_id = ' . $row['module_id'];
		$result_2 = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result_2);
		
		$sql = 'DELETE 
				FROM ' . MODULES_TABLE . ' 
				WHERE module_id = ' . $row['module_id'];
		$db->sql_query($sql);
		
		//check to see if the module left any orphans (there's no reason why it should, the acp only lets categories have children)
		if ($row['left_id'] + 1 != $row['right_id'])
		{
			//let the grandparent adopt the oprhans since we killed the parent (isn't that a nice image)
			$sql = 'UPDATE ' . MODULES_TABLE . ' 
					SET 	left_id = left_id -1, 
							right_id = right_id - 1, 
							parent_id = ' . $row['parent_id'] . ' 
					WHERE 	module_class = "' . $row['module_class'] . '" 
					AND 	left_id BETWEEN ' . $row['left_id'] . ' 
					AND 	' . $row['right_id'];
			$db->sql_query($sql);
		}

		$sql = 'UPDATE ' . MODULES_TABLE . ' 
				SET 	right_id = right_id - 2 
				WHERE 	module_class = "' . $row['module_class'] . '"
				AND 	right_id > ' . $row['right_id'];
		$db->sql_query($sql);
		
		$sql = 'UPDATE ' . MODULES_TABLE . ' 
				SET 	left_id = left_id - 2 
				WHERE 	module_class = "' . $row['module_class'] . '" 
				AND 	left_id > ' . $row['right_id'];
		$db->sql_query($sql);
		
		//if an empty parent class is left behind, get rid of it too
		while ($parent_id = $row['parent_id'])
		{
			$sql = 'SELECT * 
					FROM ' . MODULES_TABLE . '
					WHERE module_id = ' . $parent_id;
			$result_2 = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result_2);
			
			if ($row['left_id'] + 1 != $row['right_id'] OR $row['module_langname'] == 'ACP_CAT_DOT_MODS')
			{
				break;
			}
			
			$sql = 'DELETE 
					FROM ' . MODULES_TABLE . ' 
					WHERE module_id = ' . $row['module_id'];
			$db->sql_query($sql);
			
			$sql = 'UPDATE ' . MODULES_TABLE . ' 
					SET 	right_id = right_id - 2 
					WHERE 	module_class = "' . $row['module_class'] . '" 
					AND 	right_id > ' . $row['right_id'];
			$db->sql_query($sql);
			
			$sql = 'UPDATE ' . MODULES_TABLE . '
					SET 	left_id = left_id - 2 
					WHERE 	module_class = "' . $row['module_class'] . '" 
					AND 	left_id > ' . $row['right_id'];
			$db->sql_query($sql);
		}
	}
}

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

/**
*
* What sql_layer should we use?
*
**/
switch ($db->sql_layer)
{
	case 'mysql':
		$db_schema = 'mysql_40';
		$delimiter = ';';
	break;

	case 'mysql4':
		if (version_compare($db->sql_server_info(true), '4.1.3', '>='))
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

$mode = request_var('mode', '');

// Switch to the mode...
switch ($mode)
{
	case 'install':
	
			// Drop all previous Formel1WebTip tables
			drop_tables('formel_config');
			drop_tables('formel_drivers');
			drop_tables('formel_teams');
			drop_tables('formel_races');
			drop_tables('formel_tipps');
			drop_tables('formel_wm');
			
			// Remove old permissions from roles and acl_options table
			remove_acl_option('a_formel_races');
			remove_acl_option('a_formel_teams');
			remove_acl_option('a_formel_drivers');
			remove_acl_option('a_formel_settings');
			
			// Remove all existing Formel1WebTip modules
			module_seek_and_destroy('formel');
			
			// Setup $auth_admin class so we can add tabulated survey permission options
			$auth_admin = new auth_admin();

			// Add Formel1WebTip permissions as global permissions
			$auth_admin->acl_add_option(array(
			    'local'        => array(),
			    'global'    => array('a_formel_settings','a_formel_drivers','a_formel_teams','a_formel_races')
			));	
			
			// create the acp modules
			$modules = new acp_modules();
			$acp_formel = array(
				'module_basename'	=> '',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> 31,
				'module_class'		=> 'acp',
				'module_langname'	=> 'ACP_FORMEL_MANAGEMENT',
				'module_mode'		=> '',
				'module_auth'		=> ''
			);
			$modules->update_module_data($acp_formel);
			
			$acp_formel_settings = array(
				'module_basename'	=> 'formel',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $acp_formel['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'ACP_FORMEL_SETTINGS',
				'module_mode'		=> 'settings',
				'module_auth'		=> 'acl_a_formel_settings'
			);
			$modules->update_module_data($acp_formel_settings);
			
			$acp_formel_races = array(
				'module_basename'	=> 'formel',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $acp_formel['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'ACP_FORMEL_RACES',
				'module_mode'		=> 'races',
				'module_auth'		=> 'acl_a_formel_races'
			);
			$modules->update_module_data($acp_formel_races);
			
			$acp_formel_teams = array(
				'module_basename'	=> 'formel',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $acp_formel['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'ACP_FORMEL_TEAMS',
				'module_mode'		=> 'teams',
				'module_auth'		=> 'acl_a_formel_teams'
			);
			$modules->update_module_data($acp_formel_teams);
			
			$acp_formel_drivers = array(
				'module_basename'	=> 'formel',
				'module_enabled'	=> 1,
				'module_display'	=> 1,
				'parent_id'			=> $acp_formel['module_id'],
				'module_class'		=> 'acp',
				'module_langname'	=> 'ACP_FORMEL_DRIVERS',
				'module_mode'		=> 'drivers',
				'module_auth'		=> 'acl_a_formel_drivers'
			);
			$modules->update_module_data($acp_formel_drivers);

			//Now create all Formel1WebTip tables
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
				}
			}
			unset($sql_query);
			
			$cache->purge();
			
			$message = $user->lang['INSTALL_FORMEL_DONE'];
			trigger_error($message);	
	break;
	
	default:
			$message = $user->lang['INSTALL_FORMEL_OPTION_INSTALL'];
			$message = sprintf($message, '<a href="'.append_sid("install.$phpEx?mode=install").'" class="gen">', '</a>', '<a href="'.append_sid( $phpbb_root_path . "index.$phpEx").'" class="gen">', '</a>');
			trigger_error($message);
	break;
}

?>