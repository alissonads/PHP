CREATE DATABASE IF NOT EXISTS elvis_store
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE elvis_store;

CREATE TABLE IF NOT EXISTS email_list(
	first_name VARCHAR(30),
    last_name VARCHAR(30),
    email VARCHAR(50) NOT NULL
);

ALTER TABLE email_list 
ADD PRIMARY KEY(email);

DESCRIBE email_list;

select * from email_list;

DELETE FROM email_list WHERE email = 'sally@gregs-list.net' LIMIT 1;