<?php namespace Debug;
    
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);
    
    require_once( '../library/lib.inc.php' );
    
    $error = array(
        0 => 'Debugging Not Available',
        1 => 'Invalid Debugging Key',
        2 => 'User Does Not Exist'
    );
    
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
    
    $_SESSION['GUARD_SESHU'] = $username;
    header('Location: http://guard.neetgroup.net');
    
?>

    