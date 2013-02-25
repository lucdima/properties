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
include ('config.php');
include ('functions_hm.php');
class Propiedad {
   private $_idpropiedad;
   private $_nombre;
   private $_descripcion;
   private $_moneda1;
   private $_moneda2;
   private $_precio1;
   private $_precio2;
   private $_superficie;
   private $_detalle=array();
   private $_estado;
   private $_operacion;
   private $_foto=array();
   private $_video=array();
   private $_visibilidad;
   private $_mapa;
   private $_errores= array();
   private $_fotop;	
   private $_plano;
	 
  function set_idpropiedad($i) {
	$this->_idpropiedad=$i;
	}
  function get_idpropiedad() {
	return $this->_idpropiedad;
  }
  function validar() {
		$this->set_errores(0,"");
		$this->set_errores(1,"");
		$this->set_errores(2,"");
		$e=TRUE;
		if ($this->_nombre=="") {
			$this->set_errores(0,"Error en el nombre");
			$e=FALSE;
		}
		if ($this->_operacion==0) {
				$this->set_errores(1,"Debe elegir alguna operación");
				$e=FALSE;
		}
		if ((($this->_operacion==1) OR ($this->_operacion==3)) AND (($this->_precio1=="") OR ($this->_precio1==0))) {
				$this->set_errores(1,"Debe colocar algún precio de alquiler");
				$e=FALSE;	
		}
		if ((($this->_operacion==2) OR ($this->_operacion==3)) AND (($this->_precio2=="")  OR ($this->_precio2==0))) {
				$this->set_errores(2,"Debe colocar algún precio de venta");
				$e=FALSE;	
		}

		if ((($this->_operacion==1) OR ($this->_operacion==3)) AND (!is_numeric($this->_precio1))) {
				$this->set_errores(1,"Precio de alquiler incorrecto");
				$e=FALSE;	
		}
		if ((($this->_operacion==2) OR ($this->_operacion==3)) AND (!is_numeric($this->_precio2))) {
				$this->set_errores(2,"Precio de venta incorrecto");
				$e=FALSE;	
		}
		return $e;
	}
	
	function get_errores($i) {
		if (isset($this->_errores[$i])) return $this->_errores[$i];
			else return NULL;
	}
	
	function set_errores($i,$v) {
		$this->_errores[$i]=$v;
	}
  
   function get_nombre() {
	   return $this->_nombre;
	}
	function set_nombre($n) {
		$this->_nombre=$n;
	}
	function get_descripcion($s=0,$l=0) {
	if ($s==0) return $this->_descripcion;
		else {
			$desc="<strong>";
			$pos=strpos($this->_descripcion,"\r");
			$desc.=substr_replace($this->_descripcion,'</strong>', ($pos));
			$desc.="<br/>".substr($this->_descripcion,$pos);
			if ($l==0) return $desc;
				else {
					return substr($desc,0,$l+22);
				}
		}
	}

	function set_descripcion($s) {
		$this->_descripcion=$s;	
	}
	function get_moneda1() {
	   return $this->_moneda1;
   }
	
	function set_moneda1($m) {
		$this->_moneda1=$m;
	}
	function get_moneda2() {
	   return $this->_moneda2;
   }
	
	function set_moneda2($m) {
		$this->_moneda2=$m;
	}
	
	function get_precio1(){
		return $this->_precio1;
	}
	function set_precio1($p){
		$this->_precio1=$p;
	}
	function get_precio2(){
		return $this->_precio2;
	}
	function set_precio2($p){
		$this->_precio2=$p;
	}
   function get_superficie() {
	   return $this->_superficie;
   }
	
	function set_superficie($s) {
		$this->_superficie=$s;
	}
   
	function get_estado() {
	   return $this->_estado;
   }
	
	function set_estado($e) {
		$this->_estado=$e;
	}
	function get_operacion() {
	   return $this->_operacion;
   }
   function get_operacionnombre(){
   		if ($this->_operacion==1) return 'alquiler';
   		if ($this->_operacion==2) return 'venta';
   		if ($this->_operacion==3) return 'alquiler y venta';
   }
	
