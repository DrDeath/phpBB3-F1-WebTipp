#
# $Id: $
#


# Table: 'phpbb_formel_config'
CREATE TABLE phpbb_formel_config (
	config_name VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	config_value VARCHAR(255) CHARACTER SET UTF8 DEFAULT '' NOT NULL COLLATE UNICODE
);;

ALTER TABLE phpbb_formel_config ADD PRIMARY KEY (config_name);;


# Table: 'phpbb_formel_drivers'
CREATE TABLE phpbb_formel_drivers (
	driver_id INTEGER NOT NULL,
	driver_name VARCHAR(255) CHARACTER SET UTF8 DEFAULT '' NOT NULL COLLATE UNICODE,
	driver_img VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	driver_team INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_formel_drivers ADD PRIMARY KEY (driver_id);;


CREATE GENERATOR phpbb_formel_drivers_gen;;
SET GENERATOR phpbb_formel_drivers_gen TO 0;;

CREATE TRIGGER t_phpbb_formel_drivers FOR phpbb_formel_drivers
BEFORE INSERT
AS
BEGIN
	NEW.driver_id = GEN_ID(phpbb_formel_drivers_gen, 1);
END;;


# Table: 'phpbb_formel_teams'
CREATE TABLE phpbb_formel_teams (
	team_id INTEGER NOT NULL,
	team_name VARCHAR(255) CHARACTER SET UTF8 DEFAULT '' NOT NULL COLLATE UNICODE,
	team_img VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	team_car VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL
);;

ALTER TABLE phpbb_formel_teams ADD PRIMARY KEY (team_id);;


CREATE GENERATOR phpbb_formel_teams_gen;;
SET GENERATOR phpbb_formel_teams_gen TO 0;;

CREATE TRIGGER t_phpbb_formel_teams FOR phpbb_formel_teams
BEFORE INSERT
AS
BEGIN
	NEW.team_id = GEN_ID(phpbb_formel_teams_gen, 1);
END;;


# Table: 'phpbb_formel_races'
CREATE TABLE phpbb_formel_races (
	race_id INTEGER NOT NULL,
	race_name VARCHAR(255) CHARACTER SET UTF8 DEFAULT '' NOT NULL COLLATE UNICODE,
	race_img VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	race_quali VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	race_result VARCHAR(255) CHARACTER SET NONE DEFAULT '' NOT NULL,
	race_time INTEGER DEFAULT 0 NOT NULL,
	race_length VARCHAR(8) CHARACTER SET NONE DEFAULT '' NOT NULL,
	race_laps INTEGER DEFAULT 0 NOT NULL,
	race_distance VARCHAR(8) CHARACTER SET NONE DEFAULT '' NOT NULL,
	race_debut INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_formel_races ADD PRIMARY KEY (race_id);;


CREATE GENERATOR phpbb_formel_races_gen;;
SET GENERATOR phpbb_formel_races_gen TO 0;;

CREATE TRIGGER t_phpbb_formel_races FOR phpbb_formel_races
BEFORE INSERT
AS
BEGIN
	NEW.race_id = GEN_ID(phpbb_formel_races_gen, 1);
END;;


# Table: 'phpbb_formel_wm'
CREATE TABLE phpbb_formel_wm (
	wm_id INTEGER NOT NULL,
	wm_race INTEGER DEFAULT 0 NOT NULL,
	wm_driver INTEGER DEFAULT 0 NOT NULL,
	wm_team INTEGER DEFAULT 0 NOT NULL,
	wm_points INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_formel_wm ADD PRIMARY KEY (wm_id);;


CREATE GENERATOR phpbb_formel_wm_gen;;
SET GENERATOR phpbb_formel_wm_gen TO 0;;

CREATE TRIGGER t_phpbb_formel_wm FOR phpbb_formel_wm
BEFORE INSERT
AS
BEGIN
	NEW.wm_id = GEN_ID(phpbb_formel_wm_gen, 1);
END;;


# Table: 'phpbb_formel_tipps'
CREATE TABLE phpbb_formel_tipps (
	tipp_id INTEGER NOT NULL,
	tipp_user INTEGER DEFAULT 0 NOT NULL,
	tipp_race INTEGER DEFAULT 0 NOT NULL,
	tipp_result VARCHAR(60) CHARACTER SET NONE DEFAULT 0 NOT NULL,
	tipp_points INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_formel_tipps ADD PRIMARY KEY (tipp_id);;


CREATE GENERATOR phpbb_formel_tipps_gen;;
SET GENERATOR phpbb_formel_tipps_gen TO 0;;

CREATE TRIGGER t_phpbb_formel_tipps FOR phpbb_formel_tipps
BEFORE INSERT
AS
BEGIN
	NEW.tipp_id = GEN_ID(phpbb_formel_tipps_gen, 1);
END;;


