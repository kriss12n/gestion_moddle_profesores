<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plantilla extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->load->model("PlantillaModal");
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('plantilla');
	}
	public function getGroup()
	{

		$estuden = $this->GroupModel->getGroup();
		echo json_encode($estuden);
	}
	public function getTodo()
	{

		$estuden = $this->PlantillaModal->getTodo();
		echo json_encode($estuden);
	}
	public function GuardaresDatos()
	{
		$data =	array(
			"group_id" => $this->request->nivel->group_id,
			"base_course_id" => $this->request->nivel->base_course_id,
			"teacher_id" => $this->request->nivel->teacher_id,
			"year" => $this->request->nivel->year
		);
		$this->PlantillaModal->GuardaresDatos($data);
	}
	public function EditarGroup()
	{
		$id = $this->request->edit->id;

		$data =	array(
			"group_id" => $this->request->edit->group_id,
			"base_course_id" => $this->request->edit->base_course_id,
			"teacher_id" => $this->request->edit->teacher_id,
			"year" => $this->request->edit->year
		);

		$this->PlantillaModal->EditarGroup($data, $id);
	}
	public function eliminargroum()
	{
		$id = $this->request->edit;


		$this->PlantillaModal->eliminargroum($id);
	}
	public function verificar(){
		$users = $this->PlantillaModal->verificar($this->request->verificar->base_course_id, $this->request->verificar->teacher_id);
		echo json_encode($users);		
	}

	public function verificar2(){
		$users = $this->PlantillaModal->verificar2($this->request->verificar2->teacher_id);
		echo json_encode($users);		
	}
	public function verificar3(){
		$users = $this->PlantillaModal->verificar3($this->request->verificar3->base_course_id);
		echo json_encode($users);		
	}
}
