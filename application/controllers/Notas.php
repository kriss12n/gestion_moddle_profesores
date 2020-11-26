<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notas extends CI_Controller {

	public function __construct() {

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->request = json_decode(file_get_contents('php://input'));

		$this->load->model("NotasModel");
	  }

	public function index()
	{	
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notas');
	}
	public function getNotas(){


		$notas = $this->NotasModel->getNotas();
		echo json_encode($notas);	
	}

	public function getEstuden(){


		$estuden = $this->NotasModel->getEstuden($this->request->id,$this->request->idasig);
		echo json_encode($estuden);	
	}
	public function getCurso(){

		$estuden = $this->NotasModel->getCurso($this->request->curso);
		echo json_encode($estuden);	
	}
	public function getProfe(){


		$profes = $this->NotasModel->getProfe();
		echo json_encode($profes);	
	}
	public function getSubject(){


		$Subject = $this->NotasModel->getSubject($this->request->id);
		echo json_encode($Subject);	
	}

	public function GuardarNota(){

		$data = array(
			"student_id"=>$this->request->notas->student_id,
			"teacher_id"=>$this->request->notas->teacher_id,
			"subject_id"=>$this->request->notas->subject_id,
			"calification"=>$this->request->notas->nota,
			"craeted_at"=>$this->request->notas->fecha,

		);

		$this->NotasModel->GuardarNota($data);		


	}

	

}
