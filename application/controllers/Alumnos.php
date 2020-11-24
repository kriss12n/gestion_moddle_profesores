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
		$this->load->model("UsuarioModel");
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
		$users = $this->UsuarioModel->getUsuario();
		echo json_encode($users);	
	}

	public function getRol()
	{
		$Rol = $this->UsuarioModel->getRol();
		echo json_encode($Rol);	
	}
	public function getApoderado()
	{
		$Apoderado = $this->UsuarioModel->getApoderado();
		echo json_encode($Apoderado);	
	}
// CREATES SEGUN ROL
	public function createAlumnos()
	{
		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"commune"=>$this->request->alumno->commune,
			"contact_movil"=>$this->request->alumno->contact_movil,
		);

		$this->UsuarioModel->createAlumnos($data);		
	}

	public function createProfesor()
	{
		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"email"=>$this->request->alumno->email,
			"phone"=>$this->request->alumno->phone,
			"contact_movil"=>$this->request->alumno->contact_movil,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"password"=>hash("sha256",$this->request->alumno->password),
			"commune"=>$this->request->alumno->commune,
		);

		$this->UsuarioModel->createProfesor($data);		
	}

	public function createApoderado()
	{
		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"phone"=>$this->request->alumno->phone,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"commune"=>$this->request->alumno->commune,
			"contact_movil"=>$this->request->alumno->contact_movil
		);

		$this->UsuarioModel->createApoderado($data);	
	}

	public function createGesor()

	{
		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"email"=>$this->request->alumno->email,
			"phone"=>$this->request->alumno->phone,
			"contact_movil"=>$this->request->alumno->contact_movil,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"password"=>hash("sha256",$this->request->alumno->password),
			"commune"=>$this->request->alumno->commune,
		);

		$this->UsuarioModel->createGesor($data);	
	}
//TERMINO CREATES SEGUN ROL
//UPDATES SEGUN EL ROL 
	public function updateA(){
	
		$id = $this->request->alumno->id;

		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"commune"=>$this->request->alumno->commune,
			"contact_movil"=>$this->request->alumno->contact_movil,
		);

		$this->UsuarioModel->updateA($data,$id);	
	
	}
	public function updateP(){
		$id = $this->request->alumno->id;
		if($this->request->alumno->passwordsecret ==""){
			$data = array(
				"rut"=>$this->request->alumno->rut,
				"name"=>$this->request->alumno->name,
				"lastname_p"=>$this->request->alumno->lastname_p,
				"lastname_m"=>$this->request->alumno->lastname_m,
				"email"=>$this->request->alumno->email,
				"phone"=>$this->request->alumno->phone,
				"contact_movil"=>$this->request->alumno->contact_movil,
				"address"=>$this->request->alumno->address,
				"rol_id"=>$this->request->alumno->rol_id,
				"representative_id"=>$this->request->alumno->representative_id,
				"representative_supp_id"=>$this->request->alumno->representative_supp_id,
				"course_id"=>$this->request->alumno->course_id,
				"prioritary"=>$this->request->alumno->prioritary,
				"commune"=>$this->request->alumno->commune,
			);
		}else{
			$data = array(
				"rut"=>$this->request->alumno->rut,
				"name"=>$this->request->alumno->name,
				"lastname_p"=>$this->request->alumno->lastname_p,
				"lastname_m"=>$this->request->alumno->lastname_m,
				"email"=>$this->request->alumno->email,
				"phone"=>$this->request->alumno->phone,
				"contact_movil"=>$this->request->alumno->contact_movil,
				"address"=>$this->request->alumno->address,
				"rol_id"=>$this->request->alumno->rol_id,
				"representative_id"=>$this->request->alumno->representative_id,
				"representative_supp_id"=>$this->request->alumno->representative_supp_id,
				"course_id"=>$this->request->alumno->course_id,
				"prioritary"=>$this->request->alumno->prioritary,
				"password"=>hash("sha256",$this->request->alumno->passwordsecret),
				"commune"=>$this->request->alumno->commune,
			);
		}

		$this->UsuarioModel->updateP($data,$id);		
	}
	public function updateAP(){
		$id = $this->request->alumno->id;
		$data = array(
			"rut"=>$this->request->alumno->rut,
			"name"=>$this->request->alumno->name,
			"lastname_p"=>$this->request->alumno->lastname_p,
			"lastname_m"=>$this->request->alumno->lastname_m,
			"address"=>$this->request->alumno->address,
			"rol_id"=>$this->request->alumno->rol_id,
			"phone"=>$this->request->alumno->phone,
			"representative_id"=>$this->request->alumno->representative_id,
			"representative_supp_id"=>$this->request->alumno->representative_supp_id,
			"course_id"=>$this->request->alumno->course_id,
			"prioritary"=>$this->request->alumno->prioritary,
			"commune"=>$this->request->alumno->commune,
			"contact_movil"=>$this->request->alumno->contact_movil
		);

		$this->UsuarioModel->updateAP($data,$id);	
	}
	public function updateG(){
		$id = $this->request->alumno->id;

		if($this->request->alumno->passwordsecret ==""){
			$data = array(
				"rut"=>$this->request->alumno->rut,
				"name"=>$this->request->alumno->name,
				"lastname_p"=>$this->request->alumno->lastname_p,
				"lastname_m"=>$this->request->alumno->lastname_m,
				"email"=>$this->request->alumno->email,
				"phone"=>$this->request->alumno->phone,
				"contact_movil"=>$this->request->alumno->contact_movil,
				"address"=>$this->request->alumno->address,
				"rol_id"=>$this->request->alumno->rol_id,
				"representative_id"=>$this->request->alumno->representative_id,
				"representative_supp_id"=>$this->request->alumno->representative_supp_id,
				"course_id"=>$this->request->alumno->course_id,
				"prioritary"=>$this->request->alumno->prioritary,
				"commune"=>$this->request->alumno->commune,
			);
		}else{
			$data = array(
				"rut"=>$this->request->alumno->rut,
				"name"=>$this->request->alumno->name,
				"lastname_p"=>$this->request->alumno->lastname_p,
				"lastname_m"=>$this->request->alumno->lastname_m,
				"email"=>$this->request->alumno->email,
				"phone"=>$this->request->alumno->phone,
				"contact_movil"=>$this->request->alumno->contact_movil,
				"address"=>$this->request->alumno->address,
				"rol_id"=>$this->request->alumno->rol_id,
				"representative_id"=>$this->request->alumno->representative_id,
				"representative_supp_id"=>$this->request->alumno->representative_supp_id,
				"course_id"=>$this->request->alumno->course_id,
				"prioritary"=>$this->request->alumno->prioritary,
				"password"=>hash("sha256",$this->request->alumno->passwordsecret),
				"commune"=>$this->request->alumno->commune,
			);
		}

		$this->UsuarioModel->updateG($data,$id);	
	}

// TERMINO DE UPDATES SEGUN EL ROL


	public function deleteAlumnos()
	{

		$id = $this->request->alumno;

		$this->UsuarioModel->deleteUsuario($id);
}
public function getAlumnosByFilter(){


	$filtro = $this->UsuarioModel->getAlumnosByFilter($this->request->filtro);

	echo json_encode($filtro);	
}
}


