<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
  public function __construct(){
     parent::__construct();
     

  }
	public function check_admin($log,$pass){
        $this->db->select('id_comp');
        $res=$this->db->get_where('admin',['password'=>$pass,'login'=>$log])->row();

        if($res)
           return $res->id_comp;
        return false; 
	}
  
	public function get_current_userdata($id_comp){
      $count_month_days=date('t');

      for($i=$count_month_days;$i>=1;$i--)
      {
		      $data['present'][$i]=$this->db->query("
            SELECT
               users.`id`,
               TIME_FORMAT(`begin`, '%H:%i') as `begin`,
               TIME_FORMAT(`end`, '%H:%i') as `end`,
               TIME_FORMAT(`begin_time1`, '%H:%i') as `begin_time1`,
               TIME_FORMAT(`end_time1`, '%H:%i') as `end_time1`,
               TIME_FORMAT(`lunch_begin`, '%H:%i') as `lunch_begin`,
               TIME_FORMAT(`lunch_end`, '%H:%i') as `lunch_end`,
               `description`,
               `image`,
               day(day) as monthday,
               month(curdate()) as month,
               WEEKDAY(day) as weekday,
               late
            FROM users join timeline on user_id=`users`.id
            WHERE   id_comp=$id_comp and year(day)=year(curdate()) and month(day)=month(curdate()) and day(day)=$i")
            ->result_array();
      }
    
      for($i=$count_month_days;$i>=1;$i--){
          $sql="select image,name,surname from users  WHERE id_comp=$id_comp and id not in(select user_id from timeline where day(day)=$i and year(day)=year(curdate()) and month(day)=month(curdate()) )";
          $data['mess'][$i]=$this->db->query($sql)->result_array();
      
      }
     return $data;
	}
    public function edit_current_timeline($data){
        
        $id=$data['id'];
      $begin=$data['begin'].':00';  
    	$begin_time=$data['begin_time'].':00';
      $end=$data['end'].':00';
      $end_time=$data['end_time'].':00';
      $lunch_begin=$data['lunch_begin'].':00';
      $lunch_end=$data['lunch_end'].':00';
    	$description=$data['user_desc'];
      $day=$data['day'];
        $sql="UPDATE timeline 
              SET
               `begin_time1`='$begin_time',
               `begin`='$begin',
               `end`='$end',
               `end_time1`='$end_time',
               `lunch_begin`='$lunch_begin',
               `lunch_end`='$lunch_end',
               `description`='$description',
               `late`=IF(ABS(TIME_TO_SEC('$begin')-TIME_TO_SEC('$begin_time'))>300,(TIME_TO_SEC('$begin')-TIME_TO_SEC('$begin_time'))/60,0)
              WHERE `user_id`=$id AND MONTH(`day`)=MONTH(curdate()) and DAY(day)=$day";	
           
       $this->db->query($sql);
       //return $this->db->last_query();
      
}
public function add_user($name,$surname,$password){
        $data = array(
           'name'    => $name ,
           'surname' => $surname ,
           'password'=>$password,
           'id_comp' =>$_SESSION['id_comp']
        );
        $this->db->insert('users', $data); 

    }
  public function  delete_user($id){
     $this->db->where('id', $id);
     $this->db->delete('users'); 
     $this->db->where('user_id', $id);
     $this->db->delete('timeline'); 
  }
  public function update_user($id,$name,$surname,$src,$begin_time,$end_time,$pass){
      $data = array(
         'name' => $name,
         'surname' => $surname,
         'image' => $src,
         'begin_time'=>$begin_time,
         'end_time'=>$end_time,
         'password'=>$pass
       );
      $this->db->where('id', $id);
      $this->db->update('users', $data); 
   }
  public function update_today($id,$begin_time,$end_time,$user_desc){
       $data = array(
         'begin_time1'=>$begin_time,
         'end_time1'=>$end_time,
         'description'=>$user_desc,
       );
      $this->db->where('user_id', $id);
      $this->db->update('timeline', $data); 
      return $this->db->last_query();
  }
  public function get_year_data($id_comp,$year){
      $where="YEAR(`day`)=$year";
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
  public function get_month_data($id_comp,$month,$year){
     
      $where="YEAR(`day`)=$year and MONTH(`day`)=$month";

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
  public function get_worker_month_data($id,$month,$year){
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
           `late`,
           DAY(`day`) as day,
           `user_id`
          FROM `timeline` WHERE MONTH(`day`)='$month' and YEAR(`day`)='$year' and user_id='$id' order by DAY(day) 
         ";
        
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
 public function get_available_months($id_comp,$year){
      $sql="SELECT distinct MONTH(`day`) AS month FROM `timeline`,users 
        WHERE  `user_id`=`users`.id AND id_comp=$id_comp AND YEAR(`day`)=$year ORDER BY month";
     return $this->db->query($sql)->result_array();

 }
public function get_available_years($id_comp){

   $sql="SELECT distinct YEAR(`day`) AS year FROM `timeline`,users 
        WHERE  `user_id`=`users`.id AND id_comp=$id_comp  ORDER BY year desc";
     return $this->db->query($sql)->result_array();




} 

}