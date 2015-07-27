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
	public function edit($id, $edit){
		$data['tipo_id']=$id;
		$data['tipo_des']=$edit;
		$data['tipo_img']='';
		$this->load->model('tipoPOI_model');
		$this->tipoPOI_model->edit_tipoPOI($data);
		return true;
	}
	
	public function delete($id){
		$this->load->model('tipoPOI_model');
		$this->tipoPOI_model->delete_tipoPOI($id);
	}
	
	public function new_tipoPOI($_descrip){
		$this->load->model('tipoPOI_model');
		$data['tipo_des']=$_descrip;
		$data['tipo_img']='';
		$this->tipoPOI_model->insert_tipoPOI($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */