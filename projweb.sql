-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 31 Mai 2017 à 09:20
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$0oONvsQvG6eFqmBWRczkG.A8z8Iz6bydiem245S.K5nk0.rzP/7x2', 'isOWuqedn2QqhnX9DvkFNPbq4PHRWZjdQyKAmuxuqrBsZdCezb6lUiPke1pS', '2017-05-17 14:56:32', '2017-05-17 14:56:32');

-- --------------------------------------------------------

--
-- Structure de la table `allows`
--

CREATE TABLE `allows` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `allows`
--

INSERT INTO `allows` (`product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, '<p>Salut, super <strong>produit!!!</strong></p>', 1, 1, '2017-05-18 05:12:54', '2017-05-18 05:12:54');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(123, '2014_10_12_000000_create_users_table', 1),
(124, '2014_10_12_100000_create_password_resets_table', 1),
(125, '2017_04_02_141050_create_admins_table', 1),
(126, '2017_04_02_162522_create_type_products_table', 1),
(127, '2017_04_02_162636_create_products_table', 1),
(128, '2017_04_03_124108_create_orders_table', 1),
(129, '2017_04_03_125420_create_states_table', 1),
(130, '2017_04_09_191647_create_table_allows', 1),
(131, '2017_04_09_194333_create_table_comments', 1),
(132, '2017_04_12_180401_add_columns_to_user_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `price` double(8,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `price`, `user_id`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 50000.00, 1, 1, '2017-05-18 04:54:42', '2017-05-18 04:54:42'),
(2, 50000.00, 1, 1, '2017-05-18 04:55:05', '2017-05-18 04:55:05'),
(3, 50000.00, 1, 1, '2017-05-18 04:55:12', '2017-05-18 04:55:12'),
(4, 370000.00, 1, 2, '2017-05-18 04:55:53', '2017-05-18 05:11:59');

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 1, NULL, NULL),
(3, 1, 1, NULL, NULL),
(4, 2, 4, NULL, NULL),
(4, 3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uyuni.jpg',
  `available` tinyint(1) NOT NULL,
  `stock` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `photo`, `available`, `stock`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 'Volkswagen - Scirocco', 50000, '1495040694.jpg', 1, 7, 3, '2017-05-17 15:04:54', '2017-05-18 04:55:12'),
(2, 'Tesla - Model S', 75000, '1495040866.jpg', 0, 0, 2, '2017-05-17 15:07:46', '2017-05-18 04:55:53'),
(3, 'Tesla - Model 3', 70000, '1495041006.jpg', 1, 5, 2, '2017-05-17 15:10:07', '2017-05-18 04:55:53'),
(4, 'Peugeot - 5008', 30000, '1495041120.jpg', 1, 15, 4, '2017-05-17 15:12:00', '2017-05-17 15:12:00'),
(5, 'Alfa Romeo', 55000, '1495041225.jpg', 1, 7, 4, '2017-05-17 15:13:46', '2017-05-17 15:13:46'),
(6, 'Lamborghini - Murcielago', 1300000, '1495041341.jpg', 1, 2, 1, '2017-05-17 15:15:23', '2017-05-18 04:48:03'),
(7, 'Mclaren - P1', 1200000, '1495041450.jpg', 1, 2, 1, '2017-05-17 15:17:30', '2017-05-17 15:17:30'),
(8, 'Audi - S5', 80000, '1495041650.jpg', 1, 9, 3, '2017-05-17 15:20:50', '2017-05-17 15:20:50'),
(9, 'Renault - Clio 3', 1000, '1495091870.jpg', 1, 150, 3, '2017-05-18 05:17:50', '2017-05-18 05:17:50');

-- --------------------------------------------------------

--
-- Structure de la table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'A preparer', NULL, NULL),
(2, 'Expedier', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_products`
--

CREATE TABLE `type_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `type_products`
--

INSERT INTO `type_products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sport', '2017-05-17 14:58:21', '2017-05-17 14:58:21'),
(2, 'Electric', '2017-05-17 14:59:22', '2017-05-17 14:59:22'),
(3, 'Coupe', '2017-05-17 15:01:10', '2017-05-17 15:01:10'),
(4, 'SUV', '2017-05-17 15:02:33', '2017-05-17 15:02:33');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_profile_pic.png'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `lastName`, `address`, `about`, `picture`) VALUES
(1, 'Yan', 'yan@yan.com', '$2y$10$0bBUsPBTWsJcENIdmd.sUux9UXHghZOQOZHHFHecIe9mwnaT7Rn/K', 'Yzoadz17tVdeKEfJabXmAckyEnXqQHygR9dpBXaviEImw46ZJztpJZwzHT1C', '2017-05-18 04:38:28', '2017-05-27 16:59:31', 'Livet', '12 rue Belfort', '<p>I love <strong>Chocolate!</strong></p>', '1495089611.jpg'),
(5, 'yoyo', 'yo@yo.fr', '$2y$10$ODl2EiSEfyZ0IebLxe/7oewJAKA1VDTudb7c8WM92rZql09MY9bqq', NULL, '2017-05-26 05:31:37', '2017-05-26 05:31:37', NULL, NULL, NULL, 'default_profile_pic.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_name_unique` (`name`);

--
-- Index pour la table `allows`
--
ALTER TABLE `allows`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `allows_user_id_foreign` (`user_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_product_id_foreign` (`product_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_state_id_foreign` (`state_id`);

--
-- Index pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_type_id_foreign` (`type_id`);

--
-- Index pour la table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_products`
--
ALTER TABLE `type_products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_products`
--
ALTER TABLE `type_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
