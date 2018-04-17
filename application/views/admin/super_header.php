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
<script src="<?php echo base_url('js/admin.js')?>"></script>	
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/admin_style.css')?>">
</head>
<body>
  <div class="container-fluid">

      <!-- Static navbar -->
      <nav class="navbar navbar-default super-header">
        <div class="container-fluid">
          <div class="navbar-header ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand copmanyname" href="#" style="color:white"><?=$company_name?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li > <a href="<?=base_url('admin/firms')?>">Կազմակերպություններ</a></li> 
              <li > <a href="<?=base_url('admin/home')?>">Ընդհանուր</a></li>
              <li ><a href="<?=base_url('admin/individual')?>">Անհատական </a></li>
              <li><a href="<?php echo base_url('admin/change_password_form')?>">Փոխել գաղտնաբառը</a></li>
              <li ><a href="<?=base_url('admin/logout')?>""><input type="button" id="login" class="btn btn-danger" value="Ելք"></a></li>
           </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<!-- <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Կազմակերպություններ</a>
    </div>
    <ul class="nav navbar-nav">
   
   date_default_timezone_set('Asia/Yerevan');
   if(!isset($_SESSION['id_comp']))
        $_SESSION['id_comp']=1;
    foreach($companys as $firm){
         $active='';
        if($firm['id']==$_SESSION['id_comp'])
            $active='class="active"';
      $url='user/company/'.$firm['id'];
      
        echo '<li id='.$firm['id']." $active".'><a href="'.base_url($url).'">'.$firm['name'].'</a></li>';
      }
      
      
      
      <li><a href="<?php //echo base_url('admin/home')?>">Հիմնական</a></li>
      <li><a href="<?php// echo base_url('admin/year')?>">Տարի</a></li>
      <li><a href="<?php //echo base_url('admin/individual')?>">Անհատական</a></li>
      <li><a href="<?php //echo base_url('admin/change_password_form')?>">Փոխել գաղտնաբառը</a></li>
      <li><a href="<?php //echo base_url('admin/logout')?>">Ելք</a></li> 
    </ul>
  </div>
</nav>   -->
<!-- <nav class="navbar navbar-default">
  <div class="container-fluid" id="nav-header">
    <div class="navbar-header">
      <a class="navbar-brand">Կազմակերպություններ</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?php //echo base_url('admin/workers')?>">Աշխատողներ</a></li>
      <li><a href="<?php //echo base_url('admin/home')?>">Հիմնական</a></li>
      <li><a href="<?php //echo base_url('admin/year')?>">Տարի</a></li>
      <li><a href="<?php //echo base_url('admin/individual')?>">Անհատական</a></li>
      <li><a href="<?php //echo base_url('admin/change_password_form')?>">Փոխել գաղտնաբառը</a></li>
      <li><a href="<?php //echo base_url('admin/logout')?>">Ելք</a></li>
    </ul>
  </div>
</nav> -->
<?php


?>
</body>
  </html>

