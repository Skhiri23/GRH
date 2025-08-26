-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 30 mai 2024 à 17:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `aziz_db`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_monthly_values` ()   BEGIN
    UPDATE paiement_employee AS current_month
    LEFT JOIN paiement_employee AS previous_month ON current_month.cin = previous_month.cin 
        AND MONTH(current_month.mois) = MONTH(previous_month.mois) + 1
    SET current_month.total_deductions = COALESCE(previous_month.total_deductions, 0),
        current_month.total_primes = COALESCE(previous_month.total_primes, 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_post_status` ()   BEGIN
    UPDATE posts
    SET statut_poste = 'Inactif'
    WHERE date_limite < CURDATE() AND statut_poste != 'Inactif';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `statut` varchar(255) DEFAULT 'en attente',
  `resume` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id`, `post_id`, `firstname`, `lastname`, `email`, `gender`, `phone`, `start_date`, `address`, `cover_letter`, `statut`, `resume`, `submission_date`, `password`) VALUES
(40, NULL, 'Mohamed aziz', 'skhiri', 'aziz@gmail.com', 'homme', '52237532', '0000-00-00', 'nahj washinton skanes mechref', NULL, 'accepté', NULL, '2024-05-29 21:49:25', 'aziz1234'),
(41, NULL, 'Mohame', 'skhiri', 'aziz22@gmail.com', 'homme', '577', '0000-00-00', 'azzz', NULL, 'pending', NULL, '2024-05-29 21:51:16', 'aziz1234');

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `poste` varchar(255) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `jours_pris` int(11) DEFAULT 0,
  `cin` varchar(255) DEFAULT NULL,
  `statut` enum('en attente','accepté','refusé') NOT NULL DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id`, `nom`, `departement`, `poste`, `dateDebut`, `dateFin`, `jours_pris`, `cin`, `statut`) VALUES
