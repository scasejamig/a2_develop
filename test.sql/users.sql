-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 18 2024 г., 12:39
-- Версия сервера: 10.4.20-MariaDB
-- Версия PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` bigint(19) UNSIGNED NOT NULL,
  `village_id` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `plot_id` varchar(255) NOT NULL DEFAULT '',
  `access` tinyint(1) NOT NULL DEFAULT 0,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` bigint(14) UNSIGNED NOT NULL DEFAULT 0,
  `phone_code` varchar(4) NOT NULL DEFAULT '',
  `phone_attempts_code` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `phone_attempts_sms` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `updated` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `last_login` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `plots` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `village_id`, `plot_id`, `access`, `first_name`, `last_name`, `email`, `phone`, `phone_code`, `phone_attempts_code`, `phone_attempts_sms`, `updated`, `last_login`, `plots`) VALUES
(1, 1, '1', 1, 'Carrol', 'Fernandez', 'test1@gmail.com', 971000000001, '1111', 0, 8, 0, 1686239445, ''),
(2, 1, '2', 1, 'Martin', 'Kurian', 'test2@gmail.com', 971000000002, '1111', 0, 0, 0, 1686227116, ''),
(3, 1, '3', 1, 'Nisha', 'Banchi', 'test3@gmail.com', 971000000003, '1111', 0, 0, 0, 1686227116, ''),
(4, 1, '4', 1, 'Umang', 'Nayak', 'test4@gmail.com', 971000000004, '1111', 0, 0, 0, 1686227116, ''),
(5, 1, '5', 1, 'Mahira', 'Hussain', 'test5@gmail.com', 971000000005, '1111', 0, 0, 0, 1686227116, ''),
(6, 1, '6', 1, 'Muhammad ', 'Ali', 'test6@gmail.com', 971000000006, '1111', 0, 0, 0, 1686227116, ''),
(7, 1, '7', 1, 'Yanina', 'Payares', 'test7@gmail.com', 971000000007, '1111', 0, 0, 0, 1686227116, ''),
(8, 1, '8', 1, 'Iffat', 'Shahzad', 'test8@gmail.com', 971000000008, '1111', 0, 0, 0, 1686227116, ''),
(9, 1, '9', 1, 'Izem', 'Yilmaz', 'test9@gmail.com', 971000000009, '1111', 0, 0, 0, 1686227116, ''),
(10, 1, '5', 1, 'Mhiz', 'Brainy', 'test10@gmail.com', 971000000010, '1111', 0, 0, 0, 1686227116, ''),
(11, 1, '7', 1, 'Nasir', 'Mughal', 'test11@gmail.com', 971000000011, '1111', 0, 0, 0, 1686227116, ''),
(12, 1, '12', 1, 'Jorgen', 'Jorgensen', 'test12@gmail.com', 971000000012, '1111', 0, 0, 0, 1686227116, ''),
(13, 1, '13', 1, 'Lennis', 'Nabalayo', 'test13@gmail.com', 971000000013, '1111', 0, 0, 0, 1686227116, ''),
(14, 1, '5', 1, 'Vipul', 'Bansode', 'test14@gmail.com', 971000000014, '1111', 0, 0, 0, 1686227116, ''),
(15, 1, '15', 1, 'Marina', 'Fonf', 'test15@gmail.com', 971000000015, '1111', 0, 0, 0, 1686227116, ''),
(16, 1, '16', 1, 'Shamir', 'Khan', 'test16@gmail.com', 971000000016, '1111', 0, 0, 0, 1686227116, ''),
(17, 1, '17', 1, 'Ricardo', 'Sabularse', 'test17@gmail.com', 971000000017, '1111', 0, 0, 0, 1686227116, ''),
(18, 1, '18', 1, 'Roger', 'Alam', 'test18@gmail.com', 971000000018, '1111', 0, 0, 0, 1686227116, ''),
(19, 1, '19', 1, 'Vam', 'Kannambra', 'test19@gmail.com', 971000000019, '1111', 0, 0, 0, 1686227116, ''),
(20, 1, '20', 1, 'Naiel', 'Zemour', 'test20@gmail.com', 971000000020, '1111', 0, 0, 0, 1686227116, ''),
(21, 1, '21', 1, 'Sajad', 'Bobs', 'test21@gmail.com', 971000000021, '1111', 0, 0, 0, 1686227116, ''),
(22, 1, '20', 1, 'Mumtaz', 'Falak', 'test22@gmail.com', 971000000022, '1111', 0, 0, 0, 1686227116, ''),
(23, 1, '23', 1, 'Nazia', 'Khan', 'test23@gmail.com', 971000000023, '1111', 0, 0, 0, 1686227116, ''),
(24, 0, '24', 0, 'Nazia', 'Khan', 'test23@gmail.com', 971000000023, '', 0, 0, 1705576872, 0, ''),
(25, 0, '25', 0, 'Nazia', 'Khan', 'test23@gmail.com', 971000000023, '', 0, 0, 1705576872, 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `plot_id` (`plot_id`(191)) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
