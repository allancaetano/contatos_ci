CREATE DATABASE  IF NOT EXISTS `php_mysql` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `php_mysql`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: php_mysql
-- ------------------------------------------------------
-- Server version	5.6.28

--
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS contatos;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE contatos (
    id int(11) NOT NULL AUTO_INCREMENT,
    nome varchar(20) CHARACTER SET latin1 NOT NULL,
    telefone varchar(20) CHARACTER SET latin1 DEFAULT NULL,
    email varchar(50) CHARACTER SET latin1 DEFAULT NULL,
    nascimento date DEFAULT NULL,
    favorito tinyint(1) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `anexos_contatos`
--

DROP TABLE IF EXISTS anexos_contatos;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE anexos_contatos (
    id int(11) NOT NULL AUTO_INCREMENT,
    contato_id int(11) NOT NULL,
    nome varchar(255) NOT NULL,
    arquivo varchar(255) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT contato_id FOREIGN KEY (contato_id) REFERENCES contatos (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Dump completed
