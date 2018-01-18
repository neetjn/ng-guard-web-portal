<?php namespace Actions;

    require_once( '../library/lib.inc.php' );
    
    $general_error = array(
        0 => 'Insufficient Parameter(s)'
    );
    
    if( $_SESSION['guard_user'] ):
        \Library\Tools\Communicator::throw_error( $login_error[6] ); // user already logged in
    endif;

    $username = $_POST['username'];
    $password = $_POST['password'];

    \Library\Application\User::Register( $username, $password );

?>