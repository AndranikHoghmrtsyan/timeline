<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ժամանակացույց</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?=base_url('css/bootstrap.css')?>">
        <link rel="stylesheet" href="<?=base_url('css/form-elements.css')?>">
       <link rel="stylesheet" href="<?=base_url('css/style.css')?>">

    </head>

    <body style="background: linear-gradient(to right, #2A91D3 , #D5D5D5,#2A91D3)">

        <!-- Top content -->
        <div class="top-content">
          
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                          <div class="form-top admin_top">
                            <div class="form-top-left">
                              <h3>Փոխել մուտքանունը և գաղտնաբառը</h3>
                            </div>
                            <div class="form-top-right">
                              <i class="fa fa-lock"></i>
                            </div>
                          </div>
                            <div class="form-bottom admin_bottom">


                          <form role="form" action="<?php echo base_url('admin/change_password')?>" method="post" class="login-form">
                            <div class="form-group">
                                <input type="password" name="old_password"  placeholder="Գաղտնաբառ" autocomplete="off"  class="form-username form-control" id="form-username" required>
                            </div>

                            <div class="form-group">
                                
                                <input type="password" name="new_login"  placeholder="Նոր մուտքանուն" autocomplete="off"  class="form-password form-control" id="form-password" required>
                            </div>
                            <div class="form-group">
                                
                                <input type="password" name="new_password1"  placeholder="Նոր գաղտնաբառը" autocomplete="off"  class="form-password form-control" id="form-password" required>
                            </div>
                             <div class="form-group">
                                
                                <input type="password" name="new_password2"  placeholder="Կրկնել գաղտնաբառը" autocomplete="off"  class="form-password form-control" id="form-password" required>
                            </div>
                              <button type="submit" class="btn" style="background-color:#009EDF;color:white">Հաստատել</button>
                          </form>
                                                    <h4 style="color:red">
                           <?php
                             if(isset($_SESSION['msg'])){
                                 echo $_SESSION['msg'];
                                 unset($_SESSION['msg']);
   
                            }

                           ?>
</h4> 
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">

                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?=base_url('js/jquery-3.2.1.min.js')?>"></script>
        <script src="<?=base_url('js/bootstrap.js')?>"></script>
       <!--  <script src="base_url('js/jquery.backstretch.min.js')?>"></script> -->
        <!-- <script src="js/scripts.js"></script> -->
    </body>

</html>
