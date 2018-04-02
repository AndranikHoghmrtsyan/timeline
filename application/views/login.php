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
  <h2>Մուտք</h2>
  <form action="<?php echo base_url('user/check_oper')?>" method="post">
    <div class="form-group">
      <label for="login">Նշանաբառ:</label>
      <input type="password" class="form-control" id="login" placeholder="նշանաբառ..." name="oper_log">
    </div>
    <div class="form-group">
      <label for="pwd">Ծածկագիր:</label>
      <input type="password" class="form-control" id="pwd" placeholder="ծածկագիր..." name="oper_pass">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Հիշել</label>
    </div>
    <button type="submit" class="btn btn-default">Մուտք</button>
  </form>
</div>
</div>
<div class="col-sm-4" >
</div>
</body>
</html>