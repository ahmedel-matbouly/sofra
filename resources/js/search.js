$(document).on('keyup','#search-all-canned-replies',function(){

      var search_content=$(this).val();
      if(search_content!=''){
          $.ajax({
              
             url:'/search-all-canned-replies',
             method:'GET',
             data:{search_content},
             dataType:'json',
             success:function(data){
                $('.content-inner .table-responsive').html(data.row_result); 
             }

          })
      }
      else{
        $('.content-inner .table-responsive').html(old_content);
      }
});