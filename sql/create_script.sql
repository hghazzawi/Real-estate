drop schema public cascade;
create schema public;

drop table if exists users;

create table users (
	user_id varchar(20) primary key,
	password varchar(32) not null,
	user_type char (1) not null,
	email_address varchar(256) not null,
	enrol_date date not null,
	last_access date not null
	);
	
insert into users(user_id,password,user_type,email_address,enrol_date,last_access)
values(
	'hghazzawi',
	'12345678',
	's',
	'name@gmail.com',
	'12/9/2014',
	'12/9/2014'
	);
	
insert into users(user_id,password,user_type,email_address,enrol_date,last_access)
values(
	'michaelj',
	'12345678',
	'd',
	'name@gmail.com',
	'12/9/2014',
	'12/9/2014'
	);	
	
insert into users(user_id,password,user_type,email_address,enrol_date,last_access)
values(
	'jestaris',
	'12345678',
	'c',
	'name@gmail.com',
	'12/9/2014',
	'12/9/2014'
	);
	
insert into users(user_id,password,user_type,email_address,enrol_date,last_access)
values(
	'jamesd',
	'12345678',
	'a',
	'name@gmail.com',
	'12/9/2014',
	'12/9/2014'
	);
	
insert into users(user_id,password,user_type,email_address,enrol_date,last_access)
values(
	'hollym',
	'12345678',
	'p',
	'name@gmail.com',
	'12/9/2014',
	'12/9/2014'
	);
	
drop table if exists people;

CREATE TABLE people (
	
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	salutation VARCHAR(10),
	first_name VARCHAR(25) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	street_address_1 VARCHAR(75) ,
	street_address_2 VARCHAR(75) ,
	city VARCHAR(75) ,
	province VARCHAR(2) ,
	postal_code VARCHAR(6) ,
	primary_phone_number VARCHAR(15) NOT NULL,
	secondary_phone_number VARCHAR(10) ,
	fax_number VARCHAR(10) ,
	preffered_contact_method CHAR(1) NOT NULL
	
);

insert into people(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)
	values(
			'hghazzawi',
			'Mr',
			'Hasan',
			'Ghazzawi',
			'598 front st',
			'Oshawa',
			'ON',
			'L1H3NH',
			'2899285412',
			'e'
	);
	
insert into people(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)
	values(
			'jamesd',
			'Mr',
			'James',
			'Daniels',
			'111 name st',
			'Oshawa',
			'ON',
			'L1J4V4',
			'2895215412',
			'e'
	);
	
insert into people(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)
	values(
			'jestaris',
			'Mr',
			'Justin',
			'Estaris',
			'111 name st',
			'Oshawa',
			'ON',
			'L1J4V4',
			'2895215412',
			'l'
	);

insert into people(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)
	values(
			'hollym',
			'Ms',
			'Holly',
			'Martin',
			'111 name st',
			'Oshawa',
			'ON',
			'L1J4V4',
			'2895215412',
			'p'
	);
	
insert into people(user_id,salutation,first_name,last_name,street_address_1,city,province,postal_code,primary_phone_number,preffered_contact_method)
	values(
			'michaelj',
			'Mr',
			'Michael',
			'Jackson',
			'111 name st',
			'Oshawa',
			'ON',
			'L1J4V4',
			'2895215412',
			'p'
	);


DROP TABLE IF EXISTS salutations;

CREATE TABLE salutations(
	value CHAR(6)
);

INSERT INTO salutations VALUES ('Mr');
INSERT INTO salutations VALUES ('Mrs');
INSERT INTO salutations VALUES ('Miss');
INSERT INTO salutations VALUES ('Ms');

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

-- File: listing_status.sql
-- Author: Hasan Ghazzawi
-- Date: 17/10/2014
-- Description: SQL file to create listing status property/value table

DROP TABLE IF EXISTS listing_status;

CREATE TABLE listing_status(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO listing_status(value, property) VALUES ('o', 'Open');

INSERT INTO listing_status(value, property) VALUES ('c', 'Closed');

INSERT INTO listing_status(value, property) VALUES ('s', 'Sold');

INSERT INTO listing_status(value, property) VALUES ('h', 'Hidden');

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

drop sequence if exists listing_id_seq;
create sequence listing_id_seq;
select setval('listing_id_seq', 10000);


CREATE TABLE listings(

	listing_id INTEGER PRIMARY KEY DEFAULT NEXTVAL('listing_id_seq'),
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	status CHAR(1) NOT NULL,
	price NUMERIC NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code CHAR(6) NOT NULL,
	province CHAR(2) NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	city INTEGER NOT NULL,
	property_options INTEGER NOT NULL,
	bedrooms INTEGER NOT NULL,
	bathrooms INTEGER NOT NULL,
	listing_type INTEGER NOT NULL,
	listing_stories INTEGER NOT NULL,
	listing_date DATE NOT NULL,
	listing_view SMALLINT NOT NULL DEFAULT 0,
	listing_material SMALLINT NOT NULL DEFAULT 0,
	listing_sale_status SMALLINT NOT NULL DEFAULT 0

);



-- File: property_options.sql
-- Author: YOUR NAME
-- Date: THE DATE YOU CREATED THE FILE
-- Description: SQL file to create property_options property/value table

DROP TABLE IF EXISTS property_options;

CREATE TABLE property_options(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO property_options (value, property) VALUES (1, 'Garage');

INSERT INTO property_options (value, property) VALUES (2, 'AC');

INSERT INTO property_options (value, property) VALUES (4, 'Pool');

INSERT INTO property_options (value, property) VALUES (8, 'Acreage');

INSERT INTO property_options (value, property) VALUES (16, 'Waterfront');


DROP TABLE IF EXISTS preferred_contact_method;

CREATE TABLE preferred_contact_method (
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO preferred_contact_method  (value, property) VALUES ('e', 'Email');

INSERT INTO preferred_contact_method  (value, property) VALUES ('l', 'Letter Post');

INSERT INTO preferred_contact_method  (value, property) VALUES ('p', 'Phone');


DROP TABLE IF EXISTS provinces;

CREATE TABLE provinces(
	value CHAR(2)
);

INSERT INTO provinces VALUES ('AB');
INSERT INTO provinces VALUES ('BC');
INSERT INTO provinces VALUES ('MB');
INSERT INTO provinces VALUES ('NB');
INSERT INTO provinces VALUES ('NF');
INSERT INTO provinces VALUES ('NS');
INSERT INTO provinces VALUES ('NT');
INSERT INTO provinces VALUES ('NU');
INSERT INTO provinces VALUES ('ON');
INSERT INTO provinces VALUES ('PE');
INSERT INTO provinces VALUES ('PQ');
INSERT INTO provinces VALUES ('SK');
INSERT INTO provinces VALUES ('YT');

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

