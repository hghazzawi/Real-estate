-- File: listing_bedrooms.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create bedrooms property/value table

DROP TABLE IF EXISTS listing_bedrooms;

CREATE TABLE listing_bedrooms(
value SMALLINT PRIMARY KEY,
property VARCHAR(2) NOT NULL
);

INSERT INTO listing_bedrooms (value, property) VALUES (1, '1');

INSERT INTO listing_bedrooms (value, property) VALUES (2, '2');

INSERT INTO listing_bedrooms (value, property) VALUES (4, '3');

INSERT INTO listing_bedrooms (value, property) VALUES (8, '4+');
