-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Février 2017 à 14:53
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `memorable`
--

-- --------------------------------------------------------

--
-- Structure de la table `appareillage`
--

CREATE TABLE `appareillage` (
  `info1` varchar(40) NOT NULL,
  `info2` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `appareillage`
--

INSERT INTO `appareillage` (`info1`, `info2`) VALUES
('Ain', 'Bourg-en-Bresse'),
('Aisne', 'Laon'),
('Allier', 'Moulins'),
('Alpes-de-Haute-Provence', 'Digne-les-Bains'),
('Hautes-Alpes', 'Gap'),
('Alpes-Maritimes', 'Nice'),
('Ardèche', 'Privas'),
('Ardennes', 'Charleville-Mézières'),
('Ariège', 'Foix'),
('Aube', 'Troyes'),
('Aude', 'Carcassonne'),
('Aveyron', 'Rodez'),
('Bouches-du-Rhône', 'Marseille'),
('Calvados', 'Caen'),
('Cantal', 'Aurillac'),
('Charente', 'Angoulême'),
('Charente-Maritime', 'La Rochelle'),
('Cher', 'Bourges'),
('Corrèze', 'Tulle'),
('Corse-du-Sud', 'Ajaccio'),
('Haute-Corse', 'Bastia'),
('Côte-d’Or', 'Dijon'),
('Côtes-d’Armor', 'Saint-Brieuc'),
('Creuse', 'Guéret'),
('Dordogne', 'Périgueux'),
('Doubs', 'Besançon'),
('Drôme', 'Valence'),
('Eure', 'Évreux'),
('Eure-et-Loir', 'Chartres'),
('Finistère', 'Quimper'),
('Gard', 'Nîmes'),
('Haute-Garonne', 'Toulouse'),
('Gers', 'Auch'),
('Gironde', 'Bordeaux'),
('Hérault', 'Montpellier'),
('Ille-et-Vilaine', 'Rennes'),
('Indre', 'Châteauroux'),
('Indre-et-Loire', 'Tours'),
('Isère', 'Grenoble'),
('Jura', 'Lons-le-Saunier'),
('Landes', 'Mont-de-Marsan'),
('Loir-et-Cher', 'Blois'),
('Loire', 'Saint-Étienne'),
('Haute-Loire', 'Le Puy-en-Velay'),
('Loire-Atlantique', 'Nantes'),
('Loiret', 'Orléans'),
('Lot', 'Cahors'),
('Lot-et-Garonne', 'Agen'),
('Lozère', 'Mende'),
('Maine-et-Loire', 'Angers'),
('Manche', 'Saint-Lô'),
('Marne', 'Châlons-en-Champagne'),
('Haute-Marne', 'Chaumont'),
('Mayenne', 'Laval'),
('Meurthe-et-Moselle', 'Nancy'),
('Meuse', 'Bar-le-Duc'),
('Morbihan', 'Vannes'),
('Moselle', 'Metz'),
('Nièvre', 'Nevers'),
('Nord', 'Lille'),
('Oise', 'Beauvais'),
('Orne', 'Alençon'),
('Pas-de-Calais', 'Arras'),
('Puy-de-Dôme', 'Clermont-Ferrand'),
('Pyrénées-Atlantiques', 'Pau'),
('Hautes-Pyrénées', 'Tarbes'),
('Pyrénées-Orientales', 'Perpignan'),
('Bas-Rhin', 'Strasbourg'),
('Haut-Rhin', 'Colmar'),
('Rhône', 'Lyon'),
('Haute-Saône', 'Vesoul'),
('Saône-et-Loire', 'Mâcon'),
('Sarthe', 'Le Mans'),
('Savoie', 'Chambéry'),
('Haute-Savoie', 'Annecy'),
('Paris', 'Paris'),
('Seine-Maritime', 'Rouen'),
('Seine-et-Marne', 'Melun'),
('Yvelines', 'Versailles'),
('Deux-Sèvres', 'Niort'),
('Somme', 'Amiens'),
('Tarn', 'Albi'),
('Tarn-et-Garonne', 'Montauban'),
('Var', 'Toulon'),
('Vaucluse', 'Avignon'),
('Vendée', 'La Roche-sur-Yon'),
('Vienne', 'Poitiers'),
('Haute-Vienne', 'Limoges'),
('Vosges', 'Épinal'),
('Yonne', 'Auxerre'),
('Territoire de Belfort', 'Belfort'),
('Essonne', 'Évry'),
('Hauts-de-Seine', 'Nanterre'),
('Seine-Saint-Denis', 'Bobigny'),
('Val-de-Marne', 'Créteil'),
('Val-d’Oise', 'Cergy'),
('Guadeloupe', 'Basse-Terre'),
('Martinique', 'Fort-de-France'),
('Guyane', 'Cayenne'),
('La Réunion', 'Saint-Denis'),
('Mayotte', 'Mamoudzou');

-- --------------------------------------------------------

--
-- Structure de la table `questionnaires`
--

CREATE TABLE `questionnaires` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) CHARACTER SET ucs2 NOT NULL,
  `auteur` varchar(40) CHARACTER SET ucs2 NOT NULL,
  `type` int(11) NOT NULL,
  `ouverture` int(11) NOT NULL,
  `realisations` int(11) NOT NULL,
  `nbquestions` int(11) NOT NULL,
  `description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `nom`, `auteur`, `type`, `ouverture`, `realisations`, `nbquestions`, `description`) VALUES
(1, 'Capitales', 'guillaumot.theo', 0, 0, 0, 4, 'Les capitales du monde'),
(2, 'Le prénom des écrivains', 'guillaumot.theo', 0, 0, 0, 5, 'Explicite'),
(3, 'Les numéros de département', 'guillaumot.theo', 0, 0, 0, 3, ''),
(4, 'Calcul mental', 'guillaumot.theo', 0, 0, 0, 2, ''),
(5, 'Les échecs', 'guillaumot.theo', 0, 0, 0, 4, 'caca'),
(6, 'Les mamans dans l''histoire', 'guillaumot.theo', 0, 0, 0, 2, ''),
(7, 'Vocabulaire ville / espagnol', 'guillaumot.theo', 0, 0, 0, 25, ''),
(10, 'les prefectures 2', 'guillaumot.theo', 0, 0, 0, 101, ' '),
(11, 'Les numéros atomiques', 'renaud.garioud', 0, 0, 0, 4, 'rfhuegoirjg'),
(12, 'Les capitales 5', 'guillaumot.theo', 0, 0, 0, 1, 'frguergpzf'),
(13, 'Les capitales du monde 5', 'guillaumot.theo', 0, 0, 0, 3, 'crgv');

-- --------------------------------------------------------

--
-- Structure de la table `question_reponse`
--

CREATE TABLE `question_reponse` (
  `question` varchar(400) DEFAULT NULL,
  `reponse` varchar(400) DEFAULT NULL,
  `idquestionnaire` int(11) NOT NULL,
  `numeroquestion` int(11) NOT NULL,
  `nbposes` int(11) NOT NULL,
  `nbcorrect` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question_reponse`
