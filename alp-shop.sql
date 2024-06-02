-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 09:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alp-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'admin', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `variation_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Shirts'),
(2, 'Pants & Trousers'),
(3, 'Dresses'),
(4, 'Accesories'),
(5, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `message_id` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `sentByAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`message_id`, `customer_id_fk`, `message`, `timestamp`, `sentByAdmin`, `is_read`) VALUES
(55, 27, 'Hello Customer Your Order WIll Arrive Today ! , ', '2024-05-07 15:41:58', 1, 1),
(56, 27, 'Please prepare the payment', '2024-05-07 15:42:07', 1, 1),
(57, 28, 'You can talk to us for your inquries', '2024-05-07 15:45:39', 1, 1),
(58, 28, 'hii', '2024-05-08 07:42:37', 0, 1),
(59, 28, 'hello', '2024-05-08 07:42:50', 1, 1),
(60, 28, 'your prod is to be delivered today', '2024-05-08 07:48:48', 1, 1),
(61, 28, 'ahaha', '2024-05-09 09:23:44', 1, 1),
(62, 28, 'first ', '2024-05-09 09:23:57', 0, 1),
(63, 28, 'Hello po', '2024-05-09 09:45:39', 0, 1),
(64, 28, 'Bakit?', '2024-05-09 09:45:55', 1, 1),
(65, 28, 'Thank you', '2024-05-09 10:28:22', 0, 1),
(66, 28, 'welcome Po!', '2024-05-09 10:31:40', 1, 1),
(67, 32, 'Kistis', '2024-05-09 10:55:08', 0, 1),
(68, 32, 'Hi po!', '2024-05-09 10:55:26', 1, 1),
(69, 28, 'Your order has arrived', '2024-05-10 16:14:24', 1, 1),
(70, 28, 'Thank you', '2024-05-10 16:14:36', 0, 1),
(71, 28, 'hii', '2024-05-15 11:47:56', 0, 1),
(72, 28, 'hello', '2024-05-15 11:48:15', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `message_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`message_id`, `name`, `email`, `date`, `phone`, `message`) VALUES
(21, 'c', 'w', '2024-05-10 05:08:57', '1', 'qwe'),
(22, 'gojo', 'goatjo12@email.com', '2024-05-15 05:47:44', '12345', 'Nah Id Win'),
(63, 'sukuna', 'chef@email.com', '2024-05-15 09:21:37', '12345', 'Stand Proud\n');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `province` varchar(255) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `username` varchar(145) DEFAULT NULL,
  `img` text NOT NULL DEFAULT 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg',
  `sex` varchar(55) NOT NULL,
  `birthday` date DEFAULT NULL,
  `City` varchar(99) DEFAULT NULL,
  `Barangay` varchar(99) DEFAULT NULL,
  `Zip_Code` int(10) DEFAULT NULL,
  `landmark` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `password`, `province`, `phone_number`, `username`, `img`, `sex`, `birthday`, `City`, `Barangay`, `Zip_Code`, `landmark`) VALUES
(27, 'Mike', 'Hernandez', 'MikeHernandez@gmail.com', '$2y$10$pY9R2ux3jrEDXc8IPxJMRuP68JGb6S6m5hZ8yUa3TwpC3Ccwhohue', 'Laguna', '912345678', 'Mikeee', 'data:image/jpeg;base64,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', 'male', '1988-12-01', 'Rizal', 'Paule 1', 4004, 'Bayani Street'),
(28, 'Phi', 'Sora', 'sora@gmail.com', '$2y$10$MekrMyKYximD0tPp5Kvx0OuSZFfH/puIvxVUZEpzUE/stWLtWdILK', 'Laguna', '9776523759', 'PhiDiots', 'data:image/jpeg;base64,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', 'male', '1970-01-01', 'Rizal', 'Paule 1', 4004, 'Bayani Street'),
(29, 'Name', 'Kho', 'name@gmail.com', '$2y$10$Xj.Q3WUApX1I2Nv6fMEtZu2tFWSgzJrjdHSOHkAh/izTmy61rXf8C', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(31, 'John Paul ', 'Dimaculangan', 'dimaculanganjohnpaul23@gmail.com', '$2y$10$76dqY6x0G/r2Bcjxce8KFecOUS057FJlMp802shuqJlDHV.eN9fHK', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(32, 'kistis', 'meow', 'meow@gmail.com', '$2y$10$JmQJJUOeyrp6rRxGB.JQgurqo4qQhjhtVexqzz/tG02wtL/gt.aEa', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(34, 'jon', 'jon', 'jon@gmail.com', '$2y$10$IGnZ.QBXPpFd2yuU9z2hTuMllwOBIRo0EVeGAdiOBuX5Hw0Rwcd3y', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(35, 'hannah', 'bishi', 'hannahbishi@gmail.com', '$2y$10$NWiTrgvlA3Tq9rqveITR6eJTFnkjtLeH3HuqTmiktd8lvpkgyd0zW', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(39, 'chae', 'nayun', 'NayunJaja@email.com', '$2y$10$3hZVqWoU9fKNZUMCpWtg.OfocyNUMAvAIu7uuvZfx/yC8K5s7SXta', NULL, NULL, 'Nayun', 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', 'male', '1970-01-01', '', '', NULL, ''),
(40, 'hoku', 'son', 'hoku@email.com', '$2y$10$QjEc3VqkPu3yShBdPccIturM6yqRzSajozRNt3ZWJVRaKjyaIfjgW', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(41, 'test', 'test', 'test@email.com', '$2y$10$sRArebqmiqjQyqjxBS.xruPF3x3JerxCsstLJfRZpziSwf3Mo2Z9C', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(42, 'test', 'test', 'testa@email', '$2y$10$B.FfkG1CyW/NPolXTzCrZOgRotvHlG3Jqae2JZuJ2hQP2KzTP3GHC', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, '', '', NULL, ''),
(43, 'cyrus@email.com', 'umali', 'cyrus65@email.com', '$2y$10$hU12YP0Bn0OzWENdY/ymd.uTZ.87ONxDbFmHbBUZuaD6EdeKw.KYG', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, NULL, NULL, NULL, NULL),
(44, 'mark', 'isleta', 'mark65@email.com', '$2y$10$LV32ob4DY4LucuzOszCb9er8yA5a6eT.ka09M0sVQ/AYDRJpFNumW', NULL, NULL, NULL, 'https://icon-library.com/images/windows-user-icon/windows-user-icon-23.jpg', '', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `payment_id_fk` int(11) DEFAULT NULL,
  `shipment_id_fk` int(11) DEFAULT NULL,
  `ord_status` varchar(50) NOT NULL,
  `delivery_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `total_price`, `customer_id_fk`, `payment_id_fk`, `shipment_id_fk`, `ord_status`, `delivery_date`) VALUES
