$(document).ready(function(){
$('#add_person').click(function(){

     $('#registr_form').css("display", "block");
 $('#error').html("");

});

$('#send_reg_form').click(function(){
     var name=$('#name').val();
     var surname=$('#surname').val();
     if(name==""||surname==""){
         $('#error').html("All fields are required");
         return;
      }   
    
      $.ajax({
         url:base_url+'admin/add_user',
         type:'post',
         data:{name:name,surname:surname},
         success:function(data){
             $('#registr_form').css('display','none');
             location.reload();
         }

      });
  })

$('#close_reg_form').click(function(){

     $('#registr_form').css("display", "none");
 

});
$('.foto').click(function(){

  parentTR=$(this).parents('tr');
 

});
$(':file').on('change', function() {
console.log($(this))
   $('#new_image').trigger( "click" );
 
   });
  $('#new_image').on('click', function() {
   

    $.ajax({
        // Your server script to process the upload
        url: base_url+'admin/upload',
        type: 'POST',

        // Form data
        data: new FormData($('form')[0]),

        // Tell jQuery not to process data or worry about content-type
        // You *must* include these options!
        cache: false,
        contentType: false,
        processData: false,

        // Custom XMLHttpRequest
       
        success:function(d){
        parentTR.find('img').attr("src",base_url+d);
       
        //$('#new_img').attr("src",base_url+d);

        }
    });
});






//delete worker

var modalConfirm = function(callback){
  
  $(".delete_worker").on("click", function(){
    selectedUser=$(this).parents('tr');
   
    var name=selectedUser.find('.name').text();
    var surname=selectedUser.find('.surname').text();
    var data="Դուք իրոք ուզում եք ջնջել<br> "+name+" "+surname+"ի<br> բոլոր տվյալները";
    $('.modal-body').html(data)
    $("#mi-modal").modal('show');
  });

  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#mi-modal").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#mi-modal").modal('hide');
  });
};

modalConfirm(function(confirm){
    if(confirm){
       var id=selectedUser.attr('id');
       var src=selectedUser.find('img').attr('src');
      
        $.ajax({
           url:base_url+'admin/delete_user',
           type:'post',
           data:{id:id,src:src},
           success:function(data){
              selectedUser.remove();
          }
       });
    }
});
//update worker

$('.update_worker').click(function(){
    var parentTr=$(this).parents('tr');
    var id=parentTr.attr('id');
    var src=parentTr.find('img').attr('src');
    var name=parentTr.find('.name').text();
    var surname=parentTr.find('.surname').text();
    var begin_time=parentTr.find('.begin_time').val();
    var end_time=parentTr.find('.end_time').val();
    $.ajax({
           url:base_url+'admin/update_user',
           type:'post',
           data:{id:id,
            src:src,
            name:name,
            surname:surname,
            begin_time:begin_time,
            end_time:end_time
          },
           success:function(data){
            
          }
       });
});
$('.today_update').click(function(){
    var parentTr=$(this).parents('tr');
    var id=parentTr.attr('id');
    var begin_time=parentTr.find('.begin_time').val();
    var end_time=parentTr.find('.end_time').val();
    var user_desc=parentTr.find('.user_desc').text();
    var admin_desc=parentTr.find('.admin_desc').text();
    $.ajax({
           url:base_url+'admin/update_today',
           type:'post',
           data:{
             id:id,
             begin_time:begin_time,
             end_time:end_time,
             user_desc:user_desc,
             admin_desc:admin_desc
           },
           success:function(data){
            
          }
       });
});

});