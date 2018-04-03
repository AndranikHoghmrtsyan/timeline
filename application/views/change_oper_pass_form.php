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

<div class="container">
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
<h4> Փոխել մուտքանունը և գաղտնաբառը </h4>
	<form method="post" action="<?php echo base_url('user/change_oper_password')?>">
<input type="password" class="input-lg form-control" name="old_login"  placeholder="Հին մուտքանուն" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="old_password"  placeholder="Հին գաղտնաբառ" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="new_login"  placeholder="Նոր մուտքանուն" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="new_password1"  placeholder="Նոր գաղտնաբառ" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="new_password2"  placeholder="Գաղտնաբառի կրկնություն" autocomplete="off" required>
<br/>

<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"  value="Փոխել">

</form>
<?php
if(isset($_SESSION['change_error'])){
   echo '<br><h4 style="color:red">'.$_SESSION['change_error'].'</h4>';
   unset($_SESSION['change_error']);
}
?>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>
</body>
</html>