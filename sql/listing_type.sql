-- File: listing_type.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create type property/value table

DROP TABLE IF EXISTS listing_type;

CREATE TABLE listing_type(
value SMALLINT PRIMARY KEY,
property VARCHAR(50) NOT NULL
);

INSERT INTO listing_type (value, property) VALUES (1, 'House');

INSERT INTO listing_type (value, property) VALUES (2, 'TownHouse');

INSERT INTO listing_type (value, property) VALUES (4, 'Apartment');

INSERT INTO listing_type (value, property) VALUES (8, 'Duplex');

INSERT INTO listing_type (value, property) VALUES (16, 'Triplex');

INSERT INTO listing_type (value, property) VALUES (32, 'Residential Commercial');

INSERT INTO listing_type (value, property) VALUES (64, 'Garden Home');
