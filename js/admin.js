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
        
        url: base_url+'admin/upload',
        type: 'POST',

        // Form data
        data: new FormData($('form')[0]),

        // Tell jQuery not to process data or worry about content-type
       
        cache: false,
        contentType: false,
        processData: false,
        success:function(d){
            parentTR.find('img').attr("src",base_url+d);
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
$('.current_update').click(function(){
    var parentTr=$(this).parents('tr');
    var id=parentTr.attr('id');
    var begin=parentTr.find('.begin').val();
    var begin_time=parentTr.find('.begin_time').val();
    var end=parentTr.find('.end').val();
    var end_time=parentTr.find('.end_time').val();
    var lunch_begin=parentTr.find('.lunch_begin').val();
    var lunch_end=parentTr.find('.lunch_end').val();
    var user_desc=parentTr.find('.user_desc').text();
    var admin_desc=parentTr.find('.admin_desc').text();
    var day=$(this).parents('table').attr('id');

    $.ajax({
           url:base_url+'admin/edit_current_timeline',
           type:'post',
           data:{
             id:id,
             begin_time:begin_time,
             begin:begin,
             end_time:end_time,
             end:end,
             lunch_begin:lunch_begin,
             lunch_end:lunch_end,
             user_desc:user_desc,
             admin_desc:admin_desc,
             day:day
           },
           success:function(data){
            if(data>0)
              parentTr.find('.begin').css('color','red');
            else if(data<0)
              parentTr.find('.begin').css('color','green');
            else
              parentTr.find('.begin').css('color','blue');
          }
       });
});
$('.month_worker').click(function(){
  var id=$(this).attr('id');
 $.ajax({
         url:base_url+'admin/get_worker_month_data',
         type:'post',
         data:{id:id},
         
         success:function(data){
          console.log(data)
           show_user_month_data(data);
           $('.month_update').click(function(){
             var parentTr=$(this).parents('tr');
             var id=parentTr.attr('id');
             var begin=parentTr.find('.begin').val();
             var begin_time=parentTr.find('.begin_time').val();
             var end=parentTr.find('.end').val();
             var end_time=parentTr.find('.end_time').val();
             var lunch_begin=parentTr.find('.lunch_begin').val();
             var lunch_end=parentTr.find('.lunch_end').val();
             var user_desc=parentTr.find('.description').text();
             var admin_desc=parentTr.find('.admin_desc').text();
             var day=parentTr.find('.day').text();
             var late=parentTr.find('.late');
             $.ajax({
                 url:base_url+'admin/edit_worker_month_data',
                 type:'post',
                 dataType:'JSON',
                 data:{
                    id:id,
                    begin_time1:begin_time,
                    begin:begin,
                    end_time1:end_time,
                    end:end,
                    lunch_begin:lunch_begin,
                    lunch_end:lunch_end,
                    description:user_desc,
                    admin_desc:admin_desc,
                    day:day
                },
                success:function(data){
                  if(data>0)
                    late.html(data)
                  else if(data<0)
                    late.html(-1*data);
                }
             });
           });
        }

      });
  });
function show_user_month_data(data){
     
       var html='<table class="table"><tr><th>Օր</th><th colspan=2>Սկիզբ</th><th colspan=2>Ընդմիջում</th><th colspan=2>Ավարտ</th><th>Բացատր</th><th>Տնօրեն</th><th>ՈՒշացում</th><th></th><tr>';
       for(var i=0;i<data.length;i++){
          var user_id=data[i]['user_id'];
          var begin_time=data[i]['begin_time1'];
          var begin=data[i]['begin'];
          var lunch_begin=data[i]['lunch_begin'];
          var lunch_end=data[i]['lunch_end'];
          var end_time=data[i]['end_time1'];
          var end=data[i]['end'];
          var description=data[i]['description'];
          var late='';
          var admin_desc=data[i]['admin_desc'];
          var day=data[i]['day'];
          html+="<tr id="+user_id+">";
          html+= "<td class='day'>"+day+"</td>";
          html+= "<td>"+begin_time+"</td>";
          html+= "<td>"+begin+"</td>";
          html+= "<td>"+lunch_begin+"</td>";
          html+= "<td>"+lunch_end+"</td>";
          html+= "<td>"+end_time+"</td>";
          html+= "<td>"+end+"</td>";
          html+= "<td>"+description+"</td>";
          html+= "<td>"+admin_desc+"</td>";
          if(data[i]['late']!=0){
              if(data[i]['late']>0){
                  late=data[i]['late'];
                  html+="<td class='late' style='color:red'>"+late+"</td>";
              }
              else if(data[i]['late']<0){
                  late=-1*data[i]['late'];
                 html+="<td class='late' style='color:green'>"+late+"</td>";
              }
           } 
           else{
               html+="<td></td>";
           }
           
           html+='</tr>';
      }
      html+='</table>';
      $("#worker_month_data").html(html);
}
$('.individual_workers').click(function(){
    var id=$(this).attr('id');
    $.ajax({
        url:base_url+'admin/get_worker_month_data',
        type:'post',
        dataType:'JSON',
        data:{
           id:id
        },
        success:function(data){

       show_user_month_data(data);
         
            
        }


    })
})
function show_user_year_data(data){
    console.log(data)
    var month=[0,'Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս','Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'];  
    var html='<table class="table"><tr><th>Ամիս</th><th>Ուշացումների քանակ</th><th>ՈՒշացում</th><tr>';
    for(var i=0;i<data.length;i++){
        var m=data[i]['month'];
        var monthName=month[m];
        var total_late=data[i]['total_late'];
        var count_late=data[i]['count_late'];
        html+="<tr id="+m+">";
        html+= "<td >"+monthName+"</td>";
        html+= "<td >"+count_late+"</td>";
        html+= "<td >"+total_late+"</td>";
    }
    html+='</table>';
    $("#worker_year_data").html(html);
}

$('.list-group-item').hover(function() {
$(this).css('cursor','pointer');
});

  $('.month').click(function(){
    var id=$(this).attr('id');

    $.ajax({
        url:base_url+'admin/change_month',
        type:'post',
        data:{
           id:id
        },
        success:function(data){
         location.reload();
            
        }


    })
      })

  $('.year').click(function(){
    var year=$(this).attr('id');

    $.ajax({
        url:base_url+'admin/change_year',
        type:'post',
        data:{
           year:year
        },
        success:function(data){
         location.reload();
            
        }


    })
      })
});