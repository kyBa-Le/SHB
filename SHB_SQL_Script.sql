(NULL, 15, 'WHITE', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 16, 'BROWN', 'https://images.asos-media.com/products/monki-knitted-turtleneck-sweater-in-beige-melange/206875726-1-beigemelange?$n_640w$&wid=513&fit=constrain'),
    (NULL, 20, 'BROWN', 'https://images.asos-media.com/products/asos-design-oversized-wool-look-overcoat-in-khaki/206095382-1-khaki?$n_640w$&wid=513&fit=constrain');

INSERT INTO Payments (dateTime, total_cost, description, method, province, district, detailed_address, status, phone, fullName, user_id)
VALUES
    ('2024-12-15 10:30:00', 3200000, 'Payment for clothing order', 'Momo', 'Hanoi', 'Cau Giay', '23 Duy Tan Street', 'Paid', '0123456789', 'sa', 1),
    ('2024-12-16 14:45:00', 900000, 'Payment for jacket', 'COD', 'Ho Chi Minh City', 'District 1', '45 Le Duan Street', 'Pending', '0123456789', 'bá', 2),
    ('2024-12-18 09:15:00', 4500000, 'Payment for children’s wear', 'COD', 'Danang', 'Hai Chau', '56 Tran Phu Street', 'Pending', '0123456789', 'hiền', 3),
    ('2024-12-19 16:00:00', 1800000, 'Payment for sweater', 'Momo', 'Hanoi', 'Dong Da', '78 Nguyen Chi Thanh Street', 'Paid', '0123456789', 'nga', 4),
    ('2024-12-20 11:20:00', 3200000, 'Payment for coats', 'COD', 'Hue', 'Phu Nhuan', '12 Hung Vuong Street', 'Pending', '0123456789', 'Đạt', 5);

INSERT INTO Order_items (product_name, quantity, unit_price, size, product_id, product_image_link, product_color, payments_id, user_id, status)
VALUES
    ('Baggy Jeans', 2, 1600000, 'L', 1, 'https://images.asos-media.com/products/asos-design-super-baggy-jean-in-light-wash-blue/207091945-2?$n_960w$', 'DARK', 1, 1, 'Shipping'),
    ('Oversized knitted midaxi dress', 1, 900000, 'M', 2, 'https://images.asos-media.com/products/arket-oversized-knitted-midaxi-dress-with-side-splits-in-black/207139601-2?$n_480w$', 'DARK', 1, 1, 'Shipping'),
    ('Mini King Teddy Crew Pant Set', 3, 1500000, 'S', 4, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-27-24_S6_2_RB4F22_Black_P_RA_AA_09-16-53_57438_PXF.jpg', 'DARK', 3, 3, 'Shipping'),
    ('Logo backprint t-shirt', 2, 900000, 'XL', 8, 'https://images.asos-media.com/products/calvin-klein-jeans-logo-backprint-t-shirt-in-dark-brown-asos-exclusive/207312118-2?$n_480w$', 'DARK', 4, 4, 'Delivered'),
    ('Mini Mock Neck Knit Dress', 4, 800000, 'M', 24, 'https://cdn.shopify.com/s/files/1/0293/9277/files/09-20-23Studio6_RA_AA_15-01-53_57_THRD005_Black_39419_DG.jpg', 'DARK', 4, 4, 'Delivered');