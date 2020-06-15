-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2020 a las 15:31:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foro_expertos`
--
CREATE DATABASE IF NOT EXISTS `foro_expertos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `foro_expertos`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `buscar`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar` (IN `palabra` VARCHAR(50))  NO SQL
BEGIN
CALL buscar_pregunta(palabra);
CALL buscar_respuestas(palabra);
END$$

DROP PROCEDURE IF EXISTS `buscar_pregunta`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_pregunta` (IN `palabra` VARCHAR(50))  BEGIN
declare idpregunta int;
declare idtesauro int;
declare fin int default 0;
declare preguntacursor cursor for
SELECT ID  FROM `foro_expertos`.`preguntas` WHERE `Tema` LIKE CONCAT('%', palabra, '%') OR  `Mensaje` LIKE CONCAT('%', palabra, '%');

DECLARE CONTINUE HANDLER FOR  NOT FOUND SET fin=1;
OPEN preguntacursor;
getpregunta: LOOP
fetch preguntacursor into idpregunta;

if ( fin=1) then

leave getpregunta;
end if;
  INSERT INTO `tesauro_preguntas`(`ID_tesauro`, `Id_pregunta`) VALUES ((SELECT ID  FROM `foro_expertos`.`tesauro` WHERE tesauro.`Palabra` LIKE  CONCAT('%', palabra, '%')), idpregunta);

end LOOP getpregunta;
CLOSE preguntacursor;

END$$

DROP PROCEDURE IF EXISTS `buscar_respuestas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_respuestas` (IN `palabra` VARCHAR(50))  NO SQL
BEGIN
declare idrespuesta int;
declare idtesauro int;
declare fin int default 0;
declare respuestacursor cursor for
SELECT ID  FROM `foro_expertos`.`respuestas` WHERE `Mensaje`  LIKE CONCAT('%', palabra, '%');

DECLARE CONTINUE HANDLER FOR  NOT FOUND SET fin=1;
OPEN respuestacursor;
getrespuesta: LOOP
fetch respuestacursor into idrespuesta;

if ( fin=1) then

leave getrespuesta;
end if;
  INSERT INTO `tesauro_respuestas`(`ID_tesauro`, `Id_Respuesta`) VALUES ((SELECT ID  FROM `foro_expertos`.`tesauro` WHERE tesauro.`Palabra` LIKE  CONCAT('%', palabra, '%')), idrespuesta);

end LOOP getrespuesta;
CLOSE respuestacursor;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `categoria`:
--

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID`, `Nombre`, `Descripcion`) VALUES
(1, 'Medicina', 'Categoria general de medicina'),
(2, 'Informatica', 'Categoria general de informatica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expertos`
--

