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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */