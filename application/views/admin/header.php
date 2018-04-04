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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" ><?php echo $company_name ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?php echo base_url('admin/workers')?>">Աշխատողներ</a></li>
      <li><a href="<?php echo base_url('admin/home')?>">Հիմնական</a></li>
      <li><a href="<?php echo base_url('admin/year')?>">Տարի</a></li>
      <li><a href="<?php echo base_url('admin/individual')?>">Անհատական</a></li>
      <li><a href="<?php echo base_url('admin/change_password_form')?>">Փոխել գաղտնաբառը</a></li>
      <li><a href="<?php echo base_url('admin/logout')?>">Ելք</a></li>
    </ul>
  </div>
</nav>


