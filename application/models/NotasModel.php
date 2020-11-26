<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotasModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function getNotas()
	{
		$this->db->select("s.name as asig, u.name as nombre,u.rut as rut ,u.lastname_p as apellidoP 
		,u.lastname_m as apellidoM, califications.id, califications.calification, califications.craeted_at,califications.student_id,califications.subject_id,califications.calification");
		$this->db->from("califications");
		$this->db->join('user as u', 'u.id = califications.student_id', 'Left');
		$this->db->join('subject as s', 's.id = califications.subject_id', 'Left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getEstuden($id,$idasig)
	{
		$this->db->distinct();
		$this->db->select ("u.name as namex,u.lastname_p as lastname_p,u.lastname_m as lastname_m,u.rut as rut, bc.name as name,u.id");
		$this->db->from("base_course_subject");
		$this->db->join('user as u', 'u.id = base_course_subject.student_id', 'Left');
		$this->db->join('base_course as bc', 'bc.id = base_course_subject.base_course_id', 'inner');
		$this->db->where('base_course_subject.base_course_id',$id);
		$this->db->where('base_course_subject.subject_id',$idasig);


		$query = $this->db->get();
		return $query->result();
	}
	public function getCurso($id)
	{
		$this->db->distinct();
		$this->db->select ("base_course_subject.base_course_id, bc.name as name");
		$this->db->from("base_course_subject");
		$this->db->join('base_course as bc', 'bc.id = base_course_subject.base_course_id', 'inner');
		$this->db->where('subject_id ', $id);//1
		$query = $this->db->get();
		return $query->result();
	
	}

	public function getProfe()
	{
		$this->db->select("user.id,user.rut,user.name,user.lastname_p,user.lastname_m");
		$this->db->from("user");
		$this->db->where('rol_id',"2" );
		$query = $this->db->get();
		return $query->result();
	}
	public function getSubject($id)
	{
		$this->db->select("u.name as User,s.name as Asig ,user_subject.user_id,user_subject.subject_id");
		$this->db->from("user_subject");
		$this->db->join('user as u', 'u.id = user_subject.user_id', 'Left');
		$this->db->join('subject as s', 's.id = user_subject.subject_id', 'Left');
		$this->db->where('user_id',$id );
		$query = $this->db->get();
		return $query->result();
	}
	public function GuardarNota ($data){
		$query = $this->db->insert('califications',$data);  
		return true;
	}


}