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
include ('classes.php');
session_start();
$c=new Conector();
$c->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);
$p=$c->get_propiedad_db($_GET['idp'],1);


if (!isset($_GET['idp'])) exit();

if ($p==NULL) exit();

echo '<!DOCTYPE html>
<html>
<head>
</head>
<body>';
echo $p->get_mapa();
echo '</br>';
echo $p->get_nombre();
echo '</body>
</html>';
?>