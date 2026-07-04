#!/bin/sh
#ssh -p 443 -R0:localhost:80 -o StrictHostKeyChecking=no -o ServerAliveInterval=30 1pDpXhEzpW4@a.pinggy.io
while true; do 
    ssh -p 443 -o StrictHostKeyChecking=no -o ServerAliveInterval=30 -R0:localhost:80 a.pinggy.io; 
sleep 10; done
