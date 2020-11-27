
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgregarAsignaura extends CI_Controller {

	public function __construct() {

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->request = json_decode(file_get_contents('php://input'));
		$this->load->model("AregarasignaturaModel");
		
	  }

	public function index()
	{	
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('agregarasignatura');
	}

	public function getAlumnos()
	{
		$users = $this->AregarasignaturaModel->getUsuario();
		echo json_encode($users);	
	}
	public function getSubject()
	{
		$users = $this->AregarasignaturaModel->getSubject();
		echo json_encode($users);	
	}
	public function getNivel()
	{
		$users = $this->AregarasignaturaModel->getNivel($this->request->nivel->id);
		echo json_encode($users);	
	}
}
