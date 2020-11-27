<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CursosModel extends CI_Model {

    function __construct()
    {
		parent::__construct();
		$this->load->database();

    }
    
	public function createCursos($data){

		   $query = $this->db->insert('base_course',$data);  
		   
            return true; 
           
	}

	public function getCursos(){
		$query = $this->db->get("base_course");
		return $query->result();

	}

	public function updateCursos($data,$id){

		$this->db->where("id",$id);
		$query = $this->db->update("base_course",$data);
		return true;

	}

	public function deleteCursos($id){

		$this->db->where("id",$id);
		$query = $this->db->delete("base_course");
		return true;
	}

	public function updateUserWithoutPassword($data,$id){
		$this->db->where("id",$id);
		$query = $this->db->update("usuario",$data);
		return true;
	}

	public function getStudentsByTeacherChief($id){

		$query =	$this->db->query('SELECT * FROM user WHERE id IN 
		(SELECT student_id FROM group_user WHERE group_id =
		(SELECT group_id FROM planilla WHERE teacher_id = '.$id.'))
		ORDER BY user.lastname_p ASC
		');
		return $query->result();

	}

	public function getSubjectsByStudent($id){

		$query =	$this->db->query('SELECT id,name FROM subject where id IN (
			SELECT subject_id FROM califications where student_id = '.$id.')');

		return $query->result();

	}

	public function getCalificationsBySubjectAndStudent($id,$student){

		$query= $this->db->query('SELECT id,calification FROM califications WHERE subject_id ='.$id.'  AND student_id = '.$student.'');
	
		return $query->result();

	}
	
}
