<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    
	public function created_Categori($data){

		   $query = $this->db->insert('subject',$data);  
            return true; 
           
	}

	public function getSubject(){
		$query = $this->db->get("subject");
		return $query->result();

	}

	public function editar($data,$id){

		$this->db->where("id",$id);
		$query = $this->db->update("subject",$data);
		return true;

	}

	public function deleteSubject($id){

		$this->db->where("id",$id);
		$query = $this->db->delete("subject");
		return true;
	}

	public function getLevelBySubject($id){

		$this->db->where("subject_id",$id);
		$query = $this->db->get("level");
		return $query->result();
	}


	
}
