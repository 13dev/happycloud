<?php
//date_default_timezone_set('America/Montreal');

#Database details
define('dbname', 'DBNAME');
define('dbhost', 'HOST');
define('dbuser', 'USER');
define('dbpass', 'PASS');


#Editor password
define('editorPass', 'PASS OF EDITOR');

#Enter your URL, leave out the trailing "/"
define('yourURL', 'DOMAIN NAME');

#Service name
define('serviceName', 'SERVICE NAME');

#Service footer
define('bitdropFooter', 'Copyright© Happycloud 2016');

#Create image thumbnails, true/false 
define('useThumb', false);

#Size of the short URL, ex: yourURL.com/a4vGfD <- Size 6
define('shortURLSize', 3);

#http or https
define('URLPrefix', 'http');

#Enable or Disable HotLink protection, true/false
define('hotLinkProtection', true);

#The maximum file size in bytes
define('maxFileSize', 1330000000);

#The maximum allowed downloads, set 0 for Unlimited
define('maxAllowedDownloads', 0);

#Enable BitDrop API access, true/false
define('enableAPI', true);

#Block flagged files from being downloaded, true/false
define('blockOnFlag', false);

#Debug mode (Not In Use)
define('debugMode', 1);

#Limit file types, true/false
define('limitFileTypes', false);

#List of allowed file types, comma seperated, NO spaces
#Ref List https://en.wikipedia.org/wiki/Internet_media_type#List_of_common_media_types
define('allowedFileTypes', 'image/gif,image/jpg,image/jpeg,image/png,image/JPG,image/pjpeg,image/GIF');

#Set the time your file expires
/* Time Chart
 * Never	| 0
 * 30 Min	| 1800
 * 1 Hour	| 3600
 * 3 Hours	| 10800
 * 1 Day	| 86400
 * 1 Week	| 604800
 * 3 Weeks	| 1814400
 3dias
 */
define('expireTime', 1814400);
?>