<?php
//set_error_handler("customError",E_USER_WARNING);
//error_reporting(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("BASE_TIME_ZONE","Asia/Calcutta");
define("VIEWPORT","width=device-width, initial-scale=1.0, user-scalable=0");//width=device-width, initial-scale=1, shrink-to-fit=no (bootstrap 4)

define("BASE_URL","http://localhost/college-admission");
define("BASE_URL_ADMIN","http://localhost/college-admission/admin");
define("BASE_URL_CLIENT","http://localhost/college-admission/client");
define("BASE_URL_UPLOADS","http://localhost/college-admission/uploads");// local
//define("BASE_URL","http://192.168.1.9/Journal");// WITH IPv4

define("GOOGLE_FONT_1","https://fonts.googleapis.com/css?family=Poppins|Roboto|Rubik|Viga|Oswald|Inter&display=swap");
define("FONT_AWESOME_CSS","https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css");

define("CURRENT_YEAR","2024");

define("COLLEGE_NAME","CollegeAdmission.in");
define("SITE_TAGLINE","Administrator Panel");
//define("SITE_URL","");

define("COLLEGE_LOGO","images/logo.jpg");
define("FAVICON","images/logo.jpg");

define("MODAL_VALIDATION_TEXT","<i class='fa fa-exclamation-triangle mr-1 faa-flash animated'></i>Alert!");

//define("SESSIONNAME","0");
    $local_timezone = BASE_TIME_ZONE;
    date_default_timezone_set($local_timezone);	
?>