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
$cleaned_death_data = $raw_death_data;



function add_canton_id()
{
   foreach ($cleaned_death_data as $row) {
       $row["canton_id"] = 0;
   }
   return null;
}

//Death cause rating ids:
// 0: Unknown
// 1: Definite
// 2: Likely
// 3: Unlikely
// 4: Unrelated
function add_death_cause_rating ()
{
    foreach ($cleaned_death_data as $row) {
        switch ($row["Todersursache"]) {
            case "Krebs":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Ischemische Herzkrankheiten":
                $row["death_cause_rating_id"] = 2;
                break;
            case "andere Herzkrankheiten":
                $row["death_cause_rating_id"] = 2;
                break;
            case "Demenz":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Covid-19":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Hypertonie":
                $row["death_cause_rating_id"] = 2;
                break;
            case "Infektion der Atemwege":
                $row["death_cause_rating_id"] = 4;
                break;
            case "Zerebrovaskuläre Erkrankungen":
                $row["death_cause_rating_id"] = 2;
                break;
            case "Unfälle/Verletzungen":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Krankheiten des Nervensystems":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Krankheiten des Verdauensapparats":
                $row["death_cause_rating_id"] = 2;
                break;
            case "Stoffwechselerkrankungen":
                $row["death_cause_rating_id"] = 3;
                break;
            case "Krankheiten des Urogenitalsystems":
                $row["death_cause_rating_id"] = 4;
                break;
            case "Suizid":
                $row["death_cause_rating_id"] = 1;
                break;
            case "andere Todesursachen":
                $row["death_cause_rating_id"] = 0;
                break;
            case "Total":
                $row["death_cause_rating_id"] = 0;
                break;
            default:
                echo ("Not a real cause of death");
        }
    }
}

add_canton_id();
add_death_cause_rating();

return $cleaned_death_data;


// TODO 1: Filtere Zeitraum und Vorfalltyp.
// TODO 2: Normalisiere Art, Aktivität und Land – Fatal wird für diese Fragen
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

