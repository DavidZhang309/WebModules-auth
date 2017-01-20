/*!50001 DROP TABLE IF EXISTS `v_permissions`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_permissions` AS select `u`.`UserID` AS `UserID`,`u`.`Username` AS `Username`,`pu`.`ProjectID` AS `ProjectID`,`pu`.`PermissionCode` AS `PermissionCode`,`proj`.`ProjectName` AS `ProjectName`,`p`.`PermissionName` AS `PermissionName` from (((`tbl_users` `u` left join `tbl_user_permissions` `pu` on((`u`.`UserID` = `pu`.`UserID`))) left join `tbl_projects` `proj` on((`proj`.`ProjectID` = `pu`.`ProjectID`))) left join `tbl_permissions` `p` on(((`p`.`ProjectID` = `pu`.`ProjectID`) and (`p`.`PermissionCode` = `pu`.`PermissionCode`)))) where ((`pu`.`ProjectID` is not null) and (`pu`.`PermissionCode` is not null)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

