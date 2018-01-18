<?php namespace Actions;

    require_once( '../library/lib.inc.php' );
    
    $general_error = array(
        0 => 'Insufficient Parameter(s)'
    );

    $developer_error = array(
        0 => 'User Not Found',
        1 => 'User Already Has Developer Access',
        2 => 'Authentication Failure'
    );

    $developer_result = array(
        0 => 'Developer Registered Successfully'
    );
    
    $action = $_POST['act'];
    if(!$action):
        \Library\Tools\Communicator::throw_error( $general_error[0] ); // command parameter not specified
    endif;
    
    $user = \Library\Application\User::Load();
    
    switch ($action):
        case 'register':
            if($user->data->guard['developer']):
                \Library\Tools\Communicator::throw_error( $developer_error[1] ); // user is already developer
            else:
                $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                $developer_key = substr(str_shuffle($alpha_numeric), 0, 15); // unique 15 char alphanumeric key
                $handle = $user->data->guard['id'];
                \Library\Tools\SQL::query( "UPDATE `users` SET `developer` = '1', `dev_key` = '$developer_key' WHERE `id` = '$handle'" );
                \Library\Tools\Communicator::throw_result( $developer_result[0] );
            endif;
            break;
        case 'query':
            $username = $user->data->guard['username'];
            $password = $_POST['password'];
            if ( \Library\Application\User::Authenticate( $username, $password, false ) ): // left here, fix authentication func to return error properly, find out where breaking, beginning def. works
                \Library\Tools\Communicator::throw_result( $user->data->guard['developer_key'] );
            else:
                \Library\Tools\Communicator::throw_error( $developer_error[2] ); // no return message on auth fail
            endif;
            break;
        default:
            \Library\Tools\Communicator::throw_error( $general_error[0] );
            break;
    endswitch;

?>