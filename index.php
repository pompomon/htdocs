<?php
  //error_reporting (E_ALL);
  function por($obj){
    echo"<PRE>";
    print_r($obj);
    echo"</PRE>";
  }
  define( 'DEFAULT_CONTROLLER', 'videos' );
  define( 'DEFAULT_ACTION', 'list' );
  if( !defined( 'PATH_SEPARATOR' ) ){define( 'PATH_SEPARATOR', getenv( 'COMSPEC' ) ? ';' : ':' );}
  ini_set( 'include_path', ini_get( 'include_path' ) . PATH_SEPARATOR . dirname( __FILE__ ) );
  function __autoload( $class_name ){ 
       if ( !class_exists( $class_name ) ){
          foreach ( new RecursiveIteratorIterator(
                           new RecursiveDirectoryIterator( 'classes' ) ) as $class_file ){
             if ( $class_file->getFilename() === $class_name.'.php' ){
                require_once( $class_file );
                break;
             }
          }
       }
    }
    
    function get_action( $action_name ){
        if( $action_name == DEFAULT_ACTION ){
            return DEFAULT_ACTION . '_get';
        }
        switch( $_SERVER['REQUEST_METHOD'] ){
            case 'GET':
                return $action_name . '_get';
            case 'POST':
                return $action_name . '_post';
        }
    }

    function get_result( $controller_name = DEFAULT_CONTROLLER, $action_name = DEFAULT_ACTION ){
        if( is_array( $controller_methods = get_class_methods( $controller = $controller_name.'_controller' ) ) 
        && in_array( $action = get_action( $action_name ), $controller_methods ) ){
            if( is_array( $result = call_user_func( array( new $controller, $action ) ) ) ){
                extract( $result, EXTR_PREFIX_ALL, 'view' );
                unset( $result );
            }
           if( is_file($view = sprintf( 'views/%s/%s.php', $controller_name, $action_name ) ) ){
              require_once ( sprintf( 'views/%s/%s.php', $controller_name, $action_name ) );
              exit();
            }
        }
        $action_name !== DEFAULT_ACTION?get_result() : die( '<h2>Internal server error!!!</h2><p>Check - <b>index.app.php</b></p>' );
    }
    get_result( @$_GET['controller'], @$_GET['action'] );
?>