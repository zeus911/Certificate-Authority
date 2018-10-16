# Certificate Authority Webapp for OpenSSL

<h2>Create and Manage:</h2> 
1. Certificate Server Requests (CSR/REQ).<br />
2. Certificate with Subject Alternative Name.
3. Code Signing (Java, Microsoft Authenticode)
4. Create PFX/P12 archives.
5. Create Java Keystores.
6. Update, Renew, Revoke, Delete certificates.
7. Check if CSR/Certificate/PrivateKey matches.
8. More TLS tools...

<h3>Installation:</h3>
1. git clone https://github.com/lopeaa/certificate-authority
2. Replace/create .env file with yours.
3. composer update

<h3>Configuration:</h3>
1. Login with "email" has been replace with "username" in:
 "/vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUsers.php"

Then, do the same with register.blade.php and login.blade.php in order to add the "username" form.

<h3>How to start:</h3>
1. Register a new Username in /register and use it to login. 
