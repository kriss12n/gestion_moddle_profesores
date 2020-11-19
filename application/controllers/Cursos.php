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
		require_once(APPPATH.'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');



		$new_cursos = array("courses"=>array(	
            array(	"fullname" =>$this->request->cursos->fullname,
					"shortname" =>$this->request->cursos->shortname,
					"summary" =>$this->request->cursos->summary,
                	"categoryid" =>$this->request->cursos->categoryid,
                	
            )
			)
		);	

			$return = $MoodleRest->request(
				'core_course_create_courses', 
				$new_cursos, 
				MoodleRest::METHOD_POST
			);

			echo json_encode($return);
	}

	public function getcourses()
	{
		require_once(APPPATH . 'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$courses = $MoodleRest->request(


			'core_course_get_courses',
			array(
				"options" => array(
					"ids" => array(),
				)
			),
			MoodleRest::RETURN_JSON
		);


		echo json_encode($courses);
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
