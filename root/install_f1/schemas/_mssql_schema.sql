/*

 $Id: $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_formel_config'
*/
CREATE TABLE [phpbb_formel_config] (
	[config_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[config_value] [varchar] (255) DEFAULT ('') NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_config] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_config] PRIMARY KEY  CLUSTERED 
	(
		[config_name]
	)  ON [PRIMARY] 
GO


/*
	Table: 'phpbb_formel_drivers'
*/
CREATE TABLE [phpbb_formel_drivers] (
	[driver_id] [int] IDENTITY (1, 1) NOT NULL ,
	[driver_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[driver_img] [varchar] (255) DEFAULT ('') NOT NULL ,
	[driver_team] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_drivers] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_drivers] PRIMARY KEY  CLUSTERED 
	(
		[driver_id]
	)  ON [PRIMARY] 
GO


/*
	Table: 'phpbb_formel_teams'
*/
CREATE TABLE [phpbb_formel_teams] (
	[team_id] [int] IDENTITY (1, 1) NOT NULL ,
	[team_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[team_img] [varchar] (255) DEFAULT ('') NOT NULL ,
	[team_car] [varchar] (255) DEFAULT ('') NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_teams] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_teams] PRIMARY KEY  CLUSTERED 
	(
		[team_id]
	)  ON [PRIMARY] 
GO


/*
	Table: 'phpbb_formel_races'
*/
CREATE TABLE [phpbb_formel_races] (
	[race_id] [int] IDENTITY (1, 1) NOT NULL ,
	[race_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[race_img] [varchar] (255) DEFAULT ('') NOT NULL ,
	[race_quali] [varchar] (255) DEFAULT ('') NOT NULL ,
	[race_result] [varchar] (255) DEFAULT ('') NOT NULL ,
	[race_time] [int] DEFAULT (0) NOT NULL ,
	[race_length] [varchar] (8) DEFAULT ('') NOT NULL ,
	[race_laps] [int] DEFAULT (0) NOT NULL ,
	[race_distance] [varchar] (8) DEFAULT ('') NOT NULL ,
	[race_debut] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_races] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_races] PRIMARY KEY  CLUSTERED 
	(
		[race_id]
	)  ON [PRIMARY] 
GO


/*
	Table: 'phpbb_formel_wm'
*/
CREATE TABLE [phpbb_formel_wm] (
	[wm_id] [int] IDENTITY (1, 1) NOT NULL ,
	[wm_race] [int] DEFAULT (0) NOT NULL ,
	[wm_driver] [int] DEFAULT (0) NOT NULL ,
	[wm_team] [int] DEFAULT (0) NOT NULL ,
	[wm_points] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_wm] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_wm] PRIMARY KEY  CLUSTERED 
	(
		[wm_id]
	)  ON [PRIMARY] 
GO


/*
	Table: 'phpbb_formel_tipps'
*/
CREATE TABLE [phpbb_formel_tipps] (
	[tipp_id] [int] IDENTITY (1, 1) NOT NULL ,
	[tipp_user] [int] DEFAULT (0) NOT NULL ,
	[tipp_race] [int] DEFAULT (0) NOT NULL ,
	[tipp_result] [varchar] (60) DEFAULT (0) NOT NULL ,
	[tipp_points] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_formel_tipps] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_formel_tipps] PRIMARY KEY  CLUSTERED 
	(
		[tipp_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

