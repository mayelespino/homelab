
# The payload for different file/message types 

## Audio

```
{"ok":true,"result":[{"update_id":940961528,
"message":{"message_id":17,"from":{"id":8679559480,"is_bot":false,"first_name":"Mayel","last_name":"Espino","language_code":"en"},"chat":{"id":8679559480,"first_name":"Mayel","last_name":"Espino","type":"private"},"date":1776047495,"voice":{"duration":2,"mime_type":"audio/ogg","file_id":"AwACAgEAAxkBAAMRadxVhyDt1UzZjtRYwurtScaW1nEAAlYMAALLFOFGULCJ6FV7qZU7BA","file_unique_id":"AgADVgwAAssU4UY","file_size":11543}}}]}
```

## GIF

```
"message":{"message_id":19,"from":{"id":8679559480,"is_bot":false,"first_name":"Mayel","last_name":"Espino","language_code":"en"},"chat":{"id":8679559480,"first_name":"Mayel","last_name":"Espino","type":"private"},"date":1776047831,"sticker":{"width":512,"height":512,"emoji":"\ud83d\udc2f","set_name":"UtyaDuck","is_animated":true,"is_video":false,"type":"regular","thumbnail":{"file_id":"AAMCAgADGQEAAxNp3FbX-DblgFe6AAE6J7JmRM8HULIAAlACAAJWnb0Kg9DUR-s4-9oBAAdtAAM7BA","file_unique_id":"AQADUAIAAladvQpy","file_size":6662,"width":128,"height":128},"thumb":{"file_id":"AAMCAgADGQEAAxNp3FbX-DblgFe6AAE6J7JmRM8HULIAAlACAAJWnb0Kg9DUR-s4-9oBAAdtAAM7BA","file_unique_id":"AQADUAIAAladvQpy","file_size":6662,"width":128,"height":128},"file_id":"CAACAgIAAxkBAAMTadxW1_g25YBXugABOieyZkTPB1CyAAJQAgACVp29CoPQ1EfrOPvaOwQ","file_unique_id":"AgADUAIAAladvQo","file_size":21802}}}]}
```

## Plain text
```
"message":{"message_id":18,"from":{"id":8679559480,"is_bot":false,"first_name":"Mayel","last_name":"Espino","language_code":"en"},"chat":{"id":8679559480,"first_name":"Mayel","last_name":"Espino","type":"private"},"date":1776047737,"text":"Simple text"}},{"update_id":940961530,
```

## Photo
```
message":{"message_id":20,"from":{"id":8679559480,"is_bot":false,"first_name":"Mayel","last_name":"Espino","language_code":"en"},"chat":{"id":8679559480,"first_name":"Mayel","last_name":"Espino","type":"private"},"date":1776048066,"photo":[{"file_id":"AgACAgEAAxkBAAMUadxXwhOoColswHrj6E81CWGHqDkAAiANaxvLFOFGHZBvQw1fmdsBAAMCAANzAAM7BA","file_unique_id":"AQADIA1rG8sU4UZ4","file_size":1395,"width":59,"height":90},{"file_id":"AgACAgEAAxkBAAMUadxXwhOoColswHrj6E81CWGHqDkAAiANaxvLFOFGHZBvQw1fmdsBAAMCAANtAAM7BA","file_unique_id":"AQADIA1rG8sU4UZy","file_size":28932,"width":210,"height":320},{"file_id":"AgACAgEAAxkBAAMUadxXwhOoColswHrj6E81CWGHqDkAAiANaxvLFOFGHZBvQw1fmdsBAAMCAAN4AAM7BA","file_unique_id":"AQADIA1rG8sU4UZ9","file_size":162334,"width":524,"height":800},{"file_id":"AgACAgEAAxkBAAMUadxXwhOoColswHrj6E81CWGHqDkAAiANaxvLFOFGHZBvQw1fmdsBAAMCAAN5AAM7BA","file_unique_id":"AQADIA1rG8sU4UZ-","file_size":233636,"width":839,"height":1280}]}}]}
```

----
# Telegram Bot Setup for Homelab Alerts

## Initial Setup (5 minutes)
1. Create your bot

