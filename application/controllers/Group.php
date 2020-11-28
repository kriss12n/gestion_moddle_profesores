<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->load->model("GroupModel");
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('group');
	}
	public function getGroup()
	{


		$estuden = $this->GroupModel->getGroup();
		echo json_encode($estuden);
	}
	public function createdGroup()
	{

		$data =	array(
			"name" => $this->request->categoria->name,
			"description" => $this->request->categoria->description
		);
		$this->GroupModel->createdGroup($data);
	}
	public function EditarGroup()
	{
		$id = $this->request->edit->id;

		$data =	array(
			"name" => $this->request->edit->name,
			"description" => $this->request->edit->description,
		);

		$this->GroupModel->EditarGroup($data, $id);
	}
	public function eliminargroum()
	{
		$id = $this->request->edit;


		$this->GroupModel->eliminargroum($id);
	}
}
