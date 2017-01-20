/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_permissions` (
  `UserID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `PermissionCode` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`ProjectID`,`PermissionCode`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