Open Telegram, search for @BotFather
Send /newbot, follow prompts, give it a name
BotFather gives you a token like 123456789:ABCdef... — save this

2. Get your chat ID

## Send any message to your new bot
Visit this URL in your browser:

https://api.telegram.org/bot<TOKEN>/getUpdates

Look for "chat":{"id":123456789} — that number is your chat ID


## Sending Alerts
Dead simple with curl:

```
bashTOKEN="123456789:ABCdef..."
CHAT_ID="123456789"

## Basic alert
curl -s "https://api.telegram.org/bot$TOKEN/sendMessage" \
  -d chat_id=$CHAT_ID \
  -d text="Backup completed ✅"

## With Markdown formatting
curl -s "https://api.telegram.org/bot$TOKEN/sendMessage" \
  -d chat_id=$CHAT_ID \
  -d parse_mode=Markdown \
  -d text="*ALERT* CPU at \`95%\`"

```

Or a reusable bash function you can drop in any script:

bash# Add to ~/.bashrc or a shared lib script

```
tg() {
  curl -s "https://api.telegram.org/bot$TOKEN/sendMessage" \
    -d chat_id=$CHAT_ID \
    -d text="$1" > /dev/null
}
```

# Usage anywhere
tg "Disk usage at 90%"
tg "Salt minion vm-02 is unreachable"

Python Integration

```
pythonimport requests

TOKEN = "123456789:ABCdef..."
CHAT_ID = "123456789"

def alert(message, parse_mode=None):
    payload = {"chat_id": CHAT_ID, "text": message}
    if parse_mode:
        payload["parse_mode"] = parse_mode
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendMessage", data=payload)

# Plain
alert("Backup done")

# Formatted
alert("*WARNING* Disk at `90%`", parse_mode="Markdown")
```

Two-Way Interaction (the good part)
This is where Telegram shines. You can build a command interface where typing commands to your bot triggers actions on your server.
Simple polling listener — runs on your server, checks for new messages:
pythonimport requests, time, subprocess

```
TOKEN = "123456789:ABCdef..."
CHAT_ID = 123456789  # int this time
offset = 0

COMMANDS = {
    "/status":  "systemctl status salt-master --no-pager",
    "/disk":    "df -h /",
    "/uptime":  "uptime",
    "/temps":   "sensors",
    "/vms":     "multipass list",
}

def send(text):
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendMessage",
                  data={"chat_id": CHAT_ID, "text": text})

def get_updates():
    global offset
    r = requests.get(f"https://api.telegram.org/bot{TOKEN}/getUpdates",
                     params={"offset": offset, "timeout": 30}, timeout=35)
    return r.json().get("result", [])

while True:
    for update in get_updates():
        offset = update["update_id"] + 1
        msg = update.get("message", {})

        # Only respond to yourself
        if msg.get("chat", {}).get("id") != CHAT_ID:
            continue

        text = msg.get("text", "").strip()

        if text in COMMANDS:
            result = subprocess.check_output(COMMANDS[text], shell=True).decode()
            send(f"```\n{result}\n```")
        elif text == "/help":
            send("\n".join(COMMANDS.keys()))
        else:
            send(f"Unknown command. Try /help")
```


Run this as a systemd service and you have a persistent bot that responds to your commands.

Systemd Service
ini# /etc/systemd/system/telegram-bot.service

```
[Unit]
Description=Telegram Homelab Bot
After=network.target

[Service]
ExecStart=/usr/local/pyenv/versions/3.14.3/bin/python /home/node/telegram_bot.py
Restart=always
RestartSec=5
Environment=PYTHONUNBUFFERED=1

[Install]
WantedBy=multi-user.target
bashsudo systemctl daemon-reload
sudo systemctl enable --now telegram-bot
sudo systemctl status telegram-bot
```

Inline Keyboards (Button UI)
You can send messages with clickable buttons instead of typing commands:
pythonimport json, requests

```
def send_with_buttons(text, buttons):
    keyboard = {"inline_keyboard": [[{"text": b, "callback_data": b} for b in row] for row in buttons]}
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendMessage", json={
        "chat_id": CHAT_ID,
        "text": text,
        "reply_markup": keyboard
    })

send_with_buttons("Choose action:", [
    ["/status", "/disk"],
    ["/uptime", "/vms"]
])
```

