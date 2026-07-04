<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>3336 Fontana</title>
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
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,0,0,0.03) 2px, rgba(0,0,0,0.03) 4px);
  pointer-events: none;
  z-index: 100;
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
.clock { font-family: var(--display); font-size: 14px; color: var(--amber); text-align: right; letter-spacing: 1px; }
.clock .date-line { font-size: 10px; color: var(--text-dim); margin-top: 2px; letter-spacing: 2px; }

/* Section labels */
.section-label {
  font-size: 10px; letter-spacing: 3px; color: var(--text-dim);
  text-transform: uppercase; margin-bottom: 12px;
  display: flex; align-items: center; gap: 8px;
}
.section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* Nav buttons */
.nav-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 8px; margin-bottom: 28px;
}
.nav-btn {
  background: var(--bg3); border: 1px solid var(--border);
  color: var(--cyan); padding: 10px 14px;
  font-family: var(--mono); font-size: 12px; letter-spacing: 1px;
  cursor: pointer; text-decoration: none;
  display: flex; align-items: center; gap: 8px;
  transition: all 0.15s;
  clip-path: polygon(0 0, calc(100% - 8px) 0, 100% 8px, 100% 100%, 8px 100%, 0 calc(100% - 8px));
}
.nav-btn:hover { background: var(--cyan-dim); border-color: var(--cyan); color: #fff; }
.nav-btn .icon { opacity: 0.6; }
.nav-btn.amber { color: var(--amber); border-color: rgba(255,170,0,0.3); }
.nav-btn.amber:hover { background: var(--amber-dim); border-color: var(--amber); color: #fff; }

/* Node cards */
.nodes-grid {
  display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 10px; margin-bottom: 28px;
}
.node-card {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 14px; position: relative; overflow: hidden;
  clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 0 100%);
}
.node-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px; background: linear-gradient(90deg, var(--cyan), transparent);
}
.corner-decor {
  position: absolute; top: 0; right: 0;
  width: 10px; height: 10px;
  border-top: 2px solid var(--cyan); border-right: 2px solid var(--cyan); opacity: 0.5;
}
.node-name {
  font-family: var(--display); font-size: 11px; font-weight: 700;
  letter-spacing: 2px; color: var(--cyan); text-transform: uppercase; margin-bottom: 4px;
}
.node-addr { font-size: 11px; color: var(--text-dim); margin-bottom: 8px; }
.status-row { display: flex; align-items: center; gap: 8px; }
.dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
.dot.online  { background: var(--green); animation: pulse 2s infinite; }
.dot.offline { background: var(--red); }
.dot.unknown { background: var(--text-dim); }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.3} }
.status-text { font-size: 11px; color: var(--text-dim); }
.ping-val { margin-left: auto; font-size: 11px; }
.ping-val.ok { color: var(--green); }
.ping-val.fail { color: var(--red); }

/* Ping output (collapsible) */
.ping-raw {
  margin-top: 8px; font-size: 10px; color: var(--text-dim);
  background: rgba(0,0,0,0.3); padding: 6px 8px;
  border-left: 2px solid var(--border);
  white-space: pre-wrap; word-break: break-all;
  display: none;
}
.node-card:hover .ping-raw { display: block; }

