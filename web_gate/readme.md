# gate-pi

<u>The web-gate-startup.service</u>

There is a separate ```nginx``` installation and systemctl service for the web server.

<u>web-gate-startup.service</u>

The ```web-gate-startup.service``` is concerned with stating and managing the tunnel. The tunnel service I use is <a href="https://pinggy.io">https://pinggy.io</a>. The tunnel I create is ```https://fontana3336pl.a.pinggy.link```  then mapped so to ```http://mayelespino.com/home```


<u>/var/www/html/index.php</u>

The ```/var/www/html/index.php``` is the main file that links in the following:

- speaker.php
- sensor.php
- bookmarks.php

The PHP files executes requests to the REST API of the corresponding services running on other raspberry pies. The files need to be copied here from the git repo: ```gate-pi/web_gate```.