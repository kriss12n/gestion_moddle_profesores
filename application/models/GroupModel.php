<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupModel extends CI_Model
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
	public function createdGroup($data)
	{

		$query = $this->db->insert('group', $data);

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
		$query = $this->db->delete("group");
		return true;
	}
}
