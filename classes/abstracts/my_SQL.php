<?php
    abstract class my_SQL {

    private $dbLink;
    private $dbName;
    private $hostName;
    private $dbUser;
    private $dbPwd;
    private $dbPrefix;
    private $query_string;
    private $dbQueryResult;
    private $dbResultLine;
    private $error_string;
    private $array_debug;
    private $site_dir;
    
    function  __construct() {
        $this->site_dir = $_SERVER['DOCUMENT_ROOT'];
        require($this->site_dir.'/config/connect.inc');
        if(!$this->dbLink = mysql_connect($this->hostName, $this->dbUser, $this->dbPwd)){
          die('Нет подключения к БД');
        }
        mysql_query('SET NAMES utf8');
        mysql_select_db($this->dbName,$this->dbLink);
    }

    function error() {
      if (!is_dir($this_dir."/logs_files")){
            mkdir($this->site_dir."/logs_files", 0777);
      }
     $f_ = file($this->site_dir."/logs_files/sql_error.txt");
     $f  = fopen($this->site_dir."/logs_files/sql_error.txt","w");
     fputs($f,"##(".date("Y-m-d H:i:s").")::".$_SERVER['HTTP_REFERER']."::".$this->query_string."::".$this->array_debug[0]['file'].",".$this->array_debug[0]['line']."\r\n".@implode("",$f_));
     fclose($f);
    }

    function select($table,$what='*',$where='',$order='ORDER BY id ASC ',$limit='',$join_tables=array()){
      if($where){
        $where = sprintf("WHERE %s ",$where);
      }
      if($limit){
        $limit = sprintf('LIMIT %s',$limit);
      }
      if($join_tables){
        foreach($join_tables as $id=>$table_info){
          $join.=sprintf(" %s JOIN `%s` as `%s` ON %s ",$table_info['type'],$this->dbPrefix.$table_info['table'],$table_info['as'],$table_info['on']);
        }
      }
      $query = sprintf("SELECT %s FROM %s ",$what,$this->dbPrefix.$table.$join.' '.$where.' '.$order.' '.$limit);
      $result = array();
      if($this->query($query)){
        if($this->row_count()>0){
          while($row = $this->fetch()){
            $result[]=$row;
          }
        }
      }
      return $result;
    }

    function query($query) {
        $mtime  = microtime();    
        $mtime  = explode(" ",$mtime);
        $mtime  = $mtime[1] + $mtime[0]; 
        $tstart = $mtime;
        
        $this->query_string  = $query;
        $this->dbQueryResult = mysql_query($this->query_string,$this->dbLink);
        
        $mtime = microtime();    
        $mtime = explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0]; 
        $tend  = $mtime;
        
        $totaltime = ($tend - $tstart);
        if($this->dbQueryResult == true){
          return true;
        }
        else {
             $this->error_string = mysql_error();
             $this->array_debug  = debug_backtrace();
             $this->error();
             return false;
        }
    }
    
    function last_insert_id() {
        return mysql_insert_id($this->dbLink);
    }

    function fetch() {
        @$this->dbResultLine = mysql_fetch_array($this->dbQueryResult);
        return $this->dbResultLine;
    }

    function update($fields,$table,$id=''){
      foreach($fields as $field_name=>$value){
        $pattern[]=sprintf(" `%s` = '%s' ",$field_name,mysql_real_escape_string($value));
      }
      $pattern = sprintf('`%s` SET %s ',$this->dbPrefix.$table,implode(',',$pattern));
      if(is_numeric($id)){
        $query = sprintf("UPDATE %s WHERE `id` = '%d' LIMIT 1",$pattern,$id );
      }else{
        $query  = sprintf("INSERT INTO %s ",$pattern);
      }
      if($this->query($query)){
        if(!is_numeric($id)){
          $id = $this->last_insert_id();
        }
        return $id;
      }else{
        return false;
      }
    }
    
    function delete($table,$where){
      $query = sprintf("DELETE FROM `%s` WHERE %s ",$this->dbPrefix.$table,$where);
      return $this->query($query);
    }

    function row_count() {
        $queryLines = mysql_num_rows($this->dbQueryResult);
        return $queryLines;
    }

}
?>