<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPOI extends CI_Controller {

	
	public function pruebas()
	{
		
		$this->load->view('pruebas');
	}
	
	public function nuevo(){
		
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
		}else{
			echo $_POST['Nombre'];
		}
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_POI');
		$this->load->view('templates/footer_admin');
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
			$data['conf_id']=$_POST['slt_configur'];
			$data['poi_id']=$_POST['id_poi'];
			//GUARDAMOS EL POI PARA OBTENER EL ID Y ASI GUARDAR LA IMAGEN
			$this->load->model('POI_model');
			$this->POI_model->edit_tipoPOI($data);
			//si se ha cambiado las imagenes borramos las que tenemos y copiamos las nuevas.
			// Cargamos la libreria Upload
			$this->load->library('upload');
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
			}
			
			if (!empty($_FILES['geolocalizacion']['name'])){
				//borramos la imagen.
				
				$file = "assets/visibilityMaps/worldInfo/wordInfo_".$_POST['id_poi'].".png";
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
		}
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_POI');
		$this->load->view('templates/footer_admin');
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