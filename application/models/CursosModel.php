<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CursosModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    
	public function createCursos($data){

		   $query = $this->db->insert('base_course',$data);  
		   
            return true; 
           
	}

	public function getCursos(){
		$query = $this->db->get("base_course");
		return $query->result();

	}

	public function deleteUsuario($id){

		$this->db->where("id",$id);
		$query = $this->db->delete("usuario");

	}

	public function getKam(){

		$this->db->where("id_tipo_usuario",2);
		$query = $this->db->get("usuario");

		return $query->result();

	}

	public function updateUserWithPassword($data,$id){

		$this->db->where("id",$id);
		$query = $this->db->update("usuario",$data);
		return true;

	}

	public function updateUserWithoutPassword($data,$id){
		$this->db->where("id",$id);
		$query = $this->db->update("usuario",$data);
		return true;
	}

	
}
