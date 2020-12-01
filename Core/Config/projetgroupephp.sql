-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 01 déc. 2020 à 16:51
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetgroupephp`
--
DROP DATABASE IF EXISTS `projetgroupephp`;
CREATE DATABASE IF NOT EXISTS `projetgroupephp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projetgroupephp`;

-- --------------------------------------------------------

--
-- Structure de la table `chat_message`
--

DROP TABLE IF EXISTS `chat_message`;
CREATE TABLE `chat_message` (
  `message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `content` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chat_thread`
--

DROP TABLE IF EXISTS `chat_thread`;
CREATE TABLE `chat_thread` (
  `chat_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friendship`
--

DROP TABLE IF EXISTS `friendship`;
CREATE TABLE `friendship` (
  `friendship_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `poll`
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE `poll` (
  `poll_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `poll_answer`
--

DROP TABLE IF EXISTS `poll_answer`;
CREATE TABLE `poll_answer` (
  `answer_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `is_correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE `user_answer` (
  `answer_id` int(11) NOT NULL COMMENT 'L''ID de la réponse',
  `user_id` int(11) NOT NULL COMMENT 'L''ID de l''utilisateur ayant fourni cette réponse',
  `poll_answer_id` int(11) NOT NULL COMMENT 'L''ID de la question à laquelle l''utilisateur a répondu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `fk_chatmessage_chatthread_chatid` (`chat_id`),
  ADD KEY `fk_chatmessage_user_userid` (`user_id`);

--
-- Index pour la table `chat_thread`
--
ALTER TABLE `chat_thread`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `fk_chatthread_poll_pollid` (`poll_id`);

--
-- Index pour la table `friendship`
--
ALTER TABLE `friendship`
  ADD PRIMARY KEY (`friendship_id`),
  ADD UNIQUE KEY `unique_userid_friendid` (`user_id`,`friend_id`) USING BTREE,
  ADD KEY `fk_friendship_user_friendid` (`friend_id`);

--
-- Index pour la table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`poll_id`),
  ADD KEY `fk_poll_user_creatorid` (`creator_id`);

--
-- Index pour la table `poll_answer`
--
ALTER TABLE `poll_answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_pollanswer_poll_pollid` (`poll_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `index_username` (`username`),
  ADD UNIQUE KEY `index_email` (`email`);

--
-- Index pour la table `user_answer`
--
ALTER TABLE `user_answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_useranswer_pollanswer_pollanswerid` (`poll_answer_id`),
  ADD KEY `fk_useranswer_user_userid` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat_thread`
--
ALTER TABLE `chat_thread`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `friendship`
--
ALTER TABLE `friendship`
  MODIFY `friendship_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poll`
--
ALTER TABLE `poll`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poll_answer`
--
ALTER TABLE `poll_answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_answer`
--
ALTER TABLE `user_answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''ID de la réponse';

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `fk_chatmessage_chatthread_chatid` FOREIGN KEY (`chat_id`) REFERENCES `chat_thread` (`chat_id`),
  ADD CONSTRAINT `fk_chatmessage_user_userid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `chat_thread`
--
ALTER TABLE `chat_thread`
  ADD CONSTRAINT `fk_chatthread_poll_pollid` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`poll_id`);

--
-- Contraintes pour la table `friendship`
--
ALTER TABLE `friendship`
  ADD CONSTRAINT `fk_friendship_user_friendid` FOREIGN KEY (`friend_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `fk_friendship_user_userid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `fk_poll_user_creatorid` FOREIGN KEY (`creator_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `poll_answer`
--
ALTER TABLE `poll_answer`
  ADD CONSTRAINT `fk_pollanswer_poll_pollid` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`poll_id`);

--
-- Contraintes pour la table `user_answer`
--
ALTER TABLE `user_answer`
  ADD CONSTRAINT `fk_useranswer_pollanswer_pollanswerid` FOREIGN KEY (`poll_answer_id`) REFERENCES `poll_answer` (`answer_id`),
  ADD CONSTRAINT `fk_useranswer_user_userid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
