#!/bin/sh
grep HREF Safari\ Bookmarks.html | cut -d'"' -f2 -f3 | tr '<A>' ' '| tr '"' ',' > Bookmarks.csv

