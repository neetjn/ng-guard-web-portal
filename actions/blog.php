<?php namespace Actions;

    require_once( '../library/lib.inc.php' );
    
    $general_error = array(
        0 => 'Insufficient Parameter(s)'
    );
    
    $blog_error = array(
        0 => 'User Not Found',
        1 => 'User Does Not Have Such Privileges'
    );
    
    $blog_result = array(
        0 => 'Posted Successfully',
        1 => 'Commented Successfully'
    );
    
    function html_proof($str) {
        return strip_tags( $str );
    }
    
    $action = $_POST['act'];
    if(!$action):
        \Library\Tools\Communicator::throw_error( $general_error[0] ); // command parameter not specified
    endif;
    
    $user = \Library\Application\User::Load();
    $blog = new \Library\Application\Blog();
    
    switch($action):
        case 'post':
            if( $user->data->guard['admin'] ):
                $title = html_proof( $_POST['title'] );
                $post = html_proof( $_POST['post'] );
                if( strlen( $title ) >= 3 && strlen( $post ) >= 10 ) {
                    $blog->post->create->__invoke( $user->data->guard['id'], $title, $post );
                    \Library\Tools\Communicator::throw_result( $blog_result[0] );
                } else {
                    \Library\Tools\Communicator::throw_error( $general_error[0] );
                }
            else:
                \Library\Tools\Communicator::throw_result( $blog_error[1] );
            endif;
            break;
        case 'comment':
            $post_id = $_POST['id'];
            $comment = html_proof( $_POST['comment'] );
            if( strlen( $comment ) >= 10 && strlen( $comment ) <= 140 ) {
                $blog->post->comment->__invoke( $post_id, $user->data->guard['id'], $comment );
                \Library\Tools\Communicator::throw_result( $blog_result[1] );
            } else {
                \Library\Tools\Communicator::throw_error( $general_error[0] );
            }
            break;
        default:
            \Library\Tools\Communicator::throw_error( $general_error[0] );
            break;
    endswitch;
    
?>
    
