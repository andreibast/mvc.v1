<?php

define('DEBUG', true);

//database settings
define('DB_NAME', 'andreimvc.v1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1'); //database host. Use IP address to avoid DNS lookup




define('DEFAULT_CONTROLLER', 'Home'); //default controller if there isn't one defined in the URL
define('DEFAULT_LAYOUT', 'default'); //if no layout is set in the controller, use this layout.

define('PROOT', '/AndreiMVC/mvc.v1/'); //less likely to set this on live servers. Created this line to '/' for live server. (proot =project root)

define('SITE_TITLE','Andrei MVC Framework'); //this will be used if no site title is set

define('CURRENT_USER_SESSION_NAME', 'kwXeuysqldkKfejkFEkFEf'); //session name for logged user
define('REMEMBER_ME_COOKIE_NAME', 'KLfLjl35rfrKL4fffws'); //cookie name for logged user
define('REMEMBER_ME_COOKIE_EXPIRY', 604800); //time in seconds for remember-me-cookie to live (30 days)


