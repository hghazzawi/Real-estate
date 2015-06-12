CREATE TABLE reports 
(
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
	listing_id INTEGER NOT NULL REFERENCES listings(listing_id),
	reported_on date not null,
	status CHAR(1) not null,
	primary key (user_id,listing_id)
);