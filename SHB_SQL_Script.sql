create database SHB;
use SHB;
create table Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(50),
    phone VARCHAR(10),
    avatar_link VARCHAR(255),
    province VARCHAR(255),
    district VARCHAR(255),
    detailed_address VARCHAR(255)
);