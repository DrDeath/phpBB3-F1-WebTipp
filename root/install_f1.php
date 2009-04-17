<?php
/**
*
* @author Username (Joe Smith) joesmith@example.org
* @package umil
* @copyright (c) 2008 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'FORMEL_TITLE';

/*
* The name of the config variable which will hold the currently installed version
* You do not need to set this yourself, UMIL will handle setting and updating the version itself.
*/
$version_config_name = 'f1webtipp_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
* $mod_name
* 'INSTALL_' . $mod_name
* 'INSTALL_' . $mod_name . '_CONFIRM'
* 'UPDATE_' . $mod_name
* 'UPDATE_' . $mod_name . '_CONFIRM'
* 'UNINSTALL_' . $mod_name
* 'UNINSTALL_' . $mod_name . '_CONFIRM'
*/
$language_file = 'mods/formel';

/*
* Options to display to the user (this is purely optional, if you do not need the options you do not have to set up this variable at all)
* Uses the acp_board style of outputting information, with some extras (such as the 'default' and 'select_user' options)
*/
/*
$options = array(
	'test_username'	=> array('lang' => 'TEST_USERNAME', 'type' => 'text:40:255', 'explain' => true, 'default' => $user->data['username'], 'select_user' => true),
	'test_boolean'	=> array('lang' => 'TEST_BOOLEAN', 'type' => 'radio:yes_no', 'default' => true),
);
*/
/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 0.3.0
	'0.3.0'	=> array(
		// Now to add some permission settings
		'permission_add' => array(
			array('a_formel_races', true),
			array('a_formel_teams', true),
			array('a_formel_drivers', true),
			array('a_formel_settings', true),
		),

		// How about we give some default permissions then as well?
		'permission_set' => array(
			// Global Role permissions
			array('ROLE_ADMIN_FULL', 'a_formel_races'),
			array('ROLE_ADMIN_FULL', 'a_formel_teams'),
			array('ROLE_ADMIN_FULL', 'a_formel_drivers'),
			array('ROLE_ADMIN_FULL', 'a_formel_settings'),
		),

		// Now to add the tables (this uses the layout from develop/create_schema_files.php and from phpbb_db_tools)
		'table_add' => array(
			
			array('phpbb_formel_config', array(
					'COLUMNS'		=> array(
						'config_name'		=> array('VCHAR', ''),
						'config_value'		=> array('VCHAR_UNI', ''),
					),
					'PRIMARY_KEY'	=> 'config_name',
				),
			),
			
			array('phpbb_formel_drivers', array(
					'COLUMNS'		=> array(
						'driver_id'			=> array('UINT', NULL, 'auto_increment'),
						'driver_name'		=> array('VCHAR_UNI', ''),
						'driver_img'		=> array('VCHAR', ''),
						'driver_team'		=> array('UINT', 0),
						'driver_penalty'	=> array('DECIMAL', 0),
					),
					'PRIMARY_KEY'	=> 'driver_id',
				),
			),
			
			array('phpbb_formel_teams', array(
					'COLUMNS'		=> array(
						'team_id'			=> array('UINT', NULL, 'auto_increment'),
						'team_name'			=> array('VCHAR_UNI', ''),
						'team_img'			=> array('VCHAR', ''),
						'team_car'			=> array('VCHAR', ''),
						'team_penalty'		=> array('DECIMAL', 0),
					),
					'PRIMARY_KEY'	=> 'team_id',
				),
			),
			
			array('phpbb_formel_races', array(
					'COLUMNS'		=> array(
						'race_id'			=> array('UINT', NULL, 'auto_increment'),
						'race_name'			=> array('VCHAR_UNI', ''),
						'race_img'			=> array('VCHAR', ''),
						'race_quali'		=> array('VCHAR', ''),
						'race_result'		=> array('VCHAR', ''),
						'race_time'			=> array('UINT:11', 0),
						'race_length'		=> array('VCHAR:8', ''),
						'race_laps'			=> array('UINT', 0),
						'race_distance'		=> array('VCHAR:8', ''),
						'race_debut'		=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'race_id',
				),
			),
			
			array('phpbb_formel_wm', array(
					'COLUMNS'		=> array(
						'wm_id'				=> array('UINT', NULL, 'auto_increment'),
						'wm_race'			=> array('UINT', 0),
						'wm_driver'			=> array('UINT', 0),
						'wm_team'			=> array('UINT', 0),
						'wm_points'			=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'wm_id',
				),
			),
			
			array('phpbb_formel_tipps', array(
					'COLUMNS'		=> array(
						'tipp_id'			=> array('UINT', NULL, 'auto_increment'),
						'tipp_user'			=> array('UINT', 0),
						'tipp_race'			=> array('UINT', 0),
						'tipp_result'		=> array('VCHAR:60', 0),
						'tipp_points'		=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'tipp_id',
				),
			),
		),

		// Alright, now lets add some modules to the ACP
		'module_add' => array(
			// First, lets add a new category named ACP_FORMEL_MANAGEMENT to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_FORMEL_MANAGEMENT'),
			
			// Now we will add the settings mode to the ACP_FORMEL_MANAGEMENT category using the "manual" method.
            array('acp', 'ACP_FORMEL_MANAGEMENT', array(
					'module_basename'	=> 'formel',
					'module_langname'	=> 'ACP_FORMEL_SETTINGS',
					'module_mode'		=> 'settings',
					'module_auth'		=> 'acl_a_formel_settings',
				),
			),
			
			// Now we will add the races mode to the ACP_FORMEL_MANAGEMENT category using the "manual" method.
            array('acp', 'ACP_FORMEL_MANAGEMENT', array(
					'module_basename'	=> 'formel',
					'module_langname'	=> 'ACP_FORMEL_RACES',
					'module_mode'		=> 'races',
					'module_auth'		=> 'acl_a_formel_races',
				),
			),
			
			// Now we will add the teams mode to the ACP_FORMEL_MANAGEMENT category using the "manual" method.
            array('acp', 'ACP_FORMEL_MANAGEMENT', array(
					'module_basename'	=> 'formel',
					'module_langname'	=> 'ACP_FORMEL_TEAMS',
					'module_mode'		=> 'teams',
					'module_auth'		=> 'acl_a_formel_teams',
				),
			),
			
			// Now we will add the drivers mode to the ACP_FORMEL_MANAGEMENT category using the "manual" method.
            array('acp', 'ACP_FORMEL_MANAGEMENT', array(
					'module_basename'	=> 'formel',
					'module_langname'	=> 'ACP_FORMEL_DRIVERS',
					'module_mode'		=> 'drivers',
					'module_auth'		=> 'acl_a_formel_drivers',
				),
			),
		),

		/*
		* Now we need to insert some data.  The easiest way to do that is through a custom function
		* Enter 'custom' for the array key and the name of the function for the value.
		*/
		'custom'	=> 'first_fill_0_3_0',
	),

/*
	// Version 1.0.0
	'1.0.0' => array(
		// Nothing changed in this version.
	),
*/
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

/*
* Here is our custom function that will be called for version 0.3.0.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function first_fill_0_3_0($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'install' :
		case 'update' :
			// Run this when installing/updating

			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_config');
				
				$sql_ary = array();
				
				$sql_ary[] = array('config_name' => 'mod_id', 				'config_value' => '2',);
				$sql_ary[] = array('config_name' => 'deadline_offset',		'config_value' => '600',);
				$sql_ary[] = array('config_name' => 'forum_id',				'config_value' => '0',);
				$sql_ary[] = array('config_name' => 'event_change',			'config_value' => '86400',);
				$sql_ary[] = array('config_name' => 'points_mentioned',		'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'points_placed',		'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'points_fastest',		'config_value' => '2',);
				$sql_ary[] = array('config_name' => 'points_tired',			'config_value' => '2',);
				$sql_ary[] = array('config_name' => 'restrict_to',			'config_value' => '0',);
				$sql_ary[] = array('config_name' => 'no_car_img',			'config_value' => 'nocar.jpg',);
				$sql_ary[] = array('config_name' => 'no_team_img',			'config_value' => 'noteam.jpg',);
				$sql_ary[] = array('config_name' => 'no_driver_img',		'config_value' => 'nodriver.jpg',);
				$sql_ary[] = array('config_name' => 'driver_img_height',	'config_value' => '60',);
				$sql_ary[] = array('config_name' => 'driver_img_width',		'config_value' => '48',);
				$sql_ary[] = array('config_name' => 'car_img_height',		'config_value' => '50',);
				$sql_ary[] = array('config_name' => 'car_img_width',		'config_value' => '140',);
				$sql_ary[] = array('config_name' => 'team_img_width',		'config_value' => '120',);
				$sql_ary[] = array('config_name' => 'team_img_height',		'config_value' => '48',);
				$sql_ary[] = array('config_name' => 'show_in_profile',		'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'no_race_img',			'config_value' => 'norace.jpg',);
				$sql_ary[] = array('config_name' => 'race_img_width',		'config_value' => '210',);
				$sql_ary[] = array('config_name' => 'race_img_height',		'config_value' => '121',);
				$sql_ary[] = array('config_name' => 'show_gfx',				'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'show_gfxr',			'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'show_headbanner',		'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'head_height',			'config_value' => '60',);
				$sql_ary[] = array('config_name' => 'head_width',			'config_value' => '468',);
				$sql_ary[] = array('config_name' => 'headbanner1_img',		'config_value' => 'images/formel/formel_webtipp.jpg',);
				$sql_ary[] = array('config_name' => 'headbanner1_url',		'config_value' => 'formel.php',);
				$sql_ary[] = array('config_name' => 'headbanner2_img',		'config_value' => 'images/formel/formel_rules.jpg',);
				$sql_ary[] = array('config_name' => 'headbanner2_url',		'config_value' => 'formel.php?mode=rules',);
				$sql_ary[] = array('config_name' => 'headbanner3_img',		'config_value' => 'images/formel/formel_stats.jpg',);
				$sql_ary[] = array('config_name' => 'headbanner3_url',		'config_value' => 'formel.php?mode=stats',);
				$sql_ary[] = array('config_name' => 'show_countdown',		'config_value' => '1',);
				$sql_ary[] = array('config_name' => 'show_avatar',			'config_value' => '1',);
				
				$db->sql_multi_insert($table_prefix . 'formel_config ', $sql_ary);
			}
			
			if ($umil->table_exists($table_prefix . 'formel_drivers'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_drivers');
				
				$sql_ary = array();
				
				# -- Team 1 McLaren Mercedes
				$sql_ary[] = array('driver_id' => 1,  'driver_name' => 'Hamilton, Lewis', 		'driver_img' => '', 'driver_team' => 1,);
				$sql_ary[] = array('driver_id' => 2,  'driver_name' => 'Kovalainen, Heikki',	'driver_img' => '',	'driver_team' => 1,);
				$sql_ary[] = array('driver_id' => 3,  'driver_name' => 'Rosa de la, Pedro',		'driver_img' => '',	'driver_team' => 1,);
				$sql_ary[] = array('driver_id' => 4,  'driver_name' => 'Paffet, Gary',			'driver_img' => '', 'driver_team' => 1,);
				# -- Team 2 Scuderia Ferrari
				$sql_ary[] = array('driver_id' => 5,  'driver_name' => 'Räikkönen, Kimi',		'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 6,  'driver_name' => 'Massa, Felipe',			'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 7,  'driver_name' => 'Badoer, Luca',			'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 8,  'driver_name' => 'Gené, Mark',			'driver_img' => '',	'driver_team' => 2,);
				# -- Team 3 BMW Sauber F1 Team
				$sql_ary[] = array('driver_id' => 9,  'driver_name' => 'Kubica, Robert',		'driver_img' => '',	'driver_team' => 3,);
				$sql_ary[] = array('driver_id' => 10, 'driver_name' => 'Heidfeld, Nick',		'driver_img' => '',	'driver_team' => 3,);
				$sql_ary[] = array('driver_id' => 11, 'driver_name' => 'Klien, Christian',		'driver_img' => '',	'driver_team' => 3,);
				# -- Team 4 Renault F1 Team
				$sql_ary[] = array('driver_id' => 12, 'driver_name' => 'Alonso, Fernando',		'driver_img' => '',	'driver_team' => 4,);
				$sql_ary[] = array('driver_id' => 13, 'driver_name' => 'Piquet, Nelson Jr.',	'driver_img' => '',	'driver_team' => 4,);
				$sql_ary[] = array('driver_id' => 14, 'driver_name' => 'Grosjean, Romain',		'driver_img' => '',	'driver_team' => 4,);
				# -- Team 5 Toyota Racing
				$sql_ary[] = array('driver_id' => 15, 'driver_name' => 'Trulli, Jarno',			'driver_img' => '',	'driver_team' => 5,);
				$sql_ary[] = array('driver_id' => 16, 'driver_name' => 'Glock, Timo',			'driver_img' => '',	'driver_team' => 5,);
				$sql_ary[] = array('driver_id' => 17, 'driver_name' => 'Kobayashi, Kamui',		'driver_img' => '',	'driver_team' => 5,);				
				# -- Team 6 Scuderia Toro Rosso
				$sql_ary[] = array('driver_id' => 18, 'driver_name' => 'Buemi, Sebstiano',		'driver_img' => '',	'driver_team' => 6,);
				$sql_ary[] = array('driver_id' => 19, 'driver_name' => 'Bourdais, Sébastien',	'driver_img' => '',	'driver_team' => 6,);
				# -- Team 7 Red Bull Racing
				$sql_ary[] = array('driver_id' => 20, 'driver_name' => 'Webber, Marc',			'driver_img' => '',	'driver_team' => 7,);
				$sql_ary[] = array('driver_id' => 21, 'driver_name' => 'Vettel, Sebastian',		'driver_img' => '',	'driver_team' => 7,);
				# -- Team 8 Williams F1 Team
				$sql_ary[] = array('driver_id' => 22, 'driver_name' => 'Rosberg, Nico',			'driver_img' => '',	'driver_team' => 8,);
				$sql_ary[] = array('driver_id' => 23, 'driver_name' => 'Nakajima, Kazuki',		'driver_img' => '',	'driver_team' => 8,);
				$sql_ary[] = array('driver_id' => 24, 'driver_name' => 'Hülkenberg, Nico',		'driver_img' => '',	'driver_team' => 8,);	
				# -- Team 9 Brawn GP F1 Team
				$sql_ary[] = array('driver_id' => 25, 'driver_name' => 'Button, Jenson',		'driver_img' => '',	'driver_team' => 9,);
				$sql_ary[] = array('driver_id' => 26, 'driver_name' => 'Barrichello, Rubens',	'driver_img' => '',	'driver_team' => 9,);
				$sql_ary[] = array('driver_id' => 27, 'driver_name' => 'Wurz, Alexander',		'driver_img' => '',	'driver_team' => 9,);
				# -- Team 10 Force India F1 Team
				$sql_ary[] = array('driver_id' => 28, 'driver_name' => 'Sutil, Adrian',			'driver_img' => '',	'driver_team' => 10,);
				$sql_ary[] = array('driver_id' => 29, 'driver_name' => 'Fisichella, Giancarlo',	'driver_img' => '',	'driver_team' => 10,);
				$sql_ary[] = array('driver_id' => 30, 'driver_name' => 'Liuzzi, Vitantonio',	'driver_img' => '',	'driver_team' => 10,);
				
				$db->sql_multi_insert($table_prefix . 'formel_drivers ', $sql_ary);
			}

			if ($umil->table_exists($table_prefix . 'formel_teams'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_teams');
				
				$sql_ary = array();

				$sql_ary[] = array('team_id' => 1,  'team_name' => 'McLaren Mercedes', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 2,  'team_name' => 'Scuderia Ferrari', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 3,  'team_name' => 'BMW Sauber F1 Team', 	'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 4,  'team_name' => 'Renault F1 Team', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 5,  'team_name' => 'Toyota Racing', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 6,  'team_name' => 'Scuderia Toro Rosso', 	'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 7,  'team_name' => 'Red Bull Racing', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 8,  'team_name' => 'Williams F1 Team', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 9,  'team_name' => 'Brawn GP F1 Team', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 10, 'team_name' => 'Force India F1 Team', 	'team_img' => '', 'team_car' => '',);

				$db->sql_multi_insert($table_prefix . 'formel_teams ', $sql_ary);
			}
			
			if ($umil->table_exists($table_prefix . 'formel_races'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_races');
				
				$sql_ary = array();

				$sql_ary[] = array('race_id' => 1,  'race_name' => 'Melbourne / Australien', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1238306400, 'race_length' => '5,303', 'race_laps' => 58, 'race_distance' => '307,574', 'race_debut' => 1996,);
				$sql_ary[] = array('race_id' => 2,  'race_name' => 'Malaysia / Kuala Lumpur', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1238922000, 'race_length' => '5,543', 'race_laps' => 56, 'race_distance' => '310,408', 'race_debut' => 1999,);
				$sql_ary[] = array('race_id' => 3,  'race_name' => 'China / Shanghai', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1240124400, 'race_length' => '5,451', 'race_laps' => 56, 'race_distance' => '305,066', 'race_debut' => 2004,);
				$sql_ary[] = array('race_id' => 4,  'race_name' => 'Bahrain / Manama', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1240747200, 'race_length' => '5,412', 'race_laps' => 57, 'race_distance' => '308,238', 'race_debut' => 2004,);
				$sql_ary[] = array('race_id' => 5,  'race_name' => 'Spanien / Barcelona', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1241956800, 'race_length' => '4,627', 'race_laps' => 66, 'race_distance' => '305,256', 'race_debut' => 1991,);
				$sql_ary[] = array('race_id' => 6,  'race_name' => 'Monaco / Monte Carlo', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1243166400, 'race_length' => '3,340', 'race_laps' => 78, 'race_distance' => '260,520', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 7,  'race_name' => 'Türkei / Istanbul', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1244376000, 'race_length' => '5,338', 'race_laps' => 58, 'race_distance' => '309,356', 'race_debut' => 2005,);
				$sql_ary[] = array('race_id' => 8,  'race_name' => 'Großbritannien / Silverstone', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1245585600, 'race_length' => '5,141', 'race_laps' => 60, 'race_distance' => '308,355', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 9,  'race_name' => 'Deutschland / Nürburgring', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1247400000, 'race_length' => '5,148', 'race_laps' => 60, 'race_distance' => '308,863', 'race_debut' => 1984,);
				$sql_ary[] = array('race_id' => 10, 'race_name' => 'Ungarn / Budapest', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1248609600, 'race_length' => '4,381', 'race_laps' => 70, 'race_distance' => '306,663', 'race_debut' => 1986,);
				$sql_ary[] = array('race_id' => 11, 'race_name' => 'Europa / Valencia', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1251028800, 'race_length' => '5,473', 'race_laps' => 57, 'race_distance' => '310,080', 'race_debut' => 2008,);
				$sql_ary[] = array('race_id' => 12, 'race_name' => 'Belgien / Spa-Francorchamps', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1251633600, 'race_length' => '6,976', 'race_laps' => 44, 'race_distance' => '306,927', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 13, 'race_name' => 'Italien / Monza', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1252843200, 'race_length' => '5,793', 'race_laps' => 53, 'race_distance' => '306,720', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 14, 'race_name' => 'Singapur / Singapur', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1254052800, 'race_length' => '5,067', 'race_laps' => 61, 'race_distance' => '309,087', 'race_debut' => 2008,);
				$sql_ary[] = array('race_id' => 15, 'race_name' => 'Japan / Suzuka', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1254632400, 'race_length' => '5,807', 'race_laps' => 53, 'race_distance' => '307,771', 'race_debut' => 1987,);
				$sql_ary[] = array('race_id' => 16, 'race_name' => 'Brasilien / São Paulo', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1255881600, 'race_length' => '4,309', 'race_laps' => 71, 'race_distance' => '305,909', 'race_debut' => 1973,);
				$sql_ary[] = array('race_id' => 17, 'race_name' => 'Arabische Emirate / Abu Dhabi',	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1257073200, 'race_length' => '5,520', 'race_laps' => 56, 'race_distance' => '309,120', 'race_debut' => 2009,);
				
				$db->sql_multi_insert($table_prefix . 'formel_races ', $sql_ary);
			}
			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_FIRST_FILL';
		break;

		case 'uninstall' :
		break;
	}
}

?>