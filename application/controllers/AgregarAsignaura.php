
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
	
	public function getRamos()
	{
		$users = $this->AregarasignaturaModel->getRamos();
		echo json_encode($users);	
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
	public function Guardarestudenasig()
	{
	if($this->request->nivel->level_id == null){
		$data = array(
			
			"base_course_id"=>$this->request->nivel->base_course_id,
			"subject_id"=>$this->request->nivel->subject_id,
			"student_id"=>$this->request->nivel->student_id,
		);
	}else{
		$data = array(
"base_course_id"=>$this->request->nivel->base_course_id,
			"subject_id"=>$this->request->nivel->subject_id,
			"student_id"=>$this->request->nivel->student_id,
			"level_id"=>$this->request->nivel->level_id,

		);

	}

		$this->AregarasignaturaModel->Guardarestudenasig($data);		
	}
	public function eliminar()
	{
	            $id =   $this->request->id ;
	

		$this->AregarasignaturaModel->eliminar($id);		
	}
	public function verificar(){
		$users = $this->AregarasignaturaModel->verificar($this->request->verificar->base_course_id, $this->request->verificar->student_id, $this->request->verificar->subject_id);
		echo json_encode($users);		
	}
}