	function set_operacion($o) {
		$this->_operacion=$o;
	}
	function get_video() {
	   return $this->_video;
   }
	
	function set_video($m) {
		$this->_video=$m;
	}
	function get_mapa() {
	   return $this->_mapa;
   }
	
	function set_mapa($m) {
		$this->_mapa=$m;
	}
	
	function get_visibilidad() {
		return $this->_visibilidad;
		
	}
	function set_visibilidad($v) {
		$this->_visibilidad=$v;
	}
	
	function get_moneda_radio($s) {
		if ($s==$this->get_moneda()) return "checked";
			else return "";
	}
	function get_estado_radio($s) {
		if ($s==$this->get_estado()) return "checked";
			else return "";
	}
	function get_radio($r1,$r2) {
		if ($r1==$r2) return "checked";
			else return "";
	}
	function get_checkbox($r1,$r2) {
		if ($r1==$r2) return "checked";
			else return "";
	}
	function get_detalle_individual($i) {
		// echo $this->_detalle[$i]->get_nombre();
		return $this->_detalle[$i];
	}
	function get_detalle() {
		return $this->_detalle;
	}
	function add_detalle($d) {
		$this->_detalle[]=$d;
	}
	function set_detalle($d) {
		$this->_detalle=$d;
	}
	function get_detalle_nombre_individual($i){
		return $this->_detalle[$i]->get_nombre();
	}
	function get_detalle_valor_individual($v) {
		return $this->_detalle[$v]->get_valor();
	}
	function set_detalle_valor_individual($id,$val) {
		for ($i=0;$i<count($this->_detalle);$i++) {
			if ($this->_detalle[$i]->get_iddetalle()==$id) {
				$this->_detalle[$i]->set_valor($val);
			}
		}	
	}
	
	function eliminar_detalle($id) {
		foreach ($this->_detalle as $k => $d) {
			if ($d->get_iddetalle()==$id) {
				unset($this->_detalle[$k]);
				// unset($f);
			}
		}

		if (count($this->_detalle)==0) {
			unset($this->_detalle);
		}	

		/*
		for ($i=0;$i<count($this->_detalle);$i++) {
			if ($this->_detalle[$i]->get_iddetalle()==$id) {
				unset($this->_detalle[$i]);
			}
		}*/
	}
	function eliminar_foto($id) {
		foreach ($this->_foto as $k => $f) {
			if ($f->get_idfoto()==$id) {
				unset($this->_foto[$k]);
				// unset($f);
			}
		}

		if (count($this->_foto)==0) {
			unset($this->_foto);
		}
		/*
		for ($i=0;$i<count($this->_foto);$i++) {
			if (($this->_foto[$i]->get_idfoto())==$id) {
				unset($this->_foto[$i]);
			}
		} */
	}
	
	function add_foto($f) {
		$this->_foto[]=$f;
	}
	function show_foto_original($id){
		$filename=$this->_idpropiedad.'-'.$id.'.jpg';
		return '<img src="'.FOTOSORIGINALES.$filename.'" />';
	}
	function show_foto_media($id){
		$filename=$this->_idpropiedad.'-'.$id.'.jpg';
		return '<img src="'.FOTOSMEDIAS.$filename.'" />';
	}
	function show_foto_thumb($i){
		$filename=$this->_idpropiedad.'-'.$i.'.jpg';
		return '<img src="'.FOTOSTHUMB.$filename.'" />';
	}
	function href_foto_thumb($i){
		$filename=$this->_idpropiedad.'-'.$i.'.jpg';
		return FOTOSTHUMB.$filename;
	}
	function href_foto_media($i){
		$filename=$this->_idpropiedad.'-'.$i.'.jpg';
		return FOTOSMEDIAS.$filename;
	}
	function href_foto_original($i){
		$filename=$this->_idpropiedad.'-'.$i.'.jpg';
		return FOTOSORIGINALES.$filename;
	}
	function get_fotos(){
		return $this->_foto;
	}
	function set_foto($f){
		$this->_foto=$f;
	}
	function get_fotop(){
		return $this->_fotop;
	}
	function get_plano(){
		return $this->_plano;
	}
	function set_fotop($id){
		if ($id==NULL) unset($this->_fotop);
		else $this->_fotop=$id;
		// echo "** Foto principal: ".$this->_fotop;
	}
	function set_plano($id){
		if ($id==NULL) unset($this->_plano);
		else $this->_plano=$id;
		// echo "** Plano: ".$this->_plano;
	}
	function add_video($v) {
		$this->_video[]=$v;
	}

