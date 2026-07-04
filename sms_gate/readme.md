# SMS Gate

At a high level this is how to I installed and run this service on my rasberry pi

<u>The Crontab</u>

<b>NOTE:</b>  In this case there is no need for a service because it is run from a contrab.

The crontab daemon file

```
# m h  dom mon dow   command
@reboot sudo mount /dev/sda1 /mnt/bookmarks/ -o uid=pi,gid=pi
# run the sms gateway                                           
* * * * * /usr/bin/python3 /home/pi/sms_gate/sms_gate.py      <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
# maintenance to get rid of unwanted emails from gateway
0 8 * * 0 echo 'd *' | mail -N
# notify service has restarted
@reboot /usr/bin/python3 /home/pi/sms_gate/sms_send.py
```

The cron deamon runs the ```sms_gateway.py``` every minute, and the sms_gateway runs in a loop 5 times, waiting 10 seconds between loops. 

<u>The ~/sms_gate folder</u>

 The cron deamon runs the program from   ```~/gate-pi/sms_gate``` . This folder is not in the git repo, so the ```sms_gate.cfg``` in this folder has actual/real values.

