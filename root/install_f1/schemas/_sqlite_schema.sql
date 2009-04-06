#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_formel_config'
CREATE TABLE phpbb_formel_config (
	config_name varchar(255) NOT NULL DEFAULT '',
	config_value varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (config_name)
);


# Table: 'phpbb_formel_drivers'
CREATE TABLE phpbb_formel_drivers (
	driver_id INTEGER PRIMARY KEY NOT NULL ,
	driver_name varchar(255) NOT NULL DEFAULT '',
	driver_img varchar(255) NOT NULL DEFAULT '',
	driver_team INTEGER UNSIGNED NOT NULL DEFAULT '0',
	driver_penalty decimal(5,2) NOT NULL DEFAULT '0'
);


# Table: 'phpbb_formel_teams'
CREATE TABLE phpbb_formel_teams (
	team_id INTEGER PRIMARY KEY NOT NULL ,
	team_name varchar(255) NOT NULL DEFAULT '',
	team_img varchar(255) NOT NULL DEFAULT '',
	team_car varchar(255) NOT NULL DEFAULT '',
	team_penalty decimal(5,2) NOT NULL DEFAULT '0'
);


# Table: 'phpbb_formel_races'
CREATE TABLE phpbb_formel_races (
	race_id INTEGER PRIMARY KEY NOT NULL ,
	race_name varchar(255) NOT NULL DEFAULT '',
	race_img varchar(255) NOT NULL DEFAULT '',
	race_quali varchar(255) NOT NULL DEFAULT '',
	race_result varchar(255) NOT NULL DEFAULT '',
	race_time INTEGER UNSIGNED NOT NULL DEFAULT '0',
	race_length varchar(8) NOT NULL DEFAULT '',
	race_laps INTEGER UNSIGNED NOT NULL DEFAULT '0',
	race_distance varchar(8) NOT NULL DEFAULT '',
	race_debut INTEGER UNSIGNED NOT NULL DEFAULT '0'
);


# Table: 'phpbb_formel_wm'
CREATE TABLE phpbb_formel_wm (
	wm_id INTEGER PRIMARY KEY NOT NULL ,
	wm_race INTEGER UNSIGNED NOT NULL DEFAULT '0',
	wm_driver INTEGER UNSIGNED NOT NULL DEFAULT '0',
	wm_team INTEGER UNSIGNED NOT NULL DEFAULT '0',
	wm_points INTEGER UNSIGNED NOT NULL DEFAULT '0'
);


# Table: 'phpbb_formel_tipps'
CREATE TABLE phpbb_formel_tipps (
	tipp_id INTEGER PRIMARY KEY NOT NULL ,
	tipp_user INTEGER UNSIGNED NOT NULL DEFAULT '0',
	tipp_race INTEGER UNSIGNED NOT NULL DEFAULT '0',
	tipp_result varchar(60) NOT NULL DEFAULT '0',
	tipp_points INTEGER UNSIGNED NOT NULL DEFAULT '0'
);



COMMIT;