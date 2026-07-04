import configparser
from smtplib import SMTP_SSL, SMTP_SSL_PORT
from icecream import ic



# Read configuration file
config = configparser.ConfigParser()
config.read('/home/pi/sms_gate/sms_gate.cfg')
ic.disable()


SMTP_HOST = config['DEFAULT']['smtp_server']
SMTP_USER = config['DEFAULT']['gate_email']
SMTP_PASS = config['DEFAULT']['smtp_password']
gate_email = config['DEFAULT']['gate_email']
sms_email = config['DEFAULT']['sms_email']
gate_email_body = config['DEFAULT']['gate_email_body']
gate_email_subject = config['DEFAULT']['gate_email_subject']


# Craft the email
from_email = f'<{gate_email}>'  
to_emails = [f'{sms_email}']
body = f"{gate_email_body}"
headers = f"From: {gate_email}\r\n"
headers += f"To: {', '.join(to_emails)}\r\n"
headers += f"Subject: {gate_email_subject}\r\n"


email_message = headers + "\r\n" + body  # Blank line needed between headers and body
ic(email_message)

# Connect, authenticate, and send mail
smtp_server = SMTP_SSL(SMTP_HOST, port=SMTP_SSL_PORT)
smtp_server.set_debuglevel(0)  # Set to 1 to show SMTP server interactions
smtp_server.login(SMTP_USER, SMTP_PASS)
smtp_server.sendmail(from_email, to_emails, email_message)
# Disconnect
smtp_server.quit()

