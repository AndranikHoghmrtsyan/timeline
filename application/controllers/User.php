<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
public function __construct(){
     parent::__construct();
     $this->load->model('user_model');

}

	public function index()
	{
		//$data['users']=$this->user_model->get_all();
		$data['companys']=$this->user_model->get_companys();
		$this->load->view('header',$data);
	}
	public function company($id_comp)
	{
		$_SESSION['id_comp']=$id_comp;
        $header_data['companys']=$this->user_model->get_companys();
        $this->load->view('header',$header_data);
		$data['users']=$this->user_model->get_users_by_company($id_comp);
		$data['company_name']=$this->user_model->get_company_name_by_id($id_comp);
		$this->load->view('all_users',$data);
	}
    public function register_form()
	{
		$this->load->view('reg_form');
	}
	public function register()
	{
		$this->user_model->register($this->input->post());
	}
	public function get_user_data()
	{
    
		 $id=$this->input->post('id');
		 $password=$this->input->post('password');
		 $res=$this->user_model->check_user($id,$password);
        if(!$res)
      	     echo json_encode(["status"=>"error"]);
        else{
        	
      	    $data=$this->user_model->get_user_data($id);
      	 
      	   echo json_encode(["status"=>"success","user"=>$data[0]]);
	        }
    } 
    public function set_time()
	{
		
		   $id=$this->input->post('id');
		   $time=$this->input->post('time');
     date_default_timezone_set('Asia/Yerevan');

	$this->user_model->set_time($id,$time);
     $time1=date('H:i');
      echo $time1;
	} 
 public function set_description(){
 	$id=$this->input->post('id');
	$text=$this->input->post('text');
 	echo $this->user_model->set_description($id,$text);
 }
  
 
public function get_profile(){
     $id=$this->input->post('id');
     echo json_encode($this->user_model->get_profile($id));
}
public function update_profile(){
     $password=$_POST['password'];
     $id=$_POST['id'];
     $this->user_model->update_profile($id,$password);
}
}
