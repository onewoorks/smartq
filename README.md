# SMART QUEUE BACKED API
SmartQueue mobile apps basic restful api to serve and feed a required data and information. This application is based on php and please make sure your environment is php ready with minimum php version 5.6 and mysql 5.7 to support json datatype

## basic configuration 
database setup
 1. import sql from *libraries/drivers/onewoork_smartq.sql*
 2. open *libraries/drivers/mysql.php*
 3. change line 13 - 16 accordingly

## test application
 1. open any internet browser
 2. go to *http://localhost/smartq/organisation.json?quesortImi*
 3. the page will return list of organisation as stored in database.
