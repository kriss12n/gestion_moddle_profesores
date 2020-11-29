<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		// load base_url
		$this->load->helper('url');
		$this->load->library('MoodleRest');
		$this->request = json_decode(file_get_contents('php://input'));
		$this->load->model("CategoriaModel");
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('topmenu');
		$this->load->view('nav');
		$this->load->view('categorias');
	}
	public function created_Categori()
	{
		

		$data =	array(	
			"name" =>$this->request->categoria->name,
			"sige_code"=> $this->request->categoria->sige,	
			"description" =>$this->request->categoria->description,
		);	
		
	 $this->CategoriaModel->created_Categori($data);
	
	}
	public function editar()
	{
		
	      $id = $this->request->categoria->id;
		$data =	array(	
			"name" =>$this->request->categoria->name,
			"sige_code"=> $this->request->categoria->sige,	
			"description" =>$this->request->categoria->description,
		);	
		
	 $this->CategoriaModel->editar($data,$id);

	
	}
	public function deleteSubject()
	{
		
	      $id = $this->request->id;

		
	 $this->CategoriaModel->deleteSubject($id);

	
	}

	

	public function getSubject()
	{
		
		$profes = $this->CategoriaModel->getSubject();
		echo json_encode($profes);	
	}
}
