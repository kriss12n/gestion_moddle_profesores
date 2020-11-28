<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PlantillaModal extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getGroup()
	{
		$this->db->select("*");
		$this->db->from("group");
		$query = $this->db->get();
		return $query->result();
	}
	public function getTodo()
	{
		$this->db->select("user.rut, user.name,user.lastname_p,user.lastname_m, group.name as nombregrupo, base_course.name as basename,group.id as group_id, base_course.id as base_course_id
		,user.id as teacher_id,planilla.year ,planilla.id");
		$this->db->from("planilla");
		$this->db->join('group', 'group.id = planilla.group_id', 'Left');
		$this->db->join('base_course', 'base_course.id = planilla.base_course_id', 'Left');
		$this->db->join('user', 'user.id = planilla.teacher_id', 'Left');
		$query = $this->db->get();
		return $query->result();
	}
	public function GuardaresDatos($data)
	{

		$query = $this->db->insert('planilla', $data);

		return true;
	}

	public function EditarGroup($data, $id)
	{

		$this->db->where("id", $id);
		$query = $this->db->update("planilla", $data);
		return true;
	}
	public function eliminargroum($id)
	{

		$this->db->where("id", $id);
		$query = $this->db->delete("planilla");
		return true;
	}
	public function verificar($base_course_id,$teacher_id)
	{
		$this->db->select("*");
		$this->db->from("planilla");
		$this->db->where('planilla.base_course_id',$base_course_id);
		$this->db->where('planilla.teacher_id',$teacher_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function verificar2($teacher_id)
	{
		$this->db->select("*");
		$this->db->from("planilla");
		$this->db->where('planilla.teacher_id',$teacher_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function verificar3($base_course_id)
	{
		$this->db->select("*");
		$this->db->from("planilla");
		$this->db->where('planilla.base_course_id',$base_course_id);
		$query = $this->db->get();
		return $query->result();
	}
}
