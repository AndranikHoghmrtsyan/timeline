

<div class="container">
    <?php
      if(empty($userdata))die;

      $all_months=[0,'Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս','Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'];
      $week_day=['Երկուշաբթի','Երեքշաբթի','Չորեքշաբթի','Հինգշաբթի','ՈՒրբաթ','Շաբաթ','Կիրակի'];  
      if(!empty($userdata['present']))
          foreach($userdata['present'] as $day=>$value)
              if(!empty($value)){
                  $monthname=$all_months[date('n')]; 
                  $dayname=$week_day[$value[0]['weekday']];
    ?>               
                  <table class='table table-bordered days' id=<?=$day?>>
                      <caption><h4 style="color:#F05746;text-align:center"><?="$monthname $day $dayname"?></h4></caption>
                      <thead>
                          <tr>
                              <th></th>
                              <th colspan=2>Սկիզբ</th>
                              <th >Ընդմիջում</th>
                              <th >Ընդ. ավարտ</th>
                              <th colspan=2>Ավարտ</th>
                              <th>Բացատրություն</th>
                              <th>Տնօրեն</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
      <?php                
                      foreach($value as $row){
                        	$id=$row['id'];
    	                    $begin_time=$row['begin_time1'];
    	                    $begin=$row['begin'];
    	                    $late=$row['late'];
    	                    $lunch_begin=$row['lunch_begin'];
                        	$lunch_end=$row['lunch_end'];
    	                    $end_time=$row['end_time1'];
    	                    $end=$row['end'];
    	                    $description=$row['description'];
                          $src=base_url($row['image']);
                          $admin_desc=$row['admin_desc'];
                          if($late>0)
                              $textcolor='red';
                          elseif($late<0)
                              $textcolor='green';
                          
      ?>
                          <tr id=<?=$id?>>
                              <td><img src=<?=$src?> width=50></td>
                              <td><input type='time' class='begin_time' value=<?=$begin_time?> ></td>
                              <td ><input type='time' class='begin' value=<?=$begin?> style='color:<?=$textcolor ?>'></td>
                              <td><input type='time' class='lunch_begin' value=<?=$lunch_begin ?> ></td>
                              <td><input type='time' class='lunch_end' value=<?=$lunch_end ?> ></td>
                              <td><input type='time' class='end_time' value=<?=$end_time ?>></td>
                              <td><input type='time' class='end' value=<?=$end ?>></td>
                              <td class='user_desc' contenteditable><?=$description ?></td>
                              <td class='admin_desc' contenteditable><?=$admin_desc ?></td>
                              <td><button class="current_update btn btn-success">Խմբագրել</button> </td>
                          </tr>
      <?php   
                      }      
                      echo  '</tbody>';
                      if(!empty($userdata['mess'][$day])){
                          foreach($userdata['mess'][$day] as $row){
                          $user=$row['name'].' '.$row['surname'];
                          $src=base_url($row['image']);
      ?>
                          <tr>
                             <td><img src=<?=$src?> width=50></td>
                             <td colspan=2><?=$user?></td>
                             <td colspan=7></td>
                          </tr>
      <?php    
                         }
                      }
              echo '</table><br>';
              }
      ?>
   
   
</div>
 
</body>
</html>

