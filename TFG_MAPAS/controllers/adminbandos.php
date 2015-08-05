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
	 
	 public function index(){
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('bando_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$template_data['bandos']=$this->bando_model->get_bandos();
		//LISTAMOS LA CONFIGURACIONES
		$this->load->view('templates/header_admin');
		$this->load->view('admin/admin_bando',$template_data);
		$this->load->view('templates/footer_admin');
	 }
	public function get_bandos(){
		$this->load->library('session');
		!isset($this->session->userdata['logged_in'])?   die('Página con acceso restringido. <a href="'.site_url(array('admin', 'login')).'">Click aquí para hacer login</a>')   :   ''; // si el usuario no tiene activada la variable de sessión "habilitado", detenemos la ejecución del programa y presentamos mensaje de error.
		
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
	public function get_bando_json($id){
		//CARGAMOS EL MODELO DE CONFIGURACION
		$this->load->model('bando_model');
		//LEEMOS LA BD DE LAS DISTINTAS CONFIGURACIONS
		$data=$this->bando_model->get_bando($id);
		//LISTAMOS LA CONFIGURACIONES
		echo json_encode($data);
	}
	public function lista(){
		
		
	
	}
	public function edit(){
		
		$data['ban_id']=$_POST['id'];;
		$data['ban_des']=$_POST['des'];;
		$data['ban_color']=$_POST['color'];
		$hex=$data['ban_color'];
		
		$this->load->model('bando_model');
		$ant=$this->bando_model->get_bando($_POST['id']);
		$this->bando_model->edit_bando($data);
		//Obtenemos los POIS con el mismo bando
		$this->load->model('POI_model');
		$data=$this->POI_model->get_POIbyBando($data['ban_id']);
		//Por cada POI que tenga este bando se cambia el color de la imagen
		//ATENCION: ESTE FOR PUEDE TARAR ASI QUE UTILIZAR EN ASICRONO MEDIANTE AJAX
		echo $ant->color."/n";
		echo $hex;
		if ($ant->color!=$hex){
			foreach ($data as $item){
				//Creamos el objeto imagen, como son png uilizamos esta funcion
				$im = imagecreatefrompng("./assets/visibilityMaps/map_".$item->poi_id.".png"); 			
				//Se ponen estas dos lineas para conservar las transparecinas de la imagen.
				imagealphablending($im, true);
				imagesavealpha($im, true);
				//Normalmente el primer pixel es de color transparente
				$colorBlanco=imagecolorat($im, 0,0);
				$ancho=imagesx($im); //devuelve el ancho de la imagen
				$alto=imagesy($im); //devuelve el alto de la imagen
				
				$hex = str_replace("#", "", $hex);
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
				 $rgb = array($r, $g, $b);//pasamos de HEX a RGB
				//Obtenomos el color del pixel para cambiar
				$colorPixel = imagecolorallocate($im,$rgb[0],$rgb[1],$rgb[2]);
				for ($i=0; $i<$ancho; $i++){
					for ($j=0; $j<$alto; $j++){
						if (imagecolorat($im, $i,$j)!=$colorBlanco){//Si es distinto el pixel cambiamos el color
							imagesetpixel ( $im ,$i , $j , $colorPixel );
						}
					}
				}
				//header('Content-Type: image/png');
				imagepng($im, "./assets/visibilityMaps/map_".$item->poi_id.".png");
			}
		}
		return "todo Ok";
	}
	
	public function delete($id){
		$this->load->model('bando_model');
		$this->bando_model->delete_bando($id);
	}
	
	public function new_bando(){
		$this->load->model('bando_model');
		$data['ban_des']=$_POST['des'];;
		$data['ban_color']=$_POST['color'];
		$this->bando_model->insert_bando($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */