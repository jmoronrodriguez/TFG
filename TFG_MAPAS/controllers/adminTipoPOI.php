<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminTipoPOI extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function get_tipoPOIs(){
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('tipoPOI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['tipoPOIs']=$this->tipoPOI_model->get_tipoPOIs();
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_tipoPOI',$template_data);
		$this->load->view('templates/footer_admin');
	}
	public function get_tipoPOIs_json(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('tipoPOI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['bandos']=$this->tipoPOI_model->get_tipoPOIs();
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($template_data['bandos']);
	}
	public function get_tipoPOI_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('tipoPOI_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$data=$this->tipoPOI_model->get_tipoPOI($id);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($data);
	}
	public function edit(){
		$data['tipo_id']=$_POST['tipo_id'];
		$data['tipo_des']=$_POST['tipo_des'];;
		$data['tipo_img']='';
		$this->load->model('tipoPOI_model');
		$this->tipoPOI_model->edit_tipoPOI($data);
		// Cargamos la libreria Upload
		$this->load->library('upload');
		if (!empty($_FILES['icono'.$data['tipo_id']]['name'])){
			//Borramos el tipo Anterior
			$file = "assets/img/IconsPOIs/tipoPOI_".$_POST['tipo_id'].".png";
			$do = unlink($file);			 
			if($do != true){
				echo "There was an error trying to delete the file" . $f->foto . "<br />";
			}
			
			// Configuración para el Archivo 1 file_name
			$config['upload_path'] = 'assets/img/IconsPOIs/';
			$config['allowed_types'] = 'gif|jpg|png';     
			$config['file_name'] = 'tipoPOI_'.$_POST['tipo_id'].'.png';    

			// Cargamos la configuración del Archivo 1
			$this->upload->initialize($config);

			// Subimos archivo 1
			if ($this->upload->do_upload('icono'.$data['tipo_id']))
			{
				$data = $this->upload->data();
			}
			else
			{
				echo $this->upload->display_errors();
			}
			
		}
		return true;
	}
	
	public function delete($id){
		$this->load->model('tipoPOI_model');
		$this->tipoPOI_model->delete_tipoPOI($id);
		$file = "assets/img/IconsPOIs/tipoPOI_".$id.".png";
		$do = unlink($file);			 
		if($do != true){
			echo "There was an error trying to delete the file" . $f->foto . "<br />";
		}
	}
	
	public function new_tipoPOI(){
		$this->load->model('tipoPOI_model');
		$data['tipo_des']=$_POST['des_nuevo'];
		$data['tipo_img']='';
		$this->tipoPOI_model->insert_tipoPOI($data);
		// Cargamos la libreria Upload
		$this->load->library('upload');
		$newID=$this->tipoPOI_model->getNextID();
		if (!empty($_FILES['icono']['name'])){
			// Configuración para el Archivo 1 file_name
			$config['upload_path'] = 'assets/img/IconsPOIs/';
			$config['allowed_types'] = 'gif|jpg|png';     
			$config['file_name'] = 'tipoPOI_'.$newID.'.png';  
			// Cargamos la configuración del Archivo
			$this->upload->initialize($config);
			// Subimos archivo 1
			if ($this->upload->do_upload('icono'))			{
				$data = $this->upload->data();
				echo true;
				return true;
			}else{
				echo false;
				return false;
			}
			
		}else{
			echo false;
			return false;
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */