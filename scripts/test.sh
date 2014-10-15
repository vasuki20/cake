#!/bin/bash
now="$(date)"
printf "Current date and time %s\n" "$now"
 
now="$(date +'%d_%m_%Y')"

printf "Current date in dd/mm/yyyy format %s\n" "$now"


zipfile="yoonic_latest_$(date +'%d_%m_%Y').tar"

printf "zipfile name %s\n" "$zipfile"

tar -cvf /home/yoonic/www/yoonic-cis-admin/reports/$zipfile.tar /home/yoonic/www/yoonic-cis-admin/reports/latest

printf "done %s\n" "$zipfile"

