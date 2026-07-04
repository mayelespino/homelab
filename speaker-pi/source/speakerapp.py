from flask import Flask
import subprocess 
import logging
import sys

app = Flask(__name__)
app.config.from_object("config.ProductionConfig")

#
# Health check
#

@app.route('/')
def root():
    dict = app.config["STATIONS"]
    stations = str(dict).replace(",","<BR/>\n")
    return stations

#
# set up logger
#
logger = logging.getLogger()
logger.setLevel(logging.INFO)
formatter = logging.Formatter('%(asctime)s | %(levelname)s | %(message)s')

file_handler = logging.FileHandler('/mnt/ramdisk/speaker.log')
file_handler.setLevel(logging.INFO)
file_handler.setFormatter(formatter)

logger.addHandler(file_handler)

#
# Volume
#

@app.route('/mute/', methods=['POST'])
def play_mute():
    subprocess.Popen(["/usr/bin/pkill","mplayer","-c"])
    subprocess.Popen(["/usr/bin/pkill","omxplayer","-c"])
    logger.info("play_mute - OK")
    return "play_mute - OK"

@app.route('/100/', methods=['POST'])
def vol_100():
    subprocess.Popen(["sudo","/usr/bin/amixer","set", "PCM", "--", "100%"])
    logger.info("vol_100 - OK")
    return "vol_100 - OK"

@app.route('/95/', methods=['POST'])
def vol_95():
    subprocess.Popen(["sudo","/usr/bin/amixer","set", "PCM", "--", "95%"])
    logger.info("vol_95 - OK")
    return "vol_95 - OK"

@app.route('/85/', methods=['POST'])
def vol_85():
    subprocess.Popen(["sudo","/usr/bin/amixer","set", "PCM", "--", "85%"])
    logger.info("vol_85 - OK")
    return "vol_85 - OK"

@app.route('/75/', methods=['POST'])
def vol_75():
    subprocess.Popen(["sudo","/usr/bin/amixer","set", "PCM", "--", "75%"])
    logger.info("vol_75 - OK")
    return "vol_75 - OK"

@app.route('/50/', methods=['POST'])
def vol_50():
    subprocess.Popen(["sudo","/usr/bin/amixer","set", "PCM", "--", "50%"])
    logger.info("vol_50 -OK")
    return "vol_50 -OK"

#
# Utils
#
@app.route('/cron/', methods=['GET'])
def util_cron():
    p = subprocess.Popen(["/usr/bin/crontab","-l"], stdout=subprocess.PIPE)
    out, err = p.communicate()
    logger.info("util_cron",out)
    return out

@app.route('/date_time/', methods=['GET'])
def util_date_time():
    p = subprocess.Popen(["/bin/date"], stdout=subprocess.PIPE)
    out, err = p.communicate()
    logger.info("util_date_time",out)
    return out


@app.route('/log/', methods=['GET'])
def util_log():
    p = subprocess.Popen(["/bin/cat", "/mnt/ramdisk/speaker.log"], stdout=subprocess.PIPE)
    out, err = p.communicate()
    logger.info("util_log",out)
    return out

#
# Play a station
#
@app.route('/play_station/<station>/', methods=['POST'])
def play_station(station):
    dict = app.config["STATIONS"]
    if not dict.has_key(station):
       return "unknown station: {}".format(station)
    stat = dict[station]
    subprocess.Popen(["/usr/bin/mplayer","-playlist", stat])
    logger.info("play_station: {} - OK".format(stat))
    return "play_station: {} - OK".format(stat)
#
# List stations
#
@app.route('/list_stations/', methods=['GET'])
def list_station():
    stationsDict = app.config["STATIONS"]
    stationList = list(stationsDict.keys()) 
    stationList.sort()
    logger.info("list_station")
    return ",".join(stationList)

#
# Hey Google
#
@app.route('/heygoogle/<command>/', methods=['POST'])
def hey_google(command):
	if command == "time":
    		subprocess.Popen(["/usr/bin/mplayer","/var/www/html/media/hg_what_time.mp3"])
	elif command ==  "weather":
    		subprocess.Popen(["/usr/bin/mplayer","/var/www/html/media/hg_weather.mp3"])
	elif command ==  "nature_sounds":
    		subprocess.Popen(["/usr/bin/mplayer","/var/www/html/media/hg_nature_sounds.mp3"])
	elif command ==  "news":
    		subprocess.Popen(["/usr/bin/mplayer","/var/www/html/media/hg_news.mp3"])
	elif command ==  "stop":
    		subprocess.Popen(["/usr/bin/mplayer","/var/www/html/media/hg_stop.mp3"])
	return "OK\n"

#
# MAIN
#
if __name__ == '__main__':
    app.run(debug=False, host='0.0.0.0')
