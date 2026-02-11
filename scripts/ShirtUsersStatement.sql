SHOW DATABASES;

CREATE DATABASE shirt;

SHOW CREATE DATABASE shirt;

CREATE USER 'shirt_user'@'localhost'
IDENTIFIED BY 'Shirt123!';

-- DROP USER 'shirt_user'@'localhost';

GRANT SELECT, UPDATE, INSERT, DELETE
ON shirt.*
TO 'shirt_user'@'localhost';

SHOW GRANTS FOR 'shirt_user'@'localhost';

USE shirt;

CREATE TABLE shirt_users (
    shirt_user_id INT NOT NULL AUTO_INCREMENT,
    email_address VARCHAR(255) NOT NULL UNIQUE,
    password CHAR(64) NOT NULL,
    pronouns VARCHAR(60) NOT NULL,
    first_name VARCHAR(60) NOT NULL,
    last_name VARCHAR(60) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    date_time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_time_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (shirt_user_id)
);

SHOW TABLES;

SHOW CREATE TABLE shirt_users;

DESCRIBE shirt_users;

INSERT INTO shirt_users
(email_address, password, pronouns, first_name, last_name, phone_number)
VALUES
('taylor@shirts.com', SHA2('myLongP@ssword', 256), 'She/Her', 'Taylor', 'Swift', '555-1234');

SELECT * FROM shirt_users;

-- Taylor Swift's Lead Shirt Designer
INSERT INTO shirt_users
(email_address, password, pronouns, first_name, last_name, phone_number)
VALUES
('paul@shirts.com', SHA2('myLongP@ssword', 256), 'He/Him', 'Paul', 'Sidoti', '555-5678');

-- Third user (required)
INSERT INTO shirt_users
(email_address, password, pronouns, first_name, last_name, phone_number)
VALUES
('alex@shirts.com', SHA2('myLongP@ssword', 256), 'They/Them', 'Alex', 'Rivera', '555-9012');