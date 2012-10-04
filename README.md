voting-fb-app
=============

A Facebook App for Voting On 3 Items.
	- Can schedule vote "campaigns" to run at certain times
	- Stores on Amazon S3


Install Instructions
--------------------

Pre-Requisites: MongoDB, Amazon S3 Storage Bucket

1) Clone from repo with:
	git clone git@github.com:/six0h/voting-fb-app.git

2) Copy config_sample.php to config.php

3) Set your required Path information

4) Edit Global variables in www/js/site.js to your desired settings

5) Add an administrator to mongo with the following Document Schema:
	{'first_name':'FIRSTNAMEHERE','last_name':'LASTNAMEHERE','email':'EMAILHERE','admin':1,'password':'PASSHERE'}

Be sure to place your password in the database as an MD5 HASH of its original self, do not use plain-text, it will not work.

Visit http://whateveryouraddress.com/admin to login with your new administrator password and create a campaign.



THIS SOFTWARE IS NOT FREE TO USE IN ANY FORM OR FASHION, THIS WAS CREATED AS AN ARCHIVE TO EASILY GRAB FROM BY THE OWNER OF THIS MATERIAL.
IF YOU ARE INTERESTED IN USING THIS SOFTWARE, PLEASE CONTACT THE OWNER AT CODY@TELENOVA.CA.
