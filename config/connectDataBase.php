<?php 

try {
    $strConnexion = "mysql:host=localhost;dbname=school";
    $pdo = new PDO($strConnexion,"louka", "root", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ 
    ]); 
} catch (PDOException $e) {
    $message = $e->getMessage();
    die($message);
}