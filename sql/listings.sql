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
	city INTEGER NOT NULL,
	postal_code CHAR(6) NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	province CHAR(2) NOT NULL,
	property_options INTEGER NOT NULL,
	bedrooms INTEGER NOT NULL,
	bathrooms INTEGER NOT NULL,
	listing_type INTEGER NOT NULL,
	listing_stories INTEGER NOT NULL,
	listing_material SMALLINT NOT NULL DEFAULT 0,
	listing_date DATE NOT NULL,
	listing_view SMALLINT NOT NULL DEFAULT 0,
	listing_sale_status SMALLINT NOT NULL DEFAULT 0

);


