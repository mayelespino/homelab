import configparser
import imaplib
import email
from smtplib import SMTP_SSL, SMTP_SSL_PORT
import requests
from icecream import ic
import time

def ping():
    return("PONG!!")

def help(functDict):
    return(", ".join(functDict.keys()))

def speakerCron():
    api_url = f"{speakerpi}/cron/"
    return(requests.get(api_url).text)

def speakerList():
    api_url = f"{speakerpi}/list_stations/"
    return(requests.get(api_url).text)

def speakerMute():
    api_url = f"{speakerpi}/mute/"
    return(requests.post(api_url).text)

def speakerAmbient():
    api_url = f"{speakerpi}/play_station/ambient1/"
    return(requests.post(api_url).text)

def speakerBible():
    api_url = f"{speakerpi}/play_station/biblia3/"
    return(requests.post(api_url).text)

def speakerWawas():
    api_url = f"{speakerpi}/play_station/reggae1/"
    return(requests.post(api_url).text)

def speakerTalk():
    api_url = f"{speakerpi}/play_station/theater1/"
    return(requests.post(api_url).text)

def heyGoogleNews():
    api_url = f"{speakerpi}/heygoogle/news/"
    return(requests.post(api_url).text)

def heyGoogleWeather():
    api_url = f"{speakerpi}/heygoogle/weather/"
    return(requests.post(api_url).text)

def heyGoogleStop():
    api_url = f"{speakerpi}/heygoogle/stop/"
    return(requests.post(api_url).text)

def heyGoogleTime():
    api_url = f"{speakerpi}/heygoogle/time/"
    return(requests.post(api_url).text)

def heyGoogleNatureSounds():
    api_url = f"{speakerpi}/heygoogle/nature_sounds/"
    return(requests.post(api_url).text)

def sensorBright():
    api_url = f"{sensorpi}/brightness/"
    response = requests.get(api_url).text
    return(f"brightness: {response}")

def sensorHumidity():
    api_url = f"{sensorpi}/humidity/"
    response = requests.get(api_url).text
    return(f"humidity: {response}")

def sensorOnBoardTemp():
    api_url = f"{sensorpi}/onboard-temp/"
    response = requests.get(api_url).text
    return(f"on board temp: {response}")

def sensorTemp():
    api_url = f"{sensorpi}/temperature/"
    response = requests.get(api_url).text
    return(f"ambient temp: {response}")

def sensorBarometer():
    api_url = f"{sensorpi}/barometer/"
    response = requests.get(api_url).text
    return(f"barometer: {response}")

def sensorMotion():
    api_url = f"{sensorpi}/human/"
    response = requests.get(api_url).text
    return(f"motion sensor: {response}")

def speedTest():
    api_url = f"{sensorpi}/speedtest/"
    return(requests.get(api_url).text)

def sensorAll():
    api_url = f"{sensorpi}/all/"
    return(requests.get(api_url).text)

