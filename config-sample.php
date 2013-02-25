<?php
/*
Properties!
Author: (C) 2013 - Lucas Dima lucdima@gmail.com
License 
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//Database
define("SERVER","localhost");
define("DATABASE","properties");
define("DATABASEUSER","YOURUSER");
define("DATABASEPASSWORD","YOURPASSWORD");

//Email
define("MAILERCLASSPATH","./mailer5.0.0/class.phpmailer.php");
define("SMTPSERVER","localhost");
define("SMTPUSER","");
define("SMTPPASS","");
define("ABSHTTPPATH","http://localhost/properties/");

//Client
define("EMAIL","#");
define("TEL","(011) 888-8888");
define("DIR","Dirección");

// Charset
define('CHARSET','utf-8');
define('METACHARSET','<meta http-equiv="content-type" content="text/html; charset=UTF-8" />');
define('MYSQLCHARSET','utf8');

// Admin
define('USER','admin');
define('PASSWORD','PASSWORD');

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
