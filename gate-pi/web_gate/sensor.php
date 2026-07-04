<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sensor // 3336 Fontana</title>
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
  --blue: #4488ff;
  --purple: #bf80ff;
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
.clock { font-family: var(--display); font-size: 14px; color: var(--amber); text-align: right; letter-spacing: 1px; }
.clock .date-line { font-size: 10px; color: var(--text-dim); margin-top: 2px; letter-spacing: 2px; }

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

/* Sensor grid */
.sensor-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 10px;
  margin-bottom: 28px;
}

.sensor-card {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 16px; position: relative; overflow: hidden;
  clip-path: polygon(0 0, calc(100% - 10px) 0, 100% 10px, 100% 100%, 0 100%);
}
.sensor-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px;
}
.sensor-card.temp::before    { background: linear-gradient(90deg, var(--amber), transparent); }
.sensor-card.humid::before   { background: linear-gradient(90deg, var(--blue), transparent); }
.sensor-card.bright::before  { background: linear-gradient(90deg, #ffff55, transparent); }
.sensor-card.baro::before    { background: linear-gradient(90deg, var(--purple), transparent); }
.sensor-card.motion::before  { background: linear-gradient(90deg, var(--red), transparent); }
.sensor-card.default::before { background: linear-gradient(90deg, var(--cyan), transparent); }

.corner-decor {
  position: absolute; top: 0; right: 0;
  width: 10px; height: 10px;
  border-top: 2px solid var(--cyan); border-right: 2px solid var(--cyan); opacity: 0.4;
}

.sensor-icon {
  font-size: 22px; margin-bottom: 8px; display: block; line-height: 1;
}
.sensor-label {
  font-size: 10px; letter-spacing: 2px; color: var(--text-dim);
  text-transform: uppercase; margin-bottom: 6px;
}
.sensor-value {
  font-family: var(--display); font-size: 20px; font-weight: 700;
  letter-spacing: 1px; line-height: 1.2;
}
.sensor-value.temp-color    { color: var(--amber); }
.sensor-value.humid-color   { color: var(--blue); }
.sensor-value.bright-color  { color: #ffff55; }
.sensor-value.baro-color    { color: var(--purple); }
.sensor-value.motion-color  { color: var(--red); }
.sensor-value.default-color { color: var(--cyan); }
.sensor-value.unavail       { color: var(--text-dim); font-size: 13px; font-family: var(--mono); font-weight: 400; }

.sensor-unit {
  font-family: var(--mono); font-size: 11px;
  color: var(--text-dim); margin-top: 2px;
}

/* Timestamp bar */
.timestamp-bar {
  background: var(--bg2); border: 1px solid var(--border);
  border-left: 2px solid var(--cyan);
  padding: 10px 16px; margin-bottom: 28px;
  display: flex; align-items: center; gap: 12px; font-size: 12px;
}
.timestamp-bar .ts-label { color: var(--text-dim); letter-spacing: 1px; }
.timestamp-bar .ts-value { color: var(--cyan); }

/* Speedtest block */
.speedtest-block {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 16px; margin-bottom: 28px; position: relative;
  clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
}
.speedtest-block::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px; background: linear-gradient(90deg, var(--green), transparent);
}
.speedtest-rows { display: flex; flex-direction: column; gap: 6px; margin-top: 4px; }
.speedtest-row {
  display: flex; align-items: baseline; gap: 10px;
  padding: 5px 0; border-bottom: 1px solid rgba(0,245,255,0.06);
  font-size: 12px;
}
.speedtest-row:last-child { border-bottom: none; }
.speedtest-key { color: var(--text-dim); min-width: 140px; flex-shrink: 0; }
.speedtest-val { color: var(--green); }
.speedtest-unavail { color: var(--text-dim); font-size: 11px; }

/* Motion indicator */
.motion-active { color: var(--red) !important; }
.motion-clear  { color: var(--green) !important; }

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

<?php
date_default_timezone_set('America/Los_Angeles');
$date = new DateTime();

function fetch_sensor($path) {
  $val = @file_get_contents('http://sensor.local:5000/' . $path . '/');
  return ($val !== false && trim($val) !== '') ? trim($val) : null;
}

$ts         = fetch_sensor('time-stamp');
$brightness = fetch_sensor('brightness');
$humidity   = fetch_sensor('humidity');
$onboard    = fetch_sensor('onboard-temp');
$temp       = fetch_sensor('temperature');
$baro       = fetch_sensor('barometer');
$motion     = fetch_sensor('human');
$speedtest  = fetch_sensor('speedtest');
?>

  <!-- Header -->
  <div class="header">
    <div>
      <div class="header-title">Sensor</div>
      <div class="header-sub">environment monitor // 3336 fontana</div>
    </div>
    <div class="clock">
      <?= date_format($date, 'H:i:s') ?>
      <div class="date-line"><?= date_format($date, 'Y/m/d') ?> PDT</div>
    </div>
  </div>

  <a class="back-btn" href="javascript:history.back()">&#8592; back</a>

  <!-- Last check timestamp -->
  <div class="timestamp-bar">
    <span class="ts-label">last check</span>
    <span class="ts-value"><?= $ts ? htmlspecialchars($ts) : '— unavailable' ?></span>
  </div>

  <!-- Sensor cards -->
  <div class="section-label">readings</div>
  <div class="sensor-grid">

    <!-- Temperature -->
    <div class="sensor-card temp">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9651;</span>
      <div class="sensor-label">temperature</div>
      <?php if ($temp): ?>
        <div class="sensor-value temp-color"><?= htmlspecialchars($temp) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

    <!-- Onboard Temp -->
    <div class="sensor-card temp">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9651;</span>
      <div class="sensor-label">onboard temp</div>
      <?php if ($onboard): ?>
        <div class="sensor-value temp-color"><?= htmlspecialchars($onboard) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

    <!-- Humidity -->
    <div class="sensor-card humid">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9670;</span>
      <div class="sensor-label">humidity</div>
      <?php if ($humidity): ?>
        <div class="sensor-value humid-color"><?= htmlspecialchars($humidity) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

    <!-- Barometer -->
    <div class="sensor-card baro">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9711;</span>
      <div class="sensor-label">barometer</div>
      <?php if ($baro): ?>
        <div class="sensor-value baro-color"><?= htmlspecialchars($baro) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

    <!-- Brightness -->
    <div class="sensor-card bright">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9788;</span>
      <div class="sensor-label">brightness</div>
      <?php if ($brightness): ?>
        <div class="sensor-value bright-color"><?= htmlspecialchars($brightness) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

    <!-- Motion -->
    <div class="sensor-card motion">
      <div class="corner-decor"></div>
      <span class="sensor-icon">&#9650;</span>
      <div class="sensor-label">motion</div>
      <?php if ($motion !== null):
        $motion_lc = strtolower($motion);
        $detected = (strpos($motion_lc, 'true') !== false || strpos($motion_lc, 'yes') !== false || strpos($motion_lc, '1') !== false);
      ?>
        <div class="sensor-value <?= $detected ? 'motion-active' : 'motion-clear' ?>">
          <?= $detected ? 'DETECTED' : 'clear' ?>
        </div>
        <div class="sensor-unit"><?= htmlspecialchars($motion) ?></div>
      <?php else: ?>
        <div class="sensor-value unavail">unavailable</div>
      <?php endif; ?>
    </div>

  </div>

  <!-- Speedtest -->
  <div class="section-label">speedtest</div>
  <div class="speedtest-block">
    <?php if ($speedtest): ?>
      <div class="speedtest-rows">
        <?php
          $parts = explode(',', $speedtest);
          foreach ($parts as $part) {
            $part = trim($part);
            if ($part === '') continue;
            if (strpos($part, ':') !== false) {
              [$k, $v] = explode(':', $part, 2);
              echo '<div class="speedtest-row"><span class="speedtest-key">' . htmlspecialchars(trim($k)) . '</span><span class="speedtest-val">' . htmlspecialchars(trim($v)) . '</span></div>';
            } else {
              echo '<div class="speedtest-row"><span class="speedtest-val">' . htmlspecialchars($part) . '</span></div>';
            }
          }
        ?>
      </div>
    <?php else: ?>
      <span class="speedtest-unavail">sensor.local unavailable</span>
    <?php endif; ?>
  </div>

  <div class="footer">
    <span class="footer-id">SYS // sensor.local</span>
    <span class="footer-id">ENV MONITOR <span class="blink">_</span></span>
  </div>

</div>
</body>
</html>

