-- File: listing_view.sql
-- Author: YOUR NAME
-- Date: THE DATE YOU CREATED THE FILE
-- Description: SQL file to create city property/value table

DROP TABLE IF EXISTS listing_view;

CREATE TABLE listing_view(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO listing_view (value, property) VALUES (1, 'City');

INSERT INTO listing_view (value, property) VALUES (2, 'Mountain');

INSERT INTO listing_view (value, property) VALUES (4, 'Ocean');

INSERT INTO listing_view (value, property) VALUES (8, 'Lake');

INSERT INTO listing_view (value, property) VALUES (16, 'River');

INSERT INTO listing_view (value, property) VALUES (32, 'Ravine');

