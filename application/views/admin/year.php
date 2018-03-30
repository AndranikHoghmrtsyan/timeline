

<div  class="container">
    <div class="row"> 
        <div class="col-sm-4">
        	<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                   <?php 
                      // echo $all_month[$month];
                   echo $_SESSION['year'];
                 
                   ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php 
                     foreach($available_years as $row){
                       $year=$row['year'];
                      
                       if($year==$_SESSION['year'])
                            echo "<li  id=$year class='list-group-item list-group-item-action active year' href='#' >$year</li>";
                       else
                            echo "<li id=$year class='list-group-item list-group-item-action year' href='#'>$year</li>";

                    }
                    ?>
    
                </ul>
            </div>
            <table id="user_list" class="table" >
            	<tr><th></th><th>Անուն</th><th>Ազգանուն</th><th>ՈՒշացում</th><th>Ընդամենը</th></tr>

              <?php 

                foreach ($users as $worker){
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
                    echo "<tr class='workers_year' id=$id>";
                    echo  "<td id=$id ><img src='$src' class='img-circle' height=60 ></td>";
                    echo "<td>$name</td><td>$surname</td><td>$count_late</td><td>$total_late</td>";
                    echo "</tr>";
                 }
           ?>
           </table>	
        </div>
    
        
             
         
        <div class="col-sm-4" >
        	<?php
$all_month=[0,'Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս','Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'];  

 echo $month=$_SESSION['month']; 
?>
<div class="container">
    <div class="row"> 
      <div class="col-sm-3" ></div>
      <div class="col-sm-6" >
   
       <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
  <?php 
//echo $all_month[$month];
  ?>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
       <?php 

        //    foreach($months_names as $row){
        //     $m=$row['month'];
        //     $monthname=$all_month[$m];
        //     if($m==$month)
        //         echo "<li  id=$m class=' list-group-item list-group-item-action active month' href='#' >$monthname</li>";
        //     else
        //        echo "<li id=$m class=' list-group-item list-group-item-action month' href='#'>$monthname</li>";

        // }

   ?>
    
  </ul>
</div>
     
      </div>      
      <div class="col-sm-3" ></div>     
    </div>  
 
</div>
            <div id="worker_year_data"></div>
        </div>
        <div class="col-sm-4" >
        </div>
    </div> 
</div>