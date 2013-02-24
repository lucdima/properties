<?php
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
						<li><a href="#"> 
						<button class="btn btn-large btn-block btn-primary" type="button"><?php echo _("Contacto");?></button>
						</a></li>
					</ul>
 				</div>
 			</div>
		</div>
	</div>
<?php footer() ?>
</div>
<?php endpage() ?>