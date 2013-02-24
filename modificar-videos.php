<?php
include ('classes.php');
session_start();
islogged();


echo startheaderadmin("Adimnistrador de videos");

echo endheaderadmin();

$conector = new Conector();
$conector->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);

if (isset($_GET['idp'])) {
	$_SESSION['propiedad'] = $conector->get_propiedad_db($_GET['idp']);
}


// unset($_SESSION['propiedad']);
// Si el objeto no existe traerlo de la base
// if (!isset($_SESSION['propiedad'])) $_SESSION['propiedad'] = $conector->get_propiedad_db(1);
// Por el momento la traemos siempre
// $_SESSION['propiedad'] = $conector->get_propiedad_db(1);
if ($_SESSION['propiedad']==NULL) {
	echo "Error";
	exit ();
	}


echo '<div class="wrapper">';

echo '<div class="logo"><a href="admin.php"><img src="img/hm_logo.png" width="291" height="84" border="0" /></a></div>';

echo menu_mod($_SESSION['propiedad']->get_idpropiedad(),4);
echo "<h1>Modificar Videos</h1>";


// move_uploaded_file

if (isset($_POST['subirnuevovideo'])) {
	

	// Agregar fecha de ultima modificacion a la tabla propiedades
	$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());

	echo "** Next".$conector->next_table_id("videos");
	$nextidv=$conector->next_table_id("videos");
	
	// Grabarlo en la base de datos
// 	echo "** Next".$conector->next_table_id("videos");
	$conector->nuevo_video($_SESSION['propiedad']->get_idpropiedad(),$nextidv,$_POST['descripcion'],$_POST['url']);

	// Adosarla a la propiedad
	$f = new video();
	$f->set_idvideo($nextidv);
	$f->set_url($_POST['url']);
	$f->set_descripcion($_POST['descripcion']);
	$_SESSION['propiedad']->add_video($f);
	unset($f);
	
	}




// Eliminar
for ($i=0;$i<count($_SESSION['propiedad']->get_videos());$i++) {
//	echo "** i: ".$i;
	if (isset($_POST['eliminar'.$i]))
		{

		// Agregar fecha de ultima modificacion a la tabla propiedades
		$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
		
//		echo "**Apreto eliminar $i<br/>";
		//echo "**0".$_POST['idvideo0'];
//		echo "**id detalle a eliminar: ".$_POST['idvideo'.$i];
		$_SESSION['propiedad']->eliminar_video($_POST['idvideo'.$i]);
		$conector->eliminar_video_prop($_POST['idvideo'.$i]);
		}
	}

// echo "** Cantidad de videos:".count($_SESSION['propiedad']->get_videos());


/* Agregar video */
$ret = "<form ENCTYPE=\"multipart/form-data\" action=\"modificar-videos.php\" method = \"POST\">";
$ret .='<h2>Subir videos</h2>';
$ret .= 'URL del video:<input type="text" name="url" id="url" />';
$ret .='<br/>';
$ret .= 'Descripción del video:<input type="text" name="descripcion" id="descripcion" />';
$ret .='<br/>';
$ret .= "<input type=\"hidden\" name=\"prim\" value=\"yaentro\">";
$ret .='<br/>';
$ret .= "<input type=\"submit\" class=\"button\" name=\"subirnuevovideo\" value=\"Subir\">";
if (!isset($errorvideo)) $errorvideo="";
$ret .= "<span class=\"error\">$errorvideo</span>";
echo $ret;

if ($_SESSION['propiedad']->get_videos()!=NULL) {
	
	$td= new Tabla();
	$td->set_filas(count($_SESSION['propiedad']->get_videos()));
	$td->set_columnas(3);
	$td->set_titulos(array ("Video","Descripcion","Eliminar"));
	$i=0;
/* Mostrar videos */	
foreach ($_SESSION['propiedad']->get_videos() as $k => $f) {
	$fid=$f->get_idvideo();
	$columna[0][$i]=$f->get_embed(ANCHOVIDEOADMIN,ALTOVIDEOADMIN).'<br/><a href="'.$f->get_url().'">Link</a><input type="hidden" name="idvideo'.$i.'" value="'.$f->get_idvideo().'" />';
 	

 	$columna[2][$i]='<input id="eliminar'.$i.'" name="eliminar'.$i.'" type="submit" class="button" value="Eliminar" />';
	$columna[1][$i]=$f->get_descripcion();
	// echo "**k:".$k;
	$i++;
}
$td->set__columnasinterior($columna);
echo $td->dibujar();
}
else {
	echo "<br/><span class=\"error\">La propiedad no posee videos</span>";
	// echo '<input type="hidden" name="cantdetallesprop" value="0" />';
}





echo "</form>";
echo "</div>";
echo footeradmin();
?>
