<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_model extends CI_Model {

	public function check_super($log,$pass){
    return true;
        $this->db->select('id_comp');
        $res=$this->db->get_where('admin',['password'=>$pass,'login'=>$log])->row();

        if($res)
           return $res->id_comp;
        return false; 
	}
  public function get_companys_data(){
    $query="SELECT admin.*,name from admin join company on company.id=admin.id_comp";
      return $this->db->query($query)->result_array();
  }
}
  