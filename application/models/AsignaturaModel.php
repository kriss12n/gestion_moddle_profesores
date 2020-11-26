<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsignaturaModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    
	public function createSubject($data){

		   $query = $this->db->insert('subject',$data);  
            return true; 
           
	}

	public function getSubject(){
		$query = $this->db->get("subject");
		return $query->result();

	}

	public function updateSubject($data,$id){

		$this->db->where("id",$id);
		$query = $this->db->update("subject",$data);
		return true;

	}

	public function deleteSubject($id){

		$this->db->where("id",$id);
		$query = $this->db->delete("base_course");
		return true;
	}

	public function getLevelBySubject($id){

		$this->db->where("subject_id",$id);
		$query = $this->db->get("level");
		return $query->result();
	}


	
}
