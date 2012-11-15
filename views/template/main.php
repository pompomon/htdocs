<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="/content/reset.css" type="text/css" />
<link rel="stylesheet" href="/content/default.css" type="text/css" />
<?=@$pageScripts;?>
</head>
<body>
<div class="sk"><div class="sk1">
<div class="head">
  <div class="head-name">Тестовое задание</div>
  <div class="head-mail"><b>Выполнил:</b> <span><a href="mailto:pompomon@gmail.com">Судариков Рома</a></span></div>
 </div>
 <div class="isk">
  <div class="isk-left">
   <ul class="lmenu">
   <li class="lmenu__item "><a href="/todos/edit">Добавить задание</a></li>
   <li class="lmenu__item "><a href="/todos/list">Список заданий</a></li>
   </ul>  
  </div><!-- /.isk-left -->
  <div class="isk-right">
  <?= @$pageContent; ?>
    </div><!-- /.isk-right -->
  <div class="clear"></div>
 </div><!-- /.isk -->
</div></div><!-- /.sk -->
</body>
</html>