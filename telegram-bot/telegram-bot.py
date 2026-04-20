import requests, time, subprocess, configparser

config = configparser.ConfigParser()
config.read("telegram-bot.ini")

TOKEN = config["telegram"]["token"]
CHAT_ID = int(config["telegram"]["chat_id"])
offset = 0

COMMANDS = {
    "/ping":  ping(),
}


def status():
        return "PONG"
    
######################################################################
#
######################################################################
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

        if msg.get("chat", {}).get("id") != CHAT_ID:
            continue

        text = msg.get("text", "").strip()
        print(f"Received command: {text}")
        if text in COMMANDS:
            try:
                result = COMMANDS[text]
                send(result)
            except Exception as e:
                send(f"Error: {e}")