-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 07 aug 2020 kl 00:58
-- Serverversion: 10.4.13-MariaDB
-- PHP-version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `info_block` text NOT NULL,
  `title` text NOT NULL,
  `live` int(5) NOT NULL,
  `order_of_info` int(5) NOT NULL,
  `image` text NOT NULL,
  `imageStyle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `about`
--

INSERT INTO `about` (`id`, `info_block`, `title`, `live`, `order_of_info`, `image`, `imageStyle`) VALUES
(1, '[\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\",\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"]', 'About Me', 0, 1, '', ''),
(7, '', 'My Art', 0, 2, '', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `address` text NOT NULL,
  `organization_num` text NOT NULL,
  `email` text NOT NULL,
  `country` text NOT NULL,
  `city` text NOT NULL,
  `zip` text NOT NULL,
  `company_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `company`
--

INSERT INTO `company` (`id`, `full_name`, `address`, `organization_num`, `email`, `country`, `city`, `zip`, `company_name`) VALUES
(0, 'Daniel Karlsson', 'Gråhallsvägen 23', '200004241337', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '432 47', 'Kubkompaniet');

-- --------------------------------------------------------

--
-- Tabellstruktur `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `cart` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `unique_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `paid` int(1) NOT NULL DEFAULT 0,
  `archived` int(1) NOT NULL DEFAULT 0,
  `full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `braintree_id` varchar(255) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `shipped` int(2) NOT NULL DEFAULT 0,
  `refunded` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`id`, `cart`, `email`, `country`, `city`, `phone`, `zip`, `address`, `unique_id`, `paid`, `archived`, `full_name`, `braintree_id`, `payment_date`, `shipped`, `refunded`) VALUES
(51, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f2314cd74581', 1, 1, 'Daniel Karlsson', '32wrdpjf', '2020/07/30 20:43:37', 0, '[{\"id\":\"45\",\"quantity\":\"1\",\"priceDuringOrder\":\"79.00\"},{\"id\":\"43\",\"quantity\":3,\"priceDuringOrder\":\"79.00\"}]'),
(52, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f2314fc6d21f', 1, 1, 'Daniel Karlsson', '1w10v7f1', '2020/07/30 20:44:21', 0, '[{\"id\":\"44\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":1,\"priceDuringOrder\":\"68.98\"}]'),
(53, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f2315278c07d', 1, 1, 'Daniel Karlsson', 'nnvmt6wr', '2020/07/30 20:45:06', 0, '[{\"id\":\"45\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":2,\"priceDuringOrder\":\"68.98\"}]'),
(54, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f235ce0722ac', 1, 1, 'Daniel Karlsson', 'ernk3xr8', '2020/07/31 01:51:09', 0, '[{\"id\":\"42\",\"quantity\":2,\"priceDuringOrder\":\"68.98\"},{\"id\":\"44\",\"quantity\":3,\"priceDuringOrder\":\"79.00\"}]'),
(55, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f235d13831c5', 1, 1, 'Daniel Karlsson', '89pmj575', '2020/07/31 01:51:57', 0, '[{\"id\":\"45\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":1,\"priceDuringOrder\":\"68.98\"},{\"id\":\"43\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"44\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"}]'),
(56, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f235d3e5c5e6', 1, 1, 'Daniel Karlsson', 'g27rhxhy', '2020/07/31 01:52:38', 0, '[{\"id\":\"45\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":1,\"priceDuringOrder\":\"68.98\"}]'),
(57, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f235d6f47189', 1, 1, 'Daniel Karlsson', '75x2jnq6', '2020/07/31 01:53:26', 0, '[{\"id\":\"45\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":2,\"priceDuringOrder\":\"68.98\"}]'),
(58, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f2409ed89f25', 1, 1, 'Daniel Karlsson', 'edhmrqfg', '2020/07/31 14:09:28', 0, '[{\"id\":\"42\",\"quantity\":2,\"priceDuringOrder\":\"68.98\"},{\"id\":\"45\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"44\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"}]'),
(59, '[]', 'daniel.karlsson36@outlok.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f240a1d8e277', 1, 1, 'Daniel Karlsson', 'cjg6zdhc', '2020/07/31 14:10:15', 0, '[{\"id\":\"43\",\"quantity\":2,\"priceDuringOrder\":\"79.00\"},{\"id\":\"44\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"}]'),
(60, '[]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f240a499a905', 1, 1, 'Daniel Karlsson', 'pv07qmnp', '2020/07/31 14:10:58', 0, '[{\"id\":\"43\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"},{\"id\":\"42\",\"quantity\":1,\"priceDuringOrder\":\"68.98\"},{\"id\":\"44\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"},{\"id\":\"45\",\"quantity\":1,\"priceDuringOrder\":\"79.00\"}]');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `category` int(5) NOT NULL,
  `image` text NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `archived` int(5) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `production_value` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `category`, `image`, `description`, `archived`, `created`, `updated`, `width`, `height`, `weight`, `production_value`, `quantity`) VALUES
(42, 'Acrobatic - Limited Linoleum Edition Linocut Block Handprinted on Hahnem?hle Paper', '68.98', '79.99', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5e8c6b770fb035.13860806.jpg\"]', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '0000-00-00 00:00:00', '2020-07-30 01:10:31', '0.00', '0.00', '0.30', '30.00', 10),
(43, 'Your Future - Limited Linoleum Edition Linocut Block Handprinted on Hahnem?hle Paper', '79.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5e8c6b8948a724.76759272.jpg\"]', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '0000-00-00 00:00:00', '2020-07-04 19:36:28', '0.00', '0.00', '0.00', '30.00', 2),
(44, 'Moon(shine)', '79.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5e8c6bc1b27901.25603008.jpg\"]', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '0000-00-00 00:00:00', '2020-07-04 19:36:34', '0.00', '0.00', '0.00', '30.00', 2),
(45, 'Freebird - Limited Linoleum Edition Linocut Block Handprinted on Hahnem?hle Paper', '79.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5e8c6b9d658e11.22011587.jpg\"]', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '0000-00-00 00:00:00', '2020-07-04 19:36:40', '0.00', '0.00', '0.00', '30.00', 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` int(5) NOT NULL,
  `order_of_conditions` int(5) NOT NULL DEFAULT 0,
  `title` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `terms_conditions` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `live` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `order_of_conditions`, `title`, `terms_conditions`, `live`) VALUES
(23, 1, 'Test', '[\"Test\"]', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `joined` datetime NOT NULL,
  `groups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `groups`) VALUES
(35, 'z_sour', '8ec28773ceee96afd633df261cae91356cd6913996a002274a2f8c49f4e873f1', 'c3b5040b14236b9ea214209eb08e69df', 'Daniel Karlsson', '2020-05-16 21:35:14', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT för tabell `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT för tabell `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
