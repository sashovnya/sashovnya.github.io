from flask import Flask, render_template, request
import requests
from bs4 import BeautifulSoup
import json

app = Flask(__name__)
@app.route('/', methods=['GET', 'POST'])
@app.route('/')
def index():
    return render_template('index.html')

@app.route('/search', methods=['POST'])
def search():
    keyword = request.form['keyword']
    results = google_search(keyword)
    save_results(results, 'search_results.json')
    return 'Výsledky byly úspěšně uloženy.'

def google_search(keyword):
    url = f'https://www.google.com/search?q={keyword}'
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'}
    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.text, 'html.parser')
    search_results = []
    for result in soup.find_all('div', class_='BNeawe vvjwJb AP7Wnd'):
        search_results.append(result.get_text())
    return search_results

def save_results(results, filename):
    with open(filename, 'w') as file:
        json.dump(results, file)

if __name__ == '__main__':
    app.run(debug=True)
