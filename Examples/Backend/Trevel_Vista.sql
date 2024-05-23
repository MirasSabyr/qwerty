-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2024 г., 20:56
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
-- База данных: `Trevel Vista`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Маршруты`
--

CREATE TABLE `Маршруты` (
  `startPos` int NOT NULL,
  `stopPos` int NOT NULL,
  `distance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Маршруты`
--

INSERT INTO `Маршруты` (`startPos`, `stopPos`, `distance`) VALUES
(1, 2, 2822);

-- --------------------------------------------------------

--
-- Структура таблицы `Маршруты`
--

CREATE TABLE `Пользователи` (
  `id` int NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Пользователи`
--

INSERT INTO `Пользователи` (`id`, `firstName`, `secondName`,`isAdmin`) VALUES
(1, 'Али', 'Нурланулы',1),
(2, 'Мирас', 'Сабыр',0),
(3, 'Ерхан', 'Котик',0);
-- --------------------------------------------------------

--
-- Структура таблицы `Отели`
--

CREATE TABLE `Отели` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countryId` int NOT NULL,
  `stars` tinyint NOT NULL,
  `costPerNight` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Отели`
--

INSERT INTO `Отели` (`id`, `name`, `countryId`, `stars`, `costPerNight`) VALUES
(1, 'Cosmos St.Petersburg Olympia Garden Hotel', 1, 4, 45984),
(2, 'Апарт-отель Port Comfort on Ligovsky 4*', 1, 4, 34216);

-- --------------------------------------------------------

--
-- Структура таблицы `Билеты`
--

CREATE TABLE `Билеты` (
  `id` int NOT NULL,
  `airport` int NOT NULL,
  `hotelId` int NOT NULL,
  `userId` int NOT NULL,
  `cost` int NOT NULL,
  `days` tinyint NOT NULL,
  `nights` tinyint NOT NULL,
  `departureTime` datetime NOT NULL,
  `landingTime` datetime NOT NULL,
  `isAdult` tinyint(1) NOT NULL DEFAULT '1',
  `isHaveLinks` tinyint(1) NOT NULL DEFAULT '0',
  `links` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Билеты`
--

INSERT INTO `Билеты` (`id`, `airport`, `hotelId`, `userId`, `cost`, `days`, `nights`, `departureTime`, `landingTime`, `isAdult`, `isHaveLinks`, `links`) VALUES
(1, 2, 1, 1, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 1, 1, '2,3'),
(2, 2, 1, 2, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 0, 1, '1'),
(3, 2, 1, 3, 112509, 1, 2, '2024-05-22 22:20:00', '2024-06-03 14:30:00', 0, 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `Страны`
--

CREATE TABLE `Страны` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Страны`
--

INSERT INTO `Страны` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Казахстан');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Отели`
--
ALTER TABLE `Отели`
  ADD PRIMARY KEY (`id`);
--
-- Индексы таблицы `Пользователи`
--
ALTER TABLE `Пользователи`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Билеты`
--
ALTER TABLE `Билеты`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Страны`
--
ALTER TABLE `Страны`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Отели`
--
ALTER TABLE `Отели`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Пользователи`
--
ALTER TABLE `Пользователи`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Билеты`
--
ALTER TABLE `Билеты`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Страны`
--
ALTER TABLE `Страны`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
