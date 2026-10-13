<?php
/**
 * Code-Along 10: Shark-Daten transformieren – Startcode
 *
 * Dieses Gerüst braucht ihr nur, wenn ihr ohne KI arbeitet. Der reguläre Weg
 * läuft über explore.php und eure eigene Spezifikation in KI_PROMPT.md.
 *
 * Eure Fragen:
 * 1. ...
 * 2. ...
 * 3. ...
 *
 * Die Werte unten sind Platzhalter aus einer möglichen Fassung. Ersetzt sie
 * durch eure eigenen Entscheidungen – Zeitraum und Kategorien folgen aus eurer
 * Frage, nicht umgekehrt.
 *
 * Wichtig: Häufigkeit im Datensatz ist nicht dasselbe wie Risiko.
 */

$raw_death_data = include 'extract.php';
$cleaned_up_death_data = $raw_death_data;

//echo('in file');

function add_canton_id()
{
    echo('in add canton id');
   foreach ($cleaned_up_death_data as $cantonal_death_array) {
       print_r($cantonal_death_array);
       echo "\n";
        foreach($cantonal_death_array as $row){
            switch($row['Kanton']){
                case 'ZH':
                    $row['canton_id'] = 5;
                    break;
                case 'GE':
                    $row['canton_id'] = 6;
                    break;
                case 'UR':
                    $row['canton_id'] = 3;
                    break;
                case 'AR':
                    $row['canton_id'] = 4;
                    break;
                case 'GR':
                    $row['canton_id'] = 2;
                    break;
                case 'BS':
                    $row['canton_id'] = 1;
                    break;
                default:
                    echo('Invalid Canton');
                    break;
            }
        }
   }
   return null;
}

//Death cause+
// 0: Unknown
// 1: Definite
// 2: Likely
// 3: Unlikely
// 4: Unrelated
function add_death_cause_rating ()
{
    echo('in add death cause rating');
    foreach ($cleaned_up_death_data as $cantonal_death_array) {
        foreach($cantonal_death_array as $row){
            switch($row['Todesursache']){
                case 'Suizid':
                    $row['is_caused_by_stress'] = true;
                    break;
                case 'Herzkrankheiten':
                    $row['is_caused_by_stress'] = true;
                    break;
                case 'Alkoholisch Leberzirrhose':
                    $row['is_caused_by_stress'] = true;
                    break;
                default:
                    $row['is_caused_by_stress'] = false;
                    break;
            }
        }
   }
}

add_canton_id();
add_death_cause_rating();

print_r($cleaned_up_death_data);
return $cleaned_up_death_data;

