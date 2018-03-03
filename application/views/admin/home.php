

<div class="container">
         
  <table class="table table-bordered">
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
   if(empty($userdata))die;
   // echo '<pre>';
  if(!empty($userdata['present']))
    foreach($userdata['present'] as $row){
    	$id=$row['id'];
    	$begin_time=$row['begin_time1'];
    	$begin=$row['begin'];
    	//$lunch_begin_time=$row['lunch_begin_time'];
    	$lunch_begin=$row['lunch_begin'];
    	//$lunch_end_time=$row['lunch_end_time'];
    	$lunch_end=$row['lunch_end'];
    	$end_time=$row['end_time1'];
    	$end=$row['end'];
    	$description=$row['description'];
      $src=base_url($row['image']);
      $admin_desc=$row['admin_desc'];
      echo "<tr id=$id>";
      echo "<td><img src=$src width=50></td>";

      echo  '<td>';
      echo "<select class='begin_time'>
              <option>$begin_time</option>
              <option>09 : 00</option>
              <option>10 : 00</option>
              <option>11 : 00</option>
              <option>12 : 00</option>
              <option >13 : 00</option>
              <option>14 : 00</option>
            </select>";
      echo '</td>';

      if(strnatcmp($begin,$begin_time)>0)
          echo  "<td style='color:red'>$begin</td>";
      else 
      	  echo  "<td >$begin</td>";
          echo  "<td>$lunch_begin</td>";
          echo  "<td>$lunch_end</td>";
          echo '<td>';
             echo "<select class='end_time'>
                      <option>$end_time</option>
                      <option>14 : 00</option>
                      <option>15 : 00</option>
                      <option>16 : 00</option>
                      <option>17 : 00</option>
                      <option>18 : 00</option>
                      <option>19 : 00</option>
                      <option>20 : 00</option>
                      <option >21 : 00</option>
                      <option>22 : 00</option>
                  </select>";
          echo '</td>';
          echo  "<td>$end</td>";
          echo  "<td class='user_desc' contenteditable>$description</td>";
          echo  "<td class='admin_desc' contenteditable>$admin_desc</td>";
          echo  '<td><button class="today_update btn btn-success">Խմբագրել</button> </td>';
          echo   '</tr>';
    }
    if(!empty($userdata['mess'])){
       foreach($userdata['mess'] as $row){
     
          $user=$row['name'].' '.$row['surname'];
          
          $src=base_url($row['image']);
       
          echo "<tr >";
          echo "<td><img src=$src width=50></td>";
          echo  "<td colspan=2>$user</td>";
        echo  "<td colspan=7></td>";
          
          echo   '</tr>';
    }
    }
    ?>
    </tbody>
  </table>
</div>
 
</body>
</html>

