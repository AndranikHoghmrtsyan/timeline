<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ժամանակացույց</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="col-sm-4" >
  </div>
  <div class="col-sm-4" >
  
  <h3>Մուտք</h3>
  <form action="<?php echo base_url('user/check_oper')?>" method="post">
    <div class="form-group">
      <label for="login">Մուտքանուն:</label>
      <input type="password" class="form-control" id="login" placeholder="Մուտքանուն..." name="oper_log">
    </div>
    <div class="form-group">
      <label for="pwd">Գաղտնաբառ:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Գաղտնաբառ..." name="oper_pass">
    </div>
    <button type="submit" class="btn btn-success">Մուտք</button>
  </form>
  <br/>
<h3><a href="<?=base_url('user/change_oper_password_form')?>">Փոխել Գաղտնաբառը</a></h3>
<br/>
  <h4 style="color:red">
  <?php
if(isset($_SESSION['login_error'])){
    echo $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}

  ?>
</h4>
</div>
</div>
<div class="col-sm-4" >
</div>
</body>
</html>
