#
# To stop the player:
# $pkill mplayer
#
# Credit:
# - https://stackoverflow.com/questions/20021457/playing-mp3-song-on-python
#
# Links:
# - https://docs.python.org/3/library/webbrowser.html
#
import webbrowser
import sys
import requests

fileName = sys.argv[1]

response = requests.head(f'http://localhost/media/{fileName}')
if response.status_code != 200:
	sys.exit("ERROR. Can't read supplied filename.")


webbrowser.open(f'media/{fileName}')
