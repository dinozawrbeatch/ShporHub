-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 29 2021 г., 15:23
-- Версия сервера: 8.0.24
-- Версия PHP: 7.3.29

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
  `course` int NOT NULL,
  `group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `course`, `group_id`) VALUES
(1, 'Мат.Анализ', 1, 1),
(2, 'Алгебра и геометрия', 1, 1),
(3, 'Основы программирования', 1, 1),
(4, 'История', 1, 1),
(5, 'Право', 2, 1),
(6, 'Цифровая культура ', 1, 1),
(8, 'Мат.Анализ', 1, 2),
(9, 'Алгебра и геометрия', 1, 2),
(10, 'Основы программирования', 1, 2),
(11, 'История', 1, 2),
(12, 'Цифровая культура', 1, 2),
(13, 'Мат.Анализ', 1, 3),
(14, 'Основы программирования', 1, 3),
(15, 'Алгебра и геометрия', 1, 3),
(16, 'История', 1, 3),
(17, 'Цифровая культура', 1, 3),
(18, 'Финансовая грамотность', 2, 1),
(19, 'Дискретная математика', 2, 1),
(20, 'Мат.Анализ', 2, 1),
(21, 'Системное программирование', 2, 1),
(22, 'Право', 2, 2),
(23, 'Финансовая грамотность', 2, 2),
(24, 'Дискретная математика', 2, 2),
(25, 'Мат.Анализ', 2, 2),
(26, 'Системное программирование', 2, 2),
(27, 'Финансовая грамотность', 2, 3),
(28, 'Дискретная математика', 2, 3),
(29, 'Мат.Анализ', 2, 3),
(30, 'Системное программирование', 2, 3),
(31, 'Физика', 3, 1),
(32, 'Кратные интегралы и ряды', 3, 1),
(33, 'Теория вероятностей', 3, 1),
(34, 'Теория автоматов', 3, 1);

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
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `shpors`
--

CREATE TABLE `shpors` (
  `id` int NOT NULL,
  `file_name` varchar(32) NOT NULL,
  `min_file_name` varchar(32) NOT NULL,
  `discipline_id` varchar(32) NOT NULL,
  `num` int NOT NULL,
  `description` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `shpor_id` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shpors`
--

INSERT INTO `shpors` (`id`, `file_name`, `min_file_name`, `discipline_id`, `num`, `description`, `type`, `shpor_id`, `date`) VALUES
(1, 'matan1', 'a', '1', 1, 'Всем привет, я работаю за еду', 'Контрольная', 1, '2021-10-06'),
(2, 'matan2', 'b', '1', 2, 'Всем привет, я работаю за еду', 'Контрольная', 1, '2021-10-06'),
(3, 'matan3', 'a', '1', 3, 'Всем привет, я работаю за еду', 'Контрольная', 1, '2021-10-06'),
(4, 'matan4', 'a', '1', 4, 'Всем привет, я работаю за еду', 'Контрольная', 1, '2021-10-06');

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
-- Индексы таблицы `shpors`
--
ALTER TABLE `shpors`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
-- AUTO_INCREMENT для таблицы `shpors`
--
ALTER TABLE `shpors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
