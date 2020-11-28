<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfesorAsignaturaModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getProfe()
	{
		$this->db->select("user.id,user.rut, user.name,user.lastname_p,user.lastname_m
		,user.address,user.commune,user.password, user.phone,user.email,user.prioritary,user.course_id,user.representative_id ,user.representative_supp_id,user.contact_movil ,user.rol_id,roles.name as rol ,representative.name as pepe ,representative.lastname_p as apellidop ,representative.lastname_m as lastnamem ,
		,representative2.name as pepe2 ,representative2.lastname_p as apellidop2 ,representative2.lastname_m as lastnamem2 ,bs.name as course_id ,bs.id as idcor");
		$this->db->from("user");
		$this->db->join('roles', 'roles.id = user.rol_id', 'Left');
		$this->db->join('user as representative', 'representative.id = user.representative_id', 'Left');
		$this->db->join('user as representative2', 'representative2.id = user.representative_supp_id', 'Left');
		$this->db->join('base_course as bs', 'bs.id = user.course_id', 'Left');
		$this->db->where('user.rol_id', "2");

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
	public function getTodo()
	{
		$this->db->select("u.rut, u.name,u.lastname_p,u.lastname_m,s.name as subjectname ,s.id as subject_id,user_subject.id");
		$this->db->from("user_subject");
		$this->db->join('user as u', 'u.id = user_subject.user_id', 'Left');
		$this->db->join('subject as s', 's.id = user_subject.subject_id', 'Left');
		$query = $this->db->get();
		return $query->result();
	}

	public function verificar2($user_id,$subject_id)
	{
		$this->db->select("*");
		$this->db->from("user_subject");
		$this->db->where('user_subject.user_id', $user_id);
		$this->db->where('user_subject.subject_id', $subject_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function Guardarestudenasig($data)
	{
		$query = $this->db->insert('user_subject', $data);
		return true;
	}
	public function Editar($data,$id)
	{
		$this->db->where("id", $id);
		$query = $this->db->update("user_subject", $data);
		return true;
	}
	public function eliminargroum($id)
	{

		$this->db->where("id", $id);
		$query = $this->db->delete("user_subject");
		return true;
	}
}
