<?php
   class todos_controller
    {
        private $todos;
        function __construct(){
          $this->todos = new todos_model();
        }
        
        function list_get(){
            $result = $this->todos->gettodosList();
            foreach($result as $id=>$item){
              foreach($item as $field_name=>$value){
                switch($field_name){
                  case 'date_add':
                  case 'date_finish':
                  case 'date_done':{
                      if($value){
                        $result[$id][$field_name] = date('Y-m-d H:i',strtotime($value));
                      }
                      break;
                  }
                  default:{
                    $result[$id][$field_name] = nl2br(stripslashes($value));
                    break;
                  }
                }
              }
            }
          return array('todos'=>$result);
        }
        
        function edit_get(){
          $id = $_GET['id'];
          if(is_numeric($id)&&$id){
            $result = $this->todos->gettodoItem($id);
            foreach($result as $field_name=>$value){
              $result[$field_name] = (stripslashes($value));
            }
            $result['title_page'] = 'Редактирование задания:'.$result['desc'];
          }else{
            $result['title_page'] = 'Добавление задания';
            $result['date_finish'] = date('Y-m-d H:i');
          }
          return $result;
        }
        
        function edit_post(){
          $todo = $_POST['todo'];
          if(!$todo['date_add']){
            $todo['date_add'] = date('Y-m-d H:i');
          }
          $id = $_GET['id']?$_GET['id']:'new';
          $result = $this->todos->savetodoItem($id,$todo);
          if(is_numeric($result)){
            if($_GET['ajax']){
              echo 'Y';die();
            }
            header('Location:/todos/list');
          }else{
            $todo['errors']=$result['error'];
            return $todo;
          }
        }
        
        function finish_get(){
          if(is_numeric($_GET['id'])&&$_GET['id']){
            $todo['date_done'] = date('Y-m-d H:i');
            $id = $_GET['id'];
            $this->todos->savetodoItem($id,$todo);
            header('Location:/todos/list');
          }
        }
        
        function delete_get(){
          if(is_numeric($_GET['id'])&&$_GET['id']){
            return $this->todos->deletetodoItem($_GET['id']);
          }else{
            return false;
          }
        }
    }
?>