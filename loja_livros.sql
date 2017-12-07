-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: loja
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(13) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `edicao` varchar(50) DEFAULT NULL,
  `descricao` text,
  `qtd` int(10) unsigned NOT NULL,
  `preco` double NOT NULL,
  `numeroPaginas` int(10) unsigned NOT NULL,
  `editora` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (1,'1478529631451','Desenvolvendo Websites PHP','Aprenda a criar Websites dinâmicos e interativos com PHP e banco de dados.','Juliano Nieerauer','3° edição','Desenvolvendo Websites com PHP apresenta técnicas de programação fundamentais oara o desenvolvimento de sites dinâmicos e interativos. Você arenderá a desenvolver sites com uma linguagem utilizadad em milhões de sites no mundo.',14,62.2,342,'Novatec','livro-php-juliano-niederauer.jpeg'),(2,'7859631247012','Desenvolvendo um sistema Web com PHP do começo ao Fim Com Mysql, HTML5 e Bootstrap Framework','','Jõao Rubens Marchete Filho','1° edição','O PHP (Hypertext Preprocessor) é uma linguagem utilizada para o desenvolvimento de aplicações para a Web. É de fácil utilização e possui grande diversidade de recursos. A linguagem permite a criação de páginas dinâmicas e rápidas.',5,30,245,'Editora Viena','livro-php-joao-rubens.jpeg'),(3,'9874589365214','Gimp descomplicado','Como criar Editar sem se complicar','Guilherme RazGriz','1° edição','Tratar imagens é uma técnica cada vez mais utilizada para atrair a atenção das pessoas. O gimp é muito mais do que a última palavra no tocante à edição e criações de imagens bitmap das ferramentas de código aberto; ela possui a capacidade de adptar ao gosto de seus usuários, permitindo a presonalização da sua interface!',2,20.2,320,'Editora Viena','livro-gimp-raz-griz.jpeg'),(4,'1023658974562','O cérebro com foco e disciplina','','Renato alves','8° edição','Transforme seu cotidiano com mais produtividade e desenvolva o autocontrole para resultados extraordinários.',22,15.2,342,'Editora Gente','livro-renato-alves-cerebro-foco-disciplina.jpeg');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-06 22:18:59
