@echo off

rem 
set DB_HOST="localhost"
set DB_USER="root"
set DB_PASSWORD=""
set DB_NAME="final"

rem 
set CURRENT_TIME=%date% %time%

rem 
mysql -h %DB_HOST% -u %DB_USER% -p%DB_PASSWORD% %DB_NAME% -e "UPDATE job_post SET job_status = 'Closed' WHERE '%CURRENT_TIME%' NOT BETWEEN AdStartDate AND AdEndDate;"