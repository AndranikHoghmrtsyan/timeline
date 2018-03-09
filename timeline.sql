-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 09 2018 г., 08:22
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `timeline`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `id_comp` int(2) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `id_comp`, `login`, `password`) VALUES
(1, 1, 'admin1', '123'),
(2, 2, 'admin2', '123'),
(3, 3, 'admin3', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(1, 'ColibriLab'),
(2, 'Colibri'),
(3, 'ARS Systems');

-- --------------------------------------------------------

--
-- Структура таблицы `timeline`
--

CREATE TABLE `timeline` (
  `id` int(5) NOT NULL,
  `user_id` int(4) NOT NULL,
  `day` date NOT NULL,
  `begin` time DEFAULT NULL,
  `lunch_begin` time DEFAULT NULL,
  `lunch_end` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `begin_time1` time NOT NULL,
  `end_time1` time NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT 'Բացատրություն...',
  `admin_desc` varchar(200) NOT NULL,
  `late` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `timeline`
--

INSERT INTO `timeline` (`id`, `user_id`, `day`, `begin`, `lunch_begin`, `lunch_end`, `end`, `begin_time1`, `end_time1`, `description`, `admin_desc`, `late`) VALUES
(48, 27, '2018-03-05', '11:22:41', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', 82),
(49, 28, '2018-03-05', '10:22:52', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', 22),
(50, 27, '2018-03-06', '12:24:21', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', 144),
(51, 28, '2018-03-06', '11:05:29', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', 65),
(52, 29, '2018-03-06', '09:27:48', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', NULL),
(53, 27, '2018-03-07', '09:03:09', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', NULL),
(54, 28, '2018-03-07', '10:20:13', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', 20),
(55, 29, '2018-03-07', '08:40:19', NULL, NULL, NULL, '09:00:00', '19:00:00', 'Բացատրություն...', '', NULL),
(56, 30, '2018-03-08', '08:29:24', '09:42:05', '20:26:52', '20:26:53', '10:00:00', '19:00:00', 'Բացատրություն...', '', -91),
(57, 27, '2018-03-08', '08:29:10', '09:41:47', '20:26:37', '20:26:40', '10:00:00', '19:00:00', 'Բացատրություն...', '', -91),
(58, 29, '2018-03-08', '08:29:37', '09:42:01', '09:54:48', '09:56:44', '08:26:00', '19:00:00', 'Բացատրություն...', '', -1),
(59, 28, '2018-03-08', '10:04:00', '09:41:00', '21:37:00', '04:12:00', '10:00:00', '19:00:00', 'dddddd', 'mmmmmm', 0),
(60, 31, '2018-03-08', '10:20:00', '10:19:09', '10:21:45', '10:23:25', '11:00:00', '19:00:00', 'Բացատրություն...', '', -40),
(61, 32, '2018-03-08', NULL, NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', NULL),
(62, 27, '2018-03-09', '08:43:24', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', -77),
(63, 28, '2018-03-09', '09:43:00', '13:00:00', '14:00:00', '19:05:00', '10:00:00', '19:00:00', 'Բացատրություն...', '', -17),
(64, 29, '2018-03-09', '08:43:34', NULL, NULL, NULL, '23:00:00', '19:00:00', 'Բացատրություն...', '', -856),
(65, 30, '2018-03-09', '08:43:38', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', -76),
(66, 31, '2018-03-09', '08:43:43', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '', -76);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL DEFAULT '123',
  `id_comp` int(2) NOT NULL,
  `begin_time` varchar(8) NOT NULL DEFAULT '10:00',
  `end_time` varchar(8) NOT NULL DEFAULT '19:00',
  `image` varchar(40) NOT NULL DEFAULT 'images/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `id_comp`, `begin_time`, `end_time`, `image`) VALUES
(27, 'ddd', 'uuuu', '123', 2, '10:00:00', '19:00:00', 'images/news151_1.jpg'),
(28, 'kkkk', 'hhhh', '123', 2, '10:00', '19:00', 'images/news160-main.jpg'),
(29, 'VVVV', 'KUPOH', '123', 2, '23:00', '19:00', 'images/news157-main.jpg'),
(30, 'Levon', 'Galstyan', '123', 2, '10:00', '19:00', 'images/news207-main.jpg'),
(31, 'xxx', 'yyy', '123', 2, '10:00', '19:00', 'images/news195-main.jpg'),
(32, 'anhayt', 'none', '123', 2, '10:00', '19:00', 'images/news223_1.png'),
(33, 'bacaka', 'bacaka', '123', 2, '10:00', '19:00', 'images/default.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
