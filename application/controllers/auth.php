<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {

    parent::__construct();
    // load base_url
	$this->load->helper('url');
	$this->load->library('MoodleRest');
	$this->request = json_decode(file_get_contents('php://input'));
  }

	public function login()
	{
		require_once(APPPATH.'libraries/MoodleRest.php');
		$MoodleRest = new MoodleRest();
		$MoodleRest->setServerAddress("https://educacion.citizenapp.cl/webservice/rest/server.php");
		$MoodleRest->setToken('5da89f5f2ca98b8f3d3582933c4d7095');

		$login = array("user"=>array(array("username"=>"memosaurio","password"=>'$$mem1to**-')));

		

	$return = 	$MoodleRest->request(
			"core_auth_user_login",
			$login,
			MoodleRest::METHOD_POST
		);

		print_r($return);

		// $user=$this->request->user;
		// $password= $this->request->password;
		
		// if(isset($data[0])){
		// 	$session_data = array(
		// 		'id'=>$data[0]->id,
		// 		'nombre'=>$data[0]->nombre,
		// 		'telefono'=>$data[0]->telefono,
		// 		'email'=>$data[0]->email,
		// 		'usuario'=>$data[0]->usuario,
		// 		'tipo_usuario'=>$data[0]->id_tipo_usuario,
		// 	);
		// 	$this->session->set_userdata($session_data); 
		// 	echo json_encode($this->session);
		// }else{
		// 	echo json_encode("Error al intentar iniciar sesión, intentelo denuevo");
		// }	
		
	}
	  function enter(){  
           if($this->session->userdata('nombre') != '')  
           {
			   $data["validation"] = true;
			   $data["rol"] = $this->session->userdata["tipo_usuario"] ;

			   echo json_encode($data);  
		   }
           else  
           {  
                echo json_encode(false);
           }  
      }  

	 function logout()  
      {  
           	$this->session->unset_userdata('user');  
        	$this->load->view('header');
			$this->load->view('/auth/login');
      }  
}



