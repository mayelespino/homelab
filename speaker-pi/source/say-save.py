from gtts import gTTS
import os
import sys

if len(sys.argv) < 2:
   sys.exit("Must provide a text")

tts = gTTS(text=str(sys.argv[1]), lang='en')

tts.save("tmp.mp3")
