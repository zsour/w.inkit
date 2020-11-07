-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 07 nov 2020 kl 21:02
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

--
-- Dumpning av Data i tabell `about`
--

INSERT INTO `about` (`id`, `info_block`, `title`, `live`, `order_of_info`, `image`, `imageStyle`) VALUES
(8, '[\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\r\\n\\r\\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"]', 'About My Art', 1, 1, '', ''),
(15, '[\"I like to paint.\"]', 'New Header', 1, 2, '', ''),
(16, '', '', 1, 3, '../public/img/uploadedImages/5f88824f8d5e88.45663759.png', '');

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
(63, '[{\"id\":\"58\",\"quantity\":\"1\",\"priceDuringOrder\":\"85.00\"},{\"id\":\"60\",\"quantity\":\"2\",\"priceDuringOrder\":\"33.00\"}]', 'daniel.karlsson36@outlook.com', 'Sweden', 'Varberg', '0739808116', '432 47', 'Gråhallsvägen 23', '5f3ef0f41cede', 1, 0, 'Daniel Karlsson', '9hfmhj69', '2020/08/20 23:54:08', 0, '0'),
(64, '[{\"id\":\"58\",\"quantity\":\"1\",\"priceDuringOrder\":\"85.00\"}]', 'malinp82@gmail.com', 'Sverige', 'Varberg', '0762300722', '43242', 'Thulegatan 9D', '5f43af03d35eb', 1, 0, 'Malin Wejrot', '73xnz0cp', '2020/08/24 14:14:27', 0, '0'),
(65, '[{\"id\":\"57\",\"quantity\":\"1\",\"priceDuringOrder\":\"94.00\"}]', 'malinp82@gmail.com', 'Sverige', 'Varberg', '0762300722', '43242', 'Thulegatan 9D', '5f43b53494da7', 1, 0, 'Malin Wejrot', 'a1hka0q0', '2020/08/24 14:41:00', 0, '0');

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
(56, 'Walk on water - Limited Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '85.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f3eee450a2d57.01622719.jpg\"]', 'This print is part of my series of masked girls. They all took part in an exhibition this summer and each one is a limited edition of 25.\r\n\r\n\"Walk on water\"\r\n\r\nThe paper is 54 x 39 cm and the print is 31 x 20,5 cm\r\n\r\n\r\nHandmade Linocut Linoprint, B/W Limited edition of 25 prints, featuring a girl walking in the water wearing a mask.\r\n\r\nPrinted with care from an self made original linoleum carving\r\n\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n-The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it\'s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:42:29', '2020-08-20 23:42:29', '0.00', '0.00', '0.00', '40.00', 2, 1, 3),
(57, 'I Love You (pink) - Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '94.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f3eee99e63c95.46024958.jpg\"]', 'Handmade Linocut Linoprint, B/W featuring Mary making a heart with her hands.\r\n\r\n.............................................................\r\n.............................................................\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n- The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it\'s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:43:53', '2020-08-20 23:43:53', '0.00', '0.00', '0.00', '0.00', 3, 1, 4),
(58, 'Geisha - Limited Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '85.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f3eeeffd2a703.91877302.jpg\"]', 'Handmade Linocut Linoprint, Made from two linoplates for two colour print - Limited edition of 25 prints, featuring a Geisha.\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n- The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it\'s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:45:35', '2020-08-20 23:45:35', '400.00', '530.00', '0.00', '0.00', 2, 0, 5),
(59, 'Lemons - Limited Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '50.00', '85.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f3eef3f01bcb4.85798775.jpg\"]', 'Lemons - Original Handmade Linocut Linoprint, A multicolour block print, B/W and yellow Limited edition of 60 prints, featuring lemons. The print measures about 26 x 26 centimetres.\r\n\r\nPrinted with care from an self made original linoleum carving\r\n\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n- The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it’s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:46:39', '2020-08-20 23:46:39', '260.00', '260.00', '0.00', '30.00', 3, 1, 2),
(60, 'Star Wars - Hoth - Limited Linoleum Edition Linocut Block Handprinted on Hahnemühle Paper', '33.00', '50.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f3eefa086c4e4.68240354.jpg\"]', 'Hoth - Original Handcarved\r\n\r\nThis is one of my print from my Star Wars series with six selected planet/places from the movies.\r\n\r\nPrinted with care from an self made original linoleum carving\r\n\r\nHoth was a remote, icy planet that was the sixth planet in the star system of the same name. It notably hosted Echo Base, the temporary headquarters of the Alliance to Restore the Republic, until the Galactic Empire located the Rebels, initiating a major confrontation known as the Battle of Hoth.\r\n\r\nHandmade Linocut Linoprint, B/W Limited edition of 100 prints, featuring the planet Hoth from Star Wars\r\n\r\n\r\n- Handcarved in Lino and handpulled on a press – each print is an unique, original, handmade artwork, signed and numbered by the artist\r\n\r\n- Hand-finished edges, so you can frame it with a mount or with edges exposed as you prefer :)\r\n\r\n- As each print is handmade and unique, there may be tiny variations from the one pictured here.\r\n\r\n-The linocut is on beautiful quality Hahnemühle 230gsm subtly textured fine art paper, chosen for it\'s quality colour reproduction and archivability.\r\n\r\n- All materials used are of archival quality, so if treated correctly this artwork will last for centuries to come\r\n\r\n- Limited edition printed in Black on white\r\n\r\nNB In this edition some prints shows some of the traces from the block - this is deliberate artistic choice, and is by no means to be considered as a flaw.', 0, '2020-08-20 23:48:16', '2020-08-20 23:48:16', '195.00', '265.00', '0.00', '20.00', 2, 1, 1),
(61, 'Queen B', '50.00', '0.00', 0, '[\"..\\/public\\/img\\/uploadedImages\\/5f43b173e83610.39531638.jpg\"]', 'Queen B, Handmade linoleum', 0, '2020-08-24 14:24:19', '2020-08-24 14:24:19', '160.00', '230.00', '0.00', '0.00', 2, 1, 6);

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
(26, 1, 'Test', '', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT för tabell `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
