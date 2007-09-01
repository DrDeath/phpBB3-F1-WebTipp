<html>
<head>
<title>Formel 1 WebTipp Installer</title>
</head>
<body>
<?php
/** 
*
* \install_f1webtipp.php
*
* @package
* @version $Id: install_f1webtipp.php 1 2007-07-30 13:25:14Z stoffel04 $
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);


if ($user->data['user_type'] != USER_FOUNDER) 
{
	die('Hacking attempt. You must be logged in as a founder to run this script.');
}

if (isset($_POST['submit'])) 
{

	// Check db sql_layer :  mysqli, mysql4 (>= 4.1.3)  or mysql4 (< 4.1.3) ?
	$sql_data = '';
	if ($db->sql_layer == 'mysqli' || version_compare($db->mysql_version, '4.1.3', '>='))
	{ 
		$sql_data = ' CHARACTER SET `utf8` COLLATE `utf8_bin`;'; 
	} 
	else
	{
		$sql_data = ';';
	}

	// Drop the formel_config table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_config';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Create formel_config table
	$sql = 'CREATE TABLE '.$table_prefix."formel_config (
		config_name varchar(255) NOT NULL default '',
		config_value varchar(255) NOT NULL default ''
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_config</b> succesfully created</font><br />";

	// Drop the formel_drivers table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_drivers';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Create formel_drivers table
	$sql = 'CREATE TABLE '.$table_prefix."formel_drivers (
		driver_id mediumint(8) NOT NULL auto_increment,
		driver_name varchar(32) NOT NULL default '',
		driver_img varchar(255) NOT NULL default '',
		driver_team mediumint(8) NOT NULL default '0',
		PRIMARY KEY  (driver_id)
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_drivers</b> succesfully created</font><br />";
	
	// Drop the formel_teams table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_teams';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	// Create formel_teams table
	$sql = 'CREATE TABLE '.$table_prefix."formel_teams (
		team_id smallint(8) NOT NULL auto_increment,
		team_name varchar(64) NOT NULL default '',
		team_img varchar(255) NOT NULL default '',
		team_car varchar(255) NOT NULL default '',
		PRIMARY KEY  (team_id)
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_teams</b> succesfully created</font><br />";
	
	// Drop the formel_races table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_races';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Create formel_races table
	$sql = 'CREATE TABLE '.$table_prefix."formel_races (
		race_id mediumint(8) NOT NULL auto_increment,
		race_name varchar(64) NOT NULL default '',
		race_img varchar(255) NOT NULL default '',
		race_quali varchar(255) NOT NULL default '0',
		race_result varchar(255) NOT NULL default '0',
		race_time int(11) NOT NULL default '0',
		race_length varchar(8) NOT NULL default '',
		race_laps mediumint(8) NOT NULL default '0',
		race_distance varchar(8) NOT NULL default '',
		race_debut mediumint(8) NOT NULL default '0',
		PRIMARY KEY  (race_id)
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_races</b> succesfully created</font><br />";

	// Drop the formel_wm table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_wm';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Create formel_wm table
	$sql = 'CREATE TABLE '.$table_prefix."formel_wm (
		wm_id mediumint(8) NOT NULL auto_increment,
		wm_race mediumint(8) NOT NULL default '0',
		wm_driver mediumint(8) NOT NULL default '0',
		wm_team mediumint(8) NOT NULL default '0',
		wm_points mediumint(8) NOT NULL default '0',
		PRIMARY KEY  (wm_id)
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_wm</b> succesfully created</font><br />";
	
	// Drop the formel_tipps table if existing
	$sql = 'DROP TABLE IF EXISTS '.$table_prefix.'formel_tipps';
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	// Create formel_tipps table
	$sql = 'CREATE TABLE '.$table_prefix."formel_tipps (
		tipp_id mediumint(8) NOT NULL auto_increment,
		tipp_user mediumint(8) NOT NULL default '0',
		tipp_race mediumint(8) NOT NULL default '0',
		tipp_result varchar(60) NOT NULL default '',
		tipp_points mediumint(8) NOT NULL default '0',
		PRIMARY KEY  (tipp_id)
		)";
	$sql .= $sql_data;
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	echo "<font color=green size=2>++ Table <b>" . $table_prefix . "formel_tipps</b> succesfully created</font><br />";
	
	// Insert config values into formel_config table
	$sql = 'INSERT INTO '.$table_prefix."formel_config (config_name, config_value) VALUES 
		('mod_id', '2'),
		('deadline_offset', '600'),
		('forum_id', '0'),
		('event_change', '86400'),
		('points_mentioned', '1'),
		('points_placed', '1'),
		('points_fastest', '2'),
		('points_tired', '2'),
		('restrict_to', '0'),
		('no_car_img', 'nocar.jpg'),
		('no_team_img', 'noteam.jpg'),
		('no_driver_img', 'nodriver.jpg'),
		('driver_img_height', '60'),
		('car_img_height', '50'),
		('car_img_width', '140'),
		('driver_img_width', '48'),
		('team_img_width', '120'),
		('team_img_height', '48'),
		('show_in_profile', '1'),
		('no_race_img', 'norace.jpg'),
		('race_img_width', '210'),
		('race_img_height', '121'),
		('show_gfx', '1'),
		('show_gfxr', '1'),
		('show_headbanner', '1'),
		('head_height', '60'),
		('head_width', '468'),
		('headbanner1_img', 'images/formel/formel_webtipp.jpg'),
		('headbanner1_url', 'formel.php'),
		('headbanner2_img', 'images/formel/formel_rules.jpg'),
		('headbanner2_url', 'formel.php?mode=rules'),
		('headbanner3_img', 'images/formel/formel_stats.jpg'),
		('headbanner3_url', 'formel.php?mode=stats'),
		('show_countdown', '1'),
		('show_avatar', '1')
		";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++++ Inserts into table <b>" . $table_prefix . "formel_config</b> succesfully ( Configuration )</font><br />";

	// Todo: Check all races against start time and date
	// Insert races into formel_races table
	$sql = 'INSERT INTO '.$table_prefix."formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES 
		(1, 'Melbourne - Australien', '', '0', '0', 1174186800, '5,303', 58, '307,574', 1996),
		(2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1176015600, '5,543', 56, '310,408', 1999),
		(3, 'Bahrain / Manama', '', '0', '0', 1176636600, '5,412', 57, '308,238', 2004),
		(4, 'Spanien / Barcelona', '', '0', '0', 1179057600, '4,627', 66, '305,256', 1991),
		(5, 'Monaco / Monte Carlo', '', '0', '0', 1180267200, '3,340', 78, '260,520', 1950),
		(6, 'Kanada / Montreal', '', '0', '0', 1181494800, '4,361', 70, '305,270', 1978),
		(7, 'USA / Indianapolis', '', '0', '0', 1182099600, '4,192', 73, '306,016', 2000),
		(8, 'Frankreich / Magny-Cours', '', '0', '0', 1183291200, '4,411', 70, '308,586', 1991),
		(9, 'Großbritannien / Silverstone', '', '0', '0', 1183892400, '5,141', 60, '308,355', 1950),
		(10, 'Deutschland / Nürburgring', '', '0', '0', 1185105600, '5,148', 60, '308,863', 1984),
		(11, 'Ungarn / Budapest', '', '0', '0', 1186315200, '4,381', 70, '306,663', 1986),
		(12, 'Türkei / Istanbul', '', '0', '0', 1188129600, '5,338', 58, '309,356', 2005),
		(13, 'Italien / Monza', '', '0', '0', 1189339200, '5,793', 53, '306,720', 1950),
		(14, 'Belgien / Spa-Francorchamps', '', '0', '0', 1189944000, '6,976', 44, '306,927', 1950),
		(15, 'Japan / Fuji', '', '0', '0', 1191132000, '4,563', 67, '305,721', 1976),
		(16, 'China / Shanghai', '', '0', '0', 1191733200, '5,451', 56, '305,066', 2004),
		(17, 'Brasilien / São Paulo', '', '0', '0', 1192986000, '4,309', 71, '305,909', 1973)
		";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++++ Inserts into table <b>" . $table_prefix . "formel_races</b> succesfully ( Races )</font><br />";
	
	// Todo: Check all teams against teamnames
	// Insert teams into formel_teams table
	$sql = 'INSERT INTO '.$table_prefix."formel_teams (team_id, team_name, team_img, team_car) VALUES 
		(1, 'McLaren Mercedes', '', ''),
		(2, 'Renault F1 Team', '', ''),
		(3, 'Scuderia Ferrari', '', ''),
		(4, 'Honda Racing F1 Team', '', ''),
		(5, 'Toyota Racing', '', ''),
		(6, 'BMW Sauber F1 Team', '', ''),
		(7, 'Red Bull Racing', '', ''),
		(8, 'Williams F1 Team', '', ''),
		(9, 'Scuderia Toro Rosso', '', ''),
		(10, 'Spyker MF1', '', ''),
		(11, 'Super Aguri F1', '', '')
		";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);

	echo "<font color=green size=2>++++ Inserts into table <b>" . $table_prefix . "formel_teams</b> succesfully ( F1 Teams )</font><br />";
	
	// Todo: Check all drivers against their team memberships
	// Insert all drivers into formel_drivers table 
	$sql = 'INSERT INTO '.$table_prefix."formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES 
		(1, 'Alonso, Fernando', '', 1),
		(2, 'De la Rosa, Pedro', '', 1),
		(3, 'Paffett, Gary', '', 1),
		(4, 'Hamilton, Lewis', '', 1),
		(5, 'Kovalainen, Heikki', '', 2),
		(6, 'Fisichella, Giancarlo', '', 2),
		(7, 'Piquet Jr., Nelson', '', 2),
		(8, 'Zonta, Ricardo', '', 2),
		(9, 'Räikkönen, Kimi', '', 3),
		(10, 'Massa, Felipe', '', 3),
		(11, 'Badoer, Luca', '', 3),
		(12, 'Gené, Mark', '', 3),
		(13, 'Barrichello, Rubens', '', 4),
		(14, 'Button, Jenson', '', 4),
		(15, 'Klien, Christian', '', 4),
		(16, 'Rossiter, James', '', 4),
		(17, 'Heidfeld, Nick', '', 6),
		(18, 'Kubica, Robert', '', 6),
		(19, 'Vettel, Sebastian', '', 6),
		(20, 'Glock, Timo', '', 6),
		(21, 'Schumacher, Ralf', '', 5),
		(22, 'Trulli, Jarno', '', 5),
		(23, 'Montagny, Franck', '', 5),
		(24, 'Coulthard, David', '', 7),
		(25, 'Webber, Mark', '', 7),
		(26, 'Doornbos, Robert', '', 7),
		(27, 'Rosberg, Nico', '', 8),
		(28, 'Wurz, Alexander', '', 8),
		(29, 'Karthikeyan, Narain', '', 8),
		(30, 'Nakajima, Kazuki', '', 8),
		(31, 'Liuzzi, Vitantonio', '', 9),
		(32, 'Speed, Scott', '', 9),
		(33, 'Ammermüller, Michael', '', 7),
		(34, 'Albers, Christijan', '', 10),
		(35, 'Winkelhock, Markus', '', 10),
		(36, 'Sutil, Adrian', '', 10),
		(37, 'Mondini, Giorgio', '', 10),
		(38, 'Sato, Takuma', '', 11),
		(39, 'Davidson, Anthony', '', 11),
		(40, 'Van der Garde, Giedo', '', 11),
		(41, 'Yamamoto, Sakon', '', 11)
		";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);
	
	echo "<font color=green size=2>++++ Inserts into table <b>" . $table_prefix . "formel_drivers</b> succesfully ( F1 Drivers )</font><br />";
	
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
	
	//Add new permission set to the module system
	$sql = 'INSERT INTO '.$table_prefix."acl_options (auth_option, is_global, is_local, founder_only) VALUES 
		('a_formel_settings', 1, 0, 0),
		('a_formel_drivers', 1, 0, 0),
		('a_formel_teams', 1, 0, 0),
		('a_formel_races', 1, 0, 0)
		";
	$result = $db->sql_query($sql);
	$db->sql_freeresult($result);	
	
	//Destroy the old permission chache again to enable the new set :-)
	$cache->purge();
	
	echo "<font color=green size=2>++ New permission set established into <b>" . $table_prefix . "acl_options</b> ( ACP F1 Permissions )</font><br />";

	echo "<br /><center>\n";
	echo "<font color=green size=5><b>Tables created successfully.</b></font><br />\n";
	echo "<a href=".append_sid("{$phpbb_root_path}index.$phpEx")."><b>Go back to the index page</b></a>\n";
	echo "</center>\n";
} 
else 
{
	echo "<br /><center>\n";
	echo "<font size=10>Formel 1 WebTipp MOD v0.1.22 (beta)</font><br />\n";
	echo "<b>Script for automated Formel 1 WebTipp table generation.<br />(for Olympus boards only)</b><br /><br />\n";
	echo "<form method='POST'>\n";
	echo "<font color=red>This procedure will erase all settings, drivers, teams, races and usertipps of any previous Formel 1 WebTipp installation.</font><br>\n";
	echo "Are you sure you want to continue?\n";
	echo "<p><input type='submit' value='Continue' name='submit'></p>\n";
	echo "</form>\n";
	echo "</center>\n";
}
?>
</body>
</html>