-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2022 at 01:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cine`
--

-- --------------------------------------------------------

--
-- Table structure for table `actores`
--

CREATE TABLE `actores` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(255) NOT NULL,
  `APELLIDO` varchar(255) NOT NULL,
  `EDAD` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PELICULAS` float NOT NULL,
  `FECHA_NACIMIENTO` date NOT NULL,
  `FECHA` datetime NOT NULL,
  `FK_PELICULA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actores`
--

INSERT INTO `actores` (`ID`, `NOMBRE`, `APELLIDO`, `EDAD`, `EMAIL`, `PELICULAS`, `FECHA_NACIMIENTO`, `FECHA`, `FK_PELICULA`) VALUES
(4, 'actu', 'ape', 19, '@gmail.com', 5, '2022-09-26', '2022-09-27 18:20:17', 5),
(7, 'actu', 'ape', 19, '@gmail.com', 5, '2022-09-26', '2022-09-27 18:20:17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pelicula`
--

CREATE TABLE `pelicula` (
  `ID` int(11) NOT NULL,
  `PELICULA` varchar(255) NOT NULL,
  `DESCRIPCION` varchar(255) NOT NULL,
  `CATEGORIA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelicula`
--

INSERT INTO `pelicula` (`ID`, `PELICULA`, `DESCRIPCION`, `CATEGORIA`) VALUES
(4, 'nueva', 'anime', 'desc'),
(5, 'saw', 'gore', 'miedo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actores`
--
ALTER TABLE `actores`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `FK_PELICULA` (`FK_PELICULA`);

--
-- Indexes for table `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actores`
--
ALTER TABLE `actores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actores`
--
ALTER TABLE `actores`
  ADD CONSTRAINT `actores_ibfk_1` FOREIGN KEY (`FK_PELICULA`) REFERENCES `pelicula` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
