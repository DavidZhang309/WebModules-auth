/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissions` (
  `ProjectID` int(11) NOT NULL,
  `PermissionCode` int(11) NOT NULL,
  `PermissionName` varchar(64) NOT NULL,
  PRIMARY KEY (`ProjectID`,`PermissionCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

