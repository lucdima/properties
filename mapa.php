<?php
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