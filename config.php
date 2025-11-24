<?php
$host = "localhost";
$db   = "registros_diarios";
$user = "root";
$pass = ""; //

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
