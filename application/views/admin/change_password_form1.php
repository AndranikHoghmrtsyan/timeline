<div class="container">
<div class="row">
<div class="col-sm-6 col-sm-offset-3">

<form method="post" action="<?php echo base_url('admin/change_password')?>">
	
<input type="password" class="input-lg form-control"  name="old_password"  placeholder="Գաղտնաբառ" autocomplete="off" required>
<br/>
<input type="text" class="input-lg form-control" name="new_login"  placeholder="Նոր մուտքանուն" autocomplete="off" required>
<br/>	
<input type="password" class="input-lg form-control" name="new_password1"  placeholder="Նոր գաղտնաբառը" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="new_password2"  placeholder="Կրկնել գաղտնաբառը" autocomplete="off" required>
<br/>

<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"  value="Փոխել տվյալները">

</form>
<?php
if(isset($_SESSION['msg'])){
   echo '<div style="color:red">'.$_SESSION['msg'].'</div>';
   unset($_SESSION['msg']);
}
?>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>