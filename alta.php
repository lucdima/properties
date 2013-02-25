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
islogged();

if (!isset($_POST['first'])) {
	unset($_SESSION['propiedad']);
	$_SESSION['propiedad']=new Propiedad();
// Load default values
$_SESSION['propiedad']->set_moneda1("ars");
$_SESSION['propiedad']->set_moneda2("usd");
$_SESSION['propiedad']->set_estado("Disponible");
$_SESSION['propiedad']->set_visibilidad("Visible");
}
else {
	
	$valor_operacion=0;
	if (isset($_POST['operacion1'])) {
		if ($_POST['operacion1']=='Alquiler') $valor_operacion+=1;
		if ($_POST['operacion1']=='Venta')    $valor_operacion+=2; 
	}	
	if (isset($_POST['operacion2'])) {
		if ($_POST['operacion2']=='Alquiler') $valor_operacion+=1;
		if ($_POST['operacion2']=='Venta')    $valor_operacion+=2; 
	}
	

	$_SESSION['propiedad']->set_nombre($_POST['nombre']);
	$_SESSION['propiedad']->set_descripcion($_POST['descripcion']);
	$_SESSION['propiedad']->set_moneda1($_POST['moneda1']);
	$_SESSION['propiedad']->set_precio1(intval($_POST['precio1']));
	$_SESSION['propiedad']->set_moneda2($_POST['moneda2']);
	$_SESSION['propiedad']->set_precio2(intval($_POST['precio2']));
	$_SESSION['propiedad']->set_superficie(intval($_POST['superficie']));
	$_SESSION['propiedad']->set_estado($_POST['estado']);
	$_SESSION['propiedad']->set_visibilidad($_POST['visibilidad']);
	$_SESSION['propiedad']->set_operacion($valor_operacion);
	$_SESSION['propiedad']->set_mapa($_POST['mapa']);

	if (isset($_POST['crear'])) {
		if ($_SESSION['propiedad']->validar()) {
		$c=new Conector();
		$c->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);
		$c->persistir($_SESSION['propiedad']);
		$_SESSION['propiedad']->set_idpropiedad(mysql_insert_id());
		$headertxt="location: ".ABSHTTPPATH."modificar-detalles.php?idp=".$_SESSION['propiedad']->get_idpropiedad();
		header($headertxt);
		exit();
		}
		else {
			$e=1;
			}
	}	
}


echo startheaderadmin("Crear una propiedad");

$check1="1";
$check2="1";
if (($_SESSION['propiedad']->get_operacion()==1) OR ($_SESSION['propiedad']->get_operacion()==3)) $check1="0";
if (($_SESSION['propiedad']->get_operacion()==2) OR ($_SESSION['propiedad']->get_operacion()==3)) $check2="0";
echo '<script language="JavaScript">';
echo "animatedcollapse.addDiv('Alquiler', 'fade=1,hide=".$check1."');";
echo "animatedcollapse.addDiv('Venta', 'fade=1,hide=".$check2."');";
echo "animatedcollapse.init();";
echo "</script>";
?>

<script language="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo solo acepta números."
        return false
    }
    status = ""
    return true
}



function checkOp() {
	var nameInfo = $("#checkInfo");
	nameInfo.text("");
	nameInfo.removeClass("error");
}

</script>

<?php
echo endheaderadmin();

echo '<div class="wrapper">';

echo '<div class="logo"><a href="admin.php"><img src="img/hm_logo.png" width="291" height="84" border="0" /></a></div>';

echo "<h1>Nueva propiedad</h1>";

/*
if ($e=1) {
		echo $_SESSION['propiedad']->get_errores(0);
		echo '<br/>';
		echo $_SESSION['propiedad']->get_errores(1);
		echo '<br/>';
		echo $_SESSION['propiedad']->get_errores(2);
		echo '<br/>';
}
*/
echo '<form id="customForm" action="alta.php" method="POST">';

// Nombre
echo '<div>';
$c="";
if ($_SESSION['propiedad']->get_errores(0)!="") {
	$info= '<span id="nameInfo" class="error">'.$_SESSION['propiedad']->get_errores(0).'</span>';
	$c="error";
}
else {
	$info= '<span id="nameInfo"></span>';
}
echo '<label for="name">Nombre</label>';
echo '<input name="first" type = "hidden" value="1">';
echo '<input id="name" class="'.$c.'" name="nombre" type="text" value="'.$_SESSION['propiedad']->get_nombre().'" />';
// style="width:450px;"
echo $info;
echo '</div>';

echo '<div>';
echo '<label for="name">Descripción</label>';
echo '<textarea name="descripcion" id="descripcion">';
echo $_SESSION['propiedad']->get_descripcion();
echo '</textarea>';
echo '</div>';

echo "<hr/>";

echo '<div>';
echo '<label for="name">Operación</label>';


// $info= '<span id="checkInfo"></span>';

