<div class="container">
<div class="row">
<div class="col-sm-6 col-sm-offset-3">

<form method="post" action="<?php echo base_url('admin/change_password')?>">
<input type="password" class="input-lg form-control" name="password"  placeholder="Հին ծածկագիրը" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="password1"  placeholder="Նոր ծածկագիրը" autocomplete="off" required>
<br/>
<input type="password" class="input-lg form-control" name="password2"  placeholder="Կրկնել ծածկագիրը" autocomplete="off" required>
<br/>

<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Փոխել ծածկագիրը..." value="Փոխել ծածկագիրը">

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