-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Kas 2024, 14:52:13
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `emailcode`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `ad` text DEFAULT NULL,
  `email` text NOT NULL,
  `sifre` text DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `verification_code` text NOT NULL,
  `verification_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `email`
--

INSERT INTO `email` (`id`, `ad`, `email`, `sifre`, `token`, `verification_code`, `verification_at`) VALUES
(51, 'ali', 'ali@gmail.com', 'asdasdasda', 'qwe12asd1dasd1sde152+e912+3123/123121-3131*23', 'qwe12asd1/2*173/172/38412+e+s/-1*2weqweq', '2026-11-18 16:50:35');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
