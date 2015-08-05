<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	public function index()
	{
		
		$this->load->helper('url');
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_index');
		$this->load->view('templates/footer_admin');
	}
	public function administracion()
	{
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
		$this->load->helper('url');
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_index');
		$this->load->view('templates/footer_admin');
	}
	public function login(){
		$this->load->helper('url');
		$this->load->view('admin/login');
	}
	public function atentificacion(){
		$username=$_POST['username'];
		$password=$_POST['inputPassword'];
		$this->load->model('usuario');
		$user = $this->usuario->authenticate($username, $password);
		if ($user){
			$this->_set_session($user);
			redirect('/admin/', 'refresh');
			return TRUE;
		}
	}
	private function _set_session($user){
		$this->load->library('session');
		$sess_array = array(
			'id' => $user->id,
			'username' => $user->username
       	);

		$this->session->set_userdata('logged_in', $sess_array);
	}
	
	function logout(){   
	   $this->load->library('session');
	   $this->session->unset_userdata('logged_in'); // desactivamos la varialble de session "habilitado". Equivale a dejar sin acceso al usuario.
	   $this->login();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */