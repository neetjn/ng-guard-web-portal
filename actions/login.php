<?php namespace Actions;

    require_once( '../library/lib.inc.php' );

    $username = $_POST['username'];
    $password = $_POST['password'];

    \Library\Application\User::Login( $username, $password );

?>