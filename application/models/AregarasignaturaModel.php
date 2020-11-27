<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AregarasignaturaModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    

	public function getUsuario()
	{
		$this->db->select("user.id,user.rut, user.name,user.lastname_p,user.lastname_m
		,user.address,user.commune,user.password, user.phone,user.email,user.prioritary,user.course_id,user.representative_id ,user.representative_supp_id,user.contact_movil ,user.rol_id,roles.name as rol ,representative.name as pepe ,representative.lastname_p as apellidop ,representative.lastname_m as lastnamem ,
		,representative2.name as pepe2 ,representative2.lastname_p as apellidop2 ,representative2.lastname_m as lastnamem2 ,bs.name as course_id ,bs.id as idcor");
		$this->db->from("user");
			$this->db->join('roles', 'roles.id = user.rol_id', 'Left');
			$this->db->join('user as representative', 'representative.id = user.representative_id','Left');	
			$this->db->join('user as representative2', 'representative2.id = user.representative_supp_id','Left');	
			$this->db->join('base_course as bs', 'bs.id = user.course_id','Left');	
			$this->db->where('user.rol_id', "1");

		$query = $this->db->get();
		return $query->result();
	}
	public function getSubject()
	{
		$this->db->select("*");
		$this->db->from("subject");
		$query = $this->db->get();
		return $query->result();
	}
	public function getNivel($id)
	{
		$this->db->select("*");
		$this->db->from("level");
		$this->db->where('level.subject_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
}
