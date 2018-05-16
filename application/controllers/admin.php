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

///////////////////
	public function index()
	{
		if($this->input->cookie('role')){
            $_SESSION['role']=$this->input->cookie('role');
			$_SESSION['id_comp']=$this->input->cookie('id_comp');
			redirect(base_url("admin/home"));
		}
		else 
            $this->load->view('admin/login');
	}
///////////////////
    public function load_view($page,$data=[]){
         $id_comp=$_SESSION['id_comp'];  
         $data['company_name']=$this->user_model->get_company_name_by_id($id_comp);
         if($_SESSION['role']=='admin')   
            $this->load->view('admin/header',$data);
         elseif($_SESSION['role']=='super')
             $this->load->view('admin/super_header',$data);
         $this->load->view("admin/$page",$data);
    }
/////////////////
	public function check_admin()
	{
		$pass=trim($this->input->post('pass'));
        $log=trim($this->input->post('log'));
		$res=$this->admin_model->check_admin($log,$pass);
        
        if($res){
             $_SESSION['id_comp']=$res->id_comp;
             $_SESSION['role']=$res->role;
             setcookie('id_comp', $res->id_comp, time()+3600*24*10,'/');
             setcookie('role',$res->role, time()+3600*24*10,'/');
             redirect(base_url("admin/home"));
           
     	}
        else{
           $_SESSION['error']="Սխալ մուտքանուն կամ գաղտնաբառ";
           redirect(base_url('admin/index')); 
        }

	}
///////////
	public function home(){
        if(!isset($_SESSION['role']))
            redirect(base_url('admin/index'));
        $id_comp=$_SESSION['id_comp'];  
        if($_SESSION['role']=='admin'){  
            $data['userdata']=$this->admin_model->get_current_userdata($id_comp);
            $this->load_view('home',$data);
        }
        else{
            $data['companys']=$this->admin_model->get_companys(); 
            $data['users']=$this->admin_model->get_year_data($id_comp,$_SESSION['year']); 
            $data['month_data']=$this->admin_model->get_month_data($id_comp,$_SESSION['month'],$_SESSION['year']); 
            $data['available_months']=$this->admin_model->get_available_months($id_comp,$_SESSION['year']);
            $data['available_years']=$this->admin_model->get_available_years($id_comp); 
            $this->load_view('year',$data); 
        }
    }
