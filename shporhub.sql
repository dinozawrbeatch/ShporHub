-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 15 2021 г., 14:38
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shporhub`
--

-- --------------------------------------------------------

--
-- Структура таблицы `disciplines`
--

CREATE TABLE `disciplines` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `course` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `course`) VALUES
(1, 'matan', 1),
(2, 'aig', 1),
(3, 'oop', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `code`) VALUES
(1, 'ивт', 'ОБ-09.03.01.01-21'),
(2, 'иис', 'ОБ-09.03.03.02-21'),
(3, 'пи', 'ОБ-09.03.02.01-21');

-- --------------------------------------------------------

--
-- Структура таблицы `groups_discipline`
--

CREATE TABLE `groups_discipline` (
  `id` int NOT NULL,
  `group_id` int NOT NULL,
  `discipline_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `groups_discipline`
--

INSERT INTO `groups_discipline` (`id`, `group_id`, `discipline_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `shpora`
--

CREATE TABLE `shpora` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `file_name` varchar(32) NOT NULL,
  `status` int NOT NULL,
  `discipline_id` varchar(32) NOT NULL,
  `num` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `hash` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `course` int NOT NULL,
  `group_id` int NOT NULL,
  `token` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `hash`, `course`, `group_id`, `token`, `is_admin`) VALUES
(15, 'dadada', 'vasya', '2cfdb368ba1e20bd0d8c5b838f380843', 1, 1, '', 0),
(16, 'fafafa', 'vasya', '601e55dcbe9ec76a8e980d9a16369069', 1, 1, '601e55dcbe9ec76a8e980d9a16369069', 0),
(17, 'popapisya', 'vasya', '7c343f9872517c6a897106bcc09d88d3', 1, 1, '156269bf3d95a00891b9c584c9363237', 0),
(18, 'elprimo', 'megachlen', 'b2691c960fb69e0a32cfeb991998fdf6', 1, 1, 'c728e9f13cce4f7de15c44df9cd832f1', 0),
(27, 'elprimo1', 'megachlen', '9a2e4e4167be98577fc1ee370510d23a', 1, 1, '489565cfa0d07713d1c685a38c30c555', 0),
(28, 'elprimo12', '', '5b2d5982f1bb451c4232eb975cc6655b', 1, 1, '985659846af9ce7ee684e1232bef4ccb', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `groups_discipline`
--
ALTER TABLE `groups_discipline`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shpora`
--
ALTER TABLE `shpora`
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
-- AUTO_INCREMENT для таблицы `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `groups_discipline`
--
ALTER TABLE `groups_discipline`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `shpora`
--
ALTER TABLE `shpora`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
