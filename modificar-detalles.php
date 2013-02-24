<?php
include ('classes.php');
session_start();
islogged();

echo startheaderadmin("Modificar propiedad");


echo '<script language="JavaScript">';
echo "animatedcollapse.addDiv('mapa', 'fade=1,hide=1');";
echo "animatedcollapse.init();";
echo "</script>";


echo endheaderadmin();

// unset($_SESSION['propiedad']);
$conector = new Conector();
$conector->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);

if (isset($_GET['idp'])) {
	$_SESSION['propiedad'] = $conector->get_propiedad_db($_GET['idp']);
}

if ($_SESSION['propiedad']==NULL) {
	echo "Error";
	exit ();
	}

echo '
<div class="wrapper">
<div class="logo"><a href="admin.php"><img src="img/hm_logo.png" width="291" height="84" border="0" /></a></div>';

echo menu_mod($_SESSION['propiedad']->get_idpropiedad(),2);
echo "<h1>Modificar Detalles</h1>";

// Crea un nuevo detalle, lo guarda en la base y se lo asigna a la propiedad
if (isset($_POST['crear'])) {
/*	echo "**Apreto crear<br/>";
	echo $_POST['nombre'];
    echo $_POST['valor'];*/
    $_SESSION['detallesimple']=new Detalle();
    $_SESSION['detallesimple']->set_nombre($_POST['nombre']);
    $_SESSION['detallesimple']->set_valor($_POST['valor']);
    if (!$_SESSION['detallesimple']->validar()) {
		echo "El nombre del detalle no puede estar vacío";
		}
		else {
			// Agregar fecha de ultima modificacion a la tabla propiedades
			$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());

			$id=$conector->persistir_detalle($_SESSION['detallesimple'],$_SESSION['propiedad']->get_idpropiedad());
			$_SESSION['detallesimple']->set_iddetalle($id);
			$_SESSION['propiedad']->add_detalle($_SESSION['detallesimple']);
			unset($_SESSION['detallesimple']);
	}
}

// Asigna un detalle a una propiedad
if (isset($_POST['cantdetallessis'])) {
	for ($i=0;$i<$_POST['cantdetallessis'];$i++) {
		// echo "**".$i;
		if (isset($_POST['agregar'.$i])) {
			// echo "**ACTUALIZANDO!!";
			// Agregar fecha de ultima modificacion a la tabla propiedades
			$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());

			$_SESSION['detallesimple']=new Detalle();
			$_SESSION['detallesimple']->set_iddetalle($_POST['iddetallesis'.$i]);
			$_SESSION['detallesimple']->set_nombre($_POST['nombredetexist'.$i]);
			// echo "**"-$_POST['valordetallep'.$i];
			$_SESSION['detallesimple']->set_valor($_POST['valordetalle'.$i]);	
			$_SESSION['propiedad']->add_detalle($_SESSION['detallesimple']);
		
			$id=$conector->asignar_detalle($_SESSION['detallesimple'],$_SESSION['propiedad']->get_idpropiedad());
			unset($_SESSION['detallesimple']);
		}
}
}	

for ($i=0;$i<count($_SESSION['propiedad']->get_detalle());$i++)
	{
	if (isset($_POST['eliminar'.$i]))
		{
		// echo "**Apreto eliminar $i<br/>";
		// echo $_POST['nombre'];
		// echo $_POST['valor'];
		// echo "**id detalle a eliminar: ".$_POST['iddetalleprop'.$i];
		$_SESSION['propiedad']->eliminar_detalle($_POST['iddetalleprop'.$i]);
		$conector->eliminar_detalle_prop($_SESSION['propiedad']->get_idpropiedad(),$_POST['iddetalleprop'.$i]);

		// Agregar fecha de ultima modificacion a la tabla propiedades
		$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
		}
	}


// echo $_POST['cantdetalles'];
if ((isset($_POST['cantdetallesprop'])) and (count($_SESSION['propiedad']->get_detalle())>0)) {	
	foreach ($_SESSION['propiedad']->get_detalle() as $d) {
		// echo $d->get_iddetalle();
		// echo " - ";
		// echo $d->get_nombre();
		// echo "**<br>";
	}
}	

// Actualizar valores de los detalles de la propiedad	
for ($i=0;$i<count($_SESSION['propiedad']->get_detalle());$i++) {
		 if (isset($_POST['actualizar'.$i])) {
			// echo "** Acutalizando id, valores: ". $_POST['iddetalleprop'.$i].$_POST['valordetallep'.$i];
			$_SESSION['propiedad']->set_detalle_valor_individual($_POST['iddetalleprop'.$i],$_POST['valordetallep'.$i]);
			$conector->actualizar_detalle($_POST['iddetalleprop'.$i],$_SESSION['propiedad']->get_idpropiedad(),$_POST['valordetallep'.$i]);
			
			// Agregar fecha de ultima modificacion a la tabla propiedades
			$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
		}
	}




echo "<h2>Datos de la propiedad</h2>";
echo '<div id="detalles">';
echo "nombre: ".$_SESSION['propiedad']->get_nombre();
echo "<br/>";
echo "descripcion: ".$_SESSION['propiedad']->get_descripcion(1);
echo "<br/>";

