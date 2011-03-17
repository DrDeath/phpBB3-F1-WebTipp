<?php
/**
*
* @package phpbb3f1webtipp
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* install/index.php - [UMIL install-File]
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
define('IN_INSTALL', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
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
*/
$language_file = 'mods/formel';

/*
* Optionally we may specify our own logo image to show in the upper corner instead of the default logo.
* $phpbb_root_path will get prepended to the path specified
* Image height should be 50px to prevent cut-off or stretching.
*/
// $logo_img = 'images/formel/formel_webtipp.jpg';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	// Version 0.3.0 - this is the first version using UMIL
	//all older versions have to add the config variable 'f1webtipp_version' with the value '0.3.0' before.
	//See also the update instructions -->  /contrib/update_0130_to_030.xml
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
			// Global Role permissions give to the role "Full admin"
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

	// Version 0.3.1
	'0.3.1' => array(
		// Version 0.3.1 - adding feature "Guests are allowed to view the f1webtipp". Default is false.
		'custom'	=> 'fill_0_3_1',
	),

	// Version 0.3.2
	'0.3.2' => array(
		// Version 0.3.2- adding support for Ultimate Point System. Default is point systems disabled and point value 50.00
		'custom'	=> 'fill_0_3_2',
	),

	// Version 0.3.3
	'0.3.3' => array(
		// Version 0.3.3- adding option to disable drivers
		'table_column_add' => array(
			array('phpbb_formel_drivers', 'driver_disabled', array(
					'BOOL', 0
				)
			),
		),
	),

	// Version 0.3.4
	'0.3.4' => array(
		// Version 0.3.4- nothing to change
	),

	// Version 0.3.5
	'0.3.5' => array(
		// Version 0.3.5- adding option for race abort - change table column to decimal
		'table_column_update' => array(
			array('phpbb_formel_wm', 'wm_points', array(
					'DECIMAL', 0
				)
			),
		),
		// Version 0.3.5- adding feature "Safety Car Deployment". Default points 2
		'custom'	=> 'fill_0_3_5',
	),

	// Version 0.3.6
	'0.3.6' => array(
		// Version 0.3.6- adding AddOn "Viewtopic statistic".
		'custom'	=> 'fill_0_3_6',
	),

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

				# -- Team 1 Red Bull Racing
				$sql_ary[] = array('driver_id' => 1,  'driver_name' => 'Vettel, Sebastian', 	'driver_img' => '', 'driver_team' => 1,);
				$sql_ary[] = array('driver_id' => 2,  'driver_name' => 'Webber, Mark',			'driver_img' => '',	'driver_team' => 1,);
				$sql_ary[] = array('driver_id' => 26, 'driver_name' => 'Ricciardo, Daniel',		'driver_img' => '',	'driver_team' => 1,);
				# -- Team 2 McLaren Mercedes
				$sql_ary[] = array('driver_id' => 3,  'driver_name' => 'Hamilton, Lewis',		'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 4,  'driver_name' => 'Button, Jenson',		'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 27, 'driver_name' => 'Paffett, Gary',			'driver_img' => '',	'driver_team' => 2,);
				$sql_ary[] = array('driver_id' => 28, 'driver_name' => 'Rosa de la, Pedro',		'driver_img' => '',	'driver_team' => 2,);
				# -- Team 3 Scuderia Ferrari
				$sql_ary[] = array('driver_id' => 5,  'driver_name' => 'Alonso, Fernando',		'driver_img' => '',	'driver_team' => 3,);
				$sql_ary[] = array('driver_id' => 6,  'driver_name' => 'Massa, Felipe',			'driver_img' => '',	'driver_team' => 3,);
				$sql_ary[] = array('driver_id' => 29, 'driver_name' => 'Bianchi, Jules',		'driver_img' => '',	'driver_team' => 3,);
				# -- Team 4 Mercedes GP F1 Team
				$sql_ary[] = array('driver_id' => 7,  'driver_name' => 'Schumacher, Michael',	'driver_img' => '',	'driver_team' => 4,);
				$sql_ary[] = array('driver_id' => 8,  'driver_name' => 'Rosberg, Nico',			'driver_img' => '',	'driver_team' => 4,);
				# -- Team 5 Lotus Renault GP
				$sql_ary[] = array('driver_id' => 9,  'driver_name' => 'Heidfeld, Nick',		'driver_img' => '',	'driver_team' => 5,);
				$sql_ary[] = array('driver_id' => 10, 'driver_name' => 'Petrow, Witali',		'driver_img' => '',	'driver_team' => 5,);
				$sql_ary[] = array('driver_id' => 30, 'driver_name' => 'Grosjean, Romain',		'driver_img' => '',	'driver_team' => 5,);
				$sql_ary[] = array('driver_id' => 31, 'driver_name' => 'Senna, Bruno',			'driver_img' => '',	'driver_team' => 5,);
				# -- Team 6 Williams
				$sql_ary[] = array('driver_id' => 11, 'driver_name' => 'Barrichello, Rubens',	'driver_img' => '',	'driver_team' => 6,);
				$sql_ary[] = array('driver_id' => 12, 'driver_name' => 'Maldonado, Pastor',		'driver_img' => '',	'driver_team' => 6,);
				$sql_ary[] = array('driver_id' => 32, 'driver_name' => 'Bottas, Valtteri',		'driver_img' => '',	'driver_team' => 6,);
				# -- Team 7 Force India F1 Team
				$sql_ary[] = array('driver_id' => 14, 'driver_name' => 'Sutil, Adrian',			'driver_img' => '',	'driver_team' => 7,);
				$sql_ary[] = array('driver_id' => 15, 'driver_name' => 'Resta di, Paul',		'driver_img' => '',	'driver_team' => 7,);
				$sql_ary[] = array('driver_id' => 33, 'driver_name' => 'Hülkenberg, Nico',		'driver_img' => '',	'driver_team' => 7,);
				# -- Team 8 Sauber F1 Team
				$sql_ary[] = array('driver_id' => 16, 'driver_name' => 'Kobayashi, Kamui',		'driver_img' => '',	'driver_team' => 8,);
				$sql_ary[] = array('driver_id' => 17, 'driver_name' => 'Pérez Mendoza, Sergio',	'driver_img' => '',	'driver_team' => 8,);
				$sql_ary[] = array('driver_id' => 34, 'driver_name' => 'Gutierrez, Esteban',	'driver_img' => '',	'driver_team' => 8,);
				# -- Team 9 Scuderia Toro Rosso
				$sql_ary[] = array('driver_id' => 18, 'driver_name' => 'Buemi, Sébastien',		'driver_img' => '',	'driver_team' => 9,);
				$sql_ary[] = array('driver_id' => 19, 'driver_name' => 'Alguersuari, Jaime',	'driver_img' => '',	'driver_team' => 9,);
				# -- Team 10 Team Lotus
				$sql_ary[] = array('driver_id' => 20, 'driver_name' => 'Trulli, Jarno',			'driver_img' => '',	'driver_team' => 10,);
				$sql_ary[] = array('driver_id' => 21, 'driver_name' => 'Kovalainen, Heikkio',	'driver_img' => '',	'driver_team' => 10,);
				# -- Team 11 HRT F1 Team
				$sql_ary[] = array('driver_id' => 22, 'driver_name' => 'Karthikeyan, Narain',	'driver_img' => '',	'driver_team' => 11,);
				$sql_ary[] = array('driver_id' => 23, 'driver_name' => 'Liuzzi, Vitantonio',	'driver_img' => '',	'driver_team' => 11,);
				# -- Team 12 Marussia Virgin Racing
				$sql_ary[] = array('driver_id' => 24, 'driver_name' => "D'Ambrosio, Jérôme",	'driver_img' => '',	'driver_team' => 12,);
				$sql_ary[] = array('driver_id' => 25, 'driver_name' => 'Glock, Timo',			'driver_img' => '',	'driver_team' => 12,);
				
				$db->sql_multi_insert($table_prefix . 'formel_drivers ', $sql_ary);
			}

			if ($umil->table_exists($table_prefix . 'formel_teams'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_teams');

				$sql_ary = array();

				$sql_ary[] = array('team_id' => 1,  'team_name' => 'Red Bull Racing', 			'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 2,  'team_name' => 'McLaren Mercedes', 			'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 3,  'team_name' => 'Scuderia Ferrari', 			'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 4,  'team_name' => 'Mercedes GP F1 Team',	 	'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 5,  'team_name' => 'Lotus Renault GP', 			'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 6,  'team_name' => 'Williams', 					'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 7,  'team_name' => 'Force India F1 Team', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 8,  'team_name' => 'Sauber F1 Team', 			'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 9,  'team_name' => 'Scuderia Toro Rosso', 		'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 10, 'team_name' => 'Team Lotus', 				'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 11, 'team_name' => 'HRT F1 Team', 				'team_img' => '', 'team_car' => '',);
				$sql_ary[] = array('team_id' => 12, 'team_name' => 'Marussia Virgin Racing', 	'team_img' => '', 'team_car' => '',);

				$db->sql_multi_insert($table_prefix . 'formel_teams ', $sql_ary);
			}

			if ($umil->table_exists($table_prefix . 'formel_races'))
			{
				// before we fill anything in this table, we truncate it. Maybe someone missed an old installation.
				$db->sql_query('TRUNCATE TABLE ' . $table_prefix . 'formel_races');

				$sql_ary = array();

				$sql_ary[] = array('race_id' => 1,  'race_name' => 'Melbourne / Australien', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1301205600, 'race_length' => '5,303', 'race_laps' => 58, 'race_distance' => '307,574', 'race_debut' => 1996,);
				$sql_ary[] = array('race_id' => 2,  'race_name' => 'Malaysia / Kuala Lumpur', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1302422400, 'race_length' => '5,543', 'race_laps' => 56, 'race_distance' => '310,408', 'race_debut' => 1999,);
				$sql_ary[] = array('race_id' => 3,  'race_name' => 'China / Shanghai', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1303023600, 'race_length' => '5,451', 'race_laps' => 56, 'race_distance' => '305,066', 'race_debut' => 2004,);
				$sql_ary[] = array('race_id' => 4,  'race_name' => 'Türkei / Istanbul', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1304856000, 'race_length' => '5,338', 'race_laps' => 58, 'race_distance' => '309,356', 'race_debut' => 2005,);
				$sql_ary[] = array('race_id' => 5,  'race_name' => 'Spanien / Barcelona', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1306065600, 'race_length' => '4,655', 'race_laps' => 66, 'race_distance' => '307,104', 'race_debut' => 1991,);
				$sql_ary[] = array('race_id' => 6,  'race_name' => 'Monaco / Monte Carlo', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1306670400, 'race_length' => '3,340', 'race_laps' => 78, 'race_distance' => '260,520', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 7,  'race_name' => 'Kanada / Montreal', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1307898000, 'race_length' => '4,361', 'race_laps' => 70, 'race_distance' => '305,270', 'race_debut' => 1967,);
				$sql_ary[] = array('race_id' => 8,  'race_name' => 'Europa / Valencia', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1309089600, 'race_length' => '5,419', 'race_laps' => 57, 'race_distance' => '308,883', 'race_debut' => 2008,);
				$sql_ary[] = array('race_id' => 9,  'race_name' => 'Großbritannien / Silverstone', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1310299200, 'race_length' => '5,891', 'race_laps' => 52, 'race_distance' => '306,747', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 10, 'race_name' => 'Deutschland / Nürburgringt', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1311508800, 'race_length' => '5,148', 'race_laps' => 60, 'race_distance' => '308,863', 'race_debut' => 1984,);
				$sql_ary[] = array('race_id' => 11, 'race_name' => 'Ungarn / Budapest', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1312113600, 'race_length' => '4,381', 'race_laps' => 70, 'race_distance' => '306,630', 'race_debut' => 1986,);
				$sql_ary[] = array('race_id' => 12, 'race_name' => 'Belgien / Spa-Francorchamps', 	'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1314532800, 'race_length' => '7,004', 'race_laps' => 44, 'race_distance' => '308,052', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 13, 'race_name' => 'Italien / Monza', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1315742400, 'race_length' => '5,793', 'race_laps' => 53, 'race_distance' => '306,720', 'race_debut' => 1950,);
				$sql_ary[] = array('race_id' => 14, 'race_name' => 'Singapur / Singapur', 			'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1316952000, 'race_length' => '5,073', 'race_laps' => 61, 'race_distance' => '309,316', 'race_debut' => 2008,);
				$sql_ary[] = array('race_id' => 15, 'race_name' => 'Japan / Suzuka', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1318140000, 'race_length' => '5,807', 'race_laps' => 53, 'race_distance' => '307,471', 'race_debut' => 1987,);
				$sql_ary[] = array('race_id' => 16, 'race_name' => 'Korea / Yeongum', 				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1318744800, 'race_length' => '5,615', 'race_laps' => 55, 'race_distance' => '309,155', 'race_debut' => 2010,);
				$sql_ary[] = array('race_id' => 17, 'race_name' => 'Indien / Greater Noida',		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1319979600, 'race_length' => '5,141', 'race_laps' => 60, 'race_distance' => '308,400', 'race_debut' => 2011,);
				$sql_ary[] = array('race_id' => 18, 'race_name' => 'Arabische Emirate / Abu Dhabi', 'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1321189200, 'race_length' => '5,554', 'race_laps' => 55, 'race_distance' => '305,361', 'race_debut' => 2009,);
				$sql_ary[] = array('race_id' => 19, 'race_name' => 'Brasilien / São Paulo', 		'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1322409600, 'race_length' => '4,309', 'race_laps' => 71, 'race_distance' => '305,909', 'race_debut' => 1973,);
				$sql_ary[] = array('race_id' => 20, 'race_name' => 'Bahrain / Manama',				'race_img' => '', 'race_quali' => '0', 'race_result' => '0', 'race_time' => 1322956800, 'race_length' => '5,412', 'race_laps' => 57, 'race_distance' => '308,238', 'race_debut' => 2004,);

				$db->sql_multi_insert($table_prefix . 'formel_races ', $sql_ary);
			}
			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_FIRST_FILL';
		break;

		case 'uninstall' :
		break;
	}
}

/*
* Here is our custom function that will be called for version 0.3.1.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function fill_0_3_1($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'install' :
		case 'update' :
			// Run this when installing/updating
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql_ary = array();
				
				$sql_ary[] = array('config_name' => 'guest_viewing', 'config_value' => '0',);
				
				$db->sql_multi_insert($table_prefix . 'formel_config ', $sql_ary);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;

		case 'uninstall' :
			// Run this when uninstalling
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
			$sql = 'DELETE FROM ' . $table_prefix . "formel_config
				WHERE config_name = 'guest_viewing'";
			$db->sql_query($sql);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;
	}
}

/*
* Here is our custom function that will be called for version 0.3.2.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function fill_0_3_2($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'install' :
		case 'update' :
			// Run this when installing/updating
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql_ary = array();
				
				$sql_ary[] = array('config_name' => 'points_enabled', 'config_value' => '0',);
				$sql_ary[] = array('config_name' => 'points_value', 'config_value' => '50.00',);
				
				$db->sql_multi_insert($table_prefix . 'formel_config ', $sql_ary);
			}
			
			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;

		case 'uninstall' :
			// Run this when uninstalling
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql = 'DELETE FROM ' . $table_prefix . "formel_config
				WHERE config_name = 'points_enabled'";
				$db->sql_query($sql);
				$sql = 'DELETE FROM ' . $table_prefix . "formel_config
				WHERE config_name = 'points_value'";
				$db->sql_query($sql);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;
	}
}

/*
* Here is our custom function that will be called for version 0.3.5.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function fill_0_3_5($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'install' :
		case 'update' :
			// Run this when installing/updating
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql_ary = array();
				
				$sql_ary[] = array('config_name' => 'points_safety_car', 'config_value' => '2',);
				
				$db->sql_multi_insert($table_prefix . 'formel_config ', $sql_ary);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;

		case 'uninstall' :
			// Run this when uninstalling
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql = 'DELETE FROM ' . $table_prefix . "formel_config
					WHERE config_name = 'points_safety_car'";
				$db->sql_query($sql);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;
	}
}

/*
* Here is our custom function that will be called for version 0.3.6.
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
*/
function fill_0_3_6($action, $version)
{
	global $db, $table_prefix, $umil;

	switch ($action)
	{
		case 'install' :
		case 'update' :
			// Run this when installing/updating
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql_ary = array();

				$sql_ary[] = array('config_name' => 'show_in_viewtopic', 'config_value' => '1',);

				$db->sql_multi_insert($table_prefix . 'formel_config ', $sql_ary);
			}
			
			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;

		case 'uninstall' :
			// Run this when uninstalling
			if ($umil->table_exists($table_prefix . 'formel_config'))
			{
				$sql = 'DELETE FROM ' . $table_prefix . "formel_config
					WHERE config_name = 'show_in_viewtopic'";
				$db->sql_query($sql);
			}

			// Method 1 of displaying the command (and Success for the result)
			return 'INSERT_F1_CONFIG';
		break;
	}
}

?>