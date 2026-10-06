<?php
/**
 * Vorbereiteter Extract für Code-Along 10.
 *
 * Entspricht dem CSV-Extract aus Block B: Kopfzeile lesen, leere Zeilen
 * überspringen, jede übrige Zeile als assoziatives Array zurückgeben.
 */

$handle = fopen(__DIR__ . '/raw_data/death_data_sg.csv.csv', 'r');

if ($handle === false) {
    throw new RuntimeException('death_data_sg.csv konnte nicht geöffnet werden.');
}

$header = array_map('trim', fgetcsv($handle, null, ';', '"', ''));
$death_causes = [];

while (($row = fgetcsv($handle, null, ';', '"', '')) !== false) {
    if (($row[0] ?? '') === '' || count($row) !== count($header)) {
        continue;
    }

    $death_causes[] = array_combine($header, $row);
}

fclose($handle);

return $death_causes;