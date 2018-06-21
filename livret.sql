-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 20 Juin 2018 à 15:46
-- Version du serveur :  5.7.22-0ubuntu0.16.04.1
-- Version de PHP :  7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livret`
--

CREATE DATABASE livret;
USE livret;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `classe_nom` varchar(30) DEFAULT NULL,
  `classe_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `compte_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `compte_dateExpiration` date NOT NULL,
  `compte_typeCompte` enum('administrateur','enseignant','responsable_pedagogique') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`compte_id`, `user_id`, `compte_dateExpiration`, `compte_typeCompte`) VALUES
(1, 1, '2018-06-20', 'administrateur'),
(2, 1, '2018-06-20', 'enseignant'),
(3, 1, '2018-06-30', 'responsable_pedagogique'),
(4, 2, '2018-07-31', 'administrateur'),
(5, 2, '2018-07-31', 'enseignant'),
(6, 2, '2018-07-31', 'responsable_pedagogique');

-- --------------------------------------------------------

--
-- Structure de la table `ec`
--

CREATE TABLE `ec` (
  `ec_id` int(11) NOT NULL,
  `ue_id` int(11) NOT NULL,
  `groupe_id` int(11) DEFAULT NULL,
  `ec_code` varchar(40) NOT NULL,
  `ec_nom` varchar(60) DEFAULT NULL,
  `ec_competence` text,
  `ec_prerequis` text,
  `ec_contenu` text,
  `ec_coef` int(11) DEFAULT NULL,
  `ec_nbre_heure_cm` int(11) DEFAULT NULL,
  `ec_nbre_heure_td` int(11) DEFAULT NULL,
  `ec_nbre_heure_tp` int(11) DEFAULT NULL,
  `ec_nbre_heure_tpe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `formation_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'responsable pédagogique',
  `formation_code` varchar(30) NOT NULL,
  `formation_nom` varchar(100) NOT NULL,
  `formation_semestre` enum('1','2','3','4','5','6') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `groupe_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `groupe_specialite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_utilisateurs`
--

CREATE TABLE `groupe_utilisateurs` (
  `groupe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'enseignant'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `invariant`
--

CREATE TABLE `invariant` (
  `invariant_id` int(11) NOT NULL,
  `invariant_nom` varchar(40) DEFAULT NULL,
  `invariant_contenu` text,
  `invariant_code_contenu` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livret`
--

CREATE TABLE `livret` (
  `livret_id` int(11) NOT NULL,
  `livret_nom` varchar(80) DEFAULT NULL,
  `livret_date_creation` datetime DEFAULT NULL,
  `livret_etat` enum('publié','archivé','supprimé') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livret_formation_invariant_position`
--

CREATE TABLE `livret_formation_invariant_position` (
  `livret_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `invariant_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `projet_id` int(11) NOT NULL,
  `projet_nom` varchar(100) NOT NULL,
  `projet_etat` enum('en cours','termine','supprime') NOT NULL DEFAULT 'en cours',
  `projet_step` int(11) NOT NULL DEFAULT '1',
  `projet_date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet_invariant`
--

CREATE TABLE `projet_invariant` (
  `projet_id` int(11) NOT NULL,
  `invariant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suggestions`
--

CREATE TABLE `suggestions` (
  `suggestion_id` int(11) NOT NULL,
  `suggestion_cible` enum('ue_nom','ue_nbre_cred','ec_nom','ec_competence','ec_prerequis','ec_contenu','ec_coef','ec_nbre_heure_cm','ec_nbre_heure_td','ec_nbre_heure_tp','ec_nbre_heure_tpe','general') DEFAULT NULL,
  `suggestion_cible_id` int(11) DEFAULT NULL,
  `suggestion_valeur` text,
  `suggestion_etat` enum('applique','en cours','ignore') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suggestions_projet_utilisateur`
--

CREATE TABLE `suggestions_projet_utilisateur` (
  `projet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `suggestion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ue`
--

CREATE TABLE `ue` (
  `ue_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `ue_code` varchar(40) NOT NULL,
  `ue_nom` varchar(60) DEFAULT NULL,
  `ue_nbre_cred` int(11) DEFAULT NULL,
  `ue_semestr` enum('1','2','3','4','5','6') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `user_id` int(11) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_mdpasse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_mdpasse`) VALUES
(1, 'niakhos', 'Daouda', 'niakhdaouda@gmail.com', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0'),
(2, 'Aliou', 'Ibrahim', 'aliouibnibrahim@gmail.com', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_temporaires`
--

CREATE TABLE `utilisateurs_temporaires` (
  `user_id` int(11) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_type_de_compte` varchar(50) NOT NULL,
  `user_token` varchar(100) NOT NULL,
  `user_date_exp_temp` datetime NOT NULL,
  `user_date_expiration` date NOT NULL,
  `user_date_enregistrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs_temporaires`
--

INSERT INTO `utilisateurs_temporaires` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_type_de_compte`, `user_token`, `user_date_exp_temp`, `user_date_expiration`, `user_date_enregistrement`) VALUES
(1, 'Niakh', 'Daouda', 'niakhdaouda@gmail.com', 'administrateur', 'O81xFckJdmsQ02CFr88LpuKbD1t9x4M6gEliy50CmVnrdhvnhU', '2018-06-22 12:34:41', '2020-01-01', '2018-06-20 12:34:41'),
(2, 'Niakh', 'dshhj', 'niakhdaouda@gmail.com', 'administrateur', 'YlRhaOTuIUtZLlor8hmcRSR2ZkKDJsgk2vmbjz2WPULKcZvYb1', '2018-06-22 12:54:14', '2018-06-21', '2018-06-20 12:54:14'),
(3, 'Niakh', 'dshhj', 'niakhdaouda@gmail.co', 'administrateur', 'uz2ftZFPTFSHinMrHmGHx8DRHmat4NxuERoRC3w27sdd9ZKpaQ', '2018-06-22 12:58:16', '2018-06-21', '2018-06-20 12:58:16'),
(4, 'Niakh', 'dshhj', 'niakhdaouda@gmail.co', 'administrateur', 'dMEZqk7m5nb560vlfJxSsyvwNKuKZr1LSLqXVSoZ1BZBokuFHI', '2018-06-22 13:01:07', '2018-06-21', '2018-06-20 13:01:07'),
(5, 'Niakh', 'Daouda', 'niakhdaouda.developper@gmail.com', 'administrateur', '7snhrEE9OGbB4AWbektnUcOTgRO2oV58DUA0VaAF6sX0mY33wo', '2018-06-22 14:05:39', '2020-12-31', '2018-06-20 14:05:39'),
(6, 'Sall', 'Aliou', 'aliouibnibrahim@yahoo.fr', 'administrateur', 'OeiDeKNxZs2J7gkcIcIARtFjzSaos0uWb5Q6W89M48bZONZBxZ', '2018-06-22 15:45:12', '2030-01-01', '2018-06-20 15:45:12');

-- --------------------------------------------------------

--
-- Structure de la table `_paramettres`
--

CREATE TABLE `_paramettres` (
  `param_name` varchar(255) NOT NULL,
  `param_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `_paramettres`
--

INSERT INTO `_paramettres` (`param_name`, `param_value`) VALUES
('idLastProjetLoaded', '0');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`classe_id`),
  ADD KEY `formation_id` (`formation_id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`compte_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `ec`
--
ALTER TABLE `ec`
  ADD PRIMARY KEY (`ec_id`),
  ADD KEY `ue_id` (`ue_id`),
  ADD KEY `groupe_id` (`groupe_id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`formation_id`),
  ADD UNIQUE KEY `projet_id` (`projet_id`,`formation_code`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`groupe_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `groupe_utilisateurs`
--
ALTER TABLE `groupe_utilisateurs`
  ADD PRIMARY KEY (`groupe_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `invariant`
--
ALTER TABLE `invariant`
  ADD PRIMARY KEY (`invariant_id`);

--
-- Index pour la table `livret`
--
ALTER TABLE `livret`
  ADD PRIMARY KEY (`livret_id`);

--
-- Index pour la table `livret_formation_invariant_position`
--
ALTER TABLE `livret_formation_invariant_position`
  ADD PRIMARY KEY (`livret_id`,`position`),
  ADD UNIQUE KEY `livret_id_2` (`livret_id`,`invariant_id`),
  ADD KEY `formation_id` (`formation_id`),
  ADD KEY `invariant_id` (`invariant_id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`projet_id`);

--
-- Index pour la table `projet_invariant`
--
ALTER TABLE `projet_invariant`
  ADD KEY `projet_id` (`projet_id`),
  ADD KEY `invariant_id` (`invariant_id`);

--
-- Index pour la table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Index pour la table `suggestions_projet_utilisateur`
--
ALTER TABLE `suggestions_projet_utilisateur`
  ADD PRIMARY KEY (`projet_id`,`user_id`,`suggestion_id`);

--
-- Index pour la table `ue`
--
ALTER TABLE `ue`
  ADD PRIMARY KEY (`ue_id`),
  ADD KEY `classe_id` (`classe_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- Index pour la table `utilisateurs_temporaires`
--
ALTER TABLE `utilisateurs_temporaires`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_token` (`user_token`);

--
-- Index pour la table `_paramettres`
--
ALTER TABLE `_paramettres`
  ADD UNIQUE KEY `param_name` (`param_name`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `compte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ec`
--
ALTER TABLE `ec`
  MODIFY `ec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `formation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `groupe_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `invariant`
--
ALTER TABLE `invariant`
  MODIFY `invariant_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `livret`
--
ALTER TABLE `livret`
  MODIFY `livret_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `projet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ue`
--
ALTER TABLE `ue`
  MODIFY `ue_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `utilisateurs_temporaires`
--
ALTER TABLE `utilisateurs_temporaires`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`formation_id`);

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`user_id`);

--
-- Contraintes pour la table `ec`
--
ALTER TABLE `ec`
  ADD CONSTRAINT `ec_ibfk_1` FOREIGN KEY (`ue_id`) REFERENCES `ue` (`ue_id`),
  ADD CONSTRAINT `ec_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`user_id`),
  ADD CONSTRAINT `formation_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`projet_id`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`projet_id`);

--
-- Contraintes pour la table `groupe_utilisateurs`
--
ALTER TABLE `groupe_utilisateurs`
  ADD CONSTRAINT `groupe_utilisateurs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`user_id`),
  ADD CONSTRAINT `groupe_utilisateurs_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`groupe_id`);

--
-- Contraintes pour la table `livret_formation_invariant_position`
--
ALTER TABLE `livret_formation_invariant_position`
  ADD CONSTRAINT `livret_formation_invariant_position_ibfk_1` FOREIGN KEY (`livret_id`) REFERENCES `livret` (`livret_id`),
  ADD CONSTRAINT `livret_formation_invariant_position_ibfk_2` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`formation_id`),
  ADD CONSTRAINT `livret_formation_invariant_position_ibfk_3` FOREIGN KEY (`invariant_id`) REFERENCES `invariant` (`invariant_id`);

--
-- Contraintes pour la table `projet_invariant`
--
ALTER TABLE `projet_invariant`
  ADD CONSTRAINT `projet_invariant_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projet` (`projet_id`),
  ADD CONSTRAINT `projet_invariant_ibfk_2` FOREIGN KEY (`invariant_id`) REFERENCES `invariant` (`invariant_id`);

--
-- Contraintes pour la table `ue`
--
ALTER TABLE `ue`
  ADD CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`classe_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
