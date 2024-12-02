<?php

$dsn = "mysql:host=localhost;dbname=schedule";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}