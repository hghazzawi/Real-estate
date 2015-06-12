-- File: listing_bathrooms.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create bathrooms property/value table

DROP TABLE IF EXISTS listing_bathrooms;

CREATE TABLE listing_bathrooms(
value SMALLINT PRIMARY KEY,
property VARCHAR(2) NOT NULL
);

INSERT INTO listing_bathrooms (value, property) VALUES (1, '1');

INSERT INTO listing_bathrooms (value, property) VALUES (2, '2');

INSERT INTO listing_bathrooms (value, property) VALUES (4, '3');

INSERT INTO listing_bathrooms (value, property) VALUES (8, '4+');


