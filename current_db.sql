-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 09 nov 2020 kl 12:55
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.2.30

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
  `company_name` text NOT NULL,
  `instagram_link` text NOT NULL,
  `twitter_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `company`
--

INSERT INTO `company` (`id`, `full_name`, `address`, `organization_num`, `email`, `country`, `city`, `zip`, `company_name`, `instagram_link`, `twitter_link`) VALUES
(0, 'Daniel Karlsson', 'Gråhallsvägen 23', '20000424-XXXX', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '432 47', 'Kubkompaniet', 'https://www.instagram.com/w.inkit/?hl=sv', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `info_block` text NOT NULL,
  `title` text NOT NULL,
  `live` int(5) NOT NULL,
  `order_of_info` int(5) NOT NULL,
  `image` text NOT NULL,
  `imageStyle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(63, '[{\"id\":\"58\",\"quantity\":\"1\",\"priceDuringOrder\":\"85.00\"}]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f3ef0f41cede', 1, 0, 'Daniel Karlsson', '9hfmhj69', '2020/08/20 23:54:08', 0, '0');

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
  `quantity` int(11) NOT NULL,
  `live` int(5) NOT NULL DEFAULT 1,
  `order_of_product` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `category`, `image`, `description`, `archived`, `created`, `updated`, `width`, `height`, `weight`, `production_value`, `quantity`, `live`, `order_of_product`) VALUES
(58, 'Geisha - Limited Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '85.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5fa92bc6083440.95325811.jpg\"]', 'Handmade Linocut Linoprint, Made from two linoplates for two colour print - Limited edition of 25 prints, featuring a Geisha.\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n- The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it\'s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:45:35', '2020-11-09 12:45:10', '400.00', '530.00', '0.00', '0.00', 2, 0, 5);

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
(38, 'w.inkit', '682a9250c3b6792040d1368e3c93a55f858321a389767687e8e8aac1bfa3d994', 'ebbe17edc88fa1bd21960f49de28ad38', 'Malin Wejrot', '2020-08-20 23:08:36', 1);

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
-- Index för tabell `faq`
--
ALTER TABLE `faq`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT för tabell `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT för tabell `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT för tabell `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
