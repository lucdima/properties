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

echo startheaderadmin("Administrar fotos de la propiedad");
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
echo '<div class="wrapper">';

echo '<div class="logo"><a href="admin.php"><img src="img/hm_logo.png" width="291" height="84" border="0" /></a></div>';

echo menu_mod($_SESSION['propiedad']->get_idpropiedad(),3);
echo "<h1>Modificar Fotos</h1>";






// move_uploaded_file
if (isset($_POST['subirnuevafoto'])) {
	
	// echo "** Next".$conector->next_table_id("fotos");
	$nextidf=$conector->next_table_id("fotos");
	$filename=$_SESSION['propiedad']->get_idpropiedad().'-'.$nextidf.'.jpg';
	
	
	if ($_FILES["nuevafoto"]['type']!='image/jpeg') {
		$errorfoto="La foto debe estar en formato jpg";
	}
	else if (($size=getimagesize($_FILES["nuevafoto"]['tmp_name']))==NULL) {
		$errorfoto="Error en el archivo jpg";
	}
	else if (($size[0]<640) OR ($size[1]<480)) {
		$errorfoto="Imagen con poca resolución. Imagen actual: ".$size[0]."x".$size[1]."px. Mínimo 640x480px";
	}
	else if (!move_uploaded_file($_FILES["nuevafoto"]['tmp_name'],FOTOSORIGINALES.$filename)) {
		// echo FOTOSORIGINALES.$filename;
		$errorfoto=FOTOSORIGINALES.$filename."Error al subir la foto";
		}
	else {	
	superscaleimage(FOTOSORIGINALES.$filename,FOTOSMEDIAS.$filename,ANCHOMEDIO,ALTOMEDIO,95);
	// echo '<img src="'.FOTOSMEDIAS.$filename.'">';
	superscaleimage(FOTOSORIGINALES.$filename,FOTOSTHUMB.$filename,ANCHOTHUMB,ALTOTHUMB,95);
	// echo '<img src="'.FOTOSTHUMB.$filename.'">';
		
	// Grabarla en la base de datos
	// echo "** Next".$conector->next_table_id("fotos");
	$conector->nueva_foto($_SESSION['propiedad']->get_idpropiedad(),$nextidf,"");

	// Adosarla a la propiedad
	$f = new foto();
	$f->set_idfoto($nextidf);
	$_SESSION['propiedad']->add_foto($f);
	
	// Si hay una sola la establece como principal
	// echo "** Cantidad de fotos:".count($_SESSION['propiedad']->get_fotos());
	if (count($_SESSION['propiedad']->get_fotos())==1) {
		// echo "** Estableciendo foto p automaticamente".$nextidf."||";
		$_SESSION['propiedad']->set_fotop($nextidf);
		$conector->establecer_fotop($_SESSION['propiedad']->get_idpropiedad(),$nextidf);
	}

	// Agregar fecha de ultima modificacion a la tabla propiedades
	$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
	
	unset($f);
	
	}
}	

// echo "** Primer foto:".$_SESSION['propiedad']->get_primerfoto_id();


// Eliminar
for ($i=0;$i<count($_SESSION['propiedad']->get_fotos());$i++)
	{
	if (isset($_POST['eliminar'.$i]))
		{
		// Agregar fecha de ultima modificacion a la tabla propiedades
		$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
			
		// echo "**Apreto eliminar $i<br/>";
		// echo "**id detalle a eliminar: ".$_POST['idfoto'.$i];
		$_SESSION['propiedad']->eliminar_foto($_POST['idfoto'.$i]);
		$conector->eliminar_foto_prop($_POST['idfoto'.$i]);
		eliminar_archivo_foto($_SESSION['propiedad']->get_idpropiedad(),$_POST['idfoto'.$i]);
		
		// Si la foto es el plano debe colocar null en el objeto propiedad y en la tabla.
		if ($_SESSION['propiedad']->get_plano()==$_POST['idfoto'.$i]) {
			$_SESSION['propiedad']->set_plano(NULL);
			$conector->establecer_plano($_SESSION['propiedad']->get_idpropiedad(),NULL);
		}

		/* Si existen más fotos establecer la primera como foto principal sino colocar NULL. */
		if ($_SESSION['propiedad']->get_fotop()==$_POST['idfoto'.$i]) {
			// echo "** Se elimina la foto principal";
			if (count($_SESSION['propiedad']->get_fotos())>0) {
				// echo "** Primer foto: ".$_SESSION['propiedad']->get_primerfoto_id()."|";
				$_SESSION['propiedad']->set_fotop($_SESSION['propiedad']->get_primerfoto_id());
				$conector->establecer_fotop($_SESSION['propiedad']->get_idpropiedad(),$_SESSION['propiedad']->get_primerfoto_id());
			}
			else {
				$_SESSION['propiedad']->set_fotop(NULL);
				$conector->establecer_fotop($_SESSION['propiedad']->get_idpropiedad(),NULL);
			}
		}
		}
	}

