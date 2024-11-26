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
-- Table structure for table `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_receta` int NOT NULL,
  `ingrediente` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ingredientes_ibfk_1` (`id_receta`),
  CONSTRAINT `ingredientes_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredientes`
--

LOCK TABLES `ingredientes` WRITE;
/*!40000 ALTER TABLE `ingredientes` DISABLE KEYS */;
INSERT INTO `ingredientes` VALUES (144,33,'Manzanas'),(145,33,'Harina'),(146,33,'Azúcar'),(147,33,'Mantequilla'),(152,35,'Harina de trigo'),(153,35,'Tomates'),(154,35,'Queso mozzarella'),(155,35,'Albahaca'),(156,36,'Chocolate amargo'),(157,36,'Harina'),(158,36,'Huevos'),(159,36,'Mantequilla'),(160,37,'Tomates'),(161,37,'Cebolla'),(162,37,'Ajo'),(163,37,'Caldo de pollo'),(164,38,'Pollo'),(165,38,'Leche de coco'),(166,38,'Especias de curry'),(167,38,'Cebolla'),(168,39,'Pasta fettuccine'),(169,39,'Mantequilla'),(170,39,'Crema'),(171,39,'Queso parmesano'),(172,40,'Harina de trigo'),(173,40,'Huevos'),(174,40,'Leche'),(175,40,'Azúcar'),(176,41,'Tortillas de maíz'),(177,41,'Carne molida'),(178,41,'Tomates'),(179,41,'Queso cheddar'),(180,42,'Manzana'),(181,42,'Plátano'),(182,42,'Fresas'),(183,42,'Naranja'),(184,43,'Arroz Arborio'),(185,43,'Champiñones'),(186,43,'Caldo de verduras'),(187,43,'Vino blanco'),(208,33,'prueba de ingrediente');
/*!40000 ALTER TABLE `ingredientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'001_create_receta.sql','2024-11-22 21:33:49');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasos`
--

DROP TABLE IF EXISTS `pasos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_receta` int NOT NULL,
  `numero_paso` int NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pasos_ibfk_1` (`id_receta`),
  CONSTRAINT `pasos_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasos`
--

