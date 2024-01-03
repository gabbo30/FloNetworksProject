-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-12-2023 a las 07:08:07
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `photogram`
--
CREATE DATABASE IF NOT EXISTS `photogram` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `photogram`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `friendships`
--

CREATE TABLE `friendships` (
  `id_user` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `post_text` longtext CHARACTER SET utf8 COLLATE utf8_spanish2_ci,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `photo`, `date`, `post_text`, `lat`, `lon`) VALUES
(1, 1, '', '2023-12-29 01:20:36', 'Hola. Esta es mi primera publicaci&oacute;n.', NULL, NULL),
(2, 2, '', '2023-12-29 01:45:56', 'Esta tambi&eacute;n es mi primera publicaci&oacute;n.\r\nMe gusta metallica lml', NULL, NULL),
(3, 3, '', '2023-12-29 06:50:27', 'Dale like a mi post! :c', NULL, NULL),
(4, 1, '', '2023-12-29 10:29:57', 'Nota mental: No comprometerse a hacer proyectos importantes en v&iacute;speras navide&ntilde;as. Gracias :(', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts_likes`
--

CREATE TABLE `posts_likes` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts_likes`
--

INSERT INTO `posts_likes` (`id_post`, `id_user`) VALUES
(3, 3),
(3, 2),
(1, 2),
(1, 4),
(2, 1),
(4, 2),
(4, 4),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `lastname`, `password`, `profile_pic`, `active`) VALUES
(1, 'junior.gibson.lp@gmail.com', 'Gabriel', 'Rodriguez', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1),
(2, 'ricardoarr@gmail.com', 'Ricardo', 'Arredondo', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1),
(3, 'abigail7u7@outlook.es', 'Abigail', 'Gonzalez', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1),
(4, 'alexmeraz@hotmail.com', 'Alejandro', 'Meraz', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_location`
--

CREATE TABLE `users_location` (
  `id_location` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_location`
--

INSERT INTO `users_location` (`id_location`, `id_user`, `lat`, `lon`) VALUES
(5, 1, '31.73774180113787', '-106.43332500489349'),
(6, 2, '14.870689713134091', '5.275600361508173');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `users_location`
--
ALTER TABLE `users_location`
  ADD PRIMARY KEY (`id_location`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users_location`
--
ALTER TABLE `users_location`
  MODIFY `id_location` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