--

INSERT INTO `question_reponse` (`question`, `reponse`, `idquestionnaire`, `numeroquestion`, `nbposes`, `nbcorrect`, `idquestion`) VALUES
('Argentine', 'Buenos Aires', 1, 1, 0, 0, 1),
('France', 'Paris', 1, 2, 0, 0, 2),
('Italie', 'Rome', 1, 3, 0, 0, 3),
('Espagne', 'Madrid', 1, 4, 0, 0, 4),
('Hugo', 'Victor', 2, 1, 0, 0, 5),
('Chateaubriand', 'René', 2, 2, 0, 0, 6),
('Pennac', 'Daniel', 2, 3, 0, 0, 7),
('Maupassant', 'Guy', 2, 4, 0, 0, 8),
('Yourcenar', 'Marguerite', 2, 5, 0, 0, 9),
('Ain', '01', 3, 1, 0, 0, 10),
('Rhône', '69', 3, 2, 0, 0, 11),
('Loire-Atlantique', '44', 3, 3, 0, 0, 12),
('2+2', '4', 4, 1, 0, 0, 13),
('6 x 7', '42', 4, 2, 0, 0, 14),
('Combien de fous chaque joueur possède-t-il ?', '2', 5, 1, 0, 0, 15),
('Pour quel coup les joueurs jouent-ils plus d''une pièce à la fois ?', 'Le roque', 5, 2, 0, 0, 16),
('Combien de cases compte l''échiquier ?', '64', 5, 3, 0, 0, 17),
('Quelle est la seule pièce à se déplacer en décrivant un L ?', 'Le cavalier', 5, 4, 0, 0, 18),
('Comment s''appelle la maman de théo ?', 'Géraldine', 6, 1, 0, 0, 19),
('Comment s''appelle la maman de Chiara Mastrioani ?', 'Catherine Deneuve', 6, 2, 0, 0, 20),
('fontaine', 'fuente', 7, 1, 0, 0, 21),
('gymnase', 'gimnasio', 7, 2, 0, 0, 22),
('trésor public/impôts', 'hacienda', 7, 3, 0, 0, 23),
('hôpital', 'hospital', 7, 4, 0, 0, 24),
('marché', 'mercadillo semanal', 7, 5, 0, 0, 25),
('marché couvert', 'mercado de abastos', 7, 6, 0, 0, 26),
('métro', 'metro', 7, 7, 0, 0, 27),
('monument', 'monumento', 7, 8, 0, 0, 28),
('musée', 'museo', 7, 9, 0, 0, 29),
('opéra', 'opera', 7, 10, 0, 0, 30),
('parc', 'parque', 7, 11, 0, 0, 31),
('passage', 'paseo', 7, 12, 0, 0, 32),
('passage piétons', 'paso de peatones', 7, 13, 0, 0, 33),
('district', 'pedania', 7, 14, 0, 0, 34),
('piscine', 'piscina', 7, 15, 0, 0, 35),
('patinoire', 'pista de patinaje', 7, 16, 0, 0, 36),
('place', 'plaza', 7, 17, 0, 0, 37),
('arènes', 'plaza de toros', 7, 18, 0, 0, 38),
('club omnisports', 'polideportivo', 7, 19, 0, 0, 39),
('village', 'pueblo', 7, 20, 0, 0, 40),
('port', 'puerto', 7, 21, 0, 0, 41),
('marché aux puces', 'rastro', 7, 22, 0, 0, 42),
('restaurant', 'restaurante', 7, 23, 0, 0, 43),
('salle de jeux', 'sala de juegos', 7, 24, 0, 0, 44),
('théâtre', 'teatro', 7, 25, 0, 0, 45),
('Ain', 'Bourg-en-Bresse', 9, 1, 0, 0, 46),
('Aisne', 'Laon', 9, 2, 0, 0, 47),
('Allier', 'Moulins', 9, 3, 0, 0, 48),
('Alpes-de-Haute-Provence', 'Digne-les-Bains', 9, 4, 0, 0, 49),
('Hautes-Alpes', 'Gap', 9, 5, 0, 0, 50),
('Alpes-Maritimes', 'Nice', 9, 6, 0, 0, 51),
('Ardèche', 'Privas', 9, 7, 0, 0, 52),
('Ardennes', 'Charleville-Mézières', 9, 8, 0, 0, 53),
('Ariège', 'Foix', 9, 9, 0, 0, 54),
('Aube', 'Troyes', 9, 10, 0, 0, 55),
('Ain', 'Bourg-en-Bresse', 10, 1, 0, 0, 56),
('Aisne', 'Laon', 10, 2, 0, 0, 57),
('Allier', 'Moulins', 10, 3, 0, 0, 58),
('Alpes-de-Haute-Provence', 'Digne-les-Bains', 10, 4, 0, 0, 59),
('Hautes-Alpes', 'Gap', 10, 5, 0, 0, 60),
('Alpes-Maritimes', 'Nice', 10, 6, 0, 0, 61),
('Ardèche', 'Privas', 10, 7, 0, 0, 62),
('Ardennes', 'Charleville-Mézières', 10, 8, 0, 0, 63),
('Ariège', 'Foix', 10, 9, 0, 0, 64),
('Aube', 'Troyes', 10, 10, 0, 0, 65),
('Aude', 'Carcassonne', 10, 11, 0, 0, 66),
('Aveyron', 'Rodez', 10, 12, 0, 0, 67),
('Bouches-du-Rhône', 'Marseille', 10, 13, 0, 0, 68),
('Calvados', 'Caen', 10, 14, 0, 0, 69),
('Cantal', 'Aurillac', 10, 15, 0, 0, 70),
('Charente', 'Angoulême', 10, 16, 0, 0, 71),
('Charente-Maritime', 'La Rochelle', 10, 17, 0, 0, 72),
('Cher', 'Bourges', 10, 18, 0, 0, 73),
('Corrèze', 'Tulle', 10, 19, 0, 0, 74),
('Corse-du-Sud', 'Ajaccio', 10, 20, 0, 0, 75),
('Haute-Corse', 'Bastia', 10, 21, 0, 0, 76),
('Côte-d’Or', 'Dijon', 10, 22, 0, 0, 77),
('Côtes-d’Armor', 'Saint-Brieuc', 10, 23, 0, 0, 78),
('Creuse', 'Guéret', 10, 24, 0, 0, 79),
('Dordogne', 'Périgueux', 10, 25, 0, 0, 80),
('Doubs', 'Besançon', 10, 26, 0, 0, 81),
('Drôme', 'Valence', 10, 27, 0, 0, 82),
('Eure', 'Évreux', 10, 28, 0, 0, 83),
('Eure-et-Loir', 'Chartres', 10, 29, 0, 0, 84),
('Finistère', 'Quimper', 10, 30, 0, 0, 85),
('Gard', 'Nîmes', 10, 31, 0, 0, 86),
('Haute-Garonne', 'Toulouse', 10, 32, 0, 0, 87),
('Gers', 'Auch', 10, 33, 0, 0, 88),
('Gironde', 'Bordeaux', 10, 34, 0, 0, 89),
('Hérault', 'Montpellier', 10, 35, 0, 0, 90),
('Ille-et-Vilaine', 'Rennes', 10, 36, 0, 0, 91),
('Indre', 'Châteauroux', 10, 37, 0, 0, 92),
('Indre-et-Loire', 'Tours', 10, 38, 0, 0, 93),
('Isère', 'Grenoble', 10, 39, 0, 0, 94),
('Jura', 'Lons-le-Saunier', 10, 40, 0, 0, 95),
('Landes', 'Mont-de-Marsan', 10, 41, 0, 0, 96),
('Loir-et-Cher', 'Blois', 10, 42, 0, 0, 97),
('Loire', 'Saint-Étienne', 10, 43, 0, 0, 98),
('Haute-Loire', 'Le Puy-en-Velay', 10, 44, 0, 0, 99),
('Loire-Atlantique', 'Nantes', 10, 45, 0, 0, 100),
('Loiret', 'Orléans', 10, 46, 0, 0, 101),
('Lot', 'Cahors', 10, 47, 0, 0, 102),
('Lot-et-Garonne', 'Agen', 10, 48, 0, 0, 103),
('Lozère', 'Mende', 10, 49, 0, 0, 104),
('Maine-et-Loire', 'Angers', 10, 50, 0, 0, 105),
('Manche', 'Saint-Lô', 10, 51, 0, 0, 106),
('Marne', 'Châlons-en-Champagne', 10, 52, 0, 0, 107),
('Haute-Marne', 'Chaumont', 10, 53, 0, 0, 108),
('Mayenne', 'Laval', 10, 54, 0, 0, 109),
('Meurthe-et-Moselle', 'Nancy', 10, 55, 0, 0, 110),
('Meuse', 'Bar-le-Duc', 10, 56, 0, 0, 111),
('Morbihan', 'Vannes', 10, 57, 0, 0, 112),
('Moselle', 'Metz', 10, 58, 0, 0, 113),
('Nièvre', 'Nevers', 10, 59, 0, 0, 114),
('Nord', 'Lille', 10, 60, 0, 0, 115),
('Oise', 'Beauvais', 10, 61, 0, 0, 116),
('Orne', 'Alençon', 10, 62, 0, 0, 117),
('Pas-de-Calais', 'Arras', 10, 63, 0, 0, 118),
('Puy-de-Dôme', 'Clermont-Ferrand', 10, 64, 0, 0, 119),
('Pyrénées-Atlantiques', 'Pau', 10, 65, 0, 0, 120),
('Hautes-Pyrénées', 'Tarbes', 10, 66, 0, 0, 121),
('Pyrénées-Orientales', 'Perpignan', 10, 67, 0, 0, 122),
('Bas-Rhin', 'Strasbourg', 10, 68, 0, 0, 123),
('Haut-Rhin', 'Colmar', 10, 69, 0, 0, 124),
('Rhône', 'Lyon', 10, 70, 0, 0, 125),
('Haute-Saône', 'Vesoul', 10, 71, 0, 0, 126),
('Saône-et-Loire', 'Mâcon', 10, 72, 0, 0, 127),
('Sarthe', 'Le Mans', 10, 73, 0, 0, 128),
('Savoie', 'Chambéry', 10, 74, 0, 0, 129),
('Haute-Savoie', 'Annecy', 10, 75, 0, 0, 130),
('Paris', 'Paris', 10, 76, 0, 0, 131),
('Seine-Maritime', 'Rouen', 10, 77, 0, 0, 132),
('Seine-et-Marne', 'Melun', 10, 78, 0, 0, 133),
('Yvelines', 'Versailles', 10, 79, 0, 0, 134),
('Deux-Sèvres', 'Niort', 10, 80, 0, 0, 135),
('Somme', 'Amiens', 10, 81, 0, 0, 136),
('Tarn', 'Albi', 10, 82, 0, 0, 137),
('Tarn-et-Garonne', 'Montauban', 10, 83, 0, 0, 138),
('Var', 'Toulon', 10, 84, 0, 0, 139),
('Vaucluse', 'Avignon', 10, 85, 0, 0, 140),
('Vendée', 'La Roche-sur-Yon', 10, 86, 0, 0, 141),
('Vienne', 'Poitiers', 10, 87, 0, 0, 142),
('Haute-Vienne', 'Limoges', 10, 88, 0, 0, 143),
('Vosges', 'Épinal', 10, 89, 0, 0, 144),
('Yonne', 'Auxerre', 10, 90, 0, 0, 145),
('Territoire de Belfort', 'Belfort', 10, 91, 0, 0, 146),
('Essonne', 'Évry', 10, 92, 0, 0, 147),
('Hauts-de-Seine', 'Nanterre', 10, 93, 0, 0, 148),
('Seine-Saint-Denis', 'Bobigny', 10, 94, 0, 0, 149),
('Val-de-Marne', 'Créteil', 10, 95, 0, 0, 150),
('Val-d’Oise', 'Cergy', 10, 96, 0, 0, 151),
('Guadeloupe', 'Basse-Terre', 10, 97, 0, 0, 152),
('Martinique', 'Fort-de-France', 10, 98, 0, 0, 153),
('Guyane', 'Cayenne', 10, 99, 0, 0, 154),
('La Réunion', 'Saint-Denis', 10, 100, 0, 0, 155),
('Mayotte', 'Mamoudzou', 10, 101, 0, 0, 156),
('1', 'Hydrogène', 11, 1, 0, 0, 157),
('2', 'Hélium', 11, 2, 0, 0, 158),
('3', 'Lithium', 11, 3, 0, 0, 159),
('4', 'Beryllium', 11, 4, 0, 0, 160),
('', '', 12, 1, 0, 0, 161),
('Argentine', 'Buenos aires', 13, 1, 0, 0, 162),
('zimbabwe', 'hararé', 13, 2, 0, 0, 163),
('chine', 'pékin', 13, 3, 0, 0, 164);

