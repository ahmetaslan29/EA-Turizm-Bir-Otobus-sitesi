-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Haz 2019, 20:07:46
-- Sunucu sürümü: 10.1.39-MariaDB
-- PHP Sürümü: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `otobus`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `biletler`
--

CREATE TABLE `biletler` (
  `bilet_id` int(11) NOT NULL,
  `kullanici_id` int(11) DEFAULT NULL,
  `ad` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soyad` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cinsiyet` tinyint(4) NOT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tc` varchar(11) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_turkish_ci NOT NULL,
  `sefer_id` int(11) NOT NULL,
  `koltuk_no` tinyint(4) NOT NULL,
  `durum` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `biletler`
--

INSERT INTO `biletler` (`bilet_id`, `kullanici_id`, `ad`, `soyad`, `cinsiyet`, `eposta`, `tc`, `tel`, `sefer_id`, `koltuk_no`, `durum`) VALUES
(6, 0, 'Emre', 'Tanrıverdi', 1, 'emretanriverdi@gmail.com', '37975401242', '3333333333333', 21, 1, 1),
(22, 0, 'emre', 'demir', 1, 'deneme@gmail.com', '11111111111', '3333333333333', 13, 1, 1),
(23, 0, 'ahmet', 'demir', 1, 'deneme@gmail.com', '11111111111', '3333333333333', 13, 2, 1),
(24, 0, 'Sema', 'demir', 0, 'deneme@gmail.com', '11111111111', '3333333333333', 23, 4, 1),
(25, 0, 'Sude', 'demir', 0, 'deneme@gmail.com', '11111111111', '3333333333333', 23, 5, 1),
(26, 0, 'Hüseyin', 'Akgül', 1, 'deneme@gmail.com', '12312432423', '1232423423423', 22, 28, 1),
(27, 0, 'Ayşe', 'Akgül', 0, 'deneme@gmail.com', '37975401242', '3333333333333', 23, 37, 1),
(28, 0, 'Ahmet', 'demir', 1, 'deneme@gmail.com', '22222222222', '3333333333333', 13, 15, 1),
(29, 0, 'emre', 'demir', 1, 'deneme@gmail.com', '37975401242', '1111111111111', 23, 35, 1),
(30, 0, 'Ahmet', 'emre', 0, 'e@gmail.com', '22222222222', '3333333333333', 25, 47, 1),
(31, 0, 'emre', 'demir', 1, 'deneme@gmail.com', '37975401242', '1111111111111', 23, 35, 1),
(32, 0, 'Ahmet', 'emre', 0, 'e@gmail.com', '22222222222', '3333333333333', 25, 47, 1),
(33, 0, 'emre', 'demir', 1, 'deneme@gmail.com', '37975401242', '1111111111111', 23, 35, 1),
(34, 0, 'Ahmet', 'emre', 0, 'e@gmail.com', '22222222222', '3333333333333', 25, 47, 1),
(36, 0, 'deneme', 'denemsoyad', 0, 'deneme@hotmail.com', '55555555555', '6666666666666', 26, 33, 1),
(37, 2, 'deme2', 'denem2', 1, 'deneme@gmail.comm', '11111111112', '7777777777777', 26, 32, 1),
(38, 0, 'Ayşe', 'denemsoyad', 0, 'deneme@gmail.com', '11111111111', '3333333333333', 26, 7, 1),
(39, 0, 'Emre', 'Akgül', 1, 'emretanriverdi@gmail.com', '11111111111', '3333333333333', 28, 19, 1),
(40, 0, 'Ahmet', 'demir', 0, 'deneme@gmail.com', '11111111111', '1231231232131', 29, 35, 1),
(41, 0, 'sdf', 'sdfs', 1, 'a@sdfsfs.com', '12312432423', '1111111111111', 31, 15, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duraklar`
--

CREATE TABLE `duraklar` (
  `durak_id` int(11) NOT NULL,
  `sehir_id` int(11) NOT NULL,
  `adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `duraklar`
--

INSERT INTO `duraklar` (`durak_id`, `sehir_id`, `adi`) VALUES
(176, 1, 'Adana Merkez Otogarı'),
(177, 2, 'Adıyaman Otogarı'),
(178, 3, 'Afyon Otogarı'),
(179, 4, 'Ağrı Otogarı'),
(180, 68, 'Aksaray Otogarı'),
(181, 5, 'Amasya Otogarı'),
(182, 6, 'Ankara Otogarı'),
(183, 7, 'Antalya Otogarı'),
(184, 75, 'Ardahan Otogarı'),
(185, 8, 'Artvin Otogarı'),
(186, 9, 'Aydın Otogarı'),
(187, 10, 'Balıkesir Otobüs Terminali'),
(188, 74, 'Bartın Otogarı'),
(189, 72, 'Batman Otogarı'),
(190, 69, 'Bayburt Otogarı'),
(191, 11, 'Bilecik Otogarı'),
(192, 14, 'Bolu Otogarı'),
(193, 15, 'Burdur Otogarı'),
(194, 16, 'Burulaş Bursa Otogarı'),
(195, 17, 'Çanakkale Otogarı'),
(196, 18, 'Çankırı Otogarı'),
(197, 19, 'Çorum Otogarı'),
(198, 20, 'Denizli Otogarı'),
(199, 21, 'Diyarbakır Otogarı'),
(200, 34, 'İstanbul Dudullu Terminali'),
(201, 81, 'Düzce Otogarı'),
(202, 22, 'Edirne Otogarı'),
(203, 23, 'Elazığ Otogarı'),
(204, 24, 'Erzincan Otogarı'),
(205, 25, 'Erzurum Otogarı'),
(206, 26, 'Eskişehir Otogarı'),
(207, 27, 'Gaziantep Otogarı'),
(208, 28, 'Giresun Otogarı'),
(209, 29, 'Gümüşhane Otogarı'),
(210, 31, 'Hatay Otogarı'),
(211, 32, 'Isparta Otogarı'),
(212, 34, 'İstanbul Esenler Otogarı'),
(213, 34, 'İstanbul Harem Otogarı'),
(214, 35, 'İZOTAŞ İzmir Otogarı'),
(215, 46, 'Kahramanmaraş Otogarı'),
(216, 78, 'Karabük Otogarı'),
(217, 70, 'Karaman Otogarı'),
(218, 37, 'Kastamonu Otogarı'),
(219, 38, 'Kayseri Otogarı'),
(220, 71, 'Kırıkkale Otogarı'),
(221, 39, 'Kırklareli Otogarı'),
(222, 40, 'Kırşehir Otogarı'),
(223, 41, 'Kocaeli Otogarı'),
(224, 42, 'Konya Otogarı'),
(225, 43, 'Kütahya Otogarı'),
(226, 44, 'Malatya Otogarı'),
(227, 45, 'Manisa Otogarı'),
(228, 47, 'Mardin Otogarı'),
(229, 33, 'MEŞOT Mersin Otogarı'),
(230, 48, 'Muğla Otogarı'),
(231, 49, 'Muş Otogarı'),
(232, 50, 'Nevşehir Otogarı'),
(233, 51, 'Niğde Otogarı'),
(234, 52, 'Ordu Otogarı'),
(235, 80, 'Osmaniye Otogarı'),
(236, 53, 'Rize Otogarı'),
(237, 54, 'Sakarya Otogarı'),
(238, 55, 'Samsun Otogarı'),
(239, 56, 'Siirt Otogarı'),
(240, 57, 'Sinop Otogarı'),
(241, 58, 'Sivas Otogarı'),
(242, 63, 'Şanlıurfa Otogarı'),
(243, 59, 'Tekirdağ Otogarı'),
(244, 60, 'Tokat Otogarı'),
(245, 61, 'Trabzon Otogarı'),
(246, 64, 'Uşak Otogarı'),
(247, 77, 'Yalova Otogarı'),
(248, 66, 'Yozgat Otogarı'),
(249, 67, 'Zonguldak Otogarı'),
(250, 77, 'Yalova Otogar'),
(251, 52, 'Ünye Otogarı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `ad` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `soyad` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cinsiyet` tinyint(4) NOT NULL,
  `eposta` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `tc` varchar(11) COLLATE utf8mb4_turkish_ci NOT NULL,
  `yetki` tinyint(4) NOT NULL,
  `tel` varchar(13) COLLATE utf8mb4_turkish_ci NOT NULL,
  `durum` tinyint(4) NOT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `dogum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `ad`, `soyad`, `cinsiyet`, `eposta`, `tc`, `yetki`, `tel`, `durum`, `sifre`, `dogum`) VALUES
(2, 'Ahmet', 'Aslan', 1, 'aslan@hotmail.com', '11111111111', 0, '123 456 78 99', 0, '111', '2019-06-04'),
(3, 'Emre', 'Tanrıverdi', 1, 'admin@gmail.com', '00000000000', 1, '123 456 78 99', 0, '000', '1997-12-02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `otobusler`
--

CREATE TABLE `otobusler` (
  `otobus_id` int(11) NOT NULL,
  `marka_model` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `cikis_yili` smallint(4) NOT NULL,
  `tipi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL,
  `kapasite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `otobusler`
--

INSERT INTO `otobusler` (`otobus_id`, `marka_model`, `cikis_yili`, `tipi`, `kapasite`) VALUES
(1, 'Mercedes Benz', 2011, '2+1', 37),
(2, 'Setra S415', 2015, '2+2', 50),
(3, 'Renault Cabine', 2018, '2+2', 50),
(5, 'Mercedes Benz', 2019, '2+1', 37),
(7, 'Mercedes V', 2019, '2+1', 37);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `seferler`
--

CREATE TABLE `seferler` (
  `sefer_id` int(11) NOT NULL,
  `otobus_id` int(11) NOT NULL,
  `kalkis_tarihi` datetime NOT NULL,
  `varis_tarihi` datetime NOT NULL,
  `kalkis_otogar` int(11) NOT NULL,
  `varis_otogar` int(11) NOT NULL,
  `fiyat` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `seferler`
--

INSERT INTO `seferler` (`sefer_id`, `otobus_id`, `kalkis_tarihi`, `varis_tarihi`, `kalkis_otogar`, `varis_otogar`, `fiyat`) VALUES
(4, 1, '2019-06-06 11:11:00', '2019-06-07 12:12:00', 176, 179, 100),
(5, 2, '2019-06-06 11:11:00', '2019-06-07 12:12:00', 176, 192, 100),
(6, 2, '2019-06-06 11:11:00', '2019-06-07 12:12:00', 176, 214, 100),
(7, 1, '2019-06-29 12:45:00', '2019-06-30 12:12:00', 245, 187, 80),
(8, 1, '2019-06-29 12:45:00', '2019-06-30 12:12:00', 245, 187, 80),
(9, 1, '2019-06-29 12:45:00', '2019-06-30 12:12:00', 245, 187, 80),
(10, 1, '2019-06-13 05:03:00', '2019-06-14 14:20:00', 176, 193, 80),
(11, 3, '2019-06-24 04:10:00', '2019-06-25 00:10:00', 208, 183, 150),
(12, 3, '2019-06-17 00:30:00', '2019-06-17 08:30:00', 208, 192, 80),
(13, 1, '2019-06-20 06:45:00', '2019-06-21 04:25:00', 177, 176, 150),
(19, 1, '2019-06-29 04:00:00', '2019-06-29 05:00:00', 176, 249, 789),
(21, 7, '2019-06-29 23:54:00', '2019-06-29 23:59:00', 176, 177, 100),
(22, 2, '2019-06-28 05:02:00', '2019-06-29 05:07:00', 176, 177, 456),
(23, 1, '2019-06-16 04:03:00', '2019-06-22 02:02:00', 176, 177, 80),
(24, 1, '2019-06-16 12:00:00', '2019-06-16 22:00:00', 176, 176, 150),
(25, 2, '2019-06-23 03:45:00', '2019-06-23 04:54:00', 177, 176, 900),
(26, 2, '2019-06-20 07:00:00', '2019-06-20 12:30:00', 176, 177, 50),
(27, 1, '2019-06-21 23:00:00', '2019-06-21 23:59:00', 177, 176, 100),
(28, 7, '2019-06-26 07:00:00', '2019-06-26 19:00:00', 224, 251, 50),
(29, 1, '2019-06-29 07:00:00', '2019-06-29 19:00:00', 251, 224, 50),
(30, 2, '2019-06-20 12:00:00', '2019-06-22 23:00:00', 176, 177, 80),
(31, 1, '2019-06-19 07:30:00', '2019-06-21 19:00:00', 176, 177, 90),
(32, 1, '2019-06-18 19:00:00', '2019-06-19 06:00:00', 176, 177, 150),
(33, 1, '2019-06-20 20:00:00', '2019-06-21 09:15:00', 176, 177, 90),
(34, 1, '2019-06-20 18:00:00', '2019-06-21 07:00:00', 177, 176, 80),
(35, 7, '2019-06-21 19:00:00', '2019-06-22 08:00:00', 177, 176, 90),
(36, 1, '2019-06-21 18:00:00', '2019-06-22 07:00:00', 177, 176, 100),
(37, 1, '2019-06-22 10:00:00', '2019-06-23 01:00:00', 177, 176, 100),
(38, 3, '2019-06-23 23:00:00', '2019-06-24 09:00:00', 177, 176, 85);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sehirler`
--

CREATE TABLE `sehirler` (
  `sehir_id` int(11) NOT NULL,
  `adi` varchar(255) COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `sehirler`
--

INSERT INTO `sehirler` (`sehir_id`, `adi`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyonkarahisar'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elazığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkâri'),
(31, 'Hatay'),
(32, 'Isparta'),
(33, 'İçel (Mersin)'),
(34, 'İstanbul'),
(35, 'İzmir'),
(36, 'Kars'),
(37, 'Kastamonu'),
(38, 'Kayseri'),
(39, 'Kırklareli'),
(40, 'Kırşehir'),
(41, 'Kocaeli'),
(42, 'Konya'),
(43, 'Kütahya'),
(44, 'Malatya'),
(45, 'Manisa'),
(46, 'Kahramanmaraş'),
(47, 'Mardin'),
(48, 'Muğla'),
(49, 'Muş'),
(50, 'Nevşehir'),
(51, 'Niğde'),
(52, 'Ordu'),
(53, 'Rize'),
(54, 'Sakarya'),
(55, 'Samsun'),
(56, 'Siirt'),
(57, 'Sinop'),
(58, 'Sivas'),
(59, 'Tekirdağ'),
(60, 'Tokat'),
(61, 'Trabzon'),
(62, 'Tunceli'),
(63, 'Şanlıurfa'),
(64, 'Uşak'),
(65, 'Van'),
(66, 'Yozgat'),
(67, 'Zonguldak'),
(68, 'Aksaray'),
(69, 'Bayburt'),
(70, 'Karaman'),
(71, 'Kırıkkale'),
(72, 'Batman'),
(73, 'Şırnak'),
(74, 'Bartın'),
(75, 'Ardahan'),
(76, 'Iğdır'),
(77, 'Yalova'),
(78, 'Karabük'),
(79, 'Kilis'),
(80, 'Osmaniye'),
(81, 'Düzce');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `biletler`
--
ALTER TABLE `biletler`
  ADD PRIMARY KEY (`bilet_id`);

--
-- Tablo için indeksler `duraklar`
--
ALTER TABLE `duraklar`
  ADD PRIMARY KEY (`durak_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`,`tc`);

--
-- Tablo için indeksler `otobusler`
--
ALTER TABLE `otobusler`
  ADD PRIMARY KEY (`otobus_id`);

--
-- Tablo için indeksler `seferler`
--
ALTER TABLE `seferler`
  ADD PRIMARY KEY (`sefer_id`);

--
-- Tablo için indeksler `sehirler`
--
ALTER TABLE `sehirler`
  ADD PRIMARY KEY (`sehir_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `biletler`
--
ALTER TABLE `biletler`
  MODIFY `bilet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Tablo için AUTO_INCREMENT değeri `duraklar`
--
ALTER TABLE `duraklar`
  MODIFY `durak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `otobusler`
--
ALTER TABLE `otobusler`
  MODIFY `otobus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `seferler`
--
ALTER TABLE `seferler`
  MODIFY `sefer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
