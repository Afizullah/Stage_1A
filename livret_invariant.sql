-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 04 juil. 2018 à 11:54
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `livret`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `classe_id` int(11) NOT NULL,
  `classe_nom` varchar(30) DEFAULT NULL,
  `formation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`classe_id`, `classe_nom`, `formation_id`) VALUES
(1, 'DUT1 Info', 1);

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
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`compte_id`, `user_id`, `compte_dateExpiration`, `compte_typeCompte`) VALUES
(1, 1, '2018-06-20', 'administrateur'),
(2, 1, '2018-06-20', 'enseignant'),
(3, 1, '2018-06-30', 'responsable_pedagogique'),
(4, 2, '2018-07-31', 'administrateur'),
(5, 2, '2018-07-31', 'enseignant'),
(6, 2, '2018-07-31', 'responsable_pedagogique'),
(9, 5, '2018-06-21', 'administrateur');

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

--
-- Déchargement des données de la table `ec`
--

INSERT INTO `ec` (`ec_id`, `ue_id`, `groupe_id`, `ec_code`, `ec_nom`, `ec_competence`, `ec_prerequis`, `ec_contenu`, `ec_coef`, `ec_nbre_heure_cm`, `ec_nbre_heure_td`, `ec_nbre_heure_tp`, `ec_nbre_heure_tpe`) VALUES
(13, 1, 7, 'DUTINFO 1111', 'Initiation à l\'informatique', '• Savoir installer et configurer un système informatique_x000D_• Faire du conseil et assistance technique à des utilisateurs, clients, services_x000D_• Comprendre un système informatique_x000D_• Savoir utililiser les outils bureautiques', 'Aucun', '• Codage de l’information : nombres et caractères. Arithmétique et traitements associés\n• Architecture générale d\'un système informatique\n• Types et caractéristiques des systèmes d’exploitation\n• Langage de commande : commandes de base, introduction à la programmation des scripts\n• Gestion des taches (création, destruction, suivi, etc.), des fichiers (types, droits, etc.) et des utilisateurs (caractéristiques, création, suppression, etc.)\n• Principes de l’installation et de la configuration d’un système.\n• Introduction aux outils bureautique', 1, 5, 10, 15, 10),
(14, 1, 7, 'DUTINFO 1112', 'Introduction à l\'algorithmique et à la programmation', '• Comprendre la démarche méthodologique de la programmation informatique\n• Connaître un formalisme algorithmique\n• Savoir analyser un problème pour en tirer une solution formelle\n• Savoir écrire un algorithme d’une solution formelle\n• Connaître quelques algorithmes fondamentaux sur des données numériques et alphanumériques\n• Savoir analyser et comparer des algorithmes et rendre plus performant un algorithme\n• Connaître un langage de programmation informatique pour transposer les algorithmes fondamentaux', 'Aucun', '• Notion d\'information et de modélisation.(Analyse descendante, Analyse ascendante, Primitives et combinaisons de primitives du processeur algorithmique de référence)\n• Structures algorithmiques fondamentales (séquence, choix, itération, etc.)\n•  Présentation du Formalisme algorithmique\n• Notion de type\n•  Procédures et Fonctions algorithmiques\n•  Récursivité et dérécursification\n• Implantation en langage de programmation.', 4, 30, 10, 20, 30),
(16, 1, 7, 'DUTINFO 1113', 'Technologie des ordinateurs', '• Connaître les méthodes de codage et de représentation de l’information, et les traitements associés.\n• Connaître le fonctionnement des circuits combinatoires associés au traitement des données $ Réaliser les cirscuits combinatoires.', 'Aucun', '• Codage de l’information : numération, représentation des nombres et codage en machines, codage des caractères, arithmétique et traitement associés.\n•  Éléments logiques : algèbre de Boole, circuits logiques combinatoires (décodeur, additionneur, unité de calcul), systèmes séquentiels simples (registres, compteurs).', 3, 8, 10, 12, 10),
(18, 1, 8, 'DUTINFO 1114', 'Introduction aux Réseaux', '• Connaître les principes de la transmission et du codage de l\'information.\n• Connaître les principales techniques de transport mises en oeuvre dans les réseaux.', 'Aucun', '• Concepts fondamentaux des réseaux_x000D_• Transmission de l\'information : support, topologie, codages, techniques d\'accès, partage._x000D_• Gestion des communications dans le réseau : synchronisation, contrôle d\'erreurs, contrôle de flux, routage, adressage, commutation_x000D_• Technologie des réseaux locaux : Ethernet, FDDI, WiFi, etc.', 2, 14, 16, 0, 10);

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

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`formation_id`, `projet_id`, `user_id`, `formation_code`, `formation_nom`, `formation_semestre`) VALUES
(1, 1, 2, 'DUTINFO', 'DUT Informatique', '4');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `groupe_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  `groupe_specialite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `projet_id`, `groupe_specialite`) VALUES
(7, 1, 'Informatique'),
(8, 1, 'Réseaux'),
(9, 3, 'new');

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

--
-- Déchargement des données de la table `invariant`
--

INSERT INTO `invariant` (`invariant_id`, `invariant_nom`, `invariant_contenu`, `invariant_code_contenu`) VALUES
(3, 'Mot du chef de département', '<p>Cher(e)s &eacute;tudiant(e)s du D&eacute;partement G&eacute;nie Informatique (DGI) de l&rsquo;EcoleSup&eacute;rieure Polytechnique (ESP), vous tenez entre les mains le livret de l&rsquo;&eacute;tudiant qui fait la synth&egrave;se d&rsquo;un ensemble d&rsquo;informations utiles sur l&rsquo;organisation de vos &eacute;tudes. Il a pour ambition de vous apporter de vraies r&eacute;ponses aux multiples questions qui vous interpellent surtout lorsque vous vous inscrivez pour la premi&egrave;re fois dans l&rsquo;une des formations du D&eacute;partement.</p>\r\n', NULL),
(4, 'Réglement intérieur', '<p>Article 15 - Tous les cours, s&eacute;ances de travaux dirig&eacute;s et de travaux pratiques, sont obligatoires. Toute absence non justifi&eacute;e entra&icirc;ne la note z&eacute;ro pour les interrogations, compositions ou examens qui auraient lieu ce jour-l&agrave;.</p>\r\n', NULL),
(5, 'Sigles et abréviations', '', NULL),
(6, 'Équipe Pédagogique', '', NULL),
(7, 'Conditions de passage', '', NULL),
(8, 'Extraits de l\'arrêté organisant la forma', '', NULL);

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

--
-- Déchargement des données de la table `projet`
--

INSERT INTO `projet` (`projet_id`, `projet_nom`, `projet_etat`, `projet_step`, `projet_date_creation`) VALUES
(1, 'Projet Livrets 2018', 'en cours', 1, '2018-06-20 16:26:22'),
(2, 'Test', 'en cours', 1, '2018-06-21 11:05:30'),
(3, 'cool', 'en cours', 1, '2018-07-03 16:27:50');

-- --------------------------------------------------------

--
-- Structure de la table `projet_invariant`
--

CREATE TABLE `projet_invariant` (
  `projet_id` int(11) NOT NULL,
  `invariant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `projet_invariant`
