<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminPOI extends CI_Controller {

	
	public function pruebas()
	{
		
		$this->load->view('pruebas');
	}
	
	public function nuevo()
	{
		
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_POI');
		$this->load->view('templates/footer_admin');
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
			$newPoi=$this->POI_model->get_POIbyData($data);
			
			/*
			 * Revisamos si el archivo fue subido
			 * Comprobamos si existen errores en el archivo subido
			 */
			 echo $newPoi;
			if (!empty($_FILES['Imagen']['name']))
			{
				// Configuración para el Archivo 1 file_name
				$config['upload_path'] = 'assets/visibilityMaps/';
				$config['allowed_types'] = 'gif|jpg|png';     
				$config['file_name'] = 'map_'.$newPoi->id.'.png';     

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
				$config['file_name'] = 'wordInfo_'.$newPoi->id.'.pgw';     				
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
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */