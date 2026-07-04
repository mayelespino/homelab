import sqlite3
from sqlite3 import Error
import csv


try:
    conn = sqlite3.connect("bookmarks.db")
    cur = conn.cursor()
    cur.execute('''CREATE TABLE IF NOT EXISTS bookmarks(url, description, tags); ''')
except Error as e:
    print(e)




with open('Bookmarks.csv') as csv_file:
    csv_reader = csv.reader(csv_file, delimiter=',')
    line_count = 0
    for row in csv_reader:
        # print(f'\t{row[1]}')
        sql = ''' INSERT INTO bookmarks(url,description,tags) VALUES(?,?,?) '''
        cur.execute(sql, (row[0], row[1], ""))
        line_count += 1
    print(f'Processed {line_count} lines.')
conn.commit()
