<?php
class POI_model extends CI_Model
{
	var $id;
	var $poi_des;
	var $posX;
	var $posY;
	var $img;
	var $MaxEdad;
	var $MinEdad;
	var $id_tipo;
	var $id_conf;
	var $id_bando;
	
	function insert_tipoPOI($data)
	{
		$this->db->insert('poi', $data);
	}
	
	function get_POIbyID($id){
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('poi_id', $id);
		$this->db->limit(1);
		$query = $this->db-> get();

   		if($query -> num_rows() == 1)
   		{
			$rows = $query->result();
			$this->id = $rows[0]->poi_id;
			$this->poi_des = $rows[0]->poi_des;
			$this->posX = $rows[0]->poi_X;
			$this->posY = $rows[0]->poi_Y;
			$this->img = $rows[0]->poi_img;
			$this->MaxEdad = $rows[0]->poi_fin;
			$this->MinEdad = $rows[0]->poi_ini;
			$this->id_tipo = $rows[0]->tipo_id;
			$this->id_conf = $rows[0]->conf_id;
			$this->id_bando = $rows[0]->bando_id;
			
			return $this;
   		}

        return FALSE;
	}
	function get_POIbyBando($id_bando){
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('bando_id', $id_bando);
		$query = $this->db-> get();
		return $query->result();
	}
	function get_POIbyTipo($id_tipo){
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('tipo_id', $id_tipo);
		$query = $this->db-> get();
		return $query->result();
	}
	function get_POIbyConfiguracion($id_conf){
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('conf_id', $id_conf);
		$query = $this->db-> get();
		return $query->result();
	}
	function get_POIbyData($data){
		//`poi_id`, `poi_X`, `poi_Y`, `poi_img`, `poi_ini`, `poi_fin`, `id_tipo`, `bando_id`, `conf_id` poi_des
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('poi_X', $data['poi_X']);
		$this->db->where('poi_Y', $data['poi_X']);
		$this->db->limit(1);
		$query = $this->db-> get();
		if($query -> num_rows() == 1)
   		{
			$rows = $query->result();
			$this->id = $rows[0]->poi_id;
			$this->posX = $rows[0]->poi_X;
			$this->posY = $rows[0]->poi_Y;
			$this->img = $rows[0]->poi_img;
			$this->MaxEdad = $rows[0]->poi_fin;
			$this->MinEdad = $rows[0]->poi_ini;
			$this->id_tipo = $rows[0]->tipo_id;
			$this->id_conf = $rows[0]->conf_id;
			$this->id_bando = $rows[0]->bando_id;
			
			return $this;
   		}

        return FALSE;
	
	}
	function get_POIsbyData($data){
		//SELECT * FROM `poi` WHERE conf_id=1 AND `poi_ini`>=10 AND `poi_fin`<=90 and bando_id IN(1,5,6) and tipo_id in (1,5,6) 
		$this->db->select('*');
		$this->db->from('poi');
		$this->db->where('conf_id', $data['id_conf']);
		if (isset($data['rango'])){
			$array = array('poi_ini >=' => $data['rango'][0], 'poi_fin <=' => $data['rango'][1]);
			$this->db->where($array);
		}
		$this->db->where_in('bando_id', $data['bandos']);
		$this->db->where_in('tipo_id', $data['tipoPOI']);
		$query = $this->db-> get();
		return $query->result();
	
	}
	function getNextID(){
		$this->db->select_max('poi_id');
		$query = $this->db->get('poi');
		if($query -> num_rows() == 1){
			$rows = $query->result();
			if (is_null($rows[0]->poi_id)){
				return 1;
			}
			return $rows[0]->poi_id;
		}
		return -1;
	
	}
	function get_POIs() {
        $query = $this->db->get('poi');
        return $query->result();
    }
	function delete_tipoPOI($id){
        $this->db->delete('poi',array('poi_id'=>$id));
    }

    function edit_tipoPOI($data){
        $this->db->where('poi_id', $data['poi_id']);
        return $this->db->update('poi', $data);
    }

}

?>