--

INSERT INTO `projet_invariant` (`projet_id`, `invariant_id`) VALUES
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8);

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

--
-- Déchargement des données de la table `ue`
--

INSERT INTO `ue` (`ue_id`, `classe_id`, `ue_code`, `ue_nom`, `ue_nbre_cred`, `ue_semestr`) VALUES
(1, 1, 'DUTINFO 111', 'Bases de l\'informatique', 14, '1');

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
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_mdpasse`) VALUES
(1, 'niakhos', 'Daouda', 'niakhdaouda@gmail.com', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0'),
(2, 'Aliou', 'Ibrahim', 'aliouibnibrahim@gmail.com', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0'),
(5, 'Niakh', 'Daouda', 'niakhdaouda.developper@gmail.com', '9af15b336e6a9619928537df30b2e6a2376569fcf9d7e773eccede65606529a0');

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
-- Déchargement des données de la table `utilisateurs_temporaires`
--

INSERT INTO `utilisateurs_temporaires` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_type_de_compte`, `user_token`, `user_date_exp_temp`, `user_date_expiration`, `user_date_enregistrement`) VALUES
(1, 'Niakh', 'Daouda', 'niakhdaouda@gmail.com', 'administrateur', 'O81xFckJdmsQ02CFr88LpuKbD1t9x4M6gEliy50CmVnrdhvnhU', '2018-06-22 12:34:41', '2020-01-01', '2018-06-20 12:34:41'),
(2, 'Niakh', 'dshhj', 'niakhdaouda@gmail.com', 'administrateur', 'YlRhaOTuIUtZLlor8hmcRSR2ZkKDJsgk2vmbjz2WPULKcZvYb1', '2018-06-22 12:54:14', '2018-06-21', '2018-06-20 12:54:14'),
(3, 'Niakh', 'dshhj', 'niakhdaouda@gmail.co', 'administrateur', 'uz2ftZFPTFSHinMrHmGHx8DRHmat4NxuERoRC3w27sdd9ZKpaQ', '2018-06-22 12:58:16', '2018-06-21', '2018-06-20 12:58:16'),
(4, 'Niakh', 'dshhj', 'niakhdaouda@gmail.co', 'administrateur', 'dMEZqk7m5nb560vlfJxSsyvwNKuKZr1LSLqXVSoZ1BZBokuFHI', '2018-06-22 13:01:07', '2018-06-21', '2018-06-20 13:01:07'),
(5, 'Niakh', 'Daouda', 'niakhdaouda.developper@gmail.com', 'administrateur', '7snhrEE9OGbB4AWbektnUcOTgRO2oV58DUA0VaAF6sX0mY33wo', '2018-06-22 14:05:39', '2020-12-31', '2018-06-20 14:05:39'),
(6, 'Sall', 'Aliou', 'aliouibnibrahim@yahoo.fr', 'administrateur', 'OeiDeKNxZs2J7gkcIcIARtFjzSaos0uWb5Q6W89M48bZONZBxZ', '2018-06-22 15:45:12', '2030-01-01', '2018-06-20 15:45:12'),
(7, 'Niakh', 'Daouda', 'niakhdaouda.developper@gmail.com', 'administrateur', 'FCUlnm1SdAt6BGbYaA3EDNzraVEkDHl9UrZMaFSCn9TQjQjgHp', '2018-06-23 10:27:02', '2018-06-21', '2018-06-21 10:27:02');

-- --------------------------------------------------------

--
-- Structure de la table `_paramettres`
--

CREATE TABLE `_paramettres` (
  `param_name` varchar(255) NOT NULL,
  `param_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `_paramettres`
--

INSERT INTO `_paramettres` (`param_name`, `param_value`) VALUES
('idLastProjetLoaded', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`classe_id`),
  ADD KEY `fk_Classe_Formation` (`formation_id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`compte_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`compte_typeCompte`);

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
  ADD UNIQUE KEY `projet_id` (`projet_id`,`groupe_specialite`);

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
  ADD PRIMARY KEY (`projet_id`),
  ADD UNIQUE KEY `projet_nom` (`projet_nom`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `classe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `compte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `ec`
--
ALTER TABLE `ec`
  MODIFY `ec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `formation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `groupe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `invariant`
--
ALTER TABLE `invariant`
  MODIFY `invariant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `livret`
--
ALTER TABLE `livret`
  MODIFY `livret_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `projet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ue`
--
ALTER TABLE `ue`
  MODIFY `ue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs_temporaires`
--
ALTER TABLE `utilisateurs_temporaires`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `fk_Classe_Formation` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`formation_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
