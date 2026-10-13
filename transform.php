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

$raw_death_data = include __DIR__ . '/extract.php';
$cleaned_up_death_data = $raw_death_data;



function add_canton_id()
{
   foreach ($cleaned_up_death_data as $cantonal_death_array) {
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

return $cleaned_up_death_data;


// TODO 1: Filtere Zeitraum und Vorfalltyp.
// TODO 2: Normalisiere Art, Aktivität und Land – Fatal wird für diese Fragen
+
//         nicht gebraucht.
// TODO 3: Zähle Arten und Aktivitäten getrennt.
// TODO 4: Sortiere beide Rankings und behalte je die Top 10.
// TODO 5: Erzeuge gleich aufgebaute Ergebniszeilen nach Datenvertrag:
//         dimension, rank, category, incidents.
// TODO 6: Ergänze Abdeckungswerte und unbekannte Rohwerte im Audit.
// TODO 7: Zähle pro Land zusätzlich mit, welche Art und welche Aktivität dort
//         am häufigsten vorkommt. Achtung: Ein Vorfall ohne Land bleibt in den
//         beiden Ranglisten – hier gehört kein Filter hin.
// TODO 8: Erzeuge die Länderzeilen nach Datenvertrag:
//         country, iso3, incidents, top_species, top_activity.
//         Diese Liste wird nicht auf Top 10 gekürzt.

