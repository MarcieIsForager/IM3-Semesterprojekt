<?php
/**
 * Vorbereiteter Extract für Code-Along 10.
 *
 * Entspricht dem CSV-Extract aus Block B: Kopfzeile lesen, leere Zeilen
 * überspringen, jede übrige Zeile als assoziatives Array zurückgeben.
 */
$root_data_path = '../data_csvs/';
$death_causes = [];


foreach (new DirectoryIterator('../data_csvs') as $file){
    if($file->isDot()){
        continue;
    }
    
    $handle = fopen(__DIR__ . $root_data_path . $file->getFileName(), 'r' );
    if($handle === false) {
        throw new RuntimeException($file->getFileName() . 'Konnte nicht gefunden werden');
    }

    $header = array_map('trim', fgetcsv($handle, null, ';', '"', ''));
    $temp_death_causes = [];

    while (($row = fgetcsv($handle, null, ';', '"', '')) !== false) {
        if (($row[0] ?? '') === '' || count($row) !== count($header)) {
            continue;
        }
        $temp_death_causes[] = array_combine($header, $row);
    }

    $death_causes[] = $temp_death_causes;
    fclose($handle);
}


return $death_causes;