<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	
		public function index(){
			$this->load->helper('url');
			$this->load->view('templates/header');
			$this->load->view('inicio/normal');
			$this->load->view('templates/footer');
		}
	
		public function prueba(){
			$this->load->helper('url');
			$this->load->view('templates/header');
			$this->load->view('inicio/prueba');
			$this->load->view('templates/footer');
		}
}