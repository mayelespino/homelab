class Config(object):
    DEBUG = False
    TESTING = False

class ProductionConfig(Config):
    STATIONS = { 
        "chill1" : "http://uk4.internet-radio.com:8049/listen.pls",
	"chill2" : "http://199.233.234.34:25373/listen.pls",
	"chill3" : "http://91.121.38.100:8220/listen.pls",
        "dance1" : "http://hirschmilch.de:7000/listen.pls",
        "theater1" : "http://176.31.98.109:4962/listen.pls",
        "theater2" : "http://74.50.122.103:7372/listen.pls",
        "bible1" : "http://listen.wofr.org:8888/kjv.m3u",
        "bolero1" : "http://192.99.83.154:8024/listen.pls",
	"ambient1" : "http://uk5.internet-radio.com:8347/listen.pls",
	"ambient2" : "http://uk5.internet-radio.com:8260/listen.pls",
	"nature1" : "http://nap.casthost.net:8793/listen.pls",
	"christian1" : "http://server10.reliastream.com:8043/listen.pls",
    }
