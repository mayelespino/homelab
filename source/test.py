import os
import sqlite3 as sql

dbPath = "/mnt/bookmarks/bookmarks.db"
print(dbPath)
filepath = os.path.abspath(dbPath)
assert os.path.exists(dbPath)

conn = sql.connect(dbPath)
cur = conn.cursor()
cur.execute("SELECT * FROM bookmarks")
print(cur.fetchall())

