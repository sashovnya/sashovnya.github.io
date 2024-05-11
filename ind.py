import requests
from bs4 import BeautifulSoup
import json
import csv

query = "your_search_query"
url = f"https://www.google.com/search?q={query}"

response = requests.get(url)
soup = BeautifulSoup(response.text, 'html.parser')

results = []
for div in soup.find_all('div', class_='yuRUbf'):
    title = div.find('h3').text
    link = div.find('a')['href']
    results.append({'title': title, 'link': link})

with open('results.json', 'w') as outfile:
    json.dump(results, outfile)

with open('results.csv', 'w', newline='', encoding='utf-8') as f:
    writer = csv.writer(f)
    writer.writerow(["Title", "Link"])
    writer.writerows([[result['title'], result['link']] for result in results])
