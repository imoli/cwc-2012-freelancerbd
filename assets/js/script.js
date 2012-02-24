$(document).ready(function(){
    $('.attend-event').live('click',function(event){
        event.preventDefault();
        var eventId=$(this).attr('href').replace('#','');
        $.ajax({
            type: "POST",
            url: ajaxPath,
            dataType:'json',
            data: {
                event_id:eventId,
                action:'attendMark'
            },
            success: function(response){
                if(response.status=='login'){
                    alert('You need to login to request!');
                }else if(response.status=='success'){
                    var preCount=$('.a_count_'+eventId).text();
                    var newCount=parseInt(preCount)+parseInt(1);
                    $('.a_count_'+eventId).text(newCount);
                    alert(response.msg);
                }else if(response.status=='warning')
                    alert(response.msg);
            }
        });       
    }); 
   
   
   
   
    // comment for validation
    $('.comment_submit').live('click',function(event){
        if($('#comment').val()==''){
             event.preventDefault();
             alert('Enter your comment');
          }
    });
    
    //tag creation
    $('.tag_submit').live('click',function(event){
        event.preventDefault();
        var tag=$('#tag').val();
        var talk_id=$('#talk_id').val();
        if(tag==''){
            alert('Enter your tag');
            return false;
        }
        $.ajax({
            type: "POST",
            url: ajaxPath,
            dataType:'json',
            data: {
                tag:tag,
                talk_id:talk_id,
                action:'submit_tag'
            },
            success: function(response){
                if(response.status=='login'){
                    alert('You need to login to request!');
                }else if(response.status=='success'){
                    alert(response.msg);
                    $('#tag').val('');
                }
            }
        });       
    }); 
    
    
});