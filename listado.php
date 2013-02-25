<?php
include ('classes.php');
session_start();
$c=new Conector();
$c->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);

if (!isset($_GET['o'])) $_GET['o']=1;

echo startheader("Properties - Propiedades en alquiler y venta en la Ciudad de Buenos Aires. Argentina");
echo lightboxclone();
echo endheader();

?>
<div id="container">



<?php echo headermenu($_GET['o']); ?>


    <!-- cierra header-->

 <div id="content">
 <div id="cuerpo">




<?php
// Listar todas las propiedades
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$ps=$c->get_propiedades($_GET['o'],1,($curr_page-1),$limit);
// Paginador
$items = array(1,2,3,4,5,6,7,8,9,10,11,12);
$qty_items = $c->get_total_propiedades($_GET['o'],1);
$qty_pages = ceil($qty_items / $limit);


if (count($ps)==0) {
  echo '<div class="pfiltrada">';
  echo "<p>No hay propiedades cargadas</p>";
  echo '</div>';
}
else {
foreach ($ps as $p) {
      echo '<div class="pfiltrada">';
      echo '<div class="encabezado"><a href="propiedad.php?idp='.$p->get_idpropiedad().'">';
      echo $p->get_nombre();
      echo '</a>';

      if (isset($_SESSION['logged'])) {
        echo '&nbsp&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp&nbsp<a href="modificar.php?idp='.$p->get_idpropiedad().'">Editar</a>';
      }

      echo '</div><!-- cierra encabezado-->';

      echo '<div class="foto"><a href="propiedad.php?idp='.$p->get_idpropiedad().'">';
      
      if (file_exists($p->href_foto_thumb($p->get_fotop()))) {
        echo '<img src="'.$p->href_foto_thumb($p->get_fotop()).'" width="105" height="105" border="0" alt="'.$p->get_nombre().'" />';  
      } else echo '<img src="'.NOPICSMALL.'" width="105" height="105" border="0" alt="'.$p->get_nombre().'"/>';
      
      if ($p->get_estado()!="Disponible") echo '<span class="'.strtolower($p->get_estado()).'"></span>';
      echo '</a></div> <!-- cierra foto-->';
      
      echo '<div class="info">';
      echo '<p>'.$p->get_descripcion(1).'</p>';
      echo '<a href="propiedad.php?idp='.$p->get_idpropiedad().'">(más información)</a>';
      echo '</div> <!-- cierra info-->';
 
      echo '<div class="data">';
      // echo '<p>'.$p->get_operacionnombre().'</p>';
      if (($p->get_operacion()==1) or ($p->get_operacion()==3)) {
          echo "<p>Precio de alquiler ".$p->get_moneda1().' '.$p->get_precio1();
          echo "</p>";
        }

      if (($p->get_operacion()==2) or ($p->get_operacion()==3)) {
          echo "<p>Precio de venta ".$p->get_moneda2().' '.$p->get_precio2();
          echo "</p>";
        } 
      echo '<p>Superficie '.$p->get_superficie().' m²</p>';
      echo '</div><!-- cierra data-->';
    
      echo '<div class="iconos">';
      foreach ($p->get_fotos() as $k => $f) {          
          echo '<a href="'.$p->href_foto_media($f->get_idfoto()).'" rel="prettyPhoto[gallery2]" title="'.$p->get_nombre().'">';
          if ($k==0) echo '<span class="pics"></span>';
          echo '</a>';
        }
      echo '<!-- cierra pics-->';
         
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
        echo '<a href="'.$p->href_foto_media($p->get_plano()).'" rel="prettyPhoto" title="Plano '.$p->get_nombre().'"><div class="plano"></div></a><!-- cierra plano-->';
      }
        else {
          // echo '<a href="#"><div class="plano"></div></a><!-- cierra plano-->';
        }
      
      echo '</div><!-- cierra iconos-->';
 
      echo '</div><!-- cierra pfiltrada-->';
  }
}
  
echo '<!-- cierra cuerpo-->
</div>  ';

// Paginador parte 2
$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$next_page = $curr_page < $qty_pages ? $curr_page + 1 : null;
$prev_page = $curr_page > 1 ? $curr_page - 1 : null;

$offset = ($curr_page - 1) * $limit;
$items = array_slice($items, $offset, $limit);

?>
<style>
.curr{
    border:1px solid #ddd;
    padding:3px;
}
</style>


<? if($prev_page) { 
    echo '<a href="listado.php?page='.$prev_page.'&o='.$_GET['o'].'"> << </a>';
}
 for($i = 1; $i <= $qty_pages; $i++) {
    echo '<a href="listado.php?page='.$i.'&o='.$_GET['o'].'" class="'.($i == $curr_page ? 'curr' : '').'"> '.$i.' </a>';
 }
 if($next_page) {
    echo '<a href="listado.php?page='.$next_page.'&o='.$_GET['o'].'"> >> </a>';
}


echo '
<!-- cierra content-->
</div>  
<!-- cierra conteiner-->';
echo '</div> ';
echo footer();

echo lightclonestart();
echo endpage();


?>
