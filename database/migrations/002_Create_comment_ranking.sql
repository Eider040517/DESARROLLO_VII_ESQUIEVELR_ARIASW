CREATE DATABASE  IF NOT EXISTS `receta_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `receta_db`;
-- MySQL dump 10.13  Distrib 8.0.40, for macos14 (arm64)
--
-- Host: 127.0.0.1    Database: receta_db
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `recipe_comments`
--

DROP TABLE IF EXISTS `recipe_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_receta` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_receta` (`id_receta`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recipe_comments_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipe_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_comments`
--

LOCK TABLES `recipe_comments` WRITE;
/*!40000 ALTER TABLE `recipe_comments` DISABLE KEYS */;
INSERT INTO `recipe_comments` VALUES (1,41,44,'prueba de comentario','2024-11-27 01:48:50'),(2,41,44,'prueba de comentario','2024-11-27 01:56:09'),(3,41,44,'prueba de comentario 2','2024-11-27 01:59:30'),(4,41,44,'Me gusto mucho este taco','2024-11-27 02:56:21'),(5,41,42,'tambien me gusto mucho esta comida','2024-11-27 03:16:03'),(6,33,42,'hola&#13;&#10;','2024-11-27 03:20:41'),(7,33,42,'  ','2024-11-27 03:20:52'),(8,33,42,'hola ','2024-11-27 03:20:58'),(9,33,42,'hola Ñ','2024-11-27 03:21:07');
/*!40000 ALTER TABLE `recipe_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ratings`
--

DROP TABLE IF EXISTS `recipe_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `id_receta` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rating_id`),
  UNIQUE KEY `id_receta` (`id_receta`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recipe_ratings_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipe_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `recipe_ratings_chk_1` CHECK ((`rating` between 1 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ratings`
--

LOCK TABLES `recipe_ratings` WRITE;
/*!40000 ALTER TABLE `recipe_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_ratings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27 14:08:04
