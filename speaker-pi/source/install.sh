#!/bin/sh
cp index.html /var/www/html
cp -R media /var/www/html
#
pip3 install playsound
pip3 install pydub
pip3 install PyAudio
pip3 install ffmpeg
pip3 install gtts