if (($_SESSION['propiedad']->get_operacion()==1) or ($_SESSION['propiedad']->get_operacion()==3)) {
		echo "precio alquiler: ".$_SESSION['propiedad']->get_moneda1().' '.$_SESSION['propiedad']->get_precio1();
		echo "<br/>";
	}


if (($_SESSION['propiedad']->get_operacion()==2) or ($_SESSION['propiedad']->get_operacion()==3)) {
		echo "precio venta: ".$_SESSION['propiedad']->get_moneda2().' '.$_SESSION['propiedad']->get_precio2();
		echo "<br/>";
	}	


echo "superficie: ".$_SESSION['propiedad']->get_superficie();
echo "<br/>";
echo "estado: ".$_SESSION['propiedad']->get_estado();
echo "<br/>";
echo "operacion: ".$_SESSION['propiedad']->get_operacionnombre();
echo "<br/>";
echo "visibilidad: ".$_SESSION['propiedad']->get_visibilidad();
echo "<br/>";
echo 'Google maps <a href="#" style="font-size:9px;" onclick="animatedcollapse.toggle(\'mapa\')">mostrar/ocultar</a>';

echo "<div id='mapa'>";
echo $_SESSION['propiedad']->get_mapa();
echo "</div>";

echo '</div>'; // div detalles
echo "<br/>";
// Listar detalles de la propiedad con botÃ³n de eliminar.
echo "<hr/>";




echo "<h2>Detalles de esta propiedad</h2>";
echo '<form action="modificar-detalles.php" method="POST"  enctype="multipart/form-data">';
if ($_SESSION['propiedad']->get_detalle()!=NULL) {
$td= new Tabla();
$td->set_filas(count($_SESSION['propiedad']->get_detalle()));
$td->set_columnas(4);
$td->set_titulos(array ("Nombre","Valor","Eliminar","Actualizar"));
// for ($i=0;$i<count($_SESSION['propiedad']->get_detalle());$i++) {
	
$i=0;	
foreach ($_SESSION['propiedad']->get_detalle() as $d) {
	$columna[0][$i]=$d->get_nombre().'<input type="hidden" name="iddetalleprop'.$i.'" value="'.$d->get_iddetalle().'" />';
 	$columna[1][$i]='<input id="valordetallep'.$i.'" name="valordetallep'.$i.'" type="text" value="'.$d->get_valor().'" />';
	$columna[2][$i]='<input id="eliminar'.$i.'" name="eliminar'.$i.'" type="submit" class="button" value="Eliminar" />';
	$columna[3][$i]='<input id="actualizar'.$i.'" name="actualizar'.$i.'" class="button" type="submit" value="Actualizar" />';
	$i++;
}
$td->set__columnasinterior($columna);
echo $td->dibujar();
echo '<input type="hidden" name="cantdetallesprop" value="'.$i.'" />';
}
else {
	echo "La propiedad no posee detalles";
	echo '<input type="hidden" name="cantdetallesprop" value="0" />';
}

// Listar detalles de todo el sistema con campo valor y botÃ³n agregar.
echo "<hr/>";
echo "<h2>Detalles existentes en el sistema para agregarle a esta propiedad</h2>";
$_SESSION['detalles']=$conector->get_detalles_db_complemento($_SESSION['propiedad']->get_detalle());
if ($_SESSION['detalles']!=NULL) {
$td= new Tabla();
$td->set_filas(count($_SESSION['detalles']));
$td->set_columnas(3);
$td->set_titulos(array ("Nombre","Valor","Agregar"));
$i=0;
foreach ($_SESSION['detalles'] as $d) {
	$columna[0][$i]=$d->get_nombre();
	$columna[0][$i].='<input type="hidden" name="nombredetexist'.$i.'" value="'.$d->get_nombre().'" />';
 	$columna[1][$i]='<input id="valordetalle'.$i.'" name="valordetalle'.$i.'" type="text" value="" />';
 	$columna[2][$i]='<input type="hidden" name="iddetallesis'.$i.'" value="'.$d->get_iddetalle().'" />';
	$columna[2][$i].='<input id="agregar'.$i.'" name="agregar'.$i.'" type="submit" class="button" value="Agregar" />';
	$i++;
}
$td->set__columnasinterior($columna);
echo $td->dibujar();
echo '<input type="hidden" name="cantdetallessis" value="'.$i.'" />';
}
else {
	echo "no hay detalles para elegir";
	echo '<input type="hidden" name="cantdetallesprop" value="0" />';
}
// Mostrar formulario para crear un nuevo detalle.
echo "<hr/>";
echo "<h2>Agregar nuevo detalle a la propiedad</h2>";

// Mostrar el formulario para crear uno nuevo
$_SESSION['detalle']=new Detalle();

echo '<label for="name">Nombre</label>';
echo '<input name="first" type = "hidden" value="1">';
echo '<input id="nombre" name="nombre" type="text" value="'.$_SESSION['detalle']->get_nombre().'" />';
echo ' | ';
echo '<label for="name">Valor</label>';
echo '<input id="valor" name="valor" type="text" value="'.$_SESSION['detalle']->get_valor().'" />';
echo ' | ';
echo '<input id="crear" name="crear" class="button" type="submit" value="Agregar" />';
echo '<hr/>';


echo '</form>';

echo footeradmin();

?>

