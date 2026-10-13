<?php

header('Content-Type: text/plain; charset=utf-8');
require __DIR__ . '/config.php';
$result = include 'transform.php';
$rows = $result['data'];

try {
    $pdo = new PDO($dsn, $dbuser, $password, $options);
    echo "Verbindung steht. \n\n";
} catch (PDOException $e) {
    exit("Verbindung fehlgeschlagen: " . $e->getMessage() . "\n\n");
}

$delete_preexisting_data = $pdo->prepare(
    'DELETE * FROM death_cause'
);

$insert_death_data = $pdo->prepare(
    'INSERT INTO death_cause (death_cause, total_death_toll, percentage_of_death_toll, canton_id, is_caused_by_stress)
     VALUES (:death_cause, :totat_death_toll, :percentage_of_death_toll, :canton_id, :is_caused_by_stress)'
);

$delete_preexisting_data->execute();

foreach ($result as $rows) {
    foreach ($rows as $row) {
    $insert_death_data->execute([
        'death_cause'           => $row['Todesursache'],
        'total_death_toll'              => $row['Total Tode'],
        'percentage_of_death_toll'  => $row['Total prozent'],
        'canton_id' => $row['canton_id'],
        'is_caused_by_stress' => $row['is_caused_by_stress']
        ]);
    }
}

return 'success'; 