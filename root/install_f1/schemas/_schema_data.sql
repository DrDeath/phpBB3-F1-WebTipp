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

# -- Races
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (1, 'Melbourne - Australien', '', '0', '0', 1205636400, '5,303', 58, '307,574', 1996);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1206255600, '5,543', 56, '310,408', 1999);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (3, 'Bahrain / Manama', '', '0', '0', 1207481400, '5,412', 57, '308,238', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (4, 'Spanien / Barcelona', '', '0', '0', 1209297600, '4,627', 66, '305,256', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (5, 'Monaco / Monte Carlo', '', '0', '0', 1211716800, '3,340', 78, '260,520', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (6, 'Kanada / Montreal', '', '0', '0', 1212944400, '4,361', 70, '305,270', 1978);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (7, 'Singapur / Singapur', '', '0', '0', 1222581600, '', 0, '', 0);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (8, 'Frankreich / Magny-Cours', '', '0', '0', 1214136000, '4,574', 70, '308,586', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (9, 'Großbritannien / Silverstone', '', '0', '0', 1215345600, '5,141', 60, '308,355', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (10, 'Deutschland / Hockenheim', '', '0', '0', 1216555200, '5,148', 0, '', 1970);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (11, 'Ungarn / Budapest', '', '0', '0', 1217764800, '4,381', 70, '306,663', 1986);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (12, 'Türkei / Istanbul', '', '0', '0', 1210507200, '5,338', 58, '309,356', 2005);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (13, 'Italien / Monza', '', '0', '0', 1221393600, '5,793', 53, '306,720', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (14, 'Belgien / Spa-Francorchamps', '', '0', '0', 1220788800, '6,976', 44, '306,927', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (15, 'Japan / Fuji', '', '0', '0', 1223785800, '4,563', 67, '305,721', 1976);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (16, 'China / Shanghai', '', '0', '0', 1224396000, '5,451', 56, '305,066', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (17, 'Brasilien / São Paulo', '', '0', '0', 1225648800, '4,309', 71, '305,909', 1973);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (18, 'Europa / Valencia', '', '0', '0', 1219579200, '5,473', 0, '', 2008);

# -- Teams
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (1, 'Scuderia Ferrari', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (2, 'BMW Sauber F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (3, 'Renault F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (4, 'Williams F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (5, 'Red Bull Racing', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (6, 'Toyota Racing F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (7, 'Scuderia Toro Rosso', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (8, 'Honda Racing F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (9, 'Super Aguri F1', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (10, 'Force India F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (11, 'McLaren Mercedes', '', '');

# -- Drivers
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (1, 'Räikkönen, Kimi', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (2, 'Massa, Felipe', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (3, 'Badoer, Luca', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (4, 'Gené, Mark', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (5, 'Heidfeld, Nick', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (6, 'Kubica, Robert', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (7, 'Doornbos, Robert', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (8, 'Alonso, Fernando', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (9, 'Piquet, Nelson Jr.', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (10, 'Grosjean, Romain', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (11, 'Rosberg, Nico', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (12, 'Nakajima, Kazuki', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (13, 'Hülkenberg, Nico', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (14, 'Coulthard, David', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (15, 'Webber, Marc', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (16, 'Trulli, Jarno', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (17, 'Glock, Timo', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (18, 'Kobayashi, Kamui', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (19, 'Bourdais, Sébastien', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (20, 'Vettel, Sebastian', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (21, 'Button, Jenson', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (22, 'Barrichello, Rubens', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (23, 'Wurz, Alexander', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (24, 'Sato, Takuma', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (25, 'Davidson, Anthony', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (26, 'Rossiter, James', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (27, 'Sutil, Adrian', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (28, 'Fisichella, Giancarlo', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (29, 'Liuzzi, Vitantonio', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (30, 'Hamilton, Lewis', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (31, 'Kovalainen, Heikki', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (32, 'Rosa de la, Pedro', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (33, 'Paffet, Gary', '', 11);



# -- Permissions
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_settings', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_drivers', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_teams', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_races', 1, 0, 0);


# POSTGRES COMMIT #






