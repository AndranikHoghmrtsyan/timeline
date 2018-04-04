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
  <form action="<?php echo base_url('admin/check_admin')?>" method="post">
    <div class="form-group">
      <label for="login">Մուտքանուն:</label>
      <input type="password" class="form-control" id="login" placeholder="նշանաբառ..." name="login">
    </div>
    <div class="form-group">
      <label for="pwd">Գաղտնաբառ:</label>
      <input type="password" class="form-control" id="pwd" placeholder="ծածկագիր..." name="password">
    </div>
    <button type="submit" class="btn btn-default">Մուտք</button>
  </form>
  <?php
if(isset($_SESSION['error'])){
     echo "<h3>".$_SESSION['error']."</h3>";
     unset($_SESSION['error']);

}



  ?>
</div>
</div>
<div class="col-sm-4" >
</div>
</body>
</html>
