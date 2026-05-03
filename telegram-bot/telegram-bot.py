import requests, time, subprocess, configparser

config = configparser.ConfigParser()
config.read("telegram-bot.ini")

TOKEN = config["telegram"]["token"]
CHAT_ID = int(config["telegram"]["chat_id"])
offset = 0

def ping():
        return "PONG"
def echo():
        return "ECHO"

COMMANDS = {
    "/ping":  ping(),
    "/echo":  echo(),
}


    
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
        print(update)
        offset = update["update_id"] + 1
        msg = update.get("message", {})

        if msg.get("chat", {}).get("id") != CHAT_ID:
            continue

        text = msg.get("text", "").strip().lower()
        command = text.split()[0] if text else ""
        parameters = text.split()[1:] if len(text.split()) > 1 else []
        if command in COMMANDS:
            try:
                result = COMMANDS[command]
                if result == "ECHO":
                     echoString = update.get("message", {}).get("from", {}).get("first_name", "") + " " + update.get("message", {}).get("from", {}).get("last_name", "") + ": " + " ".join(parameters)
                     send(echoString)
                else:
                    send(result)
            except Exception as e:
                send(f"Error: {e}")