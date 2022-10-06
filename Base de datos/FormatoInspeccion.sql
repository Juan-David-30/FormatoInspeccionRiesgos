-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-10-2022 a las 05:10:13
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS FormatoInspeccion; 
CREATE DATABASE IF NOT EXISTS FormatoInspeccion; 
USE FormatoInspeccion; 

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `FormatoInspeccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CodFact`
--

CREATE TABLE `CodFact` (
  `id_CF` varchar(25) NOT NULL,
  `id_GF` int(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `CodFact`
--

INSERT INTO `CodFact` (`id_CF`, `id_GF`, `Nombre`) VALUES
('1A', 1, 'Temperaturas extremas'),
('1B', 1, 'Niveles de luz natural inadecuados'),
('1C', 1, 'Aireación natural deficiente'),
('1D', 1, 'Humedad relativa y lluvias'),
('1E', 1, 'Electricidad atmosférica'),
('1F', 1, 'Presiones barométricas anormales'),
('2A', 2, 'Tipo físico(no mecánico)'),
('2B', 2, 'Tipo químico'),
('2C', 2, 'Tipo biológico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empresa`
--

CREATE TABLE `Empresa` (
  `id` int(10) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Direcccion` varchar(100) NOT NULL,
  `Telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Empresa`
--

INSERT INTO `Empresa` (`id`, `Nombre`, `Direcccion`, `Telefono`) VALUES
(1, 'ITD Juan Del Corral IED', 'No se xd', 310771823),
(2, 'Magdalena Ortega', 'cra no se', 501915), (3, 'Platzi', 'Todo el mundo, es web', 3100150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Fuente`
--

CREATE TABLE `Fuente` (
  `id_Fuen` int(10) NOT NULL,
  `id_CF` varchar(25) NOT NULL,
  `Descripcion` text NOT NULL,
  `id_Info` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `GrupoFact`
--

CREATE TABLE `GrupoFact` (
  `id_GF` int(10) NOT NULL,
  `Nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `GrupoFact`
--

INSERT INTO `GrupoFact` (`id_GF`, `Nombre`) VALUES 
(1, 'Ambiente de trabajo microclima'),
(2, 'Contaminante Físico'),
(3, 'Insalubridad locativa y ambiental deficiente'),
(4, 'Sobrecarga física'),
(5, 'Psicosociales productores de sobrecarga psíquica'),
(6, 'Productores de inseguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Informacion`
--

CREATE TABLE `Informacion` (
  `id` int(10) NOT NULL,
  `Elaborado` varchar(255) NOT NULL,
  `Area` varchar(255) NOT NULL,
  `Empresa` int(10) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MetodoInstalado`
--

CREATE TABLE `MetodoInstalado` (
  `idMetodo` int(10) NOT NULL,
  `Descripcion` text NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `id_Puest` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MetodoRecomendado`
--

CREATE TABLE `MetodoRecomendado` (
  `idMetodo` int(10) NOT NULL,
  `Descripcion` text NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `id_Puest` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PuestosAfect`
--

CREATE TABLE `PuestosAfect` (
  `id_Puest` int(10) NOT NULL,
  `id_Sec` int(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `NumExp` int(255) NOT NULL,
  `P` int(100) NOT NULL,
  `E` int(100) NOT NULL,
  `C` int(100) NOT NULL,
  `Resultado` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Seccion`
--

CREATE TABLE `Seccion` (
  `id_Sec` int(10) NOT NULL,
  `id_Fuen` int(10) NOT NULL,
  `NombreSec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `CodFact`
--
ALTER TABLE `CodFact`
  ADD PRIMARY KEY (`id_CF`),
  ADD KEY `id_GF` (`id_GF`);

--
-- Indices de la tabla `Empresa`
--
ALTER TABLE `Empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Fuente`
--
ALTER TABLE `Fuente`
  ADD PRIMARY KEY (`id_Fuen`),
  ADD KEY `id_Info` (`id_Info`),
  ADD KEY `id_CF` (`id_CF`);

--
-- Indices de la tabla `GrupoFact`
--
ALTER TABLE `GrupoFact`
  ADD PRIMARY KEY (`id_GF`);

--
-- Indices de la tabla `Informacion`
--
ALTER TABLE `Informacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Empresa` (`Empresa`);

--
-- Indices de la tabla `MetodoInstalado`
--
ALTER TABLE `MetodoInstalado`
  ADD PRIMARY KEY (`idMetodo`),
  ADD KEY `id_Puest` (`id_Puest`);

--
-- Indices de la tabla `MetodoRecomendado`
--
ALTER TABLE `MetodoRecomendado`
  ADD PRIMARY KEY (`idMetodo`),
  ADD UNIQUE KEY `id_Puest` (`id_Puest`);

--
-- Indices de la tabla `PuestosAfect`
--
ALTER TABLE `PuestosAfect`
  ADD PRIMARY KEY (`id_Puest`),
  ADD KEY `id_Sec` (`id_Sec`);

--
-- Indices de la tabla `Seccion`
--
ALTER TABLE `Seccion`
  ADD PRIMARY KEY (`id_Sec`),
  ADD KEY `id_Fuen` (`id_Fuen`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Empresa`
--
ALTER TABLE `Empresa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Fuente`
--
ALTER TABLE `Fuente`
  MODIFY `id_Fuen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `GrupoFact`
--
ALTER TABLE `GrupoFact`
  MODIFY `id_GF` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Informacion`
--
ALTER TABLE `Informacion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `MetodoInstalado`
--
ALTER TABLE `MetodoInstalado`
  MODIFY `idMetodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `MetodoRecomendado`
--
ALTER TABLE `MetodoRecomendado`
  MODIFY `idMetodo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `PuestosAfect`
--
ALTER TABLE `PuestosAfect`
  MODIFY `id_Puest` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `Seccion`
--
ALTER TABLE `Seccion`
  MODIFY `id_Sec` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `CodFact`
--
ALTER TABLE `CodFact`
  ADD CONSTRAINT `codfact_ibfk_1` FOREIGN KEY (`id_GF`) REFERENCES `GrupoFact` (`id_GF`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Fuente`
--
ALTER TABLE `Fuente`
  ADD CONSTRAINT `fuente_ibfk_2` FOREIGN KEY (`id_Info`) REFERENCES `Informacion` (`id`),
  ADD CONSTRAINT `fuente_ibfk_3` FOREIGN KEY (`id_CF`) REFERENCES `CodFact` (`id_CF`);

--
-- Filtros para la tabla `Informacion`
--
ALTER TABLE `Informacion`
  ADD CONSTRAINT `informacion_ibfk_1` FOREIGN KEY (`Empresa`) REFERENCES `Empresa` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `MetodoInstalado`
--
ALTER TABLE `MetodoInstalado`
  ADD CONSTRAINT `metodoinstalado_ibfk_1` FOREIGN KEY (`id_Puest`) REFERENCES `PuestosAfect` (`id_Puest`);

--
-- Filtros para la tabla `MetodoRecomendado`
--
ALTER TABLE `MetodoRecomendado`
  ADD CONSTRAINT `metodorecomendado_ibfk_1` FOREIGN KEY (`id_Puest`) REFERENCES `PuestosAfect` (`id_Puest`);

--
-- Filtros para la tabla `PuestosAfect`
--
ALTER TABLE `PuestosAfect`
  ADD CONSTRAINT `puestosafect_ibfk_1` FOREIGN KEY (`id_Sec`) REFERENCES `Seccion` (`id_Sec`);

--
-- Filtros para la tabla `Seccion`
--
ALTER TABLE `Seccion`
  ADD CONSTRAINT `seccion_ibfk_1` FOREIGN KEY (`id_Fuen`) REFERENCES `Fuente` (`id_Fuen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
