UPDATE `#__jshopping_config` SET
`count_category_to_row`='2',
`product_list_display_extra_fields`='a:2:{i:0;s:1:"1";i:1;s:1:"2";}',
`allow_reviews_prod`='1',
`show_buy_in_category`='1',
`show_tax_in_product`='1',
`show_plus_shipping_in_product`='1',
`show_delivery_time`='1',
`demo_type`='1',
`product_show_weight`='1',
`admin_show_product_basic_price`='1',
`admin_show_attributes`='1',
`admin_show_delivery_time`='1',
`admin_show_product_video`='1',
`admin_show_product_labels`='1',
`product_list_show_weight`='1',
`product_list_show_manufacturer`='1',
`show_product_code`='1',
`admin_show_product_extra_field`='1',
`admin_show_freeattributes`='1',
`use_extend_attribute_data`='1';

INSERT INTO `#__jshopping_attr` (`attr_id`, `attr_ordering`, `attr_type`, `independent`, `name_en-GB`) VALUES
(1, 1, 1, 1, 'Color'),
(2, 2, 1, 1, 'Size');

ALTER TABLE `#__jshopping_products_attr` ADD `attr_1` INT( 11 ) NOT NULL;
ALTER TABLE `#__jshopping_products_attr` ADD `attr_2` INT( 11 ) NOT NULL;

INSERT INTO `#__jshopping_attr_values` (`value_id`, `attr_id`, `value_ordering`, `image`, `name_en-GB`) VALUES
(1, 1, 1, '5f1fe7106367b7dda40517995e73bcf8.jpg', 'Blue'),
(2, 1, 2, 'fc69a97cdc8fa3e586eda044c16249d4.jpg', 'Red'),
(3, 2, 1, '', 'S'),
(4, 2, 2, '', 'M');


INSERT INTO `#__jshopping_categories` (`category_id`, `category_image`, `category_parent_id`, `category_publish`, `category_ordertype`, `category_template`, `ordering`, `category_add_date`, `products_page`, `products_row`, `access`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`) VALUES
(1, '339ba546165dd04207dbe5e26a82f5a7.jpg', 0, 1, 1, NULL, 1, '2011-12-26 11:34:04', 12, 3, 1, 'Cars', 'cars', '(E90) (2005–present) Sedan, coupe, convertiblen and wagon', '', '', '', ''),
(2, 'f842229beea322fc8d52f5f12639d90f.jpg', 0, 1, 1, NULL, 2, '2011-12-26 11:57:39', 12, 3, 1, 'Motorbike', 'motorbike', '(2004–present) Bikes', '', '', '', ''),
(3, NULL, 2, 1, 1, NULL, 1, '2011-12-26 12:00:38', 12, 3, 1, '2010', '2010', '2010 year bikes', '', '', '', ''),
(4, NULL, 2, 1, 1, NULL, 2, '2011-12-26 12:00:58', 12, 3, 1, '2011', '2011', '2011 year bikes', '', '', '', ''),
(5, NULL, 3, 1, 1, NULL, 1, '2011-12-26 12:06:03', 12, 3, 1, 'Big bike', 'bigbike', '', '', '', '', ''),
(6, NULL, 3, 1, 1, NULL, 2, '2011-12-26 12:06:21', 12, 3, 1, 'Small Bike', 'smallbike', '', '', '', '', ''),
(7, '913703c2c6b7c44fabfba9fc955ca13e.jpg', 0, 1, 1, NULL, 3, '2011-12-26 12:14:05', 12, 3, 1, 'Music & Video', 'music-video', '(F10)(2010–present) audio', '', '', '', ''),
(8, 'e2ed1ef494b1fc781bdccb917501a2f7.jpg', 0, 1, 1, NULL, 4, '2011-12-26 12:18:51', 12, 3, 1, 'Water', 'water', 'Water', '<h1>Water</h1>', '', '', '');



INSERT INTO `#__jshopping_delivery_times` (`id`, `name_en-GB`) VALUES
(1, '2-5 days'),
(2, '5-10 days');


INSERT INTO `#__jshopping_free_attr` (`id`, `ordering`, `required`, `type`, `name_en-GB`) VALUES
(1, 1, 0, 0, 'Label');




INSERT INTO `#__jshopping_manufacturers` (`manufacturer_id`, `manufacturer_url`, `manufacturer_logo`, `manufacturer_publish`, `products_page`, `products_row`, `ordering`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`) VALUES
(1, '', '', 1, 12, 3, 1, 'New York factory', '', '', '', '', '', ''),
(2, '', '', 1, 12, 3, 2, 'Gvadelupa factory', '', '', '', '', '', '');


ALTER TABLE `#__jshopping_products` ADD `extra_field_1` TEXT NOT NULL;
ALTER TABLE `#__jshopping_products` ADD `extra_field_2` TEXT NOT NULL;


INSERT INTO `#__jshopping_products` (`product_id`, `parent_id`, `product_ean`, `product_quantity`, `unlimited`, `product_availability`, `product_date_added`, `date_modify`, `product_publish`, `product_tax_id`, `currency_id`, `product_template`, `product_url`, `product_old_price`, `product_buy_price`, `product_price`, `min_price`, `different_prices`, `product_weight`, `product_thumb_image`, `product_name_image`, `product_full_image`, `product_manufacturer_id`, `product_is_add_price`, `average_rating`, `reviews_count`, `delivery_times_id`, `hits`, `weight_volume_units`, `basic_price_unit_id`, `label_id`, `vendor_id`, `access`, `name_en-GB`, `alias_en-GB`, `short_description_en-GB`, `description_en-GB`, `meta_title_en-GB`, `meta_description_en-GB`, `meta_keyword_en-GB`, `extra_field_1`, `extra_field_2`) VALUES
(1, 0, 'xt00100', 120, 0, '', '2011-12-26 12:35:39', '2011-12-26 13:12:10', 1, 1, 1, 'default', '', 0.00, 0.00, 47.60, 47.60, 1, 1120.0000, 'thumb_9fedd69376f8f6f7e7e6c4908aa562a5.jpg', '9fedd69376f8f6f7e7e6c4908aa562a5.jpg', 'full_9fedd69376f8f6f7e7e6c4908aa562a5.jpg', 1, 0, 0.00, 0, 0, 9, 0.0000, 0, 0, 0, 1, 'Convertible', 'convertible', 'The 3 Series convertible, for the first time, is available with a 3-piece folding aluminum hardtop roof.', '<p>The 3 Series convertible, for the first time, is available with a 3-piece folding aluminum hardtop  roof. The new convertible is also the center of many new technological advancements for BMW as well as the recipient of many existing safety and performance technologies that have been improved upon for the new model. The new 3 Series convertible improves upon BMW''s "Comfort Access" option, by allowing the user to completely raise and lower the folding roof by simply pressing and holding the respective buttons on the key fob.</p>', '', '', '', '4', '165'),
(2, 0, 'xt00102', 10000, 0, '', '2011-12-26 13:22:48', '2011-12-26 15:31:16', 1, 1, 1, 'default', '', 0.00, 0.00, 117.30, 103.96, 1, 9.0000, 'thumb_67c57c86a9a4a36c2219240c36d56436.jpg', '67c57c86a9a4a36c2219240c36d56436.jpg', 'full_67c57c86a9a4a36c2219240c36d56436.jpg', 1, 1, 8.50, 3, 0, 13, 0.0000, 0, 0, 0, 1, 'Coupe', 'coupe', 'The two-door iteration of the 3-Series became available in August 2006 and premiered as a 2007 model.', '<p>The two-door iteration of the 3-Series became available in August 2006 and premiered as a 2007 model. It is the second BMW coupe offered with BMW xDrive, BMW''s moniker for all-wheel-drive, after the 325ix of the late ''80s and early ''90s. The coupe''s body is its own design and no longer derived from the saloon with two less doors like its predecessors, being longer and narrower than the E90 counterpart.</p>', '', '', '', '3', '120'),
(3, 0, '9781741105704', 12000, 0, '', '2011-12-26 15:38:54', '2011-12-26 16:10:07', 1, 1, 1, 'default', '', 856.00, 0.00, 47.60, 40.46, 1, 1500.0000, 'thumb_34e8560c8f5168fca957249ee1155744.jpg', '34e8560c8f5168fca957249ee1155744.jpg', 'full_34e8560c8f5168fca957249ee1155744.jpg', 2, 1, 6.33, 3, 0, 4, 0.0000, 0, 2, 0, 1, 'Saloon (E90)', 'saloon-e90', 'The saloon (sedan) model of the 3 series was the first model sold of the 5th generation BMW 3 series', '<p>The saloon (sedan) model of the 3 series was the first model sold of the 5th generation BMW 3 series. Debuting in the US in 2006, the E90 came in two trims, the 325i/x and 330i/x models. Later, the US E90 received an engine boost with the debuts of the 2007 328i/x and 335i/x models.<br /> BMW released an M3 variant of the E90 saloon for the 2008 model year. The M3 features the same V8 Engine as the Coupe. It separated itself from the standard E90 by utilizing the E92 coupe''s front fascia.</p>', '', '', '', '5', '170'),
(4, 0, '9780007331680', 100, 0, '', '2011-12-26 15:42:25', '2011-12-26 15:43:00', 1, 1, 1, 'default', '', 0.00, 0.00, 69.00, 69.00, 0, 1800.0000, 'thumb_ef8c670fbde778d44656d530a2038362.jpg', 'ef8c670fbde778d44656d530a2038362.jpg', 'full_ef8c670fbde778d44656d530a2038362.jpg', 1, 0, 6.00, 3, 0, 4, 0.0000, 0, 0, 0, 1, 'Touring (E91)', 'touring-e91', 'The Sports Touring model of the 3-Series is available with both rear-wheel drive and xDrive AWD.', '<p>The Sports Touring model of the 3-Series is available with both rear-wheel drive and xDrive AWD. This model features a large (optional) Panoramic roof, which stretches far enough for passengers in the rear to enjoy.</p>', '', '', '', '3', '190'),
(5, 0, '10000001', 133, 0, '', '2011-12-26 15:46:47', '2011-12-26 15:48:12', 1, 1, 1, 'default', '', 0.00, 0.00, 141.69, 141.69, 0, 120.0000, 'thumb_db6b1b47578673a4945ccc3a0566f678.jpg', 'db6b1b47578673a4945ccc3a0566f678.jpg', 'full_db6b1b47578673a4945ccc3a0566f678.jpg', 2, 0, 3.00, 2, 0, 4, 0.0000, 0, 0, 0, 1, 'M1', '', '', '', '', '', '', '', ''),
(6, 0, '55889966', 122, 0, '', '2011-12-26 15:49:46', '2011-12-26 15:49:46', 1, 1, 1, 'default', '', 0.00, 0.00, 69.00, 69.00, 0, 150.0000, 'thumb_a27e5e49d03b538340aeec1350722382.jpg', 'a27e5e49d03b538340aeec1350722382.jpg', 'full_a27e5e49d03b538340aeec1350722382.jpg', 1, 0, 0.00, 0, 0, 1, 0.0000, 0, 0, 0, 1, 'M2', '', '', '', '', '', '', '', ''),
(7, 0, '1312313', 12, 0, '', '2011-12-26 15:55:33', '2011-12-26 15:58:36', 1, 1, 1, 'default', '', 0.00, 0.00, 6.95, 6.95, 0, 0.0000, 'thumb_3ee58838349bf67da57aaf6c1248fc0c.jpg', '3ee58838349bf67da57aaf6c1248fc0c.jpg', 'full_3ee58838349bf67da57aaf6c1248fc0c.jpg', 1, 0, 5.00, 2, 0, 5, 0.0000, 0, 0, 0, 1, 'mp3', 'mp3', 'mp3', '', '', '', '', '', ''),
(8, 0, '11455', 12, 0, '', '2011-12-26 16:00:40', '2011-12-26 16:00:40', 1, 1, 1, 'default', '', 0.00, 0.00, 78.00, 78.00, 0, 0.3000, 'thumb_3731bd14eb4d84fa1724fabee6fdece2.jpg', '3731bd14eb4d84fa1724fabee6fdece2.jpg', 'full_3731bd14eb4d84fa1724fabee6fdece2.jpg', 2, 0, 6.50, 2, 0, 3, 0.0000, 0, 0, 0, 1, 'Video', 'video', '', '', '', '', '', '', ''),
(9, 0, '012122', 12, 0, '', '2011-12-26 16:04:54', '2011-12-26 16:07:12', 1, 1, 1, 'default', '', 0.00, 0.00, 20, 20, 0, 1.5000, 'thumb_238351c2bd98aadea04bbae5df6cb102.jpg', '238351c2bd98aadea04bbae5df6cb102.jpg', 'full_238351c2bd98aadea04bbae5df6cb102.jpg', 0, 0, 7.50, 2, 1, 4, 1.5000, 2, 0, 0, 1, 'Water 1,5L', 'water-15l', 'Cool water Water 1,5L', '', '', '', '', '', ''),
(10, 0, '88954', 10000, 0, '', '2011-12-26 16:11:38', '2011-12-27 10:45:59', 1, 1, 1, 'default', '', 0.00, 0.00, 35.00, 28.00, 1, 2.5000, 'thumb_6ab122ff4342c618f743f6e66a66829a.jpg', '6ab122ff4342c618f743f6e66a66829a.jpg', 'full_6ab122ff4342c618f743f6e66a66829a.jpg', 0, 1, 8.50, 4, 0, 11, 2.5000, 2, 1, 0, 1, 'Water 2,5 L', 'water-25-l', '', '', '', '', '', '', '');





INSERT INTO `#__jshopping_products_attr2` (`id`, `product_id`, `attr_id`, `attr_value_id`, `price_mod`, `addprice`) VALUES
(16, 1, 2, 3, '+', 0.00),
(15, 1, 2, 4, '+', 10.00),
(14, 1, 1, 2, '+', 0.00),
(13, 1, 1, 1, '+', 0.00),
(30, 2, 1, 2, '+', 10.00),
(29, 2, 1, 1, '+', 5.00);



INSERT INTO `#__jshopping_products_extra_fields` (`id`, `allcats`, `cats`, `type`, `group`, `ordering`, `name_en-GB`) VALUES
(1, 0, 'a:1:{i:0;s:1:"1";}', 1, 0, 1, 'Doors'),
(2, 0, 'a:1:{i:0;s:1:"1";}', 1, 0, 2, 'Power (hp)');




INSERT INTO `#__jshopping_products_files` (`id`, `product_id`, `demo`, `demo_descr`, `file`, `file_descr`, `ordering`) VALUES
(1, 7, '11_stadium_arcadium_x.mp3', 'stadium_arcadium', '', '', 0),
(2, 7, '11_stadium_arcadium_x.mp3', 'stadium_arcadium', '', '', 1),
(3, 7, '11_stadium_arcadium_x.mp3', 'stadium_arcadium', '', '', 2);





INSERT INTO `#__jshopping_products_free_attr` (`id`, `product_id`, `attr_id`) VALUES
(2, 2, 1);




INSERT INTO `#__jshopping_products_images` (`image_id`, `product_id`, `image_thumb`, `image_name`, `image_full`, `name`, `ordering`) VALUES
(1, 1, 'thumb_9fedd69376f8f6f7e7e6c4908aa562a5.jpg', '9fedd69376f8f6f7e7e6c4908aa562a5.jpg', 'full_9fedd69376f8f6f7e7e6c4908aa562a5.jpg', '', 1),
(2, 2, 'thumb_67c57c86a9a4a36c2219240c36d56436.jpg', '67c57c86a9a4a36c2219240c36d56436.jpg', 'full_67c57c86a9a4a36c2219240c36d56436.jpg', '', 1),
(3, 2, 'thumb_df4480b863687511f7868966225b8a92.jpg', 'df4480b863687511f7868966225b8a92.jpg', 'full_df4480b863687511f7868966225b8a92.jpg', '', 2),
(4, 3, 'thumb_34e8560c8f5168fca957249ee1155744.jpg', '34e8560c8f5168fca957249ee1155744.jpg', 'full_34e8560c8f5168fca957249ee1155744.jpg', '', 1),
(5, 4, 'thumb_ef8c670fbde778d44656d530a2038362.jpg', 'ef8c670fbde778d44656d530a2038362.jpg', 'full_ef8c670fbde778d44656d530a2038362.jpg', '', 1),
(6, 5, 'thumb_db6b1b47578673a4945ccc3a0566f678.jpg', 'db6b1b47578673a4945ccc3a0566f678.jpg', 'full_db6b1b47578673a4945ccc3a0566f678.jpg', '', 1),
(7, 6, 'thumb_a27e5e49d03b538340aeec1350722382.jpg', 'a27e5e49d03b538340aeec1350722382.jpg', 'full_a27e5e49d03b538340aeec1350722382.jpg', '', 1),
(8, 7, 'thumb_3ee58838349bf67da57aaf6c1248fc0c.jpg', '3ee58838349bf67da57aaf6c1248fc0c.jpg', 'full_3ee58838349bf67da57aaf6c1248fc0c.jpg', '', 1),
(9, 8, 'thumb_3731bd14eb4d84fa1724fabee6fdece2.jpg', '3731bd14eb4d84fa1724fabee6fdece2.jpg', 'full_3731bd14eb4d84fa1724fabee6fdece2.jpg', '', 1),
(10, 9, 'thumb_238351c2bd98aadea04bbae5df6cb102.jpg', '238351c2bd98aadea04bbae5df6cb102.jpg', 'full_238351c2bd98aadea04bbae5df6cb102.jpg', '', 1),
(11, 10, 'thumb_6ab122ff4342c618f743f6e66a66829a.jpg', '6ab122ff4342c618f743f6e66a66829a.jpg', 'full_6ab122ff4342c618f743f6e66a66829a.jpg', '', 1),
(12, 10, 'thumb_663a6f3491c2ab53ece779e468f57cad.jpg', '663a6f3491c2ab53ece779e468f57cad.jpg', 'full_663a6f3491c2ab53ece779e468f57cad.jpg', '', 2);




INSERT INTO `#__jshopping_products_prices` (`price_id`, `product_id`, `discount`, `product_quantity_start`, `product_quantity_finish`) VALUES
(28, 2, 15.000000, 1000, 10000),
(27, 2, 10.000000, 100, 1000),
(26, 2, 5.000000, 11, 100),
(25, 2, 0.000000, 1, 10),
(34, 3, 15.000000, 101, 1000),
(33, 3, 10.000000, 11, 100),
(32, 3, 0.000000, 1, 10),
(43, 10, 20.000000, 101, 1000),
(42, 10, 10.000000, 11, 100),
(41, 10, 0.000000, 1, 10);



INSERT INTO `#__jshopping_products_relations` (`product_id`, `product_related_id`) VALUES
(3, 2),
(3, 1);



INSERT INTO `#__jshopping_products_reviews` (`review_id`, `product_id`, `user_id`, `user_name`, `user_email`, `time`, `review`, `mark`, `publish`, `ip`) VALUES
(1, 2, 42, 'admin', 'admin@mail.de', '2011-12-26', 'wow very cool\r\n', 7, 1, '127.0.0.1'),
(2, 2, 42, 'dunkan', 'admin@mail.de', '2011-12-26', 'very good', 10, 1, '127.0.0.1'),
(3, 2, 42, 'Kate', 'admin@mail.de', '2011-12-26', 'it''s cool man', 0, 1, '127.0.0.1'),
(4, 3, 42, 'admin', 'admin@mail.de', '2011-12-26', 'bla bla', 10, 1, '127.0.0.1'),
(5, 3, 42, 'qwerty', 'admin@mail.de', '2011-12-26', 'qwerrtt', 2, 1, '127.0.0.1'),
(6, 3, 42, 'admin123', 'admin@mail.de', '2011-12-26', 'ererwfsdsdf', 7, 1, '127.0.0.1'),
(7, 4, 42, 'admin', 'admin@mail.de', '2011-12-26', 'oppaa', 5, 1, '127.0.0.1'),
(8, 4, 42, 'admin123', 'admin@mail.de', '2011-12-26', 'testst', 4, 1, '127.0.0.1'),
(9, 4, 42, 'admin11', 'admin@mail.de', '2011-12-26', '123123', 9, 1, '127.0.0.1'),
(10, 5, 42, 'admin', 'admin@mail.de', '2011-12-26', 'wer', 2, 1, '127.0.0.1'),
(11, 5, 42, 'admin', 'admin@mail.de', '2011-12-26', 'rtyrtyrty', 4, 1, '127.0.0.1'),
(12, 7, 42, 'admin', 'admin@mail.de', '2011-12-26', 'wow', 5, 1, '127.0.0.1'),
(13, 7, 42, 'vasja', 'admin@mail.de', '2011-12-26', 'super puper', 0, 1, '127.0.0.1'),
(14, 8, 42, 'admin', 'admin@mail.de', '2011-12-26', 'opaa', 4, 1, '127.0.0.1'),
(15, 8, 42, 'admin', 'admin@mail.de', '2011-12-26', 'qwertyytyutyutyth', 9, 1, '127.0.0.1'),
(16, 9, 42, 'admin', 'admin@mail.de', '2011-12-26', 'i will drink this right now!', 9, 1, '127.0.0.1'),
(17, 9, 42, 'admin123', 'admin@mail.de', '2011-12-26', 'hey drinki! i will empty you!', 6, 1, '127.0.0.1'),
(18, 10, 42, 'admin', 'admin@mail.de', '2011-12-26', 'dfgdfg', 8, 1, '127.0.0.1'),
(19, 10, 42, 'admin123', 'admin@mail.de', '2011-12-26', 'wrwerwer', 0, 1, '127.0.0.1'),
(20, 10, 42, 'admin111', 'admin@mail.de', '2011-12-26', 'werwer', 0, 1, '127.0.0.1'),
(21, 10, 42, 'admin11', 'admin@mail.de', '2011-12-26', '123erg gdg ', 9, 1, '127.0.0.1');




INSERT INTO `#__jshopping_products_to_categories` (`product_id`, `category_id`, `product_ordering`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 6, 1),
(6, 4, 1),
(7, 7, 1),
(8, 7, 2),
(9, 8, 1),
(10, 8, 2);
