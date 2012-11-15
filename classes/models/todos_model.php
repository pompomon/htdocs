<?php
    class todos_model extends my_SQL{

        public function __construct(){
            parent::__construct();
        }
        
        public function gettodosList(){
          return $this->select('todos','*');
        }
        
        public function gettodoItem($id){
          $result = array_shift( $this->select('todos',' * ',sprintf(' `id` = %d ',$id)));
          return $result;
        }

        public function savetodoItem($id,$todo){
          foreach($todo as $field_name=>$value){
            switch($field_name){
              default:{
                if(!$value){
                  $error[]=$field_name;
                }
                break;
              }
            }
          }
          if($error){
            return array('error'=>$error);
          }
          if($id=$this->update($todo,'todos',$id)){
            return $id;
            }
            return false;
        }
        
      public function deletetodoItem($id){
        $this->delete('todos',sprintf('`id`=%d ',$id));
      }
    }
?>