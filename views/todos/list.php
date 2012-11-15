<?php
    $pageTitle = 'Задачи';
    $pageScripts = '<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" /> 
    <link rel="stylesheet" href="/content/jquery-ui-timepicker-addon.css" /> 
    <script type="application/javascript" src="http://code.jquery.com/jquery-latest.js" ></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/scripts/jquery-ui-timepicker-addon.js" ></script>
    <script type="text/javascript" src="/scripts/list_init.js" ></script>';
    ob_start();
?>
<h2>Список задач</h2>
<table class='tbole'>
<tr><th>№</th><th>Описание</th><th>Дата добавления</th><th>Дата окончания</th><th>Дата завершения</th></tr>
<?php if(is_array($view_todos)){foreach($view_todos as $todo_item){
?>
<tr><td><?=$todo_item['id'];?></td><td><?=$todo_item['desc'];?></td><td><?=$todo_item['date_add'];?></td><td class="date_finish">
<div><?=$todo_item['date_finish'];?></div>
<?=(!$todo_item['date_done']?'<div class="hidden date_change"><input class="date_change_input" type="text" value="'.$todo_item['date_finish'].'" name="date_finish_'.$todo_item['id'].'"/><input type="button" value="Изменить" class="date_change_submit"><div class="close_me">X</div></div>':'');?>
</td><td><?=($todo_item['date_done']?$todo_item['date_done']:'Выполняется')?></td>
<td><div class="edit_item"><?=(!$todo_item['date_done']?'<a href="/todos/finish/'.$todo_item['id'].'">Завершить</a>':'Завершена');?></div><div class="delete_item"><a href="/todos/delete/<?=$todo_item['id']?>">Удалить</a></div></td></tr>
<?
  }
}?>
</table>
<?php
    $pageContent = ob_get_contents();
    ob_end_clean();
    require_once ( 'views/template/main.php' );
?>
