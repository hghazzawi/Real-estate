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