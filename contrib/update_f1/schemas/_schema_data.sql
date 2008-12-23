#
# $Id: schema_data.sql,v 1.257 2007/09/20 21:19:00 stoffel04 Exp $
#

# POSTGRES BEGIN #

# -- Races -- tbd
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (1, 'Melbourne - Australien', '', '0', '0', 1205636400, '5,303', 58, '307,574', 1996);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1206255600, '5,543', 56, '310,408', 1999);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (3, 'Bahrain / Manama', '', '0', '0', 1207481400, '5,412', 57, '308,238', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (4, 'Spanien / Barcelona', '', '0', '0', 1209297600, '4,627', 66, '305,256', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (5, 'Monaco / Monte Carlo', '', '0', '0', 1211716800, '3,340', 78, '260,520', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (6, 'Kanada / Montreal', '', '0', '0', 1212944400, '4,361', 70, '305,270', 1978);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (7, 'Singapur / Singapur', '', '0', '0', 1222581600, '', 0, '', 0);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (8, 'Frankreich / Magny-Cours', '', '0', '0', 1214136000, '4,574', 70, '308,586', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (9, 'Großbritannien / Silverstone', '', '0', '0', 1215345600, '5,141', 60, '308,355', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (10, 'Deutschland / Hockenheim', '', '0', '0', 1216555200, '4,574', 0, '', 1970);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (11, 'Ungarn / Budapest', '', '0', '0', 1217764800, '4,381', 70, '306,663', 1986);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (12, 'Türkei / Istanbul', '', '0', '0', 1210507200, '5,338', 58, '309,356', 2005);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (13, 'Italien / Monza', '', '0', '0', 1221393600, '5,793', 53, '306,720', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (14, 'Belgien / Spa-Francorchamps', '', '0', '0', 1220788800, '6,976', 44, '306,927', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (15, 'Japan / Fuji', '', '0', '0', 1223785800, '4,563', 67, '305,721', 1976);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (16, 'China / Shanghai', '', '0', '0', 1224396000, '5,451', 56, '305,066', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (17, 'Brasilien / São Paulo', '', '0', '0', 1225648800, '4,309', 71, '305,909', 1973);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES (18, 'Europa / Valencia', '', '0', '0', 1219579200, '5,473', 0, '', 2008);

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
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (6, 'Massa, Felipe', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (7, 'Räikkönen, Kimi', '', 2);
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
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (16, 'Grassi di, Lucas', '', 4);

# -- Team 5 Toyota Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (17, 'Trulli, Jarno', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (18, 'Glock, Timo', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (19, 'Kobayashi, Kamui', '', 5);

# -- Team 6 Scuderia Toro Rosso
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (20, 'Bourdais, Sébastien', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (21, 'Buemi, Sebstian', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (22, 'Sato, Takuma', '', 6);

# -- Team 7 Red Bull Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (23, 'Webber, Marc', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (24, 'Vettel, Sebastian', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (25, 'Alguersuari, Jaime', '', 7);

# -- Team 8 Williams F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (26, 'Rosberg, Nico', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (27, 'Nakajima, Kazuki', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (28, 'Hülkenberg, Nico', '', 8);

# -- Team 9 Honda Racing F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (29, 'Button, Jenson', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (30, 'Barrichello, Rubens', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (31, 'Wurz, Alexander', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (32, 'Senna, Bruno', '', 9);

# -- Team 10 Force India F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (33, 'Sutil, Adrian', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (34, 'Fisichella, Giancarlo', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (35, 'Liuzzi, Vitantonio', '', 10);


# POSTGRES COMMIT #






