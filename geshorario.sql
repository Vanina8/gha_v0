-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2020 a las 12:56:42
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `geshorario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `id` int(11) NOT NULL,
  `codigo` varchar(15) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`id`, `codigo`, `nombre`, `estado`) VALUES
(88, 'Ing-Com1', 'Compiladores 1', 1),
(89, 'Ing-Log1', 'Lógica Matemática 1', 1),
(90, 'Ing-IA1', 'Inteligencia artificial 1', 0),
(91, 'Ing-IA2', 'Inteligencia Artificial 2', 1),
(92, 'Ges-Met1', 'Metodología 1', 1),
(93, 'Ges-GF', 'Gestión Financiera', 0),
(95, 'Cal-Ing1', 'Calculo 1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `id` int(3) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id`, `nombre`, `estado`, `id_categoria`) VALUES
(6, 'A-102', 0, 6),
(10, 'A-110', 0, 6),
(11, 'A-108', 0, 6),
(13, 'A-101', 0, 11),
(14, 'A-201', 0, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaaula`
--

CREATE TABLE `categoriaaula` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriaaula`
--

INSERT INTO `categoriaaula` (`id`, `nombre`) VALUES
(6, 'Sant Jaume'),
(11, 'Sant Miquel'),
(13, 'Sant Antoni');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curricula`
--

CREATE TABLE `curricula` (
  `id` int(11) NOT NULL,
  `id_titulo` int(2) NOT NULL,
  `codigo_asig` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curricula`
--

INSERT INTO `curricula` (`id`, `id_titulo`, `codigo_asig`) VALUES
(60, 19, 'Ing-Com1'),
(61, 19, 'Ing-Log1'),
(62, 19, 'Ing-IA1'),
(63, 19, 'Ing-IA2'),
(64, 22, 'Ges-Met1'),
(65, 21, 'Ges-GF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`, `descripcion`) VALUES
(1, '1ero.', ''),
(4, '1ero. D', ''),
(5, '2do A', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_asig`
--

CREATE TABLE `grupo_asig` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_asig` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo_asig`
--

INSERT INTO `grupo_asig` (`id`, `id_grupo`, `id_asig`) VALUES
(31, 1, 92),
(32, 1, 91),
(34, 5, 89),
(35, 5, 91),
(37, 4, 92),
(38, 5, 88),
(39, 4, 89),
(40, 4, 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(6) NOT NULL,
  `semestre` int(1) NOT NULL,
  `curso` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `semestre`, `curso`) VALUES
(5, 1, '2020'),
(6, 2, '2020'),
(7, 0, ''),
(8, 0, '2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id` int(3) NOT NULL,
  `nombres` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `clave` varchar(300) CHARACTER SET utf8 NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_rol` int(1) NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 NOT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id`, `nombres`, `apellidos`, `dni`, `email`, `clave`, `estado`, `id_rol`, `telefono`, `foto`) VALUES
(86, 'Romina', 'Queralt Ensenyat ', '693458745f', 'romina@gmail.com', '$2y$10$wcDxiVa4OeAVo6nh3rhbBedzdbkM8EQjOrzwImvn/Yw5FwhMSgNLy', 1, 11, '695214585', '../api/login/foto_perfil/perfil.jpg'),
(87, 'Maria Elena', 'Villegas Villegas', '63254125e', 'maria@gmail.com', '$2y$10$M4iM1AbEclAwJbmCvsaX7ugzdMHJx/5TnY5zZakphFwPJCvsCUa8y', 1, 12, '85265412', '../api/login/foto_perfil/perfil.jpg'),
(89, 'Marta ', 'Lambea Azcona', '45214523g', 'marta@gmail.com', '$2y$10$GZSx0akwwWO/40y5T4GBsO0FS9QykIdkF8rsPcKbdk9RFv3RpTrFi', 1, 12, '475852145', '../api/login/foto_perfil/perfil.jpg'),
(90, 'Felipe', 'Márquez Ruíz', '6325412t', 'felipe@gmail.com', '$2y$10$WlyHwidPaQKXLrStUooLEOLI/EzxYWSugRmKIeFkP.Lnd.1KSh7we', 1, 10, '693458741', '../api/login/foto_perfil/perfil.jpg'),
(92, 'Fany', 'Chávez Vega', '23658596f', 'fany@gmail.com', '$2y$10$gbjBN70NQhHaOSlNyKioSehZZWUnUuDM4sOOyyk5K9fkUKYHttg42', 1, 10, '693254581', '../api/login/foto_perfil/perfil.jpg'),
(93, 'Maria Tereza', 'Ciurliza', '3698545g', 'mariat@gmail.com', '$2y$10$.qfsomBsowtasETxB.AoAO9pPFG2L.xl6iH4WR9qw7.4e0zs3SR/a', 1, 12, '695124574', '../api/login/foto_perfil/perfil.jpg'),
(94, 'Amelia', 'Rivera Chumbes', '2654125t', 'amelia@gmail.com', '$2y$10$kGcMGSPat.Nfxp4d7bsBmOrIDRJG9a5/eleQbZ/eTFrNQElinEHci', 1, 12, '987582145', '../api/login/foto_perfil/perfil.jpg'),
(95, 'Katucha', 'Bento Fernandez', '5621423h', 'katucha@gmail.com', '$2y$10$BlsdEMt.fEheidHcvENWIeYmtNujEXLg802PbRZK/zzzQiEXAN9Mm', 0, 12, '693254587', '../api/login/foto_perfil/perfil.jpg'),
(96, 'Jose', 'Rivera Rovira', '23654215f', 'jose@gmail.com', '$2y$10$FohRas24JZe5kjWQNvVG5O.QU/JZdxw3XZITmSdy4piu3da16JSD2', 1, 12, '852654126', '../api/login/foto_perfil/perfil.jpg'),
(98, 'Sonia', 'Ramirez Alvarado', '63254125h', 'sonia@gmail.com', '$2y$10$cea02kXwooO12YTbg1nEReVo1TUTMObd3crTFEd.VAyuk2P0Q3WkK', 1, 12, '695214584', '../api/login/foto_perfil/perfil.jpg'),
(99, 'Fernanda', 'Medez Suarez', '3652145r', 'fernanda@gmail.com', '$2y$10$fzVDO6gtFw6dymNwwvpboOsK/tEhw0qfSacbGAwWwMCR5L62lCITO', 1, 12, '695421452', '../api/login/foto_perfil/3652145r.png'),
(100, 'Luisa', 'Muñoz Solis', '6321252f', 'luisa@gmail.com', '$2y$10$exLb2FyCKzCOwhWKtNCov.1hVlWQeD4DFng19q.mhB74c0A/oG/KC', 1, 12, '695478521', '../api/login/foto_perfil/perfil.jpg'),
(102, 'Alicia', 'Aguirre Zapata', '23658545k', 'alicia@gmail.com', '$2y$10$.sNPGi.i8i7LfevyEQI6wO96g2X7K2S/b6c8SwRsZC.xf.l5pv/2C', 1, 10, '', '../api/login/foto_perfil/perfil.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profe_asig`
--

CREATE TABLE `profe_asig` (
  `id` int(10) NOT NULL,
  `id_profe` int(3) NOT NULL,
  `id_asig` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profe_asig`
--

INSERT INTO `profe_asig` (`id`, `id_profe`, `id_asig`) VALUES
(26, 89, 88),
(27, 87, 89),
(28, 87, 91),
(29, 89, 92),
(30, 98, 89),
(31, 98, 88),
(32, 96, 88),
(33, 96, 95),
(34, 94, 89),
(35, 94, 91);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(1) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(10, 'Administrador'),
(11, 'Coordinador'),
(12, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion`
--

CREATE TABLE `sesion` (
  `id` int(11) NOT NULL,
  `id_aula` int(3) NOT NULL,
  `id_tramo` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_asig` int(11) NOT NULL,
  `id_profe` int(3) NOT NULL,
  `id_horario` int(6) NOT NULL,
  `dia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sesion`
--

INSERT INTO `sesion` (`id`, `id_aula`, `id_tramo`, `id_grupo`, `id_asig`, `id_profe`, `id_horario`, `dia`) VALUES
(61, 11, 12, 5, 91, 87, 5, 2),
(62, 11, 12, 5, 91, 87, 5, 4),
(63, 10, 19, 5, 91, 78, 5, 5),
(64, 11, 12, 5, 91, 87, 5, 3),
(65, 13, 13, 5, 91, 87, 5, 1),
(66, 10, 20, 5, 91, 87, 5, 3),
(67, 13, 20, 5, 91, 78, 5, 2),
(68, 6, 13, 4, 92, 89, 5, 5),
(69, 11, 19, 5, 91, 78, 5, 3),
(70, 10, 13, 4, 92, 89, 5, 3),
(71, 6, 12, 4, 92, 89, 5, 2),
(72, 6, 15, 4, 92, 89, 5, 2),
(73, 13, 15, 1, 91, 87, 5, 2),
(74, 6, 15, 5, 89, 78, 5, 1),
(75, 10, 12, 5, 88, 89, 5, 5),
(76, 14, 12, 1, 92, 89, 5, 4),
(77, 14, 12, 1, 91, 78, 5, 2),
(78, 10, 19, 1, 91, 94, 5, 3),
(79, 11, 19, 1, 91, 94, 5, 1),
(80, 11, 15, 1, 91, 94, 5, 1),
(81, 11, 19, 1, 92, 89, 5, 4),
(82, 10, 12, 4, 95, 96, 5, 1),
(83, 10, 19, 4, 89, 98, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo`
--

CREATE TABLE `titulo` (
  `id` int(2) NOT NULL,
  `nombre` varchar(35) CHARACTER SET utf8 NOT NULL,
  `curso` varchar(15) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `titulo`
--

INSERT INTO `titulo` (`id`, `nombre`, `curso`) VALUES
(2, 'Arquitectura', '2020'),
(3, 'Ingenieria Multimedia', '2020'),
(21, 'Máster en Gestión de las TIC', '2020'),
(22, 'Máster en Gestión Financiera', '2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramos`
--

CREATE TABLE `tramos` (
  `id` int(11) NOT NULL,
  `inicio` varchar(5) DEFAULT NULL,
  `fin` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tramos`
--

INSERT INTO `tramos` (`id`, `inicio`, `fin`) VALUES
(12, '10:00', '11:00'),
(13, '11:30', '12:30'),
(15, '09:00', '10:00'),
(19, '08:00', '09:00'),
(20, '12:30', '13:32'),
(21, '07:44', '07:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoriaaula`
--
ALTER TABLE `categoriaaula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `curricula`
--
ALTER TABLE `curricula`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `grupo_asig`
--
ALTER TABLE `grupo_asig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `usuario` (`email`);

--
-- Indices de la tabla `profe_asig`
--
ALTER TABLE `profe_asig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sesion`
--
ALTER TABLE `sesion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulo`
--
ALTER TABLE `titulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tramos`
--
ALTER TABLE `tramos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categoriaaula`
--
ALTER TABLE `categoriaaula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `curricula`
--
ALTER TABLE `curricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupo_asig`
--
ALTER TABLE `grupo_asig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `profe_asig`
--
ALTER TABLE `profe_asig`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `sesion`
--
ALTER TABLE `sesion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `titulo`
--
ALTER TABLE `titulo`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tramos`
--
ALTER TABLE `tramos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
