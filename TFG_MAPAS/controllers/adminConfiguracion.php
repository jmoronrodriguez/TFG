<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminConfiguracion extends CI_Controller {

	
	public function get_configurations(){
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('configuracion_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['configuration']=$this->configuracion_model->get_configurations();
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_config',$template_data);
		$this->load->view('templates/footer_admin');
	}
	public function get_configurations_json(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('configuracion_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['configuration']=$this->configuracion_model->get_configurations();
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($template_data['configuration']);
	}
	public function edit(){
		$data['conf_id']=$_POST['id'];
		$data['conf_des']=$_POST['des'];
		$data['min_edad']=$_POST['minEdad'];
		$data['max_edad']=$_POST['maxEdad'];
		$this->load->model('configuracion_model');
		$this->configuracion_model->edit_configuration($data);
		return true;
	}
	
	public function delete($id){
		$this->load->model('configuracion_model');
		$this->configuracion_model->delete_configuration($id);
	}
	
	public function new_configuration(){
		$this->load->model('configuracion_model');
		$data['conf_des']=$_POST['des'];
		$data['min_edad']=$_POST['minEdad'];
		$data['max_edad']=$_POST['maxEdad'];
		$this->configuracion_model->insert_cofiguration($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */