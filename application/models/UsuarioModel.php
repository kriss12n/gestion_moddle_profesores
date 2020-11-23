<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function createAlumnos($data)
	{
		$query = $this->db->insert('user',$data);  
		return true;
	}

	public function createProfesor($data)
	{
		$query = $this->db->insert('user',$data);  
		return true;
	}

	public function createApoderado($data)
	{
		$query = $this->db->insert('user',$data);  
		return true;
	}

	public function createGesor($data)
	{
		$query = $this->db->insert('user',$data);  
		return true;
	}

	public function getUsuario()
	{
		$this->db->select("user.id,user.rut, user.name,user.lastname_p,user.lastname_m
		 ,user.address,user.commune, user.phone,user.email,user.representative_id,user.representative_supp_id,user.contact_movil ,user.rol_id,roles.name as rol");
		$this->db->from("user");
		$this->db->join('roles', 'roles.id = user.rol_id', 'Left');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getRol()
	{
		$this->db->select("*");
		$this->db->from("roles");
		$query = $this->db->get();
		return $query->result();
	}
	public function getApoderado()
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where('rol_id', "3");
		$query = $this->db->get();
		return $query->result();
	}

	public function getAlumnosByFilter( $role )
	{
		$this->db->select("user.id,user.rut, user.name,user.lastname_p,user.lastname_m
		,user.address,user.commune, user.phone,user.email,user.representative_id,user.representative_supp_id,user.contact_movil ,user.rol_id,roles.name as rol");
		$this->db->from("user");
			$this->db->join('roles', 'roles.id = user.rol_id', 'Left');
		$this->db->where('rol_id',  $role );
		$query = $this->db->get();
		return $query->result();
	}

	public function deleteUsuario($id)
	{

		$this->db->where("id", $id);
		$query = $this->db->delete("alumno");
	}



	public function getKam()
	{

		$this->db->where("id_tipo_usuario", 2);
		$query = $this->db->get("alumno");

		return $query->result();
	}

	public function updateUserWithPassword($data, $id)
	{

		$this->db->where("id", $id);
		$query = $this->db->update("alumno", $data);
		return true;
	}

	public function updateUserWithoutPassword($data, $id)
	{
		$this->db->where("id", $id);
		$query = $this->db->update("alumno", $data);
		return true;
	}
}
