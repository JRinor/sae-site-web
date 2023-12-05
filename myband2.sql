-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 29 sep. 2023 à 20:07
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myband2`
--

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` tinyint(4) NOT NULL DEFAULT 0,
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`login`, `password`, `email`, `contact`, `admin`) VALUES
('Van.Halen', 'jump', 'contact@rockband.fr', 0, 0),
('Freddy.Mercury', 'queen', 'freddy@queen.uk', 0, 0),
('admin', 'SuperPassword', 'admin@myband.com', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `setlist`
--

CREATE TABLE `setlist` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `lyrics` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `setlist`
--

INSERT INTO `setlist` (`id`, `title`, `artist`, `style`, `lyrics`) VALUES
(1, 'Pause', 'Compo', 'Apéro Concert', NULL),
(2, 'Lettre à France', 'M. Polnareff', 'Apéro Concert', NULL),
(3, 'Hymne à l\'amour', 'E. Piaf', 'Apéro Concert', NULL),
(4, 'Let it be', 'Beatles', 'Apéro Concert', NULL),
(5, 'Hallelujah', 'J. Buckey', 'Apéro Concert', NULL),
(6, 'Your Song', 'E. John', 'Apéro Concert', NULL),
(7, 'Lucie', 'P. Obispo', 'Apéro Concert', NULL),
(8, 'Toi + moi', 'Grégoire', 'Apéro Concert', NULL),
(9, 'Shape of my heart', 'Sting', 'Apéro Concert', NULL),
(10, 'SOS', 'D. Balavoine', 'Apéro Concert', NULL),
(11, 'Colorblind', 'Counting Crows', 'Apéro Concert', NULL),
(12, 'J\'ai oublié de l\'oublier', 'E. Mitchell', 'Apéro Concert', NULL),
(13, 'Kissing you', 'Dees\'re', 'Apéro Concert', NULL),
(14, 'C\'est bon pour le moral', 'C. Créole', 'Tour du Monde - Créole', NULL),
(15, 'Le douanier rousseau', 'C. Créole', 'Tour du Monde - Créole', NULL),
(16, 'Ca fait rire les oiseaux', 'C. Créole', 'Tour du Monde - Créole', NULL),
(17, 'Ai se tu e pego', 'M. Telo', 'Tour du Monde - Tube été', NULL),
(18, 'Lambada', 'Kaoma', 'Tour du Monde - Tube été', NULL),
(19, 'Samba de janeiro', 'Bellini', 'Tour du Monde - Tube été', NULL),
(20, 'La Bamba', 'Los Lobos', 'Tour du Monde - Tube été', NULL),
(21, 'No woman no cry', 'B. Marley', 'Tour du Monde - Reggae', NULL),
(22, 'Reggae Night', 'J. Cliff', 'Tour du Monde - Reggae', NULL),
(23, 'Ville de lumière', 'Gold', '80s, Disco, Funk - Gold', NULL),
(24, 'Plus près des étoiles', 'Gold', '80s, Disco, Funk - Gold', NULL),
(25, 'Capitaine abandonné', 'Gold', '80s, Disco, Funk - Gold', NULL),
(26, 'Nuit de folie', 'Début de soirée', '80s, Disco, Funk - Medley 80', NULL),
(27, 'Macumba', 'J.P Mader', '80s, Disco, Funk - Medley 80', NULL),
(28, 'Le Jerk', 'T. Hazard', '80s, Disco, Funk - Medley 80', NULL),
(29, 'Les démons de minuits', 'Image', '80s, Disco, Funk - Medley 80', NULL),
(30, 'Gimme Gimme Gimme', 'ABBA', '80s, Disco, Funk - Disco', NULL),
(31, 'Hot Stuff', 'D. Sommer', '80s, Disco, Funk - Disco', NULL),
(32, 'Call Me', 'Blondie', '80s, Disco, Funk - Disco', NULL),
(33, 'I Will Survive', 'G. Glaynor', '80s, Disco, Funk - Disco', NULL),
(34, 'Magnolia forever', 'C. François', '80s, Disco, Funk - Cloclo', NULL),
(35, 'Cette année là', 'C. François', '80s, Disco, Funk - Cloclo', NULL),
(36, 'Staying alive', 'Beegees', '80s, Disco, Funk - Medley Funk', NULL),
(37, 'Long train running', 'Dobbie Brothers', '80s, Disco, Funk - Medley Funk', NULL),
(38, 'Le Freak', 'Chic', '80s, Disco, Funk - Medley Funk', NULL),
(39, 'Je marche seul', 'J.J Goldman', 'Goldman & Cie', NULL),
(40, 'Quand la musique est bonne', 'J.J Goldman', 'Goldman & Cie', NULL),
(41, 'Il suffira d\'un signe', 'J.J Goldman', 'Goldman & Cie', NULL),
(42, 'Encore un matin', 'J.J Goldman', 'Goldman & Cie', NULL),
(43, 'Envole moi', 'J.J Goldman', 'Goldman & Cie', NULL),
(44, 'J\'irai ou tu iras', 'JJ. Goldman / C. Dion', 'Goldman & Cie', NULL),
(45, 'L\'aventurier', 'Indochine', '80s, Disco, Funk', NULL),
(46, 'Sunlight des tropiques', 'G. Montagné', '80s, Disco, Funk - Montagné', NULL),
(47, 'On va s\'aimer', 'G. Montagné', '80s, Disco, Funk - Montagné', NULL),
(48, 'A Whiter Shade Of Pale', 'Procol Harum', 'Love & Slows', NULL),
(49, 'Si (Zaz) : 113', 'Zaz', 'Love & Slows', NULL),
(50, 'Knocking heaven\'s door : 110', 'Guns & Roses', 'Love & Slows', NULL),
(51, 'La derniere danse : 111', 'Kyo', 'Love & Slows', NULL),
(52, 'No woman no cry (copie dans reggae)', 'B. Marley', 'Love & Slows', NULL),
(53, 'Stil got the blues', 'G. Moore', 'Love & Slows', NULL),
(54, 'Still loving you : 120', 'Scorpion', 'Love & Slows', NULL),
(55, 'Nothing else matter : 121', 'Metallica', 'Love & Slows', NULL),
(56, 'I Will always love you : 122', 'W. Houston', 'Love & Slows', NULL),
(57, 'Vivo per lei', 'A. Boccelli & H. Ségara', 'Love & Slows', NULL),
(58, 'La bas', 'J.J. Goldman', 'Love & Slows', NULL),
(59, 'Heros', 'M. Carey', 'Love & Slows', NULL),
(60, 'Glory Box', 'Portishead', 'Love & Slows', NULL),
(61, 'Shallow (A Star is Born) - à venir', 'B. Cooper / Lady Gaga', 'Love & Slows', NULL),
(62, 'My Immortal', 'Evanescence', 'Rock - Slow', NULL),
(63, 'Belles, belles, belles', 'C. François', 'Sixties - Twist', NULL),
(64, 'Twist again', 'C. Checker', 'Sixties - Twist', NULL),
(65, 'Johnny be good', 'C. Berry', 'Sixties - Rock\'n roll', NULL),
(66, 'Blues suedes shoes', 'E. Presley', 'Sixties - Rock\'n roll', NULL),
(67, 'The One That I Want', 'Grease', 'Sixties - Rock\'n roll', NULL),
(68, 'Last night (impro)', '', 'Sixties - Madison', NULL),
(69, 'Champs Elysée', 'J. Dassin', 'Sixties - Madison', NULL),
(70, 'Wonderwall', 'Oasis', 'Pop Music', NULL),
(71, 'A ma place', 'A. Bauer & Zazie', 'Pop Music', 'A MA PLACE paroles.pdf'),
(72, 'Hotel California', 'Eagles', 'Pop Music', NULL),
(73, 'Cendrillon', 'Téléphone', 'Rock - Téléphone', NULL),
(74, 'I Love Rock\'n roll', 'J. Jett', 'Rock - Téléphone', NULL),
(75, 'Bohemian Rhapsody', 'Queen', 'Rock - Queen', 'BohemianRhapsody.pdf'),
(76, 'We are the Champion', 'Queen', 'Rock - Queen', NULL),
(77, 'Show must go on', 'Queen', 'Rock - Queen', NULL),
(78, 'Rock you', 'Queen', 'Rock - Queen', NULL),
(79, 'Eye of the tiger', 'Survivor', 'BO', NULL),
(80, 'Ghostbuster', 'R. Parker Jr', 'BO', NULL),
(81, 'The power of love', 'Frankie Goes to Hollywood', 'BO', NULL),
(82, 'Bring me to life', 'Evanescence', 'BO', NULL),
(83, 'Shallow', 'B. Cooper, L. Gaga', 'BO', NULL),
(84, 'Starlight', 'Muse', 'Rock around the world', NULL),
(85, 'Zombie', 'Cranberries', 'Rock around the world', NULL),
(86, 'Seven nation', 'White stripes', 'Rock around the world', NULL),
(87, 'Feeling good', 'Muse', 'Rock around the world', NULL),
(88, 'Beat it', 'M. Jackson', 'Rock around the world', NULL),
(89, 'Gotta get away', 'The Offspring', 'Rock around the world', NULL),
(90, 'Ca c\'est vraiment toi', 'Téléphone', 'Rock around the world', NULL),
(91, 'Highway to Hell', 'ACDC', 'Rock around the world', NULL),
(92, 'Smoke on the water', 'Deep Purple', 'Rock around the world', NULL),
(93, 'Hold the line', 'Toto', 'Rock around the world', NULL),
(94, 'I was made for loving you', 'Kiss', 'Rock around the world', NULL),
(95, 'Que je t\'aime', 'J. Halliday', 'Rock - Johnny', NULL),
(96, 'Allumer le feu', 'J. Halliday', 'Rock - Johnny', NULL),
(97, 'L\'envie', 'J. Halliday', 'Rock - Johnny', NULL),
(98, 'Je ne suis pas un héros', 'D. Balavoine', 'Rock frenchies', NULL),
(99, 'Mourir Demain', 'P. Obispo / N. StPier', 'Rock frenchies', NULL),
(100, 'Sunday bloody Sunday', 'U2', 'Rock - U2', NULL),
(101, 'Where the streets have no name', 'U2', 'Rock - U2', NULL),
(102, 'New year\'s day', 'U2', 'Rock - U2', NULL),
(103, 'The kids aren\'t alright', 'The Offspring', 'Rock - Punk', NULL),
(104, 'Pretty fly (for a white guy)', 'The Offspring', 'Rock - Punk', NULL),
(105, 'Un jour en France', 'Noir Désir', 'Rock - Noir Désir', NULL),
(106, 'L\'homme pressé', 'Noir Désir', 'Rock - Noir Désir', NULL),
(107, 'Emma', 'Matmatah', 'Rock - Matmatah', NULL),
(108, 'Lambé', 'Matmatah', 'Rock - Matmatah', NULL),
(109, 'C\'est toi que je t\'aime', 'Inconnus', 'Rock - Matmatah', NULL),
(110, 'Marcia Baila', 'Rita mitsouko', 'Ambiance / Fête', NULL),
(111, 'La salsa du démon', 'Le Splendide', 'Ambiance / Fête', NULL),
(112, 'Tourner les serviettes', 'P. Sebastien', 'Ambiance / Fête - P Sébastien', NULL),
(113, 'Les sardines', 'P. Sebastien', 'Ambiance / Fête - P Sébastien', NULL),
(114, 'Les lacs du Connemara', 'M. Sardou', 'Ambiance / Fête - Danse Folk', NULL),
(115, 'Rolling in the deep', 'Adèle', 'Ambiance / Fête - Adèle', NULL),
(116, 'Someone like you', 'Adèle', 'Ambiance / Fête - Adèle', NULL),
(117, 'Get lucky', 'Daft Punk', 'Actualté', NULL),
(118, 'Everybody', 'M. Solveig', 'Actualté', NULL),
(119, 'Locked out of heaven', 'B. Mars', 'Actualté', NULL),
(120, 'I Gotta Feeling', 'D. Getta', 'Actualté', NULL),
(121, 'Chandelier', 'Sia', 'Actualté', NULL),
(126, 'Lose Yourself', 'Eminem', 'Rap', NULL),
(130, 'Requiem pour un fou', 'J. Hallyday', 'Pop - Johnny', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `setlist`
--
ALTER TABLE `setlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `setlist`
--
ALTER TABLE `setlist`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
