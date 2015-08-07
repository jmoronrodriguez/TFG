<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPOI extends CI_Controller {

	
	public function pruebas()
	{
		
		$this->load->view('pruebas');
	}
	
	public function nuevo(){
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_POI');
		$this->load->view('templates/footer_admin');
	}
	public function get_poi_json(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['pois']=$this->POI_model->get_POIs();
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($template_data['pois']);
	
	}
	public function get_mapas_json(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['pois']=$this->POI_model->get_POIs();
		$i=0;
		foreach ($template_data['pois'] as $poi){
			$prueba[$i]['poi_id']=$poi->poi_id;
			$prueba[$i]['poi_des']=$poi->poi_des;
			$prueba[$i]['poi_X']=$poi->poi_X;
			$prueba[$i]['poi_Y']=$poi->poi_Y;
			$prueba[$i]['tipo_id']=$poi->tipo_id;
			//Obtenemos las coordenadas del archivo pgw (World Info)
			$fp = fopen("assets/visibilityMaps/worldInfo/wordInfo_".$poi->poi_id.".pgw", "r");
			$lineas;
			$j=0;
			while(!feof($fp)) {
				$lineas[$j] = fgets($fp);
				$j++;
			}
			fclose($fp);
			$prueba[$i]['minX']=(float)$lineas[4];
			$prueba[$i]['minY']=(float)$lineas[5];
			//Obtenemos el alto y el ancho de la imagen para calcular las otras coordenadas que faltan
			$nombre_fichero= asset_url()."visibilityMaps/map_".$poi->poi_id.".png";
			list($ancho, $alto, $tipo, $atributos) = getimagesize("./assets/visibilityMaps/map_".$poi->poi_id.".png");
			$prueba[$i]['maxX']=((float)$lineas[4]+($ancho*50));
			$prueba[$i]['maxY']=((float)$lineas[5] -($alto*50));
			$i++;
		}
			
		echo json_encode ($prueba);
	}
	public function get_mapasBydata_json(){
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		//conf: configSelect, bandos: arrayBandos, tipos: arrayTipos, rango: arrayEdad
		$data['id_conf']=$_POST['conf'];
		$j=0;
		$data['bandos']=array();
		for ($i=0; $i<count($_POST['bandos']); $i++){
			if ($_POST['bandos'][$i]['seleccionado'] === "true"){
				$data['bandos'][$j]=$_POST['bandos'][$i]['id_bando'];
				$j++;
			}
		}
		$j=0;
		$data['tipoPOI']=array();
		for ($i=0; $i<count($_POST['tipos']); $i++){
			if ($_POST['tipos'][$i]['seleccionado'] === "true"){
				$data['tipoPOI'][$j]=$_POST['tipos'][$i]['id_tipo'];
				$j++;
			}
		}
		$data['rango']=$_POST['rango'];
		//print_r($data);
		$poi['POIs']=$this->POI_model->get_POIsbyData($data);
		$i=0;
		$prueba=[];
		foreach ($poi['POIs'] as $poi){
			$prueba[$i]['poi_id']=$poi->poi_id;
			$prueba[$i]['poi_des']=$poi->poi_des;
			$prueba[$i]['poi_X']=$poi->poi_X;
			$prueba[$i]['poi_Y']=$poi->poi_Y;
			$prueba[$i]['tipo_id']=$poi->tipo_id;
			//Obtenemos las coordenadas del archivo pgw (World Info)
			$fp = fopen("assets/visibilityMaps/worldInfo/wordInfo_".$poi->poi_id.".pgw", "r");
			$lineas;
			$j=0;
			while(!feof($fp)) {
				$lineas[$j] = fgets($fp);
				$j++;
			}
			fclose($fp);
			$prueba[$i]['minX']=(float)$lineas[4];
			$prueba[$i]['minY']=(float)$lineas[5];
			//Obtenemos el alto y el ancho de la imagen para calcular las otras coordenadas que faltan
			$nombre_fichero= asset_url()."visibilityMaps/map_".$poi->poi_id.".png";
			list($ancho, $alto, $tipo, $atributos) = getimagesize("./assets/visibilityMaps/map_".$poi->poi_id.".png");
			$prueba[$i]['maxX']=((float)$lineas[4]+($ancho*50));
			$prueba[$i]['maxY']=((float)$lineas[5] -($alto*50));
			$i++;
		}
		echo json_encode ($prueba);
	}
	public function get_poiById_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$poi=$this->POI_model->get_POIbyID($id);
		//LISTAMOS LA CONFIGURACIONES get_poiByTipo_json
		echo json_encode($poi);
	}
	public function get_poiByBando_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$poi['POIs']=$this->POI_model->get_POIbyBando($id);
		$poi['tam']=count($poi['POIs']);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($poi);
	}
	public function get_poiByTipo_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$poi['POIs']=$this->POI_model->get_POIbyTipo($id);
		$poi['tam']=count($poi['POIs']);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($poi);
	}
	public function get_poiByConfiguracion_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$poi['POIs']=$this->POI_model->get_POIbyConfiguracion($id);
		$poi['tam']=count($poi['POIs']);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($poi);
	}
	public function get_poiByData_json(){
		$data['id_conf']=$_POST['conf'];
		$j=0;
		$data['bandos']=array();
		for ($i=0; $i<count($_POST['bandos']); $i++){
			if ($_POST['bandos'][$i]['seleccionado'] === "true"){
				$data['bandos'][$j]=$_POST['bandos'][$i]['id_bando'];
				$j++;
			}
		}
		$j=0;
		$data['tipoPOI']=array();
		for ($i=0; $i<count($_POST['tipos']); $i++){
			if ($_POST['tipos'][$i]['seleccionado'] === "true"){
				$data['tipoPOI'][$j]=$_POST['tipos'][$i]['id_tipo'];
				$j++;
			}
		}
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('POI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$poi['POIs']=$this->POI_model->get_POIsbyData($data);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($poi);
	}
	public function do_upload(){
		 // Revisamos si se ha subido algo
		 
		if (isset($_POST['Nombre'])){
			// Cargamos la libreria Upload
			$this->load->library('upload');
			
			 //`poi_id`, `poi_X`, `poi_Y`, `poi_img`, `poi_ini`, `poi_fin`, `tipo_id`, `bando_id`, `conf_id` poi_des
			$data['poi_des']=$_POST['Nombre'];
			$data['poi_X']=$_POST['CoorX'];
			$data['poi_Y']=$_POST['CoorY'];
			$data['poi_img']='';
			$data['poi_ini']=$_POST['MinEdad'];
			$data['poi_fin']=$_POST['MaxEdad'];
			$data['tipo_id']=$_POST['slt_tipo'];
			$data['bando_id']=$_POST['slt_bando'];
			$bando_id=$data['bando_id'];
			$data['conf_id']=$_POST['slt_configur'];
			//GUARDAMOS EL POI PARA OBTENER EL ID Y ASI GUARDAR LA IMAGEN
			$this->load->model('POI_model');
			$this->POI_model->insert_tipoPOI($data);
			$newPoi=$this->POI_model->getNextID();
			/*
			 * Revisamos si el archivo fue subido
			 * Comprobamos si existen errores en el archivo subido
			 */
			if (!empty($_FILES['Imagen']['name']))
			{
				// Configuración para el Archivo 1 file_name
				$config['upload_path'] = 'assets/visibilityMaps/';
				$config['allowed_types'] = 'gif|jpg|png';     
				$config['file_name'] = 'map_'.$newPoi.'.png';     

				// Cargamos la configuración del Archivo 1
				$this->upload->initialize($config);

				// Subimos archivo 1
				if ($this->upload->do_upload('Imagen'))
				{
					$data = $this->upload->data();
				}
				else
				{
					echo $this->upload->display_errors();
				}

			}

			// Revisamos si existe un segundo archivo
			if (!empty($_FILES['geolocalizacion']['name']))
			{
				// La configuración del Archivo 2, debe ser diferente del archivo 1
				// si configuras como el Archivo 1 no hará nada
				$config['upload_path'] = 'assets/visibilityMaps/worldInfo/';
				$config['allowed_types'] = '*';      
				$config['file_name'] = 'wordInfo_'.$newPoi.'.pgw';     				
				// Cargamos la nueva configuración
				$this->upload->initialize($config);

				// Subimos el segundo Archivo
				if ($this->upload->do_upload('geolocalizacion'))
				{
					$data = $this->upload->data();
				}
				else
				{
					echo $this->upload->display_errors();
				}

			}
			//Obtenemos el color del bando
			//CARGAMOS EL MODELO DE CONFIGURACION
			$this->load->model('bando_model');
			//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
			$data=$this->bando_model->get_bando($bando_id);
			$hex=$data->color;
			//cambiamos de color la imagen
			//Creamos el objeto imagen, como son png uilizamos esta funcion
			$im = imagecreatefrompng("./assets/visibilityMaps/map_".$newPoi.".png"); 			
			//Se ponen estas dos lineas para conservar las transparecinas de la imagen.
			imagealphablending($im, true);
			imagesavealpha($im, true);
			//Normalmente el primer pixel es de color transparente
			$colorBlanco=imagecolorat($im, 0,0);
			$ancho=imagesx($im); //devuelve el ancho de la imagen
			$alto=imagesy($im); //devuelve el alto de la imagen
		
			$hex = str_replace("#", "", $hex);
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
			 $rgb = array($r, $g, $b);//pasamos de HEX a RGB
			//Obtenomos el color del pixel para cambiar
			$colorPixel = imagecolorallocate($im,$rgb[0],$rgb[1],$rgb[2]);
			for ($i=0; $i<$ancho; $i++){
				for ($j=0; $j<$alto; $j++){
					if (imagecolorat($im, $i,$j)!=$colorBlanco){//Si es distinto el pixel cambiamos el color
						imagesetpixel ( $im ,$i , $j , $colorPixel );
					}
				}
			}
			//header('Content-Type: image/png');
			imagepng($im, "./assets/visibilityMaps/map_".$newPoi.".png");
	}else{
		echo $_POST['Nombre'];
	}
		redirect('/adminPOI/nuevo', 'refresh');
	}

	public function edit(){
		if (isset($_POST['Nombre'])){
			$data['poi_des']=$_POST['Nombre'];
			$data['poi_X']=$_POST['CoorX'];
			$data['poi_Y']=$_POST['CoorY'];
			$data['poi_img']='';
			$data['poi_ini']=$_POST['MinEdad'];
			$data['poi_fin']=$_POST['MaxEdad'];
			$data['tipo_id']=$_POST['slt_tipo'];
			$data['bando_id']=$_POST['slt_bando'];
			$bando_id=$data['bando_id'];
			$data['conf_id']=$_POST['slt_configur'];
			$data['poi_id']=$_POST['id_poi'];
			//GUARDAMOS EL POI PARA OBTENER EL ID Y ASI GUARDAR LA IMAGEN
			$this->load->model('POI_model');
			$ant=$this->POI_model->get_POIbyID($data['poi_id']);
			$this->POI_model->edit_tipoPOI($data);
			//si se ha cambiado las imagenes borramos las que tenemos y copiamos las nuevas.
			// Cargamos la libreria Upload
			$this->load->library('upload');
			$cambiado=false;
			if (!empty($_FILES['Imagen']['name'])){
				$file = "assets/visibilityMaps/map_".$_POST['id_poi'].".png";
				$do = unlink($file);
				 
				if($do != true){
					echo "There was an error trying to delete the file" . $f->foto . "<br />";
				}
				
				// Configuración para el Archivo 1 file_name
				$config['upload_path'] = 'assets/visibilityMaps/';
				$config['allowed_types'] = 'gif|jpg|png';     
				$config['file_name'] = 'map_'.$_POST['id_poi'].'.png';     

				// Cargamos la configuración del Archivo 1
				$this->upload->initialize($config);

				// Subimos archivo 1
				if ($this->upload->do_upload('Imagen'))
				{
					$data = $this->upload->data();
				}
				else
				{
					echo $this->upload->display_errors();
				}
				
				//Obtenemos el color del bando
				//CARGAMOS EL MODELO DE CONFIGURACION
				$this->load->model('bando_model');
				//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
				$data=$this->bando_model->get_bando($bando_id);
				$hex=$data->color;
				//cambiamos de color la imagen
				//Creamos el objeto imagen, como son png uilizamos esta funcion
				$im = imagecreatefrompng("./assets/visibilityMaps/map_".$_POST['id_poi'].".png"); 			
				//Se ponen estas dos lineas para conservar las transparecinas de la imagen.
				imagealphablending($im, true);
				imagesavealpha($im, true);
				//Normalmente el primer pixel es de color transparente
				$colorBlanco=imagecolorat($im, 0,0);
				$ancho=imagesx($im); //devuelve el ancho de la imagen
				$alto=imagesy($im); //devuelve el alto de la imagen
			
				$hex = str_replace("#", "", $hex);
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
				 $rgb = array($r, $g, $b);//pasamos de HEX a RGB
				//Obtenomos el color del pixel para cambiar
				$colorPixel = imagecolorallocate($im,$rgb[0],$rgb[1],$rgb[2]);
				for ($i=0; $i<$ancho; $i++){
					for ($j=0; $j<$alto; $j++){
						if (imagecolorat($im, $i,$j)!=$colorBlanco){//Si es distinto el pixel cambiamos el color
							imagesetpixel ( $im ,$i , $j , $colorPixel );
						}
					}
				}
				//header('Content-Type: image/png');
				imagepng($im, "./assets/visibilityMaps/map_".$_POST['id_poi'].".png");
				$cambiado=true;
			}
			
			if (!empty($_FILES['geolocalizacion']['name'])){
				//borramos la imagen.
				
				$file = "assets/visibilityMaps/worldInfo/wordInfo_".$_POST['id_poi'].".pgw";
				$do = unlink($file);
				 
				if($do != true){
					echo "There was an error trying to delete the file" . $f->foto . "<br />";
				}
				
				// La configuración del Archivo 2, debe ser diferente del archivo 1
				// si configuras como el Archivo 1 no hará nada
				$config['upload_path'] = 'assets/visibilityMaps/worldInfo/';
				$config['allowed_types'] = '*';      
				$config['file_name'] = 'wordInfo_'.$_POST['id_poi'].'.pgw';     				
				// Cargamos la nueva configuración
				$this->upload->initialize($config);

				// Subimos el segundo Archivo
				if ($this->upload->do_upload('geolocalizacion'))
				{
					$data = $this->upload->data();
				}
				else
				{
					echo $this->upload->display_errors();
				}
			}
			if($cambiado==false && $ant->id_bando!=$bando_id){
				//Obtenemos el color del bando
				//CARGAMOS EL MODELO DE CONFIGURACION
				$this->load->model('bando_model');
				//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
				$data=$this->bando_model->get_bando($bando_id);
				$hex=$data->color;
				//cambiamos de color la imagen
				//Creamos el objeto imagen, como son png uilizamos esta funcion
				$im = imagecreatefrompng("./assets/visibilityMaps/map_".$_POST['id_poi'].".png"); 			
				//Se ponen estas dos lineas para conservar las transparecinas de la imagen.
				imagealphablending($im, true);
				imagesavealpha($im, true);
				//Normalmente el primer pixel es de color transparente
				$colorBlanco=imagecolorat($im, 0,0);
				$ancho=imagesx($im); //devuelve el ancho de la imagen
				$alto=imagesy($im); //devuelve el alto de la imagen
			
				$hex = str_replace("#", "", $hex);
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
				 $rgb = array($r, $g, $b);//pasamos de HEX a RGB
				//Obtenomos el color del pixel para cambiar
				$colorPixel = imagecolorallocate($im,$rgb[0],$rgb[1],$rgb[2]);
				for ($i=0; $i<$ancho; $i++){
					for ($j=0; $j<$alto; $j++){
						if (imagecolorat($im, $i,$j)!=$colorBlanco){//Si es distinto el pixel cambiamos el color
							imagesetpixel ( $im ,$i , $j , $colorPixel );
						}
					}
				}
				//header('Content-Type: image/png');
				imagepng($im, "./assets/visibilityMaps/map_".$_POST['id_poi'].".png");
				
			}
		}
		redirect('/adminPOI/nuevo', 'refresh');
	}
	public function cambioConfiguracion(){
		$id=$_GET['conf'];
		$this->load->model('configuracion_model');
		
		$data['confi']=$this->configuracion_model->get_configuration($id);
		$this->load->model('bando_model');
		$data['bandos']=$this->bando_model->get_bandos();
		$this->load->model('tipoPOI_model');
		$data['tipoPOIs']=$this->tipoPOI_model->get_tipoPOIs();
		echo json_encode($data);
	}
	
	public function delete($id){
		$this->load->model('POI_model');
		$this->POI_model->delete_tipoPOI($id);
		$file = "assets/visibilityMaps/map_".$id.".png";
		$do = unlink($file);
		if($do != true){
			echo "There was an error trying to delete the file" . $f->foto . "<br />";
		}
		
		$file = "assets/visibilityMaps/worldInfo/wordInfo_".$id.".pgw";
		$do = unlink($file);		 
		if($do != true){
			echo "There was an error trying to delete the file" . $f->foto . "<br />";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */