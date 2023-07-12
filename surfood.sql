-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 04:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` bigint(20) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(50) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`, `subtotal`) VALUES
('1014wC5wPGi6rWYsBgZI', '9WjBAAqT', 2, 176),
('1014wC5wPGi6rWYsBgZI', 'a5YtEUki', 1, 47);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` varchar(50) NOT NULL,
  `store_id` bigint(11) NOT NULL,
  `mode_of_delivery` varchar(100) NOT NULL,
  `mode_of_payment` varchar(100) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL,
  `total_price` int(11) NOT NULL,
  `person_to_contact` varchar(1000) NOT NULL,
  `ptc_phone` varchar(100) NOT NULL,
  `ptc_address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `store_id`, `mode_of_delivery`, `mode_of_payment`, `customer_id`, `date_time`, `status`, `total_price`, `person_to_contact`, `ptc_phone`, `ptc_address`) VALUES
('1014wC5wPGi6rWYsBgZI', 10002, 'Pick Up', 'Cash', 1014, '2023-06-15 10:43:45', 'Ongoing', 223, 'Juan Dela Cruz', '09123456789', 'Paco, Manila');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` varchar(100) NOT NULL,
  `store_id` bigint(20) NOT NULL,
  `product_name` varchar(1000) NOT NULL,
  `product_time` datetime NOT NULL,
  `product_price` float NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `expiry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `store_id`, `product_name`, `product_time`, `product_price`, `product_description`, `expiry_date`) VALUES
('26VCGJH5', 10001, 'Chicken Siomai', '2023-06-24 23:00:00', 79.2, 'Ready-to-Heat Chicken Siomai Take Home Packs', '2023-06-24'),
('2HCeJYTu', 10001, 'Arroz Caldo', '2023-06-24 23:00:00', 31.2, 'Don\'t fret, just grab a bowl of Arroz Caldo and instantly bring the goodness of home-grown lugaw, topped with real chicken pieces and dried garlic to you, anytime anywhere!', '2023-06-24'),
('2i56n6jE', 10007, 'Classic Chocolate Cake', '2023-06-24 23:00:00', 172, 'Buttery caramel fudge and silky smooth chocolate sandwiched between layers of dark chocolate cake and finished with chocolate ganache.', '2023-06-24'),
('2TvodFFy', 10009, 'Chocolate Rum Tiramisu', '2023-06-24 23:00:00', 1598.4, 'Espresso-soaked sponge cake using 100-percent Arabica beans, layered with rich mascarpone and dark chocolate ganache, and flavoured with premium aged Don Papa Rum.', '2023-06-24'),
('3MMJzPnb', 10002, 'Crispy Pata', '2023-06-24 23:00:00', 360, 'A Filipino dish made with pork leg simmered in spices, deep fried until golden brown and crispy.', '2023-06-24'),
('3zfycjS9', 10010, 'Cheese Overload Donuts', '2023-06-24 23:00:00', 160, 'The perfect blend of sweet and salty comes in the form of Ribbonette\'s Cheese Overload Donuts.', '2023-06-24'),
('4u94PDRc', 10008, 'Assorted Classic Donuts (Dozen)', '2023-06-24 22:00:00', 239.2, 'A dozen of assorted classic donuts', '2023-06-24'),
('5v7jofsC', 10001, 'Sweet and Sour Chicken', '2023-06-24 23:00:00', 84, 'Bring home the newest Chef Creations x Lugang Cafe and enjoy your favorite Asian dish.', '2023-06-24'),
('7Fe7t8T2', 10007, 'Sausage Roll', '2023-06-24 23:00:00', 108, 'Buttery, flaky crust filed with juicy sausage.', '2023-06-24'),
('7RvtM65R', 10004, 'Choc Aleck', '2023-06-24 23:00:00', 38.4, 'Choco Butter Cream', '2023-06-24'),
('8iEH5ckG', 10001, 'Champorado with Taiwan Fish Flakes', '2023-06-24 23:00:00', 31.2, 'Try Champorado, our newest 7-Fresh Pinoy Favorite offering, made with Malaysian cocoa and topped with dried fish flakes.', '2023-06-24'),
('8zWxBRuk', 10004, 'Chicken Curry', '2023-06-24 23:00:00', 36.8, 'Chicken Curry Filling', '2023-06-24'),
('9WjBAAqT', 10002, 'Sweet Chili Pork Mini Bucket', '2023-06-24 23:00:00', 88, 'A bucket of Ministop’s pork slices coated in sweet chili sauce.', '2023-06-24'),
('a5YtEUki', 10002, 'Lechon Kawali Toppers', '2023-06-24 23:00:00', 47.2, 'Lechon kawali, fried pork belly, is a tasty Filipino dish with flavors of garlic and bay leaves.', '2023-06-24'),
('Bgov2Va6', 10001, 'Egg Salad Sandwich', '2023-06-24 23:00:00', 33.6, 'Try the new and improved Egg Salad Sandwich. Now with softer bread formulation and selenium-enriched organic eggs.', '2023-06-24'),
('c2eSH9KG', 10008, 'Assorted Ultimate Bundle', '2023-06-24 23:00:00', 600, '12 pcs. Premium Donuts + 12 pcs. Classic Donuts', '2023-06-24'),
('D95CyPQT', 10003, 'Pastel Blooms Chocolate 9\" round', '2023-06-24 23:00:00', 312, 'Chocolate chiffon cake iced with choco butter créme icing. The sides of the cake are bordered with choco butter créme icing.', '2023-06-24'),
('Eh5vsi9t', 10009, 'Cheese Rolls', '2023-06-24 23:00:00', 350.4, 'A soft and billowy roll with velvety cheese at the center. Well-loved by both young and young-at-heart!', '2023-06-24'),
('eSguW7P4', 10006, 'Bananamon', '2023-06-24 23:00:00', 36, 'Moist and flavorful banana bread.', '2023-06-24'),
('EWmkkxa9', 10006, 'Cinnamon Pandesal (Pack-4pcs)', '2023-06-24 23:00:00', 76, 'Pan de Manila’s classic favorite pandesal sprinkled in cinnamon sugar.', '2023-06-24'),
('fTSVBApp', 10005, 'Sliced Bread Regular', '2023-06-24 23:00:00', 36, 'An all-time favorite bread that is soft and has a fine crumb. It has a moderately sweet taste that truly compliments any spread or dressing and can be consumed even without them.', '2023-06-24'),
('FWEgqEKD', 10001, 'Spanish Bread Bites', '2023-06-24 23:00:00', 23.2, 'Soft and buttery Spanish Bread Bites', '2023-06-24'),
('FYhuy7fT', 10001, 'Spaghetti with Meatballs', '2023-06-24 23:00:00', 44, 'Magpaka-sosy with 7-Fresh Spaghetti with Meatballs', '2023-06-24'),
('gKarDNVr', 10005, 'Choco German (Pack of 3)', '2023-06-24 23:00:00', 19.2, 'With a creamy choco filling and topped with a sugary-margarine topping to complete the taste.', '2023-06-24'),
('HGJEA5hc', 10003, 'Chocolate Whole Roll', '2023-06-24 23:00:00', 281.6, 'A fan favorite! A chocolate sponge cake rolled, filled, and iced with our chocolate frosting!', '2023-06-24'),
('J5EbGBeT', 10004, 'Cheezymada', '2023-06-24 23:00:00', 40.8, 'Butter Cream', '2023-06-24'),
('kKvaNbm7', 10001, 'Tinapang Bangus', '2023-06-24 23:00:00', 63.2, 'Enjoy the new Bangus Tinapa Big Time meal, a complete meal of rice and smoked boneless bangus hailed from Sarangani Bay.', '2023-06-24'),
('KZVUd9j8', 10009, 'Mango Bene', '2023-06-24 23:00:00', 1694.4, 'Our best-selling \"summer-cake\"! Frozen layers of meringue with custard cream, and fresh Philippine mangoes in between. Served semi-frozen.', '2023-06-24'),
('Mf2iJGx7', 10001, 'Strawberry Taho', '2023-06-24 23:00:00', 24, 'Savor Baguio feels in every scoop! Hindi mo na kailangan lumayo dahil ang Strawberry Taho, meron na sa 7-Eleven!', '2023-06-24'),
('myYzGbKN', 10001, 'Pork Sinigang na Kamias', '2023-06-24 23:00:00', 60, 'Try the Chef Creation\'s Pork Sinigang sa Kamias, with real fresh kamias served with gabi and kangkong, hindi nalalayo sa lutong-bahay na nakasanayan mo.', '2023-06-24'),
('P5cTH982', 10006, 'Pandesal Big (1 dozen)', '2023-06-24 23:00:00', 68, 'Pan de Manila’s classic favorite, baked to perfection with its distinct flavor, brown crust and soft inside.', '2023-06-24'),
('pCRPDGNv', 10007, 'Sausage and Bacon Flatbread', '2023-06-24 23:00:00', 108, 'Sausage, ham, bacon, sun-dried tomatoes, black olives, mozzarella, parmesan cheese and pesto sauce on a crafted flatbread.', '2023-06-24'),
('pyYFKce4', 10009, 'Classic Ensaymada', '2023-06-24 23:00:00', 558.4, 'Our signature recipe of this local pastry is made with 100% real butter and eggs topped with premium Edam cheese from Holland.\r\n', '2023-06-24'),
('rBeTJ3pg', 10002, 'Siomai Fritos Crab Rice', '2023-06-24 23:00:00', 46.4, 'A meal of Siomai Fritos Crab with Rice.', '2023-06-24'),
('Rxdi5DDF', 10010, 'Hopia Monggo', '2023-06-24 23:00:00', 32, 'A box of Tipas Hopia Monggo', '2023-06-24'),
('scMsT7Lj', 10003, 'Celebrate Mocha 8x12 with filling', '2023-06-24 23:00:00', 635.2, 'Light - brown colored mocha chiffon cake iced with mocha butter créme icing. The sides of the cake are bordered with vanilla butter créme icing topped with balloons toppers.', '2023-06-24'),
('sZZSJhLz', 10007, 'Ham & Cheese on French Butter Croissant', '2023-06-24 23:00:00', 120, 'French butter croissant filled with ham and cheese', '2023-06-24'),
('TEr9kVLF', 10005, 'Dinner Roll with Cheese', '2023-06-24 23:00:00', 60, 'A soft creamy bread and perfect pairing for a cup of coffee.', '2023-06-24'),
('ttR3MAfT', 10001, 'Mixed Vegetables Salad', '2023-06-24 23:00:00', 39.2, 'Light on the tummy and light for your wallet. Here comes a healthy snack of 7-Fresh Mixed Vegetables Salad.', '2023-06-24'),
('UmKGSKPa', 10001, 'Japanese Pork Curry', '2023-06-24 23:00:00', 68, 'You can savor a rich Japanese-style curry, crafted with a Filipino twist.', '2023-06-24'),
('uU99H8fy', 10006, 'Macapuno Tart (Pack-3pcs)', '2023-06-24 23:00:00', 81.6, 'All-natural and easy to spread, made from pure coconut milk (gata), sugar and macapuno.', '2023-06-24'),
('vjNkaXsj', 10008, 'Assorted Premium Donuts (Dozen)', '2023-06-24 23:00:00', 384, 'A dozen of assorted premium donuts', '2023-06-24'),
('vkkWv49q', 10010, 'Egg Pie', '2023-06-24 23:00:00', 240, 'Classic Filipino pastry is made with a creamy and custardy filling that\'s baked to perfection ', '2023-06-24'),
('Wbc7wYMA', 10003, 'Brazo De Mercedes Roll', '2023-06-24 23:00:00', 360.8, 'Cotton-soft meringue roll with rich custard filling, lightly dusted with confectioners\' sugar.', '2023-06-24'),
('xq2AyxLn', 10008, 'Assorted Munchkins (Bucket)', '2023-06-24 22:00:00', 300, 'A bucket of munchkins', '2023-06-24'),
('XrwknQ7E', 10004, 'California Toast', '2023-06-24 23:00:00', 106.4, 'Raisins', '2023-06-24'),
('Yrx68jWg', 10010, 'Hopiang Ube', '2023-06-24 23:00:00', 36, 'A box of hopia with ube filling', '2023-06-24'),
('zKQ9zq3w', 10005, 'Bicho Bicho (Pack of 3)', '2023-06-24 23:00:00', 16.8, 'Classic fried bread, elongated in shape and filled with cheese and coated with sugar.', '2023-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `store_id` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`store_id`, `email`, `password`) VALUES
(10001, 'seveneleven@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10002, 'unclejohns@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10003, 'goldilocks@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10004, 'breadtalk@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10005, 'juliesbakeshop@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10006, 'pandemanila@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10007, 'starbucks@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10008, 'dunkindonuts@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10009, 'marygrace@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6'),
(10010, 'ribonnettes@gmail.com', '$2y$10$s5LH/yvxsMAH27pd9cguOeEzFibgk66kM.XYhag6vUJ5rQ1BiaeE6');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` bigint(20) NOT NULL,
  `store_name` varchar(1000) NOT NULL,
  `store_description` varchar(1000) NOT NULL,
  `store_location` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_description`, `store_location`) VALUES
