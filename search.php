<?php
// Funkce pro získání výsledků z Google
function getGoogleResults($keyword) {
    $apiKey = "AIzaSyAazvwNgNKa6XbXOQyrI997lQcjl55zfXU";
    $cx = "b168b3d23fda0461d";
    
    // Vytvoření URL pro Google Custom Search API
    $url = "https://www.googleapis.com/customsearch/v1?q=" . urlencode($keyword) . "&cx=$cx&key=$apiKey";
    
    // Získání dat z Google API
    $response = file_get_contents($url);
    
    // Dekódování JSON odpovědi
    $data = json_decode($response, true);
    
    // Vrácení výsledků ve formátu pole
    return $data;
}

// Zpracování formuláře po odeslání
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání klíčového slovního spojení z formuláře
    $keyword = $_POST["keyword"];
    
    // Získání výsledků z Google
    $results = getGoogleResults($keyword);
    
    // Uložení výsledků do souboru ve formátu JSON
    $filename = "google_results.json";
    file_put_contents($filename, json_encode($results));
}
?>
