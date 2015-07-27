<?php
class tipoPOI_model extends CI_Model
{
	var $id;
	var $description;
	var $color;
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
			$this->id = $rows[0]->conf_id;
			$this->description = $rows[0]->conf_des;
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
}
?>