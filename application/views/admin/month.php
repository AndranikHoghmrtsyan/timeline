<div class="container">
    <div class="row"> 
      <div class="col-sm-3" ></div>
      <div class="col-sm-6" >
   
          <label for="sel1">Select month:</label>
          <select class="form-control" id="sel1">
              <option>1</option>
              <option>2</option>
              <option >3</option>
              <option>4</option>
          </select>
     
      </div>      
      <div class="col-sm-3" ></div>     
    </div>  
 
</div>
<div  class="container-fluid">
    <div class="row"> 
         <div class="col-sm-3" >
            <table id="user_list" class="table" >
            	<tr><th></th><th>Անուն Ազգանուն</th><th>ՈՒշացում</th></tr>
              <?php 

                 foreach ($workers as $worker){
	                $id=$worker['id'];
                  $name=$worker['name'];
	                $surname=$worker['surname'];
                    $src=base_url($worker['image']);
                    $total_late='00 : 00';
                    if($worker['total_late']){
                       $hour=(int)($worker['total_late']/60);
                       $hour=($hour<10)?'0'.$hour:$hour;
                       $min=$worker['total_late']%60;
                       $min=($min<10)?'0'.$min:$min;
                       $total_late=$hour.' : '.$min;
                    }
                    $count_late=$worker['count_late'];
                    echo "<tr class='month_worker' id=$id>";
                    echo  "<td id=$id ><img src='$src' class='img-circle' height=60 ></td><td>$name $surname</td><td>$count_late ($total_late)</td></tr>";
                 }
          ?>
          </table>





         </div>
    
        
             
         
         <div class="col-sm-6" >
          <div>aaaa</div>
          <div id="worker_month_data"></div>
          </div>
          <div class="col-sm-3" >
          </div>
    </div> 
</div>