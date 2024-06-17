<?php
$hostname = 'localhost';
$username = 'acd_halfana';
$password = 'WD65NVAq#Hvx';
$database = 'acd_halfana';


try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
