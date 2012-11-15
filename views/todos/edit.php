<?php
    ob_start();
    $pageScripts = '
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" /> 
    <link rel="stylesheet" href="/content/jquery-ui-timepicker-addon.css" /> 
    <script type="application/javascript" src="http://code.jquery.com/jquery-latest.js" ></script>
    <script type="text/javascript" src="/scripts/jquery.validate.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/scripts/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="/scripts/tiny_mce_init.js" ></script>
    <script type="text/javascript" src="/scripts/jquery-ui-timepicker-addon.js" ></script>
    <script type="text/javascript" src="/scripts/form_init.js" ></script>
    '.(@$view_errors?'<script type="text/javascript" src="/scripts/form_check.js"></script>':'');
?>
<h2><?=$view_title_page;?></h2>
<form action="/todos/edit/<?=@$view_id;?>" method="POST" id="submitForm">
<fieldset>
   <p>
     <label for="cdatefinish">Дата окончания:</label>
     <input id="cdatefinish" name="todo[date_finish]" class="required date" value="<?=(@$view_date_finish);?>"/>
   </p>
   <p>
     <label for="ctext">Описание:</label>
     <textarea id="ctext" name="todo[desc]" cols="22"  class="required"><?=@$view_desc?></textarea>
   </p>
   <p>
     <input class="submit" type="submit" value="Сохранить"/>
   </p>
 </fieldset>
 </form>
<?php
    $pageContent = ob_get_contents();
    ob_end_clean();
    require_once ( 'views/template/main.php' );
?>
