import os

search_word = "padang laweh"
for root, dirs, files in os.walk("."):
    # Skip vendor and node_modules
    if "vendor" in root or "node_modules" in root or ".git" in root:
        continue
    for file in files:
        if file.endswith((".php", ".json", ".js", ".css", ".html")):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8") as f:
                    content = f.read()
                    if search_word in content.lower():
                        print(f"Found in: {path}")
            except Exception as e:
                pass
