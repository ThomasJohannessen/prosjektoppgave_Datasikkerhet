-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: datasikkerhet_prosjekt
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

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
-- Temporary table structure for view `adminView`
--

DROP TABLE IF EXISTS `adminView`;
/*!50001 DROP VIEW IF EXISTS `adminView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `adminView` AS SELECT 
 1 AS `Epost`,
 1 AS `Passord`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `brukerView`
--

DROP TABLE IF EXISTS `brukerView`;
/*!50001 DROP VIEW IF EXISTS `brukerView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `brukerView` AS SELECT 
 1 AS `Navn`,
 1 AS `Epost`,
 1 AS `Kull`,
 1 AS `Studieretning`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `brukere`
--

DROP TABLE IF EXISTS `brukere`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brukere` (
  `BrukerID` int(11) NOT NULL AUTO_INCREMENT,
  `Navn` varchar(200) NOT NULL,
  `Epost` varchar(200) NOT NULL,
  `Bilde` varchar(200) DEFAULT NULL,
  `Kull` int(11) DEFAULT NULL,
  `Brukertype` int(11) NOT NULL,
  `Passord` varchar(200) NOT NULL,
  `EmneID` int(11) DEFAULT NULL,
  `Studieretning` varchar(50) DEFAULT NULL,
  `Brukerstatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`BrukerID`),
  UNIQUE KEY `Epost` (`Epost`),
  KEY `EmneID` (`EmneID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brukere`
--

LOCK TABLES `brukere` WRITE;
/*!40000 ALTER TABLE `brukere` DISABLE KEYS */;
INSERT INTO `brukere` VALUES (10,'Ola Nordmann','Ola@hiof.no','138395.jpg',0,2,'$2y$10$r6qCPh7VmknBgtW3aKvspOp3s26HCroz.rJdXzi5Xhl.Z1WTnhW3m',1032,'',1),(11,'Pia Nodeland','Pia@hiof.no','',1929,3,'$2y$10$BLG7B.wcr3ZiTYFhPazPqO7BnMKkKK0MMJRiwOVpclx85BbC9vqjW',0,'Sykepleier',1),(12,'Admin','badmin@hiof.no','',-3,1,'$2y$10$J57NnC1usCVi6PQZZz/qOuXNT/p.xpdE5kOKsIDTvf1OtyHTJLI1u',0,'',1),(17,'Ellen Knudsen','Ellen@hiof.no','732506.jpg',0,2,'$2y$10$SPdQCfcTL9u..NcMIOHMCORz1CUSc5dYkJe17f7VALXh0KMOmw15O',1033,'',1),(18,'Tom Heine','Heine@hotmail.com','739867.jpg',0,2,'$2y$10$pY/iuqrp3YVe4tjT13ifIerNeeQ90ruU3nORGrrjFmLy20kseb3GO',1034,'',1),(20,'Lars Aberg','Lars@hiof.no','443446.jpg',0,2,'$2y$10$hlcXj6ihf9hX5VxStkgWVey6bw/vuU9F0k.XOtksv4TlQMj.dbvby',1035,'',1),(26,'Ola','ola-nynormann@internet.com','854889.png',0,2,'$2y$10$TUfcDvi3Jbw5nuqr9ZvzGugog7jvublZ4TmYQY9U5aRoqNTfmH6gG',1234,'',1),(27,'ton','tunfisk@havet.no','',1788,3,'$2y$10$TUfcDvi3Jbw5nuqr9ZvzGugog7jvublZ4TmYQY9U5aRoqNTfmH6gG',0,'Datamaskin',1),(33,'Mie','Mie@hiof.no','',1929,3,'$2y$10$Id8h.weYqGNWV5PxEKnZSerjnkAMci9P/RkLAnRhNmo/N0TbfFUja',0,'IT',1),(35,'Emma','emma@hiof.no','932684.png',0,2,'$2y$10$wMbRuOio763CNoh2uPt4Xe7tiKpUPjp5ebBqlzGlMjbOHSgr8Iziy',4321,'',1),(36,'Michal','mik@hiof.no','',2015,3,'$2y$10$XQU/uUoMj6WCnhMREm9olu1UrORTIMnU7ODr6sJgyLvIyLbW7ucBC',0,'Y0loKurset',1),(37,'Michal','mikk@hiof.no','320478.jpg',0,2,'$2y$10$IBPsDgrPJIAY67v8DmEaBOz8xfbOl4m7NZMDwUwuUZsfPKKS5WAvW',7777,'',1);
/*!40000 ALTER TABLE `brukere` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emne`
--

DROP TABLE IF EXISTS `emne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emne` (
  `emnekode` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `emnenavn` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `emnePIN` int(4) NOT NULL,
  PRIMARY KEY (`emnePIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emne`
--

LOCK TABLES `emne` WRITE;
/*!40000 ALTER TABLE `emne` DISABLE KEYS */;
INSERT INTO `emne` VALUES ('ITF885','Sykepleier 101',1032),('ITF886','DigiFab',1033),('ITF887','Datasikkehet',1034),('ITF888','Lærer-fag 101',1035),('abc123','algebraisk nynorsk',1234),('abc124','Mikromakrokapital',4321),('abc234','RonkeFag',7777);
/*!40000 ALTER TABLE `emne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `emneView`
--

DROP TABLE IF EXISTS `emneView`;
/*!50001 DROP VIEW IF EXISTS `emneView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `emneView` AS SELECT 
 1 AS `emnekode`,
 1 AS `emnenavn`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `foreleserView`
--

DROP TABLE IF EXISTS `foreleserView`;
/*!50001 DROP VIEW IF EXISTS `foreleserView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `foreleserView` AS SELECT 
 1 AS `Navn`,
 1 AS `Epost`,
 1 AS `Bilde`,
 1 AS `emnekode`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `gjestPin`
--

DROP TABLE IF EXISTS `gjestPin`;
/*!50001 DROP VIEW IF EXISTS `gjestPin`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `gjestPin` AS SELECT 
 1 AS `emnekode`,
 1 AS `emnePIN`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `kommentarView`
--

DROP TABLE IF EXISTS `kommentarView`;
/*!50001 DROP VIEW IF EXISTS `kommentarView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `kommentarView` AS SELECT 
 1 AS `kommentar`,
 1 AS `kommentarHash`,
 1 AS `sprmHash`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kommentarer`
--

DROP TABLE IF EXISTS `kommentarer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kommentarer` (
  `sporsmalID` mediumint(9) NOT NULL,
  `kommentar` varchar(200) CHARACTER SET utf8 NOT NULL,
  `kommentarID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kommentarID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kommentarer`
--

LOCK TABLES `kommentarer` WRITE;
/*!40000 ALTER TABLE `kommentarer` DISABLE KEYS */;
INSERT INTO `kommentarer` VALUES (1,'Dummy kommentar',1),(3,'Haha Ja det gjÃ¸r du',2),(2,'Hei Hallo',3),(10,'hei',4),(5,'hei hei',5),(5,'hei hei',6),(6,'jeg liker datamaskin',7),(6,'yikes',8);
/*!40000 ALTER TABLE `kommentarer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `loginView`
--

DROP TABLE IF EXISTS `loginView`;
/*!50001 DROP VIEW IF EXISTS `loginView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `loginView` AS SELECT 
 1 AS `Epost`,
 1 AS `Passord`,
 1 AS `Brukertype`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `meldingView`
--

DROP TABLE IF EXISTS `meldingView`;
/*!50001 DROP VIEW IF EXISTS `meldingView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `meldingView` AS SELECT 
 1 AS `Epost`,
 1 AS `emnekode`,
 1 AS `melding`,
 1 AS `svar`,
 1 AS `emnenavn`,
 1 AS `Hash`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `meldinger`
--

DROP TABLE IF EXISTS `meldinger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meldinger` (
  `avsenderID` int(11) NOT NULL,
  `emnekode` varchar(10) NOT NULL,
  `melding` varchar(250) NOT NULL,
  `sporsmalID` int(11) NOT NULL AUTO_INCREMENT,
  `svar` varchar(250) DEFAULT NULL,
  `foreleserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`sporsmalID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meldinger`
--

LOCK TABLES `meldinger` WRITE;
/*!40000 ALTER TABLE `meldinger` DISABLE KEYS */;
INSERT INTO `meldinger` VALUES (121,'ITF888','Testmelding fra ssh',2,'Go away',10),(11,'ITF888','Are you a Hedgehog?',3,'No.',10),(11,'ITF886','Digidigihole',4,'2',17),(11,'ITF887','Heine spÃ¸rmÃ¥l 1',5,'Test, haha',18),(19,'ITF887','Hvorfor funker ikke Ã¥ bokstaven?',6,'Aner ikke',20),(11,'ITF885','Sykepleier spÃ¸rsmÃ¥l 1',7,'haha',20),(11,'ITF886','2',9,NULL,NULL),(11,'ITF887','1',11,NULL,NULL),(11,'ITF886','1',12,NULL,NULL),(11,'ITF888','1',13,NULL,NULL),(11,'ITF888','132',14,NULL,NULL),(11,'ITF887','HÃ¦llÃ¦',15,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',16,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',17,NULL,NULL),(27,'abc123','Hei hva er algebraisk nynorsk?',18,'De e nynorsk, men algebraisk, e du ikkje riktig kjlok??',26),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',19,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',20,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',21,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',22,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',23,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',24,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',25,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',26,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',27,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',28,NULL,NULL),(11,'ITF887','Dette er et spÃ¸rsmÃ¥l fra API',29,NULL,NULL),(11,'ITF888','test',30,NULL,NULL),(101,'ITF858','netttest',31,NULL,NULL),(101,'ITF858','netttest',32,NULL,NULL),(101,'ITF858','netttest',33,NULL,NULL),(11,'ITF887','aaaaaaaaaaaaaaaa pls funk',34,NULL,NULL),(11,'ITF887','Dette er  en melding fra Pia med innlogging og alt koblet fra API',35,NULL,NULL),(11,'IFT888','',36,NULL,NULL),(11,'ITF886','Funker appendix spÃ¸r Pia!',37,NULL,NULL),(11,'ITF885','dette er final spÃ¸mÃ¥l',38,NULL,NULL),(11,'ITF885','dette er final spÃ¸mÃ¥l',39,NULL,NULL),(11,'ITF885','Hei pÃ¥ dei',40,NULL,NULL),(11,'ITF885','Hei pÃ¥ dei og',41,NULL,NULL),(11,'abc124','Hei pÃ¥ dei',42,'Test svar',35),(36,'ITF885','Jeg vil dÃ¸, kan jeg dÃ¸?',43,NULL,NULL),(36,'abc234','Heyo',44,'asd',37),(36,'abc234','XD',45,NULL,NULL);
/*!40000 ALTER TABLE `meldinger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rapportering`
--

DROP TABLE IF EXISTS `rapportering`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rapportering` (
  `meldingID` int(11) NOT NULL,
  `behandlingStatus` tinyint(3) DEFAULT NULL,
  `adminKommentar` varchar(200) DEFAULT NULL,
  `RapportKommentar` varchar(200) NOT NULL,
  `rapportID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`rapportID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rapportering`
--

LOCK TABLES `rapportering` WRITE;
/*!40000 ALTER TABLE `rapportering` DISABLE KEYS */;
INSERT INTO `rapportering` VALUES (1,3,'Dummy admin kommentar','Dummy rapport kommentar',1),(3,3,NULL,'upassende',2),(10,3,NULL,'Hei',3),(3,3,NULL,'upassende',4),(6,3,NULL,'jeg liker ikke dette, dette er teit, ha det bort!',5);
/*!40000 ALTER TABLE `rapportering` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `adminView`
--

/*!50001 DROP VIEW IF EXISTS `adminView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `adminView` AS select brukere.`Epost` AS `Epost`,brukere.`Passord` AS `Passord` from brukere where (`brukere`.`Brukertype` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `brukerView`
--

/*!50001 DROP VIEW IF EXISTS `brukerView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `brukerView` AS select brukere.`Navn` AS `Navn`,brukere.`Epost` AS `Epost`,brukere.`Kull` AS `Kull`,brukere.`Studieretning` AS `Studieretning` from brukere where (`brukere`.`Brukertype` = 3) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `emneView`
--

/*!50001 DROP VIEW IF EXISTS `emneView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `emneView` AS select `emne`.`emnekode` AS `emnekode`,`emne`.`emnenavn` AS `emnenavn` from `emne` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `foreleserView`
--

/*!50001 DROP VIEW IF EXISTS `foreleserView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `foreleserView` AS select `brukere`.`Navn` AS `Navn`,`brukere`.`Epost` AS `Epost`,`brukere`.`Bilde` AS `Bilde`,`emne`.`emnekode` AS `emnekode` from (`brukere` join `emne` on((`brukere`.`EmneID` = `emne`.`emnePIN`))) where (`brukere`.`Brukertype` = 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `gjestPin`
--

/*!50001 DROP VIEW IF EXISTS `gjestPin`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `gjestPin` AS select `emne`.`emnekode` AS `emnekode`,`emne`.`emnePIN` AS `emnePIN` from `emne` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kommentarView`
--

/*!50001 DROP VIEW IF EXISTS `kommentarView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kommentarView` AS select `kommentarer`.`kommentar` AS `kommentar`,sha(concat(`kommentarer`.`kommentarID`,'c1d3764adac9b47d1ba00b3f11a8c8c0')) AS `kommentarHash`,sha(concat(`kommentarer`.`sporsmalID`,'3bbbffe76658aece882c7607c02bd18f')) AS `sprmHash` from `kommentarer` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `loginView`
--

/*!50001 DROP VIEW IF EXISTS `loginView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `loginView` AS select `brukere`.`Epost` AS `Epost`,`brukere`.`Passord` AS `Passord`,`brukere`.`Brukertype` AS `Brukertype` from `brukere` where (`brukere`.`Brukertype` <> 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `meldingView`
--

/*!50001 DROP VIEW IF EXISTS `meldingView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `meldingView` AS select `brukere`.`Epost` AS `Epost`,`emne`.`emnekode` AS `emnekode`,`meldinger`.`melding` AS `melding`,`meldinger`.`svar` AS `svar`,`emne`.`emnenavn` AS `emnenavn`,sha(concat(`meldinger`.`sporsmalID`,'3bbbffe76658aece882c7607c02bd18f')) AS `Hash` from ((`meldinger` join `emne` on((`meldinger`.`emnekode` = `emne`.`emnekode`))) left join `brukere` on((`meldinger`.`avsenderID` = `brukere`.`BrukerID`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-18  0:47:32
