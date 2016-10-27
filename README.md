# Sipher-PHP-Ransomware
This is a very minimal ransomware written in php which can be used to encrypt the webroot of any server with AES-256 twice

#Encrypt
To encrypt a website, upload the encrypt.php to the webserver, and then edit the 'invoker.html' and change the POST address to encrypt.php
The open the 'invoker.html' with any browser and enter the 'key 1, key 2 & iv' with which you want to encrypt the webserver and click submit.
In the next some moments, the whole webserver will be double encrypted, first with 'key 1' and then with 'key 2'

#Decrypt
To decrypt the encrypted webserver, upload the decrypt.php to the webserver and then edit the 'invoker.html' to change the post address to decrypt.php
Then open 'invoker.html' and enter the appropriate key values(The same ones used to encrypt the webserver or it can lead to data loss) and click submit
Int the next moments, the webserver will be decrypted
