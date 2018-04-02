
$(document).ready(function(){

   $('.user').click(function(){

   	 id=$(this).attr('id'); 
     var name=$(this).find('h4').text();
    var src=$(this).find('img').attr('src');
  
    $('#user_name_and_image').html("<img src='"+src+"' class='img-circle' height=100 style='float:left'><div style='text-align:center'><h4>"+name+"</h4></div>");
     
      
      $('#login_form').css('display','block');
      $('#timeline').css('display','none');
      $('#profile_form').css("display", "none");
      $('#message').text("");
      $(".fixed_time").text(" ");
      $(".real_time").text(" ");
   })

$('#login').click(function(){ 
    
    $('.time').attr("disabled", false);
    $('.time').removeClass("btn-danger");
    $('.time').addClass("btn-info"); 

    $(".fixed_time").text(" ");
    $(".real_time").text(" ");
    var password=$('#password').val();
   
      $.ajax({
	     url:base_url+'user/get_user_data',
	     type:'post',
	     dataType:'json',
         data:{id:id,password:password},
         success:function(data){
        console.log(data);
           if(data['status']=='error'){
           $('#message').text('Wrong password');
           }
          else{
          $('#login_form').css('display','none');
          $('#timeline').css('display','block');  
          
          $('.time').attr("disabled", false);
          $('.time').removeClass("btn-danger");
          $('.time').addClass("btn-info"); 

          $('#begin_time').text(data.user.begin_time);
         
          $('#end_time').text(data.user.end_time)
          $('#desc').text(data.user.description);
           
           if(data.user.begin!=null){
               
              $('#begin').attr("disabled", true);
               $('#begin').removeClass("btn-info");
               $('#begin').addClass("btn-danger");  
              $('#begin_real').text(data.user.begin);
           }
           else $('#begin_real').text(" ");

           if(data.user.lunch_begin!=null){ 
               
              $('#lunch_begin').attr("disabled", true);
              $('#lunch_begin').removeClass("btn-info");
               $('#lunch_begin').addClass("btn-danger");  
              $('#lunch_begin_real').text(data.user.lunch_begin);
           }
              else $('#lunch_begin_real').text(" ");

            if(data.user.lunch_end!=null){
              
                $('#lunch_end').attr("disabled", true);
                $('#lunch_end').removeClass("btn-info");
               $('#lunch_end').addClass("btn-danger");  
                $('#lunch_end_real').text(data.user.lunch_end);
              }
             else $('#lunch_end_real').text(" "); 
            if(data.user.end!=null){
              
                $('#end').attr("disabled", true);
                  $('#end').removeClass("btn-info");
               $('#end').addClass("btn-danger");  
                $('#end_real').text(data.user.end);
              }
            else $('#end_real').text(" ");

         $('#desc').val(data.user.description);
            
         }
         
         }   
      })
   })
   $('.time').click(function(){
      var time=$(this).attr('id');
      
    
      $.ajax({
        url:base_url+'user/set_time',
       type:'post',
       data:{id:id,time:time},
      success:function(data){
      console.log(data)
       $('#'+time+'_real').html(data);
       $('#'+time).attr("disabled", true);
       $('#'+time).removeClass("btn-info");
       $('#'+time).addClass("btn-danger");  
      }

       })


    })

  $("#desc").change(function(){
      var text=$(this).val();

      $.ajax({
        url:base_url+'user/set_description',
       type:'post',
       data:{id:id,text:text},
      success:function(data){
      
      }

      });
            
      }); 

  $('.profile').click(function(){
       $('#profile_form').css('display','block');
       $.ajax({
         url:base_url+'user/get_profile',
         type:'post',
         data:{id:id},
         dataType:'json',
         success:function(data){
          $('#profile_name').val(data[0].name);
          $('#profile_surname').val(data[0].surname);
          $('#profile_pwd').val(data[0].password);
          $('#profile_pwd1').val(data[0].password);    
         }

      });
  })
  $('#close_profile').click(function(){
       $('#profile_form').css('display','none');
      
  })
   $('#send_profile').click(function(){
        var password=  $('#profile_pwd').val();
        var password1=  $('#profile_pwd1').val(); 
        if(password==""||password1==""){
            $('#profile_error').html("<h4>All fields are required</h4>");
            return;
        }   
        if(password!==password1){
            $('#profile_error').html("<h4>Passwords not matching</h4>");
            return;
        } 
        $.ajax({
            url:base_url+'user/update_profile',
            type:'post',
            data:{id:id,password:password,password1:password1},
            success:function(data){
                 $('#profile_form').css('display','none');    
            }

      });

      


  })
    $('.exit_profile').click(function(){
       $('#timeline').css('display','none');
       $('#profile_form').css('display','none');
       $('#user_name_and_image').html("");
  })
   

})