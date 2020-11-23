-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 13 nov. 2020 à 14:08
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
CREATE DATABASE IF NOT EXISTS `projetgroupephp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projetgroupephp`;

-- --------------------------------------------------------

--
-- Structure de la table `chat_message`
--

CREATE TABLE IF NOT EXISTS `chat_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sent_date` datetime NOT NULL,
  `content` varchar(2000) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_chatmessage_chatthread_chatid` (`chat_id`),
  KEY `fk_chatmessage_user_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chat_thread`
--

CREATE TABLE IF NOT EXISTS `chat_thread` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_chatthread_poll_pollid` (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `friendship_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  PRIMARY KEY (`friendship_id`),
  KEY `fk_friendship_user_userid` (`user_id`),
  KEY `fk_friendship_user_friendid` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `deadline` datetime NOT NULL,
  PRIMARY KEY (`poll_id`),
  KEY `fk_poll_user_creatorid` (`creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `poll_answer`
--

CREATE TABLE IF NOT EXISTS `poll_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `fk_pollanswer_poll_pollid` (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  'isActive' BOOLEAN NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `index_username` (`username`),
  UNIQUE KEY `index_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

CREATE TABLE IF NOT EXISTS `user_answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''ID de la réponse',
  `user_id` int(11) NOT NULL COMMENT 'L''ID de l''utilisateur ayant fourni cette réponse',
  `poll_answer_id` int(11) NOT NULL COMMENT 'L''ID de la question à laquelle l''utilisateur a répondu',
  PRIMARY KEY (`answer_id`),
  KEY `fk_useranswer_pollanswer_pollanswerid` (`poll_answer_id`),
  KEY `fk_useranswer_user_userid` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
