<?php
class POI_model extends CI_Model
{
	var $id;
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
	function get_POIbyData($data){
		//`poi_id`, `poi_X`, `poi_Y`, `poi_img`, `poi_ini`, `poi_fin`, `tipo_id`, `bando_id`, `conf_id` poi_des
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
	function get_tipoPOIs() {
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