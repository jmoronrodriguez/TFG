<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminConfiguracion extends CI_Controller {

	
	public function get_configurations(){
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
	public function edit($id, $edit){
		$data['conf_id']=$id;
		$data['conf_des']=$edit;
		$this->load->model('configuracion_model');
		$this->configuracion_model->edit_configuration($data);
		return true;
	}
	
	public function delete($id){
		$this->load->model('configuracion_model');
		$this->configuracion_model->delete_configuration($id);
	}
	
	public function new_configuration($_descrip){
		$this->load->model('configuracion_model');
		$data['conf_des']=$_descrip;
		$this->configuracion_model->insert_cofiguration($data);
	}
	public function index2()
	{
		$this->load->helper('url');
		$this->load->view('inicio2');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */