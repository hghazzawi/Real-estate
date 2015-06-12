-- File: city.sql
-- Author: YOUR NAME
-- Date: THE DATE YOU CREATED THE FILE
-- Description: SQL file to create city property/value table

DROP TABLE IF EXISTS cities;

CREATE TABLE cities(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO cities (value, property) VALUES (1, 'Ajax');

INSERT INTO cities (value, property) VALUES (2, 'Brooklin');

INSERT INTO cities (value, property) VALUES (4, 'Bowmanville');

INSERT INTO cities (value, property) VALUES (8, 'Oshawa');

INSERT INTO cities (value, property) VALUES (16, 'Pickering');

INSERT INTO cities (value, property) VALUES (32, 'Port Perry');

INSERT INTO cities (value, property) VALUES (64, 'Whitby');
