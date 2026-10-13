<?php
header('Content-Type: text/json; charset=utf-8');
require __DIR__ . '/config.php';

$canton_id = trim($_GET['canton_id'] ?? '');
$death_cause = trim($_GET['death_cause'] ?? '');
$canton_popluation_divide = trim($_GET['canton_population_divide'] ?? '');




try {
    $pdo = new PDO($dsn, $dbuser, $password, $options);
    echo "Verbindung steht. \n\n";
} catch (PDOException $e) {
    exit("Verbindung fehlgeschlagen: " . $e->getMessage() . "\n\n");
}

$sql = "SELECT * FROM death_causes";

$params = [];

if ($death_cause !== '') {
    if(str_contains($sql, 'WHERE')){
        $sql .= ' AND death_cause = :death_cause';
    }
    else{
        $sql .= ' WHERE death_cause = :death_cause';
    }
    $params['death_cause'] = $death_cause;
}

if ($canton_id !== '') {
    if(str_contains($sql, 'WHERE')){
        $sql .= ' AND death_cause_rating_id = :death_cause_rating_id';
    }
    else{
        $sql .= ' WHERE death_cause_rating_id = :death_cause_rating_id';
    }
    $params['canton_id'] = $canton_id;
}

if ($canton_id !== '') {
    if(str_contains($sql, 'WHERE')){
        $sql .= ' AND death_cause_rating_id = :death_cause_rating_id';
    }
    else{
        $sql .= ' WHERE death_cause_rating_id = :death_cause_rating_id';
    }
    $params['canton_id'] = $canton_id;
}

$statement = $pdo->prepare($sql);
$statement->execute();

$data = $statement->fetchAll();

echo json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);