function searchGoogle() {
    const searchQuery = document.getElementById("searchQuery").value;
    const url = `https://www.google.com/search?q=${encodeURIComponent(searchQuery)}`;
    
    fetch(url)
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const htmlDoc = parser.parseFromString(data, "text/html");
            const searchResults = htmlDoc.querySelectorAll('.tF2Cxc');
            
            let resultsArray = [];
            searchResults.forEach(result => {
                resultsArray.push({
                    title: result.querySelector('h3').innerText,
                    url: result.querySelector('a').href
                });
            });
            
            downloadResults(JSON.stringify(resultsArray));
        })
        .catch(error => console.error('Chyba při vyhledávání:', error));
}

function downloadResults(data) {
    const blob = new Blob([data], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'search_results.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
