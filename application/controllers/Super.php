<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

    public function __construct(){
         parent::__construct();
         $this->load->model('super_model');
         $this->load->model('user_model');
         $this->load->model('admin_model');
         if(!isset($_SESSION['id_comp_super']))
            $_SESSION['id_comp_super']=2;
    }
    public function index()
	{
		if($this->input->cookie('super')){
			$_SESSION['super']=$this->input->cookie('super');
            redirect(base_url("super/home"));
		}
		else 
			$this->load->view('super/login');
	} 
    public function check_super(){
  	    $pass=trim($this->input->post('password'));
        $log=trim($this->input->post('login'));
        if($this->super_model->check_super($log,$pass)){
             $_SESSION['super']=$log;
             setcookie('super', $log, time()+3600*24*10,'/');
             redirect(base_url("super/home"));
           
     	}
        else{
           $_SESSION['error']="Սխալ մուտքանուն կամ գաղտնաբառ";
           redirect(base_url('super/index')); 
        }
    }
    public function home(){
        $id_comp=$_SESSION['id_comp_super'];
    	$data['company_name']=$this->user_model->get_company_name_by_id($id_comp); 
    	$data['companys']=$this->user_model->get_companys();
    	$this->load->view('super/header',$data);
        //$this->load->view('super/home',$data);
    }
     public function company($comp){
       $id_comp=$_SESSION['id_comp_super'];
       $data['company_name']=$comp; 
       $data['companys']=$this->user_model->get_companys();
        $this->load->view('super/header',$data);

    }
    public function firms(){
      $id_comp=$_SESSION['id_comp_super']; 
      $data['company_name']=$this->user_model->get_company_name_by_id($id_comp);  
      $data['companys_data']=$this->super_model->get_companys_data();
      $this->load->view('super/header',$data);
      $this->load->view('super/firms',$data);

    }
    public function common(){
        $id_comp=$_SESSION['id_comp_super'];
        $data['users']=$this->admin_model->get_year_data($id_comp,$_SESSION['year']); 
        $data['month_data']=$this->admin_model->get_month_data($id_comp,$_SESSION['month'],$_SESSION['year']); 
        $data['available_months']=$this->admin_model->get_available_months($id_comp,$_SESSION['year']);
        $data['company_name']=$this->user_model->get_company_name_by_id($id_comp); 
        $data['available_years']=$this->admin_model->get_available_years($id_comp); 
        $this->load->view('super/header',$data);
        $this->load->view('super/common',$data);

    }
}

 