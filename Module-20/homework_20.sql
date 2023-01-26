-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 06 2023 г., 01:30
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `homework_20`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `age`, `date_created`) VALUES
(1, 'up@updated.ru', 'Up', 'Updated', 33, '2023-01-06 01:23:10'),
(2, 'ivan@ivanov.ru', 'Ivan', 'Ivanov', 42, '2023-01-06 01:23:11'),
(3, 'ivan@ivanov.ru', 'Ivan', 'Ivanov', 42, '2023-01-06 01:23:12'),
(4, 'up@updated.ru', 'Up', 'Updated', 33, '2023-01-06 01:23:13'),
(5, 'ivan@ivanov.ru', 'Ivan', 'Ivanov', 42, '2023-01-06 01:23:13'),
(6, 'ivan@ivanov.ru', 'Ivan', 'Ivanov', 42, '2023-01-06 01:23:14'),
(7, 'alex.anufrienok@gmail.com', 'Aleksey', 'Anufrienok', 0, '2023-01-06 01:23:27'),
(8, 'alex.anufrienok@gmail.com', 'Aleksey', 'Anufrienok', 6, '2023-01-06 01:23:34'),
(9, 'alecvxvxcvxcvxcvnufrienok@gmail.com', 'zx\\z\\xzx\\z\\zx', 'AlexeAnufrie\\zxx\\z\\xznok', 0, '2023-01-06 01:23:56'),
(10, 'alex.anufrienok@gmail.com', 'aa', 'AlexeAnufrienok', 0, '2023-01-06 01:25:49');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
