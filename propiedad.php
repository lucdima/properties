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
if (!isset($_GET['idp'])) exit();


$p=$c->get_propiedad_db($_GET['idp'],1);
if ($p==NULL) exit();

echo startheader($p->get_nombre()." - Properties - Propiedades en alquiler y venta en la Ciudad de Buenos Aires. Argentina");
echo lightboxclone();
echo endheader();
?>
<div id="container">

<?php echo headermenu(); ?>
   
 <div id="content">
 <div id="cuerpo">
 <div class="pfiltrada">
<div class="propencabezado">
<?php echo $p->get_nombre();
if (isset($_SESSION['logged'])) {
        echo '&nbsp&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp&nbsp<a href="modificar.php?idp='.$p->get_idpropiedad().'">Editar</a>';
      }
?>
</div>   <!-- cierra propencabezado-->



 <div class="propfoto">
<?php
  $cl="";
if (count($p->get_fotos())==0) {

  // No hay fotos:
  if ($p->get_estado!="Disponible") {
    $cl='<div class="d'.strtolower($p->get_estado()).'"></div>';
  }
  echo '<img src="'.NOPICBIG.'" width="330" height="248" border="0" alt="'.$p->get_nombre().'" />';
  echo $cl;
} else {
foreach ($p->get_fotos() as $k => $f) {          
  if (isset($p->get_estado)) {
    if ($p->get_estado!="Disponible") {
      $cl='<div class="d'.strtolower($p->get_estado()).'"></div>';
    }
  }
  echo '<a href="'.$p->href_foto_media($f->get_idfoto()).'" rel="prettyPhoto[gallery2]">';
  if ($k==0) echo '<img src="'.$p->href_foto_media($f->get_idfoto()).'"  width="330" height="248" border="0" alt="'.$p->get_nombre().'" />';
  echo '</a>';
  echo $cl;  
}
}
?>
</div>
 <!-- cierra propfoto-->

 <div class="detalle">
 <?php
 
      if (($p->get_operacion()==1) or ($p->get_operacion()==3)) {
          echo "<p>Precio de alquiler: ".$p->get_moneda1().' '.$p->get_precio1();
          echo "</p>";
        }

      if (($p->get_operacion()==2) or ($p->get_operacion()==3)) {
          echo "<p>Precio de venta: ".$p->get_moneda2().' '.$p->get_precio2();
          echo "</p>";
        } 
      echo '<p>Superficie '.$p->get_superficie().' m²</p>';
 ?>
 </div>
 <!-- cierra detalle-->


 
 <?php
   echo '<div class="propiconos">';
      foreach ($p->get_fotos() as $k => $f) {          
          echo '<a href="'.$p->href_foto_media($f->get_idfoto()).'" rel="prettyPhoto[gallery1]">';
          if ($k==0) echo '<span class="pics"></span>';
          echo '</a>';
        }
        
       if ($p->get_mapa()!="") {
      echo '<a href="mapa.php?idp='.$p->get_idpropiedad().'&amp;iframe=true&amp;width=475&amp;height=430" rel="prettyPhoto[iframe]"> <span class="mapa"></span></a><!-- cierra mapa-->';
      }

      foreach ($p->get_videos() as $k => $f) {
        // $fid=$f->get_idvideo();
        echo '<a href="'.$f->get_url().'" rel="prettyPhoto[galleryv]" title="'.$p->get_nombre().'">';
        if ($k==0) echo '<span class="videos"></span>';
        echo '</a>';
        }
      echo '<!-- cierra videos-->';
      
      // echo '<a href="'.$p->href_foto_media($p->get_plano()).'" rel="prettyPhoto"><div class="plano"></div></a><!-- cierra plano-->';
      if ($p->get_plano()!="") {
        echo '<a href="'.$p->href_foto_media($p->get_plano()).'" rel="prettyPhoto" title="Plano '.$p->get_nombre().'"><span class="plano"></span></a><!-- cierra plano-->';
      }
        else {
       //   echo '<a href="#"><div class="plano"></div></a><!-- cierra plano-->';
        }
     
    /* Imprimir y consultar. por el momento deshabiltiados    
    echo '<a href="#"> <span class="print"></span></a>
    <a href="#"';
    echo $p->get_nombre().'\'">';
    echo '<span class="sobre"></span></a>';
    */

    echo '</div>';'
    <!-- cierra iconos derecha-->';
 ?>

<?php    

echo '<div class="porpinfo">';

echo "<p>".$p->get_descripcion(1,355)."</p>";

echo '</div>';
?> 





 <div class="tcontenedor">
 <div><h4>Detalles de la propiedad</h4></div>
 


<?php
if ($p->get_detalle()!=NULL) {

$izq="";
$der="";
foreach ($p->get_detalle() as $k => $d) {
    if ($k%2==0) {
      $izq.='<div class="tabla"><span>'.$d->get_nombre().'</span> '.$d->get_valor().'</div>';
    } else {
      $der.='<div class="tabla"><span>'.$d->get_nombre().'</span> '.$d->get_valor().'</div>';
    }
}

echo '<div class="grupo">';
echo $izq;
echo '</div>';

echo '<div class="grupo">';
echo $der;
echo '</div>';

}
?>

 </div>
   <!-- cierra tcontenedor-->
   
 </div>
 <!-- cierra pfiltrada-->
 
 </div>
 <!-- cierra cuerpo-->
 </div>
 <!-- cierra content-->

</div>
<!-- cierra conteiner-->



<?php
echo footer();
echo lightclonestart();
echo endpage();
?>
