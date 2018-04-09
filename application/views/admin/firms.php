
<div id="content" class="container-fluid">
    <div class="row">
       <!-- first column -->
       
       <div class="col-sm-4" >
        
       <div><button id="add_person" class="btn btn-primary btn-lg">Ավելացնել</button></div>
      
      <table class="table table-bordered firms_list">
    <thead>
      <tr>
        
        <th >Կազմակերպություն</th>
        <th >Մուտքանուն</th>
        <th >Գաղտնաբառ</th>
        <th >Մուտքանուն1</th>
        <th >Գաղտնաբառ1</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
   
   // echo '<pre>';
 if(!empty($companys_data))
    foreach($companys_data as $row){
    	$id=$row['id'];
    	$name=$row['name'];
      $login=$row['login'];
      $password=$row['password'];
      $login1=$row['oper_log'];
      $password1=$row['oper_pass'];
?>      
     <tr id=<?=$id?>>
     <td contenteditable='true' class='name1'><?=$name?></td>
     <td contenteditable='true' class='log'><?=$login?></td>
     <td contenteditable='true' class='pass'><?=$password?></td>
      <td contenteditable='true' class='log1'><?=$login1?></td>
     <td contenteditable='true' class='pass1'><?=$password1?></td>
     <td><button class="update_worker btn btn-success">Խմբագրել</button> </td>
     <td><button class="delete_worker btn btn-danger">Ջնջել</button> </td>
     </tr>
<?php        
    }
  
    ?>
    </tbody>
  </table>
        <!-- modal delete -->


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#EF5900;color:white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" >Ջնջել</h4>
      </div>
      <div class="modal-content" style="background-color:#cccccc;">
       
        <div class=modal-body></div>
      </div>
      <div class="modal-footer" style="background-color:#cccccc;">
        <button type="button" class="btn btn-default" id="modal-btn-si">Այո</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no" style="background-color:#EF5900;color:white">Ոչ</button>
      </div>
    </div>
  </div>
</div>


        <!-- end modal delete  -->
       <!-- end of first column -->
       </div>
<div class="col-sm-3" ></div>
       <!-- second column -->
      <div class="col-sm-5" >
       <div id="registr_form">
         
            <div class="form-group">
               <label for="name">Կազմակերպության անունը:</label>
               <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
               <label for="surname">Մենեջերի մուտքանունը:</label>
               <input type="text" class="form-control" id="surname">
            </div> 
            <div class="form-group">
               <label for="surname">Մենեջերի գաղտնաբառը:</label>
               <input type="text" class="form-control" id="psw" value="123">
            </div>
         
           <button  class="btn btn-success" id="send_reg_form">Գրանցել</button><button  class="btn btn-danger" id="close_reg_form">Չեղարկել</button>
           <br><br>
        <div id="error" style="color:red"></div>
      </div>
      </div>
      <!-- thired column -->
    
     
      <!--end of thired column -->
      
<!-- end of row       -->
</div>  
<!-- end of content    -->
</div>