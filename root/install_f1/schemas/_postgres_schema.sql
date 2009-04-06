/*

 $Id: $

*/

BEGIN;

/*
	Domain definition
*/
CREATE DOMAIN varchar_ci AS varchar(255) NOT NULL DEFAULT ''::character varying;

/*
	Operation Functions
*/
CREATE FUNCTION _varchar_ci_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) = LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_not_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) != LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) < LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_less_equal(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) <= LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_than(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) > LOWER($2)' LANGUAGE SQL STRICT;
CREATE FUNCTION _varchar_ci_greater_equals(varchar_ci, varchar_ci) RETURNS boolean AS 'SELECT LOWER($1) >= LOWER($2)' LANGUAGE SQL STRICT;

/*
	Operators
*/
CREATE OPERATOR <(
  PROCEDURE = _varchar_ci_less_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >,
  NEGATOR = >=,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR <=(
  PROCEDURE = _varchar_ci_less_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = >=,
  NEGATOR = >,
  RESTRICT = scalarltsel,
  JOIN = scalarltjoinsel);

CREATE OPERATOR >(
  PROCEDURE = _varchar_ci_greater_than,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <,
  NEGATOR = <=,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR >=(
  PROCEDURE = _varchar_ci_greater_equals,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <=,
  NEGATOR = <,
  RESTRICT = scalargtsel,
  JOIN = scalargtjoinsel);

CREATE OPERATOR <>(
  PROCEDURE = _varchar_ci_not_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = <>,
  NEGATOR = =,
  RESTRICT = neqsel,
  JOIN = neqjoinsel);

CREATE OPERATOR =(
  PROCEDURE = _varchar_ci_equal,
  LEFTARG = varchar_ci,
  RIGHTARG = varchar_ci,
  COMMUTATOR = =,
  NEGATOR = <>,
  RESTRICT = eqsel,
  JOIN = eqjoinsel,
  HASHES,
  MERGES,
  SORT1= <);

/*
	Table: 'phpbb_formel_config'
*/
CREATE TABLE phpbb_formel_config (
	config_name varchar(255) DEFAULT '' NOT NULL,
	config_value varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (config_name)
);


/*
	Table: 'phpbb_formel_drivers'
*/
CREATE SEQUENCE phpbb_formel_drivers_seq;

CREATE TABLE phpbb_formel_drivers (
	driver_id INT4 DEFAULT nextval('phpbb_formel_drivers_seq'),
	driver_name varchar(255) DEFAULT '' NOT NULL,
	driver_img varchar(255) DEFAULT '' NOT NULL,
	driver_team INT4 DEFAULT '0' NOT NULL CHECK (driver_team >= 0),
	driver_penalty decimal(5,2) DEFAULT '0' NOT NULL,
	PRIMARY KEY (driver_id)
);


/*
	Table: 'phpbb_formel_teams'
*/
CREATE SEQUENCE phpbb_formel_teams_seq;

CREATE TABLE phpbb_formel_teams (
	team_id INT4 DEFAULT nextval('phpbb_formel_teams_seq'),
	team_name varchar(255) DEFAULT '' NOT NULL,
	team_img varchar(255) DEFAULT '' NOT NULL,
	team_car varchar(255) DEFAULT '' NOT NULL,
	team_penalty decimal(5,2) DEFAULT '0' NOT NULL,
	PRIMARY KEY (team_id)
);


/*
	Table: 'phpbb_formel_races'
*/
CREATE SEQUENCE phpbb_formel_races_seq;

CREATE TABLE phpbb_formel_races (
	race_id INT4 DEFAULT nextval('phpbb_formel_races_seq'),
	race_name varchar(255) DEFAULT '' NOT NULL,
	race_img varchar(255) DEFAULT '' NOT NULL,
	race_quali varchar(255) DEFAULT '' NOT NULL,
	race_result varchar(255) DEFAULT '' NOT NULL,
	race_time INT4 DEFAULT '0' NOT NULL CHECK (race_time >= 0),
	race_length varchar(8) DEFAULT '' NOT NULL,
	race_laps INT4 DEFAULT '0' NOT NULL CHECK (race_laps >= 0),
	race_distance varchar(8) DEFAULT '' NOT NULL,
	race_debut INT4 DEFAULT '0' NOT NULL CHECK (race_debut >= 0),
	PRIMARY KEY (race_id)
);


/*
	Table: 'phpbb_formel_wm'
*/
CREATE SEQUENCE phpbb_formel_wm_seq;

CREATE TABLE phpbb_formel_wm (
	wm_id INT4 DEFAULT nextval('phpbb_formel_wm_seq'),
	wm_race INT4 DEFAULT '0' NOT NULL CHECK (wm_race >= 0),
	wm_driver INT4 DEFAULT '0' NOT NULL CHECK (wm_driver >= 0),
	wm_team INT4 DEFAULT '0' NOT NULL CHECK (wm_team >= 0),
	wm_points INT4 DEFAULT '0' NOT NULL CHECK (wm_points >= 0),
	PRIMARY KEY (wm_id)
);


/*
	Table: 'phpbb_formel_tipps'
*/
CREATE SEQUENCE phpbb_formel_tipps_seq;

CREATE TABLE phpbb_formel_tipps (
	tipp_id INT4 DEFAULT nextval('phpbb_formel_tipps_seq'),
	tipp_user INT4 DEFAULT '0' NOT NULL CHECK (tipp_user >= 0),
	tipp_race INT4 DEFAULT '0' NOT NULL CHECK (tipp_race >= 0),
	tipp_result varchar(60) DEFAULT '0' NOT NULL,
	tipp_points INT4 DEFAULT '0' NOT NULL CHECK (tipp_points >= 0),
	PRIMARY KEY (tipp_id)
);



COMMIT;