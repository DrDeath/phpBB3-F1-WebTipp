#
# $Id: $
#

# Table: 'phpbb_formel_config'
CREATE TABLE phpbb_formel_config (
	config_name varchar(255) DEFAULT '' NOT NULL,
	config_value varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (config_name)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


# Table: 'phpbb_formel_drivers'
CREATE TABLE phpbb_formel_drivers (
	driver_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	driver_name varchar(255) DEFAULT '' NOT NULL,
	driver_img varchar(255) DEFAULT '' NOT NULL,
	driver_team mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	driver_penalty decimal(5,2) DEFAULT '0' NOT NULL,
	PRIMARY KEY (driver_id)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


# Table: 'phpbb_formel_teams'
CREATE TABLE phpbb_formel_teams (
	team_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	team_name varchar(255) DEFAULT '' NOT NULL,
	team_img varchar(255) DEFAULT '' NOT NULL,
	team_car varchar(255) DEFAULT '' NOT NULL,
	team_penalty decimal(5,2) DEFAULT '0' NOT NULL,
	PRIMARY KEY (team_id)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


# Table: 'phpbb_formel_races'
CREATE TABLE phpbb_formel_races (
	race_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	race_name varchar(255) DEFAULT '' NOT NULL,
	race_img varchar(255) DEFAULT '' NOT NULL,
	race_quali varchar(255) DEFAULT '' NOT NULL,
	race_result varchar(255) DEFAULT '' NOT NULL,
	race_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	race_length varchar(8) DEFAULT '' NOT NULL,
	race_laps mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	race_distance varchar(8) DEFAULT '' NOT NULL,
	race_debut mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (race_id)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


# Table: 'phpbb_formel_wm'
CREATE TABLE phpbb_formel_wm (
	wm_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	wm_race mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	wm_driver mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	wm_team mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	wm_points mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (wm_id)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


# Table: 'phpbb_formel_tipps'
CREATE TABLE phpbb_formel_tipps (
	tipp_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	tipp_user mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	tipp_race mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	tipp_result varchar(60) DEFAULT '0' NOT NULL,
	tipp_points mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (tipp_id)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


