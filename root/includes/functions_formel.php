<?php
/** 
*
* @package phpbb3f1webtipp
* $LastChangedDate$
* $LastChangedBy$
* $Id$
* $Revision$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License*
* includes/functions_formel.php
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
* checkarrayforvalue
*
* Checks if a driver is already in the array. (0 is an undefined driver)
* Returns true or false
* If returns true, the tip is invalid.
*/
function checkarrayforvalue($wert,$array)
{
	$ret = false;
	if ($wert <> 0) 
	{
		for ($i = 0; $i < count($array); $i++)
		{
			if ($wert == $array[$i])
			{
				$ret = true;
			}
		}
	}
	return $ret;
}

/**
* formel_del_tip
*
* Delete a users tip
* Deletes a given user tip for a given race
*/
function formel_del_tip($user_id,$race_id)
{
	global $db, $user, $phpEx;

	$sql = 'DELETE 
		FROM ' . FORMEL_TIPPS_TABLE . ' 
		WHERE tipp_user = ' . (int) $user_id . ' 
			AND tipp_race = ' . (int) $race_id;
	$db->sql_query($sql);

	$tipp_msg = sprintf($user->lang['FORMEL_TIPP_DELETED'], '<a href="'.append_sid("{$phpbb_root_path}formel.$phpEx").'" class="gen">', '</a>', '<a href="'.append_sid("{$phpbb_root_path}index.$phpEx").'" class="gen">', '</a>');
	trigger_error( $tipp_msg);
}

/**
* get_formel_config
*
* Get all formel config data
* Returns the formel config in array $config
*/
function get_formel_config()
{
	global $db;

	$config = array();
	$sql = 'SELECT * 
		FROM ' . FORMEL_CONFIG_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		$config[$row['config_name']] = $row['config_value'];
	}
	$db->sql_freeresult($result);

	return $config;
}

/**
* get_formel_races
*
* Get all formel races data
* Returns all races in $races
*/
function get_formel_races()
{
	global $db;

	$races = array();
	$sql = 'SELECT * 
		FROM ' . FORMEL_RACES_TABLE . '
		ORDER BY race_time ASC';
	$result = $db->sql_query($sql);

	$races = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	return $races;
}

/**
* get_formel_teams
*
* Get all formel teams data
* Returns all teams in array $teams
*/
function get_formel_teams()
{
	global $db;

	$teams = array();
	$sql = 'SELECT * 
		FROM ' . FORMEL_TEAMS_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result)) 
	{
		$teams[$row['team_id']] = $row;
	}
	$db->sql_freeresult($result);

	return $teams;
}

/**
* get_formel_drivers
*
* Get all formel drivers data
* Returns all driver with assigned driver, car and team images in array $drivers
*/
function get_formel_drivers()
{
	global $db, $teams, $formel_config;
	global $phpEx, $phpbb_root_path;

	$drivers = array();
	$sql = 'SELECT * 
		FROM ' . FORMEL_DRIVERS_TABLE . '
		ORDER BY driver_id ASC';
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result)) 
	{
		if ($row['driver_team'] <> 0) 
		{
			$drivercar = ($teams[$row['driver_team']]['team_car'] <> '') ? '<img src="' . $phpbb_root_path . 'images/formel/' . $teams[$row['driver_team']]['team_car'] . '" width="' . $formel_config['car_img_width'] . '" height="' . $formel_config['car_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_car_img'] . '" width="' . $formel_config['car_img_width'] . '" height="' . $formel_config['car_img_height'] . '" alt="">';
		}
		else 
		{
			$drivercar = '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_car_img'] . '" width="' . $formel_config['car_img_width'] . '" height="' . $formel_config['car_img_height'] . '" alt="">';
		}
		
		$row['driver_img'] 			= ( $row['driver_img'] == '' ) ? '<img src="' . $phpbb_root_path . 'images/formel/' . $formel_config['no_driver_img'] . '" width="' . $formel_config['driver_img_width'] . '" height="' . $formel_config['driver_img_height'] . '" alt="">' : '<img src="' . $phpbb_root_path . 'images/formel/' . $row['driver_img'] . '" width="' . $formel_config['driver_img_width'] . '" height="' . $formel_config['driver_img_height'] . '" alt="">';
		$row['driver_car'] 			= $drivercar;
		$row['driver_team_name'] 	= $teams[$row['driver_team']]['team_name'];
		$drivers[$row['driver_id']]	= $row;
	}
	$db->sql_freeresult($result);
	return $drivers;
}

/**
* get_formel_drivers_data
*
* Get all formel drivers data for combobox
* Returns all drivers in array $drivers
*/
function get_formel_drivers_data()
{
	global $db, $teams, $formel_config, $user;

	$drivers = array();
	$sql = 'SELECT * 
		FROM ' . FORMEL_DRIVERS_TABLE . '
		ORDER BY driver_name ASC';
	$result = $db->sql_query($sql);

	$counter=1;
	while ($row = $db->sql_fetchrow($result)) 
	{
		$drivers[$counter] = $row;
		$counter++;
	}
	$drivers[0]['driver_id']   = '0';
	$drivers[0]['driver_name'] = $user->lang['FORMEL_DEFINE'];
	$db->sql_freeresult($result);
	return $drivers;
}

/**
* get_formel_auth
*
* Get formel auth status
* Returns TRUE if user_id is in $access_group
*/
function get_formel_auth()
{
	global $db, $formel_config, $user;

	$access_group = $formel_config['restrict_to'];
	$sql = 'SELECT g.group_id 
		FROM ' . GROUPS_TABLE . ' g, ' . USER_GROUP_TABLE . ' ug
		WHERE g.group_id = ug.group_id
			AND ug.user_id = ' . (int) $user->data['user_id'] . '
			AND ug.user_pending <> ' . true . '
			AND g.group_id = ' . (int) $access_group;
	$result = $db->sql_query($sql);

	$check_formel_auth = $db->sql_affectedrows($result);
	$db->sql_freeresult($result);
	if ( $check_formel_auth <> 0 )
	{
		return true;
	}
	return false;
}

/**
* get_formel_userdata
*
* Get username, user_colour from a user_id
* Returns user_id, username, user_colour if user_id was found.
*/
function get_formel_userdata($user_id)
{
	global $db;

	$sql = 'SELECT user_id, username, user_colour, user_avatar, user_avatar_type, user_avatar_width, user_avatar_height
		FROM ' . USERS_TABLE . '
		WHERE user_id = ' . (int) $user_id . ' 
			AND user_id <> ' . ANONYMOUS;
	$result = $db->sql_query($sql);

	return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}
?>
