/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.10-MariaDB : Database - pet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pet`;

/*Table structure for table `atividades` */

DROP TABLE IF EXISTS `atividades`;

CREATE TABLE `atividades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `atividades` */

insert  into `atividades`(`id`,`nome`,`ativo`) values (1,'Matheus','Sim'),(2,'Teste','Sim'),(3,'ABC','Sim');

/*Table structure for table `cartoes` */

DROP TABLE IF EXISTS `cartoes`;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `cartoes` */

insert  into `cartoes`(`id`,`tipo`,`numero`,`nome`,`dt_expiracao`,`cvv`,`bandeira`,`usuario_id`,`ativo`) values (2,'Cartão de Débito',1234123412341234,'Clinica Matheus','2022-08-11',123,'Visa',1,'Não'),(3,'Cartão de Crédito',1234567891234567,'matheus','2022-06-02',123,'Master Card',1,'Sim'),(6,'Cartão de Crédito',1243414341241,'teste','2022-06-02',123,'Elo',1,'Sim'),(7,'Cartão de Débito',9875465488798754,'cartão teste','2022-06-01',123,'Visa',1,'Sim');

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `atividade_id` bigint(20) unsigned NOT NULL,
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
  `pago` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Não',
  `dt_experiencia` date DEFAULT NULL,
  `ativo` enum('Sim','Não') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`),
  KEY `empresas_atividade_id_foreign` (`atividade_id`),
  CONSTRAINT `empresas_atividade_id_foreign` FOREIGN KEY (`atividade_id`) REFERENCES `atividades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `empresas` */

insert  into `empresas`(`id`,`atividade_id`,`razao_social`,`nome_fantasia`,`cep`,`endereco`,`numero`,`bairro`,`complemento`,`cidade`,`uf`,`celular`,`pago`,`dt_experiencia`,`ativo`) values (20,2,'Teste','MATHEUS DE MELLO IZABEL CRISTINA BUGNOLA DE MELLO','14015-170','Rua Álvares Cabral','40339455','centro','AP 51','Ribeirão Preto','AS','991838523','Não','2022-05-27','Sim'),(21,1,'Matheus de Mello','Matheus Mello','14015170','AV 9 DE JULHO','1243124234','test','test','Ribeirão Preto, city, Brazil','AS','(16) 66666-6666','Não','2022-05-18','Sim');

/*Table structure for table `enderecos` */

DROP TABLE IF EXISTS `enderecos`;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `enderecos` */

insert  into `enderecos`(`id`,`nome`,`rua`,`numero`,`bairro`,`complemento`,`cep`,`estado`,`cidade`,`telefone`,`principal`,`usuario_id`,`ativo`) values (1,'teste','teste','teste','teste','teste','teste','te','test','teste','Não',1,'Não'),(3,'Matheus','Miguel','asf','adf','adf','af','ad','asf','asf','Não',1,'Sim'),(4,'matheus','xxxxx','xxx','xx','xxx','xxx','xx','xxxx','xxx','Não',1,'Sim'),(5,'sergio','yyy','y','y','y','y','y','y','y','Não',1,'Não'),(6,'Clinica Matheus','Miguel','40339455','centro','AP 51','14180000','ad','Ribeirão Preto','+5516991838523','Sim',1,'Sim');

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`id`,`nome`,`link`,`ativo`) values (1,'Dashboard1x','Dashboard/Painel','Não'),(2,'Dashboard','dashboard/Fiscal','Sim');

/*Table structure for table `modulos` */

DROP TABLE IF EXISTS `modulos`;

CREATE TABLE `modulos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `modulos` */

insert  into `modulos`(`id`,`nome`,`ativo`) values (1,'Fiscal','Sim'),(2,'Laboratório','Sim');

/*Table structure for table `modulos_menus` */

DROP TABLE IF EXISTS `modulos_menus`;

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

/*Data for the table `modulos_menus` */

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` enum('main','header','footer','contato','sobre','serviço','plano') NOT NULL,
  `param` varchar(255) NOT NULL,
  `value` varchar(4000) DEFAULT NULL,
  `valueImg` varchar(255) DEFAULT NULL,
  `ativo` enum('Sim','Não') NOT NULL DEFAULT 'Sim',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_param` (`tipo`,`param`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`tipo`,`param`,`value`,`valueImg`,`ativo`) values (1,'header','titulo','Bem vindo ao Pets',NULL,'Sim'),(2,'header','meta','pet; laboratório; petshop; ',NULL,'Sim');

/*Table structure for table `plano` */

DROP TABLE IF EXISTS `plano`;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `plano` */

/*Table structure for table `plano_detalhes` */

DROP TABLE IF EXISTS `plano_detalhes`;

CREATE TABLE `plano_detalhes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `plano_id` bigint(20) NOT NULL,
  `modulo_id` bigint(20) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_detalhes#planos#plano_id` (`plano_id`),
  KEY `FK_detalhes#modulos` (`modulo_id`),
  CONSTRAINT `FK_detalhes#modulos` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`),
  CONSTRAINT `FK_detalhes#planos#plano_id` FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `plano_detalhes` */

/*Table structure for table `plano_precos` */

DROP TABLE IF EXISTS `plano_precos`;

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

/*Data for the table `plano_precos` */

/*Table structure for table `plano_tipos` */

DROP TABLE IF EXISTS `plano_tipos`;

CREATE TABLE `plano_tipos` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `plano_tipos` */

/*Table structure for table `projetos` */

DROP TABLE IF EXISTS `projetos`;

CREATE TABLE `projetos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `projetos` */

insert  into `projetos`(`id`,`nome`,`ativo`) values (1,'Projeto Fiscal','Sim');

/*Table structure for table `submenus` */

DROP TABLE IF EXISTS `submenus`;

CREATE TABLE `submenus` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_submenus#menus#menu_id` (`menu_id`),
  CONSTRAINT `FK_submenus#menus#menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `submenus` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `tipo` enum('Laboratório','Colaborador','Parceiro','Veterinário','Administrador') NOT NULL DEFAULT 'Laboratório',
  `avatar` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `ativo` enum('Sim','Não') DEFAULT 'Sim',
  `telefone` varchar(20) DEFAULT NULL,
  `empresa_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email` (`email`),
  KEY `users_empresa_id_foreign` (`empresa_id`),
  CONSTRAINT `users_empresa_id_foreign` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nome`,`email`,`senha`,`tipo`,`avatar`,`cpf_cnpj`,`ativo`,`telefone`,`empresa_id`) values (1,'Matheus de Mello','matheusnarciso@hotmail.com','e10adc3949ba59abbe56e057f20f883e','Administrador',NULL,'36848874809','Sim','16991838523',21),(2,'','','','Administrador',NULL,NULL,'Sim',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
