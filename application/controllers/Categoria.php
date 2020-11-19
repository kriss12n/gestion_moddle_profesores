<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	public function __construct() {

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
		$this->load->view('categorias');
	}
	public function created_Categori(){
		require_once(APPPATH.'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

print_r($this->request);

		$new_categoria = array("categories"=>array(	
            array(	"name" =>$this->request->categoria->name,
                	"description" =>$this->request->categoria->description
                	
            )
			)
		);	

			$return = $MoodleRest->request(
				'core_course_create_categories', 
				$new_categoria, 
				MoodleRest::METHOD_POST
			);

			echo json_encode($return);
	}

	public function get_Categori(){
		require_once(APPPATH.'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');
	
		$categori = $MoodleRest->request(

			'core_course_get_categories',
		array("criteria"=>array(
		   array(
			  "key"=>"visible",
				"value"=>"1"
		   ),
			)
		),
		MoodleRest::RETURN_JSON
		);
		
	echo json_encode($categori);
	}

}
