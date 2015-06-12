DROP TABLE IF EXISTS preferred_contact_method;

CREATE TABLE preferred_contact_method (
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO preferred_contact_method  (value, property) VALUES ('e', 'Email');

INSERT INTO preferred_contact_method  (value, property) VALUES ('l', 'Letter Post');

INSERT INTO preferred_contact_method  (value, property) VALUES ('p', 'Phone');


