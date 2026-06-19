import sqlite3

conn = sqlite3.connect("database/database.sqlite")
cursor = conn.cursor()

# Get all tables
cursor.execute("SELECT name FROM sqlite_master WHERE type='table';")
tables = [row[0] for row in cursor.fetchall()]

for table in tables:
    try:
        cursor.execute(f"PRAGMA table_info({table});")
        columns = [row[1] for row in cursor.fetchall()]
        
        cursor.execute(f"SELECT * FROM {table};")
        rows = cursor.fetchall()
        
        for r_idx, row in enumerate(rows):
            for c_idx, val in enumerate(row):
                if val and "padang" in str(val).lower():
                    print(f"Found in table '{table}', column '{columns[c_idx]}', row index {r_idx}: {val}")
    except Exception as e:
        print(f"Error checking table {table}: {e}")

conn.close()
