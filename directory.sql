CREATE DATABASE directory;

USE directory;

CREATE TABLE address (
    id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255),
    house_number INT,
    suburb VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    country VARCHAR(255),
    postal_code INT
);

CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_name VARCHAR(255),
    last_name VARCHAR(255),
    phone INT,
    lada INT,
    address_id INT,
    FOREIGN KEY (address_id) REFERENCES address(id)
); 