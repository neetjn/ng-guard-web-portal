<?php namespace Debug;
    
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);
    
    require_once( '../library/lib.inc.php' );
    
    $error = array(
        0 => 'Debugging Not Available',
        1 => 'Invalid Debugging Key',
        2 => 'User Does Not Exist',
        3 => 'Invalid Password Input'
    );
    
    $result = array( 0 => 'Password Upated Successfully' );
    
    if(!DBG_ENABLED):
        \Library\Tools\Communicator::throw_error( $error[0] );
    endif;
    
    $key = $_GET['key'];
    if(!$key || $key !== DBG_KEY):
        \Library\Tools\Communicator::throw_error( $error[1] );
    endif;    
    
    $username = $_GET['user'];
    $user = new \Library\Struct\User( $username );
    
    if(!$user->data):
        \Library\Tools\Communicator::throw_error( $error[2] );
    endif;
    
    $password = $_GET['password'];
    if( !$password || strlen($password) <= 5 || \Library\Tools\Utility::str_has_special_char($password) ):
        \Library\Tools\Communicator::throw_error( $error[3] );
    else:
        $password = \Library\Tools\Encoding::__password( $password, $user->data->secure['salt'] );
    endif;
    
    \Library\Tools\SQL::query("UPDATE `users` SET `password` = '$password' WHERE `username` = '$username'");
    \Library\Tools\Communicator::throw_result( $result[0] );
    
?>

    