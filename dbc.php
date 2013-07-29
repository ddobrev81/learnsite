<?php #dbc.php

$dbc = "mysql:host=mysql8.000webhost.com;dbname=a4962218_learn";
$login="a4962218_";
$password="";
$opt = array(
    // any occurring errors wil be thrown as PDOException
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // an SQL command to execute when connecting
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
);

$pdo = new PDO($dbc, $login, $password, $opt);

?>