	function get_primerfoto_id() {
		// $i=0;
		// echo "** Cant Foto: ".count($this->_foto);
		if (isset($this->_foto) and (count($this->_foto)>0)) {
			$a=array_keys($this->_foto);
			// echo "** Arrak Key 0: ".$a[0];
			return $this->_foto[$a[0]]->get_idfoto();
		}
		else return NULL;
		/*
	
		while ($i<count($this->_foto)) {
			if ($this->_foto[$i]->get_idfoto()
			return $this->_foto[0]->get_idfoto();
		} */
		
	}

	function get_videos(){
		return $this->_video;
	}

	function eliminar_video($id) {
		foreach ($this->_video as $k => $f) {
			if ($f->get_idvideo()==$id) {
				unset($this->_video[$k]);
				// unset($f);
			}
		}

		if (count($this->_video)==0) {
			unset($this->_video);
		}
		/*
		for ($i=0;$i<count($this->_video);$i++) {
			if ($this->_video[$i]->get_idvideo()==$id) {
				unset($this->_video[$i]);
			}
		}*/
	}
	
  }
 
 class Cotizacion {
	 private $cotizacion = array();
 }
 
 /* 
 class Moneda {
	 private $tipo;
	 
	 function get_tipo() {
		 return $this_tipo;
	 }
	 function set_tipo($t) {
		$this_tipo=$t;
	 }
	 function get_cotizacion($i){
		 return 
 } 
  */
  
  /*
 class DetalleGenerico {
	 private $_nombre;
	 
	 function get_nombre(){
		 return $this->_nombre;
	 }
	 function set_nombre($n){
		 $this->_nombre=$n;
	 }
 }  */
  
  
 class Detalle {
	 private $_iddetalle;
	 private $_valor;
	 private $_nombre;
	 private $_error;
	 /*
	  * 
	 function __construct($n) {
		 $this->_detalleGenerico = new DetalleGenerico();
		 $this->_detalleGenerico->set_nombre($n);
	 }*/
	 function validar() {
		 $this->_error="";
		 if ($this->get_nombre() == "") {
			 $this->_error="El nombre del detalle no puede estar vacío";
			 return false;
			}
		 else {
			 return true;
		 }
	}
	 
	 function get_iddetalle() {
		return $this->_iddetalle;
	}
	 function set_iddetalle($i) {
		$this->_iddetalle=$i;
		}
	 function get_nombre(){
		 return $this->_nombre;
	 }
	 function set_nombre($n){
		 $this->_nombre=trim($n);
	 }
	 
	function get_valor(){
		 return $this->_valor;
	 }
	 function set_valor($v){
		 $this->_valor=$v;
	 }
}

class Foto {
	private $_idfoto;
	private $_descripcion;
	
	function get_idfoto(){
		return $this->_idfoto;
	}
	
	function set_idfoto($id) {
		$this->_idfoto=$id;
	}
	
	function get_path() {
		return $this->_path;
	}
	function set_path($p) {
		$this->_path=$p;
	}
	function get_descripcion() {
	   return $this->_descripcion;
	}
	function set_descripcion($s) {
		$this->_descripcion=$s;	
	}
}

