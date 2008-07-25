/*

 $Id: $

*/

/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING 
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora' 
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB" 
	PROFILE "DEFAULT" 
	IDENTIFIED BY "phpbb_password" 
	DEFAULT TABLESPACE "PHPBB" 
	QUOTA UNLIMITED ON "PHPBB" 
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
*/
/*
	Table: 'phpbb_formel_config'
*/
CREATE TABLE phpbb_formel_config (
	config_name varchar2(255) DEFAULT '' ,
	config_value varchar2(765) DEFAULT '' ,
	CONSTRAINT pk_phpbb_formel_config PRIMARY KEY (config_name)
)
/


/*
	Table: 'phpbb_formel_drivers'
*/
CREATE TABLE phpbb_formel_drivers (
	driver_id number(8) NOT NULL,
	driver_name varchar2(765) DEFAULT '' ,
	driver_img varchar2(255) DEFAULT '' ,
	driver_team number(8) DEFAULT '0' NOT NULL,
	driver_penalty number(8) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_formel_drivers PRIMARY KEY (driver_id)
)
/


CREATE SEQUENCE phpbb_formel_drivers_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_formel_drivers
BEFORE INSERT ON phpbb_formel_drivers
FOR EACH ROW WHEN (
	new.driver_id IS NULL OR new.driver_id = 0
)
BEGIN
	SELECT phpbb_formel_drivers_seq.nextval
	INTO :new.driver_id
	FROM dual;
END;
/


/*
	Table: 'phpbb_formel_teams'
*/
CREATE TABLE phpbb_formel_teams (
	team_id number(8) NOT NULL,
	team_name varchar2(765) DEFAULT '' ,
	team_img varchar2(255) DEFAULT '' ,
	team_car varchar2(255) DEFAULT '' ,
	team_penalty number(8) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_formel_teams PRIMARY KEY (team_id)
)
/


CREATE SEQUENCE phpbb_formel_teams_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_formel_teams
BEFORE INSERT ON phpbb_formel_teams
FOR EACH ROW WHEN (
	new.team_id IS NULL OR new.team_id = 0
)
BEGIN
	SELECT phpbb_formel_teams_seq.nextval
	INTO :new.team_id
	FROM dual;
END;
/


/*
	Table: 'phpbb_formel_races'
*/
CREATE TABLE phpbb_formel_races (
	race_id number(8) NOT NULL,
	race_name varchar2(765) DEFAULT '' ,
	race_img varchar2(255) DEFAULT '' ,
	race_quali varchar2(255) DEFAULT '' ,
	race_result varchar2(255) DEFAULT '' ,
	race_time number(11) DEFAULT '0' NOT NULL,
	race_length varchar2(8) DEFAULT '' ,
	race_laps number(8) DEFAULT '0' NOT NULL,
	race_distance varchar2(8) DEFAULT '' ,
	race_debut number(8) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_formel_races PRIMARY KEY (race_id)
)
/


CREATE SEQUENCE phpbb_formel_races_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_formel_races
BEFORE INSERT ON phpbb_formel_races
FOR EACH ROW WHEN (
	new.race_id IS NULL OR new.race_id = 0
)
BEGIN
	SELECT phpbb_formel_races_seq.nextval
	INTO :new.race_id
	FROM dual;
END;
/


/*
	Table: 'phpbb_formel_wm'
*/
CREATE TABLE phpbb_formel_wm (
	wm_id number(8) NOT NULL,
	wm_race number(8) DEFAULT '0' NOT NULL,
	wm_driver number(8) DEFAULT '0' NOT NULL,
	wm_team number(8) DEFAULT '0' NOT NULL,
	wm_points number(8) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_formel_wm PRIMARY KEY (wm_id)
)
/


CREATE SEQUENCE phpbb_formel_wm_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_formel_wm
BEFORE INSERT ON phpbb_formel_wm
FOR EACH ROW WHEN (
	new.wm_id IS NULL OR new.wm_id = 0
)
BEGIN
	SELECT phpbb_formel_wm_seq.nextval
	INTO :new.wm_id
	FROM dual;
END;
/


/*
	Table: 'phpbb_formel_tipps'
*/
CREATE TABLE phpbb_formel_tipps (
	tipp_id number(8) NOT NULL,
	tipp_user number(8) DEFAULT '0' NOT NULL,
	tipp_race number(8) DEFAULT '0' NOT NULL,
	tipp_result varchar2(60) DEFAULT '0' NOT NULL,
	tipp_points number(8) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_formel_tipps PRIMARY KEY (tipp_id)
)
/


CREATE SEQUENCE phpbb_formel_tipps_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_formel_tipps
BEFORE INSERT ON phpbb_formel_tipps
FOR EACH ROW WHEN (
	new.tipp_id IS NULL OR new.tipp_id = 0
)
BEGIN
	SELECT phpbb_formel_tipps_seq.nextval
	INTO :new.tipp_id
	FROM dual;
END;
/


