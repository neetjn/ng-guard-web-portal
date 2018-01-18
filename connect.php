<?php

    $mysql_hostname = "162.244.29.140";
    $mysql_user = "admin";
    $mysql_password = "4ahy5y9yn";
    $mysql_database = "zadmin_guard";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>