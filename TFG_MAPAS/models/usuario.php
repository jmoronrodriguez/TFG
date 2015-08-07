<?php
class usuario extends CI_Model
{
	var $id;
	var $username;
	var $pass;
	
	
	function insert_usuario($data)
	{
		$this->db->insert('usuarios', $data);
	}
	
	
	function authenticate($username, $password){        
		$this->db->select('id_usuario, name_usuario');
		$this->db->from('usuarios');
		$this->db->where('name_usuario', $username);
		$this->db->where('pass_usuario', hash('md5', $password));
		$this->db->limit(1);

		$query = $this->db-> get();

   		if($query -> num_rows() == 1){
			$rows = $query->result();
			$this->id = $rows[0]->id_usuario;
			$this->username = $rows[0]->name_usuario;
			return $this;
   		}
        return FALSE;
 	}
 	
	function updateUsername($id, $username){
		$this->db->where('id_usuario', $id);
		$data['name_usuario']=$username;
        return $this->db->update('usuarios', $data);
	}
	function update($id, $username, $password){
		$this->db->where('id_usuario', $id);
		$data['name_usuario']=$username;
		$data['pass_usuario']=hash('md5', $password);
        return $this->db->update('usuarios', $data);
	}

}

?>