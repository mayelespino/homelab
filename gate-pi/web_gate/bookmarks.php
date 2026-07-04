<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bookmarks // 3336 Fontana</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --cyan: #00f5ff;
  --cyan-dim: rgba(0,245,255,0.15);
  --amber: #ffaa00;
  --amber-dim: rgba(255,170,0,0.15);
  --green: #00ff88;
  --green-dim: rgba(0,255,136,0.12);
  --red: #ff4455;
  --bg: #050c12;
  --bg2: #080f17;
  --bg3: #0d1a24;
  --border: rgba(0,245,255,0.2);
  --text: rgba(200,235,245,0.9);
  --text-dim: rgba(140,185,200,0.5);
  --mono: 'Share Tech Mono', monospace;
  --display: 'Orbitron', sans-serif;
}
html, body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--mono);
  font-size: 13px;
  line-height: 1.6;
  min-height: 100vh;
}
.scanlines {
  position: fixed; top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);
  pointer-events: none; z-index: 100;
}
.wrapper { max-width: 900px; margin: 0 auto; padding: 24px 20px; }

/* Header */
.header {
  display: flex; align-items: flex-end; justify-content: space-between;
  border-bottom: 1px solid var(--border);
  padding-bottom: 16px; margin-bottom: 24px; position: relative;
}
.header::before {
  content: ''; position: absolute; bottom: -1px; left: 0;
  width: 120px; height: 2px; background: var(--cyan);
}
.header-title {
  font-family: var(--display); font-size: 26px; font-weight: 900;
  color: var(--cyan); letter-spacing: 4px; text-transform: uppercase;
}
.header-sub { font-size: 11px; color: var(--text-dim); letter-spacing: 2px; margin-top: 4px; }

/* Back button */
.back-btn {
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--bg3); border: 1px solid var(--border);
  color: var(--text-dim); padding: 8px 16px;
  font-family: var(--mono); font-size: 12px; letter-spacing: 1px;
  cursor: pointer; text-decoration: none; margin-bottom: 24px;
  transition: all 0.15s;
  clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
}
.back-btn:hover { background: var(--cyan-dim); border-color: var(--cyan); color: var(--cyan); }

/* Section label */
.section-label {
  font-size: 10px; letter-spacing: 3px; color: var(--text-dim);
  text-transform: uppercase; margin-bottom: 12px;
  display: flex; align-items: center; gap: 8px;
}
.section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* Form panels */
.form-panel {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 20px; margin-bottom: 28px; position: relative;
  clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
}
.form-panel.add-panel::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px; background: linear-gradient(90deg, var(--green), transparent);
}
.form-panel.search-panel::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px; background: linear-gradient(90deg, var(--cyan), transparent);
}

.field-group { margin-bottom: 14px; }
.field-label {
  display: block; font-size: 10px; letter-spacing: 2px;
  color: var(--text-dim); text-transform: uppercase; margin-bottom: 6px;
}
.field-input {
  width: 100%; background: var(--bg3);
  border: 1px solid var(--border); color: var(--text);
  padding: 9px 12px; font-family: var(--mono); font-size: 13px;
  outline: none; transition: border-color 0.15s;
  clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.field-input:focus { border-color: var(--cyan); background: rgba(0,245,255,0.04); }
.field-input::placeholder { color: var(--text-dim); }

.submit-btn {
  background: transparent; border: 1px solid var(--green);
  color: var(--green); padding: 10px 28px;
  font-family: var(--mono); font-size: 12px; letter-spacing: 2px;
  cursor: pointer; transition: all 0.15s; text-transform: uppercase;
  clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
  margin-top: 4px;
}
.submit-btn:hover { background: var(--green-dim); color: #fff; }
.submit-btn.search { border-color: var(--cyan); color: var(--cyan); }
.submit-btn.search:hover { background: var(--cyan-dim); }

/* Tag chips */
.tag-hint {
  font-size: 10px; color: var(--text-dim); margin-top: 4px; letter-spacing: 1px;
}

/* Footer */
.footer {
  margin-top: 24px; padding-top: 12px;
  border-top: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.footer-id { font-size: 10px; color: var(--text-dim); letter-spacing: 2px; }
.blink { animation: blink 1.2s step-end infinite; color: var(--cyan); }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }
</style>
</head>
<body>
<div class="scanlines"></div>
<div class="wrapper">

  <div class="header">
    <div>
      <div class="header-title">Bookmarks</div>
      <div class="header-sub">link archive // 3336 fontana</div>
    </div>
  </div>

  <a class="back-btn" href="index.php">&#8592; home</a>

  <!-- Add bookmark -->
  <div class="section-label">add bookmark</div>
  <div class="form-panel add-panel">
    <form name="add_form" method="post" action="add_bm_form.php">
      <div class="field-group">
        <label class="field-label" for="url">url</label>
        <input class="field-input" type="text" id="url" name="url" placeholder="https://...">
      </div>
      <div class="field-group">
        <label class="field-label" for="description">description</label>
        <input class="field-input" type="text" id="description" name="description" placeholder="brief description">
      </div>
      <div class="field-group">
        <label class="field-label" for="tags">tags</label>
        <input class="field-input" type="text" id="tags" name="tags" placeholder="tag1 tag2 tag3">
        <div class="tag-hint">space-separated tags</div>
      </div>
      <button class="submit-btn" type="submit">&#43; save bookmark</button>
    </form>
  </div>

  <!-- Search -->
  <div class="section-label">search</div>
  <div class="form-panel search-panel">
    <form name="search_form" method="post" action="search_bm_form.php">
      <div class="field-group">
        <label class="field-label" for="search_string">search query</label>
        <input class="field-input" type="text" id="search_string" name="search_string" placeholder="url, description, or tag...">
      </div>
      <button class="submit-btn search" type="submit">&#8981; search</button>
    </form>
  </div>

  <!--
  <?php
    class MyDB extends SQLite3 {
      function __construct() {
        $this->open('bookmarks.db');
      }
    }
    $db = new MyDB();
    if (!$db) {
      echo $db->lastErrorMsg();
    } else {
      echo "Opened database successfully<br>\n";
    }
    $sql = "SELECT * from bookmarks;";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
      echo "URL = " . htmlspecialchars($row['url']) . "<br>\n";
      echo "DESCRIPTION = " . htmlspecialchars($row['description']) . "<br>\n";
      echo "TAGS = " . htmlspecialchars($row['tags']) . "<br>\n";
      echo "<br>\n";
    }
    echo "Operation done successfully<br>\n";
    $db->close();
  ?>
  -->

  <div class="footer">
    <span class="footer-id">SYS // bookmarks.db</span>
    <span class="footer-id">ARCHIVE <span class="blink">_</span></span>
  </div>

</div>
</body>
</html>

