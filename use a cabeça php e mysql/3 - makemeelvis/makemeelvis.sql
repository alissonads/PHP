CREATE DATABASE IF NOT EXISTS elvis_store
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE elvis_store;

CREATE TABLE IF NOT EXISTS email_list(
	first_name VARCHAR(30),
    last_name VARCHAR(30),
    email VARCHAR(50) NOT NULL UNIQUE
) DEFAULT CHARSET = utf8;

DROP TABLE email_list;

ALTER TABLE email_list 
ADD id INT NOT NULL AUTO_INCREMENT FIRST, 
ADD PRIMARY KEY(id);

DESCRIBE email_list;

select * from email_list;

DELETE FROM email_list WHERE email = 'sally@gregs-list.net' LIMIT 1;