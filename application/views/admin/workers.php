
<div id="content" class="container-fluid">
    <div class="row">
       <!-- first column -->
       
       <div class="col-sm-4" >
        
       <div><button id="add_person" class="btn btn-primary btn-lg">Ավելացնել</button></div>
      
      <table class="table table-bordered user_list">
    <thead>
      <tr>
        <th></th>
        <th >Անուն</th>
        <th >Ազգանուն</th>
        <th >Սկիզբ</th>
        <th>Ավարտ</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
   if(empty($workers))die;
   // echo '<pre>';
  
    foreach($workers as $row){
    	$id=$row['id'];
    	$name=$row['name'];
    	$surname=$row['surname'];
    	$begin_time=$row['begin_time'];
    	$end_time=$row['end_time'];
       	$src=base_url($row['image']);
?>      
     <tr id=<?=$id?>>
     <td>
         <div class="form-group">
            <form enctype="multipart/form-data">
                <input name="file" type="file" id="file1" style="display:none"/>
                <input type="button" id="new_image" value="Upload" style="display:none"/>
                <label id="image" for="file1"><img class="img-circle foto" id="new_img" src="<?php echo $src?>" width=50></label>
            </form>
        </div>   
     </td>
     
        <td contenteditable class='name'><?=$name?></td>
       <td contenteditable class='surname'><?=$surname?></td>
       <td>
          <select class='begin_time'>
            <option><?=$begin_time?></option>
            <option>09 : 00</option>
            <option>10 : 00</option>
            <option>11 : 00</option>
            <option>12 : 00</option>
            <option >13 : 00</option>
            <option>14 : 00</option>
          </select>
        </td>
        <td>
          <select class='end_time'>
            <option><?=$end_time?></option>
            <option>14 : 00</option>
            <option>15 : 00</option>
            <option>16 : 00</option>
            <option>17 : 00</option>
            <option>18 : 00</option>
            <option>19 : 00</option>
            <option>20 : 00</option>
            <option >21 : 00</option>
            <option>22 : 00</option>
          </select>
        </td>

      
      
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
               <label for="name">Անուն:</label>
               <input type="text" class="form-control" id="name">
            </div>
           <div class="form-group">
               <label for="surname">Ազգանուն:</label>
               <input type="text" class="form-control" id="surname">
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