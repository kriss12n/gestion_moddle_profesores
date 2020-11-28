<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupEstudenModel extends CI_Model
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
	public function getGroupestudent()
	{
		$this->db->select("group_user.id,user.rut, user.name,user.lastname_p,user.lastname_m, group.name as nombregrupo");
		$this->db->from("group_user");
		$this->db->join('user', 'user.id = group_user.student_id','Left');	
		$this->db->join('group', 'group.id = group_user.group_id','Left');	
		$query = $this->db->get();
		return $query->result();
	}
	public function createdGroup($data)
	{

		$query = $this->db->insert('group_user', $data);

		return true;
	}

	public function EditarGroup($data, $id)
	{

		$this->db->where("id", $id);
		$query = $this->db->update("group", $data);
		return true;
	}
	public function eliminargroum($id)
	{

		$this->db->where("id", $id);
		$query = $this->db->delete("group_user");
		return true;
	}

	public function verificar($verificar,$verificar2)
	{
		$this->db->select("*");
		$this->db->from("group_user");
		$this->db->where('group_user.student_id',$verificar);
		$this->db->where('group_user.group_id',$verificar2);

		$query = $this->db->get();
		return $query->result();
	}
}
