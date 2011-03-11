#
# $Id: schema_data.sql,v 1.257 2007/09/20 21:19:00 stoffel04 Exp $
#

# POSTGRES BEGIN #

# -- Races -- 2011 (missing local start times for India)
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(1, 'Australien / Melbourne', '', '0', '0', 1301205600, '5,303', 58, '307,574', 1996);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(2, 'Malaysia / Kuala Lumpur', '', '0', '0', 1302422400, '5,543', 56, '310,408', 1999);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(3, 'China / Shanghai', '', '0', '0', 1303023600, '5,451', 56, '305,066', 2004);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(4, 'Türkei / Istanbul', '', '0', '0', 1304856000, '5,338', 58, '309,356', 2005);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(5, 'Spanien / Barcelona', '', '0', '0', 1306065600, '4,655', 66, '307,104', 1991);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(6, 'Monaco / Monte Carlo', '', '0', '0', 1306670400, '3,340', 78, '260,520', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(7, 'Kanada / Montreal', '', '0', '0', 1307898000, '4,361', 70, '305,270', 1967);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(8, 'Europa / Valencia', '', '0', '0', 1309089600, '5,419', 57, '308,883', 2008);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(9, 'Großbritannien / Silverstone', '', '0', '0', 1310299200, '5,891', 52, '306,747', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(10, 'Deutschland / Nürburgring', '', '0', '0', 1311508800, '5,148', 60, '308,863', 1984);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(11, 'Ungarn / Budapest', '', '0', '0', 1312113600, '4,381', 70, '306,630', 1986);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(12, 'Belgien / Spa-Francorchamps', '', '0', '0', 1314532800, '7,004', 44, '308,052', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(13, 'Italien / Monza', '', '0', '0', 1315742400, '5,793', 53, '306,720', 1950);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(14, 'Singapur / Singapur', '', '0', '0', 1316952000, '5,073', 61, '309,316', 2008);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(15, 'Japan / Suzuka', '', '0', '0', 1318140000, '5,807', 53, '307,471', 1987);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(16, 'Korea / Yeongum', '', '0', '0', 1318744800, '5,615', 55, '309,155', 2010);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(17, 'Indien / Greater Noida', '', '0', '0', 1319979600, '5,141', 60, '308,400', 2011);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(18, 'Arabische Emirate / Abu Dhabi', '', '0', '0', 1321189200, '5,554', 55, '305,361', 2009);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(19, 'Brasilien / São Paulo', '', '0', '0', 1322409600, '4,309', 71, '305,909', 1973);
INSERT INTO phpbb_formel_races (race_id, race_name, race_img, race_quali, race_result, race_time, race_length, race_laps, race_distance, race_debut) VALUES(20, 'Bahrain / Manama', '', '0', '0', 1322956800, '5,412', 57, '308,238', 2004);


# -- Teams -- 2011
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(1, 'Red Bull Racing', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(2, 'McLaren Mercedes', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(3, 'Scuderia Ferrari', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(4, 'Mercedes GP F1 Team', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(5, 'Lotus Renault GP', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(6, 'Williams', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(7, 'Force India F1 Team', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(8, 'Sauber F1 Team', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(9, 'Scuderia Toro Rosso', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(10, 'Team Lotus', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(11, 'HRT F1 Team', '', '', 0.00);
INSERT INTO phpbb_formel_teams (team_id, team_name, team_img, team_car, team_penalty) VALUES(12, 'Marussia Virgin Racing', '', '', 0.00);


# -- Drivers -- 2011 (missing drivers can be added in the ACP modul)
# -- Team 1 Red Bull Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (1, 'Vettel, Sebastian', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (2, 'Webber, Mark', '', 1);

# -- Team 2 McLaren Mercedes
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (3, 'Hamilton, Lewis', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (4, 'Button, Jenson', '', 2);

# -- Team 3 Scuderia Ferrari
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (5, 'Alonso, Fernando', '', 3);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (6, 'Massa, Felipe', '', 3);

# -- Team 4 Mercedes GP F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (7, 'Schumacher, Michael', '', 4);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (8, 'Rosberg, Nico', '', 4);

# -- Team 5 Lotus Renault GP
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (9, 'Heidfeld, Nick', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (10, 'Petrow, Witali', '', 5);

# -- Team 6 Williams
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (11, 'Barrichello, Rubens', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (12, 'Maldonado, Pastor', '', 6);

# -- Team 7 Force India F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (13, 'Sutil, Adrian', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (14, 'Resta di, Paul', '', 7);

# -- Team 8 Sauber F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (15, 'Kobayashi, Kamui', '', 8);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (16, 'Pérez Mendoza, Sergio', '', 8);

# -- Team 9 Scuderia Toro Rosso
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (17, 'Buemi, Sébastien', '', 9);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (18, 'Alguersuari, Jaime', '', 9);

# -- Team 10 Team Lotus
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (19, 'Trulli, Jarno', '', 10);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (20, 'Kovalainen, Heikki', '', 10);

# -- Team 11 HRT F1 Team
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (21, 'Karthikeyan, Narain', '', 11);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (22, 'Liuzzi, Vitantonio', '', 11);

# -- Team 12 Marussia Virgin Racing
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (23, "D'Ambrosio, Jérôme", '', 12);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (24, 'Glock, Timo', '', 12);

# -- Testdrivers
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (25, 'Ricciardo, Daniel', '', 1);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (26, 'Paffett, Gary', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (27, 'Rosa de la, Pedro', '', 2);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (28, 'Bianchi, Jules', '', 3);

INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (29, 'Grosjean, Romain', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (30, 'Senna, Bruno', '', 5);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (31, 'Bottas, Valtteri', '', 6);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (32, 'Hülkenberg, Nico', '', 7);
INSERT INTO phpbb_formel_drivers (driver_id, driver_name, driver_img, driver_team) VALUES (33, 'Gutierrez, Esteban', '', 8);

# POSTGRES COMMIT #