<?php
class bando_model extends CI_Model
{
	var $id;
	var $description;
	var $color;
	function insert_bando($data)
	{
		$this->db->insert('bando', $data);
	}
	function get_bando($id){
		$this->db->select('*');
		$this->db->from('bando');
		$this->db->where('ban_id', $id);
		$this->db->limit(1);
		$query = $this->db-> get();

   		if($query -> num_rows() == 1)
   		{
			$rows = $query->result();
			$this->id = $rows[0]->ban_id;
			$this->description = $rows[0]->ban_des;
			$this->color = $rows[0]->ban_color;
			return $this;
   		}

        return FALSE;
	}

	function get_bandos() {
        $query = $this->db->get('bando');
        return $query->result();
    }
	function delete_bando($id){
        $this->db->delete('bando',array('ban_id'=>$id));
    }

    function edit_bando($data){
        $this->db->where('ban_id', $data['ban_id']);
        return $this->db->update('bando', $data);
    }
}
?>