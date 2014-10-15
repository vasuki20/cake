cd /home/yoonic/www/yoonic-cis-admin/reports
echo "Entering /home/yoonic/www/yoonic-cis-admin/reports"
rsync -e ssh `ls -rt | grep daily | tail -1` yoonic@maxis.ms.yoonic.tv:/home/yoonic/www/estd_new/app/tmp
echo "Daily done"
rsync -e ssh `ls -rt | grep week | tail -1` yoonic@maxis.ms.yoonic.tv:/home/yoonic/www/estd_new/app/tmp
echo "Weekly done"
rsync -e ssh `ls -rt | grep month | tail -1` yoonic@maxis.ms.yoonic.tv:/home/yoonic/www/estd_new/app/tmp
echo "Monthly done"
