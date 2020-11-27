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
	public function verificar($base_course_id,$student_id,$subject_id)
	{
		$this->db->select("*");
		$this->db->from("base_course_subject");
		$this->db->where('base_course_subject.base_course_id',$base_course_id);
		$this->db->where('base_course_subject.student_id',$student_id);
		$this->db->where('base_course_subject.subject_id',$subject_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getRamos()
	{

		$this->db->select("s.name as asig, u.name as nombre,u.rut as rut ,u.lastname_p as apellidoP 
		,u.lastname_m as apellidoM, bc.name as basename, l.name as namelevel  ");
				$this->db->from("base_course_subject");
		$this->db->join('user as u', 'u.id = base_course_subject.student_id', 'Left');
		$this->db->join('subject as s', 's.id = base_course_subject.subject_id', 'Left');
		$this->db->join('level as l', 'l.id = base_course_subject.level_id', 'Left');
		$this->db->join(' base_course as bc', 'bc.id = base_course_subject.base_course_id', 'Left' );
		$query = $this->db->get();
		return $query->result();
	}

	public function Guardarestudenasig($data)
	{
		$query = $this->db->insert('base_course_subject',$data);  
		return true;
	}
	
	
}
