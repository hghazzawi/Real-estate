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