#########################################################
# Main - Implementation
#########################################################
def main (functionDictionary):

    # Read email configuration values
    imap_server = config['DEFAULT']['imap_server']
    imap_password = config['DEFAULT']['imap_password']
    gate_email = config['DEFAULT']['gate_email']
    SMTP_HOST = config['DEFAULT']['smtp_server']
    SMTP_USER = config['DEFAULT']['gate_email']
    SMTP_PASS = config['DEFAULT']['smtp_password']
    gate_email = config['DEFAULT']['gate_email']
    sms_email = config['DEFAULT']['sms_email']
    gate_email_body = config['DEFAULT']['gate_email_body']
    gate_email_subject = config['DEFAULT']['gate_email_subject']

    # Connect to inbox
    imap_server = imaplib.IMAP4_SSL(host=imap_server)
    imap_server.login(gate_email, imap_password)
    imap_server.select()  # Default is `INBOX`

    # Craft the email
    from_email = f'<{gate_email}>'  
    to_emails = [f'{sms_email}']
    body = f"{gate_email_body}"
    headers = f"From: {gate_email}\r\n"
    headers += f"To: {', '.join(to_emails)}\r\n"
    headers += f"Subject: {gate_email_subject}\r\n"


    # Find all emails in inbox and print out the raw email data
    _, message_numbers_raw = imap_server.search(None, 'ALL')
    sms_request = ""
    sms_response = ""
    for message_number in message_numbers_raw[0].split():
        _, msg = imap_server.fetch(message_number, '(RFC822)')
    
        message = email.message_from_bytes(msg[0][1])

        if message.is_multipart():
            multipart_payload = message.get_payload()
            for sub_message in multipart_payload:
                sms_request = sub_message.get_payload()
                ic("multipart", sms_request)
        else:  # Not a multipart message, payload is simple string
            sms_request = message.get_payload()
            ic("single", sms_request)

        # Delete an email
        imap_server.store(message_number, '+FLAGS', '\Deleted')


    # Expunge after marking emails deleted
    imap_server.expunge()

    sms_request_parts = sms_request.lower().strip().split()
    ic(sms_request_parts)

    sms_request_function = '_'.join(sms_request_parts)
    ic(sms_request_function)
    if sms_request_function not in functionDictionary:
        ic("Not found.", sms_request_function)
        return
    elif functionDictionary[sms_request_function] == help:
        sms_response = help(functionDictionary)
        ic("help", sms_response)
    else:
        sms_response = functionDictionary[sms_request_function]()
        ic("else", sms_response)
    
    body = f"{sms_response}"
    ic(body)
    email_message = headers + "\r\n" + body  # Blank line needed between headers and body
    # Connect, authenticate, and send mail
    smtp_server = SMTP_SSL(SMTP_HOST, port=SMTP_SSL_PORT)
    smtp_server.set_debuglevel(0)  # Set to 1 to show SMTP server interactions
    smtp_server.login(SMTP_USER, SMTP_PASS)
    smtp_server.sendmail(from_email, to_emails, email_message)
    # Disconnect
    smtp_server.quit()

#########################################################
# Main()
#########################################################

if __name__ == "__main__" :
    # Read configuration file
    config = configparser.ConfigParser()
    config.read('/home/pi/sms_gate/sms_gate.cfg')
    speakerpi = config['DEFAULT']['speakerpi_url']
    sensorpi = config['DEFAULT']['sensorpi_url']
    ic.disable()

    functionDict = {
            "ping"                  : ping,
            "help"                  : help,
            "?"                     : help,
            "mute"                  : speakerMute,
            "speaker"               : speakerList,
            "speaker_cron"          : speakerCron,
            "speaker_list"          : speakerList,
            "speaker_stations"      : speakerList,
            "speaker_ambient"       : speakerAmbient,
            "speaker_mute"          : speakerMute,
            "speaker_ambient"       : speakerAmbient,
            "speaker_wawas"         : speakerWawas,
            "speaker_talk"          : speakerTalk,
            "speaker_bible"         : speakerBible,
            "google_news"           : heyGoogleNews,
            "google_stop"           : heyGoogleStop,
            "google_time"           : heyGoogleTime,
            "google_nature"         : heyGoogleNatureSounds,
            "google_weather"        : heyGoogleWeather,
            "sensor_bright"         : sensorBright,
            "sensor_brightness"     : sensorBright,
            "sensor_humidity"       : sensorHumidity,
            "sensor_board_temp"     : sensorOnBoardTemp,
            "sensor_temp"           : sensorTemp,
            "sensor_barometer"      : sensorBarometer,
            "sensor_motion"         : sensorMotion,
            "speed_test"            : speedTest,
            "speedtest"             : speedTest,
            "sensor_all"            : sensorAll,
        }

    for i in range(5):
        main(functionDict)
        time.sleep(10)

# EOF
