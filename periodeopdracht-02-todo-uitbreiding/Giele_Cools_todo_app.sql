-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 20 jan 2015 om 17:30
-- Serverversie: 5.6.20
-- PHP-versie: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `Giele_Cools_todo_app`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `done` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Gegevens worden geëxporteerd voor tabel `items`
--

INSERT INTO `items` (`id`, `user_id`, `name`, `done`, `created_at`, `updated_at`) VALUES
(36, 2, 'Database voor todo-app exporteren', 0, '2015-01-20 15:30:15', '2015-01-20 15:30:15');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_09_200558_create_users_table', 1),
('2015_01_12_193517_create_items_table', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'giele@test.be', '$2y$10$seVcbxJYbY44QvClyYwwv.ySgdwN8A8l0zLvRPQLKuu2i5So57f0a', 'TGXRa0JOIIPSWH6dTuhEQ9kJiiSxFLtPkTSr05S6YPGx0W8bLCG8i4Kzr4R9', '0000-00-00 00:00:00', '2015-01-20 15:28:11'),
(2, 'giele.cools@student.kdg.be', '$2y$10$/F3AuKINGjtSH03xkWsg1OZJEyIIk7JTxNUMi5q7oravKodT9tt2K', 'lIpQHlklsmthWnUQMiKKYL610XzCuaEmpEhEMXTmDi3yHZ7DARLmJUWzJMDj', '2015-01-16 09:46:40', '2015-01-20 15:30:30'),
(3, 'test@test.be', '$2y$10$.8Z.JGhfcxSi.KKVL9Xy/eTYVBYhicCGM9i.j8tfiFaSQSNuIsWwe', 'T3MrI54ZubBO0P7nG8g9Y8kaCbY3THHObjrBMchv4prp0WlQ65aBdSZrvZyE', '2015-01-16 09:51:45', '2015-01-20 15:29:06'),
(4, 'testregister@test.com', '$2y$10$Z/f7/LPQkJvLB17cWSWGU.DPgrW11.QPJ47YipppRrqBiCwD6.ZMu', 'pw7yQyoJSXmtqkRdSNbCKlaqr8Z6MsB0dA3NVlGloMknJB0xYxNjCej4PJiQ', '2015-01-20 15:15:21', '2015-01-20 15:28:53');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
