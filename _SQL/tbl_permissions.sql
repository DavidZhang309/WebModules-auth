CREATE TABLE `tbl_permissions` (
  `ProjectID` int(11) NOT NULL,
  `PermissionCode` int(11) NOT NULL,
  `PermissionName` varchar(64) NOT NULL,
  PRIMARY KEY (`ProjectID`,`PermissionCode`)
);