(10001, '7-eleven', '7-Eleven is the largest convenience store chain in the world. There are currently around 58,500 7-Eleven stores across the world.', 'Manila'),
(10002, 'Uncle John\'s', 'Uncle John\'s is a convenience store chain based in the Philippines owned and operated by Robinsons Convenience Stores Inc.', 'Manila'),
(10003, 'Goldilocks', 'Goldilocks Bakeshop is a bakery chain based in the Philippines, which produces and distributes Philippine cakes and pastries.', 'Manila'),
(10004, 'BreadTalk', 'BreadTalk, a Singaporean lifestyle brand that has gained international appeal, is widely credited for taking the bread and bakery industry to new heights.', 'Manila'),
(10005, 'Julie\'s Bakeshop', 'Julie\'s Bakeshop has been baking delicious and affordable breads for Filipinos for almost four decades.', 'Manila'),
(10006, 'PAN de MANILA', 'Pan de Manila breads are made fresh from scratch using the highest quality ingredients. ', 'Manila'),
(10007, 'Starbucks', 'Aside from being a coffeehouse, Starbucks also serve muffins, pastries, cakes and more.', 'Manila'),
(10008, 'Dunkin\' Donuts', 'Dunkin\' is the world\'s leading baked goods and coffee chain, serving more than 3 million customers each and every day.', 'Manila'),
(10009, 'Mary Grace', 'A homegrown Filipino company known for its well-loved Ensaymadas and Cheeserolls… and everything else that stands for the Goodness of Home!', 'Manila'),
(10010, 'Ribonnette\'s', 'Ribbonette’s Bakeshoppe has been in a number of Filipino homes bringing deliciousness and enjoyment in the form of a box of delectable treats!', 'Manila');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `first_name`, `last_name`, `phone_number`, `address`, `password`) VALUES
(1014, 'juandelacruz@gmail.com', 'Juan', 'Dela Cruz', '09123456789', 'Paco, Manila', '$2y$10$J2ZAdfjTVoDhHKD.VY5tpefL.DezITzaI3bPoqFhSj.rPQaRiPU5.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `order_list` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
