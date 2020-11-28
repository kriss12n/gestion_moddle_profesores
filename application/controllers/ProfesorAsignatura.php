
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfesorAsignatura extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->request = json_decode(file_get_contents('php://input'));
		$this->load->model("ProfesorAsignaturaModel");
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('profesorasignatura');
	}


	public function getProfe()
	{
		$users = $this->ProfesorAsignaturaModel->getProfe();
		echo json_encode($users);
	}
	public function getTodo()
	{
		$users = $this->ProfesorAsignaturaModel->getTodo();
		echo json_encode($users);
	}
	public function getSubject()
	{
		$users = $this->ProfesorAsignaturaModel->getSubject();
		echo json_encode($users);
	}

	public function createdGroup()
	{

		$data = array(

			"user_id" => $this->request->user_id,
			"subject_id" => $this->request->subject_id,

		);

		$this->ProfesorAsignaturaModel->Guardarestudenasig($data);
	}
	public function Editar()
	{
		$id = $this->request->edit->id;

		$data = array(
			"subject_id" => $this->request->edit->subject_id,
		);

		$this->ProfesorAsignaturaModel->Editar($data, $id);
	}
	public function verificar2()
	{

		$users = $this->ProfesorAsignaturaModel->verificar2($this->request->verificar2->user_id, $this->request->verificar2->subject_id);
		echo json_encode($users);
	}
	public function eliminargroum()
	{
		$id = $this->request->edit;


		$this->ProfesorAsignaturaModel->eliminargroum($id);
	}
}
