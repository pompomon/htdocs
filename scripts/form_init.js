  $(document).ready(function(){
    $("#submitForm").validate();
    $( "#cdatefinish" ).datetimepicker({controlType: 'select',dateFormat:'yy-mm-dd'});
    $('.delete_me').live('click',function(){
      if(confirm("Вы уверены?")){
        var id = $(this).siblings('input').prop('id').split('_')[1];
        $(this).parent().remove();
        $.post('/videos/deletegenre/',{id:id});
      }
    });
  });