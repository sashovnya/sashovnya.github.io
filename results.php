<?php
// Načtení uložených výsledků z Google
$results = file_get_contents("google_results.json");
$results = json_decode($results, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Search Results</title>
</head>
<body>
    <h1>Google Search Results</h1>
    <?php
    // Výpis výsledků z Google
    foreach ($results['items'] as $item) {
        echo "<h2>{$item['title']}</h2>";
        echo "<p>{$item['snippet']}</p>";
        echo "<a href='{$item['link']}'>{$item['link']}</a><br><br>";
    }
    ?>
</body>
</html>

