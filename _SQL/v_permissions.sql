CREATE VIEW `v_permissions` AS
    SELECT 
        `u`.`UserID` AS `UserID`,
        `u`.`Username` AS `Username`,
        `pu`.`ProjectID` AS `ProjectID`,
        `pu`.`PermissionCode` AS `PermissionCode`,
        `proj`.`ProjectName` AS `ProjectName`,
        `p`.`PermissionName` AS `PermissionName`
    FROM
        (((`tbl_users` `u`
        LEFT JOIN `tbl_user_permissions` `pu` ON ((`u`.`UserID` = `pu`.`UserID`)))
        LEFT JOIN `tbl_projects` `proj` ON ((`proj`.`ProjectID` = `pu`.`ProjectID`)))
        LEFT JOIN `tbl_permissions` `p` ON (((`p`.`ProjectID` = `pu`.`ProjectID`)
            AND (`p`.`PermissionCode` = `pu`.`PermissionCode`))))
    WHERE
        ((`pu`.`ProjectID` IS NOT NULL)
            AND (`pu`.`PermissionCode` IS NOT NULL))