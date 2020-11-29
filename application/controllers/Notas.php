<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notas extends CI_Controller
{

	public function __construct()
	{

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
	public function notastodas()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notastodas');
	}
	public function notascurso()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notascurso');
	}
	public function notascursoasignatura()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notascursoasignatura');
	}
	public function notascursoasignaturastuden()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notascursoasignaturastuden');
	}
	public function notascursoestudiante()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('notascursoestudiante');
	}

	public function getNotas()
	{


		$notas = $this->NotasModel->getNotas();
		echo json_encode($notas);
	}
	public function semestre()
	{


		$notas = $this->NotasModel->semestre($this->request->sem);
		echo json_encode($notas);
	}


	public function getEstuden()
	{


		$estuden = $this->NotasModel->getEstuden($this->request->id, $this->request->idasig);
		echo json_encode($estuden);
	}
	public function getCurso()
	{

		$estuden = $this->NotasModel->getCurso($this->request->curso);
		echo json_encode($estuden);
	}
	public function getNotasFiltro()
	{

		$estuden = $this->NotasModel->getNotasFiltro();
		echo json_encode($estuden);
	}

	public function getFiltroasignatura()
	{

		$estuden = $this->NotasModel->getFiltroasignatura($this->request->filtroasig);
		echo json_encode($estuden);
	}
	public function getFiltroasignaturaver()
	{

		$estuden = $this->NotasModel->getFiltroasignaturaver($this->request->filtroasig);
		echo json_encode($estuden);
	}

	public function getFiltroestuden()
	{

		$estudenx = $this->NotasModel->getFiltroestuden($this->request->filtroasig, $this->request->filtrocurso);
		echo json_encode($estudenx);
	}
	public function getFiltroestudenverx()
	{

		$estudenx = $this->NotasModel->getFiltroestudenverx($this->request->filtrocurso);
		echo json_encode($estudenx);
	}

	public function getFiltroestudenvert()
	{

		$estudenx = $this->NotasModel->getFiltroestudenvert($this->request->filtrocurso);
		echo json_encode($estudenx);
	}
	public function getFiltroestudenver()
	{

		$estudenx = $this->NotasModel->getFiltroestudenver($this->request->filtroasig, $this->request->filtrocurso);
		echo json_encode($estudenx);
	}
	public function getFiltroNOTAS()
	{

		$estudenx = $this->NotasModel->getFiltroNOTAS($this->request->filtroasig, $this->request->filtrocurso, $this->request->filtroestuden);
		echo json_encode($estudenx);
	}
	public function getFiltroNOTASVER()
	{

		$estudenx = $this->NotasModel->getFiltroNOTASVER($this->request->filtrocurso, $this->request->filtroestuden);
		echo json_encode($estudenx);
	}
	public function getProfe()
	{


		$profes = $this->NotasModel->getProfe();
		echo json_encode($profes);
	}
	public function getSubject()
	{


		$Subject = $this->NotasModel->getSubject($this->request->id);
		echo json_encode($Subject);
	}

	public function GuardarNota()
	{

		$data = array(
			"student_id" => $this->request->notas->student_id,
			"teacher_id" => $this->request->notas->teacher_id,
			"subject_id" => $this->request->notas->subject_id,
			"calification" => $this->request->notas->nota,
			"craeted_at" => $this->request->notas->fecha,
			"course_id" => $this->request->notas->cursoid,
			"semestre" => $this->request->notas->semestre,

		);

		$this->NotasModel->GuardarNota($data);
	}
	public function EditarNota()
	{
		$id = $this->request->editnota->id;

		$data = array(
			"calification" => $this->request->editnota->nota,



		);

		$this->NotasModel->EditarNota($data, $id);
	}
}