(95, '2024-05-12 05:29:26', 399.00, 28, NULL, 92, 'Completed', '2024-05-12 00:00:00'),
(96, '2024-05-14 14:48:51', 598.00, 28, NULL, 102, 'Canceled', NULL),
(97, '2024-05-14 14:50:59', 150.00, 28, NULL, 103, 'Canceled', '2024-05-23 00:00:00'),
(98, '2024-05-14 14:58:00', 297.00, 28, NULL, 104, 'Completed', '2024-05-14 00:00:00'),
(99, '2024-05-15 06:10:32', 299.00, 28, NULL, 105, 'Canceled', NULL),
(100, '2024-05-15 09:42:22', 399.00, 28, NULL, 106, 'Pending', NULL),
(101, '2024-05-15 09:51:02', 299.00, 28, NULL, 107, 'Pending', NULL),
(102, '2024-05-15 09:51:18', 299.00, 28, NULL, 108, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id_fk` int(11) NOT NULL,
  `variation_id_fk` int(11) NOT NULL,
  `order_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `quantity`, `price`, `product_id_fk`, `variation_id_fk`, `order_id_fk`) VALUES
(102, 1, 399.00, 1, 25, 95),
(103, 1, 399.00, 1, 25, 96),
(104, 1, 199.00, 50, 90, 96),
(105, 1, 150.00, 46, 76, 97),
(106, 3, 99.00, 44, 70, 98),
(107, 1, 299.00, 73, 142, 99),
(108, 1, 399.00, 1, 1, 100),
(109, 1, 299.00, 9, 17, 101),
(110, 1, 299.00, 73, 142, 102);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `customer_id_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(1500) DEFAULT NULL,
  `category_fk` int(11) DEFAULT NULL,
  `img` varchar(555) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `category_fk`, `img`, `timestamp`) VALUES
(1, 'Nike Polo Shirt', 'Introducing the Nike Swoosh Polo Shirt, a timeless fusion of style and performance. Crafted with premium materials, this classic polo features the iconic Nike Swoosh emblem, symbolizing athleticism and innovation. Whether you\'re hitting the links or navigating city streets, its moisture-wicking fabric keeps you cool and comfortable, while the tailored fit ensures a sharp, polished look. Elevate your wardrobe with the perfect blend of sporty elegance – the Nike Swoosh Polo Shirt.', 1, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338177150_599322062129928_712208375833660244_n_rz30ni.jpg', '2024-05-04 17:18:53'),
(9, 'Classic Green Shirt - Timeless Style ', ' Elevate your wardrobe with our Classic Green Shirt, a versatile staple that effortlessly blends sophistication with comfort. Crafted from premium cotton fabric, this shirt embodies timeless elegance and impeccable quality.', 1, 'https://images.unsplash.com/photo-1633966887768-64f9a867bdba?q=80&w=2003&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2024-05-04 17:18:53'),
(44, 'Women\'s Spider Shirt', 'Cotton Spandex Fabric', 1, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883938_odxrei.jpg', '2024-05-04 17:18:53'),
(45, 'Couple Ring with Premium Velvet Box', 'couple ring with premium velvet box', 4, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964195/scaikvlzztnsm7q217c6.jpg', '2024-05-04 17:18:53'),
(46, 'Poison  Perfume for men', 'Perfume with box', 4, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964875/1711148884105_p0ixqf.jpg', '2024-05-04 17:18:53'),
(47, 'Promise Ring in a Rose Stick', 'Promise Ring with rose stick', 4, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964830/1711148884005_kmulwg.jpg', '2024-05-04 17:18:53'),
(48, 'Celestial Elegance Collection', 'ntroducing the Celestial Elegance Collection, where timeless beauty meets celestial inspiration. Each piece in this stunning set, from the Stellar Nexus ring to the Crystal Arcadia Loop, is meticulously crafted to capture the essence of the cosmos.', 4, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965732/1711148884149_ru1qca.jpg', '2024-05-04 17:18:53'),
(49, 'Monochrome Elegance Emblem Shirt', 'Introducing our exquisite Monochrome Elegance Emblem Shirt, a timeless symbol of sophistication and style. Crafted with the finest quality white fabric, this shirt embodies minimalist chic, perfect for any occasion.', 1, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966613/1711148884188_sgczr4.jpg', '2024-05-04 17:18:53'),
(50, 'Slate Noir Jeans', 'Featuring a classic five-pocket design and a slim fit silhouette, these jeans offer versatility and functionality without compromising on style. The deep black stitching contrasts elegantly with the gray fabric, creating a striking visual appeal that sets these jeans apart.', 2, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg', '2024-05-04 17:18:53'),
(51, 'Women\'s Polo double lining', 'Description: Cotton Spandex Fabric', 1, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg', '2024-05-04 17:18:53'),
(69, 'black leather spaghetti strap dress', '\"Turn heads in our sleek black leather spaghetti strap dress. Crafted with high-quality leather, it hugs your curves in all the right places, while the spaghetti straps add a touch of femininity. Perfect for a night out or a special event, this dress exudes confidence and style.\"\n\n\n\n\n\n\n', 3, 'https://images.unsplash.com/photo-1618932260643-eee4a2f652a6?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2024-05-04 17:18:53'),
(70, 'A beautiful long green dress ', '\"Elevate your wardrobe with our stunning long green dress, elegantly displayed on a hanger against a crisp white wall. Crafted with luxurious fabric, its flowing silhouette and vibrant green hue exude timeless sophistication. Whether you\'re attending a formal event or simply want to make a statement, this dress is sure to captivate attention and leave a lasting impression.\"', 3, 'https://images.unsplash.com/flagged/photo-1585052201332-b8c0ce30972f?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2024-05-04 17:18:53'),
(71, 'Solid Color Denim Dress', '\"Embrace effortless style with our Solid Color Denim Dress. Crafted from high-quality denim, this dress offers both comfort and chic appeal. Its clean lines and versatile design make it perfect for casual outings or dressed-up occasions. Elevate your wardrobe with this timeless piece that effortlessly transitions from day to night.\"', 3, 'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2024-05-04 17:18:53'),
(72, 'Black Dress', '\"Embrace effortless style with our Solid Color Denim Dress. Crafted from high-quality denim, this dress offers both comfort and chic appeal. Its clean lines and versatile design make it perfect for casual outings or dressed-up occasions. Elevate your wardrobe with this timeless piece that effortlessly transitions from day to night.\"', 3, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059581/1711148884031_slen2r.jpg', '2024-05-04 17:18:53'),
(73, 'Cloud Nine Trousers', 'Dive into the epitome of comfort and style with our Cloud Nine Trousers. Crafted from a luxurious blend of fabrics, these pants offer a heavenly soft feel against your skin. The pristine white hue adds a touch of sophistication to any ensemble, while the tailored fit ensures a flattering silhouette. Whether you\'re lounging at home or stepping out for a day of errands, these trousers will keep you feeling relaxed and looking effortlessly chic', 2, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059568/1711148883957_q75i4u.jpg', '2024-05-04 17:18:53'),
(74, 'StrideFlex Joggers', 'Experience the perfect blend of comfort and style with our StrideFlex Joggers. Designed for both performance and leisure, these joggers feature a lightweight and flexible fabric that moves with you effortlessly. Whether you\'re hitting the gym or running errands, the breathable material ensures optimal comfort while maintaining a sleek silhouette. With a modern design and versatile appeal, these joggers are sure to become your go-to choice for active days and relaxed evenings.', 2, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059575/1711148883971_faucdf.jpg', '2024-05-04 17:18:53'),
(75, 'Monochrome Maven Handbag', 'Elevate your accessory game with our Monochrome Maven Handbag, where timeless elegance meets modern sophistication. Crafted with precision from premium materials, this handbag seamlessly blends classic black and white tones for a striking aesthetic. Its versatile design features ample storage space and convenient compartments, making it perfect for both work and play. Whether you\'re strutting through the city streets or attending a chic soirée, the Monochrome Maven Handbag is sure to turn heads and elevate any ensemble.', 5, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259758384_4893622137348415_2840792325919206549_n_yzoidt.jpg', '2024-05-04 17:18:53'),
(76, 'Chic Petite Noir Clutch', 'Make a statement with our Chic Petite Noir Clutch, the epitome of understated elegance. Crafted from sleek black leather with delicate white accents, this compact handbag exudes sophistication. Perfect for evenings out or special occasions, its petite size makes it ideal for carrying your essentials in style. With a timeless design and attention to detail, the Chic Petite Noir Clutch is sure to add a touch of glamour to any ensemble.', 5, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259702393_4893604670683495_8985518146452807708_n_ya5bpo.jpg', '2024-05-04 17:18:53'),
(85, 'Women Basketball Jersey', 'Nice Basketball Jersey', 1, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083295/290508344_5580036662040289_2444637078724338915_n_yjyxtt.jpg', '2024-05-11 18:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(11) NOT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `image_url` varchar(605) DEFAULT NULL,
  `product_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `variation_id`, `image_url`, `product_id_fk`) VALUES