class Video{
	private $_idvideo;
	private $_url;
	private $_descripcion;
	private $_youtubecode;
	private $_embed;

	function get_url() {
		return htmlentities($this->_url);
	}
	function set_url($u) {
		$this->_url=$u;
	}
	
	function get_descripcion() {
	   return $this->_descripcion;
	}
	function set_descripcion($s) {
		$this->_descripcion=$s;	
	}
	function get_idvideo() {
	   return $this->_idvideo;
	}
	function set_idvideo($s) {
		$this->_idvideo=$s;	
	}
	function get_youtubecode(){
		return $this->url2youtubecode($this->_url);				
	}
	function get_embed($a,$b){
		return '<iframe width="'.$a.'" height="'.$b.'" src="http://www.youtube.com/embed/'.$this->get_youtubecode().'" frameborder="0" allowfullscreen></iframe>';
	}
	function url2youtubecode($s){
		$pos=strpos($s,"?v=");
		if ($pos==0)
			{
			$pos=strpos($s,'#');
			if ($pos==0) return "";
				else {
					return substr($s,-11);
					}
			}
			else
			{
			return substr($s,$pos+3,11);
			}
		}


}


class Conector {

	function persistir($c) {
			
			$querytxt="INSERT INTO propiedades (nombre,
											 descripcion,
											 moneda1,
											 moneda2,
											 precio1,
											 precio2,
											 superficie,
											 estado,
											 visibilidad,
											 operacion,
											 mapa,
											 fechaalta,
											 fechamod) VALUES
											 ('".
											 mysql_real_escape_string($c->get_nombre())."','".
											 mysql_real_escape_string($c->get_descripcion())."','".
											 $c->get_moneda1()."','".
											 $c->get_moneda2()."','".
											 $c->get_precio1()."','".
											 $c->get_precio2()."','".
											 $c->get_superficie()."','".
											 $c->get_estado()."','".
											 $c->get_visibilidad()."','".
											 $c->get_operacion()."','".
											 mysql_real_escape_string($c->get_mapa())."',now(),now());";
			
			// echo $querytxt;
			if (!mysql_query($querytxt)) echo mysql_error();
			
		}

		function modificar($c) {

			$querytxt="UPDATE propiedades SET      nombre='".mysql_real_escape_string($c->get_nombre())."',".
									         "descripcion='".mysql_real_escape_string($c->get_descripcion())."',".
											     "moneda1='".$c->get_moneda1()."',".	  
											     "moneda2='".$c->get_moneda2()."',".
											     "precio1='".$c->get_precio1()."',".
											     "precio2='".$c->get_precio2()."',".
										      "superficie='".$c->get_superficie()."',".
										          "estado='".$c->get_estado()."',".
										     "visibilidad='".$c->get_visibilidad()."',".
										       "operacion='".$c->get_operacion()."',".
										            "mapa='".mysql_real_escape_string($c->get_mapa())."'".
										            " WHERE idpropiedad='".$c->get_idpropiedad()."';";	
			// echo "**".$querytxt;							            
			if (!mysql_query($querytxt)) echo mysql_error();							            
		}
		
		function persistir_detalle($d,$idp) {
			$querytxt="INSERT INTO detalles (nombre) VALUES ('".$d->get_nombre()."')";
			$q=mysql_query($querytxt);
			
			$querytxt="INSERT INTO propxdetalles (idpropiedad,iddetalle,valor) VALUES (".
										$idp.",".
										mysql_insert_id().",'".
										$d->get_valor()."');";
			// echo $querytxt;
			// echo "<br>";
			if (!mysql_query($querytxt)) echo mysql_error();
			return mysql_insert_id();	
			}
		
		function asignar_detalle($d,$idp) {
			$querytxt="INSERT INTO propxdetalles (idpropiedad,iddetalle,valor) VALUES (".
			$idp.",".
			$d->get_iddetalle().",'".
			$d->get_valor()."');";
			// echo "**".$querytxt;
			if (!mysql_query($querytxt)) echo mysql_error();
			return mysql_insert_id();	
		}
			
