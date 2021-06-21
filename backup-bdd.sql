-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 12 juin 2021 à 17:46
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données : `dossier_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `champ`
--

CREATE TABLE `champ` (
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typechamp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `parametres` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `champ`
--

INSERT INTO `champ` (`nom`, `typechamp`, `parametres`) VALUES
('couleur', 'image', 'a:4:{i:0;s:8:\"bleu.png\";i:1;s:8:\"vert.png\";i:2;s:9:\"rouge.png\";i:3;s:9:\"jaune.png\";}'),
('multiplication', 'number', 'a:3:{i:0;s:1:\"1\";i:1;s:2:\"13\";i:2;s:1:\"1\";}'),
('nom', 'text', 'a:4:{i:0;s:6:\"Dupond\";i:1;s:6:\"Durand\";i:2;s:5:\"Sagot\";i:3;s:10:\"Thiernesse\";}'),
('temperature', 'number', 'a:3:{i:0;s:2:\"25\";i:1;s:2:\"41\";i:2;s:3:\"0.1\";}');

-- --------------------------------------------------------

--
-- Structure de la table `enonce`
--

CREATE TABLE `enonce` (
  `idEnonce` int(11) NOT NULL,
  `contenu` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `enonce`
--

INSERT INTO `enonce` (`idEnonce`, `contenu`) VALUES
(11, '<h1>Météo</h1><div><br>Aujourd\'hui, nous accueillons monsieur <strong>##nom##</strong> qui va nous présenter la météo de la semaine.<br>Lundi ##temperature##°C,<br>Mardi ##temperature##°C,<br>Mercredi <del>##temperature##°C</del> ah non désolé, <em>c\'est ##temperature##°C<br></em><strong><em><del>Jeudi STOPPP</del></em></strong><br>Nous en avons fini.&nbsp;<br><br></div><blockquote>Au revoir</blockquote><div><br></div><pre>stopEmission();</pre>'),
(12, '<h1>Couleur</h1><div>Quelle est la couleur de l\'image ?<br><br>##couleur##</div>'),
(13, '<h1>Professeur Web</h1><div><br>Monsieur <strong>##nom## </strong>est-il votre professeur de <strong>programmation web</strong> ?<br><br></div><pre>&lt;!DOCTYPE <em>html</em>&gt;\r\n&lt;html <em>lang</em>=\"fr\"&gt; &lt;!-- l\'attribut lang=\"en\" pour l\'anglais --&gt;\r\n...\r\n&lt;/html&gt;</pre>'),
(17, '<h1>Table de multiplication</h1><div><br>Table de 4<br>4 * ##multiplication## = ?<br>4 * ##multiplication## = ?<br>4 * ##multiplication## = ?<br>4 * ##multiplication## = ?<br>4 * ##multi## = ?</div>');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `champ`
--
ALTER TABLE `champ`
  ADD PRIMARY KEY (`nom`),
  ADD KEY `idx_type` (`typechamp`);

--
-- Index pour la table `enonce`
--
ALTER TABLE `enonce`
  ADD PRIMARY KEY (`idEnonce`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enonce`
--
ALTER TABLE `enonce`
  MODIFY `idEnonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
