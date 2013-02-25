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
$c=new Conector();
$c->abrirbase(SERVER,DATABASE,DATABASEUSER,DATABASEPASSWORD);
if (isset($_GET['ide'])) {
	$c->eliminar_propiedad($_GET['ide']);
}
echo startheaderadmin("Administrador de propiedades");
// Colocar if logueado
?>
<script type="text/javascript">
function show_confirm()
{
var r=confirm("¿Seguro desea eliminar la propiedad? (Esta acción no se puede deshacer)");
if (r==true)
  {
return true;
  }
else
  {
  return false;
  }
}
</script>
<?php
echo endheaderadmin();
echo '<div class="wrapper">
<div class="logo"><img src="img/hm_logo.png" width="291" height="84" border="0" /></div>
<h1>Administrador</h1>
<ul>
<li><a href="alta.php">&#9658; Cargar nueva propiedad</a></li>
<!-- <li><a href="admin.php">Listar propiedades</a></li> -->
<li><a href="logout.php">&#9668; Salir</a></li>
</ul>
';

// Listar todas las propiedades

$curr_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$ps=$c->get_propiedades(0,0,($curr_page-1),$limit);

// Paginador
$items = array(1,2,3,4,5,6,7,8,9,10,11,12);


$qty_items = $c->get_total_propiedades();
$qty_pages = ceil($qty_items / $limit);



if (count($ps)==0) {
	echo "No hay propiedades cargadas";
}
else {
$td=new Tabla();
$td->set_titulos(array ("Foto","Nombre","Descripción","Datos principales","Detalles","Fotos","Videos","Eliminar"));
$td->set_columnas(8);
$i=0;
foreach ($ps as $p) {
	if ($p->get_fotop()==NULL) $columna[0][$i]='<img src="'.NOPICSMALL.'" />'; 
		else {
		$columna[0][$i]='<a href="'.$p->href_foto_media($p->get_fotop()).'" target="_blank">'.$p->show_foto_thumb($p->get_fotop()).'</a>';
		}
	$columna[1][$i]=$p->get_nombre();
	// echo $p->get_visibilidad();
	if  ($p->get_visibilidad()=='Visible') $pre='<br/><a href="propiedad.php?idp='.$p->get_idpropiedad().'" target="_blank">Previsualizar en nueva ventana</a>';

	$columna[2][$i]=$p->get_descripcion(1).$pre;
	$columna[3][$i]='<a href="modificar.php?idp='.$p->get_idpropiedad().'">modificar</a>';
	$columna[4][$i]='<a href="modificar-detalles.php?idp='.$p->get_idpropiedad().'">administrar</a>';
	$columna[5][$i]='<a href="modificar-fotos.php?idp='.$p->get_idpropiedad().'">administrar</a>';
	$columna[6][$i]='<a href="modificar-videos.php?idp='.$p->get_idpropiedad().'">administrar</a>';
	$columna[7][$i]='<a href="admin.php?ide='.$p->get_idpropiedad().'" onclick="return show_confirm()");>eliminar</a>';
	$i++;
}
$td->set_filas($i);
$td->set__columnasinterior($columna);
echo $td->dibujar();



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


<? if($prev_page): ?>
    <a href="admin.php?page=<?= $prev_page ?>"> << </a>
<? endif ?>
<? for($i = 1; $i <= $qty_pages; $i++): ?>
    <a href="admin.php?page=<?= $i ?>" class="<?= ($i == $curr_page) ? 'curr' : '' ?>"><?= $i ?></a>
<? endfor ?>
<? if($next_page): ?>
    <a href="admin.php?page=<?= $next_page ?>"> >> </a>
<? endif;


echo '</div> <!-- wrapper -->';
echo footeradmin();
}
?>
