<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Speaker // 3336 Fontana</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
<script>(function(d,s){if(!window.rel){s=d.createElement("script");s.type="text/javascript";s.async=true;s.id="radio-de-embedded";s.src="https://www.radio.net/inc/microsite/js/full.js";d.getElementsByTagName("head")[0].appendChild(s);window.rel=true;}}(document));</script>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --cyan: #00f5ff;
  --cyan-dim: rgba(0,245,255,0.15);
  --amber: #ffaa00;
  --amber-dim: rgba(255,170,0,0.15);
  --green: #00ff88;
  --red: #ff4455;
  --purple: #bf80ff;
  --purple-dim: rgba(191,128,255,0.15);
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

/* Section labels */
.section-label {
  font-size: 10px; letter-spacing: 3px; color: var(--text-dim);
  text-transform: uppercase; margin-bottom: 12px;
  display: flex; align-items: center; gap: 8px;
}
.section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* Radio player block */
.player-block {
  background: var(--bg2); border: 1px solid var(--border);
  padding: 16px; margin-bottom: 28px; position: relative;
  clip-path: polygon(0 0, calc(100% - 14px) 0, 100% 14px, 100% 100%, 14px 100%, 0 calc(100% - 14px));
}
.player-block::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0;
  height: 1px; background: linear-gradient(90deg, var(--purple), transparent);
}

/* Button grids */
.btn-group {
  display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px;
}
.cmd-btn {
  background: var(--bg3); border: 1px solid var(--border);
  color: var(--cyan); padding: 10px 18px;
  font-family: var(--mono); font-size: 12px; letter-spacing: 1px;
  cursor: pointer; transition: all 0.15s;
  clip-path: polygon(0 0, calc(100% - 6px) 0, 100% 6px, 100% 100%, 6px 100%, 0 calc(100% - 6px));
}
.cmd-btn:hover { background: var(--cyan-dim); border-color: var(--cyan); color: #fff; }
.cmd-btn.mute-btn { color: var(--red); border-color: rgba(255,68,85,0.3); }
.cmd-btn.mute-btn:hover { background: rgba(255,68,85,0.15); border-color: var(--red); }
.cmd-btn.vol-btn { color: var(--amber); border-color: rgba(255,170,0,0.3); }
.cmd-btn.vol-btn:hover { background: var(--amber-dim); border-color: var(--amber); }
.cmd-btn.info-btn { color: var(--text-dim); border-color: rgba(140,185,200,0.2); }
.cmd-btn.info-btn:hover { background: rgba(140,185,200,0.1); border-color: var(--text-dim); color: var(--text); }
.cmd-btn.google-btn { color: var(--purple); border-color: rgba(191,128,255,0.3); }
.cmd-btn.google-btn:hover { background: var(--purple-dim); border-color: var(--purple); }
.cmd-btn.stop-btn { color: var(--red); border-color: rgba(255,68,85,0.3); }
.cmd-btn.stop-btn:hover { background: rgba(255,68,85,0.15); border-color: var(--red); }
.cmd-btn.station-btn { color: var(--green); border-color: rgba(0,255,136,0.25); }
.cmd-btn.station-btn:hover { background: rgba(0,255,136,0.1); border-color: var(--green); }

/* Volume slider visual */
.vol-track {
  display: flex; align-items: center; gap: 4px; margin-bottom: 4px;
}
.vol-seg {
  height: 20px; flex: 1; background: var(--bg3);
  border: 1px solid var(--border); transition: background 0.2s;
  clip-path: polygon(2px 0%, 100% 0%, calc(100% - 2px) 100%, 0% 100%);
}
.vol-seg.active { background: var(--amber); border-color: var(--amber); }

/* Output block */
.output-block {
  background: var(--bg2); border: 1px solid var(--border);
  border-left: 2px solid var(--cyan);
  padding: 14px 16px; font-size: 12px;
  white-space: pre-wrap; word-break: break-word;
  min-height: 48px; margin-bottom: 28px;
}
.output-label { font-size: 10px; letter-spacing: 2px; color: var(--text-dim); margin-bottom: 6px; }
.output-empty { color: var(--text-dim); font-size: 11px; }

/* Footer */
.footer {
  margin-top: 24px; padding-top: 12px;
  border-top: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.footer-id { font-size: 10px; color: var(--text-dim); letter-spacing: 2px; }
.blink { animation: blink 1.2s step-end infinite; color: var(--cyan); }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

/* Now playing banner */
.now-playing {
  background: rgba(0,255,136,0.07); border: 1px solid rgba(0,255,136,0.3);
  border-left: 2px solid var(--green);
  padding: 10px 16px; margin-bottom: 28px;
  font-size: 12px; color: var(--green); letter-spacing: 1px;
  display: flex; align-items: center; gap: 10px;
}
.now-playing .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--green); animation: pulse 1.5s infinite; flex-shrink: 0; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.2} }
</style>
</head>
<body>
<div class="scanlines"></div>
<div class="wrapper">

  <!-- Header -->
  <div class="header">
    <div>
      <div class="header-title">Speaker</div>
      <div class="header-sub">audio control // 3336 fontana</div>
    </div>
    <div class="clock">
      <?php
        date_default_timezone_set('America/Los_Angeles');
        $date = new DateTime();
        echo date_format($date, 'H:i:s');
        echo '<div class="date-line">' . date_format($date, 'Y/m/d') . ' PDT</div>';
      ?>
    </div>
  </div>

  <a class="back-btn" href="javascript:history.back()">&#8592; back</a>

  <!-- Radio player -->
  <div class="section-label">radio stream</div>
  <div class="player-block">
    <div class="ng-app-embedded">
      <div ui-view class="microsite embedded-radio-player"
        data-playerwidth="340px"
        data-playertype="web_embedded"
        data-playstation="bibleradiobook"
        data-autoplay="true"
        data-apikey="df04ff67dd3339a6fc19c9b8be164d5b5245ae93">
      </div>
    </div>
    <noscript><a href="https://www.radio.net/s/bibleradiobook" target="bibleradio">Bible Radio Book on radio.net</a></noscript>
  </div>

