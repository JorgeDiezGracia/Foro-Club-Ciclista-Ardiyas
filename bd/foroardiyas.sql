-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 17, 2025 at 07:06 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foroardiyas`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `postId` int NOT NULL AUTO_INCREMENT,
  `message` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `userID` int NOT NULL,
  `threadID` int NOT NULL,
  PRIMARY KEY (`postId`),
  KEY `FK_userID_post` (`userID`),
  KEY `FK_threadID_post` (`threadID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postId`, `message`, `userID`, `threadID`) VALUES
(1, 'Estaría interesado, ¿precio negociables? Podemos hablar por privado', 2, 1),
(4, 'Quiero venderla por 2.500€, podemos hablar de bajar precio en función de componentes que puedo quitar', 1, 1),
(5, 'Por mi, te recomiendo que sigas haciéndolo tanto por el seguro de accidentes y vida como porque nunca se sabe si en unos meses te vuelves loco y empiezas a apuntarte a carreras', 1, 8),
(6, 'Lo que tengrían que hacer es bajar los precios, no es normal que en 5 años se haya duplicado la tarifa', 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `threadID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `userID` int NOT NULL,
  `topicID` int NOT NULL,
  PRIMARY KEY (`threadID`),
  KEY `FK_userID_thread` (`userID`),
  KEY `FK_topicID_thread` (`topicID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`threadID`, `name`, `message`, `userID`, `topicID`) VALUES
(1, 'Vendo bicicleta de carretera', 'Vendo Orbea Alma full carbono del 2020. 1.500 € negociables', 1, 1),
(7, 'Entrenamiento para ciclismo de carretera por ftp y/o pulsometro', 'Más de 10 años de experiencia me avalan, si quieres mejorar y tener mejores sensanciones ponte en contacto conmigo', 4, 2),
(8, '¿Vale la pena federarse?', 'Todos los años me federo pero cada vez la licencia es más cara y compito en menos carreras.  ¿Vale la pena? ', 3, 1),
(9, 'Entrenamiento de fono.', '3 horas en fase 2 con 10 sprints de 5 segundos a full gas', 3, 2),
(10, '¿Vale la pena comprarse una bicicleta de gravel?', 'Tengo bicicleta de montaña y carretera pero cada vez veo más gente enganchada a la gravel y no se si comprarme una aunque igual mi mujer me echa de casa', 3, 1),
(11, 'Interesado en bicicleta de montaña de doble suspensión', 'Me gustaría comprar una bici de segunda mano, a poder ser que no tenga más de 3 años y esté en buenas condiciones', 1, 1),
(14, 'Fin de semana en Pirinero Aragonés', 'Estamos planficando un fin de semana en Biescas para darle caña a la zona zero', 3, 4),
(17, 'Senator 2026', 'Me gustaría hacer la Senator del próximo año, ¿alguién que la haya hecho anteriormente?', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topicID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`topicID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topicID`, `name`) VALUES
(1, 'General'),
(2, 'Entrenamientos'),
(3, 'Rutas'),
(4, 'Quedadas'),
(5, 'Competiciones');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `name`, `email`, `role`) VALUES
(1, 'Fermin23', 'f80812a241d2f679702f36081555694e', 'Fermin', 'fermin23@gmail.com', 'user'),
(2, 'admin', 'f80812a241d2f679702f36081555694e', 'Admin admin', 'admin@admin.com', 'admin'),
(3, 'JorgeTen', 'f80812a241d2f679702f36081555694e', 'Jorge', 'jorgeten@jorgeten.com', 'user'),
(4, 'Fran', 'f80812a241d2f679702f36081555694e', 'Francisco', 'fran@fran.com', 'user'),
(5, 'prueba', 'f80812a241d2f679702f36081555694e', 'prueba', 'prueba@prueba.com', 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_threadID_post` FOREIGN KEY (`threadID`) REFERENCES `threads` (`threadID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userID_post` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `FK_topicID_thread` FOREIGN KEY (`topicID`) REFERENCES `topics` (`topicID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_userID_thread` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
