-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2025 a las 00:01:50
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
-- Base de datos: `db_unaa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_componente`
--

CREATE TABLE `lic_componente` (
  `id` int(11) NOT NULL,
  `id_condicion` int(11) DEFAULT NULL,
  `cod_componente` varchar(45) DEFAULT NULL,
  `nom_componente` text DEFAULT NULL,
  `priorizado` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_componente`
--

INSERT INTO `lic_componente` (`id`, `id_condicion`, `cod_componente`, `nom_componente`, `priorizado`, `created_at`, `updated_at`) VALUES
(1, 1, 'I.1', 'Objetivos institucionales', 0, NULL, NULL),
(2, 1, 'I.2', 'Objetivos académicos y planes de estudio', 0, NULL, NULL),
(3, 1, 'I.3', 'Grados y títulos', 0, NULL, NULL),
(4, 1, 'I.4', 'Sistemas de información', 1, NULL, NULL),
(5, 1, 'I.5', 'Procesos de admisión', 0, NULL, NULL),
(6, 1, 'I.6', 'Plan de Gestión de la Calidad Institucional', 0, NULL, NULL),
(7, 2, 'II.1', 'Creación de nuevas universidades', 0, NULL, NULL),
(8, 2, 'II.2', 'Creación de nuevos programas de estudios en universidades existentes', 0, NULL, NULL),
(9, 3, 'III.1', 'Ubicación de locales', 0, NULL, NULL),
(10, 3, 'III.2', 'Posesión de locales', 0, NULL, NULL),
(11, 3, 'III.3', 'Seguridad estructural y seguridad en caso de siniestros', 0, NULL, NULL),
(12, 3, 'III.4', 'Seguridad de uso de laboratorios y talleres', 1, NULL, NULL),
(13, 3, 'III.5', 'Disponibilidad de servicios públicos', 0, NULL, NULL),
(14, 3, 'III.6', 'Dotación de servicios higiénicos', 0, NULL, NULL),
(15, 3, 'III.7', 'Talleres y laboratorios para la enseñanza', 1, NULL, NULL),
(16, 3, 'III.8', 'Ambientes para docentes', 1, NULL, NULL),
(17, 3, 'III.9', 'Mantenimiento de la infraestructura y equipamiento', 0, NULL, NULL),
(18, 4, 'IV.1', 'Líneas de investigación', 1, NULL, NULL),
(19, 4, 'IV.2', 'Docentes que realizan investigación', 0, NULL, NULL),
(20, 4, 'IV.3', 'Registro de documentos y proyectos de investigación', 1, NULL, NULL),
(21, 5, 'V.1', 'Existencia del 25% del total de docentes, como mínimo, a tiempo completo', 0, NULL, NULL),
(22, 5, 'V.2', 'Requisitos para el ejercicio de la docencia', 0, NULL, NULL),
(23, 5, 'V.3', 'Selección, evaluación y capacitación docente', 0, NULL, NULL),
(24, 6, 'VI.1', 'Servicios de salud', 0, NULL, NULL),
(25, 6, 'VI.2', 'Servicio social', 1, NULL, NULL),
(26, 6, 'VI.3', 'Servicios psicopedagógicos', 0, NULL, NULL),
(27, 6, 'VI.4', 'Servicios deportivos', 0, NULL, NULL),
(28, 6, 'VI.5', 'Servicios culturales', 0, NULL, NULL),
(29, 6, 'VI.6', 'Servicios de seguridad y vigilancia', 0, NULL, NULL),
(30, 6, 'VI.7', 'Adecuación al entorno y protección al ambiente', 0, NULL, NULL),
(31, 6, 'VI.8', 'Acervo bibliográfico', 1, NULL, NULL),
(32, 7, 'VII.1', 'Mecanismos de mediación e inserción laboral para estudiantes y egresados', 0, NULL, NULL),
(33, 7, 'VII.2', 'Mecanismos de coordinación y alianzas estratégicas con el sector público y/o privado', 0, NULL, NULL),
(34, 8, 'VIII.1', 'Transparencia', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_condicion`
--

CREATE TABLE `lic_condicion` (
  `id` int(11) NOT NULL,
  `sigla_condic` varchar(45) DEFAULT NULL,
  `nom_condicion` text DEFAULT NULL,
  `descrip` text DEFAULT NULL,
  `priorizado` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_condicion`
--

INSERT INTO `lic_condicion` (`id`, `sigla_condic`, `nom_condicion`, `descrip`, `priorizado`, `created_at`, `updated_at`) VALUES
(1, 'CBC. I', 'CONDICIÓN I', 'Existencia de objetivos académicos, grados y títulos a otorgar y planes de estudio correspondientes.', 1, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(2, 'CBC. II', 'CONDICIÓN II', 'Oferta educativa a crearse compatible con los fines propuestos en los instrumentos de planeamiento.', 0, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(3, 'CBC. III', 'CONDICIÓN III', 'Infraestructura y equipamiento adecuado al cumplimiento de sus funciones (aulas, bibliotecas, laboratorios, entre otros).', 1, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(4, 'CBC. IV', 'CONDICIÓN IV', 'Líneas de investigación a ser desarrolladas.', 1, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(5, 'CBC. V', 'CONDICIÓN V', 'Verificación de la disponibilidad de personal docente calificado con no menos del 25% de docentes a tiempo completo.', 0, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(6, 'CBC. VI', 'CONDICIÓN VI', 'Verificación de los servicios educacionales complementarios básicos (servicio médico, social, psicopedagógico, deportivo, entre otros).', 1, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(7, 'CBC. VII', 'CONDICIÓN VII', 'Existencia de mecanismos de mediación e inserción laboral (Bolsa de Trabajo u otros).', 0, '2024-10-01 16:00:00', '2024-10-01 16:00:00'),
(8, 'CBC. VIII', 'CONDICIÓN VIII', 'CBC complementaria: Transparencia de universidades.', 0, '2024-10-01 16:00:00', '2024-10-01 16:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_evaluacion`
--

CREATE TABLE `lic_evaluacion` (
  `id` int(11) NOT NULL,
  `anio_grupo` int(11) DEFAULT NULL,
  `id_indicador` int(11) DEFAULT NULL,
  `id_mv` int(11) DEFAULT NULL,
  `sigla_mv` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `tipo_eval` varchar(45) DEFAULT 'BASE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_evaluacion`
--

INSERT INTO `lic_evaluacion` (`id`, `anio_grupo`, `id_indicador`, `id_mv`, `sigla_mv`, `estado`, `tipo_eval`, `created_at`, `updated_at`) VALUES
(1, 2025, 1, 1, 'MV1', 'SM', 'DOCUMENTAL', '2025-08-05 19:46:48', '2025-08-05 19:46:48'),
(2, 2025, 2, 2, 'MV1', 'PM', 'DOCUMENTAL', '2025-08-13 16:29:00', '2025-08-13 16:29:00'),
(3, 2025, 2, 3, 'MV2', 'NM', 'DOCUMENTAL', '2025-08-13 16:29:28', '2025-08-13 16:29:28'),
(4, 2025, 3, 4, 'MV1', 'NM', 'DOCUMENTAL', '2025-08-13 16:40:34', '2025-08-13 16:40:34'),
(5, 2025, 4, 5, 'MV1', 'SM', 'DOCUMENTAL', '2025-08-13 16:40:44', '2025-08-13 16:40:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_evidencia`
--

CREATE TABLE `lic_evidencia` (
  `id` int(11) NOT NULL,
  `id_indicador` int(11) DEFAULT NULL,
  `id_mv` int(11) DEFAULT 0,
  `anio_grupo` int(11) DEFAULT 2019,
  `nom_evidencia` text DEFAULT NULL,
  `tipo_docu` varchar(45) DEFAULT 'archivo',
  `id_sisades` int(11) DEFAULT 0,
  `id_sgc` int(11) DEFAULT 0,
  `sgc_niv0` int(11) DEFAULT 0,
  `sgc_niv1` int(11) DEFAULT 0,
  `adjunto` text DEFAULT NULL,
  `adjuntos` text DEFAULT NULL,
  `al_2019` varchar(45) DEFAULT 'OK',
  `al_2024` varchar(45) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT 0,
  `nom_usuario` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_evidencia`
--

INSERT INTO `lic_evidencia` (`id`, `id_indicador`, `id_mv`, `anio_grupo`, `nom_evidencia`, `tipo_docu`, `id_sisades`, `id_sgc`, `sgc_niv0`, `sgc_niv1`, `adjunto`, `adjuntos`, `al_2019`, `al_2024`, `comentario`, `id_usuario`, `nom_usuario`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2025, 'RRR', 'url', 0, 0, 0, 0, 'http://localhost/sgc_unaa/public/mantenimiento_cbc', NULL, '', 'OK', 'Comentario 01', 1, 'ADMINISTRADOR SISTEMAS', 1, '2025-08-04 21:01:04', '2025-08-13 16:05:39'),
(2, 1, 1, 2025, 'DOCUMENTO', 'url', 0, 0, 0, 0, 'http://localhost/sgc_unaa/public/mantenimiento_cbc', NULL, '', 'OK', 'xd', 1, 'ADMINISTRADOR SISTEMAS', 1, '2025-08-12 20:17:27', '2025-08-13 16:07:06'),
(3, 1, 1, 2025, 'documento pdf', 'archivo', 0, 0, 0, 0, '_1755092844jXtd3nTy18JVxK8.pdf', NULL, '', 'OK', 'dwqfafs', 1, 'ADMINISTRADOR SISTEMAS', 1, '2025-08-13 13:47:24', '2025-08-13 16:07:09'),
(4, 2, 2, 2025, 'Link', 'url', 0, 0, 0, 0, 'http://localhost/sgc_unaa/public/mantenimiento_cbc', NULL, '', 'OK', 'textoo', 1, 'ADMINISTRADOR SISTEMAS', 1, '2025-08-13 16:28:58', '2025-08-13 21:49:49'),
(5, 2, 3, 2025, 'ddd', 'url', 0, 0, 0, 0, 'http://localhost/sgc_unaa/public/mantenimiento_cbc', NULL, '', 'OK', NULL, 1, 'ADMINISTRADOR SISTEMAS', 1, '2025-08-13 16:29:24', '2025-08-13 16:29:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_indicador`
--

CREATE TABLE `lic_indicador` (
  `id` int(11) NOT NULL,
  `id_condicion` int(11) DEFAULT NULL,
  `id_componente` int(11) DEFAULT 0,
  `nom_indicador` varchar(45) DEFAULT NULL,
  `descrip` text DEFAULT NULL,
  `priorizado` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_indicador`
--

INSERT INTO `lic_indicador` (`id`, `id_condicion`, `id_componente`, `nom_indicador`, `descrip`, `priorizado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Indicador 1', 'La universidad tiene definidos sus objetivos institucionales.', 0, NULL, '2025-02-10 16:54:00'),
(2, 1, 2, 'Indicador 2', 'La universidad cuenta con planes de estudios para cada uno de los programas de pregrado y/o posgrado.', 0, NULL, '2025-02-10 17:56:33'),
(3, 1, 3, 'Indicador 3', 'Existencia de un documento normativo que regule las modalidades y los requisitos para la obtención del grado, y el título de los programas de estudio de la universidad.', 0, NULL, '2025-02-10 17:20:49'),
(4, 1, 4, 'Indicador 4', 'La universidad cuenta con sistemas de información que brinden soporte a los procesos de gestión económica y financiera, gestión docente, matrícula y registro académico. Adicionalmente, en sus sistemas, cuenta con tres (03) de los siguientes cuatro (04) procesos: a) Aprendizaje virtual b) Gestión de biblioteca c) Pagos virtuales d) Gestión institucional basada en indicadores.', 1, NULL, '2025-02-10 17:20:54'),
(5, 1, 5, 'Indicador 5', 'Existencia de un documento normativo que regule los procesos de admisión.', 0, NULL, '2025-02-10 17:21:02'),
(6, 1, 5, 'Indicador 6', 'La universidad cuenta con información sobre los procesos de admisión y los ingresantes según modalidades de ingreso por periodo académico.', 0, NULL, '2025-02-10 17:21:07'),
(7, 1, 6, 'Indicador 7', 'Plan de Gestión de la Calidad / Plan de mejora continua orientado a elevar la calidad de la formación académica. ', 0, NULL, '2025-02-10 17:19:36'),
(8, 1, 6, 'Indicador 8', 'La universidad cuenta con un área de Gestión de la Calidad.', 0, NULL, '2025-02-10 17:19:26'),
(9, 2, 7, 'Indicador 9', 'Existencia de un presupuesto institucional proyectado a cinco (05) años en concordancia con los objetivos estratégicos.', 0, NULL, '2024-12-13 17:47:28'),
(10, 2, 7, 'Indicador 10', 'Existencia de un Plan de Financiamiento de cinco (05) años.', 0, NULL, '2024-12-13 17:47:45'),
(11, 2, 7, 'Indicador 11', 'Vinculación de la oferta educativa propuesta a la demanda laboral.', 0, NULL, '2024-12-13 17:48:07'),
(12, 2, 7, 'Indicador 12', 'Oferta educativa relacionada con las políticas nacionales y regionales de educación universitaria.', 0, NULL, '2024-12-13 17:50:13'),
(13, 2, 7, 'Indicador 13', 'Fuentes de financiamiento de la universidad, para las universidades privadas.', 0, NULL, '2024-12-13 17:52:12'),
(14, 2, 8, 'Indicador 14', 'Vinculación de los nuevos programas de estudios, a la demanda laboral.', 0, NULL, '2024-12-13 17:52:29'),
(15, 2, 8, 'Indicador 15', 'Existencia de Plan de Financiamiento que demuestre la disponibilidad de recursos humanos y económicos para el inicio y sostenibilidad del nuevo programa de estudio a ofrecer.', 0, NULL, '2024-12-13 17:52:40'),
(16, 3, 9, 'Indicador 16', 'Todos los locales de la universidad cumplen con las normas sobre compatibilidad de uso y zonificación urbana.', 0, NULL, '2024-12-13 17:53:02'),
(17, 3, 10, 'Indicador 17', 'Locales propios, alquilados, bajo cesión en uso o algún otro título, de uso exclusivo para su propósito.', 0, NULL, '2024-12-13 17:54:12'),
(18, 3, 11, 'Indicador 18', 'Los locales cumplen con las normas de seguridad estructural en edificaciones y prevención de riesgos en estricto cumplimiento con las normas del Centro Nacional de Estimación, Prevención y Reducción del Riesgo de Desastres - CENEPRED/INDECI.', 0, NULL, '2024-12-13 17:54:29'),
(19, 3, 12, 'Indicador 19', 'La universidad cuenta con un reglamento interno de seguridad y salud en el trabajo, y protocolos de seguridad.', 1, NULL, '2024-12-13 17:54:43'),
(20, 3, 12, 'Indicador 20', 'La universidad cuenta con estándares de seguridad para el funcionamiento de los laboratorios, según corresponda.', 0, NULL, '2024-12-13 17:54:59'),
(21, 3, 13, 'Indicador 21', 'Disponibilidad de agua potable y desagüe.', 0, NULL, '2024-12-13 17:55:25'),
(22, 3, 13, 'Indicador 22', 'Disponibilidad de energía eléctrica.', 0, NULL, '2024-12-13 17:55:45'),
(23, 3, 13, 'Indicador 23', 'Disponibilidad de líneas telefónicas.', 0, NULL, '2024-12-13 17:56:02'),
(24, 3, 13, 'Indicador 24', 'Disponibilidad de Internet en los ambientes que brinden el servicio educativo de todos sus locales. El servicio de Internet debe contar con banda ancha requerida para la educación superior universitaria, conforme a lo establecido por el órgano competente y de acuerdo a la disponibilidad del servicio de telecomunicaciones en la región.', 0, NULL, '2024-12-13 21:23:22'),
(25, 3, 14, 'Indicador 25', 'Dotación de servicios higiénicos para los estudiantes en todos sus locales, de acuerdo con el art. 13 de la Norma Técnica A.040 Educación contenido en el Reglamento Nacional de Edificaciones (RNE).', 0, NULL, '2024-12-13 17:56:50'),
(26, 3, 14, 'Indicador 26', 'Dotación de servicios higiénicos para personal docente y administrativo en todos sus locales, de acuerdo con el art. 15 de la Norma Técnica A.080 del RNE.', 0, NULL, '2024-12-13 17:57:07'),
(27, 3, 15, 'Indicador 27', 'La universidad cuenta con talleres y laboratorios de enseñanza propios, de conformidad con el número de estudiantes, actividades académicas y programas de estudio.', 1, NULL, '2024-12-13 17:57:29'),
(28, 3, 15, 'Indicador 28', 'Los laboratorios de enseñanza están equipados de acuerdo con su especialidad.', 0, NULL, '2024-12-13 17:57:51'),
(29, 3, 16, 'Indicador 29', 'La universidad cuenta con ambientes para los docentes en cada local que ofrece el servicio educativo.', 1, NULL, '2024-12-13 17:58:08'),
(30, 3, 17, 'Indicador 30', 'Existencia de presupuesto y un plan de mantenimiento.', 0, NULL, '2024-12-13 17:58:21'),
(31, 4, 18, 'Indicador 31', 'Existencia de políticas, normas y procedimientos para el fomento y realización de la investigación como una actividad esencial y obligatoria de la universidad.', 0, NULL, '2024-12-13 17:58:38'),
(32, 4, 18, 'Indicador 32', 'Existencia de un Órgano Universitario de Investigación cuyo responsable cuenta con un grado de doctor.', 1, NULL, '2024-12-13 17:58:56'),
(33, 4, 18, 'Indicador 33', 'Existencia de líneas de investigación. Asimismo, se debe indicar el presupuesto asignado para la investigación, equipamiento, personal y otros.', 1, NULL, '2024-12-13 17:59:29'),
(34, 4, 18, 'Indicador 34', 'Código de Ética para la investigación.', 0, NULL, '2024-12-13 17:59:44'),
(35, 4, 18, 'Indicador 35', 'Políticas de protección de la propiedad intelectual.', 0, NULL, '2024-12-13 17:59:58'),
(36, 4, 19, 'Indicador 36', 'La universidad cuenta con un registro de docentes que realizan investigación. Asimismo, los docentes deben estar registrados en el DINA. ', 0, NULL, '2024-12-13 18:00:20'),
(37, 4, 20, 'Indicador 37', 'La universidad tiene un registro de documentos de investigación y/o repositorio institucional. Los documentos de investigación incluyen tesis, informes de investigación, publicaciones científicas, entre otros.', 0, NULL, '2024-12-13 18:00:43'),
(38, 4, 20, 'Indicador 38', 'La universidad tiene un registro de proyecto(s) de investigación en proceso de ejecución.', 1, NULL, '2024-12-13 18:01:07'),
(39, 5, 21, 'Indicador 39', 'La universidad tiene como mínimo el 25% del total de docentes a tiempo completo.', 0, NULL, '2024-12-13 18:01:30'),
(40, 5, 22, 'Indicador 40', 'Los docentes incorporados a la docencia universitaria con fecha posterior a la entrada en vigencia de la Ley Universitaria que dediquen horas de docencia en pregrado o postgrado cuentan, al menos, con grado de maestro o doctor, según corresponda.', 0, NULL, '2024-12-13 18:02:46'),
(41, 5, 23, 'Indicador 41', 'La universidad regula los mecanismos y/o procedimientos para la selección, evaluación periódica del desempeño y ratificación de sus docentes, lo cual incluye como criterio la calificación de los estudiantes por semestre académico.', 0, NULL, '2024-12-13 18:04:00'),
(42, 5, 23, 'Indicador 42', 'La universidad regula la capacitación de sus docentes.', 0, NULL, '2024-12-13 18:04:12'),
(43, 6, 24, 'Indicador 43', 'La universidad cuenta en todos sus locales con un tópico o con el servicio tercerizado.', 0, NULL, '2024-12-13 18:08:37'),
(44, 6, 25, 'Indicador 44', 'Existencia de servicios sociales disponibles para los estudiantes: bienestar social, bienestar estudiantil, programas de voluntariado, entre otros.', 1, NULL, '2024-12-13 18:09:05'),
(45, 6, 26, 'Indicador 45', 'Existencia de servicios psicopedagógicos disponibles para todos los estudiantes.', 0, NULL, '2024-12-13 18:09:30'),
(46, 6, 27, 'Indicador 46', 'Existencia de servicios deportivos en al menos tres disciplinas deportivas, disponibles para los estudiantes con el objetivo de fomentar su participación y desarrollo.', 0, NULL, '2024-12-13 18:09:59'),
(47, 6, 28, 'Indicador 47', 'Existencia y difusión de servicios culturales que estén disponibles para todos los estudiantes para su participación y desarrollo del mismo. ', 0, NULL, '2024-12-13 18:10:25'),
(48, 6, 29, 'Indicador 48', 'Existencia de servicios de seguridad y vigilancia en todos sus locales.', 0, NULL, '2024-12-13 18:10:53'),
(49, 6, 30, 'Indicador 49', 'La universidad cuenta con políticas, planes y acciones para la protección al ambiente.', 0, NULL, '2024-12-13 18:11:07'),
(50, 6, 31, 'Indicador 50', 'Material bibliográfico según planes de estudio de sus programas. El acervo bibliográfico puede ser en físico y/o virtual. Las bibliotecas virtuales deben estar suscritas.', 1, NULL, '2025-02-10 17:21:39'),
(51, 7, 32, 'Indicador 51', 'Existencia de un área, dirección o jefatura encargada del seguimiento del graduado.', 0, NULL, '2024-12-13 18:13:06'),
(52, 7, 32, 'Indicador 52', 'Mecanismos de apoyo a la inserción laboral. ', 0, NULL, '2024-12-13 18:13:33'),
(53, 7, 32, 'Indicador 53', 'Existencia de convenios con instituciones públicas y/o privadas de prácticas preprofesionales y profesionales.', 0, NULL, '2024-12-13 18:13:42'),
(54, 7, 33, 'Indicador 54', 'Mecanismos de coordinación y alianzas estratégicas con el sector público y/o privado.', 0, NULL, '2024-12-13 18:14:17'),
(55, 8, 34, 'Indicador 55', 'Transparencia de la información institucional a través de su portal web.', 0, NULL, '2025-02-10 17:21:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lic_mv`
--

CREATE TABLE `lic_mv` (
  `id` int(11) NOT NULL,
  `id_indicador` int(11) DEFAULT NULL,
  `sigla_mv` varchar(20) DEFAULT NULL,
  `nom_mv` longtext DEFAULT NULL,
  `consids` longtext DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL,
  `aplica` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lic_mv`
--

INSERT INTO `lic_mv` (`id`, `id_indicador`, `sigla_mv`, `nom_mv`, `consids`, `id_responsable`, `aplica`, `created_at`, `updated_at`) VALUES
(1, 1, 'MV1', 'Estatuto de la universidad u otro documento aprobado por la autoridad competente de la universidad.', '<ol><li>&nbsp;La universidad presenta el Estatuto vigente. En caso este documento no establezca los objetivos institucionales, la universidad podrá presentar un documento alternativo que los contenga.</li><li>Los objetivos institucionales están formulados para el cumplimiento de los fines de la universidad, de acuerdo al artículo 6 de la Ley N° 30220, Ley Universitaria. Por lo tanto, al menos uno de sus objetivos menciona a la investigación como fin de la universidad.</li><li>El MV presentado está aprobado por la autoridad competente mediante resolución o documento oficial que haga sus veces.</li></ol>', 1, 1, NULL, '2025-08-04 20:53:06'),
(2, 2, 'MV1', 'Planes de estudios de los programas de estudios (Formato de Malla Curricular)', '<div><p><b>1.</b>&nbsp;Este documento contiene:&nbsp;&nbsp;</p></div><p>a. Nombre del programa, la(s) mención(es), modalidad(es), el grado y título que otorga, de ser el caso. (Esto coincide con lo declarado en los formatos de licenciamiento A4, A8 y C1 presentados en la Solicitud de Licenciamiento Institucional y con la resolución aprobatoria/ratificatoria del plan de estudios).</p><p>b. La lista de cursos, precisando los créditos; si es general, específico o de especialidad; presencial o semipresencial; electivo u obligatorio; las horas por semestre y la codificación que utilice cada uno de ellos.</p><p>c. Perfil del graduado y/o egresado.</p><p>d. Malla curricular (esquema de cursos por ciclo. opcionalmente, la relación de cursos de requisito)&nbsp; &nbsp; &nbsp; </p><p><b>2.</b> La universidad adjunta el documento de aprobación, actualización y/o de ratificación del plan de estudio, aprobado por la autoridad competente de la universidad, según corresponda.</p>', 2, 1, NULL, '2025-08-13 16:28:33'),
(3, 2, 'MV2', 'Formato de Malla Curricular y Analisis de Creditos Académicos - SUNEDU', '<div>1. La universidad presenta el formato de licenciamiento C1 completo y firmado por el representante legal.</div><div>2. El formato de licenciamiento C1 guarda coherencia con los otros medios de verificación (planes de estudios, malla curricular; los formatos de licenciamiento A4, A5 y A8).</div><div>3. Los programas de estudios y menciones cumplen con todo establecido en la Ley Universitaria. </div><div><b>Duración de un crédito académico.&nbsp; &nbsp; </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>4. Este tiene una duración mínima de 16 horas lectivas de teoría o el doble de horas de práctica, por periodo académico.</div><div><b>Estudios de pregrado</b></div><div>5. Los estudios de pregrado comprenden estudios generales (con una duración no menor a 35 créditos académicos), estudios específicos y de especialidad (con una duración no menor a 165 créditos académicos).</div><div>6. Tienen una duración mínima de cinco años y se realizan en un máximo de dos semestres académicos por año.</div><div>7. Comprenden como mínimo 200 créditos académicos.</div><div>8. Un programa de pregrado no supera el 50 % de créditos virtuales.</div><div><b>Estudios de maestría</b></div><div>9. Comprende un mínimo de cuarenta y ocho (48) créditos académicos. Se llevan a cabo mínimo en dos semestres académicos.</div><div>10. El programa no es dictado exclusivamente bajo la modalidad virtual.</div><div><b>Estudios de doctorado</b></div><div>11. Comprende un mínimo de sesenta y cuatro (64) créditos académicos. Se llevan a cabo mínimo en seis semestres académicos</div><div>12. El programa no es dictado exclusivamente bajo la modalidad virtual.</div><div><b>Estudios de segunda especialidad&nbsp; &nbsp;</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>13. Mínimo 40 créditos académicos.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>14. Mínimo 2 semestres académicos.&nbsp;</div>', 2, 1, NULL, '2025-08-13 16:28:38'),
(4, 3, 'MV1', 'Reglamento de Grados y Títulos u otro documento normativo aprobado por la autoridad competente de la universidad, indicando ultima fecha de actualización.', '<div>1. La universidad adjunta el o los documentos que regulan todas las modalidades de estudio, menciones, así como los requisitos para la obtención de grados y títulos en todos los programas de pregrado y posgrado. Asimismo, presenta el documento que regule la obtención del título de segunda especialidad, según corresponda.</div><div>2. El o los documentos indican su última fecha de actualización.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>3. El o los documentos están aprobados por la autoridad competente.</div>', 4, 1, NULL, '2025-08-13 16:40:23'),
(5, 4, 'MV1', 'Manual de usuario o documento pertinente que evidencia los sistemas de gestión económica y financiera', '<div>Para todos los MV:</div><div>La universidad presenta un manual de usuario o cualquier otro documento que explique las funciones e instrucciones de uso de los sistemas de información.</div><div>• El documento contiene: objetivos, usuarios, procedimientos, reportes y otras funcionalidades. (Excepto para el SIAF, el cual mantiene el esquema del MEF, para las universidades públicas). Además, presenta un registro gráfico (por ejemplo, capturas de pantalla) del programa.</div><div>• El documento consigna su última fecha de actualización.&nbsp;</div><div>El sistema de gestión económica y financiera incluye:</div><div>1. Operaciones contables (ingresos, gastos, activos, pasivos, entre otros].</div><div>2. Indicadores económicos financieros.</div><div>3.&nbsp; Estado de situación financiera.</div><div>4. Estado de resultados.</div><div>5. Generación de reportes</div>', 3, 1, NULL, '2025-08-13 16:40:29'),
(6, 4, 'MV2', 'Manual de usuario o documento pertinente que  evidencia los sistemas de gestión docente', '<div>El sistema de gestión docente incluye:</div><div>1. Información del docente (datos generales, categoría, régimen de dedicación).</div><div>2. Actividades a realizar por semestre.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>3. Programación de horarios de clases.</div><div>4. Registro de asistencias.</div><div>5. Tiempo de labores administrativas e investigación.</div><div>6.&nbsp; Registro y reporte de notas.</div><div>7. Reportes de cantidad y relación de estudiantes matriculados por curso.</div><div>8. Evaluación del docente.</div>', 0, 1, NULL, '2025-02-11 15:08:30'),
(7, 4, 'MV3', 'Manual  de  usuario o documento pertinente que  evidencia los sistemas de matricula', '<div>1. El Sistema de matrícula brinda la opción de matrícula en línea de los estudiantes y contiene:</div><div><br></div><div><b>Para el estudiante</b></div><div>a. Cursos disponibles para matricula por programa y periodo académico (según pre requisitos).</div><div>b. Horario del estudiante.</div><div>c. Selección de docente.</div><div><br></div><div><b>Para uso administrativo</b></div><div>d. Generación de reporte de matrícula por periodo académico.</div><div>e. Programas ofertados por periodo académico.</div><div>f. Generación de reportes de indicadores de gestión.</div>', 0, 1, NULL, '2025-02-11 15:08:23'),
(8, 4, 'MV4', 'Manual  de  usuario o documento pertinente que  evidencia los sistemas de registro académico', '<div>1. El Sistema de registro académico permite a los estudiantes y egresados la obtención de su historial académico, considerando lo siguiente:</div><div>a. Rendimiento académico (historial de notas, promedio ponderado, créditos académicos, entre otros).</div><div>b. Porcentaje de asistencia a clases.</div>', 0, 1, NULL, '2025-02-11 15:08:16'),
(9, 4, 'MV5', 'Manual  de  usuario o documento pertinente que  evidencia los sistemas de aprendizaje virtual.', '<div>1. El Sistema de aprendizaje virtual es obligatorio para universidades con programas de educación semipresencial. Contiene lo siguiente:</div><div>a.&nbsp; Inducción al uso de plataforma virtual (Por ejemplo: videos tutoriales, correo electrónico, manual de uso, conferencia).</div><div>b. Acceso a material didáctico.</div><div>c.&nbsp; Evaluaciones en línea.</div><div>d. Consultas al docente.</div><div>e. Foros.</div><div>f. Videoconferencias.</div><div>g. Tutoría.</div><div>h. Intercambio de archivos.</div>', 0, 1, NULL, '2025-02-11 15:08:09'),
(10, 4, 'MV6', 'Manual  de  usuario o documento pertinente que  evidencia los sistemas de gestión de biblioteca.', '<div>1.&nbsp; El <b><u>Sistema de gestión de biblioteca</u></b> cuenta con lo siguiente:</div><div>a. Información sobre el préstamo según tipo de usuario o material bibliográfico (ejemplos: plazos de préstamo, lectura en sala o fuera de ella, periodo del préstamo, sanciones, etc.).</div><div>b. Registro del acervo bibliográfico (libro, revistas, tesis, periódicos, entre otros).</div><div>c. Acceso a consultas sobre disponibilidad del acervo bibliográfico.</div><div>d. Seguimiento de préstamo y devolución de material bibliográfico.</div><div>e. Reservas de libros o salas de estudio.</div><div>f. Acceso a bases de datos</div>', 0, 1, NULL, '2025-02-11 15:08:01'),
(11, 4, 'MV7', 'Manual  de  usuario o documento pertinente que  evidencia los sistemas de pagos virtuales', '<div>1. El <b><u>Sistema de pagos virtuales</u></b>:</div><div>a. Facilita el pago de los servicios que ofrece la universidad (matriculas, pensiones, constancias, cursos extracurriculares y multas, entre otros).&nbsp; &nbsp;</div><div>b. Cuenta con una plataforma desde la cual el estudiante pueda realizar pagos mediante tarjetas de crédito a débito. Para ello, la universidad podrá suscribir convenios con instituciones financieras.</div>', 0, 1, NULL, '2025-02-11 15:02:43'),
(12, 4, 'MV8', 'Manual de usuario o documento pertinente que evidencia los sistemas de gestión institucional.', '<div style=\"text-align: justify;\">1. El <u><b>Sistema de Gestión Institucional</b></u> en base a indicadores registra y suministra información sobre la gestión institucional a través del análisis de indicadores académicos, financieros y operativos para potenciar la toma de decisiones.</div>', 0, 1, NULL, '2025-03-06 22:22:17'),
(13, 5, 'MV1', 'Normatividad o Reglamento de Admisión aprobado por la autoridad competente de la universidad, que regule las modalidades de ingreso para todos los programas de estudios, indicando su última fecha de actualización.', '<div style=\"text-align: justify;\">1. La universidad adjunta el o los documentos que regulan los procesos de admisión, conforme a la Ley N\" 30220, Ley Universitaria, para todas las modalidades de los programas de estudio ofrecidos, incluyendo las segundas especialidades, declarados en el formato de licenciamiento A4 y A8.&nbsp;</div>', 0, 1, NULL, '2025-02-11 16:02:01'),
(14, 6, 'MV1', 'Informe estadistico de admisión de los últimos 2 años, según corresponda.', '<div>1. El informe estadístico considera el número de postulantes e ingresantes en los procesos de admisión de los últimos dos (2) años:</div><div>a. Por sede y filial,</div><div>b. Por proceso de admisión,</div><div>c. Por programa de estudio (incluyendo segunda especialidad),</div><div>d. Por modalidad de ingreso (según lo declarado en el MV del indicador 5),</div><div>e. Por sexo del postulante.</div>', 0, 1, NULL, '2025-02-11 16:28:27'),
(15, 7, 'MV1', 'Plan de Gestión de la Calidad Institucional, aprobado por la autoridad competente de la universidad.', '<div><b>1.</b> El plan de gestión de la calidad institucional o el plan de mejora continua está orientado a incrementar la calidad de la formación académica a nivel institucional.</div><div>El plan está vigente y contiene:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>a. Objetivos</div><div>b. Indicadores determinados en base a los objetivos y fines de la universidad.</div><div>c. Actividades</div><div>d. Resultados esperados</div><div>e. Presupuesto</div><div>f. Cronograma de actividades</div><div>g. Responsables</div><div>d. Acciones de evaluación (monitoreo y control)</div><div><b>2</b>. El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-02-17 17:22:43'),
(16, 8, 'MV1', 'Documento que acredite que existe un área de Gestión de Calidad, dirección o departamento emitido por la autoridad competente de la universidad, indicando su fecha de aprobación.', '<div>1. El documento demuestra la existencia del área que gestiona la calidad institucional, indicando su ubicación dentro del organigrama de la Universidad.</div><div>2. El área cuenta con un ambiente físico determinado.</div><div>3. El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-02-14 21:38:31'),
(17, 8, 'MV2', 'Relación del personal calificado asignado a la misma.', '<ol><li style=\"text-align: justify;\">La relación precisa la especialidad, grado y cargo del personal a cargo del área que gestiona la calidad institucional.</li><li style=\"text-align: justify;\">Si el responsable es docente de la universidad, tiene dedicación a tiempo completo y está registrado debidamente en el formato de licenciamiento C9.</li></ol>', 0, 1, NULL, '2025-02-14 21:38:38'),
(18, 9, 'MV1', 'Presupuesto Institucional formulado de acuerdo a su Plan Estratégico y/o planes operativos para los próximos cinco (05) años, que incluya el presupuesto de gestión administrativa, de investigación, de infraestructura  y de equipamiento (ampliación, renovación, mantenimiento, etc.), de gestión académica, de servicios complementarios, de programas de bienestar, entre otros.', '<ol><li style=\"text-align: justify;\">El indicador aplica solo para universidades nuevas; es decir, aquellas creadas con posterioridad al plazo establecido por la Ley de Moratoria de creación de universidades públicas y privadas por un periodo de cinco años, Ley N° 29971, y con ley de creación sin actividad académica y/o que no hayan organizado concursos de admisión.</li></ol>', 0, 1, NULL, '2025-02-14 13:34:57'),
(19, 10, 'MV1', 'Plan de financiamiento del presupuesto institucional para los próximos cinco (05) años.', '<ol><li style=\"text-align: justify;\">El indicador aplica solo para universidades nuevas; es decir, aquellas creadas con posterioridad al plazo establecido por la Ley de Moratoria de creación de universidades públicas y privadas por un periodo de cinco años, Ley N° 29971, y con ley de creación sin actividad académica y/o que no hayan organizado concursos de admisión.</li></ol>', 0, 1, NULL, '2025-02-14 13:35:02'),
(20, 11, 'MV1', 'Documento o estudios que justifiquen el desarrollo de los programas de estudio.', '<ol><li style=\"text-align: justify;\">El indicador aplica solo para universidades nuevas; es decir, aquellas creadas con posterioridad al plazo establecido por la Ley de Moratoria de creación de universidades públicas y privadas por un periodo de cinco años, Ley N° 29971, y con ley de creación sin actividad académica y/o que no hayan organizado concursos de admisión.</li></ol>', 0, 1, NULL, '2025-02-14 13:35:06'),
(21, 12, 'MV1', 'Documento que sustente la correspondencia entre la  oferta educativa propuesta y las   políticas nacionales y regionales de educación universitaria.', '<ol><li style=\"text-align: justify;\">El indicador aplica solo para universidades nuevas; es decir, aquellas creadas con posterioridad al plazo establecido por la Ley de Moratoria de creación de universidades públicas y privadas por un periodo de cinco años, Ley N° 29971, y con ley de creación sin actividad académica y/o que no hayan organizado concursos de admisión.</li></ol>', 0, 1, NULL, '2025-02-14 13:35:11'),
(22, 13, 'MV1', 'Documento donde se indique las fuentes de financiamiento de la universidad.', '<ol><li style=\"text-align: justify;\">El indicador aplica solo para universidades nuevas; es decir, aquellas creadas con posterioridad al plazo establecido por la Ley de Moratoria de creación de universidades públicas y privadas por un periodo de cinco años, Ley N° 29971, y con ley de creación sin actividad académica y/o que no hayan organizado concursos de admisión.</li></ol>', 0, 1, NULL, '2025-02-14 13:35:20'),
(23, 14, 'MV1', 'Documento o estudios que justifiquen la creaciôn de los nuevos programas de estudios.', '<div style=\"text-align: justify; \"><b>1.</b> Programa nuevo es el programa que fue creado con posterioridad a la entrada en vigencia de la Ley N° 30220, Ley Universitaria.</div><div style=\"text-align: justify;\"><b>2.</b>&nbsp; El documento justifica de manera cuantitativa y cualitativa la creación de los nuevos programas de estudio, en el área de influencia de la sede y/o filial en la que funcionarán, considerando que:</div><div style=\"text-align: justify;\">- Se aplica sobre una población bien delimitada.</div><div style=\"text-align: justify;\">- Identifica la oferta de otras instituciones de educación superior a nivel local y regional.</div><div style=\"text-align: justify;\">- Identifica una problemática de alcance nacional o regional.</div><div style=\"text-align: justify;\">- Identifica a los actores estratégicos productivos, económicos, políticos etc., públicos o privados, que atiendan esa problemática.</div><div style=\"text-align: justify; \">- Identifica las demandas de esos actores respecto de un perfil de profesional determinado.</div><div style=\"text-align: justify;\">- Identifica las capacidades del programa académico de generar ese perfil de profesional (perfil de egreso).</div><div style=\"text-align: justify; \">- Demuestra la existencia actual o futura de recursos académicos (talleres y laboratorios de enseñanza equipados; material bibliográfico); humanos (docentes), materiales (servicios básicos y complementarios), por sede o filial en la que se brindará el servicio, para brindar el servicio educativo al momento de iniciar el funcionamiento efectivo del programa.</div><div style=\"text-align: justify;\">- Determina la ratio de postulantes/ vacantes proyectada para cada una de las carreras (demanda potencial).</div><div style=\"text-align: justify; \"><b>3.</b> El documento consigna la fecha de realización (no debe exceder los dos años previos a la presentación de la solicitud de licenciamiento); está firmado por el responsable de su elaboración y cuenta con la conformidad de la autoridad competente.</div>', 0, 1, NULL, '2025-02-11 19:33:26'),
(24, 15, 'MV1', 'Plan de financiamiento del nuevo programa de estudio a ofrecer.', '<div><b>1.</b> El indicador aplica para universidades con actividad académica (con autorización definitiva, autorización provisional y con ley de creación) que desean ampliar su oferta educativa con la creación de nuevos programas de estudio.</div><div><b>2.</b> Cada programa nuevo cuenta con un plan de financiamiento para los próximos 5 años (incluyendo el año de la presentación de la solicitud de licenciamiento).</div><div><br></div><div>Los planes de financiamiento incluyen como mínimo:</div><div>- Flujo de ingresos y egresos.</div><div>- Flujo de inversión (desagregar por proyecto o fuente).</div><div>- Flujo de financiamiento (desagregar par proyecto o fuente).</div><div>- Están expresados en moneda nacional.</div><div><b>3.</b> Los planes incluyen partidas para recursos humanos, acervo bibliográfico, investigación, equipamiento e infraestructura, entre otros, según corresponda.</div><div><b>4.</b> El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-02-11 19:38:40'),
(25, 16, 'MV1', 'Licencia de Funcionamiento  Municipal vigente y/o Certificado de Parámetros Urbanísticos. RESOLUCIÓN DEL CON5EłO DIRECTIVO N° 008-2017-5UNEDU/CD  Deja sin efecto el indicador.', NULL, 0, 1, NULL, '2025-02-17 17:29:24'),
(26, 17, 'MV1', 'Títulos de propiedad de todos sus locales debidamente registrados en la SUNARP;', '<div style=\"text-align: justify;\">El documento está inscrito en la Superintendencia Nacional de Registros Públicos (Sunarp).</div><div style=\"text-align: justify;\">1. La universidad presenta el título de propiedad de todos los locales donde se brinda el servicio educativo conducente a grado académico.</div><div style=\"text-align: justify; \">2.&nbsp; La fecha de expedición no supera los tres meses anteriores a la fecha de presentacion de la SLI.</div><div style=\"text-align: justify; \">3.&nbsp; El documento consigna el nombre, razón social o RUC de la universidad en consistencia con lo declarado en el formato A1.</div>', 0, 1, NULL, '2025-03-03 16:03:49'),
(27, 17, 'MV2', 'Contratos de alquiler debidamente registrados en la SUNARP de todos sus locales. Para universidades privadas, el contrato debe tener una duración no menor a 5 años para, programas de pregrado y no menor  a  la  duración  del programa  de  posgrado. Para universidades públicas, contratos no menores a 1 año. En caso el contrato de alquiler del programa de pregrado y posgrado tenga una duración menor a Io señalado, la universidad deberá acreditar contar con un proyecto inmobiliario en implementación.', '<ol><li style=\"text-align: justify; \">El o los contratos de alquiler de cada uno de los locales alquilados están inscritos en la Sunarp.</li><li style=\"text-align: justify; \">Para universidades privadas, la vigencia del contrato no será menor a 5 años a partir de la fecha de presentación de la SLI. Para posgrado, la vigencia del contrato corresponderá a lo que dure el programa.</li><li style=\"text-align: justify; \">Los contratos de universidades públicas tienen una duración no menor a un (1) año a partir de la fecha de presentación de la SLI.</li><li style=\"text-align: justify; \">Las universidades públicas o privadas cuyo contrato de alquiler del local para programas de pregrado y posgrado, tenga una duración menor a la señalado en los párrafos anteriores, acreditan que cuentan con un proyecto inmobiliario o en implementación.</li><li style=\"text-align: justify; \">La fecha de expedición del documento no supera los tres (3) meses anteriores a la fecha de presentación de la SLI.</li></ol>', 0, 1, NULL, '2025-03-03 16:04:13'),
(28, 17, 'MV3', 'Titulos a documentos que expresen el derecho real que ejerce sobre todos sus locales; o', '<ol><li style=\"text-align: justify; \">En caso la universidad sea posesionaria presentará el certificado de posesión emitido por la Municipalidad correspondiente o un Juez de Paz.</li><li style=\"text-align: justify; \">En caso que la universidad se encuentre en proceso de prescripción adquisitiva de dominio, presentará la documentación correspondiente.</li><li style=\"text-align: justify; \">El documento especifica el nombre, razón social a RUC de la universidad.</li></ol>', 0, 1, NULL, '2025-03-03 16:04:22'),
(29, 17, 'MV4', 'Contrato, convenio u otro documento petinente en caso de cesión en uso exclusivo.', '<ol><li>El documento consigna la firma de ambas partes y está vigente.</li><li>El documento especifica el nombre, razón social o RUC de la universidad.</li><li>El documento establece un plazo no menor a la duración de los programas que se dictan en el local.</li></ol>', 0, 1, NULL, '2025-03-03 16:04:30'),
(30, 18, 'MV1', 'Certificado  vigente  de Inspección Técnica de Seguridad en Edificaciones que corresponda (ITSE Básica, Ex Post, Ex Ante o de Detalle) emitido  por  la  autoridad competente. De acuerdo a D.S. N° 085-2014-PCM Reglamento de Inspecciones Técnicas de Seguridad en Edificaciones.', NULL, 0, 1, NULL, '2025-04-14 13:49:34'),
(31, 19, 'MV1', 'Planes de  seguridad incluyendo almacenamiento y gestión  de  sustancias inflamables y/o peligrosas.', '<div>1. El documento está aprobado por la autoridad competente o por el Comité de Seguridad y Salud en el Trabajo.</div><div>2. El documento tiene alcance institucional, es decir, incluye a todos los locales donde se brinda el servicio educativo conducente a grado académica.</div><div><br></div><div><b>El Plan de seguridad de laboratorios y talleres, contiene la siguiente:&nbsp;</b></div><div>3. Gestión para el almacenamiento y disposición final de sustancias inflamables y/o peligrosas que generan los laboratorios y talleres.</div><div>4. Gestión para el almacenamiento y disposición final de los equipos electrónicos e informáticos desechados.</div>', 0, 1, NULL, '2025-03-03 16:05:05'),
(32, 19, 'MV2', 'Para el caso de generación de residuos peligrosos,  la universidad deberá presentar contratos vigentes de disposición de residuos sólidos y líquidos de los laboratorios y  talleres o un medio probatorio sucedáneo que cumpla con el misma fin.', '<div>Aplica cuando la universidad cuenta con laboratorios y talleres que manejen residuos sólidos y líquidos peligrosos.</div><ol><li style=\"text-align: justify; \">El contrato está vigente y evidencia que la totalidad de locales que tienen laboratorios y/o talleres que generen este tipo de residuos cuentan con este servicio.</li><li style=\"text-align: justify; \">El contrato consigna el nombre, razón social o RUC de la universidad, de acuerdo con lo declarado en el Formato de Licenciamiento A1.</li><li style=\"text-align: justify; \">El contrato señala la dirección del local o locales donde se realizará el recojo de los residuos peligrosos. Esta información es consistente con la información sobre laboratorios y talleres declarados en los Formatos de Licenciamiento C6.</li><li style=\"text-align: justify; \">La empresa con la cual se celebra el contrato de disposición de residuos peligrosos (sólidos y Líquidos) está inscrita en el Registro de empresas prestadoras de servicios de residuos sólidos de la Dirección General de Salud Ambiental e Inocuidad Alimentaria (Digesa), de acuerdo con lo establecido en la Ley N° 27314, Ley General de Residuos Sólidos.</li><li style=\"text-align: justify; \">En caso que en la provincia donde se encuentra el local conducente a grado académico no existiera una empresa prestadora de servicios de residuos sólidos registrada en la Digesa, la universidad presentará un documento sucedáneo como un convenio a contrato con otra institución autorizada.</li></ol>', 0, 1, NULL, '2025-03-03 16:05:25'),
(33, 19, 'MV3', 'Documento que demuestre la existencia de comités de seguridad biológica, química y radiológica, según corresponda, especificando la relación del personal calificado que lo conforma, suscrito por la autoridad competente de la universidad.', '<ol><li style=\"text-align: justify;\">Este documento especifica la relación del personal calificado que lo conforma, y está suscrito por la autoridad competente de la universidad. Cabe precisar que el reglamento interno de seguridad y salud en el trabajo bajo ninguna circunstancia reemplaza este medio de verificación.</li><li style=\"text-align: justify;\">Si la universidad declara laboratorios o talleres de las especialidades relacionadas a química, biología o radiología, entre otros, presentará el documento que acredite la existencia de comités de seguridad biológica, química y radiológica.</li><li style=\"text-align: justify;\">Los comités de seguridad biológica, química y radiológica están conformados por <u>personal calificado de la universidad </u>(indicar especialidad y grado académico), cuyo presidente será nombrado sobre la base de sus concernientes en bioseguridad.</li><li style=\"text-align: justify;\">Los comités de seguridad biológica, química y radiológica, según corresponda, están relacionados con los programas académicos conducentes a grado académico cuya actividad implique algún riesgo para la seguridad de los estudiantes y docentes (programas de ciencias de la salud e ingeniería, entre otros).</li><li style=\"text-align: justify;\">El documento está aprobado por la autoridad competente de la universidad.</li></ol>', 0, 1, NULL, '2025-03-03 16:05:35'),
(34, 20, 'MV1', 'Protocolos de seguridad para laboratorios y talleres.', '<ol><li style=\"text-align: justify; \">Los protocolos de seguridad para el funcionamiento de los laboratorios están suscritos por el <u>Comité de seguridad de laboratorios y talleres</u> o por la autoridad competente.</li><li style=\"text-align: justify;\">La universidad presenta protocolos que cuenten con estándares de seguridad para todos los laboratorios y talleres declarados en los formatos de licenciamiento C6.</li><li style=\"text-align: justify;\">Los protocolos pueden agruparse por programas o por especialidad (tipo de laboratorio y Taller).</li><li style=\"text-align: justify;\">Los protocolos contienen como mínimo: el proceso de identificación de riesgos; procedimientos de trabajo seguro; procedimientos en caso de accidentes; seguridad en el manejo de productos químicos, biológicos o radiológicos, según corresponda; signos y etiquetas; señales de seguridad y equipos de protección personal.</li></ol>', 0, 1, NULL, '2025-03-03 16:05:49'),
(35, 21, 'MV1', 'Último recibo de pago.', '<div>1. La universidad presenta el recibo del mes anterior a la visita de verificación</div><div>2. El recibo corresponde solo a los locales donde se brinda el servicio educativo conducente a grado académico.</div><div>3. El recibo evidencia el nivel del consumo.</div><div>4. El recibo es emitido por la empresa prestadora del servicio.</div><div>5. El recibo contiene nombre, razón social o RUC de la universidad conforme a lo declarado en el Formato de Licenciamiento A1.</div><div>6. El recibo consigna la dirección del local de acuerdo con lo declarado en el Formato de Licenciamiento A2.</div><div>En caso el local sea alquilado, el recibo puede estar a nombre del propietario del local, en concordancia con el contrato de alquiler.</div>', 0, 1, NULL, '2025-03-03 16:06:06'),
(36, 21, 'MV2', 'Para el caso de locales ubicados en zonas rurales, podrá demostrar la disponibilidad del servicio con una opción alternativa.', '<ol><li style=\"text-align: justify;\">Aplica solo para el caso de locales ubicados en zonas rurales.</li><li style=\"text-align: justify;\">Si el local donde ser brinda el servicio educativo conducente a grado académico se ubica en una zona rural o donde no se disponga del servicio de agua ni desagüe, la universidad presenta un documento técnico que demuestre la disponibilidad del servicio mediante una opción técnica alternativa, de acuerdo con la normativa vigente.</li><li style=\"text-align: justify;\">El documento garantiza que el agua obtenida es apta para el consumo humano.</li><li style=\"text-align: justify;\">El documento es elaborado y firmado por un ingeniero (sanitario a fin), colegiado y habilitado.</li></ol>', 0, 1, NULL, '2025-03-03 16:06:22'),
(37, 21, 'MV3', 'En el caso de las universidades nuevas o con ley de creación que no cuenten con alumnos pueden presentar un proyecto de implementación del servicio.', '<ol><li style=\"text-align: justify; \">Aplica solo para el caso de universidades nuevas o con ley de creación que no cuentan con estudiantes (sin actividad académica y/o que no hayan organizado concursos de admisión).</li></ol>', 0, 1, NULL, '2025-02-14 13:31:36'),
(38, 22, 'MV1', 'Último recibo de pago.', '<div>Presentar el recibo del mes anterior a la visita presencial.</div><div>1. El recibo corresponde solo a los locales donde ser brinda el servicio educativo conducente a grado académico.</div><div>2. El recibo evidencia el nivel del consumo.</div><div>3. El recibo es emitido por la empresa prestadora del servicio.</div><div>4. El recibo contiene nombre, razón social o RUC de la universidad conforme a lo declarado en el Formato de Licenciamiento A1.</div><div>5. El recibo consigna la dirección del local de acuerdo con lo declarado en el Formato de Licenciamiento A2.</div><div>En caso el local sea alquilado, el recibo puede estar a nombre del propietario del local, según el contrato de alquiler.&nbsp;&nbsp;</div>', 0, 1, NULL, '2025-03-03 16:06:44'),
(39, 22, 'MV2', 'Para el caso de locales ubicados en zonas rurales, podrá demostrar la disponibilidad del servicio con una opción alternativa.', '<ol><li style=\"text-align: justify; \">Aplica solo para el caso de locales ubicados en zonas rurales.</li><li style=\"text-align: justify;\">Si el local donde ser brinda el servicio educativo conducente a grado académico se ubica en una zona rural o donde no se disponga del servicio de energía eléctrica, la universidad presenta un documento técnico que demuestre la disponibilidad del servicio mediante una opción técnica alternativa, de acuerdo con la normativa vigente.</li><li style=\"text-align: justify;\">El documento es elaborado y firmado por un ingeniero (electricista, mecánico electricista o afín), colegiado y habilitado.</li></ol>', 0, 1, NULL, '2025-03-03 16:07:00'),
(40, 22, 'MV3', 'En el caso de las universidades nuevas o con ley de creación que no cuenten con alumnos pueden presentar un proyecto de implementación del servicio.', '<ol><li style=\"text-align: justify;\">Aplica solo para el caso de universidades nuevas o con ley de creación que no cuentan con estudiantes (sin actividad académica y/o que no hayan organizado concursos de admisión).</li></ol>', 0, 1, NULL, '2025-02-14 13:36:31'),
(41, 23, 'MV1', 'Último recibo de pago.', '<div>1. La&nbsp; universidad&nbsp; presenta&nbsp; el o los&nbsp; recibos&nbsp; de&nbsp; las líneas&nbsp; telefónicas</div><div>pertenecientes a los locales declarados en el Formato de Licenciamiento A2, donde se brinda el servicio educativo conducente a grado académico.</div><div>2. Los recibos corresponden al mes anterior a la visita de verificación presencial.</div><div>3. Los recibos son emitidos por la empresa prestadora del servicio.</div><div>4. El recibo consigna el nombre, razón social o RUC de la universidad, conforme a lo declarado en el Formato de Licenciamiento A1.</div><div>5. El recibo consigna la dirección del local donde se brinda el servicio educativo conducente a grado académico, de acuerdo con lo declarado en el Formato de Licenciamiento A2.</div><div>6. El recibo evidencia el nivel del consumo.</div>', 0, 1, NULL, '2025-03-03 16:07:24'),
(42, 23, 'MV2', 'Para el caso de locales ubicados en zonas rurales, podrá demostrar la disponibilidad del servicio con una opción alternativa.', '<ol><li style=\"text-align: justify;\">Aplica solo para el caso de locales ubicados en zonas rurales.</li><li style=\"text-align: justify;\">Si el local donde se brinda el servicio educativo conducente a grado académico se ubica en una zona rural o donde no se disponga del servicio de líneas telefónicas, la universidad presenta un documento técnico que demuestre la disponibilidad del servicio mediante una opción técnica alternativa, de acuerdo con la normativa vigente.</li><li style=\"text-align: justify;\">El documento es elaborado y firmado por un ingeniero (de telecomunicaciones, electrónico o afines), colegiado y habilitado.</li></ol>', 0, 1, NULL, '2025-02-12 16:15:52'),
(43, 23, 'MV3', 'En el caso de las universidades nuevas o con ley de creación que no cuenten con alumnos pueden presentar un proyecto de implementación del servicio.', '<ol><li style=\"text-align: justify;\">Aplica solo para el caso de universidades nuevas o con ley de creación que no cuentan con estudiantes (sin actividad académica y/o que no hayan organizado concursos de admisión).</li></ol>', 0, 1, NULL, '2025-02-14 13:37:01'),
(44, 24, 'MV1', 'Formato de Sunedu que contiene el listado de ambientes con conexión a internet.', '<ol><li style=\"text-align: justify; \">La universidad presenta el Formato de Licenciamiento C3 completo y firmado por el representante legal.</li><li style=\"text-align: justify;\">El formato de licenciamiento C3 registra el número total de ambientes (biblioteca, laboratorios de cómputo, aulas, laboratorios y talleres), y&nbsp; evidencia que la totalidad de estos ambientes cuenta con acceso a internet.</li><li style=\"text-align: justify;\">La información declarada en el Formato de Licenciamiento C3 es consistente con la declarado en los formatos de licenciamiento A2, C6 y C8.</li><li style=\"text-align: justify;\">En caso de contratar un servicio de internet centralizado, del cual se deriva el servicio a otros locales conducentes a grado académico, la universidad especifica en la columna \"comentarios\" del formato de licenciamiento C3, la disponibilidad real del servicio de internet que le corresponde a cada local.</li></ol>', 0, 1, NULL, '2025-02-11 14:53:25'),
(45, 24, 'MV2', 'El último recibo de pago del  servicio  para  locales ubicados en zonas rurales o un medio probatorio sucedáneo que demuestre que cuenta con el servicio.', '<div>Aplica solo para el caso de locales ubicados en zonas rurales.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div style=\"text-align: justify; \">1. Si el local donde ser brinda el <u>servicio educativo conducente a grado académico se ubica en una zona rural </u>o donde no se disponga del servicio de internet, la universidad presenta un documento técnico que demuestre la disponibilidad del servicio mediante una opción técnica alternativa, de acuerdo con la normativa vigente.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div style=\"text-align: justify; \">2. El&nbsp; documento&nbsp; es&nbsp; elaborado&nbsp; y&nbsp; firmado&nbsp; por&nbsp; un&nbsp; ingeniero&nbsp; (de telecomunicaciones, electrónico o afines), colegiado y habilitado</div>', 0, 1, NULL, '2025-02-21 16:05:13'),
(46, 24, 'MV3', 'En el caso de las universidades nuevas o con ley de creación que no cuenten con alumnos pueden presentar un proyecto de implementación del servicio.', NULL, 0, 1, NULL, NULL),
(47, 25, 'MV1', 'Formato SUNEDU, donde se incorpore el requerimiento de la dotación de servicios higiénicos por local, de acuerdo a la norma técnica A.040 y A.080 del RNE. RESOLUCIÓN DEL CON5EłO DIRECTIVO N° 008-2017-5UNEDU/CD  Deja sin efecto el indicador.', NULL, 0, 1, NULL, NULL),
(48, 26, 'MV1', 'El evaluador verificara en campo lo señalado. RESOLUCIÖN DEL CONSEJO DIRECTIVO N° 008-2017-SUNEDU/CD Deja sin efecto el indicador.', NULL, 0, 1, NULL, NULL),
(49, 27, 'MV1', 'Formato Sunedu.', '<div>1.&nbsp; La universidad señala en este formato los laboratorios y talleres de enseñanza para cada local donde se brinda el servicio educativo conducente a grado académico. Este formato está firmado por el representante legal.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>2. Las universidades con programas de estudio de las familias de ingeniería, ciencias de la salud, comunicaciones, arquitectura, entre otros, cuentan, en cada una de las sede o filiales donde se dictan estos programas, con talleres a laboratorios adecuados para el ejercicio de enseñanza-aprendizaje, actividades que involucran investigación, entre otros relacionados con los fines y objetivos de la universidad.</div><div>3. El formato C6 se encuentra en concordancia con lo declarado en los formatos de licenciamiento A2 y C7.</div><div>4. La suma de los aforos de los laboratorios y/o talleres de enseñanza declarados por cada local en el formato de licenciamiento C6, es menor al aforo del local respectivo declarado en el Formato de Licenciamiento A2.</div>', 0, 1, NULL, '2025-03-05 20:07:44'),
(50, 27, 'MV2', 'Un estudio técnico de cálculo de aforo por local, elaborado y suscrito por un consultor ingeniero o arquitecto colegiado independiente.', '<div>1. El estudio comprende a todos los locales donde se brinda el servicio educativo conducente a grado académico que no cuenten con Certificado de inspección Técnica de Seguridad en Edificaciones (ITSE).&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2. El estudio técnico de cálculo es elaborado y suscrito por un ingeniero o arquitecto colegiado independiente.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>3. El estudio técnico contiene el aforo de la totalidad de los ambientes de la universidad y su cálculo debe considerar la normativa vigente.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>4. La información de aforos está constituida por el listado ordenado de ambientes por local, con su respectiva área y el aforo correspondiente por ambiente cuya sumatoria dará el aforo total del local.</div><div>&nbsp;5. La información declarada de ambientes (aulas, laboratorios, talleres, bibliotecas y ambientes para docentes) debe ser consistente con el Formato de Licenciamiento A2, C3, C6 y C8.</div>', 0, 1, NULL, '2025-03-03 16:08:24'),
(51, 27, 'MV3', 'Certificado vigente de inspección Técnica de Seguridad en Edificaciones que corresponda (ITSE básico, ex post, ex ante o de detalle), según la  normatividad  vigente. El evaluador verificará en campo el equipamiento para sus laboratorios, según programas académicos.', '<div>1. La universidad presenta el Certificado de ITSE de sus locales que no cuenten con estudio técnico de cálculo de aforo.</div><div>2. El documento especifica el nombre, razón social o RUC de la universidad.</div><div>3. El giro o actividad consignado en el Certificado de ITSE debe ser: educación, educación superior universitaria, educación superior posgrado o universidad.</div><div>4. La información de aforos y direcciones se encuentra en concordancia con lo declarado en el Formato de Licenciamiento A3.</div><div>5. El documento es emitido por la autoridad competente.</div>', 0, 1, NULL, '2025-03-06 21:55:43'),
(52, 28, 'MV1', 'Formato  SUNEDU. El evaluador verificará en campo el equipamiento de sus laboratorios según sus programas académicos.', '<ol><li style=\"text-align: justify;\">La universidad señala en este formato el equipamiento que posee en los laboratorios y talleres declarados en los formatos de licenciamiento C6 y A3.</li><li style=\"text-align: justify;\">El equipamiento de los talleres y laboratorios es pertinente para los fines de la formación en los programas de estudio ofrecidos por la universidad, cuando corresponda.</li><li style=\"text-align: justify;\">Las universidades con programas de estudios de las familias de ingeniería, ciencias de la salud, entre otros, tienen la obligación de contar con laboratorios y talleres de enseñanza debidamente equipados en cada una de sus filiales.</li></ol>', 0, 1, NULL, '2025-03-03 16:08:51'),
(53, 29, 'MV1', 'Formato SUNEDU donde se registrará la informacion de la ubicación de los ambientes para docentes en el local de la universidad.', '<div style=\"text-align: justify; \">1. La universidad presenta el formato de licenciamiento C8 completo y firmado por el representante legal.</div><div style=\"text-align: justify; \">En este, la universidad indica el número de ambientes, su aforo, su mobiliario básico, para cada uno de los locales donde se brinda el servicio educativo conducente a grado académico declarado en el formato de licenciamiento A2.</div><div style=\"text-align: justify; \">2. Los ambientes tienen mobiliario para la preparación de clases, elaboración de documentos y coordinación con otros docentes.&nbsp; &nbsp;</div><div style=\"text-align: justify; \">3. En concordancia con el formato de licenciamiento C3, los ambientes cuentan con acceso a internet y con instalaciones eléctricas para la conexión de diversos equipos informáticos.</div><div style=\"text-align: justify; \">4. El aforo total de los ambientes para docentes es suficiente para albergar a los docentes declarados en el formato de licenciamiento C9.&nbsp;</div>', 0, 1, NULL, '2025-03-03 16:09:26'),
(54, 30, 'MV1', 'Presupuesto de mantenimiento aprobado por la autoridad competente de la universidad (indicando la última fecha de actualización).', '<ol><li style=\"text-align: justify; \">El presupuesto es a nivel institucional e incluye a todos los locales donde se brinda el servicio educativo conducente a grado académico declarados en el Formato de Licenciamiento A2.</li><li style=\"text-align: justify; \">Para universidades públicas el presupuesto de mantenimiento de infraestructura y equipamiento es consistente con la disponibilidad presupuestal del Presupuesto inicial de apertura (PIA) correspondiente a la presentación de la solicitud de licenciamiento.</li><li style=\"text-align: justify; \">El presupuesto contiene las partidas para el mantenimiento de la edificación del local como, por ejemplo: acabados, estructuras metálicas, instalaciones sanitarias. eléctricas, seguridad, sistemas contra incendio, entre otros, según corresponda; así como el mantenimiento del equipamiento (bombas, equipamiento de laboratorios y talleres, entre otros) y mobiliario (muebles fijos, carpetas, escritorios, otros).</li><li style=\"text-align: justify; \">El presupuesto está aprobado mediante resolución u otro documento equivalente, por la autoridad competente.</li><li style=\"text-align: justify; \">El presupuesto indica el año que corresponde y la moneda nacional.</li></ol>', 0, 1, NULL, '2025-03-03 16:09:44'),
(55, 30, 'MV2', 'Plan de mantenimiento aprobado por la autoridad competente de la universidad (indicando la última fecha de actualización).', '<div>• El plan está vigente.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>• El plan de mantenimiento de la infraestructura y equipamiento indica las acciones a ejecutar para cada uno de los locales donde se brinda el servicio educativo conducente a grado académico, declarados en el Formato de Licenciamiento A2.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>• Se encuentra en concordancia con las actividades y/o cronograma anual del Plan de mantenimiento declarado como MV2.</div><div>• El plan contiene como mínimo objetivos, actividades y cronograma de actividades. Las actividades para el mantenimiento de la edificación del local pueden ser: acabados, estructuras metálicas, instalaciones sanitarias, eléctricas, seguridad, sistemas contra incendio, entre otros, según corresponda; así corno el mantenimiento del equipamiento (bombas, equipamiento de laboratorios y talleres, entre otros) y mobiliario (muebles fijos, carpetas, escritorios, otros).</div><div>• El plan indica los periodos en los cuales se realizará el mantenimiento de la infraestructura y equipamiento (incluyendo equipos de laboratorio y talleres). El plan es consistente con los rubros presentados en el presupuesto de mantenimiento de infraestructura y equipamiento declarado como MV1.</div><div>• El plan es aprobado por la autoridad competente e indica su última fecha de</div><div>actualización.</div>', 0, 1, NULL, '2025-03-03 16:09:54'),
(56, 31, 'MV1', 'Estatuto o Plan Estratégico Institucional u otro documento pertinente aprobado por la autoridad competente de la universidad.', '<div>1. El Estatuto, Plan Estratégico Institucional (PEI) u otro documento pertinente está aprobado por la autoridad competente.</div><div>2. El documento, distinto al Estatuto o PEI, puede ser una política de investigación, reglamento de investigación, entre otros.</div><div>3. El o los documentos cuentan con mecanismos de gestión, adjudicación y monitoreo de fondos de investigación y con mecanismos de gestión y monitoreo de trabajos de investigación.</div><div>4. El o los documentos presentan lo siguiente:</div><div>Políticas, normas y procedimientos para el fomento de la investigación.</div><div>Políticas, normas y procedimientos para la realización de la investigación.</div>', 0, 1, NULL, '2025-03-03 16:10:10');
INSERT INTO `lic_mv` (`id`, `id_indicador`, `sigla_mv`, `nom_mv`, `consids`, `id_responsable`, `aplica`, `created_at`, `updated_at`) VALUES
(57, 32, 'MV1', 'Estatuto u otro documento pertinente aprobado por la autoridad competente de la universidad.', '<div>El documento es de alcance institucional.</div><div>1. El órgano tiene competencias sobre los departamentos, direcciones académicas, centros o institutos u otros espacios de investigación. En caso de las Universidades Públicas, este órgano es el Vicerrectorado de Investigación con las funciones establecidas en la Ley universitaria.</div><div>2. El documento es aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-03-03 16:10:22'),
(58, 32, 'MV2', 'Relación del personal del órgano de investigación.', '<div>Incluye el nombre del responsable, grado y cargo.</div><div>1. El personal tiene las competencias adecuadas al puesto (por grado, experiencia y/o competencias profesionales).</div><div>2.&nbsp; El encargado tiene grado de doctor y su título está registrado en el registro nacional de Grados y Títulos de la SUNEDU.</div>', 0, 1, NULL, '2025-03-03 16:10:30'),
(59, 33, 'MV1', 'Resolución rectoral que apruebe las líneas de investigación u otro documento pertinente  aprobado  por  la autoridad competente de la universidad.', '<div>1. El documento consigna las líneas de investigación.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>2. Las líneas de investigación guardan correspondencia y están vinculadas a los programas de estudio declarados en los formatos de licenciamiento A4 y A8. Asimismo, guardan correspondencia con los recursos humanos y físicos disponibles en la universidad (laboratorios y talleres, presupuesto, personal docente, entre otros).</div><div>3. El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-03-03 16:10:47'),
(60, 33, 'MV2', 'Presupuesto asignado para la investigacion, equipamiento, personal y otros.', '<div style=\"text-align: justify; \"><div>El documento precisa como mínimo los rubros de los montos asignados para personal administrativo, investigadores, infraestructura, equipamiento, publicaciones para los proyectos de investigación pregrado y posgrado, entre otros. </div><div>El presupuesto:</div><div>1. Es anual y está vigente.</div><div>2. Detalla las fuentes de financiamiento, tanto propias como externas.</div><div>3. Está expresado en moneda nacional.</div><div>4. Cuenta con la aprobación de la autoridad competente.</div></div>', 0, 1, NULL, '2025-03-03 16:10:56'),
(61, 34, 'MV1', 'Código de ética para el investigador, con su resolución de aprobación correspondiente.', '<div>1. La universidad presenta el código de ética para la investigación, el cual contiene como mínimo políticas de resguardo de la integridad de las personas, animales, plantas o información involucrados en la investigación, según corresponda, Asimismo, incluye medidas para asegurar su observancia (conformación de comités de ética, reglamentos, etc.).</div><div>2. Documento&nbsp; está&nbsp; aprobado,&nbsp; mediante&nbsp; resolución,&nbsp; por&nbsp; la&nbsp; autoridad competente.</div>', 0, 1, NULL, '2025-03-03 16:11:13'),
(62, 35, 'MV1', 'Resolución u otro documento pertinente, donde se indique las políticas de protección de la propiedad intelectual, aprobado por la autoridad competente de la universidad.', '<ol><li style=\"text-align: justify; \">La política de protección de la propiedad intelectual está adecuada al marco legal vigente e incluye mecanismos de control y sanciones anti plagio, así como políticas , para el registro de derechos de autor, patentes y marcas de los proyectos de investigación de la Universidad.</li><li style=\"text-align: justify; \">Ellas pueden estar contenidas en documentos como el estatuto de la universidad, reglamento y/o plan institucional, entre otros.</li><li style=\"text-align: justify; \">El documento está aprobado por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-03-03 16:12:55'),
(63, 36, 'MV1', 'Padrón de docentes actualizado al periodo vigente según formato de Relación Docente - SUNEDU, señalando a los docentes que realizan investigación y a aquellos que están registrados en el DINA.', '<div>1. La universidad presenta el formato de licenciamiento C9, en el que consigna a todos los docentes que realizan investigación con sus datos completos.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>2. El documento señala a los docentes que realizan investigación y a aquellos que están registrados en el Directorio Nacional de Investigadores e Innovadores (DINA) del Consejo Nacional de Ciencia, Tecnología e Innovación Tecnológica (Concytec).&nbsp;&nbsp;</div><div>3. Se considera que un docente está debidamente registrado en el DINA, cuando consigne en este portal además de su hoja de vida, su experiencia laboral y/o docente - precisando laborar para la Universidad que lo declara -, así como sus publicaciones y proyectos de investigación actualizados (ficha llena).&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>4. Los docentes que realizan investigación son docentes que realizan o han realizado actividades orientadas a la investigación (investigaciones publicadas, proyectos de investigación en curso, etc.), las cuales están debidamente registradas en sus perfiles DINA.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>5. La universidad cuenta con docentes investigadores registrados en DINA en toda sede o filial en la que se brinda el servicio educativo.</div><div>6. El documento está firmado por el representante legal de la universidad.&nbsp; &nbsp;&nbsp;</div>', 0, 1, NULL, '2025-03-03 16:13:17'),
(64, 37, 'MV1', 'Repositorio institucional.', '<div>Aplica solo para universidades con actividad académica, con autorización provisional, definitiva o con ley de creación.</div><div>1. Documento que evidencie la existencia de un repositorio institucional digital en el que se encuentren informes de investigación como tesis, publicaciones científicas y artículos, entre otros.&nbsp; &nbsp;</div><div>2. El repositorio institucional es accesible a toda la comunidad universitaria en todos los locales donde se brinda el servicio educativo conducente a grado académico.&nbsp;</div><div>3. El repositorio es público y está actualizado al último año calendario.</div>', 0, 1, NULL, '2025-03-03 16:13:38'),
(65, 37, 'MV2', 'Repositorio Nacional Digital de Ciencia, Tecnología e Innovación denominado ALICIA (Acceso Libre a la Información Científica).', '<div>Solo aplica para las universidades con actividad académica (con autorización definitiva, autorización provisional o ley de creación).</div><div>1. La universidad presenta un documento que demuestre su registro en el Repositorio Nacional Digital de Ciencia, Tecnología e Innovación, denominado ALICIA (Acceso Libre a la Información Científica) emitido por el Concytec.</div><div>2. El documento consigna el nombre o razón social de la universidad.</div>', 0, 1, NULL, '2025-03-03 16:13:45'),
(66, 37, 'MV3', 'Plan de Implementación para las universidades nuevas.', NULL, 0, 1, NULL, NULL),
(67, 38, 'MV1', 'Registro de proyectos precisando el nombre del proyecto, sus objetivos generales y específicos, investigador principal, recursos humanos, cronograma, presupuesto y entidad que financia.', '<div>1. El registro de proyectos de investigación (incluye tesis y otros), contempla los proyectos que se encuentran en ejecución (no concluidos).</div><div>2. El registro de proyectos incluye:</div><div><div>a. Línea de investigación a la que pertenece.</div><div>b. Nombre del proyecto.</div><div>c. Objetivos generales y específicos.</div><div>d. Nombre del investigador principal.</div><div>e. Recursos humanos (equipo de investigación).</div><div>f. Sede o Filial en la que se lleva a cabo la investigación.</div><div>g. Cronograma (fecha de inicio y fin).</div><div>h. Presupuesto (soles). </div><div>i. Esta información es consistente con la declarada para el indicador 33.</div><div>j. Fuente del financiamiento.</div><div>k. Productos y difusión de resultados (revista indexada, simposios, cuadernos de trabajo, libros, etc.).</div><div>3. La universidad cuenta con proyecto (s) de investigación en curso en su sede y en todas sus filiales.</div><div>4. El registro de proyectos de investigación puede ser presentado de acuerdo al siguiente el esquema, en formato Excel:&nbsp;</div><div>5. Autorizado por el responsable de la elaboración o la autoridad competente (firmado y visado).</div></div>', 0, 1, NULL, '2025-07-30 02:16:56'),
(68, 39, 'MV1', 'Padrón de docentes actualizado al periodo vigente, según formato de Relación Docente - SUNEDU.', '<div>La universidad presenta el formato de licenciamiento C9 firmado por el representante legal de la universidad.</div><div>1. El formato de licenciamiento C9 contiene a toda la plana docente (nombrados y contratados, bajo cualquier modalidad), que tengan como mínimo una hora dedicada al dictado de clases en el período académico vigente o el inmediato anterior a la presentación de la SLI.</div><div>2. El formato es llenado de manera completa (sin dejar celdas en blanco).</div><div>3. Incluye a los docentes que realizan investigación. Estos deben estar debidamente registrados en DINA (considerar precisiones del indicador 36).</div><div>4. La información de los docentes está actualizada al periodo vigente o inmediato anterior a la presentación de la solicitud de licenciamiento institucional.</div><div>5. La universidad cuenta como mínimo con el 25 % de docentes a tiempo completo, dedicados al dictado de clases, desarrollo de investigación, asesorías académicas y/o actividades administrativas. El cálculo del 25 % se efectuará de la relación entre los docentes a tiempo completo y el toral de docentes declarados.</div><div>6. Un docente a tiempo completo es aquel que tiene una permanencia mínima de cuarenta (40) horas semanales en la universidad, con al menos una hora de dictado de clases en el horario fijado por la universidad, independientemente de su categoría docente.</div><div>7. La universidad garantiza la disponibilidad del docente a tiempo completo por lo menos durante un período académico completo (no serán considerados para el cómputo del 25% los docentes que se encuentren con licencia).</div><div>8. Los docentes a tiempo completo están distribuidos en la sede y filiales en las que se brinda el servicio educativo, según corresponda.</div><div>9. La universidad declara en el formato de licenciamiento C9 información consistente entre el régimen de dedicación del docente (tiempo completo, tiempo parcial y dedicación exclusiva) y las horas semanales fijadas por la universidad, así como la sede y/o filiales donde dicta cada uno de ellos. </div><div>10. Usar las columnas de “comentarios” del formato de licenciamiento C9 para las precisiones necesarias que la universidad considere.</div>', 0, 1, NULL, '2025-03-03 16:21:52'),
(69, 40, 'MV1', 'Padrón de docentes actualizado al periodo vigente, según formato de Relación Docente - SUNEDU.', '<div>1. La universidad presenta el formato de licenciamiento C9 firmado por el representante legal de la universidad.&nbsp; &nbsp;</div><div>2. El formato de licenciamiento C9 contiene a toda la plana docente (nombrados y contratados bajo cualquier modalidad), que tengan como mínimo una hora dedicada al dictado de clases en el periodo académico vigente o el inmediato anterior a la presentación de la SLI.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>3. El formato está llenado de manera completa (sin dejar celdas en blanco).&nbsp; &nbsp;</div><div>4. Los docentes declarados cumplen con los requisitos para la docencia que establece el artículo 82 de la Ley N\" 30220, Ley Universitaria.&nbsp;&nbsp;</div><div>5. Los docentes que se encontraban ejerciendo la docencia a la entrada en vigencia de esta ley, y que no tuvieran el grado académico requerido por la misma, están comprendidos dentro del periodo de adecuación de cinco años (este plazo se computa desde la publicación de la sentencia recaída en el expediente N° 0014-2015-PI/TC y otros del Tribunal Constitucional, publicada en el Diario Oficial El Peruano el 14 de noviembre de 2015). Después de este periodo todos estos docentes deben regularizar sus grados académicos</div>', 0, 1, NULL, '2025-03-03 16:22:06'),
(70, 41, 'MV1', 'Instrumento normativo reglamento u otro documento que contenga los procedimientos de selección, fechas de concursos de selección, evaluación  de desempeño  anual de los docentes.', '<div>1. El documento contiene:</div><div>- Procedimientos de selección.</div><div>- Fechas de los concursos de selección.</div><div>- La evaluación de desempeño anual de los docentes que incluya la calificación de los estudiantes por semestre académico.&nbsp; &nbsp; &nbsp;</div><div><br></div><div>2. El documento está aprobado por la autoridad competente mediante resolución u otro documento equivalente.</div>', 0, 1, NULL, '2025-03-03 16:22:20'),
(71, 42, 'MV1', 'Instrumento  normativo, reglamento y otro documento que contenga los procedimientos de capacitación anual de sus docentes aprobados por la autoridad competente de la universidad.', '<div>1. El documento contiene:</div><div>a. Criterios para el otorgamiento de la capacitación.</div><div>b. Existencia de procedimientos de capacitación anual de docentes.</div><div>2. El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-02-17 17:16:26'),
(72, 42, 'MV2', 'Plan de Capacitación Docente.', '<div>1. El documento contiene:</div><div>a. Diagnóstico de competencias docentes.</div><div>b. Cronograma de actividades.</div><div>c. Contenido de las capacitaciones.</div><div>d. Presupuesto.</div><div>2. Está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-02-17 17:16:32'),
(73, 43, 'MV1', 'Formato SUNEDU de ubicación del tópico, de encontrarse dentro de las instalaciones de la universidad, y ', '<div>Para todos los MV:</div><div>1. Existe un tópico en todos los locales donde se brinda el servicio educativo conducente a grado académico.</div><div>2. El tópico de salud es el espacio físico destinado a brindar primeros auxilios.</div><div>3. El tópico está bajo la responsabilidad de personal capacitado que mantendrá un registro de ocurrencias diarias.</div><div>4. El tópico es accesible desde cualquier punto del local universitario.</div><div>5. La universidad asegura la continuidad del servicio.</div><div>6.La universidad presenta el Formato de Licenciamiento C10, indicando la ubicación del(los) tópico(s) asignado(s) a cada local.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>7. El documento está firmado por el representante legal.</div>', 0, 1, NULL, '2025-02-13 21:37:04'),
(74, 43, 'MV2', 'Documento que acredite el presupuesto destinado a la prestación del servicio.', '<div>1. El presupuesto del servicio incluye a todos los locales donde se brinda el servicio conducente a grado y/o título de la universidad, declarado en el Formato de Licenciamiento A2.</div><div>2.&nbsp; El documento está vigente y aprobado por la autoridad competente e indica su fecha de actualización, así como el periodo o año al que corresponde.</div><div>3. Para universidades públicas el presupuesto de tópico de salud es consistente con la disponibilidad presupuestal del PIA correspondiente a la presentación de la SLI.</div><div>4. El presupuesto considera las partidas de personal e insumos, pudiendo incluir mobiliario, equipos, entre otros.&nbsp;</div><div>5. Se encuentra vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-02-13 21:37:16'),
(75, 43, 'MV3', 'En caso de servicio tercerizado, contrato o convenio para la prestaciön del servicio a través de terceros.', '<div>1. En caso corresponda, la universidad presenta el contrato o convenio vigente para el servicio de tópico en todos los locales conducentes a grado académico y/o título.</div><div>2. El contrato o convenio está suscrito entre la universidad y la entidad otorgante del servicio.</div><div>3. Los contratos o convenios contienen:&nbsp;</div><div>a. Descripción del servicio.</div><div>b. La sede y filiales donde se ofrecerá el servicio tercerizado. La razon social o RUC de la universidad.</div><div>c. Fecha de inicio y fin de la prestación del servicio.</div><div>d.Firma de los responsables Legales facultados de las partes involucradas.&nbsp;</div><div>e. La dirección donde se brinda el servicio.</div><div>4. El documento está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-02-13 21:36:57'),
(76, 44, 'MV1', 'Documento que acredite el presupuesto destinado a la prestación del servicio y/o', '<ol><li style=\"text-align: justify; \">El presupuesto del servicio incluye a la sede y filiales de la universidad declaradas en el Formato de Licenciamiento A2.</li><li style=\"text-align: justify; \">Para universidades públicas el presupuesto de servicio social debe ser consistente con la disponibilidad presupuestal del PIA correspondiente a la presentación de la SLI.</li><li style=\"text-align: justify; \">El <u>presupuesto puede contener</u>, por ejemplo: bienestar social, programas de voluntariado, comedor, alojamiento, transporte universitario, equipos, mobiliario, entre otros, según corresponda.</li><li style=\"text-align: justify; \">El presupuesto indica el año al que corresponde y se consigna en moneda nacional.</li><li style=\"text-align: justify; \">La universidad asegura la continuidad del servicio.</li><li style=\"text-align: justify; \">El presupuesto está aprobado por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-03-03 16:23:07'),
(77, 44, 'MV2', 'Contrato o convenio para la prestación del servicio a través de terceros.', '<div>1. En caso corresponda, la universidad presenta el contrato o convenio vigente para la prestación de los servicios sociales en la sede y filiales.</div><div>2. El contrato o convenio está suscrito entre la universidad y la entidad otorgante del servicio.&nbsp;</div><div>3. Los contratos o convenios contienen:</div><div>a. Descripción del servicio.</div><div>b. La sede y filiales.</div><div>c. La razón social y RUC de la universidad.</div><div>d. Fecha de inicio y fin de la prestación del servicio.</div><div>f. Firma de los responsables legales facultados de las partes involucradas.</div><div>g. La dirección donde se brinda el servicio para corroborar que se encuentre dentro de la provincia correspondiente.</div><div>4. Está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-03-03 16:23:17'),
(78, 45, 'MV1', 'Documento que acredite el presupuesto destinado a la prestación del servicio y/o', '<ol><li style=\"text-align: justify; \">El presupuesto del servicio incluye a la sede y filiales de la universidad declaradas en el Formato de Licenciamiento A2.</li><li style=\"text-align: justify;\">Para universidades públicas el presupuesto de servicio psicopedagógico es consistente con la disponibilidad presupuestal del PIA correspondiente a la presentación de la SLI.&nbsp;</li><li style=\"text-align: justify;\">El presupuesto contiene, por ejemplo: programas de tutoría, talleres psicológicos, apoyo al desarrollo profesional, atención psicológica y académica, informes de evaluación, exámenes psicológicos, equipos, mobiliario, entre otros.</li><li style=\"text-align: justify;\">El presupuesto está aprobado por la autoridad competente.</li><li style=\"text-align: justify;\">El presupuesto indica el año que corresponde y se consigna en moneda nacional.</li><li style=\"text-align: justify; \">La universidad asegura la continuidad del servicio.</li></ol>', 0, 1, NULL, '2025-02-13 21:45:09'),
(79, 45, 'MV2', 'Contrato o convenio para la prestación del servicio a través de terceros.', '<div>1.En caso corresponda, la universidad presenta el contrato a convenio vigente para la prestación de los servicios sociales en la sede y filiales.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>2. El contrato o convenio está suscrito entre la universidad y la entidad otorgante del servicio.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>3. Los contratos o convenios contienen:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>a. Descripción del servicio.</div><div>b. La sede y filiales.</div><div>c. La razón social y RUC de la universidad.</div><div>d.Fecha de inicio y fin de la prestación del servicio.</div><div>e.Firma de los responsables legates facultados de las partes involucradas.</div><div>f. La dirección donde se brinda el servicio para corroborar que se encuentre dentro de la provincia correspondiente.</div><div>4. Está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-02-13 21:46:08'),
(80, 46, 'MV1', 'Documento que acredite el presupuesto destinado a la prestación del servicio y/o', '<div>1. El presupuesto del servicio incluye a la sede y filiales de la universidad declaradas en el Formato de Licenciamiento A2.</div><div>2. Para universidades públicas el presupuesto de servicio deportivo es consistente con la disponibilidad presupuestal del PIA correspondiente a la presentación de la SLI.</div><div>3. El presupuesto considera las partidas de personal (por ejemplo, contratación de instructores de las disciplinas deportivas, contratación de árbitros para campeonatos, etc.) y otros recursos como: alquiler de espacios deportivos, compra de artículos deportivos, entre otros.</div><div>4. El presupuesto está aprobado por la autoridad competente.</div><div>5. El presupuesto indica el año que corresponde y se consigna en moneda nacional.</div><div>6. Se encuentra vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-02-13 21:48:43'),
(81, 46, 'MV2', 'Contrato o convenio para la prestaciön del servicio a través de terceros.', '<div>1. En caso corresponda, la universidad presenta el contrato o convenio vigente para la prestación de los servicios deportivos en la sede y filiales.</div><div>2. El contrato o convenio está suscrito entre la universidad y la entidad otorgante del servicio.</div><div>3. Los contratos o convenios contienen:</div><div>a. Descripción del servicio.</div><div>b. La sede y filiales.</div><div>c. La razon social y RUC de la universidad.</div><div>d. Fecha de inicio y fin de la prestación del servicio.</div><div>e. Firma de los responsables legales facultados de las partes involucradas.</div><div>f. La dirección donde se brinda el servicio para corroborar que se encuentre dentro de la provincia correspondiente.</div><div>4. Está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-02-13 21:55:01'),
(82, 46, 'MV3', 'Normatividad, Reglamento, y/o Estatuto donde se indique la existencia de al menos tres disciplinas deportivas, aprobado por la autoridad competente de la universidad.', '<div>1. La universidad debe presentar el reglamento, estatuto u otro documento normativo sobre el área a cargo del servicio deportivo de la universidad y donde se evidencie la existencia de <u>al menos tres disciplinas</u>, detallando la promoción de la práctica deportiva entre todos sus estudiantes (campeonatos, talleres, etc.). Además, debe incluir las normas para el correcto desenvolvimiento del estudiante en la práctica deportiva (horarios, sanciones, normas de conducta, entre otros).&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div><div>2. La universidad podrá entregar la normativa para la promoción del deporte de alta&nbsp; competencia: becas, bonos de alimentación, viáticos, entre otros, según corresponda.&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</div><div>3. El documento debe estar aprobado por la autoridad competente e indicar su última fecha de actualizar.</div>', 0, 1, NULL, '2025-02-13 21:55:30'),
(83, 47, 'MV1', 'Documento que acredite el presupuesto destinado a la prestación del servicio y/o', '<ol><li style=\"text-align: justify; \">La universidad presenta evidencia de la existencia de servicios culturales.</li><li style=\"text-align: justify; \">El servicio está disponible en la sede y filiales para todos los estudiantes.</li><li style=\"text-align: justify; \">La universidad asegura la continuidad del servicio, encontrándose disponible a la fecha de la SLI y a la visita de verificación presencial.</li></ol>', 0, 1, NULL, '2025-03-03 16:24:16'),
(84, 47, 'MV2', 'Contrato o convenio para la prestaciön del servicio a través de terceros.', '<div><b>1</b>. En caso corresponda, la universidad presenta el contrato o convenio vigente para la prestación de los servicios culturales en la sede y filiales.</div><div><b>2</b>. El contrato o convenio está suscrito entre la universidad y la entidad otorgante del servicio.</div><div><b>3</b>. Los contratos o convenios contienen:</div><div>a. Descripción del servicio.&nbsp;</div><div>b. La sede y filiales.</div><div>c. La razón social y RUC de la universidad.</div><div>d. Fecha de inicio y fin de la prestación del servicio.</div><div>e. Firma de los responsables legales facultados de las partes involucradas.</div><div>f. La dirección donde se brinda el servicio para corroborar que se encuentre dentro de la provincia correspondiente.</div><div><b>4</b>. Está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-03-03 16:24:24'),
(85, 48, 'MV1', 'Documento que acredite el presupuesto destinado a la prestación del servicio y/o', '<ol><li style=\"text-align: justify; \">El presupuesto del servicio incluye a todos los locales de la sede y filiales de la universidad declaradas en el Formato de Licenciamiento A2.</li><li style=\"text-align: justify;\">Para universidades públicas el presupuesto de servicio de seguridad y vigilancia es consistente con la disponibilidad presupuestal del PIA correspondiente a la presentación de la SLI.</li><li style=\"text-align: justify;\">El presupuesto está aprobado por la autoridad competente.</li><li style=\"text-align: justify;\">El presupuesto indica el año que corresponde y se consigna en moneda nacional.</li></ol>', 0, 1, NULL, '2025-03-13 13:50:00'),
(86, 48, 'MV2', 'Contrato o convenio para la prestaciön del servicio a través de terceros.', '<div>1. En caso la universidad cuente con algún servicio de seguridad y vigilancia tercerizado, presenta el contrato o convenio correspondiente.</div><div>• Los contratos o convenios contienen:</div><div>- Descripción del servicio.</div><div>- La sede y filiales.</div><div>- La razón social y RUC de la universidad.</div><div>- Fecha de inicio y fin de la prestación del servicio.</div><div>- Firma de los responsables legales facultados de las partes involucradas.</div><div>2. La dirección donde se brinda el servicio para corroborar que se encuentre dentro de la provincia correspondiente.</div><div>Está vigente a la presentación de la SLI y a la visita de verificación presencial.</div>', 0, 1, NULL, '2025-03-13 13:49:51'),
(87, 49, 'MV1', 'Documento que contenga las políticas, planes y acciones de adecuación al entorno y protección del ambiente.', '<ol><li style=\"text-align: justify;\">El documento contiene las políticas, planes y acciones de adecuación al entorno y protección del ambiente.</li><li style=\"text-align: justify;\">La política, planes y acciones se enmarcan dentro de la Política Nacional de Educación Ambiental y la normatividad vigente sobre la materia.</li><li style=\"text-align: justify;\">La política, planes y acciones de protección al medio ambiente son de carácter institucional e involucran la participación de autoridades, docentes y estudiantes.</li><li style=\"text-align: justify;\">El documento está aprobado por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-03-03 16:26:45'),
(88, 50, 'MV1', 'Acervo bibliográfico físico: Lista codificada del material bibliográfico de las universidades, indicando el año de publicación, filial y programa de estudio relacionado; y/o', '<div><b>1.</b> La universidad presenta la lista codificada del material bibliográfico, en el que se indique:</div><div>a. Código de Sede/filial/Local.</div><div>b. Programas de estudios relacionados.</div><div>c. Año de publicación.</div><div>d. Titulo.</div><div>e. Autor(es).</div><div>f. Número de ejemplares.</div><div><b>2.</b> Está disponible para todos los estudiantes en todos los locales donde se brinda el servicio educativo conducente a grado académico y/o título, de acuerdo con los programas que se dicten.</div><div><b>3.</b> El registro bibliográfico es presentado de acuerdo al siguiente el esquema, en formato Excel:&nbsp;&nbsp;</div><div><b>4</b>. El registro es del último periodo académico.</div><div><b>5</b>. El documento está aprobado y/o suscrito por la autoridad competente.</div>', 0, 1, NULL, '2025-07-30 02:15:36'),
(89, 50, 'MV2', 'Acervo bibliográfico virtual: Contratos o convenios de uso del servicio de bibliotecas virtuales, por lo menos equivalentes a la que proporciona CONCYTEC.', '<ol><li style=\"text-align: justify; \">La universidad presenta contratos o convenios de uso del servicio de bibliotecas virtuales.</li><li style=\"text-align: justify;\">El acervo bibliográfico virtual está a disposición de todos los estudiantes, de acuerdo con los programas que se dicten, en todos los locales donde se brinda el servicio educativo conducente a grado académico y/o título.</li><li style=\"text-align: justify;\">Los contratos y convenios precisan la razón social y RUC de la universidad.</li><li style=\"text-align: justify;\">Los documentos están firmados por los responsables legales facultados de las partes involucradas.</li></ol>', 0, 1, NULL, '2025-02-14 14:50:42'),
(90, 51, 'MV1', 'Documento de aprobación de la creación del área, dirección o departamento emitido por la autoridad competente de la universidad; y', '<ol><li>El documento demuestra que la universidad cuenta con un área física, no necesariamente exclusiva, que gestiona el seguimiento del egresado.</li></ol><div>El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-04-24 20:40:45'),
(91, 51, 'MV2', 'ROF, MOF u otro documento aprobado por la autoridad competente de la universidad, donde se especifique las funciones del área, dirección  o departamento encargado del seguimiento del graduado; y', '<ol><li>El documento cuenta con la descripción de las funciones del área.</li><li>El documento está aprobado por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-04-24 20:41:05'),
(92, 51, 'MV3', 'Plan de seguimiento  al graduado aprobado por la autoridad competente de la universidad; y', '<p><b>1.</b> El Plan de seguimiento al graduado incluye como mínimo:</p><div>a. Objetivos</div><div>b. Actividades</div><div>c. Herramientas para recolección de datos&nbsp;</div><div>d. Presupuesto</div><div>e. Cronograma</div><div><br></div><div><b>2.</b> El documento está aprobado por la autoridad competente.</div>', 0, 1, NULL, '2025-03-03 16:27:39'),
(93, 51, 'MV4', 'Registro de graduados por semestre y programas de estudios , de los dos últimos años.', '<div>El Registro de graduados considera información de los dos últimos años previos a la presentación de la SLI.</div><ol><li>La información está desgregada por semestre y por programa.</li><li>El documento está aprobado y/o suscrito por la autoridad competente.</li><li>El Registro puede ser presentado de acuerdo al siguiente el esquema, en formato Excel:&nbsp;</li></ol>', 0, 1, NULL, '2025-02-14 21:31:01'),
(94, 52, 'MV1', 'Plataforma virtual de la bolsa de trabajo en portal web oficial (dominio propio de la universidad) disponible para los estudiantes y graduados', '<ol><li>La universidad cuenta con un documento (manual de usuario, capturas de pantalla u otros) que evidencie la existencia de una plataforma virtual destinada a la bolsa de trabajo institucional.</li><li>La plataforma virtual es accesible y contiene información actualizada para el estudiante y egresado.</li></ol>', 0, 1, NULL, '2025-03-03 16:28:10'),
(95, 52, 'MV2', 'Registro de actividades orientadas a la mejora de la inserción Iaboral tales como: cursos, talleres, seminarios, programas, entre otros.', '<ol><li>El registro cuenta actividades orientadas a la mejora de la inserción laboral, tales como cursos, talleres, seminarios, programas, entre otros.</li><li>El registro corresponde al periodo académico anterior.&nbsp;</li></ol>', 0, 1, NULL, '2025-03-03 16:28:19'),
(96, 53, 'MV1', 'Registro de convenios.', '<ol><li style=\"text-align: justify; \">Solo aplica para universidades con actividad académica (con autorización definitiva, autorización provisional o ley de creación con alumnos).</li><li style=\"text-align: justify; \">El Registro puede ser presentado de acuerdo al siguiente el esquema, en formato Excel:&nbsp;&nbsp;</li><li style=\"text-align: justify; \">El registro es del último periodo académico.&nbsp;</li><li style=\"text-align: justify; \">El documento está aprobado y/o suscrito por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-07-30 02:14:06'),
(97, 54, 'MV1', 'Documento o norma que acredite mecanismos de coordinación y alianzas estratégicas con el sector público y/o privado.', '<ol><li style=\"text-align: justify; \">El documento o norma hace referencia a las acciones que contribuyen al proceso de <u>inserción laboral </u>(por ejemplo: convenios marco institucionales de inserción laboral y/o prácticas pre y profesionales, convenios de intercambio académico, pasantías, capacitación y/o actualización, entre otros).</li><li style=\"text-align: justify; \">El documento o norma está aprobado por la autoridad competente.</li></ol>', 0, 1, NULL, '2025-02-14 15:56:47'),
(98, 55, 'MV1', 'Misión y visión.', NULL, 0, 1, NULL, '2025-03-03 16:28:53'),
(99, 55, 'MV2', 'Reglamento y calendario de Admisiôn.', NULL, 0, 1, NULL, '2025-03-03 16:29:56'),
(100, 55, 'MV3', 'Temario para los exámenes de admisión.', '1. El documento está aprobado por la autoridad competente.', 0, 1, NULL, '2025-03-03 16:30:07'),
(101, 55, 'MV4', 'Nümero de postulantes e ingresantes según modalidades de ingreso de los últimos dos años.', NULL, 0, 1, NULL, '2025-03-03 16:30:15'),
(102, 55, 'MV5', 'Vacantes y fechas de concursos de selección para docentes, según corresponda.', NULL, 0, 1, NULL, '2025-03-03 16:30:22'),
(103, 55, 'MV6', 'Número de estudiantes por facultades y programas de estudio.', NULL, 0, 1, NULL, '2025-03-03 16:30:30'),
(104, 55, 'MV7', 'Reglamento de estudiantes.', '1. El documento está aprobado por la autoridad competente.', 0, 1, NULL, '2025-03-03 16:30:38'),
(105, 55, 'MV8', 'Ambientes a espacios destinados a brindar los servicios  sociales, deportivos o culturales.', NULL, 0, 1, NULL, '2025-03-03 16:30:45'),
(106, 55, 'MV9', 'Título de los proyectos de investigacion, actualìzados al último semestre academico.', '<div>1. Contiene los proyectos de investigación señalados en el registro del indicador 38.</div><div>2. La información está actualizada y corresponde al último periodo académico, previo a la</div><div>presentación de la SLI.</div>', 0, 1, NULL, '2025-03-03 16:30:54'),
(107, 55, 'MV10', 'Tarifas de los servicios prestados por toda índole (matriculas, pension, constancias, certificados, entre otros).', '<div>1. Incluye como mínimo las tarifas de: matrícula, créditos académicos, constancias y/o</div><div>certificados, entre otros.</div>', 0, 1, NULL, '2025-03-03 16:31:02'),
(108, 55, 'MV11', 'Plana docente y docentes investigadores.', NULL, 0, 1, NULL, '2025-03-03 16:29:47'),
(109, 55, 'MV12', 'Malla curricular de todos sus programas de estudios.', '<p>1. La información está actualizada y corresponde al último periodo académico, previo a la presentación de la SLI.</p>', 0, 1, NULL, '2025-03-03 16:29:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_modulos`
--

CREATE TABLE `tb_modulos` (
  `id` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_modulos`
--

INSERT INTO `tb_modulos` (`id`, `nivel`, `id_parent`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Usuarios', '2025-07-29 01:50:33', '2025-07-29 01:50:33'),
(2, 1, 0, 'LICENCIAMIENTO', '2025-07-29 17:04:40', '2025-07-29 17:04:40'),
(3, 1, 0, 'MANTENIMIENTO', '2025-07-29 17:05:21', '2025-07-29 17:05:21'),
(4, 2, 2, 'Mantenimiento', '2025-07-29 17:13:56', '2025-07-29 17:13:56'),
(5, 2, 2, 'Reportes', '2025-07-29 17:14:05', '2025-07-29 17:14:05'),
(6, 2, 3, 'Oficinas', '2025-07-29 17:14:13', '2025-07-29 17:14:13'),
(7, 2, 3, 'Módulos del sistema', '2025-07-29 17:14:24', '2025-07-29 17:14:24'),
(8, 2, 3, 'Indicadores', '2025-08-13 19:39:44', '2025-08-13 19:39:44'),
(9, 2, 3, 'Medios de verificación (MV)', '2025-08-13 19:40:00', '2025-08-13 19:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_oficinas`
--

CREATE TABLE `tb_oficinas` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT 0,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_oficinas`
--

INSERT INTO `tb_oficinas` (`id`, `nombre`, `id_parent`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'RECTORADO', 0, 1, '2025-07-29 01:37:27', '2025-07-29 01:37:27'),
(2, 'VICERRECTORADO ACADÉMICO', 0, 1, '2025-07-29 01:56:23', '2025-07-29 01:56:23'),
(3, 'VICERRECTORADO DE INVESTIGACIÓN', 0, 1, '2025-07-29 01:56:56', '2025-07-29 01:56:56'),
(4, 'OFICINA DE GESTIÓN DE LA CALIDAD', 0, 1, '2025-07-29 15:21:25', '2025-07-29 15:39:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_permiso_usuario`
--

CREATE TABLE `tb_permiso_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_permiso_usuario`
--

INSERT INTO `tb_permiso_usuario` (`id`, `id_usuario`, `id_modulo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, '2025-07-29 01:50:53', '2025-07-29 02:00:00'),
(2, 1, 1, 1, '2025-07-29 02:00:03', '2025-07-29 02:00:03'),
(3, 1, 2, 1, '2025-07-30 02:44:09', '2025-07-30 02:44:09'),
(4, 1, 5, 1, '2025-07-30 02:44:15', '2025-07-30 02:44:15'),
(5, 1, 4, 1, '2025-07-30 02:44:15', '2025-07-30 02:44:15'),
(6, 1, 7, 1, '2025-07-30 02:44:22', '2025-07-30 02:44:22'),
(7, 1, 6, 1, '2025-07-30 02:44:22', '2025-07-30 02:44:22'),
(8, 1, 3, 1, '2025-07-30 02:44:23', '2025-07-30 02:44:23'),
(9, 1, 8, 1, '2025-08-13 19:40:09', '2025-08-13 19:40:09'),
(10, 1, 9, 1, '2025-08-13 19:40:10', '2025-08-13 19:40:10'),
(11, 2, 2, 1, '2025-08-13 20:36:01', '2025-08-13 20:36:01'),
(12, 2, 4, 1, '2025-08-13 20:36:02', '2025-08-13 20:36:02'),
(13, 5, 2, 1, '2025-08-13 21:58:08', '2025-08-13 21:58:08'),
(14, 5, 4, 1, '2025-08-13 21:58:09', '2025-08-13 21:58:09'),
(15, 5, 5, 1, '2025-08-13 21:58:10', '2025-08-13 21:58:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id` int(11) NOT NULL,
  `nom_rol` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id`, `nom_rol`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2025-07-28 19:23:57', '2025-07-28 19:23:57'),
(2, 'Visualizador de Indicadores', '2025-07-28 19:24:23', '2025-07-28 19:24:23'),
(3, 'Responsable de Indicador', '2025-07-28 19:25:08', '2025-07-28 19:25:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_oficina` int(11) NOT NULL,
  `etiqueta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_usu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `rol`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `id_oficina`, `etiqueta`, `key_usu`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 'ADMINISTRADOR SISTEMAS', 'admin@gmail.com', NULL, '$2y$10$oAC0Hn6bNB2X74IW3AxSiuhxKE.G4oQC.OSXSxzMPz0xIyXr4uK1O', NULL, 4, 'Admin', 'eyJpdiI6InhmdzV0UFlVbElEU1NBSlZycGFSVmc9PSIsInZhbHVlIjoiVkpmQVZsWWYwSE81VkVNODE0NEhkdz09IiwibWFjIjoiN2Y3MTg5NTczN2NkZjk2Y2JiYTBmMjg5ODQ2YjMxM2JmNzAyNmEyNDBjOTk2OGU0YWJjMDllMjMyOGVlY2I2ZSIsInRhZyI6IiJ9', 1, '2025-07-24 23:57:29', '2025-07-30 02:44:02'),
(2, 3, 'JUAN PEREZ MONTES', 'rectorado@unaaa.edu.pe', NULL, '$2y$10$9xgHZ.gx/rMc9r/IBZRs8u7CS89rhebARK4QUQ0m/ibesM19a9WPW', NULL, 1, '', 'eyJpdiI6InZIU3lvb3BhUWZzUGtnbFBVbisxaFE9PSIsInZhbHVlIjoiUXR6dHpPZUtpME0vOXd2OWRYMElYdz09IiwibWFjIjoiOWIyODQzMDljODRlNmUyMGFmNTYwMGVmMDVmMGZmMTZkNzc2NzZhNzE0OTcwOGM3Y2JlYTI0MGM1MDE5NWFiYiIsInRhZyI6IiJ9', 1, '2025-07-29 01:40:22', '2025-07-29 15:25:25'),
(3, 3, 'MARIA LEDESMA LUJAN', 'vrac@unaaa.edu.pe', NULL, '$2y$10$OxGLNI/i68JlA/LMKjn/rOpG5EWh8fdpt7Oo9/6m/FJqoUyVe4wyy', NULL, 2, '', 'eyJpdiI6IkppN05EZFRkS0xZOEpsRmxFeXhqVmc9PSIsInZhbHVlIjoia3B6TkJySmIxQmlZN3FsRVA1N014QT09IiwibWFjIjoiYmY3MDk5ZTllNTE5OWM0OTliZjYzYjU4MjhlZTIwODdiYzgzYTVkZmExNzZiZWU3N2EwOTExODllMWFiNDdkNyIsInRhZyI6IiJ9', 1, '2025-07-29 01:58:03', '2025-07-29 01:58:03'),
(4, 3, 'CARLOS HUAMANÍ LOARTE', 'vri@unaaa.edu.pe', NULL, '$2y$10$fJ6eWoPVgM0X7W5bUsIwhOpbUrfJNcUc2zXi949nslhrAlX3tsc22', NULL, 3, '', 'eyJpdiI6IkZYVFArS0J1YzRFeUl6Sys4dWd5UVE9PSIsInZhbHVlIjoiOVhPNXhvWElWZUtLOUJoY0VJZC92UT09IiwibWFjIjoiOTJkMWI0Y2U5NWM2NzdiMDk3NzEyNjZlNzljNmI3MTVhZTdkMWUxMzQwMzBmMjgxYzAzZTA1ODM3MDA2YTU0MSIsInRhZyI6IiJ9', 1, '2025-07-29 01:59:05', '2025-07-29 01:59:05'),
(5, 2, 'VISUALIZADOR OGC', 'visualizador@unaaa.edu.pe', NULL, '$2y$10$NV5AMQ1tpJcwJEq98EIyPunaZZ723xwEvkqOaArpa0yzwimC9dMRS', NULL, 4, '', 'eyJpdiI6Ik5vbmc3MURTekFQczZ6LzEzMFhnd2c9PSIsInZhbHVlIjoiMStDZEFhU2JxcWZBVWlaaWlGajZlZz09IiwibWFjIjoiODA0MWQ1NWQ2ZWI3YTljOWRiZDhlNTlhZTI0ZjljZGZjMjc1ODFmMjYzZWVmODQzNzY4ZmJhYmY4ZDQ0NTgwYiIsInRhZyI6IiJ9', 1, '2025-08-13 21:55:51', '2025-08-13 21:58:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `lic_componente`
--
ALTER TABLE `lic_componente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lic_condicion`
--
ALTER TABLE `lic_condicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lic_evaluacion`
--
ALTER TABLE `lic_evaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lic_evidencia`
--
ALTER TABLE `lic_evidencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lic_indicador`
--
ALTER TABLE `lic_indicador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lic_mv`
--
ALTER TABLE `lic_mv`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `tb_modulos`
--
ALTER TABLE `tb_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_oficinas`
--
ALTER TABLE `tb_oficinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_permiso_usuario`
--
ALTER TABLE `tb_permiso_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lic_componente`
--
ALTER TABLE `lic_componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `lic_condicion`
--
ALTER TABLE `lic_condicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `lic_evaluacion`
--
ALTER TABLE `lic_evaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lic_evidencia`
--
ALTER TABLE `lic_evidencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lic_indicador`
--
ALTER TABLE `lic_indicador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `lic_mv`
--
ALTER TABLE `lic_mv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_modulos`
--
ALTER TABLE `tb_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tb_oficinas`
--
ALTER TABLE `tb_oficinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_permiso_usuario`
--
ALTER TABLE `tb_permiso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