<?php
$output_text = '';
$output_label = '';
$now_playing = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = '';
    $value = '';
    foreach ($_POST as $k => $v) {
        $name = $k;
        $value = $v;
    }

    switch ($name) {
        case 'mute':
            $output_text = post_it('mute');
            $output_label = 'mute';
            break;
        case '100': case '95': case '85': case '75':
            $output_text = post_it($name);
            $output_label = 'volume ' . $name . '%';
            break;
        case 'log':
            $raw = file_get_contents('http://speaker.local:5000/log/');
            $output_text = $raw;
            $output_label = 'log';
            break;
        case 'date_time':
            $output_text = file_get_contents('http://speaker.local:5000/date_time/');
            $output_label = 'date / time';
            break;
        case 'cron':
            $output_text = file_get_contents('http://speaker.local:5000/cron/');
            $output_label = 'cron';
            break;
        case 'time':
            $output_text = post_it('heygoogle/time');
            $output_label = 'hey google: time';
            break;
        case 'weather':
            $output_text = post_it('heygoogle/weather');
            $output_label = 'hey google: weather';
            break;
        case 'nature_sounds':
            $output_text = post_it('heygoogle/nature_sounds');
            $output_label = 'hey google: nature sounds';
            break;
        case 'news':
            $output_text = post_it('heygoogle/news');
            $output_label = 'hey google: news';
            break;
        case 'stop':
            $output_text = post_it('heygoogle/stop');
            $output_label = 'stop';
            break;
        default:
            post_it('mute');
            $now_playing = htmlspecialchars($value);
            $output_text = post_it('play_station/' . $value);
            $output_label = 'station response';
            break;
    }
}

