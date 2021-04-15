<?php
     header("Content-Type:text/html; charset=utf-8");
     $serverName="LAPTOP-P832HNAS\SQLEXPRESS";
     $connectionInfo=array("Database"=>"TEST","UID"=>"sklfad_db","PWD"=>"aall0921","CharacterSet"=>"UTF-8");
     $conn=sqlsrv_connect($serverName,$connectionInfo);       
?>