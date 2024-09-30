<?php
// db.php : Connexion à la base de données
$host = '127.0.0.1:3306';
$dbname = 'php';
$user = 'root';
$pass = 'FaBen456BizBob';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
