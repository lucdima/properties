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
echo startheader(_("Properties - Propiedades en alquiler y venta en la Ciudad de Buenos Aires. Argentina"));
echo endheader();
?>
<div id="container">
	<div id="content">
 		<div id="cuerpo">
			<div class="panel">
 				<div class="botones">
 					<ul>
						<li><a href="listado.php?o=1"> 
						<button class="btn btn-large btn-block btn-primary" type="button"><?php echo _("Alquiler");?></button>
						</a></li>
						<li><a href="listado.php?o=2"> 
						<button class="btn btn-large btn-block btn-primary" type="button"><?php echo _("Venta");?></button>
						</a></li>
						<li><a href="<?php echo EMAIL;?>"> 
						<button class="btn btn-large btn-block btn-primary" type="button"><?php echo _("Contacto");?></button>
						</a></li>
					</ul>
 				</div>
 			</div>
		</div>
	</div>
<?php echo footer() ?>
</div>
<?php echo endpage() ?>