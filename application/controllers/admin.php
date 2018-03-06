<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
    }

	public function index()
	{
		if($this->input->cookie('id_comp')){
			$id_comp=$this->input->cookie('id_comp');
			$_SESSION['id_comp']=$id_comp;
			redirect(base_url('admin/home'));
		}

		else $this->load->view('admin/login');
	}

	public function check_admin()
	{
		$login=$this->input->post('login');
		$pass=$this->input->post('password');

		$id_comp=$this->admin_model->check_admin($login,$pass);
	
        if($id_comp!==false){
            $_SESSION['id_comp']=$id_comp;	
            if($this->input->post('remember'))
               	setcookie('id_comp', $id_comp, time()+3600*24*10,'/');
                redirect(base_url('admin/home'));
     	    }
	}

	public function home(){
		if(!isset($_SESSION['id_comp']))
			  redirect(base_url('admin/index'));
		 $id_comp=$_SESSION['id_comp'];
         $data['company_name']=$this->user_model->get_company_name_by_id($id_comp);   
         $this->load->view('admin/header',$data); 
		 $data['userdata']=$this->admin_model->get_today_userdata($id_comp);
		 $this->load->view('admin/home',$data);
   }

	public function logout(){

	   $id_comp=$_SESSION['id_comp'];
       unset($_SESSION['id_comp']);
       setcookie('id_comp', "", time()-3600,'/');
       //$this->input->set_cookie('id_comp', $id_comp, time()-3600,"", '/');
       redirect(base_url('admin/index'));
	}

	public function edit_user_today_timeline(){
		
		print_r( $this->admin_model->edit_user_today_timeline($_POST));
	}
	public function workers(){
		if(!isset($_SESSION['id_comp']))
			  redirect(base_url('admin/index'));
		 $id_comp=$_SESSION['id_comp'];
		 $data['company_name']=$this->user_model->get_company_name_by_id($id_comp);   
         $this->load->view('admin/header',$data); 
		 $w['workers']=$this->user_model->get_users_by_company($id_comp);
         $this->load->view('admin/workers',$w);
	}
	public function add_user(){
     $name=$_POST['name'];
     $surname=$_POST['surname'];
     $this->admin_model->add_user($name,$surname);

  }  
  public function delete_user(){
        $id=$this->input->post('id');
        
         $path=explode('/',$this->input->post('src'));
         $path=end($path);
         if($path!='default.jpg'){
            $path="images/$path";
            unlink($path);
         }
         $this->admin_model->delete_user($id);
  }
  public function update_user(){
       $id=$this->input->post('id');
       $name=$this->input->post('name');
       $surname=$this->input->post('surname');
       $begin_time=$this->input->post('begin_time');
       $end_time=$this->input->post('end_time');
       $src=explode('/',$this->input->post('src'));
       $src='images/'.end($src);
  
       $this->admin_model->update_user($id,$name,$surname,$src,$begin_time,$end_time);
  }



 public function upload(){
  
  	move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
  	echo 'images/'.$_FILES['file']['name'];

  }
  public function week(){
     $id_comp=$_SESSION['id_comp'];
      $data['data']=$this->admin_model->get_week_data($id_comp);
      
  }  
	
}