-- --------------------------------------------------------

--
-- Structure de la table `remplissages`
--

CREATE TABLE `remplissages` (
  `idproduit` int(11) NOT NULL,
  `date` date NOT NULL,
  `idremplissage` int(11) NOT NULL,
  `pourcentage` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(20) NOT NULL,
  `motdepasse` varchar(80) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `naissance` date NOT NULL,
  `nbquestions` int(11) NOT NULL,
  `nbquestionnaires` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `motdepasse`, `prenom`, `nom`, `mail`, `naissance`, `nbquestions`, `nbquestionnaires`, `admin`) VALUES
('guillaumot.theo', '86af5a34443dca823447fece51361f3a08fbdd31', 'theo', 'guillaumot', 'theoguillaumot@live.fr', '1997-05-06', 0, 0, 0),
('renaud.garioud', '81ef2ef7cd3a859923573a7bb84652871c617f7d', 'renaud', 'garioud', 'gagadu69@veryhotmail.com', '1995-12-28', 0, 0, 0),
('tristan.guillaumot', '2be88ae07a73b8c2a75656d36b1412903f7f78b8', 'tristan', 'guillaumot', 'tristan.guillaumot@club.fr', '2001-08-10', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_question`
--

CREATE TABLE `utilisateur_question` (
  `idquestion` int(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `nbtentatives` int(11) NOT NULL,
  `nbsucces` int(11) NOT NULL,
  `derniere_reponse` tinyint(1) NOT NULL,
  `idquestionnaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur_question`
--

INSERT INTO `utilisateur_question` (`idquestion`, `login`, `nbtentatives`, `nbsucces`, `derniere_reponse`, `idquestionnaire`) VALUES
(1, 'guillaumot.theo', 1, 1, 1, 1),
(2, 'guillaumot.theo', 0, 0, 0, 1),
(3, 'guillaumot.theo', 1, 1, 1, 1),
(4, 'guillaumot.theo', 0, 0, 0, 1),
(1, 'guillaumot.theo', 1, 1, 1, 1),
(2, 'guillaumot.theo', 0, 0, 0, 1),
(3, 'guillaumot.theo', 1, 1, 1, 1),
(4, 'guillaumot.theo', 0, 0, 0, 1),
(5, 'guillaumot.theo', 1, 1, 1, 2),
(6, 'guillaumot.theo', 1, 1, 1, 2),
(7, 'guillaumot.theo', 1, 1, 1, 2),
(8, 'guillaumot.theo', 1, 0, 0, 2),
(9, 'guillaumot.theo', 1, 1, 1, 2),
(21, 'guillaumot.theo', 5, 4, 1, 7),
(22, 'guillaumot.theo', 4, 2, 0, 7),
(23, 'guillaumot.theo', 3, 2, 1, 7),
(24, 'guillaumot.theo', 3, 3, 1, 7),
(25, 'guillaumot.theo', 3, 2, 1, 7),
(26, 'guillaumot.theo', 9, 6, 1, 7),
(27, 'guillaumot.theo', 2, 2, 1, 7),
(28, 'guillaumot.theo', 4, 4, 1, 7),
(29, 'guillaumot.theo', 2, 2, 1, 7),
(30, 'guillaumot.theo', 3, 3, 1, 7),
(31, 'guillaumot.theo', 4, 3, 1, 7),
(32, 'guillaumot.theo', 2, 2, 1, 7),
(33, 'guillaumot.theo', 2, 2, 1, 7),
(34, 'guillaumot.theo', 7, 4, 1, 7),
(35, 'guillaumot.theo', 2, 2, 1, 7),
(36, 'guillaumot.theo', 4, 3, 1, 7),
(37, 'guillaumot.theo', 2, 2, 1, 7),
(38, 'guillaumot.theo', 7, 5, 1, 7),
(39, 'guillaumot.theo', 2, 2, 1, 7),
(40, 'guillaumot.theo', 5, 3, 0, 7),
(41, 'guillaumot.theo', 2, 2, 1, 7),
(42, 'guillaumot.theo', 7, 4, 0, 7),
(43, 'guillaumot.theo', 4, 4, 1, 7),
(44, 'guillaumot.theo', 2, 2, 1, 7),
(45, 'guillaumot.theo', 2, 2, 1, 7),
(157, 'renaud.garioud', 2, 1, 1, 11),
(158, 'renaud.garioud', 1, 1, 1, 11),
(159, 'renaud.garioud', 1, 1, 1, 11),
(160, 'renaud.garioud', 3, 1, 1, 11),
(56, 'guillaumot.theo', 0, 0, 0, 10),
(57, 'guillaumot.theo', 0, 0, 0, 10),
(58, 'guillaumot.theo', 0, 0, 0, 10),
(59, 'guillaumot.theo', 0, 0, 0, 10),
(60, 'guillaumot.theo', 0, 0, 0, 10),
(61, 'guillaumot.theo', 0, 0, 0, 10),
(62, 'guillaumot.theo', 0, 0, 0, 10),
(63, 'guillaumot.theo', 0, 0, 0, 10),
(64, 'guillaumot.theo', 0, 0, 0, 10),
(65, 'guillaumot.theo', 0, 0, 0, 10),
(66, 'guillaumot.theo', 3, 1, 1, 10),
(67, 'guillaumot.theo', 0, 0, 0, 10),
(68, 'guillaumot.theo', 1, 1, 1, 10),
(69, 'guillaumot.theo', 0, 0, 0, 10),
(70, 'guillaumot.theo', 0, 0, 0, 10),
(71, 'guillaumot.theo', 0, 0, 0, 10),
(72, 'guillaumot.theo', 0, 0, 0, 10),
(73, 'guillaumot.theo', 0, 0, 0, 10),
(74, 'guillaumot.theo', 0, 0, 0, 10),
(75, 'guillaumot.theo', 0, 0, 0, 10),
(76, 'guillaumot.theo', 0, 0, 0, 10),
(77, 'guillaumot.theo', 0, 0, 0, 10),
(78, 'guillaumot.theo', 0, 0, 0, 10),
(79, 'guillaumot.theo', 0, 0, 0, 10),
(80, 'guillaumot.theo', 0, 0, 0, 10),
(81, 'guillaumot.theo', 0, 0, 0, 10),
(82, 'guillaumot.theo', 0, 0, 0, 10),
(83, 'guillaumot.theo', 0, 0, 0, 10),
(84, 'guillaumot.theo', 0, 0, 0, 10),
(85, 'guillaumot.theo', 0, 0, 0, 10),
(86, 'guillaumot.theo', 0, 0, 0, 10),
(87, 'guillaumot.theo', 0, 0, 0, 10),
(88, 'guillaumot.theo', 0, 0, 0, 10),
(89, 'guillaumot.theo', 0, 0, 0, 10),
(90, 'guillaumot.theo', 0, 0, 0, 10),
(91, 'guillaumot.theo', 0, 0, 0, 10),
(92, 'guillaumot.theo', 0, 0, 0, 10),
(93, 'guillaumot.theo', 0, 0, 0, 10),
(94, 'guillaumot.theo', 0, 0, 0, 10),
(95, 'guillaumot.theo', 0, 0, 0, 10),
(96, 'guillaumot.theo', 0, 0, 0, 10),
(97, 'guillaumot.theo', 0, 0, 0, 10),
(98, 'guillaumot.theo', 0, 0, 0, 10),
(99, 'guillaumot.theo', 0, 0, 0, 10),
(100, 'guillaumot.theo', 0, 0, 0, 10),
(101, 'guillaumot.theo', 4, 1, 1, 10),
(102, 'guillaumot.theo', 0, 0, 0, 10),
(103, 'guillaumot.theo', 0, 0, 0, 10),
(104, 'guillaumot.theo', 0, 0, 0, 10),
(105, 'guillaumot.theo', 0, 0, 0, 10),
(106, 'guillaumot.theo', 0, 0, 0, 10),
(107, 'guillaumot.theo', 0, 0, 0, 10),
(108, 'guillaumot.theo', 0, 0, 0, 10),
(109, 'guillaumot.theo', 0, 0, 0, 10),
(110, 'guillaumot.theo', 0, 0, 0, 10),
(111, 'guillaumot.theo', 0, 0, 0, 10),
(112, 'guillaumot.theo', 1, 0, 0, 10),
(113, 'guillaumot.theo', 0, 0, 0, 10),
(114, 'guillaumot.theo', 0, 0, 0, 10),
(115, 'guillaumot.theo', 0, 0, 0, 10),
(116, 'guillaumot.theo', 0, 0, 0, 10),
(117, 'guillaumot.theo', 0, 0, 0, 10),
(118, 'guillaumot.theo', 0, 0, 0, 10),
(119, 'guillaumot.theo', 0, 0, 0, 10),
(120, 'guillaumot.theo', 0, 0, 0, 10),
(121, 'guillaumot.theo', 0, 0, 0, 10),
(122, 'guillaumot.theo', 1, 0, 0, 10),
(123, 'guillaumot.theo', 0, 0, 0, 10),
(124, 'guillaumot.theo', 0, 0, 0, 10),
(125, 'guillaumot.theo', 1, 1, 1, 10),
(126, 'guillaumot.theo', 0, 0, 0, 10),
(127, 'guillaumot.theo', 0, 0, 0, 10),
(128, 'guillaumot.theo', 0, 0, 0, 10),
(129, 'guillaumot.theo', 1, 1, 1, 10),
(130, 'guillaumot.theo', 0, 0, 0, 10),
(131, 'guillaumot.theo', 0, 0, 0, 10),
(132, 'guillaumot.theo', 0, 0, 0, 10),
(133, 'guillaumot.theo', 0, 0, 0, 10),
(134, 'guillaumot.theo', 0, 0, 0, 10),
(135, 'guillaumot.theo', 0, 0, 0, 10),
(136, 'guillaumot.theo', 0, 0, 0, 10),
(137, 'guillaumot.theo', 0, 0, 0, 10),
(138, 'guillaumot.theo', 0, 0, 0, 10),
(139, 'guillaumot.theo', 0, 0, 0, 10),
(140, 'guillaumot.theo', 0, 0, 0, 10),
(141, 'guillaumot.theo', 0, 0, 0, 10),
(142, 'guillaumot.theo', 0, 0, 0, 10),
(143, 'guillaumot.theo', 0, 0, 0, 10),
(144, 'guillaumot.theo', 0, 0, 0, 10),
(145, 'guillaumot.theo', 0, 0, 0, 10),
(146, 'guillaumot.theo', 0, 0, 0, 10),
(147, 'guillaumot.theo', 0, 0, 0, 10),
(148, 'guillaumot.theo', 0, 0, 0, 10),
(149, 'guillaumot.theo', 0, 0, 0, 10),
(150, 'guillaumot.theo', 0, 0, 0, 10),
(151, 'guillaumot.theo', 0, 0, 0, 10),
(152, 'guillaumot.theo', 0, 0, 0, 10),
(153, 'guillaumot.theo', 0, 0, 0, 10),
(154, 'guillaumot.theo', 1, 0, 0, 10),
(155, 'guillaumot.theo', 1, 1, 1, 10),
(156, 'guillaumot.theo', 0, 0, 0, 10),
(162, 'guillaumot.theo', 2, 0, 0, 13),
(163, 'guillaumot.theo', 1, 1, 1, 13),
(164, 'guillaumot.theo', 2, 2, 1, 13);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_questionnaire`
--

CREATE TABLE `utilisateur_questionnaire` (
  `login` varchar(40) NOT NULL,
  `type` int(11) NOT NULL,
  `idquestionnaire` int(11) NOT NULL,
  `nbquestionsrepondues` int(11) NOT NULL,
  `pourcentage` float NOT NULL,
  `idproduit` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur_questionnaire`
--

INSERT INTO `utilisateur_questionnaire` (`login`, `type`, `idquestionnaire`, `nbquestionsrepondues`, `pourcentage`, `idproduit`) VALUES
('guillaumot.theo', 0, 1, 0, 0, 3),
('guillaumot.theo', 0, 2, 0, 0, 4),
('guillaumot.theo', 0, 7, 0, 0, 5),
('renaud.garioud', 0, 11, 0, 0, 6),
('guillaumot.theo', 0, 10, 0, 0, 7),
('guillaumot.theo', 0, 13, 0, 0, 8);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question_reponse`
--
ALTER TABLE `question_reponse`
  ADD PRIMARY KEY (`idquestion`);

--
-- Index pour la table `remplissages`
--
ALTER TABLE `remplissages`
  ADD PRIMARY KEY (`idremplissage`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- Index pour la table `utilisateur_questionnaire`
--
ALTER TABLE `utilisateur_questionnaire`
  ADD PRIMARY KEY (`idproduit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `questionnaires`
--
ALTER TABLE `questionnaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `question_reponse`
--
ALTER TABLE `question_reponse`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT pour la table `remplissages`
--
ALTER TABLE `remplissages`
  MODIFY `idremplissage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur_questionnaire`
--
ALTER TABLE `utilisateur_questionnaire`
  MODIFY `idproduit` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