(44, 'Skhiri', 'infra_reseaux', 'Administrateur système', '2024-05-30', '2024-05-31', 2, '04761919', 'accepté'),
(45, ' skhiri Karim', 'conception_ux_ui', 'Designer UX/UI', '2024-05-24', '2024-06-09', 17, '14037318', 'accepté'),
(46, ' hahzdoiazj kzdfjlokaej', 'infra_reseaux', 'Administrateur système', '2024-06-02', '2024-06-08', 7, '1456987', 'accepté'),
(51, 'Skhiri t', 'infra_reseaux', 'Consultant en infrastructure', '2024-05-31', '2024-06-01', 2, '04761919', 'en attente'),
(52, 'Skhiri t', 'infra_reseaux', 'Consultant en infrastructure', '2024-05-31', '2024-06-01', 2, '04761919', 'accepté'),
(53, 'Skhiri t', 'infra_reseaux', 'Consultant en infrastructure', '2024-05-31', '2024-06-01', 2, '04761919', 'refusé'),
(54, 'Skhiri t', 'infra_reseaux', 'Consultant en infrastructure', '2024-05-31', '2024-06-02', 3, '04761919', 'accepté'),
(55, 'Skhiri t', 'infra_reseaux', 'Consultant en infrastructure', '2024-06-02', '2024-06-09', 8, '04761919', 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(6) UNSIGNED NOT NULL,
  `cin` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `civility` varchar(255) DEFAULT NULL,
  `children` int(2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `departement` varchar(255) DEFAULT NULL,
  `poste` varchar(255) DEFAULT NULL,
  `type_contrat` varchar(255) DEFAULT NULL,
  `salaire` varchar(50) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `typeContrat` varchar(255) DEFAULT NULL,
  `horaire` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numcarte` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `paswrd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `cin`, `nom`, `prenom`, `email`, `gender`, `age`, `telephone`, `nationality`, `civility`, `children`, `image`, `departement`, `poste`, `type_contrat`, `salaire`, `dateDebut`, `dateFin`, `typeContrat`, `horaire`, `reg_date`, `numcarte`, `username`, `paswrd`) VALUES
(18, '14037318', 'skhiri', 'Karim', 'Karim23@gmail.com', 'h', 22, '52237532', '0', '0', 5, '', 'conception_ux_ui', 'Intégrateur web', 'CDI', '1500', '2024-05-24', '2024-10-26', '5 jours par semaine', '10h00 à 18h00', '2024-05-24 07:59:18', '2136 2154 2365 5235', 'Karim23@gmail.com', 'karim1234'),
(19, '04761919', 'Skhiri', 't', 'tareksk23@gmail.com', 'h', 55, '22940115', '0', '0', 2, 'aa', 'infra_reseaux', 'Consultant en infrastructure', 'CDD', '2500', '2024-05-24', '2027-05-23', '5 jours par semaine', '10h00 à 18h00', '2024-05-24 07:55:42', '2013036589742156', 'aziz', 'aziz'),
(41, '14725836', 'Skhiri', 'Tarek', 'TT@gmail.com', 'h', 55, '3454354', 'Luxembourgeoise', '0', 2, 'aa', 'Ressource_Humaine', 'Agent RH', 'CDD', '1500', '2024-05-24', '2024-06-08', '5 jours par semaine', '8h00 à 16h00 ', '2024-05-24 08:00:26', '3544354454654', 'admin', 'admin'),
(42, '1456987', 'hahzdoiazj', 'kzdfjlokaej', 'kjdzfjef@gmail', 'h', 22, '55', 'Afghanistan', '0', 0, 'aa', 'infra_reseaux', 'Technicien support', 'Stage', '352135', '2024-04-23', '2025-04-23', '5 jours par semaine', '8h00 à 16h00 ', '2024-05-27 16:28:21', '5235465²', 'tenin', 'tenin'),
(43, '', 'uazgdiuaz', 'aziz', '', 'f', 0, '', 'Afghanistan', '', 0, 'aa', 'recherche_developpement', 'Chercheur', 'CDI', '', '0000-00-00', '0000-00-00', '5 jours par semaine', '8h00 à 16h00 ', '2024-05-28 14:41:41', '', 'zTojSTLn', 'o6f5RVRY');

--
-- Déclencheurs `employe`
--
DELIMITER $$
CREATE TRIGGER `add_employee_to_paiement_employee` AFTER INSERT ON `employe` FOR EACH ROW BEGIN
    INSERT INTO paiement_employee (cin, nom, salaire, total_deductions, total_primes, total_net, mois)
    VALUES (NEW.cin, NEW.nom, NEW.salaire, NULL, NULL, NULL, MONTH(CURRENT_DATE()));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_employee_from_paiement_employee` AFTER DELETE ON `employe` FOR EACH ROW BEGIN
    DELETE FROM paiement_employee WHERE cin = OLD.cin;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `employe_after_delete` AFTER DELETE ON `employe` FOR EACH ROW BEGIN
    DELETE FROM paiement_employee
    WHERE cin = OLD.cin;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `employe_after_insert` AFTER INSERT ON `employe` FOR EACH ROW BEGIN
    DECLARE record_count INT;

    SELECT COUNT(*)
    INTO record_count
    FROM paiement_employee
    WHERE cin = NEW.cin;

    IF record_count = 0 THEN
        INSERT INTO paiement_employee (cin, nom, prenom_employee, salaire, mois)
        VALUES (NEW.cin, NEW.nom, NEW.prenom, NEW.salaire, MONTH(CURRENT_DATE));
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `employe_after_update` AFTER UPDATE ON `employe` FOR EACH ROW BEGIN
    UPDATE paiement_employee
    SET nom = NEW.nom,
        prenom_employee = NEW.prenom,
        salaire = NEW.salaire,
        mois = MONTH(CURRENT_DATE)
    WHERE cin = OLD.cin;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_prenom_employee` AFTER INSERT ON `employe` FOR EACH ROW BEGIN
    UPDATE paiement_employee
    SET prenom_employee = NEW.prenom
    WHERE cin = NEW.cin;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_prenom_employee_after_delete` AFTER DELETE ON `employe` FOR EACH ROW BEGIN
    DELETE FROM paiement_employee
    WHERE cin = OLD.cin;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_prenom_employee_after_update` AFTER UPDATE ON `employe` FOR EACH ROW BEGIN
    UPDATE paiement_employee
    SET prenom_employee = NEW.prenom
    WHERE cin = NEW.cin;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int(11) NOT NULL,
  `Titre_Formation` varchar(255) NOT NULL,
  `Formateur` varchar(255) NOT NULL,
  `Date_Debut` date NOT NULL,
  `Durée` varchar(50) NOT NULL,
  `Lieu` varchar(255) NOT NULL,
  `Statut_inscription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `Titre_Formation`, `Formateur`, `Date_Debut`, `Durée`, `Lieu`, `Statut_inscription`) VALUES
(4, 'Formation Python', 'majdi afandi', '2024-05-25', '200 heure', ' Centre de formation majdi Monastir 5000 ', 'En attente'),
(5, 'java', 'Skhiri Karim', '2024-06-01', '10 heure ', 'au sein de societé', 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` int(11) NOT NULL,
  `formation_id` int(11) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `statut` varchar(20) DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `formation_id`, `nom`, `prenom`, `email`, `statut`) VALUES
