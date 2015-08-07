<?php
class configuracion_model extends CI_Model
{
	var $id;
	var $description;
	var $max_edad;
	var $min_edad;
	function insert_cofiguration($data)
	{
		$this->db->insert('configuracion', $data);
	}
	function get_configuration($id){
		$this->db->select('*');
		$this->db->from('configuracion');
		$this->db->where('conf_id', $id);
		$this->db->limit(1);
		$query = $this->db-> get();

   		if($query -> num_rows() == 1)
   		{
			$rows = $query->result();
			$this->id = $rows[0]->conf_id;
			$this->description = $rows[0]->conf_des;
			$this->max_edad = $rows[0]->max_edad;
			$this->min_edad = $rows[0]->min_edad;
			return $this;
   		}

        return FALSE;
	}

	function get_configurations() {
        $query = $this->db->get('configuracion');
        return $query->result();
    }
	function delete_configuration($id){
        $this->db->delete('configuracion',array('conf_id'=>$id));
    }

    function edit_configuration($data){
        $this->db->where('conf_id', $data['conf_id']);
        return $this->db->update('configuracion', $data);
    }
}
?>