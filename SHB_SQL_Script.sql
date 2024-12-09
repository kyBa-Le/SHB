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

INSERT INTO Products (product_name, category, price, image_link, purchases, quantity)
VALUES
    ('Jeans', 'MEN', 800000, 'https://i.pinimg.com/236x/b1/f0/d6/b1f0d6cb0adf8cda638cdee3cbba7f7f.jpg', 8, 40),
    ('High neck thermal shirt', 'WOMEN', 90000, 'https://i.pinimg.com/736x/5a/a0/17/5aa0174f30f5f557bea0411332dc2f79.jpg', 12, 25),
    ('Retro High Waist Oversized Wide Leg Jeans', 'WOMEN', 300000, 'https://i.pinimg.com/736x/a0/c8/51/a0c851a575dbfa54db5071a9227e8e97.jpg', 4, 50),
    ('Baby Cotton Set', 'BABY', 500000, 'https://i.pinimg.com/736x/45/ce/6e/45ce6e62c7045b9a160547726c2771e0.jpg', 10, 20),
    ('Baby Suit', 'BABY', 250000, 'https://i.pinimg.com/736x/1b/63/50/1b6350e8aedfd7e76af845c32927b806.jpg', 5, 15),
    ('Casual Dress', 'BABY', 200000, 'https://i.pinimg.com/236x/4a/10/48/4a10483b632cff41b25e6e9f2db33736.jpg', 7, 30),
    ('Elegant Suit', 'BABY', 600000, 'https://i.pinimg.com/236x/c5/86/73/c586732962ec19d4c940bfe48db48218.jpg', 3, 10),
    ('Polo', 'MEN', 450000, 'https://i.pinimg.com/236x/b2/fc/96/b2fc960bc4dd5e76330f75abf8402823.jpg', 12, 25),
    ('Velvet polo shirt', 'MEN', 300000, 'https://i.pinimg.com/236x/56/78/bd/5678bdf9361dffbb932d143b333ff3e2.jpg', 8, 18),
    ('Shirts', 'MEN', 750000, 'https://i.pinimg.com/236x/e1/3c/39/e13c390d31d051ad0ff0623d0e7f260b.jpg', 4, 12),
    ('Short sleeve sweater', 'MEN', 250000, 'https://i.pinimg.com/236x/74/d5/7a/74d57a8b730ab7ec6b08669cf18a200a.jpg', 6, 20),
    ('Sweater', 'MEN', 800000, 'https://i.pinimg.com/236x/10/c1/e4/10c1e46e63f9c41b0ebb469264727a44.jpg', 9, 14),
    ('Sweatpants', 'MEN', 950000, 'https://i.pinimg.com/236x/cb/5e/71/cb5e716a61bf9d4bce93872de0e269c4.jpg', 2, 10),
    ('Cotton sweater', 'MEN', 500000, 'https://i.pinimg.com/236x/1f/a5/6b/1fa56b36b6f1e060aea66e68048f1425.jpg', 10, 30),
    ('Cardigan', 'WOMEN', 350000, 'https://i.pinimg.com/736x/1b/20/2f/1b202fa37f31a806fc8c573c62e5fde6.jpg', 5, 15),
    ('Wool croptopvair tops', 'WOMEN', 550000, 'https://i.pinimg.com/236x/45/2c/49/452c49b599d1553a8fa8cb545ff5aa31.jpg', 7, 18),
    ('Short Suit Set', 'WOMEN', 400000, 'https://i.pinimg.com/236x/ed/dc/58/eddc584a9d87ec88e0b718417d27140b.jpg', 6, 25),
    ('Casual Dress', 'WOMEN', 120000, 'https://i.pinimg.com/236x/4a/e7/9f/4ae79f8677763c027a1c680d370c391f.jpg', 8, 40),
    ('Little Flower Skirt', 'WOMEN', 350000, 'https://i.pinimg.com/236x/28/21/50/2821500c3f2cd24cf80e964c38743539.jpg', 3, 12),
    ('Checkered shirt', 'MEN', 450000, 'https://i.pinimg.com/236x/ec/f7/4a/ecf74a814459f55510bbf2b52bc54b61.jpg', 4, 15),
    ('Khaki shorts', 'WOMEN', 600000, 'https://i.pinimg.com/474x/e0/46/d9/e046d91989d26df83470374a84967185.jpg', 6, 18),
    ('Christmas Dresses', 'BABY', 300000, 'https://i.pinimg.com/736x/37/f8/96/37f896dbea6ae024434ccf064ae26d4e.jpg', 8, 25),
    ('Babydoll Set for Girls', 'BABY', 200000, 'https://i.pinimg.com/474x/83/df/c4/83dfc49fd2fdb5ec530e6ae928e933a7.jpg', 10, 20),
    ('Sportswear set for boys', 'BABY', 50000, 'https://i.pinimg.com/236x/aa/1f/c3/aa1fc34cf1810594f5b12c1653ec7ff8.jpg', 20, 50),
    ('Cotton clothing set for boys', 'BABY', 400000, 'https://i.pinimg.com/236x/84/3a/58/843a58fddac726565392fb88e846b491.jpg', 15, 10),
    ('Felt set for boys', 'BABY', 600000, 'https://i.pinimg.com/236x/4a/62/af/4a62af46d307a20b2483af50555a916e.jpg', 41, 74),
    ('Jean jacket', 'MEN', 600000, 'https://i.pinimg.com/236x/6a/a0/9a/6aa09a3b535f6b50c84e05baeb878f79.jpg', 35, 82),
    ('Bomber', 'MEN', 500000, 'https://i.pinimg.com/736x/91/4f/fe/914ffe951dd40dc37079dc12bfd64f28.jpg', 15, 46),
    ('Gile', 'WOMEN',680000, 'https://i.pinimg.com/736x/c8/b0/25/c8b0257de70106db9b2d4363da6c89db.jpg', 17, 39),
    ('Women jogger pants', 'WOMEN', 300000, 'https://i.pinimg.com/236x/0d/d2/2b/0dd22bc7bb9de90c652b9e4f3a8cb71a.jpg', 9, 34),
    ('Striped shirt', 'WOMEN', 250000, 'https://i.pinimg.com/736x/c4/e7/5c/c4e75cf21819f631112f073598ed8daf.jpg', 23, 59),
    ('Jeans Overalls Oversized', 'BABY', 450000, 'https://i.pinimg.com/736x/22/3f/6e/223f6eea1c2ce949cce3719cf1a927c2.jpg', 24, 47);
