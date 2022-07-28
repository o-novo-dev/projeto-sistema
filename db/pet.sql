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
-- Table structure for table `cad_atividades`
--

DROP TABLE IF EXISTS `cad_atividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_atividades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_atividades`
--

LOCK TABLES `cad_atividades` WRITE;
/*!40000 ALTER TABLE `cad_atividades` DISABLE KEYS */;
INSERT INTO `cad_atividades` VALUES (4,'Laboratório','Sim'),(5,'Clinica','Sim');
/*!40000 ALTER TABLE `cad_atividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_cartoes`
--

DROP TABLE IF EXISTS `cad_cartoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_cartoes` (
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
-- Dumping data for table `cad_cartoes`
--

LOCK TABLES `cad_cartoes` WRITE;
/*!40000 ALTER TABLE `cad_cartoes` DISABLE KEYS */;
INSERT INTO `cad_cartoes` VALUES (8,'Cartão de Crédito',1423569870258746,'matheus de mello','2022-06-24',666,'Visa',5,'Sim');
/*!40000 ALTER TABLE `cad_cartoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_contratos`
--

DROP TABLE IF EXISTS `cad_contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_contratos` (
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
  CONSTRAINT `FK_CONTRATOS#EMPRESA#ID` FOREIGN KEY (`empresa_id`) REFERENCES `cad_empresas` (`id`),
  CONSTRAINT `FK_CONTRATOS#PLANOS#ID` FOREIGN KEY (`plano_id`) REFERENCES `dev_plano` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_contratos`
--

LOCK TABLES `cad_contratos` WRITE;
/*!40000 ALTER TABLE `cad_contratos` DISABLE KEYS */;
INSERT INTO `cad_contratos` VALUES (1,NULL,'Sim','2022-07-15',1,24,'Pago','2023-07-15');
/*!40000 ALTER TABLE `cad_contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_empresas`
--

DROP TABLE IF EXISTS `cad_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_empresas` (
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
  CONSTRAINT `empresas_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `cad_atividades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_empresas`
--

LOCK TABLES `cad_empresas` WRITE;
/*!40000 ALTER TABLE `cad_empresas` DISABLE KEYS */;
INSERT INTO `cad_empresas` VALUES (24,4,'Matheus SA','Matheus Developer ','14180000','Rua Miguel Barrachini','510','Centro','','RP','SP','16991838523','2022-06-15','Sim'),(25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Sim');
/*!40000 ALTER TABLE `cad_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_enderecos`
--

DROP TABLE IF EXISTS `cad_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_enderecos` (
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
-- Dumping data for table `cad_enderecos`
--

LOCK TABLES `cad_enderecos` WRITE;
/*!40000 ALTER TABLE `cad_enderecos` DISABLE KEYS */;
INSERT INTO `cad_enderecos` VALUES (7,'Matheus de Mello','Miguel Barachini','510','Centro','','14180000','SP','Rib P','16991838523','Sim',5,'Sim');
/*!40000 ALTER TABLE `cad_enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_produtos`
--

DROP TABLE IF EXISTS `cad_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `dt_cadastro` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `tipo` enum('Serviço','Produto','Exame') NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `empresa_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produtos#usuario#id` (`usuario_id`),
  KEY `fk_produtos#empresa#id` (`empresa_id`),
  CONSTRAINT `fk_produtos#empresa#id` FOREIGN KEY (`empresa_id`) REFERENCES `cad_empresas` (`id`),
  CONSTRAINT `fk_produtos#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_produtos`
--

LOCK TABLES `cad_produtos` WRITE;
/*!40000 ALTER TABLE `cad_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_unidades`
--

DROP TABLE IF EXISTS `cad_unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_unidades` (
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
  CONSTRAINT `fk_unidades#empresas#id` FOREIGN KEY (`empresa_id`) REFERENCES `cad_empresas` (`id`),
  CONSTRAINT `fk_unidades#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_unidades`
--

LOCK TABLES `cad_unidades` WRITE;
/*!40000 ALTER TABLE `cad_unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cad_valoresreferencias`
--

DROP TABLE IF EXISTS `cad_valoresreferencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cad_valoresreferencias` (
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
  CONSTRAINT `fk_valoresReferencias#empresas#id` FOREIGN KEY (`empresa_id`) REFERENCES `cad_empresas` (`id`),
  CONSTRAINT `fk_valoresReferencias#especies#id` FOREIGN KEY (`especie_id`) REFERENCES `lab_especies` (`id`),
  CONSTRAINT `fk_valoresReferencias#produtos#id` FOREIGN KEY (`produto_id`) REFERENCES `cad_produtos` (`id`),
  CONSTRAINT `fk_valoresReferencias#unidades#id` FOREIGN KEY (`unidade_id`) REFERENCES `cad_unidades` (`id`),
  CONSTRAINT `fk_valoresReferencias#usuario#id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cad_valoresreferencias`
--

LOCK TABLES `cad_valoresreferencias` WRITE;
/*!40000 ALTER TABLE `cad_valoresreferencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `cad_valoresreferencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_menus`
--

DROP TABLE IF EXISTS `dev_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `icone` varchar(100) NOT NULL,
  `ordem` int(3) NOT NULL,
  `permissao` enum('Clínica','Laboratório','Paciente','Prestador','Financeiro','Recepcionista','Admin') NOT NULL DEFAULT 'Prestador',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_menus`
--

LOCK TABLES `dev_menus` WRITE;
/*!40000 ALTER TABLE `dev_menus` DISABLE KEYS */;
INSERT INTO `dev_menus` VALUES (1,'Agenda Médica','agenda','Sim','fas fa-calendar-alt',1,'Admin'),(2,'Relacionamento','#','Sim','fas fa-address-card',2,'Admin'),(3,'Prontuário Eletrônico','prontuario/novo','Sim','fas fa-user',3,'Admin'),(4,'Prescrição Eletrônica','prescricao/novo','Sim','fas fa-edit',4,'Admin'),(5,'Relatórios','#','Sim','fas fa-clipboard',5,'Admin'),(8,'Controle financeiro','#','Sim','fas fa-hand-holding-usd',8,'Admin'),(9,'Controle de estoque','#','Sim','fas fa-money-check-alt',9,'Admin'),(10,'Relatórios financeiros','#','Sim','fas fa-chart-line',10,'Admin');
/*!40000 ALTER TABLE `dev_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_menus_sub`
--

DROP TABLE IF EXISTS `dev_menus_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_menus_sub` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_submenus#menus#menu_id` (`menu_id`),
  CONSTRAINT `FK_submenus#menus#menu_id` FOREIGN KEY (`menu_id`) REFERENCES `dev_menus` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_menus_sub`
--

LOCK TABLES `dev_menus_sub` WRITE;
/*!40000 ALTER TABLE `dev_menus_sub` DISABLE KEYS */;
INSERT INTO `dev_menus_sub` VALUES (1,'Paciente','pacientes/view','Sim',2),(2,'Prestadores','prestadores/view','Sim',2),(3,'Unidades','clinicas/view','Sim',2),(5,'Serviços','produtos/servico/view','Sim',2),(7,'Produtos','produtos/view','Sim',2),(8,'Fornecedores','fornecedores/view','Sim',2),(9,'Exames','pacientes/relatorio','Sim',5),(11,'Prestadores','prestadores/relatorio','Sim',5),(12,'Produtos','produtos/index','Sim',9),(13,'Movimentação','movimentacao/index','Sim',9),(14,'Dashboard','financeiro/dashboard','Sim',8);
/*!40000 ALTER TABLE `dev_menus_sub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_pages`
--

DROP TABLE IF EXISTS `dev_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('main','header','footer','contato','sobre','serviço','plano') NOT NULL,
  `param` varchar(255) NOT NULL,
  `value` varchar(4000) DEFAULT NULL,
  `valueImg` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_param` (`tipo`,`param`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_pages`
--

LOCK TABLES `dev_pages` WRITE;
/*!40000 ALTER TABLE `dev_pages` DISABLE KEYS */;
INSERT INTO `dev_pages` VALUES (1,'footer','teste11','teste1','slider-02.jpg','Não',''),(2,'header','teste1','teste1','9791ed6af6b32510f8c2f324afa0c98b.jpg','Sim','');
/*!40000 ALTER TABLE `dev_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_plano`
--

DROP TABLE IF EXISTS `dev_plano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_plano` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `plano_tipo_id` bigint(11) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plano#plano_tipos#plano_tipo_id` (`plano_tipo_id`),
  CONSTRAINT `FK_plano#plano_tipos#plano_tipo_id` FOREIGN KEY (`plano_tipo_id`) REFERENCES `dev_plano_tipos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_plano`
--

LOCK TABLES `dev_plano` WRITE;
/*!40000 ALTER TABLE `dev_plano` DISABLE KEYS */;
INSERT INTO `dev_plano` VALUES (1,'Start',1,'Sim'),(2,'Start',1,'Sim'),(3,'Plus',2,'Sim'),(4,'Pro',3,'Sim'),(5,'Premium',4,'Sim'),(6,'Free',5,'Sim');
/*!40000 ALTER TABLE `dev_plano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_plano_detalhes`
--

DROP TABLE IF EXISTS `dev_plano_detalhes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_plano_detalhes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `ordem` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detalhes#planos#plano_id` (`plano_id`),
  CONSTRAINT `FK_detalhes#planos#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `dev_plano` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_plano_detalhes`
--

LOCK TABLES `dev_plano_detalhes` WRITE;
/*!40000 ALTER TABLE `dev_plano_detalhes` DISABLE KEYS */;
INSERT INTO `dev_plano_detalhes` VALUES (1,'Relacionamento','Sim',1,1),(2,'Relatórios','Sim',1,2),(3,'Agenda','Sim',1,3),(4,'Prontuário Eletrônico','Sim',1,4),(5,'Prescrição Eletrônico','Sim',1,5),(6,'Controle Financeiro','Sim',1,6),(9,'Controle de Estoque','Sim',1,7),(10,'Relatório Financeiro','Sim',1,8);
/*!40000 ALTER TABLE `dev_plano_detalhes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_plano_menus`
--

DROP TABLE IF EXISTS `dev_plano_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_plano_menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plano_menus#menus#menu_id` (`menu_id`),
  KEY `FK_plano_menus#plano#plano_id` (`plano_id`),
  CONSTRAINT `FK_plano_menus#menus#menu_id` FOREIGN KEY (`menu_id`) REFERENCES `dev_menus` (`id`),
  CONSTRAINT `FK_plano_menus#plano#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `dev_plano` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_plano_menus`
--

LOCK TABLES `dev_plano_menus` WRITE;
/*!40000 ALTER TABLE `dev_plano_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `dev_plano_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_plano_precos`
--

DROP TABLE IF EXISTS `dev_plano_precos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_plano_precos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_precos#planos#plano_id` (`plano_id`),
  CONSTRAINT `FK_precos#planos#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `dev_plano` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_plano_precos`
--

LOCK TABLES `dev_plano_precos` WRITE;
/*!40000 ALTER TABLE `dev_plano_precos` DISABLE KEYS */;
INSERT INTO `dev_plano_precos` VALUES (1,'Preço 1','Sim',1,120.00);
/*!40000 ALTER TABLE `dev_plano_precos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_plano_tipos`
--

DROP TABLE IF EXISTS `dev_plano_tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_plano_tipos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_plano_tipos`
--

LOCK TABLES `dev_plano_tipos` WRITE;
/*!40000 ALTER TABLE `dev_plano_tipos` DISABLE KEYS */;
INSERT INTO `dev_plano_tipos` VALUES (1,'Starter','Sim'),(2,'Plus','Sim'),(3,'Pro','Sim'),(4,'Premium','Sim'),(5,'Free','Sim');
/*!40000 ALTER TABLE `dev_plano_tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_especies`
--

DROP TABLE IF EXISTS `lab_especies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_especies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_especies`
--

LOCK TABLES `lab_especies` WRITE;
/*!40000 ALTER TABLE `lab_especies` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab_especies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_pets`
--

DROP TABLE IF EXISTS `lab_pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_pets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `dt_nascimento` date NOT NULL,
  `especie_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pets#especies#id` (`especie_id`),
  CONSTRAINT `fk_pets#especies#id` FOREIGN KEY (`especie_id`) REFERENCES `lab_especies` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_pets`
--

LOCK TABLES `lab_pets` WRITE;
/*!40000 ALTER TABLE `lab_pets` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab_pets` ENABLE KEYS */;
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
  `tipo` enum('Clínica','Laboratório','Paciente','Prestador','Financeiro','Recepcionista','Admin') NOT NULL DEFAULT 'Prestador',
  `avatar` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT 'Sim',
  `telefone` varchar(20) DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`,`tipo`,`empresa_id`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `cad_empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (5,'Matheus de Mello','matheusnarciso@hotmail.com','e10adc3949ba59abbe56e057f20f883e','Admin','391d3d5222ab211ccb0d8b26a1c2381e.jpg','36848874809','Sim','16991838523',24),(6,'Matheus PetLabSystem','matheus.gnu@gmail.com','e10adc3949ba59abbe56e057f20f883e','Laboratório',NULL,'36848874809','Sim','16991838523',25),(9,'Estúdio Cristina Rodrigues','crisphoto5@hotmail.com','e10adc3949ba59abbe56e057f20f883e','','','null','Sim','null',24),(10,'Cristina rodrigues','creditogames@hotmail.com','202cb962ac59075b964b07152d234b70','Prestador','','','Sim','',24),(18,'Clinica Matheus','matheus.gnu@gmail.com','698dc19d489c4e4db73e28a713eab07b','Prestador','','','Sim','',24);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-28 17:59:18
