<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

    public function __construct(){
         parent::__construct();
         $this->load->model('super_model');
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
    	$this->load->model('user_model');
    	$data['companys']=$this->user_model->get_companys();
    	$this->load->view('super/header',$data);
        //$this->load->view('super/home',$data);
    }
}

 