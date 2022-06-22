-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2022 a las 01:44:17
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `repositorio_digital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivo`
--

CREATE TABLE `tbl_archivo` (
  `idtbl_archivo` int(11) NOT NULL,
  `tbl_archivo_nombre` mediumtext DEFAULT NULL,
  `tbl_archivo_url` longtext DEFAULT NULL,
  `tbl_usuario_idtbl_usuario` int(11) DEFAULT NULL,
  `tbl_archivo_fecha` mediumtext DEFAULT NULL,
  `tbl_archivo_filename` mediumtext DEFAULT NULL,
  `tbl_archivo_urlfilemanager` mediumtext DEFAULT NULL,
  `tbl_descriparchivo_idtbl_descriparchivo` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_archivo`
--

INSERT INTO `tbl_archivo` (`idtbl_archivo`, `tbl_archivo_nombre`, `tbl_archivo_url`, `tbl_usuario_idtbl_usuario`, `tbl_archivo_fecha`, `tbl_archivo_filename`, `tbl_archivo_urlfilemanager`, `tbl_descriparchivo_idtbl_descriparchivo`) VALUES
(70, '2021_15-23-21VfDA5cnpjT.pdf', 'http://localhost/repositorioarchivos/uploads/2021_15-23-21VfDA5cnpjT.pdf', 1, '2021-03-21 15:23:21', 'mik4', 'files', NULL),
(71, '2021_16-24-50OogH4PYbWq.pdf', 'http://localhost/repositorioarchivos/uploads/2021_16-24-50OogH4PYbWq.pdf', 1, '2021-03-23 16:24:50', 'example', 'files', NULL),
(82, '2021_13-40-24ITeEAD63XU.pdf', 'http://localhost/repositorioarchivos/uploads/2021_13-40-24ITeEAD63XU.pdf', 1, '2021-03-25 13:40:24', 'example', 'files', NULL),
(86, '2021_13-40-24jdAlQbeSYG.pdf', 'http://localhost/repositorioarchivos/uploads/2021_13-40-24jdAlQbeSYG.pdf', 1, '2021-03-25 13:40:24', '13T0641 ', 'files', NULL),
(95, '2021_22-37-26lJbKuIAQZw.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021_22-37-26lJbKuIAQZw.pdf', 1, '2021-04-01 22:37:26', 'www.iiserpune.ac.in_js_ckfinder_config_newsite', 'files/admin', NULL),
(112, '2021_11-24-37jRGNukAcEV.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/05/2021_11-24-37jRGNukAcEV.pdf', 1, '2021-04-05 11:24:37', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/05', NULL),
(113, '2021_12-46-07VRQMTz7X9B.pdf', 'http://localhost/repositorioarchivos/uploads/files/macgkM/2021/04/05/2021_12-46-07VRQMTz7X9B.pdf', 10, '2021-04-05 12:46:07', 'Complete-NGINX-Cookbook-2019', 'files/macgkM/2021/04/05', NULL),
(114, '2021_12-48-43VZturUqxwF.pdf', 'http://localhost/repositorioarchivos/uploads/files/macgkM/2021/04/05/2021_12-48-43VZturUqxwF.pdf', 10, '2021-04-05 12:48:43', 'example', 'files/macgkM/2021/04/05', NULL),
(115, '2021_12-48-43Wy1hEP8eop.pdf', 'http://localhost/repositorioarchivos/uploads/files/macgkM/2021/04/05/2021_12-48-43Wy1hEP8eop.pdf', 10, '2021-04-05 12:48:43', 'example_052', 'files/macgkM/2021/04/05', NULL),
(119, '2021_20-16-26SuZvC2gKLa.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/06/2021_20-16-26SuZvC2gKLa.pdf', 1, '2021-04-06 20:16:26', 'Dialnet-PlataformaDeServiciosDeReconocimientoFacialParaDet-7527769', 'files/admin/2021/04/06', NULL),
(120, '2021_20-43-19gyqeTB0dGC.pdf', 'http://localhost/repositorioarchivos/uploads/files/macgkM/2021/04/06/2021_20-43-19gyqeTB0dGC.pdf', 10, '2021-04-06 20:43:19', 'Dialnet-PlataformaDeServiciosDeReconocimientoFacialParaDet-7527769', 'files/macgkM/2021/04/06', NULL),
(123, '2021_21-50-01GS9Z3dOfAU.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/08/2021_21-50-01GS9Z3dOfAU.pdf', 1, '2021-04-08 21:50:01', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/08', '3vMKhVL88FfoRXzIeNZoEzkIppknUFc0zeb9gH9prpdV'),
(124, '2021_21-50-01apf5vjJMzu.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/08/2021_21-50-01apf5vjJMzu.pdf', 1, '2021-04-08 21:50:01', 'Complete-NGINX-Cookbook-2019', 'files/admin/2021/04/08', '3vMKhVL88FfoRXzIeNZoEzkIppknUFc0zeb9gH9prpdV'),
(125, '21.04.10-pm30-22.24.232076.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-pm30-22.24.232076.pdf', 1, '2021-04-10 22:24:23', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/10', 'fd570e9633ffd'),
(126, '21.04.10-pm30-22.24.2334fc.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-pm30-22.24.2334fc.pdf', 1, '2021-04-10 22:24:23', 'People Australia May 06, 2019', 'files/admin/2021/04/10', 'fd570e9633ffd'),
(127, '21.04.10-at-22.28.17e54d.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.28.17e54d.pdf', 1, '2021-04-10 22:28:17', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/10', '9601528ff7d867d01d840cf6d40083b4899aa8d451da'),
(128, '21.04.10-at-22.32.165d12.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.32.165d12.pdf', 1, '2021-04-10 22:32:16', 'www.iiserpune.ac.in_js_ckfinder_config_newsite', 'files/admin/2021/04/10', '2f3386507a3b501b511b5ba8f022f259557ad5e'),
(129, '21.04.10-at-22.32.16c84d.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.32.16c84d.pdf', 1, '2021-04-10 22:32:16', 'example', 'files/admin/2021/04/10', '2f3386507a3b501b511b5ba8f022f259557ad5e'),
(130, '21.04.10-at-22.42.54f356.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.42.54f356.pdf', 1, '2021-04-10 22:42:54', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/10', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(131, '21.04.10-at-22.42.549504.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.42.549504.pdf', 1, '2021-04-10 22:42:54', 'www.iiserpune.ac.in_js_ckfinder_config_newsite', 'files/admin/2021/04/10', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(132, '21.04.10-at-22.42.54d486.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.42.54d486.pdf', 1, '2021-04-10 22:42:54', 'example', 'files/admin/2021/04/10', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(133, '21.04.10-at-22.42.54434a.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.42.54434a.pdf', 1, '2021-04-10 22:42:54', 'example_052', 'files/admin/2021/04/10', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(134, '21.04.10-at-22.42.548a46.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/10/21.04.10-at-22.42.548a46.pdf', 1, '2021-04-10 22:42:54', 'mik4', 'files/admin/2021/04/10', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(135, '21.04.18-at-15.28.18981a.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/18/25dc39/21.04.18-at-15.28.18981a.pdf', 1, '2021-04-18 15:28:18', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/18/25dc39', 'd0499078e67e8e3415119629007bd6b8d4fdcba518d440ea8c'),
(136, '21.04.18-at-15.28.1889b6.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/18/25dc39/21.04.18-at-15.28.1889b6.pdf', 1, '2021-04-18 15:28:18', 'Complete-NGINX-Cookbook-2019', 'files/admin/2021/04/18/25dc39', 'd0499078e67e8e3415119629007bd6b8d4fdcba518d440ea8c'),
(140, '21.04.18-at-16.06.57bd3e.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/18/80e388/21.04.18-at-16.06.57bd3e.pdf', 1, '2021-04-18 16:06:57', 'NGINX_A_Practical_Guide_Preview_Edition', 'files/admin/2021/04/18/80e388', '205faf9c2404a82615dd'),
(141, '21.04.18-at-16.06.5753ed.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/18/80e388/21.04.18-at-16.06.5753ed.pdf', 1, '2021-04-18 16:06:57', 'Complete-NGINX-Cookbook-2019', 'files/admin/2021/04/18/80e388', '205faf9c2404a82615dd'),
(143, '21.04.27-at-10.18.21555e.pdf', 'http://localhost/repositorioarchivos/uploads/files/admin/2021/04/27/1e0b3a/21.04.27-at-10.18.21555e.pdf', 1, '2021-04-27 10:18:21', 'Complete-NGINX-Cookbook-2019', 'files/admin/2021/04/27/1e0b3a', 'e6c8ba7c4995be0e3d829820727880f99'),
(144, '22.06.01-at-21.53.076cb9.pdf', 'http://localhost/repositorioarchivos/uploads/files/testcneld/2022/06/01/e1fab7/22.06.01-at-21.53.076cb9.pdf', 14, '2022-06-01 21:53:07', 'SinTitulo1', 'files/testcneld/2022/06/01/e1fab7', '7176e453a0dc4c862b7'),
(145, '22.06.01-at-21.55.009f47.pdf', 'http://localhost/repositorioarchivos/uploads/files/testcneld/2022/06/01/cd03db/22.06.01-at-21.55.009f47.pdf', 14, '2022-06-01 21:55:00', 'release_compressed (1)', 'files/testcneld/2022/06/01/cd03db', '3457c02e62a0085ddf85d4328552'),
(146, '22.06.01-at-21.55.008eda.pdf', 'http://localhost/repositorioarchivos/uploads/files/testcneld/2022/06/01/cd03db/22.06.01-at-21.55.008eda.pdf', 14, '2022-06-01 21:55:00', 'release_compressed', 'files/testcneld/2022/06/01/cd03db', '3457c02e62a0085ddf85d4328552'),
(147, '22.06.01-at-22.23.48c3f0.pdf', 'http://localhost/repositorioarchivos/uploads/files/testYt/2022/06/01/b87107/22.06.01-at-22.23.48c3f0.pdf', 15, '2022-06-01 22:23:48', 'AN2-2020-18', 'files/testYt/2022/06/01/b87107', '6d1f20dfb94defecb7f1802f3dfb4436ea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_descriparchivo`
--

CREATE TABLE `tbl_descriparchivo` (
  `idtbl_descriparchivo` int(11) NOT NULL,
  `tbl_descriparchivo_nombre` mediumtext DEFAULT NULL,
  `tbl_descriparchivo_descrip` mediumtext DEFAULT NULL,
  `tbl_descriparchivo_directoriofile` mediumtext DEFAULT NULL,
  `tbl_descriparchivo_filename` mediumtext DEFAULT NULL,
  `tbl_archivo_idtbl_archivo` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_descriparchivo`
--

INSERT INTO `tbl_descriparchivo` (`idtbl_descriparchivo`, `tbl_descriparchivo_nombre`, `tbl_descriparchivo_descrip`, `tbl_descriparchivo_directoriofile`, `tbl_descriparchivo_filename`, `tbl_archivo_idtbl_archivo`) VALUES
(2, 'NGINX NUEVO LIBRO', 'LIBRO DE CONFIGURACION DE NGINX EN INGLES', 'files/admin/2021/04/08', '2021_21-50-01GS9Z3dOfAU.pdf,2021_21-50-01apf5vjJMzu.pdf', '3vMKhVL88FfoRXzIeNZoEzkIppknUFc0zeb9gH9prpdV'),
(3, 'TEST', 'TEST DE PDF', 'files/admin/2021/04/10', '21.04.10-pm30-22.24.232076.pdf,21.04.10-pm30-22.24.2334fc.pdf', 'fd570e9633ffd'),
(4, 'TEST2', 'CARATULA', 'files/admin/2021/04/10', '21.04.10-at-22.28.17e54d.pdf', '9601528ff7d867d01d840cf6d40083b4899aa8d451da'),
(5, 'TEST 3', 'DESCRIPCION 3', 'files/admin/2021/04/10', '21.04.10-at-22.32.165d12.pdf,21.04.10-at-22.32.16c84d.pdf', '2f3386507a3b501b511b5ba8f022f259557ad5e'),
(6, 'TEST4', 'TEST DE 5 ARCHIVOS', 'files/admin/2021/04/10', '21.04.10-at-22.42.54f356.pdf,21.04.10-at-22.42.549504.pdf,21.04.10-at-22.42.54d486.pdf,21.04.10-at-22.42.54434a.pdf,21.04.10-at-22.42.548a46.pdf', 'bcf7e81ec5a0fa5aadc77168b34b97d240f4'),
(7, 'TESTNEWFOLDER', 'ESTE ES UN NUEVO TEST DE FOLDER', 'files/admin/2021/04/18/25dc39', '21.04.18-at-15.28.18981a.pdf,21.04.18-at-15.28.1889b6.pdf', 'd0499078e67e8e3415119629007bd6b8d4fdcba518d440ea8c'),
(9, 'WHAT IS LOREM IPSUM', 'LOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING INDUSTRY. LOREM IPSUM HAS BEEN THE INDUSTRY\'S STANDARD DUMMY TEXT EVER SINCE THE 1500S, WHEN AN UNKNOWN PRINTER TOOK A GALLEY OF TYPE AND SCRAMBLED IT TO MAKE A TYPE SPECIMEN BOOK. IT HAS SURVIVED NOT ONLY FIVE CENTURIES, BUT ALSO THE LEAP INTO ELECTRONIC TYPESETTING, REMAINING ESSENTIALLY UNCHANGED. IT WAS POPULARISED IN THE 1960S WITH THE RELEASE OF LETRASET SHEETS CONTAINING LOREM IPSUM PASSAGES, AND MORE RECENTLY WITH DESKTOP PUBLISHING SOFTWARE LIKE ALDUS PAGEMAKER INCLUDING VERSIONS OF LOREM IPSUM.', 'files/admin/2021/04/18/80e388', '21.04.18-at-16.06.57bd3e.pdf,21.04.18-at-16.06.5753ed.pdf', '205faf9c2404a82615dd'),
(11, 'HELLOTEST', 'HELLOOOOO', 'files/admin/2021/04/27/1e0b3a', '21.04.27-at-10.18.21555e.pdf', 'e6c8ba7c4995be0e3d829820727880f99'),
(12, 'TEST ARCHIVO', 'ESTE ES UN NUEVO ARCHIVO', 'files/testcneld/2022/06/01/e1fab7', '22.06.01-at-21.53.076cb9.pdf', '7176e453a0dc4c862b7'),
(13, 'ARCHIVOS MULTIPLES', 'MÚLTIPLES ARCHIVOS', 'files/testcneld/2022/06/01/cd03db', '22.06.01-at-21.55.009f47.pdf,22.06.01-at-21.55.008eda.pdf', '3457c02e62a0085ddf85d4328552'),
(14, 'TESTPDF1', 'HOLA PDF', 'files/testYt/2022/06/01/b87107', '22.06.01-at-22.23.48c3f0.pdf', '6d1f20dfb94defecb7f1802f3dfb4436ea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_directorio`
--

CREATE TABLE `tbl_directorio` (
  `idtbl_directorio` int(11) NOT NULL,
  `tbl_directorio_name` mediumtext DEFAULT NULL,
  `tbl_directorio_url` mediumtext DEFAULT NULL,
  `tbl_usuario_idtbl_usuario` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_directorio`
--

INSERT INTO `tbl_directorio` (`idtbl_directorio`, `tbl_directorio_name`, `tbl_directorio_url`, `tbl_usuario_idtbl_usuario`) VALUES
(8, 'macgkM', 'uploads/files/macgkM', 'hARg0HkqGe2fQtfNu1U2kXspolP94ntXJ0gwgl'),
(11, 'hello', 'uploads/files/hello', NULL),
(12, 'elibertokT', 'uploads/files/elibertokT', 'naW1yhU13HfbLXDqQRD9tpLw5P6dArOFbn6b7tbD'),
(13, 'testdeauditoria', 'uploads/files/testdeauditoria', NULL),
(14, 'ert', 'uploads/files/ert', NULL),
(15, 'testcneld', 'uploads/files/testcneld', '3eOWe7Z2oD0IYdha5gHdg9Hd0JpaBfT5v7I'),
(16, 'testYt', 'uploads/files/testYt', 'fxbxqnUThTYPVD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `idtbl_usuario` int(11) NOT NULL,
  `tbl_usuario_nombre` mediumtext DEFAULT NULL,
  `tbl_usuario_apellido` mediumtext DEFAULT NULL,
  `tbl_usuario_username` mediumtext DEFAULT NULL,
  `tbl_usuario_password` mediumtext DEFAULT NULL,
  `tbl_usuario_tipousuario` mediumtext DEFAULT NULL,
  `tbl_usuario_rol` mediumtext NOT NULL,
  `tbl_usuario_table` mediumtext NOT NULL,
  `tbl_usuario_iddirectorio` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`idtbl_usuario`, `tbl_usuario_nombre`, `tbl_usuario_apellido`, `tbl_usuario_username`, `tbl_usuario_password`, `tbl_usuario_tipousuario`, `tbl_usuario_rol`, `tbl_usuario_table`, `tbl_usuario_iddirectorio`) VALUES
(1, 'Juan Carlos', 'Cedeño', 'admin', '$2y$12$ddedeJOWqpLC2eBjsp4VVOnPhZwBqQiWoizBvMLirqv5DmaT.Ux1S', 'admin', '1', 'db0c2edc9f4b1f7d9461c8b28001f30dbff6cdebef7d235903c424ece18a87b116e607f903ca5e7f452fed434d8febd02c49ea2cf61b1d1d00fcac34c12dc323TTPvZtZ0gCNUkcnMzbTjShQ22q3F78Yz/HOFEkukpKY=', '3m7j7XMP73HWR'),
(10, 'MACG', 'CONTENT', 'macgkM', '$2y$12$qH..Y8MR6Inrv14BckRgp.aDEySprPo2NaLTbZhUmbOkr2Q/Rnugq', 'usuario', '1', 'f2bcb9d4bbcc9380345521077571cdf2f7ea1468dae640c2990d48af718737619aa9aa6e78c9ed4036afad6b42196d068a58e803599eef205547cfd0bd118a22djn8d8PYPi/61dgxgasTJfC2TDpqB38WY+zD+ahcnhY=', 'hARg0HkqGe2fQtfNu1U2kXspolP94ntXJ0gwgl'),
(13, 'ELIBERTO', 'AUGUSTO', 'elibertokT', '$2y$12$r5jk.uNzLDQesnfS/jer3Oxsp6tItWyOt3S6qi.7L.ewoQ5reU/1q', 'usuario', '1', '600e226a9b71c86bac8efc37202a50e4da31a728b4c4c6d907ccd8ce9e132c5f37c6842c98e9e8cee8634eb994681d42cff29ceb71b138950b51d5798e9ef44a0CUb7Fi9M4DM9KfaAMvRuTougSgqdYMrKs2h8tTL5EU=', 'naW1yhU13HfbLXDqQRD9tpLw5P6dArOFbn6b7tbD'),
(14, 'TESTCNE', 'CEDEÑO REINA', 'testcneld', '$2y$12$BsrYz1.3J3lpERk5i/nnKu632rHc3v5QaFKKU9sDnaSMpR9sl9xB2', 'usuario', '1', 'c0df62fb0f5fd61f82dbe41a7791c232ced3d1dbc30009251bedc6343ccf97630d40a49e76fe2c599c004c7552d993a8683763aa7b39174cd8421a1382f8e3ab4P6l6wBzWQ3skM67o9UOZqjeJ9YrZ8SA1jpOAmNM46c=', '3eOWe7Z2oD0IYdha5gHdg9Hd0JpaBfT5v7I'),
(15, 'TEST MARIO', 'CEDEÑO', 'testYt', '$2y$12$zQFy.tm3DTS6SmHoT4VyO.XS8qJKAQcOirfdmpBGPAjM2/zb.VYoq', 'usuario', '1', 'b35c7765def9febc6e6fbc324ca0f72d5dcf91521cbba9f680582c8cf747c07502195d69cceb5ef2ef4b64ceee3c97540f51b9c41d628e0e6c84286f63e915e59vB3YgtMSsWxIpw88eqb5nkvR8yyVkyn3mfEZ7Rz6js=', 'fxbxqnUThTYPVD');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_archivo`
--
ALTER TABLE `tbl_archivo`
  ADD PRIMARY KEY (`idtbl_archivo`);

--
-- Indices de la tabla `tbl_descriparchivo`
--
ALTER TABLE `tbl_descriparchivo`
  ADD PRIMARY KEY (`idtbl_descriparchivo`);

--
-- Indices de la tabla `tbl_directorio`
--
ALTER TABLE `tbl_directorio`
  ADD PRIMARY KEY (`idtbl_directorio`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`idtbl_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_archivo`
--
ALTER TABLE `tbl_archivo`
  MODIFY `idtbl_archivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `tbl_descriparchivo`
--
ALTER TABLE `tbl_descriparchivo`
  MODIFY `idtbl_descriparchivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_directorio`
--
ALTER TABLE `tbl_directorio`
  MODIFY `idtbl_directorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `idtbl_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
