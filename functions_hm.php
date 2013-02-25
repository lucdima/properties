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
function superscaleimage($source,$dest,$maxancho,$maxalto,$quality)
    {

		/* Check for the image's exisitance */
        if (!file_exists($source))
        {
            // echo 'File does not exist!';
            return FALSE;
        }
        else
        {
            $size = getimagesize($source); // Get the image dimensions and mime type
          	$ratio = ($size[0] / $size[1]);
			
		if (($size[0]<$maxancho) && ($size[1]<$maxalto))
			{
			//echo "Imagen muy chica NO SCALING";
			$maxancho=$size[0];
			$maxalto=$size[0];
			}
		
	if ((($maxancho*$size[1])/$size[0])<$maxalto) //DEBE ESCALAR POR EL ALTO.
	//if (((500*900)/1000)>345) //DEBE ESCALAR POR EL ALTO.
		{
		//echo "<br>DEBE ESCALAR POR EL ALTO.";
		$newancho=($maxalto*$size[0])/$size[1];
		$newalto=$maxalto;
		$origenx=($newancho-$maxancho)/2;;
		$origeny=0;
		
		}
		else
		{
		//echo "<br>DEBE ESCALAR POR EL ANCHO.";
		$newancho=$maxancho;
		$newalto=($maxancho*$size[1])/$size[0];
		$origenx=0;
		$origeny=($newalto-$maxalto)/2;
		
		// $origenx=($size[0]-$size[1])/2;
		// $origeny=0;
		// DEBE ESCALAR POR EL ANCHO;
		}
		}
			
            $resize = imagecreatetruecolor($newancho, $newalto); // Create a blank image

				$immarcadeagua="imagenes/marcadeagua.png";
                $im = imagecreatefromjpeg($source);
                imagecopyresampled($resize, $im, 0, 0, 0, 0, $newancho, $newalto, $size[0], $size[1]); // Resample the original JPEG
				
				$resize2 = imagecreatetruecolor($maxancho, $maxalto);
				// $origeny=(280-100)/2;
				imagecopyresampled($resize2, $resize, 0, 0, $origenx, $origeny, $maxancho, $maxalto, $maxancho, $maxalto); // Resample the original JPEG
				
				// imagecopyresampled($resize2, $resize, 0, 0, $origenx, $origeny, $newancho, $newalto, $size[0], $size[1]); // Resample the original JPEG
				// Le inserta la marca de agua
				/*
				if (imagesx($resize)<246) $watermark=imagecreatefrompng("img/marcadeagua140.png");
					else $watermark=imagecreatefrompng("img/marcadeagua.png");

				imagelogo($resize, $watermark, imagesx($resize), imagesy($resize), imagesx($watermark), imagesy($watermark), 'bottom');
				*/
				
		
				
                ob_start();
                imagejpeg($resize2,'', $quality); // Output the new JPEG
                $image_buffer = ob_get_contents();
                ob_end_clean();
                //Create temporary file and write to it

                $fp = fopen($dest,'w');
                fwrite($fp, $image_buffer);
                rewind($fp);

                imagedestroy($resize);
                imagedestroy($resize2);
        
    }

function scaleimagesquare($source,$dest,$maxancho,$maxalto,$quality)
    {
		/* Check for the image's exisitance */
		if (!file_exists($source))
        {
            echo 'File does not exist!';
            return FALSE;
        }
        else
        {
            $size = getimagesize($source); // Get the image dimensions and mime type
          	$ratio = ($size[0] / $size[1]);
			
		if (($size[0]<$maxancho) && ($size[1]<$maxalto))
			{
			//echo "Imagen muy chica NO SCALING";
			$maxancho=$size[0];
			$maxalto=$size[0];
			}
		
	if ((($maxancho*$size[1])/$size[0])<$maxalto) //DEBE ESCALAR POR EL ALTO.
	//if (((500*900)/1000)>345) //DEBE ESCALAR POR EL ALTO.
		{
		//echo "<br>DEBE ESCALAR POR EL ALTO.";
		$newancho=($maxalto*$size[0])/$size[1];
		$newalto=$maxalto;
		$origenx=($size[0]-$size[1])/2;
		$origeny=0;
		}
		else
		{
		//echo "<br>DEBE ESCALAR POR EL ANCHO.";
		$newancho=$maxancho;
		$newalto=($maxancho*$size[1])/$size[0];
		$origenx=0;
		$origeny=($size[1]-$size[0])/2;
		// DEBE ESCALAR POR EL ANCHO;
		}
		}
			
			
			
            $resize = imagecreatetruecolor($maxalto,$maxancho); // Create a blank image

			
            /* Check quality option. If quality is greater than 100, return error */

             //   header('Content-Type: '.$size['mime']); // Set the mime type for the image
                $im = imagecreatefromjpeg($source);
                
                imagecopyresampled($resize, $im, 0, 0, $origenx, $origeny, $newancho, $newalto, $size[0], $size[1]); // Resample the original JPEG
        //        imagejpeg($resize, '', $quality); // Output the new JPEG

                ob_start();
                imagejpeg($resize,'', $quality); // Output the new JPEG
                $image_buffer = ob_get_contents();
                ob_end_clean();
                //Create temporary file and write to it

                $fp = fopen($dest,'w');
                fwrite($fp, $image_buffer);
                rewind($fp);

                imagedestroy($im);
        
    }