LOCK TABLES `pasos` WRITE;
/*!40000 ALTER TABLE `pasos` DISABLE KEYS */;
INSERT INTO `pasos` VALUES (81,33,1,'Pelar y cortar las manzanas en rodajas finas.'),(82,33,2,'Mezclar la harina, azúcar y mantequilla para formar la masa.'),(83,33,3,'Extender la masa en un molde y colocar las manzanas encima.'),(84,33,4,'Hornear a 180 grados durante 40 minutos.'),(89,35,1,'Preparar la masa para la pizza y dejar reposar.'),(90,35,2,'Extender la masa y añadir la salsa de tomate.'),(91,35,3,'Cubrir con queso mozzarella y albahaca.'),(92,35,4,'Hornear a 220 grados durante 15 minutos.'),(93,36,1,'Derretir el chocolate y la mantequilla a baño María.'),(94,36,2,'Mezclar los ingredientes secos en un bol.'),(95,36,3,'Añadir los huevos y la mezcla de chocolate.'),(96,36,4,'Hornear a 180 grados durante 25 minutos.'),(97,37,1,'Cortar los tomates, cebolla y ajo.'),(98,37,2,'Sofreír la cebolla y el ajo en aceite.'),(99,37,3,'Añadir los tomates y el caldo de pollo.'),(100,37,4,'Cocinar a fuego lento durante 20 minutos.'),(101,38,1,'Cortar el pollo en trozos pequeños.'),(102,38,2,'Freír el pollo con las especias de curry.'),(103,38,3,'Añadir leche de coco y cebolla picada.'),(104,38,4,'Cocinar hasta que la salsa espese.'),(105,39,1,'Cocinar la pasta hasta que esté al dente.'),(106,39,2,'Derretir la mantequilla en una sartén.'),(107,39,3,'Añadir la crema y queso parmesano.'),(108,39,4,'Mezclar la pasta con la salsa Alfredo.'),(109,40,1,'Mezclar harina, huevos, leche y azúcar.'),(110,40,2,'Cocinar los panqueques en una sartén caliente.'),(111,40,3,'Servir con miel o jarabe de maple.'),(112,41,1,'Cocinar la carne molida con especias.'),(113,41,2,'Preparar las tortillas y añadir el relleno.'),(114,41,3,'Cubrir con queso cheddar y servir.'),(115,42,1,'Lavar y cortar todas las frutas en trozos pequeños.'),(116,42,2,'Mezclar en un bol grande.'),(117,42,3,'Servir frío con un poco de miel.'),(118,43,1,'Sofreír los champiñones en mantequilla.'),(119,43,2,'Añadir el arroz Arborio y vino blanco.'),(120,43,3,'Cocinar lentamente añadiendo el caldo poco a poco.'),(121,43,4,'Servir con queso parmesano rallado.'),(143,33,4,'Prueba paso');
/*!40000 ALTER TABLE `pasos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `password_reset_ibfk_1` (`email`),
  CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset`
--

LOCK TABLES `password_reset` WRITE;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
INSERT INTO `password_reset` VALUES (5,'wigudunibalera@gmail.com','$2y$10$m1BYx7kuePcK6lqiCl0hX.JLC3FxkEjUfoxvwE8xHxtQ8UTQz4EW2','2024-11-23 04:24:26');
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recetas`
--

DROP TABLE IF EXISTS `recetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recetas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `categoria` varchar(50) DEFAULT NULL,
  `tiempo_preparacion` int DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recetas`
--

LOCK TABLES `recetas` WRITE;
/*!40000 ALTER TABLE `recetas` DISABLE KEYS */;
INSERT INTO `recetas` VALUES (33,42,'Tarta de Manzana','Una receta deliciosa y sencilla para una tarta de manzana.','Postre',60,'img_67454bc41584a6.62120090.JPG','2024-11-24 16:33:06'),(35,42,'Pizza Margherita','Una receta clásica de pizza italiana.','Pizza',30,'img_67441b1a833a48.80508387.jpeg','2024-11-24 16:38:03'),(36,42,'Brownies de Chocolate','Deliciosos brownies húmedos con chocolate.','Postre',40,'img_67441b4158cab9.34076149.jpg','2024-11-24 16:38:03'),(37,42,'Sopa de Tomate','Sopa reconfortante hecha con tomates frescos.','Sopa',25,'img_67441bcbdf84d7.84487281.JPG','2024-11-24 16:38:03'),(38,42,'Pollo al Curry','Pollo al curry con especias tradicionales.','Plato Principal',50,'img_67441c0344f501.16627902.jpg','2024-11-24 16:38:03'),(39,42,'Pasta Alfredo','Pasta cremosa con salsa Alfredo.','Pasta',20,'img_67456e5a54f4b0.23248447.jpg','2024-11-24 16:38:03'),(40,42,'Panqueques','Panqueques esponjosos ideales para el desayuno.','Desayuno',15,'img_67456e1952c076.15452078.jpg','2024-11-24 16:38:03'),(41,42,'Tacos de Carne','Tacos rellenos de carne sazonada y frescos ingredientes.','Mexicano',25,'img_67456e87b9fde3.17099102.jpg','2024-11-24 16:38:03'),(42,42,'Ensalada de Frutas','Refrescante ensalada de frutas de temporada.','Ensalada',10,'img_67456ec192c611.35274329.jpeg','2024-11-24 16:38:03'),(43,42,'Risotto de Champiñones','Risotto cremoso con champiñones frescos.','Plato Principal',35,'img_67456ee90cf645.49480757.jpg','2024-11-24 16:38:03');
/*!40000 ALTER TABLE `recetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (42,'Wigudunibaler.arias','wigudunibalera@gmail.com','$2y$10$N3.N5GQQsG4WiCHmoOqKzOKjU1MkE12hoCmdlhjVaAOdN8Zca4QUW',NULL,'2024-11-23 03:42:38'),(44,'testRecuperacion','yegelo3190@exoular.com','$2y$10$gSTpFVhnqWgsju0TRA8jh.Igz6piDF.a/hCx30vfsmIti2HyVUgx6',NULL,'2024-11-23 04:36:31');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-26 14:07:52
