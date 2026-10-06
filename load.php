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

$insert_death_data = $pdo->prepare(
    'INSERT INTO death_causes (death_cause, total_death_toll, num_of_women, num_of_men, percentage_women, percentage_men, canton_id, death_cause_rating_id)
     VALUES (:death_cause, :totat_death_toll, :num_of_women, :num_of_men, :percentage_women, :percentage_men, :canton_id, :death_cause_rating_id)'
);

foreach ($rows as $row) {
    $insert_death_data->execute([
        'death_cause'           => $row['Todesursache'],
        'total_death_toll'              => $row['Total'],
        'num_of_women'  => $row['Anzahl Frauen'],
        'num_of_men'          => $row['Anzahl Männer'],
        'percentage_women' => $row['Anteil Frauen'],
        'percentage_men' => $row['Anteil Männer'],
        'canton_id' => $row['canton_id'],
        'death_cause_rating_id' => $row['death_cause_rating_id']
    ]);
}