Security Tips

Always verify chat ID in your listener — reject messages from anyone else
Store your token in an env variable or file, not hardcoded:

```
#bash  
export TG_TOKEN="your-token"
export TG_CHAT_ID="your-chat-id"
```

Consider a private bot (BotFather → /setjoingroups disable, /setprivacy enabled)


Feature Comparison vs Ntfy

FeatureTelegramNtfyFree-form replies✅ Yes❌ 

NoButton actions✅ Yes✅ 

YesSelf-hostable⚠️ Partial (API server)✅ 

FullyNo account needed❌ Needs account✅ 

YesWorks in browser✅ web.telegram.org✅ 

YesFormatting (Markdown)✅ Yes⚠️ 

LimitedFile/image sending✅ Yes✅ Yes


For your use case — interacting with your home server via replies — Telegram is the stronger choice. 
The polling listener above gives you a full command interface in about 50 lines of Python.
what number do I use for chat id?7:02 PMWhen you visit:
https://api.telegram.org/bot<TOKEN>/getUpdates
```

You'll get JSON that looks like this:

```
json{
  "result": [{
    "message": {
      "chat": {
        "id": 123456789,
        "first_name": "Mayel",
        "type": "private"
      },
      "text": "/start"
    }
  }]
}
```

The number next to "id" inside the "chat" object — that's your chat ID. It's your personal chat with the bot.
If you get an empty result ("result": []), it means the bot hasn't received any messages yet — go to Telegram, find your bot, and send it any message (like /start), then reload the URL.what if the bot sends an audio file or a picture?7:29 PMThe getUpdates response will look different depending on the media type. Here's what to expect:
Photo:

````
json{
  "message": {
    "chat": {"id": 123456789},
    "photo": [
      {"file_id": "ABC123...", "width": 320, "height": 240},
      {"file_id": "DEF456...", "width": 800, "height": 600}
    ],
    "caption": "optional text"
  }
}
Photos come as an array of sizes — use the last one for highest resolution.
Audio:
json{
  "message": {
    "chat": {"id": 123456789},
    "audio": {
      "file_id": "ABC123...",
      "duration": 30,
      "title": "filename.mp3"
    }
  }
}
```

But I think you're asking how to send these from your server to yourself. Here's how:
Send a photo:
python# From a file

```
with open("screenshot.png", "rb") as f:
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendPhoto",
                  data={"chat_id": CHAT_ID, "caption": "Server screenshot"},
                  files={"photo": f})
```

# From a URL

```
requests.post(f"https://api.telegram.org/bot{TOKEN}/sendPhoto",
              data={"chat_id": CHAT_ID, "photo": "https://example.com/image.png"})
Send an audio file:
pythonwith open("alert.mp3", "rb") as f:
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendAudio",
                  data={"chat_id": CHAT_ID},
                  files={"audio": f})
Send any file (graphs, logs, etc):
pythonwith open("server.log", "rb") as f:
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendDocument",
                  data={"chat_id": CHAT_ID, "caption": "Today's log"},
                  files={"document": f})
```

A useful homelab pattern is sending a graph or chart as an image — e.g. generate a matplotlib plot of CPU usage and send it directly to yourself:

```
pythonimport matplotlib.pyplot as plt
import requests, io
```

# Generate plot
```
plt.plot([1,2,3,4,5], [20,45,80,60,95])
plt.title("CPU Usage")
```

# Save to buffer and send without writing to disk

```
buf = io.BytesIO()
plt.savefig(buf, format="png")
buf.seek(0)

requests.post(f"https://api.telegram.org/bot{TOKEN}/sendPhoto",
              data={"chat_id": CHAT_ID, "caption": "CPU last 5 min"},
              files={"photo": buf})
```

# systemclt

## to enable the service so that it always starts

```
sudo cp ~/telegram-bot/telegram-bot.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable --now telegram-bot.service
```

## Check the status

```
sudo systemctl status telegram-bot.service
```