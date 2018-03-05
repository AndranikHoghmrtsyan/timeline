<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function check_admin($login,$pass){
        $this->db->select('id_comp');
        $res=$this->db->get_where('admin',['login'=>$login,'password'=>$pass])->row();
        return $res->id_comp;
	}
	public function get_today_userdata($id_comp){
		$data['present']= $this->db->query("SELECT
     users.`id`,
     TIME_FORMAT(`begin`, '%H:%i') as `begin`,
     TIME_FORMAT(`end`, '%H:%i') as `end`,
     TIME_FORMAT(`begin_time1`, '%H:%i') as `begin_time1`,
     TIME_FORMAT(`end_time1`, '%H:%i') as `end_time1`,
     TIME_FORMAT(`lunch_begin`, '%H:%i') as `lunch_begin`,
     TIME_FORMAT(`lunch_end`, '%H:%i') as `lunch_end`,
     `description`,
     `admin_desc`,
     `image`
      from users join timeline on user_id=`users`.id WHERE   id_comp=$id_comp and day=curdate() ORDER BY `begin` ")->result_array();
        $sql="select image,name,surname from users  WHERE id_comp=$id_comp and id not in(select user_id from timeline where day=curdate())";
        $data['mess']=$this->db->query($sql)->result_array();
        return $data;
	}
    public function edit_user_today_timeline($data){
        
        $id=$data['id'];
      $begin=$data['begin'].':00';  
    	$begin_time=$data['begin_time'].':00';
      $end=$data['end'].':00';
      $end_time=$data['end_time'].':00';
      $lunch_begin=$data['lunch_begin'].':00';
      $lunch_end=$data['lunch_end'].':00';
    	$admin_desc=$data['admin_desc'];
    	$description=$data['user_desc'];

        $sql="UPDATE timeline 
              SET
               `begin_time1`='$begin_time',
               `begin`='$begin',
               `end`='$end',
               `end_time1`='$end_time',
               `lunch_begin`='$lunch_begin',
               `lunch_end`='$lunch_end',
               `admin_desc`='$admin_desc',
               `description`='$description'
              WHERE `user_id`=$id AND `day`=curdate()";	
           
       $this->db->query($sql);
       return $this->db->last_query();
      
}
public function add_user($name,$surname){
        $data = array(
           'name' => $name ,
           'surname' => $surname ,
           'id_comp'=>$_SESSION['id_comp']
        );
        $this->db->insert('users', $data); 

    }
  public function  delete_user($id){
     $this->db->where('id', $id);
     $this->db->delete('users'); 
     $this->db->where('user_id', $id);
     $this->db->delete('timeline'); 
  }
  public function update_user($id,$name,$surname,$src,$begin_time,$end_time){
      $data = array(
         'name' => $name,
         'surname' => $surname,
         'image' => $src,
         'begin_time'=>$begin_time,
         'end_time'=>$end_time,
       );
      $this->db->where('id', $id);
      $this->db->update('users', $data); 
   }
  public function update_today($id,$begin_time,$end_time,$user_desc,$admin_desc){
       $data = array(
         'begin_time1'=>$begin_time,
         'end_time1'=>$end_time,
         'description'=>$user_desc,
         'admin_desc'=>$admin_desc
       );
      $this->db->where('user_id', $id);
      $this->db->update('timeline', $data); 
      return $this->db->last_query();
  }

}