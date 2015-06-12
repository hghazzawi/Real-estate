-- File: listing_material.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create type property/value table

DROP TABLE IF EXISTS listing_material;

CREATE TABLE listing_material(
value SMALLINT PRIMARY KEY,
property VARCHAR(50) NOT NULL
);

INSERT INTO listing_material (value, property) VALUES (1, 'Wood');

INSERT INTO listing_material (value, property) VALUES (2, 'Metal');

INSERT INTO listing_material (value, property) VALUES (4, 'Stone');


