import requests
import configparser
import inspect

config = configparser.ConfigParser()
config.read("/home/pi/telegram-bot/telegram-bot.ini")
TOKEN = config["telegram"]["token"]
CHAT_ID = int(config["telegram"]["chat_id"])
offset = 0

######################################################################
# Speaker API helpers
######################################################################

def post_it(path):
    try:
        r = requests.post(f"http://speaker.local:5000/{path}/", timeout=5)
        r.raise_for_status()
        return r.text or "(empty response)"
    except requests.RequestException as e:
        return f"Error: {e}"

def list_stations():
    try:
        r = requests.get("http://speaker.local:5000/list_stations/", timeout=5)
        r.raise_for_status()
        return r.text or "(empty response)"
    except requests.RequestException as e:
        return f"Error fetching stations: {e}"

######################################################################
# Commands
######################################################################
def help_cmd():
    return "Available commands:\n" + "\n".join(sorted(COMMANDS.keys()))

def ping():
    return "PONG@chap"

def echo(update, parameters):
    first = update.get("message", {}).get("from", {}).get("first_name", "")
    last  = update.get("message", {}).get("from", {}).get("last_name", "")
    return f"{first} {last}: {' '.join(parameters)}"

def play_station(update, parameters):
    if not parameters:
        return "Usage: /play <station_name>"
    return post_it(f"play/{parameters[0]}")

def volume(update, parameters):
    if not parameters:
        return "Usage: /volume <0-100>"
    return post_it(f"volume/{parameters[0]}")

def time_cmd():
    return post_it("heygoogle/time")

def weather():
    return post_it("heygoogle/weather")

def nature_sounds():
    return post_it("heygoogle/nature_sounds")

def news():
    return post_it("heygoogle/news")

def stop():
    return post_it("heygoogle/stop")

######################################################################

COMMANDS = {
    "/ping":          ping,
    "/echo":          echo,
    "/stations":      list_stations,
    "/play":          play_station,
    "/volume":        volume,
    "/time":          time_cmd,
    "/weather":       weather,
    "/nature_sounds": nature_sounds,
    "/news":          news,
    "/stop":          stop,
    "/help":          help_cmd,
}

######################################################################
# Telegram helpers
######################################################################

def send(text):
    requests.post(f"https://api.telegram.org/bot{TOKEN}/sendMessage",
                  data={"chat_id": CHAT_ID, "text": text})

def get_updates():
    global offset
    r = requests.get(f"https://api.telegram.org/bot{TOKEN}/getUpdates",
                     params={"offset": offset, "timeout": 30}, timeout=35)
    return r.json().get("result", [])

######################################################################
# Main loop
######################################################################

while True:
    for update in get_updates():
        offset = update["update_id"] + 1
        msg = update.get("message", {})
        if msg.get("chat", {}).get("id") != CHAT_ID:
            continue
        text       = msg.get("text", "").strip().lower()
        parts      = text.split()
        command    = parts[0] if parts else ""
        parameters = parts[1:] if len(parts) > 1 else []

        if command in COMMANDS:
            try:
                fn  = COMMANDS[command]
                sig = inspect.signature(fn)
                if len(sig.parameters) == 0:
                    result = fn()
                else:
                    result = fn(update, parameters)
                send(result)
            except Exception as e:
                send(f"Error: {e}")