DROP TABLE IF EXISTS `expertos`;
CREATE TABLE `expertos` (
  `ID` int(11) NOT NULL,
  `ID_persona` int(11) NOT NULL,
  `Nickname` varchar(50) NOT NULL,
  `ID_Subcategoria` int(11) NOT NULL,
  `ID_Profesion` int(11) NOT NULL,
  `activo` int(1) NOT NULL,
  `Puntuacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `expertos`:
--   `ID_Subcategoria`
--       `subcategoria` -> `ID`
--   `ID_persona`
--       `personas` -> `ID`
--   `ID_Profesion`
--       `profesiones` -> `ID`
--

--
-- Volcado de datos para la tabla `expertos`
--

INSERT INTO `expertos` (`ID`, `ID_persona`, `Nickname`, `ID_Subcategoria`, `ID_Profesion`, `activo`, `Puntuacion`) VALUES
(25, 19, 'fecendrer', 2, 2, 0, 0),
(31, 22, 'riodelobo', 1, 1, 1, 0),
(32, 25, 'emejota29', 3, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `ID` int(11) NOT NULL,
  `ID_Roles` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Provincia` varchar(100) NOT NULL,
  `Ciudad` varchar(100) NOT NULL,
  `Nickname` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `activo` int(1) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `personas`:
--   `ID_Roles`
--       `roles` -> `ID`
--

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`ID`, `ID_Roles`, `Nombre`, `Apellidos`, `Provincia`, `Ciudad`, `Nickname`, `Password`, `Email`, `hash`, `activo`, `Fecha`) VALUES
(19, 1, 'Felipe', 'Cendrero Diaz', 'Badajoz', 'Calamonte', 'fecendrer', '1234', 'felipealbarregas@gmail.com', 'd93ed5b6db83be78efb0d05ae420158e', 1, '0000-00-00 00:00:00'),
(21, 2, 'Jonh', 'Cabeza Cendrero', 'Badajoz', 'Calamonte', 'jonhcito', 'guau', 'felipegarba2011@hotmail.es', '53e3a7161e428b65688f14b84d61c610', 1, '0000-00-00 00:00:00'),
(22, 3, 'Guadalupe', 'Cabeza Fernandez', 'Badajoz', 'Calamonte', 'riodelobo', '1234', 'felipegarba2011@hotmail.es', 'd79aac075930c83c2f1e369a511148fe', 1, '0000-00-00 00:00:00'),
(23, 2, '', '', '', '', '', '', '', '389bc7bb1e1c2a5e7e147703232a88f6', 0, '0000-00-00 00:00:00'),
(24, 2, 'roberto', 'hermoso', 'Caceres', 'Caceres', 'robertito', '1234', 'foroexpertofelipe@gmail.com', 'f4f6dce2f3a0f9dada0c2b5b66452017', 1, '0000-00-00 00:00:00'),
(25, 3, 'emejota', 'trinidad', 'Badajoz', 'Alange', 'emejota29', '1234', 'mariajosetf1994@gmail.com', '287e03db1d99e0ec2edb90d079e142f3', 1, '2020-06-01 15:26:08'),
(26, 2, 'alex', 'Cendrero Diaz', 'Badajoz', 'Garbayuela', 'alex', '1234', 'felipegarba2011@hotmail.es', '152485520001155', 1, '2020-06-15 11:13:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE `preguntas` (
  `ID` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Subcategoria` int(11) NOT NULL,
  `Tema` varchar(100) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Mensaje` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `preguntas`:
--   `ID_Subcategoria`
--       `subcategoria` -> `ID`
--   `ID_Usuario`
--       `usuario` -> `ID`
--

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`ID`, `ID_Usuario`, `ID_Subcategoria`, `Tema`, `Fecha`, `Mensaje`) VALUES
(6, 4, 2, 'PHP', '2020-05-25 22:00:00', 'Como puedo hacer en php una consulta sql con varios where'),
(7, 4, 2, 'Realizar HTML', '2020-05-27 07:24:02', 'Buenos dias quisiera saber si hay algun curso de HTML5'),
(8, 4, 2, 'Realizar error en sql', '2020-05-27 08:11:04', 'Tengo una duda, como tengo en la base de datos un valor unique y estoy agregando un nuevo valor que ya esta repetido quiero comprobar si me lanza el error y continua ejecutandose o se para el programa'),
(9, 2, 1, 'Dolor en la espalda', '2020-05-27 17:39:52', 'Tengo un dolor en la espalda que me lleva matando siete dias, y me cai el jueves pasado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesiones`
--

DROP TABLE IF EXISTS `profesiones`;
CREATE TABLE `profesiones` (
  `ID` int(11) NOT NULL,
  `ID_Subcategoria` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `profesiones`:
--   `ID_Subcategoria`
--       `subcategoria` -> `ID`
--

--
-- Volcado de datos para la tabla `profesiones`
--

INSERT INTO `profesiones` (`ID`, `ID_Subcategoria`, `Nombre`, `Descripcion`) VALUES
(1, 1, 'Medico de familia y comunitaria', 'Medico de familia'),
(2, 2, 'Programador front-end', 'Programador web en la parte cliente'),
(3, 3, 'Programador php', 'Programadores de php'),
(4, 3, 'programador Python', 'Programadores python'),
(5, 4, 'Medico Internista', 'Medico dedicado a la medicina Interna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
CREATE TABLE `respuestas` (
  `ID` int(11) NOT NULL,
  `ID_pregunta` int(11) NOT NULL,
  `ID_experto` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Mensaje` longtext NOT NULL,
  `Valoracion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `respuestas`:
--   `ID_experto`
--       `expertos` -> `ID`
--   `ID_pregunta`
--       `preguntas` -> `ID`
--

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`ID`, `ID_pregunta`, `ID_experto`, `Fecha`, `Mensaje`, `Valoracion`) VALUES
(1, 9, 31, '2020-06-15 09:23:44', 'tomate un ibuprofeno ', 0),
(2, 9, 25, '2020-06-02 10:11:31', 'tomate un paracetamol mejor', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `roles`:
--

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `Nombre`) VALUES
(1, 'administrador'),
(2, 'usuario'),
(3, 'experto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
CREATE TABLE `subcategoria` (
  `ID` int(11) NOT NULL,
  `ID_categoria` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `subcategoria`:
--   `ID_categoria`
--       `categoria` -> `ID`
--

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`ID`, `ID_categoria`, `Nombre`, `Descripcion`) VALUES
(1, 1, 'Medicina Familiar', 'Subcategoria destinana a la medicina de familia'),
(2, 2, 'Programacion Web', 'Subcategoria de programacion web'),
(3, 2, 'Programador back-end', 'Pogramacion de back-end'),
(4, 1, 'Internista', 'Subcategoria dedicada a la medicina interna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesauro`
--

DROP TABLE IF EXISTS `tesauro`;
CREATE TABLE `tesauro` (
  `ID` int(11) NOT NULL,
  `Palabra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `tesauro`:
--

--
-- Volcado de datos para la tabla `tesauro`
--

INSERT INTO `tesauro` (`ID`, `Palabra`) VALUES
(23, 'html'),
(24, 'paracetamol');

--
-- Disparadores `tesauro`
--
DROP TRIGGER IF EXISTS `buscar_tesauro`;
DELIMITER $$
CREATE TRIGGER `buscar_tesauro` AFTER INSERT ON `tesauro` FOR EACH ROW BEGIN
CALL buscar(new.palabra);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesauro_preguntas`
--

DROP TABLE IF EXISTS `tesauro_preguntas`;
CREATE TABLE `tesauro_preguntas` (
  `ID_tesauro` int(11) NOT NULL,
  `ID_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `tesauro_preguntas`:
--   `ID_pregunta`
--       `preguntas` -> `ID`
--   `ID_tesauro`
--       `tesauro` -> `ID`
--

--
-- Volcado de datos para la tabla `tesauro_preguntas`
--

INSERT INTO `tesauro_preguntas` (`ID_tesauro`, `ID_pregunta`) VALUES
(23, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesauro_respuestas`
--

DROP TABLE IF EXISTS `tesauro_respuestas`;
CREATE TABLE `tesauro_respuestas` (
  `ID_tesauro` int(11) NOT NULL,
  `Id_Respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `tesauro_respuestas`:
--   `ID_tesauro`
--       `tesauro` -> `ID`
--

--
-- Volcado de datos para la tabla `tesauro_respuestas`
--

INSERT INTO `tesauro_respuestas` (`ID_tesauro`, `Id_Respuesta`) VALUES
(24, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `ID_Personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELACIONES PARA LA TABLA `usuario`:
--   `ID_Personas`
--       `personas` -> `ID`
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `ID_Personas`) VALUES
(2, 21),
(3, 23),
(4, 24);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `expertos`
--
ALTER TABLE `expertos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign_personas1` (`ID_persona`),
  ADD KEY `foreign_Subcategoria1` (`ID_Subcategoria`),
  ADD KEY `foreign_profesion` (`ID_Profesion`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nickname` (`Nickname`),
  ADD KEY `foreign_roles` (`ID_Roles`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign_usuarios` (`ID_Usuario`),
  ADD KEY `foreign_Subcategoria2` (`ID_Subcategoria`);

--
-- Indices de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign_Subcategoria` (`ID_Subcategoria`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign expertos` (`ID_experto`),
  ADD KEY `foreign_preguntas` (`ID_pregunta`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Foreign_categoria` (`ID_categoria`);

--
-- Indices de la tabla `tesauro`
--
ALTER TABLE `tesauro`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Palabra` (`Palabra`);

--
-- Indices de la tabla `tesauro_preguntas`
--
ALTER TABLE `tesauro_preguntas`
  ADD KEY `foreing_tesauro` (`ID_tesauro`),
  ADD KEY `foreign_pregunta1` (`ID_pregunta`);

--
-- Indices de la tabla `tesauro_respuestas`
--
ALTER TABLE `tesauro_respuestas`
  ADD KEY `foreing_tesauro1` (`ID_tesauro`),
  ADD KEY `foreign_respuesta` (`Id_Respuesta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `foreign_personas` (`ID_Personas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `expertos`
--
ALTER TABLE `expertos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `profesiones`
--
ALTER TABLE `profesiones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tesauro`
--
ALTER TABLE `tesauro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `expertos`
--
ALTER TABLE `expertos`
  ADD CONSTRAINT `foreign_Subcategoria1` FOREIGN KEY (`ID_Subcategoria`) REFERENCES `subcategoria` (`ID`),
  ADD CONSTRAINT `foreign_personas1` FOREIGN KEY (`ID_persona`) REFERENCES `personas` (`ID`),
  ADD CONSTRAINT `foreign_profesion` FOREIGN KEY (`ID_Profesion`) REFERENCES `profesiones` (`ID`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `foreign_roles` FOREIGN KEY (`ID_Roles`) REFERENCES `roles` (`ID`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `foreign_Subcategoria2` FOREIGN KEY (`ID_Subcategoria`) REFERENCES `subcategoria` (`ID`),
  ADD CONSTRAINT `foreign_usuarios` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `profesiones`
--
ALTER TABLE `profesiones`
  ADD CONSTRAINT `foreign_Subcategoria` FOREIGN KEY (`ID_Subcategoria`) REFERENCES `subcategoria` (`ID`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `foreign expertos` FOREIGN KEY (`ID_experto`) REFERENCES `expertos` (`ID`),
  ADD CONSTRAINT `foreign_preguntas` FOREIGN KEY (`ID_pregunta`) REFERENCES `preguntas` (`ID`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `Foreign_categoria` FOREIGN KEY (`ID_categoria`) REFERENCES `categoria` (`ID`);

--
-- Filtros para la tabla `tesauro_preguntas`
--
ALTER TABLE `tesauro_preguntas`
  ADD CONSTRAINT `foreign_pregunta1` FOREIGN KEY (`ID_pregunta`) REFERENCES `preguntas` (`ID`),
  ADD CONSTRAINT `foreing_tesauro` FOREIGN KEY (`ID_tesauro`) REFERENCES `tesauro` (`ID`);

--
-- Filtros para la tabla `tesauro_respuestas`
--
ALTER TABLE `tesauro_respuestas`
  ADD CONSTRAINT `foreing_tesauro1` FOREIGN KEY (`ID_tesauro`) REFERENCES `tesauro` (`ID`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `foreign_personas` FOREIGN KEY (`ID_Personas`) REFERENCES `personas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