function post_it($path) {
    $url = sprintf('http://speaker.local:5000/%s/', $path);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
?>

<?php if ($now_playing): ?>
  <div class="now-playing">
    <div class="dot"></div>
    now playing: <?= $now_playing ?>
  </div>
<?php endif; ?>

  <!-- Volume Control -->
  <div class="section-label">volume control</div>
  <form action="speaker.php" method="post">
    <div class="vol-track" id="vol-track">
      <div class="vol-seg" data-vol="25"></div>
      <div class="vol-seg" data-vol="50"></div>
      <div class="vol-seg" data-vol="75"></div>
      <div class="vol-seg active" data-vol="85"></div>
      <div class="vol-seg active" data-vol="95"></div>
      <div class="vol-seg active" data-vol="100"></div>
    </div>
    <div class="btn-group" style="margin-top:10px;">
      <button class="cmd-btn mute-btn" type="submit" name="mute" value="mute">&#9646;&#9646; mute</button>
      <button class="cmd-btn vol-btn" type="submit" name="100" value="100">100%</button>
      <button class="cmd-btn vol-btn" type="submit" name="95" value="95">95%</button>
      <button class="cmd-btn vol-btn" type="submit" name="85" value="85">85%</button>
      <button class="cmd-btn vol-btn" type="submit" name="75" value="75">75%</button>
    </div>
  </form>

  <!-- Information -->
  <div class="section-label">system info</div>
  <form action="speaker.php" method="post">
    <div class="btn-group">
      <button class="cmd-btn info-btn" type="submit" name="cron" value="cron">cron</button>
      <button class="cmd-btn info-btn" type="submit" name="date_time" value="date_time">date / time</button>
      <button class="cmd-btn info-btn" type="submit" name="log" value="log">log</button>
    </div>
  </form>

  <!-- Hey Google -->
  <div class="section-label">hey google</div>
  <form action="speaker.php" method="post">
    <div class="btn-group">
      <button class="cmd-btn google-btn" type="submit" name="time" value="time">time</button>
      <button class="cmd-btn google-btn" type="submit" name="weather" value="weather">weather</button>
      <button class="cmd-btn google-btn" type="submit" name="nature_sounds" value="nature_sounds">nature sounds</button>
      <button class="cmd-btn google-btn" type="submit" name="news" value="news">news</button>
      <button class="cmd-btn stop-btn" type="submit" name="stop" value="stop">&#9632; stop</button>
    </div>
  </form>

  <!-- Stations -->
  <div class="section-label">stations</div>
  <form action="speaker.php" method="post">
    <div class="btn-group">
      <?php
        $station_output = @file_get_contents('http://speaker.local:5000/list_stations/');
        if ($station_output) {
            $stations = explode(',', trim($station_output));
            foreach ($stations as $item) {
                $item = trim($item);
                if ($item === '') continue;
                echo '<button class="cmd-btn station-btn" type="submit" name="' . htmlspecialchars($item) . '" value="' . htmlspecialchars($item) . '">' . htmlspecialchars($item) . '</button>';
            }
        } else {
            echo '<span style="color:var(--text-dim);font-size:11px;">speaker.local unavailable</span>';
        }
      ?>
    </div>
  </form>

  <!-- Output -->
  <?php if ($output_text || $output_label): ?>
  <div class="section-label">output</div>
  <div class="output-block">
    <?php if ($output_label): ?>
      <div class="output-label">&gt; <?= htmlspecialchars($output_label) ?></div>
    <?php endif; ?>
    <?php if ($output_text): ?>
      <?= nl2br(htmlspecialchars(trim($output_text))) ?>
    <?php else: ?>
      <span class="output-empty">no response</span>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="footer">
    <span class="footer-id">SYS // speaker.local</span>
    <span class="footer-id">AUDIO CTRL <span class="blink">_</span></span>
  </div>

</div>

<script>
// Highlight volume segments on hover
const volBtns = document.querySelectorAll('.vol-btn');
const segs = document.querySelectorAll('.vol-seg');
const volMap = {'100':6,'95':5,'85':4,'75':3,'mute':0};
volBtns.forEach(btn => {
  btn.addEventListener('mouseenter', () => {
    const lvl = volMap[btn.name] || 0;
    segs.forEach((s, i) => s.classList.toggle('active', i < lvl));
  });
});
document.querySelector('.btn-group')?.addEventListener('mouseleave', () => {
  segs.forEach((s, i) => s.classList.toggle('active', i >= 3));
});
</script>
</body>
</html>
