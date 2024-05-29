-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 29 2024 г., 17:46
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Trevel_Vista`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Countries`
--

CREATE TABLE `Countries` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Countries`
--

INSERT INTO `Countries` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Казахстан'),
(3, 'Турция'),
(4, 'Америка');

-- --------------------------------------------------------

--
-- Структура таблицы `Hotels`
--

CREATE TABLE `Hotels` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars` tinyint NOT NULL,
  `costPerNight` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Hotels`
--

INSERT INTO `Hotels` (`id`, `name`, `country`, `stars`, `costPerNight`) VALUES
(1, 'Cosmos St.Petersburg Olympia Garden Hotel', 'Россия', 4, 45984),
(2, 'Апарт-отель Port Comfort on Ligovsky 4*', 'Россия', 4, 34216),
(3, 'Sultan Palace Hotel', 'Казахстан', 5, 45000),
(4, 'Atyrau Executive Apartments', 'Казахстан', 5, 36000),
(5, 'Beluga Hotel', 'Казахстан', 4, 32000),
(6, 'SULO Atyrau Hotel', 'Казахстан', 3, 26500),
(7, 'Mini Hotel Venezia', 'Казахстан', 2, 15000),
(8, 'Station Hostel', 'Казахстан', 0, 4800),
(9, 'Bricks Hotel İstanbul', 'Турция', 5, 86596),
(10, 'Green Star Pera Hotel', 'Турция', 4, 21043),
(11, 'GalataportWawhotel', 'Турция', 3, 36803),
(12, 'Han Hotel', 'Турция', 2, 17733),
(13, 'happy dreams ekonomik otel', 'Турция', 1, 10223),
(14, 'The Estes Park Resort', 'США', 4, 138958),
(15, 'Pine Haven Resort', 'США', 3, 79017),
(16, 'Columbine Inn', 'США', 2, 52203),
(17, 'Лотте Отель Санкт-Петербург', 'Россия', 5, 193562),
(18, 'Отель Статский Советник на Кустарном', 'Россия', 3, 33947),
(19, 'Отель Roof Story (Истории Крыш)', 'Россия', 2, 26800),
(20, 'Отель Номера на Гончарной', 'Россия', 0, 19102);

-- --------------------------------------------------------

--
-- Структура таблицы `Routes`
--

CREATE TABLE `Routes` (
  `id` int NOT NULL,
  `startPos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stopPos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Routes`
--

INSERT INTO `Routes` (`id`, `startPos`, `stopPos`, `distance`) VALUES
(1, 'Россия', 'Казахстан', 2822),
(2, 'Россия', 'Турция', 5248),
(3, 'Россия', 'США', 8881),
(4, 'Казахстан', 'Турция', 2727),
(5, 'Казахстан', 'США', 10403),
(6, 'Турция', 'США', 10152);

-- --------------------------------------------------------

--
-- Структура таблицы `Tickets`
--

CREATE TABLE `Tickets` (
  `id` int NOT NULL,
  `airport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotelId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int NOT NULL,
  `cost` int NOT NULL,
  `days` tinyint NOT NULL,
  `nights` tinyint NOT NULL,
  `departureTime` datetime NOT NULL,
  `landingTime` datetime NOT NULL,
  `isAdult` tinyint(1) NOT NULL DEFAULT '1',
  `isHaveLinks` tinyint(1) NOT NULL DEFAULT '0',
  `links` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Tickets`
--

INSERT INTO `Tickets` (`id`, `airport`, `hotelId`, `userId`, `cost`, `days`, `nights`, `departureTime`, `landingTime`, `isAdult`, `isHaveLinks`, `links`) VALUES
(1, 'Казахстан', 'Россия', 1, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 1, 1, '2,3'),
(2, 'Казахстан', 'Россия', 2, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 0, 1, '1'),
(3, 'Казахстан', 'Россия', 3, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 0, 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `nameUpdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `password`, `firstName`, `secondName`, `isAdmin`, `nameUpdate`) VALUES
(1, 'ali', 'a', 'Али', 'Нурланулы', 1, NULL),
(2, 'Miras', 'Mmiras_2007', 'Мирас', 'Сабыр', 0, NULL),
(3, 'Cat', 'IamCAT!', 'Ерхан', 'КотикНяша', 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Countries`
--
ALTER TABLE `Countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Hotels`
--
ALTER TABLE `Hotels`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Routes`
--
ALTER TABLE `Routes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Countries`
--
ALTER TABLE `Countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Hotels`
--
ALTER TABLE `Hotels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `Routes`
--
ALTER TABLE `Routes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
