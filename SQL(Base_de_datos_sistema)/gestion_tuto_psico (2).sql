-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2024 a las 19:32:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_tuto_psico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo_personal` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `clave_admin` varchar(100) DEFAULT NULL,
  `nom_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `apellido`, `telefono`, `correo_personal`, `password`, `clave_admin`, `nom_usuario`) VALUES
(1, 'Hayley David', 'Quispe Chinguel', '929486812', 'haylerquispe@gmail.com', '$2y$10$GO7qzt6CHSGeJR7CUJWNLexURgKZAW6J1CX9dL4sJ/5VJofQGFH7O', 'admin789', 'administrador1'),
(2, 'Miguel Vladimir', 'Perez Samanamud', '996702232', NULL, '$2y$10$IxfwuzxcIxCqVqmGKxeezOTbkHz.VLlYbJF7Gbidka2Sv0jjVP3WO', 'admin789', 'Administrador2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos`
--

CREATE TABLE `ciclos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciclos`
--

INSERT INTO `ciclos` (`id`, `nombre`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_ciclo` int(11) NOT NULL,
  `id_escuela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `id_ciclo`, `id_escuela`) VALUES
(1, 'Matematica Informatica', 1, 1),
(2, 'Lenguaje y Comunicación', 1, 1),
(3, 'Filosofía y Ética', 1, 1),
(4, 'Metodología del Trabajo Universitario', 1, 1),
(5, 'Actividades Culturales y Deportivas', 1, 1),
(6, 'Matemática Básica', 1, 1),
(7, 'Fundamentos de Cálculo', 1, 1),
(8, 'Introducción a la Ingeniería Informática', 1, 1),
(9, 'Inglés I', 1, 1),
(10, 'Liderazgo y Desarrollo Personal', 2, 1),
(11, 'Medio Ambiente y Desarrollo Sostenible', 2, 1),
(12, 'Tecnologías de la Información y Comunicación', 2, 1),
(13, 'Sociología', 2, 1),
(14, 'Matemática Discreta para Informática', 2, 1),
(15, 'Cálculo Integral', 2, 1),
(16, 'Física', 2, 1),
(17, 'Inglés II', 2, 1),
(18, 'Psicología Organizacional', 3, 1),
(19, 'Estadística', 3, 1),
(20, 'Metodología de la Investigación Científica', 3, 1),
(21, 'Geopolítica y Realidad Nacional', 3, 1),
(22, 'Lógica Digital', 3, 1),
(23, 'Matemática Aplicada', 3, 1),
(24, 'Lenguaje de Programación I', 3, 1),
(25, 'Inglés III', 3, 1),
(26, 'Métodos Numéricos', 4, 1),
(27, 'Base de Datos I', 4, 1),
(28, 'Teoría de Comunicaciones', 4, 1),
(29, 'Electrónica Digital', 4, 1),
(30, 'Arquitectura y Organización del Computador', 4, 1),
(31, 'Lenguaje de Programación II', 4, 1),
(32, 'Inglés Aplicado a la Informática I', 4, 1),
(33, 'Contabilidad y Costos', 5, 1),
(34, 'Base de Datos II', 5, 1),
(35, 'Dispositivos Móviles I', 5, 1),
(36, 'Proyecto Integrador I', 5, 1),
(37, 'Lenguaje de Programación III', 5, 1),
(38, 'Inglés aplicado a la informática II', 5, 1),
(39, 'Microprocesadores', 5, 1),
(40, 'Teoría de Compiladores', 5, 1),
(41, 'Investigación de Operaciones', 6, 1),
(42, 'Gestión y Análisis de datos e Información', 6, 1),
(43, 'Dispositivos Móviles II', 6, 1),
(44, 'Redes y Conectividad', 6, 1),
(45, 'Teleinformática I', 6, 1),
(46, 'Inglés Aplicado a la Informática III', 6, 1),
(47, 'Inteligencia Artificial', 6, 1),
(48, 'Administración de Base de Datos', 6, 1),
(49, 'Ingeniería de Sistemas de Información', 7, 1),
(50, 'Formulación y Evaluación de Proyectos', 7, 1),
(51, 'Proyecto Integrador II', 7, 1),
(52, 'Planeamiento Estratégico de la Información', 7, 1),
(53, 'Ingeniería Económica', 7, 1),
(54, 'Teleinformática II', 7, 1),
(55, 'Sistemas Expertos', 7, 1),
(56, 'Realidad Virtual', 7, 1),
(57, 'Finanzas para Empresas', 8, 1),
(58, 'Dinámica de Sistemas de Información', 8, 1),
(59, 'Tópicos Avanzados en Programación', 8, 1),
(60, 'Innovación y Tecnología', 8, 1),
(61, 'Sistemas Operativos', 8, 1),
(62, 'Proyectos Informáticos', 8, 1),
(63, 'Prospectiva Empresarial', 9, 1),
(64, 'Simulación de Sistemas Informáticos y Empresariales', 9, 1),
(65, 'Control y Calidad de Software', 9, 1),
(66, 'Proyecto Integrador en Dispositivos Móviles', 9, 1),
(67, 'Sistemas de Información Gerencial', 9, 1),
(68, 'Taller de Tesis I', 9, 1),
(69, 'Prácticas Pre Profesionales I', 9, 1),
(70, 'Gerencia y Consultoría Informática', 10, 1),
(71, 'Ingeniería del Conocimiento', 10, 1),
(72, 'Seguridad y Auditoría Informática', 10, 1),
(73, 'Tecnologías Emergentes', 10, 1),
(74, 'Tecnologías E-Business', 10, 1),
(75, 'Taller de Tesis II', 10, 1),
(76, 'Prácticas Pre Profesionales II', 10, 1),
(77, 'Fundamentos de Cálculo', 1, 3),
(78, 'Metodología del Trabajo Universitario', 1, 3),
(79, 'Actividades Culturales y Deportivas', 1, 3),
(80, 'Matemática Básica', 1, 3),
(81, 'Filosofía y Ética', 1, 3),
(82, 'Algoritmos y Estructura de Datos', 1, 3),
(83, 'Inglés I', 1, 3),
(84, 'Lenguaje y Comunicación', 1, 3),
(85, 'Cálculo Integral', 2, 3),
(86, 'Tecnologías de Información y Comunicación', 2, 3),
(87, 'Sociología', 2, 3),
(88, 'Circuitos Digitales I', 2, 3),
(89, 'Medio Ambiente y Desarrollo Sostenible', 2, 3),
(90, 'Lenguaje de Programación I', 2, 3),
(91, 'Inglés II', 2, 3),
(92, 'Liderazgo y Desarrollo Personal', 2, 3),
(93, 'Matemática Aplicada', 3, 3),
(94, 'Física I', 3, 3),
(95, 'Metodología de la Investigación Científica', 3, 3),
(96, 'Estadística', 3, 3),
(97, 'Geopolítica y Realidad Nacional', 3, 3),
(98, 'Lenguaje de Programación II', 3, 3),
(99, 'Inglés II', 3, 3),
(100, 'Psicología Organizacional', 3, 3),
(101, 'Matemática Superior', 4, 3),
(102, 'Física II', 4, 3),
(103, 'Procesos Estocásticos', 4, 3),
(104, 'Sistemas Digitales I', 4, 3),
(105, 'Desarrollo y Defensa Nacional', 4, 3),
(106, 'Circuitos Eléctricos I', 4, 3),
(107, 'Inglés para Ingeniería I', 4, 3),
(108, 'Asistente en Soporte Informático y Equipos de Comunicación', 4, 3),
(109, 'Métodos Numéricos', 5, 3),
(110, 'Física III', 5, 3),
(111, 'Procesamiento Digital de Señales', 5, 3),
(112, 'Sistemas Digitales II', 5, 3),
(113, 'Circuitos Eléctricos II', 5, 3),
(114, 'Inglés para Ingeniería II', 5, 3),
(115, 'Líneas de Trasmisión', 5, 3),
(116, 'Administración de Empresas', 6, 3),
(117, 'Teoría de Campos Electromagnéticos I', 6, 3),
(118, 'Telecomunicaciones I', 6, 3),
(119, 'Sistemas y Equipos de Radiodifusión', 6, 3),
(120, 'Dispositivos Electrónicos', 6, 3),
(121, 'Taller de Telecomunicaciones I', 6, 3),
(122, 'Control y Automatización', 6, 3),
(123, 'Economía', 7, 3),
(124, 'Teoría de Campos Electromagnéticos II', 7, 3),
(125, 'Telecomunicaciones II', 7, 3),
(126, 'Redes de Transmisión de Datos', 7, 3),
(127, 'Circuitos Electrónicos I', 7, 3),
(128, 'Taller de Telecomunicaciones II', 7, 3),
(129, 'Investigación Operativa', 7, 3),
(130, 'Proyectos en Telecomunicaciones', 8, 3),
(131, 'Propagación y Antenas', 8, 3),
(132, 'Telecomunicaciones III', 8, 3),
(133, 'Protocolos de Enrutamiento', 8, 3),
(134, 'Ingeniería de Tráfico en Telecomunicaciones', 8, 3),
(135, 'Circuitos Electrónicos II', 8, 3),
(136, 'Taller de Telecomunicaciones III', 8, 3),
(137, 'Voz y Video por Internet', 9, 3),
(138, 'Sistemas de Microondas', 9, 3),
(139, 'Comunicaciones Móviles e Inalámbricas', 9, 3),
(140, 'Comunicaciones Ópticas', 9, 3),
(141, 'Infraestructura de Redes de Telecomunicaciones', 9, 3),
(142, 'Comunicaciones por Satélite', 9, 3),
(143, 'Taller de Tesis I', 9, 3),
(144, 'Prácticas Pre Profesionales I', 9, 3),
(145, 'Prospectiva de las Telecomunicaciones', 10, 3),
(146, 'Radares', 10, 3),
(147, 'Radio y Televisión Digital', 10, 3),
(148, 'Seguridad en Redes de Comunicación', 10, 3),
(149, 'Diseño de Redes y Servicios de Telecomunicaciones', 10, 3),
(150, 'Legislación y Normalización de las Telecomunicaciones', 10, 3),
(151, 'Taller de Tesis II', 10, 3),
(152, 'Prácticas Pre Profesionales II', 10, 3),
(153, 'Cálculo Diferencial', 1, 2),
(154, 'Ciencia de los Materiales', 1, 2),
(155, 'Introducción a la Ingeniería Mecatrónica', 1, 2),
(156, 'Fundamentos de Cálculo', 1, 2),
(157, 'Filosofía y Ética', 1, 2),
(158, 'Actividades Culturales y Deportivas', 1, 2),
(159, 'Inglés I', 1, 2),
(160, 'Lenguaje y Comunicación', 1, 2),
(161, 'Metodología del Trabajo Universitario', 1, 2),
(162, 'Cálculo Integral', 2, 2),
(163, 'Física I', 2, 2),
(164, 'Dibujo para Ingeniería', 2, 2),
(165, 'Medio Ambiente y Desarrollo Sostenible', 2, 2),
(166, 'Sociología ', 2, 2),
(167, 'Inglés II', 2, 2),
(168, 'Liderazgo y Desarrollo Personal', 2, 2),
(169, 'Tecnologías de la Información y Comunicación', 2, 2),
(170, 'Matemática Aplicada', 3, 2),
(171, 'Física II', 3, 2),
(172, 'Geometría Descriptiva', 3, 2),
(173, 'Geopolítica y Realidad Nacional', 3, 2),
(174, 'Inglés III', 3, 2),
(175, 'Psicología Organizacional', 3, 2),
(176, 'Metodología de la Investigación Científica', 3, 2),
(177, 'Estadística', 3, 2),
(178, 'Métodos numéricos', 4, 2),
(179, 'Física del estado sólido', 4, 2),
(180, 'Circuitos eléctricos I', 4, 2),
(181, 'Circuitos digitales II', 4, 2),
(182, 'Dibujo técnico y geometría descriptiva', 4, 2),
(183, 'Economía', 4, 2),
(184, 'Maquinas eléctricas', 4, 2),
(185, 'Dispositivos electrónicos', 5, 2),
(186, 'Teoría de campos I', 5, 2),
(187, 'Circuitos eléctricos II', 5, 2),
(188, 'Sistemas digitales I', 5, 2),
(189, 'Fundamentos para el diseño electrónico', 5, 2),
(190, 'Procesos estocásticos', 5, 2),
(191, 'Electivo 1 ', 5, 2),
(192, 'Circuitos electrónicos I', 6, 2),
(193, 'Teoría de campos II', 6, 2),
(194, 'Control I', 6, 2),
(195, 'Sistemas digitales I', 6, 2),
(196, 'Redes de comunicación', 6, 2),
(197, 'Gestión empresarial', 6, 2),
(198, 'Electivo 2', 6, 2),
(199, 'Circuitos electrónicos I', 7, 2),
(200, 'Líneas de transmisión y antenas', 7, 2),
(201, 'Control II', 7, 2),
(202, 'Telecomunicaciones I', 7, 2),
(203, 'Proyectos de inversión', 7, 2),
(204, 'Prospectiva estratégica de la', 7, 2),
(205, 'Electivo 3', 7, 2),
(206, 'Circuitos electrónicos II', 8, 2),
(207, 'Radiodifusión y televisión digital', 8, 2),
(208, 'Control digital', 8, 2),
(209, 'Procesamiento digital de señales', 8, 2),
(210, 'Telecomunicaciones II', 8, 2),
(211, 'Sistemas expertos y robótica', 8, 2),
(212, 'Seminario de tesis', 8, 2),
(213, 'Electrónica de potencia', 9, 2),
(214, 'Microondas', 9, 2),
(215, 'Diseño de control difuso y redes neuronales', 9, 2),
(216, 'Redes y conectividad', 9, 2),
(217, 'Redes convergentes', 9, 2),
(218, 'Taller de diseño I', 9, 2),
(219, 'Prácticas pre profesionales I', 9, 2),
(220, 'Diseño de circuitos asistido por computador', 10, 2),
(221, 'Comunicación por satélite', 10, 2),
(222, 'Automatización industrial', 10, 2),
(223, 'Electrónica médica', 10, 2),
(224, 'Sistemas electrónicos embebidos', 10, 2),
(225, 'Taller de diseño II', 10, 2),
(226, 'Prácticas pre profesionales II', 10, 2),
(227, 'Cálculo Diferencial', 1, 4),
(228, 'Ciencia de los Materiales', 1, 4),
(229, 'Introducción a la Ingeniería Mecatrónica', 1, 4),
(230, 'Fundamentos de Cálculo', 1, 4),
(231, 'Filosofía y Ética', 1, 4),
(232, 'Actividades Culturales y Deportivas', 1, 4),
(233, 'Inglés I', 1, 4),
(234, 'Lenguaje y Comunicación', 1, 4),
(235, 'Metodología del Trabajo Universitario', 1, 4),
(236, 'Cálculo Integral', 2, 4),
(237, 'Física I', 2, 4),
(238, 'Dibujo para Ingeniería', 2, 4),
(239, 'Medio Ambiente y Desarrollo Sostenible', 2, 4),
(240, 'Sociología', 2, 4),
(241, 'Inglés II', 2, 4),
(242, 'Liderazgo y Desarrollo Personal', 2, 4),
(243, 'Tecnologías de la Información y Comunicación', 2, 4),
(244, 'Matemática Aplicada', 3, 4),
(245, 'Física II', 3, 4),
(246, 'Geometría Descriptiva', 3, 4),
(247, 'Geopolítica y Realidad Nacional', 3, 4),
(248, 'Inglés III', 3, 4),
(249, 'Psicología Organizacional', 3, 4),
(250, 'Metodología de la Investigación Científica', 3, 4),
(251, 'Estadística', 3, 4),
(252, 'Matemática Superior', 4, 4),
(253, 'Física III', 4, 4),
(254, 'Estática', 4, 4),
(255, 'Dibujo en 3D Básico (Aplicativo de SW)', 4, 4),
(256, 'Proyectos de Investigación Tecnológica y Científica', 4, 4),
(257, 'Estadística Aplicada', 4, 4),
(258, 'Ingeniería de Procesos', 5, 4),
(259, 'Mecánica de Fluidos', 5, 4),
(260, 'Circuitos Eléctricos I', 5, 4),
(261, 'Dinámica', 5, 4),
(262, 'Dibujo en 3D Avanzado (Aplicativo de SW)', 5, 4),
(263, 'Innovación y Prospectiva Tecnológica en Manufactura y Producción', 5, 4),
(264, 'Ingeniería Tecnológica y Mega Proyectos', 5, 4),
(265, 'Procesamiento Digital de Señales', 6, 4),
(266, 'Termodinámica', 6, 4),
(267, 'Máquinas Hidráulicas', 6, 4),
(268, 'Máquinas Eléctricas', 6, 4),
(269, 'Circuitos Eléctricos II', 6, 4),
(270, 'Elementos de Máquinas y Motores', 6, 4),
(271, 'Formulación y Evaluación de Proyectos de Mecatrónica', 6, 4),
(272, 'Control I', 7, 4),
(273, 'Mecánica para Ingenieros', 7, 4),
(274, 'Sistemas Hidráulicos', 7, 4),
(275, 'Automatización de Máquinas Eléctricas', 7, 4),
(276, 'Análisis de Circuitos Electrónicos I', 7, 4),
(277, 'Circuitos Digitales I', 7, 4),
(278, 'Proyectos Mecatrónicos', 7, 4),
(279, 'Control II', 8, 4),
(280, 'Diseño de Máquinas', 8, 4),
(281, 'Máquinas Térmicas I', 8, 4),
(282, 'Automatización de Control Industrial', 8, 4),
(283, 'Análisis de Circuitos Electrónicos II', 8, 4),
(284, 'Laboratorio de Electrónica I', 8, 4),
(285, 'Circuitos Digitales II', 8, 4),
(286, 'Máquinas Térmicas II', 9, 4),
(287, 'Laboratorio de Sistemas Digitales I', 9, 4),
(288, 'Ingeniería de Control', 9, 4),
(289, 'Microprocesadores', 9, 4),
(290, 'Laboratorio de Electrónica II', 9, 4),
(291, 'Sistemas Digitales I', 9, 4),
(292, 'Prácticas Pre-Profesionales I', 9, 4),
(293, 'Automatización de Máquinas Térmicas', 10, 4),
(294, 'Laboratorio de Sistemas Digitales II', 10, 4),
(295, 'Alta Tecnología en Robótica', 10, 4),
(296, 'Mecatrónica Avanzada', 10, 4),
(297, 'Electrónica Industrial', 10, 4),
(298, 'Sistemas Digitales II', 10, 4),
(299, 'Prácticas Pre-Profesionales II', 10, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuela`
--

CREATE TABLE `escuela` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuela`
--

INSERT INTO `escuela` (`id`, `nombre`) VALUES
(1, 'Informática'),
(2, 'Electrónica'),
(3, 'Telecomunicaciones'),
(4, 'Mecatronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `cod_estudiante` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo_institucional` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `id_escuela` int(11) NOT NULL,
  `semestre` varchar(20) NOT NULL,
  `dni` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `cod_estudiante`, `nombre`, `apellido`, `telefono`, `correo_institucional`, `password`, `id_escuela`, `semestre`, `dni`) VALUES
(1, '2022015437', 'Hayley David', 'Quispe Chinguel', '929486812', '2022015437@unfv.edu.pe', '$2y$10$kmPe0aPnqA1xtmgRcf4aS.IXzX92rWUui7eIHiHzGrDqlJQv3VIVS', 1, '5', NULL),
(2, '2021017401', 'Oscar', 'Montes Triveño', '910795809', '2021017401@unfv.edu.pe', '$2y$10$krgRlYfnAZG/nWMEWH51buJJKPbTp7iIMDVXJTOJUtdsbZEGb5KBG', 1, '5', NULL),
(3, '2023020103', 'Diego Gilbert', 'Aguedo Flores', '948753456', 'DiegoGilbert@gmail.com', '$2y$10$KhKglApV/LvrIh941Vu78ukpsFDL5bi8jkoy/5eLy5W.or5.qB8Yy', 1, '1', NULL),
(299, '2022015455', 'Jackeline', 'Tesillo Huamanga', '944689044', '2022015455@unfv.edu.pe', '$2y$10$pF0mobqzmimDru8/91yfsOuUjfN4DU.0hzMJR0NHxw9vjKX/rL4GW', 1, '', '76875454'),
(300, '2022015277', 'James Lister', 'Yapias Calzada', '990500646', '2022015277@unfv.edu.pe', '$2y$10$m1RDrLqvwsktd1MNUiby4O30W6IKIrfVJXkayewr9iIBsNNEHOXUi', 1, '', '41879294'),
(301, '2023020567', 'DANIEL ', 'MONTES PEREZ', '910795809', '2023020567@unfv.edu.pe', '$2y$10$mfVcNkPO49rB65oadTIPqOt/Bx2Ook6ONpKUU30khAZtRPs/oQH1a', 3, '', '73965632');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generico`
--

CREATE TABLE `generico` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `codigo` varchar(500) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo_institucional` varchar(100) NOT NULL,
  `clave_tutor` varchar(255) NOT NULL,
  `id_escuela` int(11) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `codigo_docente` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`id`, `nombre`, `apellido`, `telefono`, `correo_institucional`, `clave_tutor`, `id_escuela`, `dni`, `codigo_docente`, `password`) VALUES
(1, 'Williams Fernando', 'Acosta Solorzano', '987039328', 'wacosta@unfv.edu.pe', 'tutor789', 1, '06434186', '2007071', '$2y$10$DJPc4GnGjoYrQUApI0xBBO19uzcd7ehIggLUyUS2GSiIoeJD/8a.O'),
(2, 'Tito', 'Aguilar Diaz ', '985040852', 'taguilar@unfv.edu.pe', 'tutor789', 1, '08758500', '2000247', '$2y$10$GGAVSSsu7L7hi7EpjN3C8eJcYFmp5mRaBW9Ns.KdpYFgmHyEZ8Y0q'),
(3, 'Victor Timoteo', 'Astuñaupa Balbin', '944911003', 'vastunaupa@unfv.edu.pe', 'tutor789', 1, '09033894', '2013017', '$2y$10$J.JRQ8TEi8sIywTTrjnF9Ow1vigzXQpcvwp1bAyugzDo6My7Hfwu6'),
(13, 'David', 'Quispe', '929486812', 'quispe@unfv.edu.pe', '', 1, '76963684', '2022015', '$2y$10$yeGIQ0patBOBlp3kQjhoTOLmAV2wIFTY1yC1yEdbD01bcnm97Anzq'),
(14, 'Jackeline', 'Tesillo Huamanga', '944689044', 'tesillo@unfv.edu.pe', '', 1, '76875454', '2023020', '$2y$10$FnP4cbB2m7WyxvLHTXAKaOD7bPnbsRX2aCC.OYd7M/g7zh9wulb4O'),
(15, 'JHOSELYN ', 'SUAZO SALAS', '933367934', '2022020@unfv.edu.pe', '', 3, '73259250', '2022020', '$2y$10$1YuOqZq1jed1/j7qcfW9PuZa.8DyRvvDvYCqoys0Dg7BFc9RouskS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `id` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `Modalidad` varchar(200) NOT NULL,
  `comentarios` varchar(500) NOT NULL,
  `id_tutor` int(11) NOT NULL,
  `id_ciclo` int(11) NOT NULL,
  `id_escuela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`id`, `id_curso`, `fecha`, `horaInicio`, `horaFin`, `Modalidad`, `comentarios`, `id_tutor`, `id_ciclo`, `id_escuela`) VALUES
(1, 18, '2024-08-21', '19:20:00', '20:20:00', 'virtual', 'szx', 1, 3, 1),
(2, 51, '2024-08-22', '22:42:00', '23:45:00', 'virtual', 'Comentarios', 1, 7, 1),
(3, 18, '2024-08-26', '04:00:00', '05:00:00', 'presencial', 'a', 1, 3, 1),
(4, 49, '2024-08-31', '04:00:00', '05:00:00', 'virtual', 'SI', 1, 7, 1),
(5, 28, '2024-08-29', '12:29:00', '16:29:00', 'presencial', 'sin comentario', 1, 4, 1),
(6, 110, '2024-09-20', '14:30:00', '16:35:00', 'virtual', '', 15, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria_estudiante`
--

CREATE TABLE `tutoria_estudiante` (
  `id` int(11) NOT NULL,
  `id_tutoria` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `motivo` varchar(500) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tutoria_estudiante`
--

INSERT INTO `tutoria_estudiante` (`id`, `id_tutoria`, `id_estudiante`, `motivo`, `active`) VALUES
(2, 1, 1, 'Asesoramiento en proyectos', 0),
(3, 4, 1, 'Asesoramiento en proyectos', 0),
(4, 4, 1, 'Orientación profesional', 0),
(5, 3, 1, 'Dificultades en la materia', 0),
(6, 1, 1, 'Dificultades en la materia', 0),
(7, 1, 1, 'Dificultades en la materia', 0),
(8, 1, 1, 'Dificultades en la materia', 0),
(9, 3, 1, 'Dificultades en la materia', 0),
(10, 3, 1, 'Dificultades en la materia', 0),
(11, 1, 1, 'Dificultades en la materia', 0),
(12, 3, 1, 'Dificultades en la materia', 0),
(13, 1, 300, 'Preparación para exámenes', 1),
(14, 3, 300, 'Dificultades en la materia', 1),
(15, 3, 300, 'Preparación para exámenes', 1),
(16, 1, 300, 'Preparación para exámenes', 1),
(17, 3, 300, 'Orientación profesional', 1),
(18, 3, 300, 'Asesoramiento en proyectos', 1),
(19, 3, 300, 'Orientación profesional', 1),
(20, 1, 300, 'Preparación para exámenes', 1),
(21, 3, 300, 'Preparación para exámenes', 1),
(22, 3, 300, 'Preparación para exámenes', 1),
(23, 1, 300, 'Preparación para exámenes', 1),
(24, 3, 300, 'Preparación para exámenes', 1),
(25, 1, 300, 'Dificultades en la materia', 1),
(26, 3, 300, 'Asesoramiento en proyectos', 1),
(27, 3, 300, 'Preparación para exámenes', 1),
(28, 1, 300, 'Asesoramiento en proyectos', 1),
(29, 1, 300, 'Preparación para exámenes', 1),
(30, 3, 300, 'Orientación profesional', 1),
(31, 3, 300, 'Dificultades en la materia', 1),
(32, 3, 300, 'Asesoramiento en proyectos', 1),
(33, 1, 300, 'Asesoramiento en proyectos', 1),
(34, 3, 300, 'Preparación para exámenes', 1),
(35, 3, 300, 'Asesoramiento en proyectos', 1),
(36, 1, 300, 'Asesoramiento en proyectos', 1),
(37, 3, 300, 'Asesoramiento en proyectos', 1),
(38, 3, 300, 'Preparación para exámenes', 1),
(39, 3, 300, 'Preparación para exámenes', 1),
(40, 3, 300, 'Orientación profesional', 1),
(41, 1, 300, 'Dificultades en la materia', 1),
(42, 3, 300, 'Preparación para exámenes', 1),
(43, 3, 300, 'Dificultades en la materia', 1),
(44, 3, 300, 'Asesoramiento en proyectos', 1),
(45, 3, 300, 'Asesoramiento en proyectos', 1),
(46, 3, 300, 'Asesoramiento en proyectos', 1),
(47, 3, 300, 'Orientación profesional', 1),
(48, 3, 1, 'Preparación para exámenes', 0),
(49, 3, 1, 'Asesoramiento en proyectos', 0),
(50, 3, 1, 'Asesoramiento en proyectos', 1),
(51, 3, 299, 'Dificultades en la materia', 1),
(52, 6, 301, 'Preparación para exámenes', 0),
(53, 6, 301, 'Dificultades en la materia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria_generico`
--

CREATE TABLE `tutoria_generico` (
  `id` int(11) NOT NULL,
  `id_tutoria` int(11) NOT NULL,
  `id_generico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciclos`
--
ALTER TABLE `ciclos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escuela`
--
ALTER TABLE `escuela`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generico`
--
ALTER TABLE `generico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_institucional` (`correo_institucional`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tutor` (`id_tutor`);

--
-- Indices de la tabla `tutoria_estudiante`
--
ALTER TABLE `tutoria_estudiante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutoria_generico`
--
ALTER TABLE `tutoria_generico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tutoria` (`id_tutoria`),
  ADD KEY `id_generico` (`id_generico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ciclos`
--
ALTER TABLE `ciclos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT de la tabla `escuela`
--
ALTER TABLE `escuela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de la tabla `generico`
--
ALTER TABLE `generico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tutoria_estudiante`
--
ALTER TABLE `tutoria_estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `tutoria_generico`
--
ALTER TABLE `tutoria_generico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD CONSTRAINT `fk_tutoria_tutor` FOREIGN KEY (`id_tutor`) REFERENCES `tutor` (`id`);

--
-- Filtros para la tabla `tutoria_generico`
--
ALTER TABLE `tutoria_generico`
  ADD CONSTRAINT `fk_tutoria_generico_generico` FOREIGN KEY (`id_generico`) REFERENCES `generico` (`id`),
  ADD CONSTRAINT `fk_tutoria_generico_tutoria` FOREIGN KEY (`id_tutoria`) REFERENCES `tutoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
