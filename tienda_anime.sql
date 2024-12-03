-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2024 a las 15:07:28
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
-- Base de datos: `tienda_anime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `name`, `description`) VALUES
(2, 'Camiseta', '<div>Categoría de Camisetas.</div>'),
(3, 'Pantalones', '<div>Categoría para los distintos tipos de pantalones.</div>'),
(4, 'Figuras', '<div>Tipo de figuras de Animes.</div>'),
(5, 'Mangas', '<div>Volumenes de distintos tipos de mangas.</div>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden_producto`
--

CREATE TABLE `detalle_orden_producto` (
  `detalle_orden_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos`
--

CREATE TABLE `lista_deseos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos_producto`
--

CREATE TABLE `lista_deseos_producto` (
  `lista_deseos_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:166:\\\"https://127.0.0.1:8000/verify/email?expires=1732129290&signature=iXKf5LoUIaef2va9K1AlgjT9EgkvjzzBaW5py9ZpQOk%3D&token=0AfBLyULr3iHUpYyVuFL9xMVkBMe%2Bj6grsU8ftJ2PZg%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:31:\\\"castillejousopersonal@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:12:\\\"Tienda Anime\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"yesofcourse@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-11-20 18:01:30', '2024-11-20 18:01:30', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:170:\\\"https://127.0.0.1:8000/verify/email?expires=1732136378&signature=ha9%2BS1zyXoYxo3qx6nz0fue%2FkmV0FWPwJobkP7mRG0A%3D&token=0wukHARa11lIlxrA5GTdLyvpKdh8Qfj%2Fudx9nJDvKkU%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:31:\\\"castillejousopersonal@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:12:\\\"Tienda Anime\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"plaracil3@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-11-20 19:59:39', '2024-11-20 19:59:39', NULL),
(3, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:166:\\\"https://127.0.0.1:8000/verify/email?expires=1733072815&signature=VaPgRUv9v2yjiiGJs6jmTzUTvVZ2O1ACIEjAMYTyys0%3D&token=dG6l5nNa4d7HLq58oMQlhqv18Gg3%2FdujhvunPMD1vDQ%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:31:\\\"castillejousopersonal@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:12:\\\"Tienda Anime\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:18:\\\"adrititi@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-12-01 16:06:56', '2024-12-01 16:06:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `categoria_id`, `name`, `description`, `price`, `stock`, `imagen_url`) VALUES
(2, 2, 'Camiseta de Your name', 'Camiseta blanca de la película de Your Name', 3000.00, 5, 'your.jpg'),
(4, 3, 'Pantalón vaquero Tanjiro', 'Pantalón vaquero dedicado al anime kimetsu no yaiba del personaje Tanjiro.', 2500.00, 2, 'kimetsu pan.jpg'),
(5, 3, 'Pantalón chándal Bakugo.', 'Pantalón chándal dedicado al anime my hero academia del personaje Bakugo.', 2500.00, 5, 'hero pantalon.webp'),
(6, 4, 'Figura Bakugo', 'Figura nueva del anime my hero academia del personaje Bakugo', 4000.00, 3, 'bakugo.webp'),
(7, 5, 'Tomo 1 del Manga de One piece.', 'Primera edición del manga de One Piece.', 800.00, 10, 'tomo 1.jpg'),
(8, 2, 'Camiseta Oversize Shambles', 'Camiseta oversize inspirada en la famosa técnica Shambles de Trafalgar D. Water Law.', 2500.00, 10, 'Shambles.webp'),
(9, 2, 'Camiseta Luffy Manga Corta.', 'Camiseta de manga corta del anime one piece con diseño de luffy gear 5.', 2000.00, 5, 'Luffy.jpg'),
(10, 2, 'Sudadera Gojo eyes.', 'Sudadera del anime Jujutsu Kaisen.', 3500.00, 10, 'Gojo.webp'),
(11, 2, 'Camiseta de Nanami.', 'Camiseta de manga corta con la arma de Nanami de jujutsu kaisen.', 2000.00, 15, 'Nanami.webp'),
(12, 2, 'Camiseta del Karasuno.', 'Camiseta del anime de Haykiuu.', 2000.00, 10, 'Karasuno.webp'),
(13, 2, 'Camiseta de Demons Slayer.', 'Camiseta de manga corta de la respiración del agua.', 2000.00, 10, 'Water.webp'),
(14, 2, 'Camiseta de Naruto.', 'Camiseta de manga corta con el personaje de gai con su técnica de las ocho puertas.', 2000.00, 10, 'Gai.webp'),
(15, 2, 'Camiseta de Naruto niño.', 'Camiseta de manga corta con diseño de Naruto cuando era niño.', 2000.00, 10, 'Naruto.webp'),
(16, 3, 'Pantalones Jujutsu kaisen.', 'Pantalones holgados Jujutsu Kaisen Toji Fushiguro.', 5000.00, 5, 'Toji.webp'),
(17, 3, 'Pantalones Jujutsu kaisen.', 'Pantalones chándal del anime jujutsu kaisen.', 3500.00, 15, 'juju.png'),
(18, 3, 'Pantalones Assassination Classroom.', 'Pantalones ajustados del anime Assassination Classroom.', 3000.00, 5, 'Assasin.png'),
(19, 3, 'Pantalones del estigma maldito de Berserk.', 'Pantalones chándal del anime Bersek.', 3000.00, 5, 'Bersek.png'),
(20, 3, 'Pantalones 3D2Y de Monkey D Luffy One Piece.', 'Pantalones del anime One Piece.', 3000.00, 10, '3D2Y.png'),
(21, 3, 'Pantalones de Shingeki no Kyojin.', 'Pantalones con el emblema del anime Shingeki no Kyojin.', 3500.00, 5, 'Shingeki.jpg'),
(22, 3, 'Pantalones de One piece.', 'Pantalones con el logo de One Piece.', 3500.00, 10, 'One.jpg'),
(23, 3, 'Pantalones Jujutsu kaisen.', 'Pantalones con la figura de Gojo.', 3500.00, 10, 'Pan.jpg'),
(24, 4, 'Sword Art Online Alternative Gun Gale.', 'Figura de Llenn del anime \"Sword Art Online Alternative Gun Gale Online\". Realizada en PVC y a escala 1/7,', 8000.00, 3, 'Gun.webp'),
(25, 4, 'Figura Jujutsu Kaisen.', 'Figura de Sukuna del anime Jujutsu kaisen.', 10000.00, 2, 'Sukuna.jpg'),
(26, 4, 'Figura de One Piece.', 'Figura de Barbablanca (Newgate) del anime One piece.', 9000.00, 3, 'Newgate.jpg'),
(27, 4, 'Figura de Naruto.', 'Figura de Minato del anime de Naruto.', 6000.00, 4, 'Minato.jpg'),
(28, 4, 'Figura de Chainsawman.', 'Figura de Denji transformado, del anime de chainsawman.', 7000.00, 4, 'Chainsawman.jpg'),
(29, 4, 'Figura de Re zero', 'Figura de Rem en pijama del anime de Re zero.', 2000.00, 5, 'Rem.jpg'),
(30, 4, 'Figura de Overlord.', 'Figura de Shalltear del anime Overlord.', 6500.00, 6, 'Shalltear.jpg'),
(31, 4, 'Figura de Tokyo Ghoul.', 'Figura de Kaneki del anime Tokyo Ghoul.', 3000.00, 4, 'Ghoul.jpg'),
(32, 4, 'Figura de Spy x Family', 'Figura de Anya del anime de Spy x Family.', 4000.00, 3, 'Anya.jpg'),
(33, 5, 'Tomo 1 de Jujutsu Kaisen.', 'Tomo 1 del manga de Jujutsu Kaisen.', 800.00, 10, 'Jujutsu_Kaisen_tome_1.webp'),
(34, 5, 'Tomo 1 de Dandadan.', 'Tomo 1 del manga de Dandadan.', 800.00, 10, 'dandadan_1_jkt_regular.jpg'),
(35, 5, 'Tomo 1 de Overlord.', 'Tomo 1 del manga de Overlord.', 800.00, 10, 'D_NQ_NP_775826-MPE27465976475_052018-O.webp'),
(36, 5, 'Tomo 1 de Kimetsu no yaiba.', 'Tomo 1 del manga de Kimetsu no yaiba.', 800.00, 10, '81ZNkhqRvVL.jpg'),
(37, 5, 'Tomo 1 de Made in abyss.', 'Tomo 1 del manga de Made in abyss.', 1000.00, 10, 'Tomo-1-48.jpg'),
(38, 5, 'Tomo 1 de Haykiuu.', 'Tomo 1 del manga de Haykiuu.', 800.00, 10, 'haikyu-vol-1-9781421587660_hr.jpg'),
(39, 5, 'Tomo 1 de Boku no hero.', 'Tomo 1 del manga de Boku no hero.', 800.00, 10, 'My-Hero-Academia-Tome-01.webp'),
(40, 5, 'Tomo 1 de Akame ga kill.', 'Tomo 1 del manga de Akame ga kill.', 800.00, 10, 'D_NQ_NP_785719-MLM52936217664_122022-O.webp'),
(41, 5, 'Tomo 1 de Re zero.', 'Tomo 1 del manga de Re zero.', 800.00, 10, '640.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `is_verified` tinyint(1) NOT NULL,
  `image_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `email`, `password`, `roles`, `is_verified`, `image_perfil`) VALUES
(1, 'Ezequiel', 'yesofcourse@gmail.com', '$2y$13$NpX6i3qO/hPURCi0p9W8peTAMkgHmu0cWz.kWK8TnnteiJaq3JHui', '[\"ROLE_USER\"]', 0, NULL),
(2, 'Plaracil', 'plaracil3@gmail.com', '$2y$13$IoPMiypLNOIRYL5xn9.m8Obw8Iln/W5FHvMV86alYb4JgkJgMaKai', '[\"ROLE_ADMIN\"]', 0, NULL),
(3, 'Adrian', 'adrititi@gmail.com', '$2y$13$vjFCutSJ8NYbxsZIsD/wguyU/TOmVSs7McuUV5EYoU/kwv/3KBzj6', '[\"ROLE_USER\"]', 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_77E6BED5DB38439E` (`usuario_id`),
  ADD KEY `IDX_77E6BED57645698E` (`producto_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3F5E85839750851F` (`orden_id`);

--
-- Indices de la tabla `detalle_orden_producto`
--
ALTER TABLE `detalle_orden_producto`
  ADD PRIMARY KEY (`detalle_orden_id`,`producto_id`),
  ADD KEY `IDX_4BBED3D34F15702B` (`detalle_orden_id`),
  ADD KEY `IDX_4BBED3D37645698E` (`producto_id`);

--
-- Indices de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DAB13E44DB38439E` (`usuario_id`);

--
-- Indices de la tabla `lista_deseos_producto`
--
ALTER TABLE `lista_deseos_producto`
  ADD PRIMARY KEY (`lista_deseos_id`,`producto_id`),
  ADD KEY `IDX_AFE52B6CEC717891` (`lista_deseos_id`),
  ADD KEY `IDX_AFE52B6C7645698E` (`producto_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E128CFD7DB38439E` (`usuario_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7BB06153397707A` (`categoria_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_77E6BED57645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_77E6BED5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `FK_3F5E85839750851F` FOREIGN KEY (`orden_id`) REFERENCES `orden` (`id`);

--
-- Filtros para la tabla `detalle_orden_producto`
--
ALTER TABLE `detalle_orden_producto`
  ADD CONSTRAINT `FK_4BBED3D34F15702B` FOREIGN KEY (`detalle_orden_id`) REFERENCES `detalle_orden` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4BBED3D37645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  ADD CONSTRAINT `FK_DAB13E44DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `lista_deseos_producto`
--
ALTER TABLE `lista_deseos_producto`
  ADD CONSTRAINT `FK_AFE52B6C7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AFE52B6CEC717891` FOREIGN KEY (`lista_deseos_id`) REFERENCES `lista_deseos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `FK_E128CFD7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
