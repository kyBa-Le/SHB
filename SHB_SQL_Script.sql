create database SHB;
use SHB;
create table Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL, 
    category ENUM('MEN', 'WOMEN', 'BABY') NOT NULL,
    price INT NOT NULL,
    image_link VARCHAR(255),
    purchases INT DEFAULT 0, 
    quantity INT NOT NULL
);
