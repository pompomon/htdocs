$(document).ready(function(){
  $('.delete_item a').click(function(){
    if(confirm("Вы уверены?")){
      var link = $(this).prop('href');
      var item = this;
      $.get(link,function(){
        $(item).parent().parent().parent().remove();
      });
      return false;
    }
  });
  $('.edit_item a').parent().parent().siblings('.date_finish').mouseover(function(event){
    $(this).find('.date_change').fadeIn();
    event.stopImmediatePropagation();
  });
  $('.close_me').click(function(event){
    $(this).parent().fadeOut();
    event.stopImmediatePropagation();
  });
  $('.date_change_submit').click(function(){
    var date_post = $(this).siblings('input').val();
    var date = new Date(date_post);
    var date_add_post = ($(this).parent().parent().siblings().eq(2).html());
    var date_add = new Date(date_add_post);
    var date_finish_block = $(this).parent().parent();
    var todo  = {};
    todo['date_add'] = date_add_post;
    todo['date_finish'] = date_post;
    if(date-date_add>0){
      $.post('/todos/edit/'+$(this).siblings('input').prop('name').split('_')[2]+'?ajax=1',{todo:todo},function(data){
        if(data=='Y'){
          date_finish_block.find('div').eq(0).html(date_post);
          date_finish_block.find('.hidden').fadeOut();
        }else{
          alert('Произошла ошибка');
        }
      });
    }else{
      alert('Нельзя завершить задание до его начала');
    }
  });
  $( ".date_change_input").datetimepicker({controlType: 'select',dateFormat:'yy-mm-dd'});
});