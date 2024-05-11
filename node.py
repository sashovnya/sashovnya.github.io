import requests
from bs4 import BeautifulSoup
import json

# Define the search term and URL
search_term = "example search"
url = f"https://www.google.com/search?q={search_term}"

# Send a GET request to the URL
response = requests.get(url)

# Parse the HTML content using BeautifulSoup
soup = BeautifulSoup(response.content, 'html.parser')

# Extract the search result items
search_items = soup.find_all('div', class_='g')

# Extract the relevant information from each search item
results = []
for item in search_items:
    title = item.find('a').text
    link = item.find('a')['href']
    results.append({'title': title, 'link': link})

# Save the results in JSON format
with open('results.json', 'w') as f:
    json.dump(results, f)
