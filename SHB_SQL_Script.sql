drop database SHB;
create database SHB;
use SHB;
create table products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL, 
    category ENUM('MEN', 'WOMEN', 'CHILDREN') NOT NULL,
    price INT NOT NULL,
    image_link VARCHAR(255),
    purchases INT DEFAULT 0, 
    quantity INT NOT NULL,
    color ENUM('DARK', 'BROWN', 'WHITE') NOT NULL,
    `description` text
);

create table users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(50) NOT NULL,
    phone VARCHAR(10),
    avatar_link VARCHAR(255) DEFAULT 'images/avatarDefault.png',
    province VARCHAR(255),
    district VARCHAR(255),
    detailed_address VARCHAR(255),
    created_date DATETIME NOT NULL
);

create table product_colors (
	id INT AUTO_INCREMENT PRIMARY KEY,
    product_id int,
    color ENUM('DARK', 'BROWN', 'WHITE') NOT NULL,
    image_link varchar(255),
    CONSTRAINT fk_productColors_products FOREIGN KEY (product_id)  REFERENCES products(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dateTime DATETIME,
    total_cost INT,
    description VARCHAR(255),
    method VARCHAR(50),
    province VARCHAR(50),
    district VARCHAR(50),
    detailed_address VARCHAR(255),
    status VARCHAR(50),
    phone VARCHAR(10) NOT NULL,
    fullName VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_payments_users FOREIGN KEY (user_id)  REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255),
    quantity INT,
    unit_price INT,
    size VARCHAR(20),
    product_id INT, 
    product_image_link VARCHAR(255),
    product_color VARCHAR(20),
    payments_id INT, 
    user_id INT, 
    status VARCHAR(255),
    CONSTRAINT fk_orderItems_products FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_orderItems_payments FOREIGN KEY (payments_id) REFERENCES payments(id),
    CONSTRAINT fk_orderItems_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE reviews (
	id INT AUTO_INCREMENT PRIMARY KEY,
    order_items_id INT,
    content TEXT,
    user_id INT,
    CONSTRAINT fk_reviews_orderItems FOREIGN KEY (order_items_id) REFERENCES order_items(id),
    CONSTRAINT fk_reviews_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE review_images (
	id INT AUTO_INCREMENT PRIMARY KEY,
    image_link VARCHAR(255),
    review_id INT,
    CONSTRAINT fk_reviewsImages_review FOREIGN KEY (review_id) REFERENCES reviews(id)
);

INSERT INTO products (product_name, category, price, image_link, purchases, quantity, color)
VALUES
    ('Baggy Jeans', 'MEN', 800000, 'https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 8, 40, 'DARK'),
    ('Oversized knitted midaxi dress with side splits in black', 'WOMEN', 90000, 'https://images.asos-media.com/products/arket-oversized-knitted-midaxi-dress-with-side-splits-in-black/207139601-2?$n_480w$&wid=476&fit=constrain', 12, 25, 'DARK'),
    ('Down puffer long line jacket in burgundy', 'WOMEN', 300000, 'https://images.asos-media.com/products/arket-down-puffer-long-line-jacket-in-burgundy/207542456-2?$n_480w$&wid=476&fit=constrain', 49, 50, 'DARK'),
('Mini King Teddy Crew Pant Set - Black', 'CHILDREN', 500000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-27-24_S6_2_RB4F22_Black_P_RA_AA_09-16-53_57438_PXF.jpg?v=1727726876&width=600&height=900&crop=center', 10, 20, 'DARK'),
    ('Mini Ridah Matching Pant Set - Brown', 'CHILDREN', 250000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/11-30-23Studio6_RA_AA_09-48-33_13_RB3S33_Brown_62195_EH.jpg?v=1701797287&width=600&height=900&crop=center', 5, 15, 'DARK'),
    ('Mini Family Goals Crown Legging - Black', 'CHILDREN', 200000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/11-01-24_S6_20_ZDFNK1247_Black_P_KS_DO_11-26-24_65826_PXF.jpg?v=1730828801&width=400&height=599&crop=center', 7, 30, 'DARK'),
    ('Mini Original Trendsetter II Velour Set - Black', 'CHILDREN', 600000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/08-21-24_S7_14_FSF96091_Black_KT_DO_11-25-08_1166_PXF.jpg?v=1724347624&width=400&height=599&crop=center', 3, 10, 'DARK'),
    ('Logo backprint t-shirt in dark brown', 'MEN', 450000, 'https://images.asos-media.com/products/calvin-klein-jeans-logo-backprint-t-shirt-in-dark-brown-asos-exclusive/207312118-2?$n_480w$&wid=476&fit=constrain', 12, 25, 'DARK'),
    ('Cosy roll neck jumper in brown', 'MEN', 300000, 'https://images.asos-media.com/products/calvin-klein-jeans-cosy-roll-neck-jumper-in-brown-asos-exclusive/207312087-3?$n_320w$&wid=317&fit=constrain', 8, 18,'DARK'),
    ('Label co-ord shirt in navy', 'MEN', 750000, 'https://images.asos-media.com/products/pullbear-black-label-co-ord-shirt-in-navy/207510790-2?$n_480w$&wid=476&fit=constrain', 4, 12, 'DARK'),
    ('Sweater with polo collar in dark brown', 'MEN', 250000, 'https://images.asos-media.com/products/arket-knitted-rib-wool-sweater-with-polo-collar-in-dark-brown/207295474-1-brown?$n_240w$&wid=168&fit=constrain', 6, 20, 'DARK'),
    ('Puffer jacket in blackr', 'MEN', 800000, 'https://images.asos-media.com/products/the-north-face-saikuru-puffer-jacket-in-black/205418444-2?$n_480w$&wid=476&fit=constrain', 9, 14, 'DARK'),
    ('Sweatpants', 'MEN', 950000, 'https://images.asos-media.com/products/asos-design-oversized-tapered-suit-trousers-in-black/207072071-1-black?$n_480w$&wid=476&fit=constrain', 2, 10, 'DARK'),
    ('Cotton sweater', 'MEN', 500000, 'https://images.asos-media.com/products/asos-design-premium-oversized-real-leather-harrington-jacket-in-black/206796551-2?$n_960w$&wid=952&fit=constrain', 70, 30, 'DARK'),
    ('Oversized cropped suit in black', 'MEN', 350000, 'https://i.pinimg.com/236x/1f/a5/6b/1fa56b36b6f1e060aea66e68048f1425.jpg', 15, 75, 'DARK'),
    ('Oversized faux shearling jacket with funnel neck', 'WOMEN', 550000, 'https://images.asos-media.com/products/arket-oversized-faux-shearling-jacket-with-funnel-neck-and-contrast-edging-in-grey/207299014-1-grey?$n_240w$&wid=168&fit=constrain', 7, 18, 'DARK'),
('Knitted semi sheer long sleeve top in dark grey', 'WOMEN', 400000, 'https://images.asos-media.com/products/arket-merino-wool-knitted-semi-sheer-long-sleeve-top-in-dark-grey/207139285-1-darkgrey?$n_750w$&wid=750&fit=constrain', 6, 25 , 'DARK'),
    ('Oversize double breasted coat in black', 'WOMEN', 120000, 'https://images.asos-media.com/products/monki-oversize-double-breasted-coat-in-black/205218378-1-black?$n_750w$&wid=750&fit=constrain', 8, 40, 'DARK'),
    ('Western suede look jacket in brown', 'WOMEN', 350000, 'https://images.asos-media.com/products/mango-tassle-sleeve-western-suede-look-jacket-in-brown/207284761-1-brown?$n_750w$&wid=750&fit=constrain', 3, 12, 'DARK'),
    ('Oversized wool look overcoat in black salt and pepper', 'MEN', 450000, 'https://images.asos-media.com/products/asos-design-oversized-wool-look-overcoat-in-black-salt-and-pepper/206697335-2?$n_480w$&wid=476&fit=constrain', 4, 15, 'DARK'),
    ('Bomber co-ord in blacks', 'WOMEN', 600000, 'https://images.asos-media.com/products/jdy-check-bomber-co-ord-in-black/206938994-1-black?$n_750w$&wid=750&fit=constrain', 6, 18, 'DARK'),
    ('Mini Mad For You Cargo Jeans - Acid Wash Black', 'CHILDREN', 300000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/MiniMadForYouCargoJeans-AcidWashBlack_MER.jpg?v=1704391106&width=400&height=599&crop=center', 8, 25, 'DARK'),
    ('Mini Mock Neck Knit Dress - Black', 'CHILDREN', 200000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-20-23Studio6_RA_AA_15-01-53_57_THRD005_Black_39419_DG.jpg?v=1695836057&width=400&height=599&crop=center', 35, 20, 'DARK'),
    ('Mini The Real Boss Crew Neck Sweatshirt - Black', 'CHILDREN', 50000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/11-19-24_S6_1_F76044_Black_ZSR_AZ_AA_08-47-52_70645_SG.jpg?v=1732063899&width=400&height=599&crop=center', 20, 50, 'DARK'),
    ('Mini Thoughts Of Success Long Sleeve Top - Black', 'CHILDREN', 400000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/10-14-24_S6_18_31556FN_Black_RA_AA_13-15-24_60914_BH.jpg?v=1729026378&width=400&height=599&crop=center', 15, 10, 'DARK'),
    ('Mini New York Cropped Sweatshirt - Taupe/combo', 'CHILDREN', 600000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/MiniNewYorkCroppedSweatshirt-Taupecombo_MERcopy.jpg?v=1702069603&width=400&height=599&crop=center', 41, 74, 'DARK'),
    ('Jacket Black', 'MEN', 600000, 'https://images.asos-media.com/products/asos-design-slouchy-oversized-suit-jacket-in-charcoal-mini-herringbone/206993286-1-charcoal?$n_320w$&wid=317&fit=constrain', 35, 82, 'DARK'),
    ('Regular fit wool look collarless overcoat in black', 'MEN', 500000, 'https://images.asos-media.com/products/asos-design-regular-fit-wool-look-collarless-overcoat-in-black/206586384-1-black?$n_750w$&wid=750&fit=constrain', 15, 46, 'DARK'),
('Quilted velvet puff sleeve smock dress in black', 'WOMEN',680000, 'https://images.asos-media.com/products/asos-design-quilted-velvet-puff-sleeve-smock-dress-in-black/207213685-2?$n_480w$&wid=476&fit=constrain', 17, 39, 'DARK'),
    ('Knitted high neck structured trapeze jumper in navy', 'WOMEN', 300000, 'https://images.asos-media.com/products/asos-design-knitted-high-neck-structured-trapeze-jumper-in-navy/207771742-2?$n_480w$&wid=476&fit=constrain', 9, 34, 'DARK'),
    ('Wool knitted semi sheer long sleeve top in black', 'WOMEN', 250000, 'https://images.asos-media.com/products/arket-merino-wool-knitted-semi-sheer-long-sleeve-top-in-black/207139432-1-black?$n_240w$&wid=168&fit=constrain', 23, 59, 'DARK'),
    ('Mini Rude Bart Simpson Tee - Black', 'CHILDREN', 450000, 'https://cdn.shopify.com/s/files/1/0293/9277/files/MiniRudeBartSimpsonTee-Black_MERcopy.jpg?v=1698428719&width=400&height=599&crop=center', 24, 47, 'DARK');

-- Tắt chế độ Safe Update Mode
SET SQL_SAFE_UPDATES = 0;
UPDATE products
SET description = 'Elevate your wardrobe with our premium fashion apparel, designed for both comfort and style. Crafted from high-quality materials, each piece features modern cuts and timeless elegance, perfect for any occasion. Whether you\'re dressing up or keeping it casual, our collection ensures you look effortlessly chic every day.'
WHERE description IS NULL;
-- Bật lại chế độ Safe Update Mode nếu cần
SET SQL_SAFE_UPDATES = 1;


INSERT INTO users (email, username, password, fullName, phone, avatar_link, province, district, detailed_address, created_date)
VALUES 
('holykimsa05@gmail.com', 'kimsa', MD5('holykimsa@123'), 'Hồ Ly Kim Sa', '0877152961', NULL, NULL, NULL, NULL, '2025-01-01 08:15:00'),
('lekyba2000hc@gmail.com', 'kyba', MD5('123456'), 'Le Ky Ba', '0987654321', NULL, NULL, NULL, NULL, '2025-01-02 08:15:00'),
('alex.taylor@example.com', 'alextaylor', MD5('mypassword789'), 'Alex Taylor', '0112233445', NULL, NULL, NULL, NULL, '2025-01-02 08:15:00'),
('michael.brown@example.com', 'michaelb', MD5('passw0rd123'), 'Michael Brown', '0123451122', NULL, NULL, NULL, NULL, '2025-01-05 08:15:00'),
('emily.davis@example.com', 'emilyd', MD5('1234abcd'), 'Emily Davis', '0987745632', NULL, NULL, NULL, NULL, '2025-01-07 08:15:00'),
('chris.wilson@example.com', 'chrisw', MD5('qwerty789'), 'Chris Wilson', '0178901234', NULL, NULL, NULL, NULL, '2025-01-07 08:15:00'),
('sarah.jones@example.com', 'sarahj', MD5('ilovecoding'), 'Sarah Jones', '0912233445', NULL, NULL, NULL, NULL, '2025-01-08 08:15:00'),
('david.lee@example.com', 'davidl', MD5('passme123'), 'David Lee', '0908877665', NULL, NULL, NULL, NULL, '2025-01-10 08:15:00'),
('laura.martin@example.com', 'lauram', MD5('letmein2023'), 'Laura Martin', '0865543321', NULL, NULL, NULL, NULL, '2025-01-11 08:15:00'),
('kevin.thomas@example.com', 'kevint', MD5('kevinrocks'), 'Kevin Thomas', '0934567890', NULL, NULL, NULL, NULL, '2025-01-13 08:15:00');

-- insert data mẫu cho product details
INSERT INTO product_colors (id, product_id, color, image_link) 
VALUES 
    (NULL, 1, 'WHITE', 'https://images.asos-media.com/products/allsaints-underground-oversized-t-shirt-in-yellow-exclusive-to-asos/206433461-1-yellow?$n_640w$&wid=513&fit=constrain'),
    (NULL, 12, 'BROWN', 'https://images.asos-media.com/products/allsaints-underground-oversized-t-shirt-in-deep-red/206980609-1-winehousered?$n_640w$&wid=513&fit=constrain'),
    (NULL, 3, 'WHITE', 'https://images.asos-media.com/products/vero-moda-kyla-mid-rise-wide-straight-leg-jeans-in-light-blue-wash/205972254-1-lightblue?$n_640w$&wid=513&fit=constrain'),
    (NULL, 4, 'WHITE', 'https://images.asos-media.com/products/collusion-x001-antifit-jeans-in-stone-stone/205997993-1-stone?$n_640w$&wid=513&fit=constrain'),
    (NULL, 14, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-reversable-bomber-jacket-in-brown/206268458-1-green?$n_640w$&wid=513&fit=constrain'),
    (NULL, 1, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-reversable-bomber-jacket-in-brown/206268458-1-green?$n_640w$&wid=513&fit=constrain'),
    (NULL, 3, 'BROWN', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 21, 'BROWN', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 17, 'WHITE', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 21, 'WHITE', 'https://images.asos-media.com/products/topshop-knitted-ultra-fluffy-roll-neck-crop-jumper-in-charcoal/205997232-1-charcoal?$n_640w$&wid=513&fit=constrain'),
    (NULL, 11, 'BROWN', 'https://images.asos-media.com/products/asos-design-relaxed-brushed-knitted-crew-neck-jumper-with-animal-pattern-in-beige/207611607-1-beige?$n_640w$&wid=513&fit=constrain'),
    (NULL, 11, 'WHITE', 'https://images.asos-media.com/products/asos-design-oversized-boxy-fit-knitted-fisherman-rib-jumper-in-beige/207635227-1-beige?$n_640w$&wid=513&fit=constrain'),
    (NULL, 2, 'WHITE', 'https://images.asos-media.com/products/only-roll-neck-jumper-in-light-grey-melange/206796337-1-lightgrey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 13, 'WHITE', 'https://images.asos-media.com/products/asos-design-oversized-boxy-fit-knitted-fisherman-rib-jumper-in-beige/207635227-1-beige?$n_640w$&wid=513&fit=constrain'),
    (NULL, 17, 'BROWN', 'https://images.asos-media.com/products/only-roll-neck-jumper-in-light-grey-melange/206796337-1-lightgrey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 19, 'BROWN', 'https://images.asos-media.com/products/reclaimed-vintage-cable-jumper-in-stone/206506770-1-stone?$n_640w$&wid=513&fit=constrain'),
    (NULL, 19, 'WHITE', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 15, 'WHITE', 'https://images.asos-media.com/products/asos-design-oversized-knitted-jumper-in-stone-and-ecru-stripe/207026915-1-stone?$n_640w$&wid=513&fit=constrain'),
    (NULL, 16, 'WHITE', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 20, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-wool-look-overcoat-in-khaki/206095382-1-khaki?$n_640w$&wid=513&fit=constrain');

INSERT INTO payments (dateTime, total_cost, description, method, province, district, detailed_address, status, phone, fullName, user_id)
VALUES
    ('2025-01-02 10:30:00', 3200000, 'Payment for clothing order', 'Momo', 'Hanoi', 'Cau Giay', '23 Duy Tan Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-02 14:45:00', 900000, 'Payment for jacket', 'COD', 'Ho Chi Minh City', 'District 1', '45 Le Duan Street', 'Pending', '0123456789', 'bá', 2),
    ('2025-01-04 09:15:00', 4500000, 'Payment for children’s wear', 'COD', 'Danang', 'Hai Chau', '56 Tran Phu Street', 'Pending', '0123456789', 'hiền', 3),
    ('2025-01-04 16:00:00', 1800000, 'Payment for sweater', 'Momo', 'Hanoi', 'Dong Da', '78 Nguyen Chi Thanh Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-04 11:20:00', 3200000, 'Payment for coats', 'COD', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Pending', '0123456789', 'Đạt', 5);

INSERT INTO order_items (product_name, quantity, unit_price, size, product_id, product_image_link, product_color, payments_id, user_id, status)
VALUES
    ('Baggy Jeans', 2, 1600000, 'L', 1, 'https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$', 'DARK', 1, 1, 'Shipping'),
    ('Oversized knitted midaxi dress', 1, 900000, 'M', 2, 'https://images.asos-media.com/products/arket-oversized-knitted-midaxi-dress-with-side-splits-in-black/207139601-2?$n_480w$', 'DARK', 1, 1, 'Shipping'),
    ('Mini King Teddy Crew Pant Set', 3, 1500000, 'S', 4, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-27-24_S6_2_RB4F22_Black_P_RA_AA_09-16-53_57438_PXF.jpg', 'DARK', 3, 3, 'Shipping'),
    ('Logo backprint t-shirt', 2, 900000, 'XL', 8, 'https://images.asos-media.com/products/calvin-klein-jeans-logo-backprint-t-shirt-in-dark-brown-asos-exclusive/207312118-2?$n_480w$', 'DARK', 4, 1, 'Delivered'),
    ('Mini Mock Neck Knit Dress', 4, 800000, 'M', 24, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-20-23Studio6_RA_AA_15-01-53_57_THRD005_Black_39419_DG.jpg', 'DARK', 4, 1, 'Delivered');

INSERT INTO reviews (order_items_id, content, user_id)
VALUES
(1, 'Great quality, fits perfectly!', 1),
(1, 'Nice product, but size runs large.', 1),
(1, 'Color slightly different from the image.', 1),
(1, 'Very comfortable, would recommend.', 1),
(1, 'Not worth the price, returned it.', 1);

INSERT INTO review_images (image_link, review_id)
VALUES
('https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 1),
('https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 2),
('https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 3),
('https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 4),
('https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$&wid=952&fit=constrain', 5);

INSERT INTO users (email, username, password, fullName, phone, avatar_link, province, district, detailed_address, created_date)
VALUES
-- Ngày 14/01/2025
('user7@example.com', 'user7', MD5('password7'), 'User Seven', '0900000007', NULL, NULL, NULL, NULL, '2025-01-14 08:45:00'),
('user8@example.com', 'user8', MD5('password8'), 'User Eight', '0900000008', NULL, NULL, NULL, NULL, '2025-01-14 13:50:00'),

-- Ngày 13/01/2025
('user9@example.com', 'user9', MD5('password9'), 'User Nine', '0900000009', NULL, NULL, NULL, NULL, '2025-01-13 10:00:00'),
('user10@example.com', 'user10', MD5('password10'), 'User Ten', '0900000010', NULL, NULL, NULL, NULL, '2025-01-13 15:45:00'),

-- Ngày 12/01/2025
('user11@example.com', 'user11', MD5('password11'), 'User Eleven', '0900000011', NULL, NULL, NULL, NULL, '2025-01-12 09:10:00'),
('user12@example.com', 'user12', MD5('password12'), 'User Twelve', '0900000012', NULL, NULL, NULL, NULL, '2025-01-12 17:30:00'),

-- Ngày 11/01/2025
('user13@example.com', 'user13', MD5('password13'), 'User Thirteen', '0900000013', NULL, NULL, NULL, NULL, '2025-01-11 08:20:00'),
('user14@example.com', 'user14', MD5('password14'), 'User Fourteen', '0900000014', NULL, NULL, NULL, NULL, '2025-01-11 20:00:00'),

-- Ngày 10/01/2025
('user15@example.com', 'user15', MD5('password15'), 'User Fifteen', '0900000015', NULL, NULL, NULL, NULL, '2025-01-10 11:15:00'),
('user16@example.com', 'user16', MD5('password16'), 'User Sixteen', '0900000016', NULL, NULL, NULL, NULL, '2025-01-10 18:45:00'),

-- Một số ngày ngẫu nhiên
('user17@example.com', 'user17', MD5('password17'), 'User Seventeen', '0900000017', NULL, NULL, NULL, NULL, '2025-01-09 09:00:00'),
('user18@example.com', 'user18', MD5('password18'), 'User Eighteen', '0900000018', NULL, NULL, NULL, NULL, '2025-01-08 10:30:00'),
('user19@example.com', 'user19', MD5('password19'), 'User Nineteen', '0900000019', NULL, NULL, NULL, NULL, '2025-01-07 15:00:00'),
('user20@example.com', 'user20', MD5('password20'), 'User Twenty', '0900000020', NULL, NULL, NULL, NULL, '2025-01-06 16:45:00');

-- Insert data để hiển thị chart với hình dạng kim tự tháp
INSERT INTO payments (dateTime, total_cost, description, method, province, district, detailed_address, status, phone, fullName, user_id)
VALUES
    -- Ngày 19-22: ít đơn hàng
    ('2025-01-10 09:00:00', 1200000, 'Payment for casual shirt', 'Momo', 'Hanoi', 'Cau Giay', '23 Duy Tan Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-10 10:00:00', 1500000, 'Payment for shoes', 'COD', 'Ho Chi Minh City', 'District 1', '45 Le Duan Street', 'Paid', '0123456789', 'bá', 2),
    ('2025-01-11 11:00:00', 2200000, 'Payment for pants', 'Momo', 'Danang', 'Hai Chau', '56 Tran Phu Street', 'Paid', '0123456789', 'hiền', 3),

    -- Ngày 23-26: số lượng đơn hàng bắt đầu tăng lên
    ('2025-01-13 13:00:00', 2800000, 'Payment for sweater', 'Momo', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Paid', '0123456789', 'Đạt', 5),
    ('2025-01-13 16:00:00', 3100000, 'Payment for dress', 'COD', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-14 08:30:00', 3300000, 'Payment for shoes', 'Momo', 'Ho Chi Minh City', 'District 2', '56 Nguyen Thi Minh Khai', 'Paid', '0123456789', 'bá', 2),
    ('2025-01-14 11:00:00', 3500000, 'Payment for coat', 'COD', 'Danang', 'Cam Le', '12 Hoang Hoa Tham', 'Paid', '0123456789', 'hiền', 3),
    ('2025-01-15 13:00:00', 4000000, 'Payment for jacket', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-15 16:30:00', 4200000, 'Payment for sweater', 'COD', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Paid', '0123456789', 'Đạt', 5),
    ('2025-01-15 12:00:00', 2500000, 'Payment for jacket', 'COD', 'Hanoi', 'Dong Da', '78 Nguyen Chi Thanh Street', 'Paid', '0123456789', 'nga', 4),

    -- Ngày 26-28: đạt đỉnh cao nhất
    ('2025-01-9 09:00:00', 4500000, 'Payment for pants', 'Momo', 'Hanoi', 'Cau Giay', '23 Duy Tan Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-9 11:30:00', 4700000, 'Payment for shoes', 'COD', 'Danang', 'Hai Chau', '56 Tran Phu Street', 'Paid', '0123456789', 'bá', 2),
    ('2025-01-9 14:00:00', 5000000, 'Payment for jacket', 'Momo', 'Ho Chi Minh City', 'District 2', '56 Nguyen Thi Minh Khai', 'Paid', '0123456789', 'hiền', 3),
    ('2025-01-9 13:30:00', 5200000, 'Payment for sweater', 'COD', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Paid', '0123456789', 'Đạt', 5),
    ('2025-01-9 15:00:30', 5400000, 'Payment for shoes', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-9 15:50:00', 5400000, 'Payment for shoes', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-9 15:00:00', 5400000, 'Payment for shoes', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-9 15:20:00', 5400000, 'Payment for shoes', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-9 15:02:00', 5400000, 'Payment for shoes', 'Momo', 'Hanoi', 'Ba Dinh', '34 Le Hong Phong Street', 'Paid', '0123456789', 'nga', 4),

    -- Ngày 29-31: giảm nhẹ
    ('2025-01-4 12:00:00', 4500000, 'Payment for jacket', 'COD', 'Danang', 'Cam Le', '12 Hoang Hoa Tham', 'Paid', '0123456789', 'hiền', 3),
    ('2025-01-5 14:00:00', 4300000, 'Payment for pants', 'Momo', 'Ho Chi Minh City', 'District 1', '45 Le Duan Street', 'Paid', '0123456789', 'bá', 2),
    ('2025-01-5 11:30:00', 4100000, 'Payment for shoes', 'COD', 'Hanoi', 'Dong Da', '78 Nguyen Chi Thanh Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-6 12:30:00', 4000000, 'Payment for sweater', 'Momo', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Paid', '0123456789', 'Đạt', 5),

    -- Ngày 1-3: giảm dần
    ('2025-01-14 09:00:00', 3900000, 'Payment for coat', 'COD', 'Ho Chi Minh City', 'District 2', '56 Nguyen Thi Minh Khai', 'Paid', '0123456789', 'hiền', 3),
    ('2025-01-14 12:00:00', 3700000, 'Payment for pants', 'Momo', 'Hanoi', 'Cau Giay', '23 Duy Tan Street', 'Paid', '0123456789', 'sa', 1),
    ('2025-01-15 11:00:00', 3600000, 'Payment for shoes', 'COD', 'Danang', 'Hai Chau', '56 Tran Phu Street', 'Paid', '0123456789', 'bá', 2),
    ('2025-01-15 14:30:00', 3400000, 'Payment for sweater', 'Momo', 'Hanoi', 'Dong Da', '78 Nguyen Chi Thanh Street', 'Paid', '0123456789', 'nga', 4),
    ('2025-01-15 10:00:00', 3300000, 'Payment for jacket', 'COD', 'Ho Chi Minh City', 'District 1', '45 Le Duan Street', 'Paid', '0123456789', 'hiền', 3);
