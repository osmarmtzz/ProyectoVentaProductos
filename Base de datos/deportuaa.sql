-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2023 a las 06:23:17
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
-- Base de datos: `deportuaa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idp` varchar(10) NOT NULL,
  `nomp` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `existencia` int(10) NOT NULL,
  `precio` float NOT NULL,
  `imagen` text NOT NULL,
  `categoria` text NOT NULL,
  `descuento` text NOT NULL,
  `desc2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idp`, `nomp`, `descripcion`, `existencia`, `precio`, `imagen`, `categoria`, `descuento`, `desc2`) VALUES
('bal1', 'Balón Jabulani', 'balón de futbol oficial usado durante la copa mundial del 2010', 5, 500, 'balonjabulani.jpg', 'balon', 'descuento', 100),
('bal2', 'Voit Apertura 2022', 'balón voit Tracer, el balón oficial de la Liga MX para el torneo Apertura 2022', 2, 829, 'Apertura2022.jpg', 'balon', 'descuento', 0),
('bal3', 'Voit Apertura 2023', 'balón voit Tracer, el balón oficial de la Liga MX para el torneo Apertura 2022', 6, 749, 'Apertura2023.jpg', 'balon', 'descuento', 0),
('bal3', 'Voit Apertura 2023', 'balón voit Tracer, el balón oficial de la Liga MX para el torneo Apertura 2022', 6, 749, 'Apertura2023.jpg', 'balon', 'descuento', 0),
('bal4', 'Champions 2021', 'balón Champions League Esta es una pelota de precisión utilizada por los clubes de la Liga Europea', 1, 399, 'champions2021.jpg', 'balon', 'no', 0),
('bal5', 'Champions 2023', 'Balón Oficial Champions League 2023-2024 en color White-Silver met-Bright cyan-Team royal \"The Champions\"', 2, 3279, 'champions2023.jpg', 'balon', 'no', 0),
('bal6', 'Puma Orbita LaLiga 1', 'PUMA, patrocinador oficial de La Liga, presenta la Orbita La Liga Ball.', 1, 528, '', 'balon', 'no', 0),
('bal7', 'Nike Phantom', 'El balón de fútbol Nike Phantom está listo para volar hasta el fondo del arco. Cuenta con un diseño suave y duradero con gráficos de alto contraste que son fáciles de ver en la cancha.', 6, 499, 'NikePhantom.jpg', 'balon', 'no', 0),
('bal8', 'Puma Big Cat', 'Balón Puma Big Cat el cual además de lucir increíble es perfecto para la práctica de este deporte y así mejorar la técnica individual de golpeo.', 5, 349, 'Pumabigcat.jpg', 'balon', 'no', 0),
('cal1', 'Adidas Predator', 'Predator no es solo una bota. Es una declaración que las acciones hablan más que las palabras.', 2, 599, 'Adidas Predator.jpg', 'calzado', 'no', 0),
('cal2', 'Nike Mercurial Superfly 9 Club', 'Calzado de fútbol de perfil alto para terrenos múltiples', 1, 1439, 'NikeMercurial.jpg', 'calzado', 'no', 0),
('cal3', 'PUMA Attacanto', 'Versátil y de alto rendimiento: suela de goma multitachuelas de perfil bajo. Adecuado para su uso en superficies naturales duras y césped sintético.', 2, 935, 'pumaAttacanto.jpg', 'calzado', 'no', 0),
('cal4', 'Nike Vapor 15', 'Perfeccionaste tus habilidades con la práctica constante y canalizaste tu fuego interior a tu actividad. Ahora, cuando el peso del partido esté directamente sobre tus hombros, ponte a la altura de las circunstancias y cumple', 1, 6699, 'NikeVapor15.jpg', 'calzado', 'no', 0),
('cal5', 'UA Magnetico Select 3', ' Las UA Magnetico Select 3 no requieren tiempo de adaptación, sino que ofrecen un ajuste perfecto desde el primer momento.', 2, 1999, 'UAMagnetico.jpg', 'calzado', 'no', 0),
('cal6', ' Adidas X Crazyfast.3 ', ' parte superior fue hecha con un textil revestido y ligero con capas extras en zonas estratégicas que se combinan con un panel de punto plano que tiene la tarea de envolver tu tobillo', 5, 1139, 'adidasXCrazyfast.jpg', 'calzado', 'no', 0),
('cal7', 'FUTURE MATCH Neymar Jr', 'Pasa a la defensa como Neymar con los botines de fútbol FUTURE MATCH Neymar Jr FG/AG.', 1, 2199, 'FutureMatch.jpg', 'calzado', 'no', 0),
('cal8', ' ULTRA MATCH', ' Estas botas forman parte de la colección Puma Breakthrough del 2023. Placa de la suela SPEEDPLATE pensada para proporcionar toda la velocidad.', 3, 2299, 'ULTRAMATCH.jpg', 'calzado', 'no', 0),
('bal9', 'Nike Academy', 'Con ranuras innovadoras que proporcionan un giro uniforme en el campo de juego', 6, 699, 'NikeAcademy.jpg', 'balon', 'no', 0),
('bal10', 'Adidas Ucl Club', 'El Balón de Fútbol adidas UCL Club es parte de la nueva colección de la mejor competición a nivel de clubes en todo el mundo, con esta pelota pasarás horas de diversión en la cancha. ', 2, 489, 'Adidasucl.jpg', 'balon', 'no', 0),
('cal9', 'Adidas Predator Edge.3', 'Tacos de fútbol para jóvenes para agarre y control de pelota', 1, 1103, 'PumaPredator.jpg', 'calzado', 'no', 0),
('cal10', 'Puma Future Z', 'Toma el control del partido al usar los Tenis de Fútbol Puma Future Z 1.4 FG/AG, este par de la marca alemana fue diseñado para el pie femenino con base en pruebas de ajuste y de atletas de alto rendimiento. ', 3, 1919, 'PumaFuture.jpg', 'calzado', 'no', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cuenta` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pregunta_seguridad` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
