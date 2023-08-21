<?php
function writeCSVData($csvFileName, $data)
{
    if (!empty($data)) {
        $csvFile = fopen($csvFileName, "w");

        // Write the header
        fputcsv($csvFile, array_keys($data[0]));

        // Write data rows
        foreach ($data as $rowData) {
            fputcsv($csvFile, $rowData);
        }

        fclose($csvFile);
    }
}

// Exemple :
// $nomsCsvFileName = "noms.csv";
// writeCSVData($nomsCsvFileName, $nomsData);