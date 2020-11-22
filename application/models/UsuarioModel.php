<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    
	public function createUsuario($data){

		   $query = $this->db->insert('usuario',$data);  
		   
                return true; 
           
	}

	public function getUsuario(){
		$this->db->select("user.id,user.rut, user.name,user.lastname_p,user.lastname_m
		 ,user.address,user.commune, user.phone,user.email,user.representative_id,user.representative_supp_id,user.contact_movil ,user.rol_id,roles.name as rol" );
		$this->db->from("user");
		$this->db->join('roles','roles.id = user.rol_id','Left');
		$query = $this->db->get();
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
