-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2024 a las 04:33:18
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantenimientos`
--

CREATE DATABASE MANTENIMIENTOS;

-- --------------------------------------------------------

--
-- Poblamiento Base de Datos
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitores`
--

CREATE TABLE `monitores` (
  `id` int(11) NOT NULL,
  `nombremonitor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombremarca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(11) NOT NULL,
  `nombresede` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id` int(11) NOT NULL,
  `nombresala` varchar(100) NOT NULL,
  `idsede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

select * from mantenimientos;

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `idmarca` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `idsala` int(11) NOT NULL,
  `fechaingreso` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimientos`
--

CREATE TABLE `mantenimientos` (
  `id` int(11) NOT NULL,
  `idequipo` int(11) NOT NULL,
  `tipomantenimiento` int(11) NOT NULL,
  `problema` varchar(100) NOT NULL,
  `fechainicio` date NOT NULL,
  `idmonitor` int(11) NOT NULL,
  `fechafin` date DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into equipos (tipo, idmarca, codigo, idsala, fechaingreso, estado) values ('PC', 1, 'DESKTOP 23414', 1, "2024-04-20", 1);
insert into equipos (tipo, idmarca, codigo, idsala, fechaingreso, estado) values ('Portátil', 3, 'DESKTOP 234', 4, "2024-03-20", 0);

SELECT * FROM MANTENIMIENTOS;

SELECT 
    equipos.id AS equipo_id, 
    equipos.codigo AS codigo_equipo,    
    equipos.tipo AS tipo_equipo,
    marcas.nombremarca AS marca_equipo,
    salas.nombresala AS sala_equipo,
    equipos.fechaingreso AS fecha_ingreso_equipo,
    MAX(mantenimientos.fechafin) AS fecha_ultimo_mantenimiento,
    DATE_ADD(MAX(mantenimientos.fechafin), INTERVAL 6 MONTH) AS fecha_siguiente_mantenimiento,
    equipos.estado AS estado_equipo
FROM
    equipos
INNER JOIN
    marcas ON equipos.idmarca = marcas.id
INNER JOIN
    salas ON equipos.idsala = salas.id
INNER JOIN
    sedes ON salas.idsede = sedes.id
LEFT JOIN
    mantenimientos ON equipos.id = mantenimientos.idequipo
GROUP BY
    equipos.id, equipos.codigo, equipos.tipo, marcas.nombremarca, salas.nombresala, equipos.fechaingreso, equipos.estado
ORDER BY
    equipos.id;

SELECT
	equipos.id AS ID_EQUIPO,
	equipos.codigo AS NOMBRE_EQUIPO,
	mantenimientos.tipomantenimiento AS TIPO_DE_MANTENIMIENTO,
	monitores.nombremonitor AS MONITOR,
	mantenimientos.problema AS PROBLEMA,
	mantenimientos.descripcion AS DESCRIPCION,
	mantenimientos.fechainicio AS FECHA_INICIO,
	mantenimientos.fechafin AS FECHA_FIN
FROM
	mantenimientos
INNER JOIN
	equipos ON mantenimientos.idequipo = equipos.id
INNER JOIN
	monitores ON mantenimientos.idmonitor = monitores.id;
    
    SELECT
	equipos.id AS ID_EQUIPO,
	equipos.codigo AS NOMBRE_EQUIPO,
    mantenimientos.id AS ID_MANTENIMIENTO,
	mantenimientos.tipomantenimiento AS TIPO_DE_MANTENIMIENTO,
	monitores.nombremonitor AS MONITOR,
	mantenimientos.problema AS PROBLEMA,
	mantenimientos.descripcion AS DESCRIPCION,
	IF(mantenimientos.fechainicio = '0000-00-00', '', mantenimientos.fechainicio) AS FECHA_INICIO,
	IF(mantenimientos.fechafin = '0000-00-00', '', mantenimientos.fechafin) AS FECHA_FIN
FROM
	mantenimientos
INNER JOIN
	equipos ON mantenimientos.idequipo = equipos.id
INNER JOIN
	monitores ON mantenimientos.idmonitor = monitores.id;

INSERT INTO MANTENIMIENTOS (idequipo, tipomantenimiento, problema, fechainicio, idmonitor, fechafin, descripcion) VALUES (4, 0, 'Polvo', '2024-04-28', 2, '', 'ventiladores sucios');

INSERT INTO MANTENIMIENTOS (idequipo, tipomantenimiento, problema, fechainicio, idmonitor, fechafin, descripcion) VALUES (5, 1, 'Suciedad', '2024-04-02', 2, '2024-04-03', '');
	
INSERT INTO MANTENIMIENTOS (idequipo, tipomantenimiento, problema, fechainicio, idmonitor, descripcion) VALUES (4, 0, 'Polvo', '2024-04-28', 2, 'ventiladores sucios');

-- --------------------------------------------------------
select * from equipos;
select * from monitores;
--
-- Poblamiento de las Tablas
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombremarca`) VALUES
(1, 'Dell'),
(3, 'Lenovo'),
(4, 'asus'),
(5, 'acer');

select * from salas;
show grants;
SHOW GRANTS FOR 'root'@'localhost';
--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id`, `nombresala`, `idsede`) VALUES
(1, 'Sala1', 1),
(4, 'sala 3', 3),
(5, 'Sala Ñueva', 2);

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombresede`) VALUES
(1, 'Bicentenario'),
(2, 'Encarnación'),
(3, 'Casa Obando');

-- --------------------------------------------------------

--
-- Índices para tablas volcadas
--

-- --------------------------------------------------------

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkequiposala` (`idsala`),
  ADD KEY `fkequipomarca` (`idmarca`);

--
-- Indices de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkmantenimientoequipo` (`idequipo`),
  ADD KEY `fkmantenimientomonitor` (`idmonitor`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `monitores`
--
ALTER TABLE `monitores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fksalasede` (`idsede`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT de las tablas volcadas
--

-- --------------------------------------------------------

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `monitores`
--
ALTER TABLE `monitores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --------------------------------------------------------

--
-- Restricciones para tablas volcadas
--

-- --------------------------------------------------------

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fkequipomarca` FOREIGN KEY (`idmarca`) REFERENCES `marcas` (`id`),
  ADD CONSTRAINT `fkequiposala` FOREIGN KEY (`idsala`) REFERENCES `salas` (`id`);

--
-- Filtros para la tabla `mantenimientos`
--
ALTER TABLE `mantenimientos`
  ADD CONSTRAINT `fkmantenimientoequipo` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fkmantenimientomonitor` FOREIGN KEY (`idmonitor`) REFERENCES `monitores` (`id`);

--
-- Filtros para la tabla `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `fksalasede` FOREIGN KEY (`idsede`) REFERENCES `sedes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
