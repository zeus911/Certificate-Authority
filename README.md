# Certificate Authority Webapp
This is a webapp for OpenSSL CA.

Installation:
1. git clone https://github.com/lopeaa/certificate-authority
2. Replace/create .env file with yours
3. composer update

Configuration:
1. Login with "email" has been replace with "username" in /var/www/webapps/ca/vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php

Then, do the same with register.blade.php and login.blade.php in order to add the "username" form.

Use:
1. Register a new Username and use it to login. Then, do the same with register.blade.php and login.blade.php in order to add the "username" form.
