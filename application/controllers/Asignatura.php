<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asignatura extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->load->model("AsignaturaModel");
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('asignatura');
	}
	public function created_subject()
	{
		// require_once(APPPATH.'libraries/MoodleRest.php');
		// $MoodleRest = new MoodleRest();
		// $MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		// $MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$data =	array(	
			"name" =>$this->request->asignatura->name,
			"sige_code"=> $this->request->asignatura->sige,			
			"description" =>$this->request->asignatura->description,
		);	

		$this->AsignaturaModel->createSubject($data);			

			
	}

	public function getSubject()
	{
		// require_once(APPPATH . 'libraries/MoodleRest.php');
		// $MoodleRest = new MoodleRest();
		// $MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		// $MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		// $courses = $MoodleRest->request(


		// 	'core_course_get_courses',
		// 	array(
		// 		"options" => array(
		// 			"ids" => array(),
		// 		)
		// 	),
		// 	MoodleRest::RETURN_JSON
		// );

		$asignaturas = $this->AsignaturaModel->getSubject();


		echo json_encode($asignaturas);
	}

	public function update_subject(){

		$id = $this->request->asignatura->id;

		$data =	array(	
			"name" =>$this->request->asignatura->name,
			"sige_code"=> $this->request->asignatura->sige,	
			"description" =>$this->request->asignatura->description,
		);	

		$this->AsignaturaModel->updateSubject($data,$id);

	}

	public function delete_subject(){

		$id = $this->request->asignatura->id;
		$this->AsignaturaModel->deleteasignatura($id);


	}
	public function getLevelBySubject(){

	

		$id = $this->request->asignatura;
		
		// require_once(APPPATH . 'libraries/MoodleRest.php');
		// $MoodleRest = new MoodleRest();
		// $MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		// $MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');
		// $courses = $MoodleRest->request(


		// 	'core_course_get_courses_by_field',
		// 	array(
		// 		'field' => "category",
		// 		'value' => $id,
		// 	),
		// 	MoodleRest::RETURN_JSON
		// );


		$levels = $this->AsignaturaModel->getLevelBySubject($id);

        echo json_encode($levels);

	}

}