// Establecer principal
for ($i=0;$i<count($_SESSION['propiedad']->get_fotos());$i++)
	{
	if (isset($_POST['principal'.$i]))
		{
		// Agregar fecha de ultima modificacion a la tabla propiedades
		$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());
		
		// echo "**Apreto principal $i<br/>";
		// echo "**id detalle principal: ".$_POST['idfoto'.$i];
		$_SESSION['propiedad']->set_fotop($_POST['idfoto'.$i]);
		$conector->establecer_fotop($_SESSION['propiedad']->get_idpropiedad(),$_POST['idfoto'.$i]);
		}
	}	

// Establecer plano
for ($i=0;$i<count($_SESSION['propiedad']->get_fotos());$i++)
	{
	if (isset($_POST['plano'.$i]))
		{
		// Agregar fecha de ultima modificacion a la tabla propiedades
		$conector->stamp_modify_prop($_SESSION['propiedad']->get_idpropiedad());

		// echo "**Apreto plano $i<br/>";
		//echo "**id detalle plano: ".$_POST['idfoto'.$i];
		$_SESSION['propiedad']->set_plano($_POST['idfoto'.$i]);
		$conector->establecer_plano($_SESSION['propiedad']->get_idpropiedad(),$_POST['idfoto'.$i]);
		}
	}	



// echo "** Cantidad de fotos:".count($_SESSION['propiedad']->get_fotos());




/* Agregar foto */
$ret="";
if (!isset($errorfoto)) $errorfoto="";
$ret .= "<form ENCTYPE=\"multipart/form-data\" action=\"modificar-fotos.php\" method = \"POST\">";
$ret .='<h2>Subir fotos</h2>';
$ret .= "<input type=\"file\" size=25 name=\"nuevafoto\">";
$ret .= "<input type=\"hidden\" name=\"prim\" value=\"yaentro\">";
$ret .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"7000000\">";
$ret .= "<input type=\"submit\" name=\"subirnuevafoto\" value=\"Upload\" class=\"button\">";
$ret .= "<span class=\"error\">$errorfoto</span>";
echo $ret;

// echo "** Principal: ".$_SESSION['propiedad']->get_fotop();

if ($_SESSION['propiedad']->get_fotos()!=NULL) {
	
	if ($_SESSION['propiedad']->get_fotop()!=NULL)	 {
		$td= new Tabla();
		$td->set_filas(1);
		$td->set_columnas(2);
		$td->set_titulos(array ("Foto principal",$_SESSION['propiedad']->show_foto_thumb($_SESSION['propiedad']->get_fotop())));
		$columna[0][0]="Plano";
		$columna[1][0]=$_SESSION['propiedad']->show_foto_thumb($_SESSION['propiedad']->get_plano());
		$td->set__columnasinterior($columna);		
		echo $td->dibujar();
		unset($td);
	}
	
	$td= new Tabla();
	$td->set_filas(count($_SESSION['propiedad']->get_fotos()));
	$td->set_columnas(4);
	$td->set_titulos(array ("Foto","Eliminar","Principal","Plano"));
	$i=0;
/* Mostrar fotos */	
foreach ($_SESSION['propiedad']->get_fotos() as $k => $f) {
	$fid=$f->get_idfoto();
	$columna[0][$i]='<a href="'.$_SESSION['propiedad']->href_foto_media($f->get_idfoto()).'" target="_blank">'.$_SESSION['propiedad']->show_foto_thumb($f->get_idfoto()).'</a>'.'<input type="hidden" name="idfoto'.$i.'" value="'.$f->get_idfoto().'" />';
 	$columna[1][$i]='<input id="eliminar'.$i.'" name="eliminar'.$i.'" type="submit" class="button" value="Eliminar" />';
	$columna[2][$i]='<input id="principal'.$i.'" name="principal'.$i.'" class="button" type="submit" value="Establecer como principal" />';
	$columna[3][$i]='<input id="plano'.$i.'" name="plano'.$i.'" type="submit" class="button" value="Establecer como plano" />';
	// echo "**k:".$k;
	$i++;
}
$td->set__columnasinterior($columna);
echo $td->dibujar();
}
else {
	echo "<br/><br/>La propiedad no posee fotos";
	// echo '<input type="hidden" name="cantdetallesprop" value="0" />';
}





echo "</form>";
echo "</div>";
echo footeradmin();
?>
