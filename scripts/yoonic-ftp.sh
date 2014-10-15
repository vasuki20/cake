#!/bin/sh

$zipfile="yoonic-latest_$(date +'%d_%m_%Y').tar"
tar -cvf /home/yoonic/www/yoonic-cis-admin/reports/$zipfile /home/yoonic/www/yoonic-cis-admin/reports/latest


HOST='ftp.users.qwest.net'
USER='yourid'
PASSWD='yourpw'
FILE='/home/yoonic/www/yoonic-cis-admin/reports/$zipfile'

ftp -inv $HOST <<END_SCRIPT
quote USER $USER
quote PASS $PASSWD
cd /to/dump/dir
put $FILE
quit

mv /home/yoonic/www/yoonic-cis-admin/reports/$zipfile /home/yoonic/www/yoonic-cis-admin/reports/archive

END_SCRIPT
exit 0