function eliminar_archivo_foto($idp,$idf) {
	if (file_exists(FOTOSORIGINALES.'/'.$idp.'-'.$idf.'.jpg')) unlink(FOTOSORIGINALES.'/'.$idp.'-'.$idf.'.jpg');
	if (file_exists(FOTOSMEDIAS    .'/'.$idp.'-'.$idf.'.jpg')) unlink(FOTOSMEDIAS    .'/'.$idp.'-'.$idf.'.jpg');
	if (file_exists(FOTOSTHUMB     .'/'.$idp.'-'.$idf.'.jpg')) unlink(FOTOSTHUMB     .'/'.$idp.'-'.$idf.'.jpg');
}

function menu_mod($idp,$num) {
switch ($num) {
	case 1: 
		// Modificar

		return '<a href="admin.php">&#9650; Volver al menu</a> | <a href="modificar-detalles.php?idp='.$idp.'">Siguiente - Administrar detalles &#9658;</a>';

		break;
			
	case 2: 
		// Detalles
		return '<a href="admin.php">&#9650; Volver al menu</a> | <a href="modificar.php?idp='.$idp.'"> &#9668; Anterior - Modificar propiedad</a> | <a href="modificar-fotos.php?idp='.$idp.'">Siguiente - Administrar fotos &#9658; </a>';
		break;
			
	case 3: 
		// Fotos
		return '<a href="admin.php">&#9650; Volver al menu</a> | <a href="modificar-detalles.php?idp='.$idp.'">&#9668; Anterior - Administrar detalles</a> | <a href="modificar-videos.php?idp='.$idp.'">Siguiente - Administrar videos &#9658;</a>';
		break;
			
	case 4: 
		// Videos
		return '<a href="admin.php">&#9650; Volver al menu</a> | <a href="modificar-fotos.php?idp='.$idp.'">&#9668; Anterior - Administrar fotos</a>';
		break;
			

}

}

function startheaderadmin($t=""){
return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

'.METACHARSET.'


<link href="abm_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript" src="scripts/animatedcollapse.js"></script> 
<title>'.$t.'</title>';	
}

function endheaderadmin(){
	return '</head><body>';

}

function footeradmin(){
	return '</body></html>';
}

function endheader(){
	return '</head><body>';

}

function footer(){
	return '<div id="footer"><img src="img/sobre.png" width="19" height="12" border="0" alt="'._("sobre").'" /> <a href="mailto:'.EMAIL.'">e-mail de contacto</a><img src="img/phone.png" style="margin-left:30px;" width="12" height="18" border="0" alt="'._("teléfono").'"/> '.TEL.'<img src="img/dir.png" style="margin-left:30px;" width="21" height="21" border="0" alt="'._("dirección").'" /> '.DIR.'<br /><br />
 <span style="color:#878787;">&copy; 2013 Properties - Todos los derechos reservados</span>
 </div>  
 <!-- cierra footer-->';
}


function lightclonestart(){
	return '
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^=\'prettyPhoto\']").prettyPhoto();
  });
</script>';
}

function endpage() {
	return footerbootstrap().'</body></html>';
}

function islogged(){
	if (!isset($_SESSION['logged'])) {
		header("location: index.php");
		exit();
	}
}

function startheader($t="") {
return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
'.METACHARSET.'
<title>'.$t.'</title>
<link href="class.css" rel="stylesheet" type="text/css" />
'.headbootstrap();
}

function lightboxclone() {
	return '<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8"/>
    <script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>';
}

function headermenu($o=0) {
	$ret ='<div id="header">';
	$ret .='<a href="index.php"><img src="img/hm_logo.png" style="float:left" width="291" height="84" alt="Properties" title="Properties - arquitectura + inmobiliaria" border="0" /></a>';
    $ret .='<div class="menu">';
	$ret .='<ul>';
	$sel=array("","","","");
	$sel[$o]='class="selected"';
	$ret .='<li '.$sel[1].'><a href="listado.php?o=1">Alquiler</a></li>';
	$ret .='<li '.$sel[2].'><a href="listado.php?o=2">Venta</a></li>';
	$ret .='<li '.$sel[3].'><a href="mailto:'.EMAIL.'">Contacto</a></li>';
	$ret .='</ul></div></div>';
	return $ret;
}

function headbootstrap(){
return '
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen" />';
}

function footerbootstrap(){
$ret ='';
// $ret .='    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript" ></script>';
$ret .='<!-- Placed at the end of the document so the pages load faster -->';
$ret .='    <script src="js/bootstrap-transition.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-alert.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-modal.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-dropdown.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-scrollspy.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-tab.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-tooltip.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-popover.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-button.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-collapse.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-carousel.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-typeahead.js" type="text/javascript" ></script>';
$ret .='    <script src="js/bootstrap-affix.js" type="text/javascript" ></script>';
return $ret;
}

?>
