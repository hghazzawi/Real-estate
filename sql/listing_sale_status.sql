-- File: listing_sale_status.sql
-- Author: YOUR NAME
-- Date: THE DATE YOU CREATED THE FILE
-- Description: SQL file to create city property/value table

DROP TABLE IF EXISTS listing_sale_status;

CREATE TABLE listing_sale_status(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO listing_sale_status (value, property) VALUES (1, 'For Sale');

INSERT INTO listing_sale_status (value, property) VALUES (2, 'For Rent');

INSERT INTO listing_sale_status (value, property) VALUES (4, 'Both');

