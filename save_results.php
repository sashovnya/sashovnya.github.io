<?php
// Přijměte data z POST požadavku
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    // Získání aktuálního času pro vytvoření unikátního názvu souboru
    $timestamp = time();
    $file_name = 'search_results_' . $timestamp . '.json'; // Název souboru může být například search_results_YYYYMMDDHHMMSS.json

    // Uložení dat do souboru ve formátu JSON
    file_put_contents($file_name, json_encode($data));

    // Vrácení potvrzovací zprávy
    echo json_encode(array('message' => 'Results saved successfully.', 'file_name' => $file_name));
} else {
    // Pokud nebyla přijata žádná data
    echo json_encode(array('message' => 'No data received.'));
}
?>
