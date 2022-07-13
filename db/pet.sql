-- MySQL dump 10.16  Distrib 10.1.10-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: pet
-- ------------------------------------------------------
-- Server version	10.1.10-MariaDB

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
-- Current Database: `pet`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pet`;

--
-- Table structure for table `atividades`
--

DROP TABLE IF EXISTS `atividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividades`
--

LOCK TABLES `atividades` WRITE;
/*!40000 ALTER TABLE `atividades` DISABLE KEYS */;
INSERT INTO `atividades` VALUES (4,'Laboratório','Sim'),(5,'Clinica','Sim');
/*!40000 ALTER TABLE `atividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cartoes`
--

DROP TABLE IF EXISTS `cartoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartoes` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('Cartão de Crédito','Cartão de Débito') NOT NULL,
  `numero` decimal(24,0) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dt_expiracao` date NOT NULL,
  `cvv` decimal(3,0) DEFAULT NULL,
  `bandeira` enum('Visa','Master Card','Elo','American Express') DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `ativo` enum('Sim','Não') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_cartao` (`usuario_id`),
  CONSTRAINT `fk_usuario_cartao` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartoes`
--

LOCK TABLES `cartoes` WRITE;
/*!40000 ALTER TABLE `cartoes` DISABLE KEYS */;
INSERT INTO `cartoes` VALUES (8,'Cartão de Crédito',1423569870258746,'matheus de mello','2022-06-24',666,'Visa',5,'Sim');
/*!40000 ALTER TABLE `cartoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `dt_contrato` date NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `status` enum('Aberto','Pago','Cancelado') NOT NULL DEFAULT 'Aberto',
  `dt_fim` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CONTRATOS#PLANOS#ID` (`plano_id`),
  KEY `FK_CONTRATOS#EMPRESA#ID` (`empresa_id`),
  CONSTRAINT `FK_CONTRATOS#EMPRESA#ID` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `FK_CONTRATOS#PLANOS#ID` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `atividade_id` bigint(20) unsigned DEFAULT NULL,
  `razao_social` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_fantasia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt_experiencia` date DEFAULT NULL,
  `ativo` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`),
  KEY `empresas_atividade_id_foreign` (`atividade_id`),
  CONSTRAINT `empresas_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (24,4,'Matheus SA','Matheus Developer ','14180000','Rua Miguel Barrachini','510','Centro','','RP','SP','16991838523','2022-06-15','Sim'),(25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Sim');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enderecos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `principal` enum('Sim','Não') DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_endereco` (`usuario_id`),
  CONSTRAINT `fk_usuario_endereco` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` VALUES (7,'Matheus de Mello','Miguel Barachini','510','Centro','','14180000','SP','Rib P','16991838523','Sim',5,'Sim');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especies`
--

DROP TABLE IF EXISTS `especies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especies`
--

LOCK TABLES `especies` WRITE;
/*!40000 ALTER TABLE `especies` DISABLE KEYS */;
/*!40000 ALTER TABLE `especies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `icone` varchar(100) NOT NULL,
  `ordem` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Agenda Médica','#','Sim','far fa-calendar-alt',1),(2,'Agendamento Online','#','Sim','far fa-calendar-check',2),(3,'Manutenção de Cadastro','#','Sim','far fa-user',3),(4,'Pedido de Exames','#','Sim','far fa-laptop-medical',4),(5,'Prescrição Eletrônica','#','Sim','fal fa-files-medical',5),(6,'Prontuário Eletrônico','#','Sim','fal fa-book',6),(7,'Relatórios','#','Sim','fal fa-chart-line',7);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'Cadastro de Pet','Sim'),(2,'Prontuário Eletrônico','Sim'),(3,'Prescrição Eletrônica','Sim'),(4,'Agenda Médica','Sim'),(5,'Agendamento Online','Sim'),(6,'Pedido de Exames','Sim'),(7,'Relatórios','Sim');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos_menus`
--

DROP TABLE IF EXISTS `modulos_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos_menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `modulo_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_modulos_menus#modulos` (`modulo_id`),
  KEY `FK_modulos_menus#menus#menu_id` (`menu_id`),
  CONSTRAINT `FK_modulos_menus#menus#menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`),
  CONSTRAINT `FK_modulos_menus#modulos` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos_menus`
--

LOCK TABLES `modulos_menus` WRITE;
/*!40000 ALTER TABLE `modulos_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulos_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('main','header','footer','contato','sobre','serviço','plano') NOT NULL,
  `param` varchar(255) NOT NULL,
  `value` varchar(4000) DEFAULT NULL,
  `valueImg` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  `projeto_id` bigint(20) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_param` (`tipo`,`param`),
  KEY `FK_PAGES#PROJETOS#ID` (`projeto_id`),
  CONSTRAINT `FK_PAGES#PROJETOS#ID` FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'footer','teste11','teste1','slider-02.jpg','Não',4,''),(2,'header','teste1','teste1','9791ed6af6b32510f8c2f324afa0c98b.jpg','Sim',3,'');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `dt_nascimento` date NOT NULL,
  `especie_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pets#especies#id` (`especie_id`),
  CONSTRAINT `fk_pets#especies#id` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano`
--

DROP TABLE IF EXISTS `plano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `plano_tipo_id` bigint(11) NOT NULL,
  `projeto_id` bigint(11) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plano#projetos#projeto_id` (`projeto_id`),
  KEY `FK_plano#plano_tipos#plano_tipo_id` (`plano_tipo_id`),
  CONSTRAINT `FK_plano#plano_tipos#plano_tipo_id` FOREIGN KEY (`plano_tipo_id`) REFERENCES `plano_tipos` (`id`),
  CONSTRAINT `FK_plano#projetos#projeto_id` FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano`
--

LOCK TABLES `plano` WRITE;
/*!40000 ALTER TABLE `plano` DISABLE KEYS */;
INSERT INTO `plano` VALUES (1,'Controle',1,3,'Sim'),(2,'Starter',1,4,'Sim'),(3,'Plus',2,4,'Sim'),(4,'Pro',3,4,'Sim'),(5,'Premium',4,4,'Sim'),(6,'Free',5,4,'Sim');
/*!40000 ALTER TABLE `plano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_detalhes`
--

DROP TABLE IF EXISTS `plano_detalhes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_detalhes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `modulo_id` bigint(20) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detalhes#planos#plano_id` (`plano_id`),
  KEY `FK_detalhes#modulos` (`modulo_id`),
  CONSTRAINT `FK_detalhes#modulos` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`),
  CONSTRAINT `FK_detalhes#planos#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_detalhes`
--

LOCK TABLES `plano_detalhes` WRITE;
/*!40000 ALTER TABLE `plano_detalhes` DISABLE KEYS */;
/*!40000 ALTER TABLE `plano_detalhes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_precos`
--

DROP TABLE IF EXISTS `plano_precos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_precos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_precos#planos#plano_id` (`plano_id`),
  CONSTRAINT `FK_precos#planos#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_precos`
--

LOCK TABLES `plano_precos` WRITE;
/*!40000 ALTER TABLE `plano_precos` DISABLE KEYS */;
/*!40000 ALTER TABLE `plano_precos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plano_tipos`
--

DROP TABLE IF EXISTS `plano_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plano_tipos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plano_tipos`
--

LOCK TABLES `plano_tipos` WRITE;
/*!40000 ALTER TABLE `plano_tipos` DISABLE KEYS */;
INSERT INTO `plano_tipos` VALUES (1,'Starter','Sim'),(2,'Plus','Sim'),(3,'Pro','Sim'),(4,'Premium','Sim'),(5,'Free','Sim');
/*!40000 ALTER TABLE `plano_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `dt_cadastro` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo` enum('Serviço','Produto') NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `empresa_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produtos#usuario#id` (`usuario_id`),
  KEY `fk_produtos#empresa#id` (`empresa_id`),
  CONSTRAINT `fk_produtos#empresa#id` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_produtos#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projetos`
--

DROP TABLE IF EXISTS `projetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projetos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `site` varchar(150) NOT NULL,
  `dominio` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projetos`
--

LOCK TABLES `projetos` WRITE;
/*!40000 ALTER TABLE `projetos` DISABLE KEYS */;
INSERT INTO `projetos` VALUES (3,'Staart Dev','Sim','www.staartdev.com.br','staartdev'),(4,'Pet Lab System','Sim','www.petlabsystem.com','petlabsystem');
/*!40000 ALTER TABLE `projetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submenus`
--

DROP TABLE IF EXISTS `submenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_submenus#menus#menu_id` (`menu_id`),
  CONSTRAINT `FK_submenus#menus#menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenus`
--

LOCK TABLES `submenus` WRITE;
/*!40000 ALTER TABLE `submenus` DISABLE KEYS */;
/*!40000 ALTER TABLE `submenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `ds_unidade` varchar(255) NOT NULL,
  `dt_cadastro` date NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `empresa_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_unidades#usuario#id` (`usuario_id`),
  KEY `fk_unidades#empresas#id` (`empresa_id`),
  CONSTRAINT `fk_unidades#empresas#id` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_unidades#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `tipo` enum('Proprietário','Cliente','Parceiro') NOT NULL DEFAULT 'Parceiro',
  `avatar` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT 'Sim',
  `telefone` varchar(20) DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  `projeto_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`,`tipo`,`empresa_id`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,'Matheus de Mello','matheusnarciso@hotmail.com','e10adc3949ba59abbe56e057f20f883e','Proprietário','391d3d5222ab211ccb0d8b26a1c2381e.jpg','36848874809','Sim','16991838523',24,3),(6,'Admin','matheus.gnu@gmail.com','e10adc3949ba59abbe56e057f20f883e','',NULL,'36848874809','Sim','16991838523',25,4),(9,'Estúdio Cristina Rodrigues','crisphoto5@hotmail.com','81dc9bdb52d04dc20036dbd8313ed055','Parceiro','null','null','Sim','null',24,3),(10,'Cristina rodrigues','creditogames@hotmail.com','202cb962ac59075b964b07152d234b70','Parceiro','','','Sim','',24,3),(18,'Clinica Matheus','matheus.gnu@gmail.com','698dc19d489c4e4db73e28a713eab07b','Parceiro','','','Sim','',24,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valoresreferencias`
--

DROP TABLE IF EXISTS `valoresreferencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valoresreferencias` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `especie_id` bigint(20) NOT NULL,
  `produto_id` bigint(20) NOT NULL,
  `unidade_id` bigint(20) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `empresa_id` bigint(20) unsigned NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_valoresReferencias#especies#id` (`especie_id`),
  KEY `fk_valoresReferencias#produtos#id` (`produto_id`),
  KEY `fk_valoresReferencias#unidades#id` (`unidade_id`),
  KEY `fk_valoresReferencias#empresas#id` (`empresa_id`),
  KEY `fk_valoresReferencias#usuario#id` (`usuario_id`),
  CONSTRAINT `fk_valoresReferencias#empresas#id` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`),
  CONSTRAINT `fk_valoresReferencias#especies#id` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`),
  CONSTRAINT `fk_valoresReferencias#produtos#id` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `fk_valoresReferencias#unidades#id` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`),
  CONSTRAINT `fk_valoresReferencias#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valoresreferencias`
--

LOCK TABLES `valoresreferencias` WRITE;
/*!40000 ALTER TABLE `valoresreferencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `valoresreferencias` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-13 17:54:34
