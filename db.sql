DROP DATABASE IF EXISTS myevents;
CREATE DATABASE myevents;
USE myevents;

CREATE TABLE society (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    cp VARCHAR(255) NOT NULL,
    town VARCHAR(255) NOT NULL,
    logo VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    github VARCHAR(255) NOT NULL,
    facebook VARCHAR(255) NOT NULL,
    twitter VARCHAR(255) NOT NULL,
    instagram VARCHAR(255) NOT NULL
);

CREATE TABLE navbar(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(25) NOT NULL,
    link VARCHAR(255) NOT NULL,
    list INT NOT NULL
);

INSERT INTO navbar (text, link, list)
VALUES
('Tu veux du bon son ?', '/', 1),
('Tu veux tout savoir ?', '/olympic/informations', 2),
('Tu veux notre histoire ?', '/olympic/history', 3),
('Tu veux nous contacter ?', '/olympic/contact', 4)
;

CREATE TABLE role(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL
);

INSERT INTO role (role)
VALUES
('SuperAdmin'),
('Admin'),
('User')
;

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    role_id INT NOT NULL
);

INSERT INTO users (email, password, lastname, firstname, role_id)
VALUES
('admin@admin.fr', '$2y$10$Fhv9XSpyrwy9lyMYvU1joOB74jHg1FwDedPu84UU3.GosX/QNWJLG', 'Super', 'Admin', 1)
;

CREATE TABLE event(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    price INT NOT NULL,
    hour TIME NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    video VARCHAR(255) NULL,
    link VARCHAR(255) NULL
);

CREATE TABLE category(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE event_category(
    event_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (event_id)
        REFERENCES event(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
    FOREIGN KEY (category_id)
        REFERENCES category(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE answer(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    message TEXT NULL,
    date_time DATETIME NULL
);

CREATE TABLE comment(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_time DATETIME NOT NULL,
    object VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    answer_id INT NULL,
    FOREIGN KEY (answer_id)
        REFERENCES answer(id)
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE partner(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NULL
);