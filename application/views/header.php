<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	
<title>Timeline</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css')?>">
<script src="<?php echo base_url('js/jquery-3.2.1.min.js')?>"></script>
<script src="<?php echo base_url('js/bootstrap.js')?>"></script>	

<script>var base_url="<?php echo base_url();?>"</script>
<script src="<?php echo base_url('js/user.js')?>"></script>	
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/user_style.css')?>">
</head>
<body>
<nav class="navbar navbar-default" id="nav1">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Կազմակերպություն</a>
    </div>
    <ul class="nav navbar-nav">
    <?php
   date_default_timezone_set('Asia/Yerevan');
   if(!isset($_SESSION['id_comp']))
        $_SESSION['id_comp']=1;
    foreach($companys_data as $firm){
         $active='';
        if($firm['id']==$_SESSION['id_comp'])
            $active='class="active"';
      $url='user/company/'.$firm['id'];
    	
       	echo '<li id='.$firm['id']." $active".'><a href="'.base_url($url).'">'.$firm['name'].'</a></li>';
      }
      
      
      ?>
    </ul>
  </div>
</nav>


