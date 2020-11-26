<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cursos extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->load->model("CursosModel");
		$this->request = json_decode(file_get_contents('php://input'));
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('curso');
	}
	public function created_courses()
	{
		// require_once(APPPATH.'libraries/MoodleRest.php');
		// $MoodleRest = new MoodleRest();
		// $MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		// $MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$data =	array(	"name" =>$this->request->cursos->name,
						"description" =>$this->request->cursos->description,
		);	

		$this->CursosModel->createCursos($data);			

			
	}

	public function getcourses()
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

		$cursos = $this->CursosModel->getCursos();


		echo json_encode($cursos);
	}

	public function update_courses(){

		$id = $this->request->cursos->id;

		$data =	array(	
			"name" =>$this->request->cursos->name,
			"description" =>$this->request->cursos->description,
		);	

		$this->CursosModel->updateCursos($data,$id);


	}

	public function delete_courses(){

		$id = $this->request->cursos->id;
		$this->CursosModel->deleteCursos($id);


	}
	public function getcoursesByFilter(){

	

		$id = $this->request->filtro;
		
		require_once(APPPATH . 'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$courses = $MoodleRest->request(


			'core_course_get_courses_by_field',
			array(
				'field' => "category",
				'value' => $id,
			),
			MoodleRest::RETURN_JSON
		);


        echo json_encode($courses);

	}

}