///////////
	public function logout(){
       unset($_SESSION['id_comp']);
       unset($_SESSION['role']);
       setcookie('id_comp', "", time()-3600,'/');
       setcookie('role', "", time()-3600,'/');
       redirect(base_url('admin/index'));
	}
    public function firms(){
       if(!isset($_SESSION['role']))
            redirect(base_url('admin/index')); 
       $data['companys_data']=$this->admin_model->get_companys_data();
       $this->load_view('firms',$data);

    }
	public function edit_current_timeline(){
		$this->admin_model->edit_current_timeline($_POST);
		$begin=strtotime($_POST['begin']);
		$begin_time=strtotime($_POST['begin_time']);
		$minutes_diff=($begin-$begin_time)/60;
		if(abs($minutes_diff)>5)	
		   echo $minutes_diff;
		else echo 0;
	}

	public function workers(){
		
		if(!isset($_SESSION['id_comp']))
			  redirect(base_url('admin/index'));
		$id_comp=$_SESSION['id_comp'];
		$w['workers']=$this->user_model->get_users_by_company($id_comp);
        $this->load_view('workers',$w);
	}
	public function add_user(){
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $password=$_POST['password'];
        $this->admin_model->add_user($name,$surname,$password);
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
        $pass=$this->input->post('pass');
        $this->admin_model->update_user($id,$name,$surname,$src,$begin_time,$end_time,$pass);
    }

    public function upload(){
  	    move_uploaded_file($_FILES['file']['tmp_name'],'images/'.$_FILES['file']['name']);
  	    echo 'images/'.$_FILES['file']['name'];

    }

    // public function month(){
    //     $id_comp=$_SESSION['id_comp'];
    //     $data['months_names']=$this->admin_model->get_months_of_year($id_comp,$_SESSION['year']);
    //     $data['workers']=$this->admin_model->get_month_data($id_comp,$_SESSION['month'],$_SESSION['year']); 
    //     $this->load_view('month',$data);
    // } 

    public function get_worker_month_data(){
    	$user_id=$this->input->post('user_id');
      
        $res=$this->admin_model->get_worker_month_data($user_id,$_SESSION['month'],$_SESSION['year']);
       
       echo json_encode($res);
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
		if(!isset($_SESSION['role']))
            redirect(base_url('admin/index'));
        $id_comp=$_SESSION['id_comp'];
        $data['users']=$this->admin_model->get_year_data($id_comp,$_SESSION['year']); 
        $data['month_data']=$this->admin_model->get_month_data($id_comp,$_SESSION['month'],$_SESSION['year']); 
        $data['available_months']=$this->admin_model->get_available_months($id_comp,$_SESSION['year']);
        $data['available_years']=$this->admin_model->get_available_years($id_comp); 
        $this->load_view('year',$data); 
    }

    public function change_password_form(){
       
        $this->load_view('change_password_form');
    }

    public function change_password(){
    	if(!isset($_SESSION['role']))
            redirect(base_url('admin/index'));
        $old_pass=$this->input->post('old_password');
        $new_log=$this->input->post('new_login');
        $new_pass1=$this->input->post('new_password1');
        $new_pass2=$this->input->post('new_password2');
        if($new_pass1!=$new_pass2){
     	    $_SESSION['msg']="Գաղտնաբառերը չեն համընկնում";
     	    redirect(base_url('admin/change_password_form'));
        }
        if(!$this->admin_model->change_password($old_pass,$new_log,$new_pass1))
            $_SESSION['msg']="Սխալ մուտքանուն կամ գաղտնաբառ";
        else  
            $_SESSION['msg']="Ձեր տվյալներն հաջողությամբ փոխվել են";
        redirect(base_url('admin/change_password_form')); 

    }

    public function get_worker_year_data(){
  	    $id=$this->input->post('id');
        $data=$this->admin_model->get_worker_year_data($id);
        echo json_encode($data);

    }
    public function change_month(){
        $_SESSION['month']=$this->input->post('id');
  	   // redirect(base_url('admin/year')); 
    } 
    public function change_year(){
    	if(!isset($_SESSION['role']))
            redirect(base_url('admin/index'));
        $_SESSION['year']=$this->input->post('year');
        redirect(base_url('admin/year')); 
    } 
    public function individual(){
    	if(!isset($_SESSION['role']))
            redirect(base_url('admin/index'));
        $id_comp=$_SESSION['id_comp'];
        $data['companys']=$this->admin_model->get_companys(); 
        $data['users']=$this->admin_model->get_year_data($id_comp,$_SESSION['year']); 
        $data['available_months']=$this->admin_model->get_available_months($id_comp,$_SESSION['year']);
        $data['available_years']=$this->admin_model->get_available_years($id_comp); 
        $this->load_view('individual',$data); 
    }
     public function change_ind_month(){
        $_SESSION['month']=$this->input->post('month');
        $user_id=$this->input->post('user_id');
        $res=$this->admin_model->get_worker_month_data($user_id,$_SESSION['month'],$_SESSION['year']);
        echo json_encode($res);
      
    } 
    public function change_company($id_comp,$page){
        $_SESSION['id_comp']=$id_comp;
         redirect(base_url("admin/$page")); 


    }
    public function add_firm(){
        $name=$this->input->post('name');
        $log=$this->input->post('log');
        $pass=$this->input->post('pass');
        $this->admin_model->add_firm($name,$log,$pass);
    }
    public function update_firm(){
       $name=$this->input->post('name');
       $id=$this->input->post('id');
       $this->admin_model->update_firm($id,$name);
    }
    public function delete_firm(){
        $id_comp=$this->input->post('id');
        $this->admin_model->delete_firm($id_comp);
    }
    
}