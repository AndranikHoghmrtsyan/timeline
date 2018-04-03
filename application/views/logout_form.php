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
  <h4>Դուրս գալ</h4>
  <form action="<?php echo base_url('user/logout')?>" method="post">
    <div class="form-group">
      <label for="login">Մուտքանուն:</label>
      <input type="password" class="form-control" id="login" placeholder="Մուտքանուն..." name="oper_log">
    </div>
    <div class="form-group">
      <label for="pwd">Գաղտնաբառ:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Գաղտնաբառ..." name="oper_pass">
    </div>
    
    <button type="submit" class="btn btn-default">Ելք</button>
  </form>
  <h4 style="color:red">
  <?php
if(isset($_SESSION['logout_error'])){
    echo $_SESSION['logout_error'];
    unset($_SESSION['logout_error']);
}

  ?>
</h4>
</div>
</div>
<div class="col-sm-4" >
</div>
</body>
</html>