		function actualizar_detalle($idd,$idp,$val) {
			$querytxt="UPDATE propxdetalles SET valor='".$val."' WHERE idpropiedad='".$idp."' AND iddetalle='".$idd."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
			return mysql_insert_id();	
		}
		
		function eliminar_detalle_prop($idp,$idd) {
			$querytxt="DELETE FROM propxdetalles WHERE idpropiedad='".$idp."' AND iddetalle='".$idd."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
		}
		function eliminar_foto_prop($idf) {
			$querytxt="DELETE FROM fotos WHERE idfoto='".$idf."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
		}
		function eliminar_video_prop($idv) {
			$querytxt="DELETE FROM videos WHERE idvideo='".$idv."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
		}
		function eliminar_propiedad($id){
			// Elimina de la tabla propiedades
			$querytxt="DELETE FROM propiedades WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
			
			// Elimina los archivos de fotos
			$querytxt="SELECT * FROM fotos WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			while ($data=mysql_fetch_array($q)) {
				eliminar_archivo_foto($id,$data['idfoto']);
			}

			// Elimina de la tabla de fotos
			$querytxt="DELETE FROM fotos WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();	

			// Elimina de la tabla de videos
			$querytxt="DELETE FROM videos WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();	

			// Elimina de la tabla propiedades y detalles
			$querytxt="DELETE FROM propxdetalles WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();	
		}
		
		function abrirbase($server,$database,$dbuser,$pass) {
			$link=mysql_connect($server,$dbuser,$pass);
			if (!$link)
				die("No se puede conectar a la base de datos");

				mysql_set_charset(MYSQLCHARSET,$link);
				mysql_select_db($database,$link)
			or die ("No se puede abrir $database:".mysql_error());
			return $link;
		}
		function get_detalles_db($idpropiedad) {
			$querytxt="select * from propxdetalles pd, detalles d where pd.idpropiedad=".$idpropiedad." and pd.iddetalle=d.iddetalle;";
			$q=mysql_query($querytxt);
			
			
			if (mysql_num_rows($q)==0) { return NULL; }
				else {
				$detalles = array();
				while ($datos=mysql_fetch_array($q)) {
					$d = new detalle();
					$d->set_iddetalle($datos['iddetalle']);
					$d->set_nombre($datos['nombre']);
					$d->set_valor($datos['valor']);
					$detalles[]=$d;
				}
				return $detalles;
				}
		}
		
		function get_detalles_db_complemento($d){
			
			if ($d==NULL) {
				$querytxt="SELECT * FROM `detalles`;";
			}
			else {
				$vector="(";
				foreach ($d as $det) {
					$vector.=$det->get_iddetalle().',';
				}
				$vector.='"")';	
				$querytxt="SELECT * FROM `detalles` WHERE iddetalle not in ".$vector.";";
			}	
			
			$q=mysql_query($querytxt);
			if (mysql_num_rows($q)==0) return NULL;
			else {
				$detalles=array();
				while ($datos=mysql_fetch_array($q)) {
						$d = new Detalle();
						$d->set_iddetalle($datos['iddetalle']);
						$d->set_nombre($datos['nombre']);
						$detalles[]=$d;
				}
				return $detalles;
			}
		}
		
		function get_propiedad_db($id,$safe=0) {
			$addsel="";
			if ($safe==1) {
				$addsel=" AND visibilidad='Visible'";
				}
			$querytxt="select * from propiedades where idpropiedad=".$id.$addsel.";";
			$q=mysql_query($querytxt);
			if (mysql_num_rows($q)==0) return NULL;
				else {
					$data=mysql_fetch_array($q);
					$p = new Propiedad();
					$p->set_idpropiedad($data['idpropiedad']);
					$p->set_nombre($data['nombre']);
					$p->set_descripcion($data['descripcion']);
					$p->set_moneda1($data['moneda1']);
					$p->set_precio1($data['precio1']);
					$p->set_moneda2($data['moneda2']);
					$p->set_precio2($data['precio2']);
					$p->set_superficie($data['superficie']);
					$p->set_estado($data['estado']);
					$p->set_operacion($data['operacion']);
					$p->set_visibilidad($data['visibilidad']);
					$p->set_mapa($data['mapa']);
					$p->set_detalle($this->get_detalles_db($id));
					$p->set_foto($this->get_fotos_db($id));
					$p->set_video($this->get_videos_db($id));
					$p->set_fotop($data['fotop']);
					$p->set_plano($data['plano']);
					return $p;
				}
				
		}
		
		// Devuelve un array de objetos foto pertenecientes a una propiedad		
		function get_fotos_db($idpropiedad) {
			$querytxt="select * from fotos f where f.idpropiedad=".$idpropiedad." order by f.idfoto;";
			$q=mysql_query($querytxt);
			$fotos=array();
			// if (mysql_num_rows($q)==0) { return NULL; }
			// 	else {
				// $detalles = array();
				while ($datos=mysql_fetch_array($q)) {
					$d = new foto();
					$d->set_idfoto($datos['idfoto']);
					$fotos[]=$d;
				}
				return $fotos;
			//	}
		}

		function get_videos_db($idpropiedad) {
			$querytxt="select * from videos v where v.idpropiedad=".$idpropiedad." order by v.idvideo;";
			$q=mysql_query($querytxt);
			$videos=array();
			
			while ($datos=mysql_fetch_array($q)) {
					$d = new video();
					$d->set_idvideo($datos['idvideo']);
					$d->set_url($datos['url']);
					$d->set_descripcion($datos['descripcion']);
					$videos[]=$d;
				}
				return $videos;
			
		}		
		
		function nueva_foto($idp,$idf,$desc){
			
			$querytxt="INSERT INTO fotos (idfoto,descripcion,idpropiedad) VALUES (".$idf.",'".mysql_real_escape_string($desc)."',".$idp.");";
			if (!mysql_query($querytxt)) echo mysql_error();
			return mysql_insert_id();	
		}
		function next_table_id($tablename){
			
			$next_increment = 0;
			$qShowStatus = "SHOW TABLE STATUS LIKE '$tablename'";
			$qShowStatusResult = mysql_query($qShowStatus);
			// or die ( "Query failed: " . mysql_error() . "<br/>" . $qShowStatus );
			$row = mysql_fetch_assoc($qShowStatusResult);
			return $row['Auto_increment'];
			
		}
		function establecer_fotop($idp,$idf) {
			if ($idf==NULL) $querytxt="UPDATE propiedades SET fotop=NULL WHERE idpropiedad='".$idp."';";
				else $querytxt="UPDATE propiedades SET fotop='".$idf."' WHERE idpropiedad='".$idp."';";
			// echo "**".$querytxt;	
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
		}
		function establecer_plano($idp,$idf) {
			if ($idf==NULL) $querytxt="UPDATE propiedades SET plano=NULL WHERE idpropiedad='".$idp."';";
				else $querytxt="UPDATE propiedades SET plano='".$idf."' WHERE idpropiedad='".$idp."';";
			// echo "**".$querytxt;	
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();
		}
		function nuevo_video($idp,$idv,$desc,$url){
			
			$querytxt="INSERT INTO videos (idvideo,descripcion,url,idpropiedad) VALUES (".$idv.",'".mysql_real_escape_string($desc)."','".mysql_real_escape_string($url)."',".mysql_real_escape_string($idp).");";
			if (!mysql_query($querytxt)) echo mysql_error();
			return mysql_insert_id();	
		}

		function get_total_propiedades($t=0,$v=0){
			$querytxt="";
			if (($t<0) OR ($t>2)) $t=0;
			if (($v==1) AND ($t==0)) $vistxt=" WHERE visibilidad='Visible';";
			if (($v==1) AND ($t!==0)) $vistxt=" AND visibilidad='Visible';";
			if ($v==0) $vistxt=";";
 			if (($t==0) OR ($t>2))  $querytxt="SELECT * from propiedades ".$vistxt;
			if ($t==1) $querytxt="SELECT * from propiedades WHERE (operacion=1 OR operacion=3) ".$vistxt;
			if ($t==2) $querytxt="SELECT * from propiedades WHERE (operacion=2 OR operacion=3) ".$vistxt;
			$query=mysql_query($querytxt);
			if (!$query) {
				echo mysql_error();
				exit();
			}
			return mysql_num_rows($query);
		}

		function get_propiedades($t=0,$v=0,$p=0,$rp=10) {
			$querytxt="";
			if (($t<0) OR ($t>2)) $t=0;
			if (($v==1) AND ($t==0)) $vistxt=" WHERE visibilidad='Visible'";
			if (($v==1) AND ($t!=0)) $vistxt=" AND visibilidad='Visible'";
			if ($t==0) $querytxt="SELECT * from propiedades ";
			if ($t==1) $querytxt="SELECT * from propiedades WHERE (operacion=1 OR operacion=3) ";
			if ($t==2) $querytxt="SELECT * from propiedades WHERE (operacion=2 OR operacion=3) ";
			$querytxt.=" LIMIT ".$p.",".$rp.";";

			

			$query=mysql_query($querytxt);
			if (!$query) {
				echo mysql_error();
				exit();
			}
			if (mysql_num_rows($query)>0) {
				$ps = Array();
				while ($data=mysql_fetch_array($query)) {
					$p = new Propiedad();
					$p->set_idpropiedad($data['idpropiedad']);
					$p->set_nombre($data['nombre']);
					$p->set_descripcion($data['descripcion']);
					$p->set_moneda1($data['moneda1']);
					$p->set_precio1($data['precio1']);
					$p->set_moneda2($data['moneda2']);
					$p->set_precio2($data['precio2']);
					$p->set_superficie($data['superficie']);
					$p->set_estado($data['estado']);
					$p->set_operacion($data['operacion']);
					$p->set_visibilidad($data['visibilidad']);
					$p->set_mapa($data['mapa']);
					$p->set_detalle($this->get_detalles_db($data['idpropiedad']));
					$p->set_foto($this->get_fotos_db($data['idpropiedad']));
					$p->set_video($this->get_videos_db($data['idpropiedad']));
					$p->set_fotop($data['fotop']);
					$p->set_plano($data['plano']);
					$ps[]=$p;
				}
				return $ps;
			}
			else {
				return NULL;
			}

			
		}

		function stamp_modify_prop($id){
			$querytxt="UPDATE propiedades SET fechamod=now() WHERE idpropiedad='".$id."';";
			$q=mysql_query($querytxt);
			if (!mysql_query($querytxt)) echo mysql_error();	
		}


}

class Tabla {
	private $_filas;
	private $_columnas;
	private $_titulos;
	private $_columnasinterior = array();
	
	function set_filas($f) {
		$this->_filas=$f;
		}
	function set_columnas($c) {
		$this->_columnas=$c;
	}
	function set_titulos($t) {
		$this->_titulos=$t;
	}
	function set__columnasinterior($c) {
		$this->_columnasinterior=$c;
	}
	function add_columna($c) {
		$this->_columnasinterior[]=$c;
	}
	
	function dibujar() {
		$r="<table border=1>";
		// titulos:
		$r.="<tr>";
		for ($i=0;$i<$this->_columnas;$i++) {
			$r.="<td>";
			$r.=$this->_titulos[$i];
			$r.="</td>";
		}
		$r.="</tr>";
		for ($i=0;$i<$this->_filas;$i++) {
			$r.="<tr>";
			for ($j=0;$j<$this->_columnas;$j++) {
				$r.="<td>";
				$r.=$this->_columnasinterior[$j][$i];
				$r.="</td>";
			}
			$r.="</tr>";
		}
		$r.="</table>";
		return $r;
	}
	
}
