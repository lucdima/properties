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
if (!isset($_SESSION['intentos'])) $_SESSION['intentos']=0;

if ($_SESSION['intentos']>=15) {
	header("location: index.php");
}

if (isset($_POST['ingresar'])) {
	if (($_POST['user']==USER) and ($_POST['pass']==PASSWORD))	{
		$_SESSION['logged']=TRUE;
		header("location: admin.php");
	}
	else {
		$error="Error en el usuario o la contraseña";
		$_SESSION['intentos']++;
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo METACHARSET;?>

<title>Admin</title>
<link href="abm_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="admin">
<div class="panel">
<div class="ingreso">
<h1>Ingreso</h1>
<h2>Usuario</h2>
<form action="login.php" method="POST">
<input name="user" value=" <?php if (isset($_POST['user'])) echo $_POST['user'];?>" type="text" />
<h2>Contraseña</h2>
<input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo $_POST['pass'];?>" /><br /><br />
<input name="ingresar" class="button" type="submit" value="Ingresar" /><br />
<?php if (isset($error)) echo $error;?>
</form>
</div>
</div>
</div>
</body>
</html>
