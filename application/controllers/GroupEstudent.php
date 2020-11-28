<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupEstudent extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->load->model("GroupEstudenModel");
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('groupestudent');
	}
	public function getGroup()
	{

		$estuden = $this->GroupModel->getGroup();
		echo json_encode($estuden);
	}

	public function getGroupestudent()
	{


		$estuden = $this->GroupEstudenModel->getGroupestudent();
		echo json_encode($estuden);
	}

	public function createdGroup()
	{

		$data =	array(
			"student_id" => $this->request->alumno,
			"group_id" => $this->request->group
		);
		$this->GroupEstudenModel->createdGroup($data);
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
		$this->GroupEstudenModel->eliminargroum($id);
	}
	public function verificar(){
		$users = $this->GroupEstudenModel->verificar($this->request->verificar, $this->request->verificar2);
		echo json_encode($users);	
	}
}
