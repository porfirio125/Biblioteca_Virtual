-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 01:10:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'todo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `portada` varchar(255) DEFAULT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `descripcion`, `portada`, `pdf`, `categoria_id`) VALUES
(4, '100 Años De Soledad ', 'Escrita por Gabriel Garzia Marquez', '100años de soledad.jpg', '100 años de soledad.pdf', 1),
(5, 'El Mundo Es Ancho Y Ajeno', 'Escrito por Ciro Alegria', 'Ciro_alegria_el_mundo_es_ancho_y_ajeno.jpg', 'CiroAlegria_El mundo es ancho y ajeno.PDF', 1),
(6, 'El Huerto De MI Amada', 'Escrito por Alfredo Brice Echenique', 'el huerto de mi amada.jpg', 'El huerto de mi amada.pdf', 1),
(7, 'Los Rios Profundos', 'Escrito Por Jose Maria Arguedas', 'los rios profundos.jpg', 'Los ríos profundos.pdf', 1),
(8, 'La Ciudad De los Tisicos', 'Escrito Por Abraham Valdelomar', 'la ciudad de los tisicos.jpg', 'la ciudad de los tisicos.pdf', 1),
(9, 'Trilce', 'Escrita Por Cesar Ballejo', 'trilce.jpg', 'trilce.pdf', 1),
(10, 'La Serpiente De Oro', 'Escrito Porb Ciro Alegria', 'la serpiente de oro.jpg', 'La serpiente de oro.pdf', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `rol`) VALUES
(1, 'Porfirio', '$2y$10$ruBBNbtko2rfUP2LV7g43eRx4soySYRMkp1ObNnESkEfNb9u4zB2C', 'admin'),
(6, 'Yuly', '$2y$10$lYUn2ZSwaHqRYg1mLXGnbud1yzwbztQnYYLeUAqFrGzG6dYPSNLDi', 'usuario'),
(7, 'Sulmy', '$2y$10$7GaAkhVsLCrSK2i5zOwiQuXN1jk8kDz7yhwrWWaeLJT.Iz80997e6', 'usuario'),
(8, 'Admin', '$2y$10$zVH663h9NQY/tt25j9UiIeY6M2uFdZyhiyrAF5mS4g/9hGscBrsQq', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
