/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Salt` varchar(32) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