/* External links */
.links-section {
  border: 1px solid var(--border); background: var(--bg2); padding: 16px;
  clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
  margin-bottom: 28px;
}
.link-row {
  display: flex; align-items: center; gap: 12px;
  padding: 8px 0; border-bottom: 1px solid rgba(0,245,255,0.07);
}
.link-row:last-child { border-bottom: none; }
.link-row a { color: var(--cyan); text-decoration: none; font-size: 12px; letter-spacing: 1px; transition: color 0.15s; }
.link-row a:hover { color: #fff; }
.link-tag {
  font-size: 9px; letter-spacing: 2px; color: var(--text-dim);
  background: rgba(0,245,255,0.07); padding: 2px 6px;
  border: 1px solid rgba(0,245,255,0.15); text-transform: uppercase; flex-shrink: 0;
}
.link-row a.external::after { content: ' ↗'; opacity: 0.5; font-size: 10px; }

/* Sensor / speaker output blocks */
.output-block {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 12px 16px; margin-bottom: 10px; font-size: 12px;
  border-left: 2px solid var(--cyan);
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

  <!-- Header -->
  <div class="header">
    <div>
      <div class="header-title">3336 Fontana</div>
      <div class="header-sub">homelab // local network control</div>
    </div>
    <div class="clock">
      <?php
        date_default_timezone_set('America/Los_Angeles');
        $date = new DateTime();
        echo date_format($date, 'H:i:s') . '<br>';
        echo '<span class="date-line">' . date_format($date, 'Y/m/d') . ' PDT</span>';
      ?>
    </div>
  </div>

  <!-- Navigation -->
  <div class="section-label">navigation</div>
  <div class="nav-grid">
    <a class="nav-btn" href="sensor.php"><span class="icon">◈</span> sensor</a>
    <?php
      $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
      if ($url == "gate.local/") {
        echo '<a class="nav-btn" href="speaker.php"><span class="icon">◈</span> speaker</a>';
      } else {
        echo '<span class="nav-btn" style="opacity:0.4;cursor:default;"><span class="icon">◈</span> speaker</span>';
      }
    ?>
    <?php
      if ($url == "gate.local/") {
        echo '<a class="nav-btn amber" href="http://gate.local:3000" target="_blank"><span class="icon">◈</span> grafana</a>';
      } else {
        echo '<span class="nav-btn amber" style="opacity:0.4;cursor:default;"><span class="icon">◈</span> grafana</span>';
      }
    ?>
    <a class="nav-btn" href="bookmarks.php"><span class="icon">◈</span> bookmarks</a>
    <a class="nav-btn amber" href="http://sensor.local:667" target="_blank"><span class="icon">◈</span> darkstat</a>
    <a class="nav-btn amber" href="http://sensor.local:3000" target="_blank"><span class="icon">◈</span> ntopng</a>
  </div>

  <!-- Sensor & Speaker outputs -->
  <?php
    $sensor_out = @file_get_contents('http://sensor.local');
    if ($sensor_out) {
      echo '<div class="section-label">sensor output</div>';
      echo '<div class="output-block">' . $sensor_out . '</div>';
    }
    $speaker_out = @file_get_contents('http://speaker.local');
    if ($speaker_out) {
      echo '<div class="section-label">speaker output</div>';
      echo '<div class="output-block">' . $speaker_out . '</div>';
    }
  ?>

  <!-- Network nodes -->
  <div class="section-label">network nodes</div>
  <div class="nodes-grid">
    <?php
      $nodes = [
        ['sensorpi',  'sensor.local'],
        ['speaker',   'speaker.local'],
        ['supermicro','supermicro'],
        ['super2',    'super2'],
        ['antsle',    'antsle.local'],
        ['chaperon',  'chaperon.local'],
        ['mac-mini',  'Mac-mini-2.lan'],
      ];
      foreach ($nodes as [$label, $host]) {
        $raw = shell_exec("ping -c1 -W1 " . escapeshellarg($host) . " 2>&1");
        $online = (strpos($raw, '1 received') !== false || strpos($raw, '1 packets received') !== false || strpos($raw, 'bytes from') !== false);
        // extract time=Xms if present
        preg_match('/time[<=]([\d.]+)\s*ms/i', $raw, $m);
        $ping_ms = isset($m[1]) ? round((float)$m[1]) . 'ms' : null;
        $dot_class = $online ? 'online' : 'offline';
        $status_text = $online ? 'reachable' : 'unreachable';
        echo '<div class="node-card">';
        echo '<div class="corner-decor"></div>';
        echo '<div class="node-name">' . htmlspecialchars($label) . '</div>';
        echo '<div class="node-addr">' . htmlspecialchars($host) . '</div>';
        echo '<div class="status-row">';
        echo '<div class="dot ' . $dot_class . '"></div>';
        echo '<span class="status-text">' . $status_text . '</span>';
        if ($ping_ms) echo '<span class="ping-val ok">~' . $ping_ms . '</span>';
        echo '</div>';
        echo '<div class="ping-raw">' . htmlspecialchars(trim($raw)) . '</div>';
        echo '</div>';
      }
    ?>
  </div>

  <!-- External links -->
  <div class="section-label">external links</div>
  <div class="links-section">
    <div class="link-row">
      <span class="link-tag">emergency</span>
      <a class="external" href="https://www.sf72.org" target="_blank">SF72 — San Francisco Emergency</a>
    </div>
    <div class="link-row">
      <span class="link-tag">news</span>
      <a class="external" href="https://text.npr.org" target="_blank">NPR text</a>
    </div>
  </div>

  <div class="footer">
    <span class="footer-id">SYS // <?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?></span>
    <span class="footer-id">STATUS: NOMINAL <span class="blink">_</span></span>
  </div>

</div>
</body>
</html>