if (($_SESSION['propiedad']->get_errores(1)=="") AND (($_SESSION['propiedad']->get_errores(2)==""))) {
	$info= '<span id="checkInfo"></span>';
	
} else {
	$info= '<span id="checkInfo" class="error">'.$_SESSION['propiedad']->get_errores(1)." ".$_SESSION['propiedad']->get_errores(2).'</span>';
	$c="error";
}





if (($_SESSION['propiedad']->get_operacion()==1) OR ($_SESSION['propiedad']->get_operacion()==3)) $check1="checked";
if (($_SESSION['propiedad']->get_operacion()==2) OR ($_SESSION['propiedad']->get_operacion()==3)) $check2="checked";
// echo '<input id="operacion1" type="checkbox" name="operacion1" value="Alquiler" '.$check1.' onchange="javascript:animatedcollapse.toggle(\'Alquiler\');" /> Alquiler';
echo '<input id="operacion1" type="checkbox" name="operacion1" value="Alquiler" '.$check1.' onchange="checkOp();animatedcollapse.toggle(\'Alquiler\');" /> Alquiler';
echo '<input id="operacion2" type="checkbox" name="operacion2" onchange="checkOp();animatedcollapse.toggle(\'Venta\');" value="Venta" '.   $check2.'/> Venta';
echo $info;
echo '</div>';

echo '<div id="bigholder" style="width:950px;">';
echo '<div id="AlquilerHolder" style="width:360px;float:left;height:60px;">';
echo '<div id="Alquiler">';
echo '<div style="float:left;width:180px;">';
echo '<label for="name">Moneda Alquiler</label>';
echo '<input type="radio" name="moneda1" value="ars" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda1(),"ars").'/> Peso | ';
echo '<input type="radio" name="moneda1" value="usd" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda1(),"usd").'/> Dólar | ';
echo '<input type="radio" name="moneda1" value="eur" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda1(),"eur").'/> Euro';
echo '</div>';
echo '<div style="float:left;width:180px;height:60px;">';
echo '<label for="name">Precio Alquiler</label>';
echo '<input id="precio1" style="width:90px;" onKeyPress="return checkIt(event)" name="precio1" type="text" value="'.$_SESSION['propiedad']->get_precio1().'" />';
echo '</div>';
echo '</div>';

echo '</div>';

echo '<div id="VentaHolder" style="width:360px;float:left;height:60px;">';
echo '<div id="Venta">';
echo '<div style="float:left;width:180px;height:60px;">';
echo '<label for="name">Moneda Venta</label>';
echo '<input type="radio" name="moneda2" value="ars" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda2(),"ars").'/> Peso | ';
echo '<input type="radio" name="moneda2" value="usd" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda2(),"usd").'/> Dólar | ';
echo '<input type="radio" name="moneda2" value="eur" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_moneda2(),"eur").'/> Euro';
echo '</div>';
echo '<div style="float:left;width:180px;height:20px;">';
echo '<label for="name">Precio Venta</label>';
echo '<input id="precio2" style="width:90px;" onKeyPress="return checkIt(event)" name="precio2" type="text" value="'.$_SESSION['propiedad']->get_precio2().'" />';
echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';

echo '<div style="clear:both;"></div>';
echo "<hr/>";


echo '<div style="width:800px";>';
echo '<div style="width:120px;float:left;">';
echo '<label for="name">Superficie</label>';
echo '<input id="superficie" style="width:60px;" onKeyPress="return checkIt(event)" name="superficie" type="text" value="'.$_SESSION['propiedad']->get_superficie().'" />';
echo "</div>";

echo '<div style="width:340px;float:left;">';
echo '<label for="name">Estado</label>';
echo '<input type="radio" name="estado" value="Disponible" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_estado(),"Disponible").'/> Disponible | ';
echo '<input type="radio" name="estado" value="Reservado" '. $_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_estado(),"Reservado"). '/> Reservado';
echo '<input type="radio" name="estado" value="Alquilado" '. $_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_estado(),"Alquilado"). '/> Alquilado';
echo '<input type="radio" name="estado" value="Vendido" '.   $_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_estado(),"Vendido").   '/> Vendido';
echo '</div>';

echo '<div style="width:200px;float:left;">';
echo '<label for="name">Visibilidad</label>';
echo '<input type="radio" name="visibilidad" value="Visible" '.$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_visibilidad(),"Visible").'/> Visible';
echo '<input type="radio" name="visibilidad" value="Oculto" ' .$_SESSION['propiedad']->get_radio($_SESSION['propiedad']->get_visibilidad(),"Oculto"). '/> Oculto';
echo "</div>";

echo "</div>";


echo '<div style="clear:both;"></div>';
echo "<hr/>";

echo "<div>";
echo '<label for="name">Mapa Embed de Google Maps</label>';
echo '<input id="mapa" style="width:450px;" name="mapa" type="text" value="'.$_SESSION['propiedad']->get_mapa().'" />';
echo '</div>';

echo '<div style="clear:both;"></div>';
echo "<hr/>";

echo '<input id="crear" name="crear" type="submit" value="Ingresar Propiedad" />';


echo '</form>';
echo '</div>';
echo footeradmin();
?>

