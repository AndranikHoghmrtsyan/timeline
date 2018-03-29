<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        if(!isset($_SESSION['month']))
              $_SESSION['month']=date('n');
        if(!isset($_SESSION['year']))
              $_SESSION['year']=date('Y');
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
		
		$pass=$this->input->post('password');

		$id_comp=$this->admin_model->check_admin($pass);
	
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

		 $data['userdata']=$this->admin_model->get_current_userdata($id_comp);
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
  public function month(){
     $id_comp=$_SESSION['id_comp'];
    

     $data['months_names']=$this->admin_model->get_months_of_year($id_comp,$_SESSION['year']);
   
     $data['company_name']=$this->user_model->get_company_name_by_id($id_comp); 
       
     $data['workers']=$this->admin_model->get_month_data($id_comp,$_SESSION['month'],$_SESSION['year']); 

     $this->load->view('admin/header',$data); 
     
     $this->load->view('admin/month',$data);
  } 
  public function get_worker_month_data(){
       $id=$this->input->post('id');
       $res=$this->admin_model->get_worker_month_data($id,$_SESSION['month'],$_SESSION['year']);
       echo ($res);
       //echo json_encode($res);

  } 
  public function edit_worker_month_data(){

      $res=$this->admin_model->edit_worker_month_data($this->input->post());
      $begin=strtotime($this->input->post('begin'));
      $begin_time1=strtotime($this->input->post('begin_time1'));
      $late=0;
      $delta=(int)(abs($begin-$begin_time1)/60);
      if($delta>5)
        $late=(int)(($begin-$begin_time1)/60);
      echo $late;


  }
	 public function year(){
     $id_comp=$_SESSION['id_comp'];
     $data['company_name']=$this->user_model->get_company_name_by_id($id_comp);
     $data['users']=$this->admin_model->get_period_data($id_comp,$period='year'); 
     $this->load->view('admin/header',$data); 
     $this->load->view('admin/year',$data); 

  }
  public function change_password_form(){
      $id_comp=$_SESSION['id_comp'];
      $data['company_name']=$this->user_model->get_company_name_by_id($id_comp); 
      $this->load->view('admin/header',$data); 
      $this->load->view('admin/change_password_form');
  }
  public function change_password(){
     $pass=$this->input->post('password');
     $new_pass1=$this->input->post('password1');
     $new_pass2=$this->input->post('password2');
     if($new_pass1!=$new_pass2){
     	$_SESSION['msg']="password not matching";
     	redirect(base_url('admin/change_password_form'));
     }
     if(!$this->admin_model->change_password($pass,$new_pass1))
         $_SESSION['msg']="password on use";
     else  
         $_SESSION['msg']="Your password is changed successfuly";
     redirect(base_url('admin/change_password_form')); 

  }
  public function get_worker_year_data(){
  	$id=$this->input->post('id');
      $data=$this->admin_model->get_worker_year_data($id);
      echo json_encode($data);

  }
  public function change_month(){
     $_SESSION['month']=$this->input->post('id');
  	
     //redirect(base_url('admin/month')); 


  }
}