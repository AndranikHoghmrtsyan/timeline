-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 16 2018 г., 14:21
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `timeline`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `timeline` (
  `user_id` int(4) NOT NULL,
  `day` date NOT NULL,
  `begin` varchar(8) DEFAULT NULL,
  `lunch_begin` varchar(8) DEFAULT NULL,
  `lunch_end` varchar(8) DEFAULT NULL,
  `end` varchar(8) DEFAULT NULL,
  `description` varchar(200) NOT NULL DEFAULT 'Բացատրություն...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `timeline`
--

INSERT INTO `timeline` (`user_id`, `day`, `begin`, `lunch_begin`, `lunch_end`, `end`, `description`) VALUES
(1, '2018-02-14', '15 : 56', '15 : 57', NULL, NULL, 'esim..'),
(4, '2018-02-14', '15 : 57', NULL, NULL, NULL, 'tenc...'),
(3, '2018-02-14', '15 : 59', NULL, NULL, NULL, 'Բացատրություն...'),
(1, '2018-02-15', '09 : 58', '10 : 23', NULL, NULL, 'Բացատրություն...'),
(3, '2018-02-16', '15 : 42', '16 : 43', NULL, NULL, 'Բացատրություն...'),
(6, '2018-02-16', NULL, NULL, NULL, NULL, 'Բացատրություն...');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(4) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `id_comp` int(2) NOT NULL,
  `begin_time` varchar(8) NOT NULL DEFAULT '10 : 00',
  `lunch_begin_time` varchar(8) NOT NULL DEFAULT '13 : 00',
  `lunch_end_time` varchar(8) NOT NULL DEFAULT '14 : 00',
  `end_time` varchar(8) NOT NULL DEFAULT '19 : 00',
  `image` varchar(40) NOT NULL DEFAULT 'images/default.jpg'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `id_comp`, `begin_time`, `lunch_begin_time`, `lunch_end_time`, `end_time`, `image`) VALUES
(1, 'Andranik', 'Hoghmrtsyan', '123', 1, '10:00', '13:00', '14:00', '19:00', 'images/default.jpg'),
(2, 'Albert', 'Hoghmrtsyan', '123', 2, '10:00', '13:00', '14:00', '19:00', 'images/default.jpg'),
(3, 'Artur', 'Hoghmrtsyan', '123', 3, '10:00', '13:00', '14:00', '19:00', 'images/artur.jpg'),
(4, 'Vardan', 'Vardanyan', '123', 1, '09:00', '13:00', '14:00', '19:00', 'images/011.jpg'),
(5, 'Vardan', 'Vardanyan', '123', 2, '09:00', '13:00', '14:00', '19:00', 'images/default.jpg'),
(6, 'Vardan', 'Vardanyan', '123', 3, '09:00', '13:00', '14:00', '19:00', 'images/default.jpg'),
(8, 'Aram', 'Sargsyan', '123', 3, '10 : 00', '13 : 00', '14 : 00', '19 : 00', 'images/news134-main.jpg'),
(9, 'Sargis', 'Martirosyan', '123', 3, '10 : 00', '13 : 00', '14 : 00', '19 : 00', 'images/news33 .jpg'),
(10, 'www', 'wwww', '123', 3, '10 : 00', '13 : 00', '14 : 00', '19 : 00', 'images/58.jpg'),
(11, 'aaa', 'bbb', '123', 3, '10 : 00', '13 : 00', '14 : 00', '19 : 00', 'images/image.thumb.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
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
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
