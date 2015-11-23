When you set things up:
1. Copy this whole project to your server folder. eg: /var/www/html/
2. set the correct parameters in the file includes/config.inc.php
3. run the file setup.sh as sudo. eg:
$ cd /var/www/html/hypercube/
$ sudo sh setup.sh

4. Open the mysql prompt. On linux this is done like:
$ mysql -u <user name> -p 
Enter your password.

Once you're in the mysql prompt, execute the temp/db_init.sql script like:
mysql> source temp/db_init.sql

SETUP is done.

Open your browser and go to the url: localhost/hypercube/

To log in as admin, login with username: 'admin' and password: 'admin'.
This takes you to the admin dashboard where you can add problems and contests.

#### Additional Information ####
You might have to change the ownership and permission bits of the files.

I will update this part later.
