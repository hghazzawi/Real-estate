-- File: user_type.sql
-- Author: Hasan Ghazzawi
-- Date: 18/10/2014
-- Description: SQL file to create user type property/value table

DROP TABLE IF EXISTS user_type;

CREATE TABLE user_type(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO user_type(value, property) VALUES ('p', 'Agent');

INSERT INTO user_type(value, property) VALUES ('c', 'Client');

