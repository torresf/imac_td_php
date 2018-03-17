-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 12 Mars 2018 à 01:57
-- Version du serveur :  5.7.21-0ubuntu0.16.04.1
-- Version de PHP :  7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `imac-movies`
--

-- --------------------------------------------------------

--
-- Structure de la table `Actor`
--

CREATE TABLE `Actor` (
  `idMovie` int(11) NOT NULL,
  `idActor` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Actor`
--

INSERT INTO `Actor` (`idMovie`, `idActor`, `name`) VALUES
(11, 27, 'Voix Off'),
(11, 30, 'Max'),
(11, 36, 'Coursier'),
(11, 40, 'Développeuse'),
(11, 41, 'M. Énigme'),
(12, 38, 'Actrice Principale'),
(13, 32, 'Sportif Secondaire'),
(13, 33, 'Patron'),
(13, 34, 'Voix Off'),
(13, 35, 'Développeur'),
(13, 36, 'Développeuse'),
(13, 37, 'Développeur'),
(13, 38, 'Sportive'),
(13, 39, 'Sportif'),
(13, 40, 'Sportive Secondaire'),
(14, 18, 'Figurante'),
(14, 31, 'Acteur Principal'),
(14, 34, 'Figurant'),
(14, 42, 'Figurante'),
(15, 29, 'MORUE'),
(15, 30, 'Acteur Principal'),
(16, 22, 'Actrice Principale'),
(17, 24, 'Voix Off'),
(18, 18, 'L\'inspectrice'),
(18, 19, 'L\'élu'),
(18, 20, 'Élève 1'),
(18, 21, 'Élève 2');

-- --------------------------------------------------------

--
-- Structure de la table `Cast`
--

CREATE TABLE `Cast` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `birthYear` int(11) DEFAULT NULL,
  `deathYear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Cast`
--

INSERT INTO `Cast` (`id`, `firstname`, `lastname`, `birthYear`, `deathYear`) VALUES
(1, 'David', 'Fincher', 1962, NULL),
(2, 'Quentin', 'Tarantino', 1963, NULL),
(3, 'Stanley', 'Kubrick', 1928, 1999),
(4, 'Ridley', 'Scott', 1937, NULL),
(5, 'Francis Ford', 'Coppola', 1939, NULL),
(6, 'Christopher', 'Nolan', 1970, NULL),
(7, 'Robert', 'Zemeckis', 1952, NULL),
(8, 'Sergio', 'Leone', 1929, 1989),
(9, 'Peter', 'Jackson', 1961, NULL),
(10, 'Irvin', 'Kershner', 1923, 2010),
(11, 'Michel', 'Gondry', 1963, NULL),
(12, 'Park', 'Chan-Wook', 1963, NULL),
(13, 'Hayao', 'Miyazaki', 1941, NULL),
(14, 'Lilly', 'Wachowski', 1967, NULL),
(15, 'Lana', 'Wachoswki', 1965, NULL),
(16, 'Sidney', 'Lumet', 1924, 2011),
(17, 'David', 'Lynch', 1946, NULL),
(18, 'Myriam', 'Anik', 1998, NULL),
(19, 'Guillaume', 'Lollier', 1998, NULL),
(20, 'Bastien', 'Germain', 1998, NULL),
(21, 'Lisa', 'Limousy', 1998, NULL),
(22, 'Émilie', 'Marti', 1998, NULL),
(23, 'Laurine', 'Sajdak', 1998, NULL),
(24, 'Marie', 'Cruveillier', 1998, NULL),
(25, 'Noélie', 'Bravo', 1998, NULL),
(26, 'Nicolas', 'Cusumano', 1998, NULL),
(27, 'Nicolas', 'Sénécal', 1998, NULL),
(28, 'Clémentine', 'Meriadec', 1998, NULL),
(29, 'Élodie', 'Deshayes', 1998, NULL),
(30, 'Quentin', 'Sedmi', 1998, NULL),
(31, 'Albert-Henri', 'Moyrand', 1998, NULL),
(32, 'Florian', 'Torres', 1998, NULL),
(33, 'Michel', 'Yip', 1998, NULL),
(34, 'Nathanaël', 'Rovere', 1998, NULL),
(35, 'Baptiste', 'Mantovani', 1998, NULL),
(36, 'Stella', 'Poulain', 1998, NULL),
(37, 'Julian', 'Bruxelle', 1998, NULL),
(38, 'Louise', 'Paris', 1998, NULL),
(39, 'Hedi', 'Hamadache', 1998, NULL),
(40, 'Léa', 'Harabagiu', 1998, NULL),
(41, 'Damien', 'Trolard', 1998, NULL),
(42, 'Audrey', 'Combe', 1998, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Country`
--

CREATE TABLE `Country` (
  `code` varchar(4) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Country`
--

INSERT INTO `Country` (`code`, `name`) VALUES
('DE', 'Germany'),
('FR', 'France'),
('GB', 'Great-Britain'),
('IT', 'Italy'),
('JP', 'Japan'),
('KR', 'South Korea'),
('USA', 'United States of America');

-- --------------------------------------------------------

--
-- Structure de la table `Director`
--

CREATE TABLE `Director` (
  `idMovie` int(11) NOT NULL,
  `idDirector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Director`
--

INSERT INTO `Director` (`idMovie`, `idDirector`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 9),
(9, 6),
(10, 8),
(11, 36),
(12, 39),
(13, 32),
(14, 18),
(15, 28),
(16, 24),
(16, 25),
(16, 26),
(16, 27),
(17, 23),
(18, 21);

-- --------------------------------------------------------

--
-- Structure de la table `Genre`
--

CREATE TABLE `Genre` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Genre`
--

INSERT INTO `Genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Biography'),
(5, 'Comedy'),
(6, 'Crime'),
(7, 'Documentary'),
(8, 'Drama'),
(9, 'Family'),
(10, 'Fantasy'),
(11, 'Film-Noir'),
(12, 'History'),
(13, 'Horror'),
(14, 'Music'),
(15, 'Musical'),
(16, 'Mystery'),
(17, 'News'),
(18, 'Romance'),
(19, 'Sci-Fi'),
(20, 'Sport'),
(21, 'Thriller'),
(22, 'War'),
(23, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT ' ',
  `releaseDate` date NOT NULL,
  `idCountry` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `releaseDate`, `idCountry`) VALUES
(1, 'Fight Club', '1999-09-10', 'USA'),
(2, 'Pulp Fiction', '1994-09-10', 'USA'),
(3, '2001: A Space Odyssey', '1968-04-03', 'USA'),
(4, 'Blade Runner', '1982-06-25', 'USA'),
(5, 'The Godfather', '1972-03-24', 'USA'),
(6, 'The Dark Knight', '2008-07-16', 'USA'),
(7, 'Forrest Gump', '1994-07-06', 'USA'),
(8, 'The Lord of the Rings: The Return of the King', '2003-12-01', 'USA'),
(9, 'Interstellar', '2014-11-05', 'USA'),
(10, 'Il Buono, il Brutto, il Cattivo', '1966-12-23', 'IT'),
(11, 'Le Carton', '2018-01-01', 'FR'),
(12, 'Le Horla', '2018-01-01', 'FR'),
(13, 'L\'Interview Numérique - Digital Sweat', '2018-01-01', 'FR'),
(14, 'METRONORME', '2018-01-01', 'FR'),
(15, 'MORUE', '2018-01-01', 'FR'),
(16, 'Olentia', '2018-01-01', 'FR'),
(17, 'Onisk', '2018-01-01', 'FR'),
(18, 'Sup de Super', '2018-01-01', 'FR');

-- --------------------------------------------------------

--
-- Structure de la table `MovieGenre`
--

CREATE TABLE `MovieGenre` (
  `idMovie` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `MovieGenre`
--

INSERT INTO `MovieGenre` (`idMovie`, `idGenre`) VALUES
(1, 8),
(2, 6),
(2, 8),
(3, 2),
(3, 19),
(4, 19),
(4, 21),
(5, 6),
(5, 8),
(6, 1),
(6, 6),
(6, 21),
(7, 8),
(7, 18),
(8, 2),
(8, 8),
(8, 10),
(9, 2),
(9, 8),
(9, 19),
(10, 23),
(11, 5),
(12, 8),
(13, 5),
(14, 8),
(15, 5),
(16, 5),
(17, 8),
(18, 5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Actor`
--
ALTER TABLE `Actor`
  ADD PRIMARY KEY (`idMovie`,`idActor`);

--
-- Index pour la table `Cast`
--
ALTER TABLE `Cast`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `Director`
--
ALTER TABLE `Director`
  ADD PRIMARY KEY (`idMovie`,`idDirector`);

--
-- Index pour la table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `MovieGenre`
--
ALTER TABLE `MovieGenre`
  ADD PRIMARY KEY (`idMovie`,`idGenre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Cast`
--
ALTER TABLE `Cast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `Genre`
--
ALTER TABLE `Genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
