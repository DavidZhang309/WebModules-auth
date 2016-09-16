CREATE TABLE `tbl_user_permissions` (
  `UserID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `PermissionCode` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`ProjectID`,`PermissionCode`)
);