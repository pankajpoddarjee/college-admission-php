<?php
//set_error_handler("customError",E_USER_WARNING);
//error_reporting(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("BASE_TIME_ZONE","Asia/Calcutta");
define("VIEWPORT","width=device-width, initial-scale=1.0, user-scalable=0");//width=device-width, initial-scale=1, shrink-to-fit=no (bootstrap 4)

/*define("BASE_URL","https://localhost/college-admission");// local
define("BASE_URL_UPLOADS","https://localhost/college-admission/uploads");// local*/

define("BASE_URL","https://localhost/college-admission");// IPV4
define("BASE_URL_UPLOADS","https://localhost/college-admission/uploads");// IPV4
define("BASE_URL_ROOT","/college-admission");

define("GOOGLE_FONT_1","https://fonts.googleapis.com/css?family=Poppins|Roboto|Archivo|Sarabun|Rubik|Viga|Oswald|Nunito|Montserrat");
define("FONT_AWESOME_CSS","https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css");

define("CURRENT_YEAR","2024");
define("CURRENT_YEAR_DISPLAY_C_PAGE","2024"); //For using in College pages title section
define("ACADEMIC_SESSION","2024-2025");

define("SITE_NAME","College Admission");
define("SITE_TAGLINE","Education Information Diary of India");
define("SITE_URL","www.collegeadmission.in");

define("SITE_LOGO","images/ca_logo.png");
define("FAVICON","images/ico.png");

define("OTHER_META_TAGS","<meta name='robots' content='noindex, nofollow'><meta name='googlebot' content='noindex, nofollow'><meta name='author' content='https://www.collegeadmission.in'><meta name='document-distribution' content='Global'><meta property='og:site_name' content='collegeadmission.in'><meta property='og:type' content='article'>
");

define("GOOGLE_AD_JS",'<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>');
define("SHOW_C_PAGE_HEADER_ADM_LINK","1");

define("MODAL_VALIDATION_TEXT","<i class='fa fa-exclamation-triangle mr-1 faa-flash animated'></i>Alert!");
define("BR","%0a"); //for whatsapp chat line break
define("WHATSAPP_API_URL","https://api.whatsapp.com/send?phone=91"); //for whatsapp chat line break

//define("SESSIONNAME","0");
    $local_timezone = BASE_TIME_ZONE;
    date_default_timezone_set($local_timezone);	


?>