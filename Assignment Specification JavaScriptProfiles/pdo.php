<?php 


    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = '';
    $dbName = 'coursera';

$pdo = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.';charset=utf8', $dbUser , $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>