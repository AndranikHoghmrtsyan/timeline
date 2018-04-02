<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


   public function check_oper($oper_log,$oper_pass){
        $this->db->select('id,id_comp');
        return $this->db->get_where('admin',['oper_pass'=>$oper_pass,'oper_log'=>$oper_log])->row();
        
    }
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
         $row=$this->db->get_where('users',array('id' => $id))->row();
    	 $begin_time=$row->begin_time.':00';
  	     $end_time=$row->end_time.':00';
  	     $sql="INSERT INTO timeline(user_id,day,begin_time1,end_time1)values($id,curdate(),'$begin_time','$end_time')";
  	     $this->db->query($sql);
		}
		
	    return $this->db->query("SELECT 
	    	TIME_FORMAT(`begin`, '%H:%i') as `begin`,
	    	TIME_FORMAT(`end`, '%H:%i') as `end`,
	    	TIME_FORMAT(`lunch_begin`, '%H:%i') as `lunch_begin`,
	    	TIME_FORMAT(`lunch_end`, '%H:%i') as `lunch_end`,
	    	description,
	    	begin_time,
	    	end_time 
	    	from timeline,users WHERE user_id=`users`.id and `users`.id=$id and day=curdate()")->result_array();

	}
	
	private function has_day_record($id){
       return $this->db->query("SELECT user_id from timeline WHERE user_id=$id and day=curdate()")->num_rows();
	}
	public function set_time($id,$time){
		
		  	$sql="UPDATE timeline SET $time=CURRENT_TIME(),`late`=(TIME_TO_SEC(`begin`)-TIME_TO_SEC(`begin_time1`))/60 WHERE user_id=$id AND day=curdate()";
		
         $this->db->query($sql);

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
	public function update_oper($user_id,$new_log,$new_pass1){




		
	}
	
}