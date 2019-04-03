-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 08:51 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skriptni`
--

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id` int(11) NOT NULL,
  `ime` char(20) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` char(40) COLLATE utf8_croatian_ci NOT NULL,
  `OIB` bigint(11) NOT NULL,
  `ured` varchar(20) COLLATE utf8_croatian_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id`, `ime`, `prezime`, `OIB`, `ured`, `status`, `tel`, `email`) VALUES
(1, 'Stefan', 'Kralj', 7847465534, 'U14/53', 'redoviti profesor', '051-353-869', 'ivo.gnjavim@riteh.hr'),
(2, 'Mentor', 'Mentoric', 85687567, 'B-31', 'prof', '0943289', 'ja@ti.on');

-- --------------------------------------------------------

--
-- Table structure for table `nadzor`
--

CREATE TABLE `nadzor` (
  `idMentor` int(11) NOT NULL,
  `idTema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `nadzor`
--

INSERT INTO `nadzor` (`idMentor`, `idTema`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `raspored`
--

CREATE TABLE `raspored` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL,
  `prostorija` char(20) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `raspored`
--

INSERT INTO `raspored` (`id`, `datum`, `vrijeme`, `prostorija`) VALUES
(1, '2016-12-25', '10:00:00', 'U69'),
(2, '2017-01-01', '00:00:01', 'U96');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idStudent` int(11) NOT NULL,
  `ime` char(20) COLLATE utf8_croatian_ci NOT NULL,
  `prezime` char(40) COLLATE utf8_croatian_ci NOT NULL,
  `JMBAG` bigint(10) NOT NULL,
  `godRod` int(5) NOT NULL,
  `mob` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `idTema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idStudent`, `ime`, `prezime`, `JMBAG`, `godRod`, `mob`, `email`, `idTema`) VALUES
(24, 'Claude', 'Shannon', 5345435, 1987, '09173284327', 'cshannon@jericevic.hr', 2),
(60, 'Ivo', 'Ipsic', 3423274, 1950, '0942389324', 'iipsic@riteh.hr', 1),
(62, 'John', 'Doe', 33903234, 1994, '0987473235', 'john@doe.com', 3),
(63, 'Jane', 'Jone', 393993585, 1990, '0931243258', 'jane@gmail.com', 2),
(64, 'Netko', 'Netkovic', 989650548, 1987, '092746894', 'neki@tip.hr', 1),
(65, 'Ivana', 'Ivcic', 4893247, 1974, '0918274357', 'ivo@yahoo.com', 3),
(66, 'Marina', 'Marincic', 948392, 1991, '092848591', 'marina@yahoo.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE `tema` (
  `idTema` int(11) NOT NULL,
  `jezik` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `prezentacija` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `seminar` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `brStudenti` int(11) NOT NULL,
  `opis` text COLLATE utf8_croatian_ci,
  `idRaspored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`idTema`, `jezik`, `prezentacija`, `seminar`, `brStudenti`, `opis`, `idRaspored`) VALUES
(1, 'PHP', 'PHP i svijet', 'Samo PHP', 3, NULL, 1),
(2, 'Pearl', 'nesto prezentacija', 'dada i seminar', 2, 'ovo je prezentacija i semniar iz Pearla', 2),
(3, 'Python', 'dada Python wohoo', 'seminar iz Pythona', 4, 'python samo python', 1),
(4, 'Pearl', 'Osnove Perla', 'Seminar iz Pearla', 3, 'Seminar i prezentacija iz Perla', 2),
(5, 'PHP', 'Prezentacija', 'Seminar', 2, 'PHP i MySQL', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nadzor`
--
ALTER TABLE `nadzor`
  ADD KEY `idMentor` (`idMentor`,`idTema`),
  ADD KEY `idTema` (`idTema`);

--
-- Indexes for table `raspored`
--
ALTER TABLE `raspored`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`),
  ADD KEY `idTema` (`idTema`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`idTema`),
  ADD KEY `idRaspored` (`idRaspored`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `raspored`
--
ALTER TABLE `raspored`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `idTema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `nadzor`
--
ALTER TABLE `nadzor`
  ADD CONSTRAINT `nadzor_ibfk_1` FOREIGN KEY (`idMentor`) REFERENCES `mentor` (`id`),
  ADD CONSTRAINT `nadzor_ibfk_2` FOREIGN KEY (`idTema`) REFERENCES `tema` (`idTema`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`idTema`) REFERENCES `tema` (`idTema`);

--
-- Constraints for table `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`idRaspored`) REFERENCES `raspored` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