(38, 4, 'Skhiri', 't', 'tareksk23@gmail.com', 'refusé'),
(39, 5, 'Skhiri', 't', 'tareksk23@gmail.com', 'accepté');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `scope` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `departement` varchar(50) DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `employe` int(11) DEFAULT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `sender_id` int(11) DEFAULT NULL,
  `marquer_comme_lu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `scope`, `message`, `departement`, `poste`, `employe`, `sender_name`, `date_sent`, `sender_id`, `marquer_comme_lu`) VALUES
(51, 'all', 'hi', '', '', 0, 'Skhiri Tarek', '2024-05-30 14:49:55', 41, 0),
(52, 'department', 'wagwan', 'Ressource_Humaine', '', 0, 'Skhiri t', '2024-05-30 14:50:22', 19, 0),
(53, 'post', 'aaaa', 'infra_reseaux', 'Consultant en infrastructure', 0, 'Skhiri Tarek', '2024-05-30 14:50:40', 41, 0),
(55, NULL, 'Un utilisateur a postulé pour le poste 6.', NULL, NULL, 1, NULL, '2024-05-30 14:54:57', NULL, 0),
(56, NULL, 'Un utilisateur a postulé pour le poste 4.', NULL, NULL, 1, NULL, '2024-05-30 14:57:50', NULL, 0),
(57, NULL, 'Un utilisateur a postulé pour le poste 6.', NULL, NULL, 1, NULL, '2024-05-30 14:58:05', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_employee`
--

CREATE TABLE `paiement_employee` (
  `id` int(11) NOT NULL,
  `cin` varchar(20) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom_employee` varchar(50) DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `total_deductions` decimal(10,2) DEFAULT 0.00,
  `total_primes` decimal(10,2) DEFAULT 0.00,
  `mois` int(11) DEFAULT month(curdate()),
  `total_net` decimal(10,2) GENERATED ALWAYS AS (`salaire` + `total_primes` - `total_deductions`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement_employee`
--

INSERT INTO `paiement_employee` (`id`, `cin`, `nom`, `prenom_employee`, `salaire`, `total_deductions`, `total_primes`, `mois`) VALUES
(1, '14037318', 'skhiri', 'Karim', 1500.00, 0.00, 0.00, 5),
(2, '04761919', 'Skhiri', 't', 2500.00, 0.00, 0.00, 5),
(3, '14037318', 'skhiri', 'Karim', 1500.00, 5.00, 1000.00, 5),
(12, '14725836', 'Skhiri', 'Tarek', 1500.00, 0.00, 5000.00, 5),
(13, '1456987', 'hahzdoiazj', 'kzdfjlokaej', 352135.00, 0.00, 0.00, 5),
(14, '', 'uazgdiuaz', 'aziz', 0.00, 0.00, 0.00, 5);

--
-- Déclencheurs `paiement_employee`
--
DELIMITER $$
CREATE TRIGGER `paiement_employee_before_update` BEFORE UPDATE ON `paiement_employee` FOR EACH ROW BEGIN
    IF NEW.salaire IS NULL THEN
        SET NEW.salaire = 0;
    END IF;
    
    IF NEW.total_primes IS NULL THEN
        SET NEW.total_primes = 0;
    END IF;
    
    IF NEW.total_deductions IS NULL THEN
        SET NEW.total_deductions = 0;
    END IF;

    SET NEW.total_net = COALESCE(NEW.salaire, 0) + COALESCE(NEW.total_primes, 0) - COALESCE(NEW.total_deductions, 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titre_poste` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_limite` date DEFAULT NULL,
  `statut_poste` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `titre_poste`, `description`, `date_limite`, `statut_poste`) VALUES
(4, 'Full Stack Engineer ', 'Crafting a compelling job description is essential to helping you attract the most qualified candidates for your job. With more than 25 million jobs listed on Indeed, a great job description can help your jobs stand out from the rest. Your job descriptions are where you start marketing your company and your job to your future hire.\\\\r\\\\n\\\\r\\\\nThe key to writing effective job descriptions is to find the perfect balance between providing enough detail so candidates understand the role and your company while keeping your description concise.\\\\r\\\\n\\\\r\\\\nUse the tips and sample job descriptions below to create a compelling job listing.', '2024-06-01', 'Actif'),
(5, 'developper java ', 'azfdeeeeeeeeeeeeeeeeee', '2024-06-16', 'Inactif'),
(6, 'Full Stack Engineer ', '', '2024-06-01', 'Actif');

-- --------------------------------------------------------

--
-- Structure de la table `user_post_candidature`
--

CREATE TABLE `user_post_candidature` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_post_candidature`
--

INSERT INTO `user_post_candidature` (`id`, `user_id`, `post_id`, `status`) VALUES
(15, 41, 4, 'accepted'),
(16, 40, 4, 'rejected'),
(17, 40, 6, 'rejected');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formation_id` (`formation_id`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement_employee`
--
ALTER TABLE `paiement_employee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_post_candidature`
--
ALTER TABLE `user_post_candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `paiement_employee`
--
ALTER TABLE `paiement_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user_post_candidature`
--
ALTER TABLE `user_post_candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);

--
-- Contraintes pour la table `user_post_candidature`
--
ALTER TABLE `user_post_candidature`
  ADD CONSTRAINT `user_post_candidature_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `candidature` (`id`),
  ADD CONSTRAINT `user_post_candidature_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
