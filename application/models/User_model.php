<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_users_by_company($id_comp)
	{
		return $this->db->get_where('users',['id_comp'=>$id_comp])->result_array();
	}
	public function check_user($id,$password)
	{
		return $this->db->get_where('users', array('id' => $id,'password'=>$password))->num_rows();
          
		
	}
	public function register($arr)
	{
       $this->db->insert('users', $arr); 

	}
	public function get_user_data($id){

    if(!$this->has_day_record($id)){
     	 $this->db->select('begin_time,end_time');
     	 $row=$this->db->get('users')->row();
    	 $begin_time=$row->begin_time;
  	     $end_time=$row->end_time;
  	     $this->db->query("INSERT INTO timeline(user_id,day,begin_time1,end_time1)values($id,curdate(),'$begin_time','$end_time')");
		}
		
	    return $this->db->query("SELECT * from timeline,users WHERE user_id=`users`.id and user_id=$id and day=curdate()")->result_array();

	}
	
	private function has_day_record($id){
       return $this->db->query("SELECT user_id from timeline WHERE user_id=$id and day=curdate()")->num_rows();
	}
	public function set_time($id,$time){
		$time_value=date('H : i');
         $this->db->query("UPDATE timeline SET $time='$time_value'  WHERE user_id=$id AND day=curdate()");
		

	}
	public function set_description($id,$text){
		
      return $this->db->query("UPDATE  timeline SET description='$text' WHERE user_id=$id and day=curdate()");

	}
	public function get_companys(){

       return $this->db->get('company')->result_array();

	}
	public function get_company_name_by_id($id_comp){
        $this->db->select('name');
    return  $this->db->get_where('company', ['id' => $id_comp])->row()->name;
       

	}
	
	public function get_profile($id){
        $this->db->select('name,surname,password');
        return $this->db->get_where('users',['id'=>$id])->result_array();

	}
	public function update_profile($id,$name,$surname,$pass){
        $data = array(
          'password' => $pass
        );

        $this->db->where('id', $id);
        $this->db->update('users', $data); 


	}
	
}