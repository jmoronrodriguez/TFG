<?php
class tipoPOI_model extends CI_Model
{
	var $id;
	var $description;
	var $imagen;
	function insert_tipoPOI($data)
	{
		$this->db->insert('tipo_poi', $data);
	}
	function get_tipoPOI($id){
		$this->db->select('*');
		$this->db->from('tipo_poi');
		$this->db->where('tipo_id', $id);
		$this->db->limit(1);
		$query = $this->db-> get();

   		if($query -> num_rows() == 1)
   		{
			$rows = $query->result();
			$this->id = $rows[0]->tipo_id;
			$this->description = $rows[0]->tipo_des;
			return $this;
   		}

        return FALSE;
	}

	function get_tipoPOIs() {
        $query = $this->db->get('tipo_poi');
        return $query->result();
    }
	function delete_tipoPOI($id){
        $this->db->delete('tipo_poi',array('tipo_id'=>$id));
    }

    function edit_tipoPOI($data){
        $this->db->where('tipo_id', $data['tipo_id']);
        return $this->db->update('tipo_poi', $data);
    }
	
	function getNextID(){
		$this->db->select_max('tipo_id');
		$query = $this->db->get('tipo_poi');
		if($query -> num_rows() == 1){
			$rows = $query->result();
			if (is_null($rows[0]->tipo_id)){
				return 1;
			}
			return $rows[0]->tipo_id;
		}
		return -1;
	
	}
}
?>