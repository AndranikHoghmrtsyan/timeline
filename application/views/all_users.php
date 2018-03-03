
<!-- begin of content   -->
<div  class="container">
 
    <div class="row"> 
         <div class="col-sm-4" >
             <h1> <?php echo $company_name?></h1>
         </div>
         <div class="col-sm-2" >
             
         </div>
         <div class="col-sm-6" >
         
             <h1> <?php echo date('d F Y ');?></h1>
         </div>
   </div>
</div>
<div id="content" class="container">
    <div class="row">
       <!-- first column -->
       
       <div class="col-sm-4" >
        
   
       <div id="aa">
       <table id="user_list" class="table" >
    <?php   
          foreach ($users as $user){
	           $id=$user['id'];
	           $name=$user['name'];
	           $surname=$user['surname'];
             $src=base_url($user['image']);
             echo "<tr class='user' id=$id>";
            echo  "<td id=$id ><img src='$src' class='img-circle' height=60 ></td><td class='interval'></td><td><h4>$name $surname</h4></td></tr>";
             //echo "<div  class='user'width=50>$name $surname</div>";
          }
          ?>
          </table>
          </div>
       <!-- end of first column -->
       </div>
<div class="col-sm-2" ></div>
       <!-- second column -->
      <div class="col-sm-5" >
           <div id="user_name_and_image"></div>
           <br>
            <br>
     
        <!--   login form  -->
           <div id="login_form" >
               
               Նշանաբառ:<input type="text" id="password" >
               <br>
               <br>
               <input type="button" id="login" class="btn btn-success" value="ՄՈՒՏՔ">
               <h2 id="message"></h2>
           </div>
         <!-- end  login form  -->  
        <!--  timeline table -->
        <div id="timeline">
         <table  class="table" >
         <tr><td id="begin_time" class="fixed_time"></td><td></td><td></td><td id="end_time" class="fixed_time"></td></tr>
        <tr><th><button id="begin" class="time btn btn-info">Սկիզբ</button></th><th><button  id="lunch_begin" class="time btn btn-info">Ընդմիջում</button></th><th><button  id="lunch_end" class="time btn btn-info">Ընդմ.ավրտ</button></th><th><button  id="end" class="time btn btn-info">Ավարտ</button></th></tr>
         
        <tr><td id="begin_real" class="real_time"></td><td id="lunch_begin_real" class="real_time"></td><td id="lunch_end_real" class="real_time"></td><td id="end_real" class="real_time"></td></tr>
        <tr> 
          <td colspan=4>  
             <label for="desc">Բացատրություն:</label>
            <textarea  class="form-control" rows="2" id="desc">Եսիմ...</textarea>
          </td>
         </tr> 
          <tr><td colspan=3><button class="profile btn btn-success">Փոխել նշանաբառը</button></td><td><button class="exit_profile btn btn-danger">Ելք</button></td></tr>
         </table>
         
       </div>
         <!-- end timeline table -->
      
      <div id="profile_form"  style="" >
         
           <div class="form-group">
              <label for="profile_pwd">Նոր նշանաբառ:</label>
              <input type="password" class="form-control" id="profile_pwd">
           </div>
            <div class="form-group">
              <label for="profile_pwd1">Նշանաբառի կրկնություն:</label>
              <input type="password" class="form-control" id="profile_pwd1">
           </div>
            
           <button  class="btn btn-success" id="send_profile">Հաստատել</button>
           <button  class="btn btn-primary" id="close_profile">Չեղարկել</button>
           <br><br>
        <div id="profile_error" style="color:red"></div>
      </div>
      <!-- end of second column -->
      </div>
      <!-- thired column -->
      <div class="col-sm-1" >
     
      <!--end of thired column -->
      </div>
<!-- end of row       -->
   </div>
<!-- end of content    -->
</div>

</body>
</html>
<style type="text/css">
 li{
   list-style:none;
  }
 .interval{
  width:40px;
  height:80px;
 }
 td,h1{
  color:#337AB7;
 }
 #aa{
height: 500px;
  overflow-y: scroll;



 }
</style>