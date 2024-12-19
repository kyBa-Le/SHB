drop database SHB;
create database SHB;
use SHB;
create table Products (
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

create table Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(50) NOT NULL,
    phone VARCHAR(10),
    avatar_link VARCHAR(255),
    province VARCHAR(255),
    district VARCHAR(255),
    detailed_address VARCHAR(255)
);

create table Product_colors (
	id INT AUTO_INCREMENT PRIMARY KEY,
    product_id int,
    color ENUM('DARK', 'BROWN', 'WHITE') NOT NULL,
    image_link varchar(255),
    CONSTRAINT fk_productColors_products FOREIGN KEY (product_id)  REFERENCES products(id)
);

INSERT INTO Products (product_name, category, price, image_link, purchases, quantity, color)
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


INSERT INTO Users (email, username, password, fullName, phone, avatar_link, province, district, detailed_address)
VALUES 
('holykimsa05@gmail.com', 'kimsa', MD5('holykimsa@123'), 'Hồ Ly Kim Sa', '0877152961', NULL, NULL, NULL, NULL),
('jane.smith@example.com', 'janesmith', MD5('securepass456'), 'Jane Smith', '0987654321', NULL, NULL, NULL, NULL),
('alex.taylor@example.com', 'alextaylor', MD5('mypassword789'), 'Alex Taylor', '0112233445', NULL, NULL, NULL, NULL),
('michael.brown@example.com', 'michaelb', MD5('passw0rd123'), 'Michael Brown', '0123451122', NULL, NULL, NULL, NULL),
('emily.davis@example.com', 'emilyd', MD5('1234abcd'), 'Emily Davis', '0987745632', NULL, NULL, NULL, NULL),
('chris.wilson@example.com', 'chrisw', MD5('qwerty789'), 'Chris Wilson', '0178901234', NULL, NULL, NULL, NULL),
('sarah.jones@example.com', 'sarahj', MD5('ilovecoding'), 'Sarah Jones', '0912233445', NULL, NULL, NULL, NULL),
('david.lee@example.com', 'davidl', MD5('passme123'), 'David Lee', '0908877665', NULL, NULL, NULL, NULL),
('laura.martin@example.com', 'lauram', MD5('letmein2023'), 'Laura Martin', '0865543321', NULL, NULL, NULL, NULL),
('kevin.thomas@example.com', 'kevint', MD5('kevinrocks'), 'Kevin Thomas', '0934567890', NULL, NULL, NULL, NULL);

-- insert data mẫu cho product details
INSERT INTO Product_colors (id, product_id, color, image_link) 
VALUES 
    (NULL, 1, 'WHITE', 'https://images.asos-media.com/products/allsaints-underground-oversized-t-shirt-in-yellow-exclusive-to-asos/206433461-1-yellow?$n_640w$&wid=513&fit=constrain'),
    (NULL, 2, 'BROWN', 'https://images.asos-media.com/products/allsaints-underground-oversized-t-shirt-in-deep-red/206980609-1-winehousered?$n_640w$&wid=513&fit=constrain'),
    (NULL, 3, 'BROWN', 'https://images.asos-media.com/products/vero-moda-kyla-mid-rise-wide-straight-leg-jeans-in-light-blue-wash/205972254-1-lightblue?$n_640w$&wid=513&fit=constrain'),
    (NULL, 4, 'WHITE', 'https://images.asos-media.com/products/collusion-x001-antifit-jeans-in-stone-stone/205997993-1-stone?$n_640w$&wid=513&fit=constrain'),
    (NULL, 5, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-reversable-bomber-jacket-in-brown/206268458-1-green?$n_640w$&wid=513&fit=constrain'),
    (NULL, 6, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-reversable-bomber-jacket-in-brown/206268458-1-green?$n_640w$&wid=513&fit=constrain'),
    (NULL, 7, 'WHITE', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 10, 'BROWN', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 9, 'WHITE', 'https://images.asos-media.com/products/topshop-knitted-cut-out-asymmetric-funnel-oversized-jumper-in-grey/206872273-1-grey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 10, 'BROWN', 'https://images.asos-media.com/products/topshop-knitted-ultra-fluffy-roll-neck-crop-jumper-in-charcoal/205997232-1-charcoal?$n_640w$&wid=513&fit=constrain'),
    (NULL, 11, 'BROWN', 'https://images.asos-media.com/products/topshop-knitted-ultra-fluffy-roll-neck-crop-jumper-in-charcoal/205997232-1-charcoal?$n_640w$&wid=513&fit=constrain'),
    (NULL, 11, 'WHITE', 'https://images.asos-media.com/products/topshop-knitted-ultra-fluffy-roll-neck-crop-jumper-in-charcoal/205997232-1-charcoal?$n_640w$&wid=513&fit=constrain'),
    (NULL, 12, 'WHITE', 'https://images.asos-media.com/products/only-roll-neck-jumper-in-light-grey-melange/206796337-1-lightgrey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 13, 'WHITE', 'https://images.asos-media.com/products/only-roll-neck-jumper-in-light-grey-melange/206796337-1-lightgrey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 9, 'BROWN', 'https://images.asos-media.com/products/only-roll-neck-jumper-in-light-grey-melange/206796337-1-lightgrey?$n_640w$&wid=513&fit=constrain'),
    (NULL, 14, 'BROWN', 'https://images.asos-media.com/products/reclaimed-vintage-cable-jumper-in-stone/206506770-1-stone?$n_640w$&wid=513&fit=constrain'),
    (NULL, 14, 'WHITE', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 15, 'WHITE', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 16, 'BROWN', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 20, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-wool-look-overcoat-in-khaki/206095382-1-khaki?$n_640w$&wid=513&fit=constrain');
