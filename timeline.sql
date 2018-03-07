-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 05 2018 г., 07:07
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
  `admin_desc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `timeline`
--

INSERT INTO `timeline` (`id`, `user_id`, `day`, `begin`, `lunch_begin`, `lunch_end`, `end`, `begin_time1`, `end_time1`, `description`, `admin_desc`) VALUES
(43, 24, '2018-03-04', '11:27:29', '11:28:22', '11:32:13', NULL, '10:00:00', '19:00:00', 'ddddddd', ''),
(44, 24, '2018-03-05', '09:06:38', '09:06:40', '09:06:41', '09:06:42', '10:00:00', '19:00:00', 'Բացատրություն...', ''),
(45, 25, '2018-03-05', '09:06:48', NULL, NULL, NULL, '10:00:00', '19:00:00', 'Բացատրություն...', '');

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
(24, 'Aram', 'Manukyan', '123', 2, '10:00', '19:00', 'images/news160-main.jpg'),
(25, 'Vazgen', 'Galoyan', '123', 2, '10:00', '19:00', 'images/news158-main.jpg');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
