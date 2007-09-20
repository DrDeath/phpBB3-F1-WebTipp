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
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (1, 'Melbourne - Australien', '', '0', '0', 1174186800, '5,303', 58, '307,574', 1996);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1176015600, '5,543', 56, '310,408', 1999);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (3, 'Bahrain / Manama', '', '0', '0', 1176636600, '5,412', 57, '308,238', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (4, 'Spanien / Barcelona', '', '0', '0', 1179057600, '4,627', 66, '305,256', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (5, 'Monaco / Monte Carlo', '', '0', '0', 1180267200, '3,340', 78, '260,520', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (6, 'Kanada / Montreal', '', '0', '0', 1181494800, '4,361', 70, '305,270', 1978);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (7, 'USA / Indianapolis', '', '0', '0', 1182099600, '4,192', 73, '306,016', 2000);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (8, 'Frankreich / Magny-Cours', '', '0', '0', 1183291200, '4,411', 70, '308,586', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (9, 'Großbritannien / Silverstone', '', '0', '0', 1183892400, '5,141', 60, '308,355', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (10, 'Deutschland / Nürburgring', '', '0', '0', 1185105600, '5,148', 60, '308,863', 1984);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (11, 'Ungarn / Budapest', '', '0', '0', 1186315200, '4,381', 70, '306,663', 1986);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (12, 'Türkei / Istanbul', '', '0', '0', 1188129600, '5,338', 58, '309,356', 2005);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (13, 'Italien / Monza', '', '0', '0', 1189339200, '5,793', 53, '306,720', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (14, 'Belgien / Spa-Francorchamps', '', '0', '0', 1189944000, '6,976', 44, '306,927', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (15, 'Japan / Fuji', '', '0', '0', 1191132000, '4,563', 67, '305,721', 1976);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (16, 'China / Shanghai', '', '0', '0', 1191733200, '5,451', 56, '305,066', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (17, 'Brasilien / São Paulo', '', '0', '0', 1192986000, '4,309', 71, '305,909', 1973);

# -- Teams
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (1, 'McLaren Mercedes', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (2, 'Renault F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (3, 'Scuderia Ferrari', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (4, 'Honda Racing F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (5, 'Toyota Racing', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (6, 'BMW Sauber F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (7, 'Red Bull Racing', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (8, 'Williams F1 Team', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (9, 'Scuderia Toro Rosso', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (10, 'Spyker MF1', '', '');
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car) VALUES (11, 'Super Aguri F1', '', '');

# -- Drivers
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (1, 'Alonso, Fernando', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (2, 'De la Rosa, Pedro', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (3, 'Paffett, Gary', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (4, 'Hamilton, Lewis', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (5, 'Kovalainen, Heikki', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (6, 'Fisichella, Giancarlo', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (7, 'Piquet Jr., Nelson', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (8, 'Zonta, Ricardo', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (9, 'Räikkönen, Kimi', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (10, 'Massa, Felipe', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (11, 'Badoer, Luca', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (12, 'Gené, Mark', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (13, 'Barrichello, Rubens', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (14, 'Button, Jenson', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (15, 'Klien, Christian', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (16, 'Rossiter, James', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (17, 'Heidfeld, Nick', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (18, 'Kubica, Robert', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (19, 'Vettel, Sebastian', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (20, 'Glock, Timo', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (21, 'Schumacher, Ralf', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (22, 'Trulli, Jarno', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (23, 'Montagny, Franck', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (24, 'Coulthard, David', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (25, 'Webber, Mark', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (26, 'Doornbos, Robert', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (27, 'Rosberg, Nico', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (28, 'Wurz, Alexander', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (29, 'Karthikeyan, Narain', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (30, 'Nakajima, Kazuki', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (31, 'Liuzzi, Vitantonio', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (32, 'Speed, Scott', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (33, 'Ammermüller, Michael', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (34, 'Albers, Christijan', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (35, 'Winkelhock, Markus', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (36, 'Sutil, Adrian', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (37, 'Mondini, Giorgio', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (38, 'Sato, Takuma', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (39, 'Davidson, Anthony', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (40, 'Van der Garde, Giedo', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (41, 'Yamamoto, Sakon', '', 11);

# -- Permissions
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_settings', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_drivers', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_teams', 1, 0, 0);
INSERT INTO phpbb_acl_options (auth_option, is_global, is_local, founder_only) VALUES ('a_formel_races', 1, 0, 0);


# POSTGRES COMMIT #






