<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Alumnos extends CI_Controller
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
		$this->load->view('alumnos');
	}
	public function getAlumnos()
	{

		require_once(APPPATH . 'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$users = $MoodleRest->request(

			'core_user_get_users',
			array(
				"criteria" => array(
					array(
						"key" => "role",
						"value" => "1"
					),
				)
			),
			MoodleRest::RETURN_JSON
		);

		echo json_encode($users, true);
	}

	public function createAlumnos()
	{

		require_once(APPPATH . 'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');


		$new_user = array(
			"users" => array(
				array(
					"username" => $this->request->alumno->username,
					"firstname" => $this->request->alumno->name,
					'lastname' => $this->request->alumno->lastname,
					'email' => $this->request->alumno->email,
					'password' => $this->request->alumno->password,
					'phone1' => $this->request->alumno->phone1,
					'address' => $this->request->alumno->address,
					'city' => $this->request->alumno->city,
				)
			)
		);

		$return = $MoodleRest->request(
			'core_user_create_users',
			$new_user,
			MoodleRest::METHOD_POST
		);

		echo json_encode($return);
	}
	public function deleteAlumnos()
	{

		require_once(APPPATH . 'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');


		$eliminarUser = array("userids" => array(
			$this->request->alumno
		));
		
		$return = $MoodleRest->request(
			'core_user_delete_users',
			$eliminarUser,
			MoodleRest::METHOD_POST
		);
		print_r($return);
	}
}
