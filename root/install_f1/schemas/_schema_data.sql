#
# $Id: schema_data.sql,v 1.257 2007/09/20 21:19:00 stoffel04 Exp $
#

# POSTGRES BEGIN #

# -- Config
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('mod_id', '2');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('deadline_offset', '600');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('forum_id', '0');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('event_change', '86400');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('points_mentioned', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('points_placed', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('points_fastest', '2');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('points_tired', '2');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('restrict_to', '0');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('no_car_img', 'nocar.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('no_team_img', 'noteam.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('no_driver_img', 'nodriver.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('driver_img_height', '60');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('driver_img_width', '48');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('car_img_height', '50');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('car_img_width', '140');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('team_img_width', '120');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('team_img_height', '48');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_in_profile', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('no_race_img', 'norace.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('race_img_width', '210');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('race_img_height', '121');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_gfx', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_gfxr', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_headbanner', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('head_height', '60');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('head_width', '468');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner1_img', 'images/formel/formel_webtipp.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner1_url', 'formel.php');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner2_img', 'images/formel/formel_rules.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner2_url', 'formel.php?mode=rules');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner3_img', 'images/formel/formel_stats.jpg');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('headbanner3_url', 'formel.php?mode=stats');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_countdown', '1');
INSERT INTO phpbb_formel_config (config_name, config_value) VALUES ('show_avatar', '1');

# -- Races -- done for 2009
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (1, 'Melbourne / Australien', '', '0', '0', 1238306400, '5,303', 58, '307,574', 1996);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1238922000, '5,543', 56, '310,408', 1999);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (3, 'China / Shanghai', '', '0', '0', 1240124400, '5,451', 56, '305,066', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (4, 'Bahrain / Manama', '', '0', '0', 1240747200, '5,412', 57, '308,238', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (5, 'Spanien / Barcelona', '', '0', '0', 1241956800, '4,627', 66, '305,256', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (6, 'Monaco / Monte Carlo', '', '0', '0', 1243166400, '3,340', 78, '260,520', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (7, 'Türkei / Istanbul', '', '0', '0', 1244376000, '5,338', 58, '309,356', 2005);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (8, 'Großbritannien / Silverstone', '', '0', '0', 1245585600, '5,141', 60, '308,355', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (9, 'Deutschland / Nürburgring', '', '0', '0', 1247400000, '5,148', 60, '308,863', 1984);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (10, 'Ungarn / Budapest', '', '0', '0', 1248609600, '4,381', 70, '306,663', 1986);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (11, 'Europa / Valencia', '', '0', '0', 1251028800, '5,473', 57, '310,080', 2008);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (12, 'Belgien / Spa-Francorchamps', '', '0', '0', 1251633600, '6,976', 44, '306,927', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (13, 'Italien / Monza', '', '0', '0', 1252843200, '5,793', 53, '306,720', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (14, 'Singapur / Singapur', '', '0', '0', 1254052800, '5,067', 61, '309,087', 2008);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (15, 'Japan / Suzuka', '', '0', '0', 1254632400, '5,807', 53, '307,771', 1987);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (16, 'Brasilien / São Paulo', '', '0', '0', 1255881600, '4,309', 71, '305,909', 1973);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (17, 'Arabische Emirate / Abu Dhabi', '', '0', '0', 1257073200, '5,52', 56, '309,120', 2009);


# -- Teams -- done for 2009
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (1, 'McLaren Mercedes', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (2, 'Scuderia Ferrari', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (3, 'BMW Sauber F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (4, 'Renault F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (5, 'Toyota Racing', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (6, 'Scuderia Toro Rosso', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (7, 'Red Bull Racing', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (8, 'Williams F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (9, 'Honda Racing F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (10, 'Force India F1 Team', '', '');

# -- Drivers -- tbd -- check for changing teams...
# -- Team 1 McLaren Mercedes
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (1, 'Hamilton, Lewis', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (2, 'Kovalainen, Heikki', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (3, 'Rosa de la, Pedro', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (4, 'Paffet, Gary', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (5, 'Resta di, Paul', '', 1);

# -- Team 2 Scuderia Ferrari
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (6, 'Räikkönen, Kimi', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (7, 'Massa, Felipe', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (8, 'Badoer, Luca', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (9, 'Gené, Mark', '', 2);

# -- Team 3 BMW Sauber F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (10, 'Kubica, Robert', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (11, 'Heidfeld, Nick', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (12, 'Klien, Christian', '', 3);

# -- Team 4 Renault F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (13, 'Alonso, Fernando', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (14, 'Piquet, Nelson Jr.', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (15, 'Grosjean, Romain', '', 4);


# -- Team 5 Toyota Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (16, 'Trulli, Jarno', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (17, 'Glock, Timo', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (18, 'Kobayashi, Kamui', '', 5);

# -- Team 6 Scuderia Toro Rosso
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (19, 'Buemi, Sebstian', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (20, 'Bourdais, Sébastien', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (21, 'Sato, Takuma', '', 6);

# -- Team 7 Red Bull Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (22, 'Webber, Marc', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (23, 'Vettel, Sebastian', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (24, 'Alguersuari, Jaime', '', 7);

# -- Team 8 Williams F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (25, 'Rosberg, Nico', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (26, 'Nakajima, Kazuki', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (27, 'Hülkenberg, Nico', '', 8);

# -- Team 9 Honda Racing F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (28, 'Button, Jenson', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (29, 'Barrichello, Rubens', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (30, 'Wurz, Alexander', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (31, 'Senna, Bruno', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (32, 'Grassi di, Lucas', '', 4);

# -- Team 10 Force India F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (33, 'Sutil, Adrian', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (34, 'Fisichella, Giancarlo', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (35, 'Liuzzi, Vitantonio', '', 10);


# POSTGRES COMMIT #






