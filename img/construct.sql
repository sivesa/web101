CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    password text NOT NULL,
);
