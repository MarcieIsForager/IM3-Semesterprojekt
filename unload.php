<?php
header('Content-Type: text/json; charset=utf-8');
require __DIR__ . '/config.php';

try {
    $pdo = new PDO($dsn, $dbuser, $password, $options);
    echo "Verbindung steht. \n\n";
} catch (PDOException $e) {
    exit("Verbindung fehlgeschlagen: " . $e->getMessage() . "\n\n");
}

$sql = "SELECT * FROM death_causes";
$statement = $pdo->prepare($sql);
$statement->execute();

$data = $statement->fetchAll();

echo json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);