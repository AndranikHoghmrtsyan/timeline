<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

    public function __construct(){
         parent::__construct();
         $this->load->model('super_model');
         $this->load->model('user_model');
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
     public function company($id_comp){
       $id_comp=$_SESSION['id_comp_super'];
       $data['company_name']=$this->user_model->get_company_name_by_id($id_comp); 
       $data['companys']=$this->user_model->get_companys();
        $this->load->view('super/header',$data);

    }
}

 