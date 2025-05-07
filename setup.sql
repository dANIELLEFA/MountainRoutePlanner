USE CSCI470;
CREATE TABLE IF NOT EXISTS cities 
(name VARCHAR(15) NOT NULL PRIMARY KEY,
section VARCHAR(4) NOT NULL,
p1 int,
p2 int,
visitcount int DEFAULT '0');
CREATE TABLE IF NOT EXISTS logs (
id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
day DATE,
time TIME,
destination VARCHAR(15),
origin VARCHAR(15),
FOREIGN KEY (destination) REFERENCES cities(name),
FOREIGN KEY (origin) REFERENCES cities(name));
CREATE TABLE IF NOT EXISTS user (
username VARCHAR(8) NOT NULL PRIMARY KEY,
passwrd VARCHAR(255) NOT NULL);
CREATE TABLE IF NOT EXISTS pointsOfInterest 
(name VARCHAR(30) NOT NULL PRIMARY KEY,
section VARCHAR(4) NOT NULL,
p1 int,
p2 int);
INSERT IGNORE INTO user VALUES (
'user',
'temp'
);
INSERT IGNORE INTO cities VALUES (
'Billings',
'BYZ',
'103',
'91','0'
);
INSERT IGNORE INTO cities VALUES (
'Bozeman',
'TFX',
'97',
'58','0'
);
INSERT IGNORE INTO cities VALUES (
'Butte',
'MSO',
'147',
'83','0'
);
INSERT IGNORE INTO cities VALUES (
'Dillon',
'TFX',
'41',
'42','0'
);
INSERT IGNORE INTO cities VALUES (
'Great Falls',
'TFX',
'97',
'144','0'
);
INSERT IGNORE INTO cities VALUES (
'Hardin',
'BYZ',
'131',
'87','0'
);
INSERT IGNORE INTO cities VALUES (
'Helena',
'TFX',
'70',
'104','0'
);
INSERT IGNORE INTO cities VALUES (
'Miles City',
'BYZ',
'192',
'112','0'
);
INSERT IGNORE INTO cities VALUES (
'Missoula',
'MSO',
'105',
'131','0'
);
INSERT IGNORE INTO cities VALUES (
'Livingston',
'BYZ',
'35',
'93','0');
INSERT IGNORE INTO pointsOfInterest VALUES (
'Bighorn River Bridge',
'BYZ',
'138',
'105');
INSERT IGNORE INTO pointsOfInterest VALUES (
'Yellowstone River Bridge',
'BYZ',
'72',
'90');
INSERT IGNORE INTO pointsOfInterest VALUES (
'Homestake Pass',
'MSO',
'150',
'80');
INSERT IGNORE INTO pointsOfInterest VALUES (
'Bear Gulch',
'TFX',
'68',
'119');
INSERT IGNORE INTO pointsOfInterest VALUES (
'Missouri River Bridge',
'TFX',
'80',
'131');