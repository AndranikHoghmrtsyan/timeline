<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
  public function __construct(){
     parent::__construct();
     

  }
	public function check_admin($pass){
        $this->db->select('id_comp');
        $res=$this->db->get_where('admin',['password'=>$pass])->row();
        return $res->id_comp;
	}
  
	public function get_today_userdata($id_comp){
		$data['present']= $this->db->query("
    SELECT
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
    FROM users join timeline on user_id=`users`.id
    WHERE   id_comp=$id_comp and day=curdate() ORDER BY `begin` ")
    ->result_array();
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
               `description`='$description',
               `late`=(TIME_TO_SEC('$begin')-TIME_TO_SEC('$begin_time'))/60
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
  public function get_period_data($id_comp,$period='year'){
    if($period=='year')
        $where="YEAR(`day`)=YEAR(curdate())";
    elseif($period=='month')
      $where="MONTH(`day`)=MONTH(curdate())";
      // $month_day=getdate()['wday'];
      // $sunday= date( 'Y-m-d', strtotime( date('Y-m-d') . " -$month_day day" ) );
      $sql=" 
       SELECT DISTINCT
       `users`.`id`,
       `name`,
       `surname`,
       `image`,
       (select sum(`late`) from `timeline` as t2 where  t2.user_id=t1.user_id and t2.late>5 AND $where) as total_late,
       (select count(`late`) from `timeline` as t3 where t3.user_id=t1.user_id and t3.late>5 AND $where ) as count_late
       FROM `users` left join `timeline` as t1
       on `users`.`id`=t1.`user_id` where $where and `id_comp`='$id_comp' order by count_late desc,total_late desc
       ";
     return $this->db->query($sql)->result_array();
  }
  public function get_worker_month_data($id){
      // $month_day=getdate()['wday'];
      // $sunday= date( 'Y-m-d', strtotime( date('Y-m-d') . " -$month_day day" ) );

      $sql="SELECT 
           TIME_FORMAT(`begin`, '%H:%i') as `begin`,
           TIME_FORMAT(`end`, '%H:%i') as `end`,
           TIME_FORMAT(`begin_time1`, '%H:%i') as `begin_time1`,
           TIME_FORMAT(`end_time1`, '%H:%i') as `end_time1`,
           TIME_FORMAT(`lunch_begin`, '%H:%i') as `lunch_begin`,
           TIME_FORMAT(`lunch_end`, '%H:%i') as `lunch_end`,
           `description`,
           `admin_desc`,
           `late`,
           `day`,
           `user_id`
          FROM `timeline` 
          WHERE MONTH(`day`)=MONTH(curdate()) and user_id=$id 
          order by day desc";
      return $this->db->query($sql)->result_array();
  }
  public function edit_worker_month_data($data){
      $user_id=$data['id'];
      $day=$data['day'];
      $begin=strtotime($data['begin']);
      $begin_time1=strtotime($data['begin_time1']);
      $late="";
      $delta=(int)(abs($begin-$begin_time1)/60);
      if($delta>5)
        $late=(int)(($begin-$begin_time1)/60);
      
      $data1=array(
         'begin_time1'=> $data['begin_time1'],
         'begin'=> $data['begin'],
         'end_time1'=> $data['end_time1'],
         'end'=> $data['end'],
         'lunch_begin'=> $data['lunch_begin'],
         'lunch_end'=> $data['lunch_end'],
         'description'=> $data['description'],
         'admin_desc'=> $data['admin_desc'],
         'late'=>$late
        );
     
      $this->db->where(['user_id'=>$user_id,'day'=>$day]); 
      $this->db->update('timeline', $data1); 
      return $this->db->last_query();
  }
  public function change_password($pass,$new_pass){
      $data = array(
         'password' => $new_pass
      );
      $this->db->where('password', $pass);
      $res=$this->db->update('admin', $data); 
      if(!$res)
         return false;
      return true;   
  }
 public function get_worker_year_data($id){
     $sql="SELECT MONTH(`day`) AS month,sum(`late`) AS total_late,count(`late`) AS count_late FROM `timeline` 
        WHERE  `user_id`=$id AND YEAR(`day`)=YEAR(curdate()) AND late>5 GROUP BY month ORDER BY month";
     return $this->db->query($sql)->result_array();

 } 
 public function get_months_of_year($id_comp){
      $sql="SELECT distinct MONTH(`day`) AS month FROM `timeline`,users 
        WHERE  `user_id`=`users`.id AND id_comp=$id_comp ORDER BY month";
     return $this->db->query($sql)->result_array();

 }


}