(2, 2, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/337895311_1305405547064895_5666911512047497757_n_jh5ue6.jpg', 1),
(72, 63, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg', 44),
(73, 63, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg', 44),
(74, 76, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964875/1711148884105_p0ixqf.jpg', 46),
(75, 76, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964869/1711148884233_sek62p.jpg', 46),
(76, 76, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964871/1711148884100_rmshrg.jpg', 46),
(77, 78, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964830/1711148884005_kmulwg.jpg', 47),
(78, 78, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964831/1711148884026_inrgle.jpg', 47),
(94, 79, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965732/1711148884149_ru1qca.jpg', 48),
(95, 79, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965729/1711148884222_tndor3.jpg', 48),
(96, 79, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965728/1711148884128_ih3too.jpg', 48),
(97, 84, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966613/1711148884188_sgczr4.jpg', 49),
(98, 85, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966596/1711148884049_k0tzqp.jpg', 49),
(99, 86, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966600/1711148884079_anmgam.jpg', 49),
(100, 87, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966615/1711148884122_uivs6p.jpg', 49),
(101, 88, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966613/1711148884188_sgczr4.jpg', 49),
(102, 92, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg', 50),
(103, 97, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg', 51),
(163, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338020017_3554416078214594_3970148051645611676_n_nhnnbp.jpg', 1),
(164, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151539/338160352_913407606379610_7383553924582431248_n_zln9sa.jpg', 1),
(165, NULL, 'https://images.unsplash.com/photo-1633966887768-64f9a867bdba?q=80&w=2003&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 9),
(166, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964195/scaikvlzztnsm7q217c6.jpg', 45),
(167, NULL, 'https://images.unsplash.com/photo-1618932260643-eee4a2f652a6?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 69),
(168, NULL, 'https://images.unsplash.com/flagged/photo-1585052201332-b8c0ce30972f?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 70),
(169, NULL, 'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 71),
(170, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059581/1711148884031_slen2r.jpg', 72),
(171, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059568/1711148883957_q75i4u.jpg', 73),
(172, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059575/1711148883971_faucdf.jpg', 74),
(173, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259758384_4893622137348415_2840792325919206549_n_yzoidt.jpg', 75),
(174, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259815523_4893622110681751_4947977880235199518_n_jo5gvn.jpg', 75),
(175, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285360/259762096_4893622080681754_2560484999150910620_n_jqb1dx.jpg', 75),
(176, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259702393_4893604670683495_8985518146452807708_n_ya5bpo.jpg', 76),
(177, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285360/259686546_4893604564016839_12038027761664530_n_lzlexl.jpg', 76),
(178, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285360/259786526_4893604674016828_2147876648725818551_n_uvir3f.jpg', 76),
(179, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259726219_4893604567350172_3351600969260337379_n_djpkdz.jpg', 76),
(190, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083295/290508344_5580036662040289_2444637078724338915_n_yjyxtt.jpg', 85),
(191, NULL, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083256/290559506_5580036778706944_243073204225653531_n_ub2z1g.jpg', 85);

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `review_id` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `order_item_id_fk` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `product_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`review_id`, `customer_id_fk`, `order_item_id_fk`, `rating`, `comment`, `timestamp`, `product_id_fk`) VALUES
(42, 28, 102, 5, 'Very Beautiful', '0000-00-00 00:00:00', 1),
(43, 28, 106, 4, 'nice\n', '0000-00-00 00:00:00', 44);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int(11) NOT NULL,
  `shipment_date` datetime NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `Customer_id_fk` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `shipping_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`shipment_id`, `shipment_date`, `address`, `city`, `province`, `zip_code`, `Customer_id_fk`, `first_name`, `last_name`, `contact`, `shipping_note`) VALUES
(44, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', ''),
(45, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', 'Paule 1'),
(46, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', 'Paule 1'),
(47, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', 'Paule 1'),
(48, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', ''),
(49, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', 'Paule 1'),
(50, '2024-05-07 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 27, 'Mike', 'Hernandez', 'mikeEmail@email.com', 'Paule 1'),
(51, '2024-05-07 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', ''),
(52, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(53, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(54, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(55, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(56, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(57, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(58, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(59, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(60, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 31, 'Phi', 'Sora', 'Sora@gmail.com', ''),
(61, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 31, 'Phi', 'Sora', 'Sora@gmail.com', ''),
(62, '2024-05-09 00:00:00', '52 rosal street', 'San Pablo', 'Laguna', '4000', 31, 'John Paul', 'Dimaculangan', 'dimaculangankjohnpaul23@gmail.com', ''),
(63, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(64, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(65, '2024-05-09 00:00:00', '055 Mabini', 'Rizal', 'laguna', '4003', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(66, '2024-05-09 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 32, 'Kistis', 'Meow', 'meow@gmail.com', ''),
(67, '2024-05-09 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 32, 'Kistis', 'Meow', 'meow@gmail.com', ''),
(68, '2024-05-09 00:00:00', 'purok 123', 'San Pablo', 'laguna', '4000', 34, 'jon', 'jon', 'jon@gmail.com', ''),
(69, '2024-05-09 00:00:00', '0073 Brgy. Concepcion', 'San Pablo', 'Laguna', '4000', 35, 'Hannah', 'Perona', 'hannahbishi@gmail.com', ''),
(70, '2024-05-09 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 39, 'Kistis', 'Meow', 'umalic65@gmail', ''),
(71, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'laguna', '4004', 28, 'Cyrus', 'Carbungco', 'umalic65@gmail', '<br /><b>Warning</b>:  Undefined variable $Barangay in <b>C:\\xampp\\htdocs\\ALP SHOP\\client\\shipping-details.php</b> on line <b>139</b><br />'),
(72, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(73, '2024-05-10 00:00:00', 'poblacion', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', 'Paule 1'),
(74, '2024-05-10 00:00:00', 'Poblacion', 'Rizal', 'Laguna', '4004', 28, 'Cyrus', 'Umali', 'umalic65@gmail', 'adqw'),
(75, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', 'Paule 1'),
(76, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', 'Paule 1'),
(77, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', 'Paule 1'),
(78, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', 'Paule 1'),
(79, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', 'Paule 1'),
(80, '2024-05-10 00:00:00', '053 avenue street', 'Rizal', 'Laguna', '3003', 44, 'mark', 'isleta', 'mark@email.com', ''),
(81, '2024-05-10 00:00:00', '053 avenue street', 'Rizal', 'Laguna', '3003', 44, 'mark', 'isleta', 'mark@email.com', ''),
(82, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', 'qweqw', 'qweqwe', 44, 'mark', 'isleta', 'mark@email.com', ''),
(83, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' ', 'qweqwe', 44, 'qwewq', 'qwewqe', 'mark@email.com', ' '),
(84, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' qweqw', 'qweqwe', 44, 'qweqwe', 'qwewqe', 'mark@email.com', ' qewqe'),
(85, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' qweq', 'qweqwe', 44, 'qweqwe', 'qwewqe', 'mark@email.com', ' eqwewqe'),
(86, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' qweqwe', 'qweqwe', 44, 'qweqwe', 'qwewqe', 'mark@email.com', ' qwewqe'),
(87, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' qweqwe', 'qweqwe', 44, 'qweqe', 'qwewqe', 'mark@email.com', ' qweqwe'),
(88, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' wqewq', 'qweqwe', 44, 'qweqwe', 'qwewqe', 'mark@email.com', ' qweqwe'),
(89, '2024-05-10 00:00:00', 'qewqe', 'qweqwe', ' qweq', 'qweqwe', 44, 'qweqwe', 'qwewqe', 'mark@email.com', ' qweqwe'),
(90, '2024-05-10 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', ''),
(91, '2024-05-11 00:00:00', 'Seoul', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', ''),
(92, '2024-05-12 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', ''),
(93, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(94, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(95, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(96, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(97, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(98, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(99, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(100, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(101, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'sora@gmail.com', NULL),
(102, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(103, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(104, '2024-05-14 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(105, '2024-05-15 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(106, '2024-05-15 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL),
(107, '2024-05-15 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'umalic65@gmail', NULL),
(108, '2024-05-15 00:00:00', 'Bayani Street', 'Rizal', 'Laguna', '4004', 28, 'Phi', 'Sora', 'Sora@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `variation_id` int(11) NOT NULL,
  `product_id_fk` int(11) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `img_id_fk` int(11) NOT NULL,
  `var_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`variation_id`, `product_id_fk`, `sku`, `size`, `color`, `stock`, `price`, `img_id_fk`, `var_img`) VALUES
(1, 1, 'N-CY-XS-1234', '             Xtrasmall', '             Canary Yellow', 1, 399.00, 164, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151539/338160352_913407606379610_7383553924582431248_n_zln9sa.jpg'),
(2, 1, 'N-AB-S-1244', 'Small', 'Aqua Blue', 4, 500.00, 163, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338020017_3554416078214594_3970148051645611676_n_nhnnbp.jpg'),
(3, 1, 'N-NB-M-1654', 'Medium', 'Navy Blue', 3, 450.00, 163, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338020017_3554416078214594_3970148051645611676_n_nhnnbp.jpg'),
(17, 9, 'GRNST-S', ' Small', ' Green', 10, 299.00, 165, 'https://images.unsplash.com/photo-1633966887768-64f9a867bdba?q=80&w=2003&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(18, 9, 'GRNST-M', 'Medium', 'Green', 10, 299.00, 165, 'https://images.unsplash.com/photo-1633966887768-64f9a867bdba?q=80&w=2003&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(19, 9, 'GRNST-L', ' Large', ' Green', 1, 299.00, 165, 'https://images.unsplash.com/photo-1633966887768-64f9a867bdba?q=80&w=2003&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(25, 1, 'N-CY-XS-1235', 'Small', 'Canary Yellow', 10, 399.00, 164, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151539/338160352_913407606379610_7383553924582431248_n_zln9sa.jpg'),
(63, 44, NULL, 'One Size Fits All', 'Blue', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(64, 44, NULL, 'One Size Fits All', 'SkyBlue', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(65, 44, NULL, 'One Size Fits All', 'Light Blue', 10, 99.00, 73, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg'),
(66, 44, NULL, 'One Size Fits All', 'Orange', 10, 99.00, 73, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg'),
(67, 44, NULL, 'One Size Fits All', 'Yellow', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(68, 44, NULL, 'One Size Fits All', 'Green', 10, 99.00, 73, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg'),
(69, 44, NULL, 'One Size Fits All', 'White', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(70, 44, NULL, 'One Size Fits All', 'Brown', 10, 99.00, 73, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg'),
(71, 44, NULL, 'One Size Fits All', 'Red', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(72, 44, NULL, 'One Size Fits All', 'Pink', 10, 99.00, 73, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963236/1711148884014_mclivt.jpg'),
(73, 44, NULL, 'One Size Fits All', 'Violet', 10, 99.00, 72, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711963239/1711148883948_xuzj6f.jpg'),
(74, 45, NULL, ' Adjustable Only', ' Crown', 1, 169.00, 166, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964195/scaikvlzztnsm7q217c6.jpg'),
(75, 45, NULL, 'Adjustable Only', 'Infinity ', 20, 169.00, 166, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964195/scaikvlzztnsm7q217c6.jpg'),
(76, 46, NULL, '50ml', 'Black', 10, 150.00, 74, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964875/1711148884105_p0ixqf.jpg'),
(77, 46, NULL, '100ml ', 'Black', 10, 150.00, 75, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964869/1711148884233_sek62p.jpg'),
(78, 47, NULL, ' Adjustable', ' Original', 5, 150.00, 77, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711964830/1711148884005_kmulwg.jpg'),
(79, 48, NULL, ' One Size Fits All', ' Stellar Nexus', 5, 139.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965729/1711148884222_tndor3.jpg'),
(80, 48, NULL, 'One Size Fits All', ' Shadow Veil Circle', 5, 139.00, 94, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965732/1711148884149_ru1qca.jpg'),
(81, 48, NULL, ' One Size Fits All', ' Celestial Ember Band', 5, 149.00, 95, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965728/1711148884128_ih3too.jpg'),
(82, 48, NULL, ' One Size Fits All', '  Crystal Arcadia Loop', 5, 139.00, 96, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711965729/1711148884222_tndor3.jpg'),
(84, 49, NULL, ' Small', ' White-A', 15, 149.00, 97, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966613/1711148884188_sgczr4.jpg'),
(85, 49, NULL, ' Small', ' White-B', 15, 149.00, 98, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966596/1711148884049_k0tzqp.jpg'),
(86, 49, NULL, ' Small', ' White-C', 15, 149.00, 99, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966600/1711148884079_anmgam.jpg'),
(87, 49, NULL, ' Small', ' White-D', 15, 149.00, 100, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966615/1711148884122_uivs6p.jpg'),
(88, 49, NULL, ' Small', ' White-E', 15, 149.00, 101, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711966613/1711148884188_sgczr4.jpg'),
(89, 50, NULL, ' Medium', ' Slate Gray', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg'),
(90, 50, NULL, ' Large', ' Slate Gray', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg'),
(91, 50, NULL, ' Medium', ' Noir Black', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg'),
(92, 50, NULL, ' Large', ' Noir Black', 15, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967005/1711148883975_kafawy.jpg'),
(93, 51, NULL, ' (Small-Large)', ' White', 15, 119.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg'),
(94, 51, NULL, ' (Small-Large)', ' Cream', 15, 119.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg'),
(95, 51, NULL, ' (Small-Large)', ' Yellow', 15, 119.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg'),
(96, 51, NULL, ' (Small-Large)', ' Rust', 15, 119.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg'),
(97, 51, NULL, ' (Small-Large)', ' Black', 15, 119.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1711967217/1711148884137_so0qwe.jpg'),
(134, 1, NULL, '  Medium', '  Aqua Blue', 10, 399.00, 163, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338020017_3554416078214594_3970148051645611676_n_nhnnbp.jpg'),
(135, 1, NULL, ' Xtrasmall', ' Navy Blue', 5, 399.00, 163, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/338020017_3554416078214594_3970148051645611676_n_nhnnbp.jpg'),
(136, 69, NULL, ' Small', ' Black', 5, 399.00, 167, 'https://images.unsplash.com/photo-1618932260643-eee4a2f652a6?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(137, 69, NULL, ' Medium', ' Black', 0, 399.00, 167, 'https://images.unsplash.com/photo-1618932260643-eee4a2f652a6?q=80&w=1980&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(138, 70, NULL, ' One Size', ' Green', 5, 499.00, 168, 'https://images.unsplash.com/flagged/photo-1585052201332-b8c0ce30972f?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(139, 71, NULL, ' Medium', ' Denim', 10, 299.00, 169, 'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(140, 71, NULL, ' Large', ' Denim', 5, 299.00, 169, 'https://images.unsplash.com/photo-1591369822096-ffd140ec948f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'),
(141, 72, NULL, ' One Size', ' Black', 10, 299.00, 170, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059581/1711148884031_slen2r.jpg'),
(142, 73, NULL, ' One Size FIt', ' White', 10, 299.00, 171, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059568/1711148883957_q75i4u.jpg'),
(143, 74, NULL, 'One Size Fit', 'Mint Green', 10, 169.00, 172, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059575/1711148883971_faucdf.jpg'),
(144, 74, NULL, 'One Size Fit', 'Khaki', 5, 169.00, 172, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712059575/1711148883971_faucdf.jpg'),
(145, 75, NULL, 'Small', 'Black', 10, 150.00, 173, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259758384_4893622137348415_2840792325919206549_n_yzoidt.jpg'),
(146, 75, NULL, 'Small', 'White', 10, 150.00, 174, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259815523_4893622110681751_4947977880235199518_n_jo5gvn.jpg'),
(147, 76, NULL, 'Small', 'Black', 5, 129.00, 177, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285360/259686546_4893604564016839_12038027761664530_n_lzlexl.jpg'),
(148, 76, NULL, 'Small', 'Brown', 5, 129.00, 178, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285360/259786526_4893604674016828_2147876648725818551_n_uvir3f.jpg'),
(149, 76, NULL, 'Small', 'White', 10, 129.00, 179, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1714285361/259726219_4893604567350172_3351600969260337379_n_djpkdz.jpg'),
(151, 1, NULL, '  Small', '  Black', 1, 399.00, 2, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1712151538/337895311_1305405547064895_5666911512047497757_n_jh5ue6.jpg'),
(159, 85, NULL, 'Small', 'BG-White', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083295/290508344_5580036662040289_2444637078724338915_n_yjyxtt.jpg'),
(160, 85, NULL, '     Small', '     BG-Black', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083295/290508344_5580036662040289_2444637078724338915_n_yjyxtt.jpg'),
(161, 85, NULL, 'Medium', 'Bulls-White', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083256/290559506_5580036778706944_243073204225653531_n_ub2z1g.jpg'),
(162, 85, NULL, 'Medium', 'Bulls-Black', 5, 199.00, 0, 'https://res.cloudinary.com/dk41ykxsq/image/upload/v1713083256/290559506_5580036778706944_243073204225653531_n_ub2z1g.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `customer_id_fk` int(11) NOT NULL,
  `variation_id_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `customer_id_fk`, `variation_id_fk`) VALUES
(14, 28, 25),
(15, 39, 25),
(16, 39, 90),
(17, 28, 138);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_customer_id_fk` (`customer_id_fk`),
  ADD KEY `cart_variation_id_fk` (`variation_id_fk`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id_UNIQUE` (`category_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `message_cust_id` (`customer_id_fk`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id_UNIQUE` (`customer_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  ADD KEY `order_shipment_id_fk_idx` (`shipment_id_fk`),
  ADD KEY `order_payment_id_fk_idx` (`payment_id_fk`),
  ADD KEY `order_customer_id_fk_idx` (`customer_id_fk`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`,`order_id_fk`),
  ADD UNIQUE KEY `order_item_id_UNIQUE` (`order_item_id`),
  ADD KEY `order_item_product_id_fk_idx` (`product_id_fk`),
  ADD KEY `order_item_order_id_fk_idx` (`order_id_fk`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `payment_id_UNIQUE` (`payment_id`),
  ADD KEY `payment_customer_id_fk_idx` (`customer_id_fk`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id_UNIQUE` (`product_id`),
  ADD KEY `product_category_id_fk_idx` (`category_fk`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_images_product_id_fk_idx` (`product_id_fk`),
  ADD KEY `product_images_variation_id_fk` (`variation_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_customer_id_fk` (`customer_id_fk`),
  ADD KEY `review_order_item_id_fk` (`order_item_id_fk`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`),
  ADD UNIQUE KEY `shipment_id_UNIQUE` (`shipment_id`),
  ADD KEY `shipment_customer_id_fk_idx` (`Customer_id_fk`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`variation_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `variations_ibfk_1` (`product_id_fk`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`,`customer_id_fk`),
  ADD UNIQUE KEY `wishlist_id_UNIQUE` (`wishlist_id`),
  ADD KEY `wiish_customer_id_fk_idx` (`customer_id_fk`),
  ADD KEY `variationtid_fk_idx` (`variation_id_fk`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_customer_id_fk` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_variation_id_fk` FOREIGN KEY (`variation_id_fk`) REFERENCES `variations` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `message_cust_id` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_customer_id_fk` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_payment_id_fk` FOREIGN KEY (`payment_id_fk`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_shipment_id_fk` FOREIGN KEY (`shipment_id_fk`) REFERENCES `shipment` (`shipment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_order_id_fk` FOREIGN KEY (`order_id_fk`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_product_id_fk` FOREIGN KEY (`product_id_fk`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_customer_id_fk` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_fk` FOREIGN KEY (`category_fk`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_fk` FOREIGN KEY (`product_id_fk`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_images_variation_id_fk` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_review`
--
ALTER TABLE `product_review`
  ADD CONSTRAINT `review_customer_id_fk` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_order_item_id_fk` FOREIGN KEY (`order_item_id_fk`) REFERENCES `order_item` (`order_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_customer_id_fk` FOREIGN KEY (`Customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variations`
--
ALTER TABLE `variations`
  ADD CONSTRAINT `variations_ibfk_1` FOREIGN KEY (`product_id_fk`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `variation_id_fk` FOREIGN KEY (`variation_id_fk`) REFERENCES `variations` (`variation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wiish_customer_id_fk` FOREIGN KEY (`customer_id_fk`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
