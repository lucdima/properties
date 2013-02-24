<?php
if (($_SERVER['SERVER_ADDR']=='127.0.0.1') OR ($_SERVER['SERVER_ADDR']=="::1")) {
	define("SERVER","localhost");
	define("DATABASE","properties");
	define("DATABASEUSER","root");
	define("DATABASEPASSWORD","omaha44");
	define("MAILERCLASSPATH","/var/www/central/mailer5.0.0/class.phpmailer.php");
	define("ABSHTTPPATH","http://localhost/properties/");
}
	else {
	if ($_SERVER['SERVER_ADDR']=='173.254.20.191') {
		define("SERVER","localhost");
		define("DATABASE","centras3_hm");
		define("DATABASEUSER","centras3_hm");
		define("DATABASEPASSWORD","I1A+O(W@(d.*");
		define("MAILERCLASSPATH","mailer5.0.0/class.phpmailer.php");	
		define("SMTPSERVER","localhost");
		define("SMTPUSER","");
		define("SMTPPASS","");
		define("ABSHTTPPATH","http://www.centraldeactores.com/homemakers/");
	} else {
	if ($_SERVER['SERVER_ADDR']=='200.26.189.11') {
		define("SERVER","localhost");
		define("DATABASE","puntomep_properties");
		define("DATABASEUSER","puntomep_prop");
		define("DATABASEPASSWORD","$0pKF4Rcdc]+");
		define("MAILERCLASSPATH","mailer5.0.0/class.phpmailer.php");	
		define("SMTPSERVER","localhost");
		define("SMTPUSER","");
		define("SMTPPASS","");
		define("ABSHTTPPATH","http://properties.puntomep.com.ar/");
	}
		
	}
}




// Charset
define('CHARSET','utf-8');
define('METACHARSET','<meta http-equiv="content-type" content="text/html; charset=UTF-8">');
define('MYSQLCHARSET','utf8');

/*
define('CHARSET','8859-1');
define('METACHARSET','<meta http-equiv="content-type" content="text/html; charset=8859-1">');
define('MYSQLCHARSET','latin1');
*/




// Admin
define('USER','admin');
define('PASSWORD','1234');

// Fotos
define("FOTOSORIGINALES","./fotos/originales/");
define("FOTOSMEDIAS","./fotos/medias/");
define("FOTOSTHUMB","./fotos/thumbs/");
define("ANCHOMEDIO","640");
define("ALTOMEDIO","480");
define("ANCHOTHUMB","80");
define("ALTOTHUMB","80");
define("NOPICSMALL","img/nopic.jpg");
define("NOPICBIG","img/nopic320.jpg");

// Videos
define("ANCHOVIDEOADMIN",320);
define("ALTOVIDEOADMIN",200);
?>
