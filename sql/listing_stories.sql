-- File: listing_stories.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create stories property/value table

DROP TABLE IF EXISTS listing_stories;

CREATE TABLE listing_stories(
value SMALLINT PRIMARY KEY,
property VARCHAR(2) NOT NULL
);

INSERT INTO listing_stories (value, property) VALUES (1, '1');

INSERT INTO listing_stories (value, property) VALUES (2, '2');

INSERT INTO listing_stories (value, property) VALUES (4, '3');

INSERT INTO listing_stories (value, property) VALUES (8, '4+');
