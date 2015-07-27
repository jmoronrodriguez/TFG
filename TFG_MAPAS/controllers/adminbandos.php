<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminBandos extends CI_Controller {

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
	public function get_bandos(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('bando_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['bandos']=$this->bando_model->get_bandos();
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_bando',$template_data);
		$this->load->view('templates/footer_admin');
	}
	public function get_bandos_json(){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('bando_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['bandos']=$this->bando_model->get_bandos();
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($template_data['bandos']);
	}
	public function lista(){
		
		
	
	}
	public function edit($id, $edit){
		$data['ban_id']=$id;
		$data['ban_des']=$edit;
		$data['ban_color']='#000';
		$this->load->model('bando_model');
		$this->bando_model->edit_bando($data);
		return true;
	}
	
	public function delete($id){
		$this->load->model('bando_model');
		$this->bando_model->delete_bando($id);
	}
	
	public function new_bando($_descrip){
		$this->load->model('bando_model');
		$data['ban_des']=$_descrip;
		$data['ban_color']='#000';
		$this->bando_model->insert_bando($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */