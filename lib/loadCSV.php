<?php
function loadCsvData($csvFileName, &$lastStudentid, $dataColumn)
{
    $data = [];
    $lastStudentid = 0;

    if (file_exists($csvFileName)) {
        $csvFile = fopen($csvFileName, "r");
        $header = fgetcsv($csvFile);

        while ($row = fgetcsv($csvFile)) {
            $lastStudentid = max($lastStudentid, $row[0]);
            $data[] = [
                "id" => $row[0],
                $dataColumn => $row[1]
            ];
        }

        fclose($csvFile);
    }

    return $data;
}

// Exemple
// $moyennesCsvcsvFileName = "moyennes.csv";
// $moyennesData = loadCsvData($moyennesCsvcsvFileName, "id", "Moyenne");

// $nomsCsvcsvFileName = "noms.csv";
// $nomsData = loadCsvData($nomsCsvcsvFileName, "id", "Noms");