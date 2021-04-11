# Overview
This project is about a simple job board listing website, written in vanilla PHP language version 7.
# Setup
I used XAMPP running on Windows to serve the application (mine was v3.2.4, but every greater version which supports PHP 7 should be okay).
# Steps to run the application
1. Upload the *jobs.sql* file to phpMyAdmin
2. If you have additional settings for the MySQL server like *username* and *password* change the file **db_settings.php** located at folder **db** accordingly
3. Run the Apache server and everything should be okay
# Information about the application
First thing you should see when you access the application should be the job listing page. At the top there is a simple navigation which has links to the *submission form* for a job offer registration and *login* page which is for the administrative panel only.
## Credentials for admin panel
**Email:** *admin@abv.bg*

**Password:** *123456*

Everyone can submit job offers. By default all job offer submissions are not published directly into the listing page and should be approved by *Admin*. After approval the job is listed. From the admin panel the administrator can view the job offer details and edit/delete or reject already approved offer if he wants to.



