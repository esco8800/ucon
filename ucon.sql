-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 14 2019 г., 18:38
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ucon`
--

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(5) NOT NULL,
  `sity_delivery` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `date_request` datetime NOT NULL,
  `ip_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`id`, `sity_delivery`, `birthday`, `phone`, `text`, `date_request`, `ip_user`) VALUES
(13, 'Город не выбран', '0000-00-00', '+7(342)423-2473', '{\"Люстр\":\"3\",\"Углов\":\"4\",\"Фактура\":\"Глянцевая\",\"Итоговая цена\":667}', '2019-02-14 11:39:48', '127.0.0.1'),
(178, 'Город не выбран', '2001-02-20', '+7(345)453-5374', '{\"Фактура\":\"Глянцевая\",\"Цвет\":\"Оранжевый\"}', '2019-02-14 17:38:58', '127.0.0.1'),
(181, 'Москва', '2001-02-20', '+7(235)453-4372', '{\"Площадь потлка\":\"3\",\"Светильников\":\"4\",\"Люстр\":\"4\",\"Труб\":\"4\",\"Углов\":\"4\",\"Фактура\":\"Матовая\",\"Цвет\":\"Синий\",\"Итоговая цена\":3060}', '2019-02-14 18:37:59', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(5) NOT NULL,
  `price_m2` decimal(10,0) NOT NULL,
  `priсe_lamp` decimal(10,0) NOT NULL,
  `price_light` decimal(10,0) NOT NULL,
  `price_pipe` decimal(10,0) NOT NULL,
  `price_corner` decimal(10,0) NOT NULL,
  `price_glossy_texture` decimal(10,0) NOT NULL,
  `price_matte_texture` decimal(10,0) NOT NULL,
  `option_color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `price_m2`, `priсe_lamp`, `price_light`, `price_pipe`, `price_corner`, `price_glossy_texture`, `price_matte_texture`, `option_color`) VALUES
(1, '50', '100', '100', '100', '90', '5', '10', '{\"2\":\"Синий\",\"3\":\"Желтый\"}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(26, 'Vadim', '$2y$10$z2xmv5el5ab96bI1U7V6feQ1XEqzz37HpwYTPZOFtlqUp7myVq8n2'),
(27, 'qwe123', '$2y$10$p4qvV6Vg5ZNlppjWWmHVLOaNM2J67/t43SxX5Ft2Mdp0syDRtX3ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
