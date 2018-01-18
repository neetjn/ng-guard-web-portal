<?php namespace Actions;
    
    require_once( '../library/lib.inc.php' );
    
    $general_error = array(
        0 => 'Insufficient Parameter(s)'
    );
    
    $ucp_error = array(
        0 => 'User Not Found',
        1 => 'Authentication Error',
        2 => 'Invalid Password Input',
        3 => 'Cannot Update Gizmo Key Yet',
        4 => 'Invalid Gizmo Key Input',
        5 => 'Forum Validation Failure',
        6 => 'Forum Handle Already In Use',
        7 => 'Forum User Requirements Not Met',
        8 => 'Email Usage Already Enabled',
        9 => 'Email Usage Already Disabled',
        10 => 'Subscription Identifier Not Matched',
        11 => 'Subscription Key Not Matched',
        12 => 'Subscription Nomenclature Not Matched',
        13 => 'User Not Subscribed',
        14 => 'User Already Subscribed',
        15 => 'Tag Does Not Exist',
        16 => 'Invalid Alias Input'
    );
    
    $ucp_result = array(
        0 => 'Password Updated Successfully',
        1 => 'Gizmo Key Updated Successfully',
        2 => 'Forum Handle Update Successfully',
        3 => 'Email Setting Updated Successfully',
        4 => 'Subscribed Successfully',
        5 => 'Authentication Phrase Renewed Successfully',
        6 => 'Alias Updated Successfully'
    );
    
    $action = $_POST['act'];
    if(!$action):
        \Library\Tools\Communicator::throw_error( $general_error[0] ); // command parameter not specified
    endif;
    
    $user = \Library\Application\User::Load();
    $username = $user->data->guard['username'];
    $handle = $user->data->guard['id'];
    
    switch($action):
        case 'update-alias':
            $alias = $_POST['alias'];
            $password = $_POST['password'];
            if( !$alias || !$password ):
                \Library\Tools\Communicator::throw_error( $general_error[0] );
            else:
                if( strlen( $alias ) <= 0 || strlen( $alias ) > 16 || \Library\Tools\Utility::str_has_special_char( $alias ) || $alias == ' '  ):
                    \Library\Tools\Communicator::throw_error( $ucp_error[17] ); // alias does not meet criteria
                endif;
                if( \Library\Application\User::Authenticate( $username, $password ) ):
                    \Library\Tools\SQL::query( "UPDATE `users` SET `alias` = '$alias' WHERE `id` = '$handle'" );
                    
                    $subject = "Account Update Confirmation";
                    $message = "We&#39;re sending you this message as confirmation that you have updated your profile - <b>Alias</b>.";
                    \Library\Application\User::Email( $user, $subject, $message );
                    
                    \Library\Application\User::Log( $handle, 4 ); // log user profile update
                    
                    \Library\Tools\Communicator::throw_result( $ucp_result[6] );
                else:
                    \Library\Tools\Communicator::throw_error( $ucp_error[1] ); // password mismatch
                endif;
            endif;
            break;
        case 'update-password':
            $current = $_POST['current'];
            $update = $_POST['update'];
            if(!$current || !$update):
                \Library\Tools\Communicator::throw_error( $general_error[0] );
            else:
                $hash = \Library\Tools\Encoding::__password( $current, $user->data->secure['salt'] );
                if($hash !== $user->data->secure['hash']):
                    \Library\Tools\Communicator::throw_error( $ucp_error[1] ); // password mismatch
                else:
                    if( strlen($update) <= 5 || \Library\Tools\Utility::str_has_special_char($update) ):
                        \Library\Tools\Communicator::throw_error( $ucp_error[2] ); // invalid password input
                    endif;
                    $password = \Library\Tools\Encoding::__password( $update, $user->data->secure['salt'] ); // hash new password
                    if($password == $user->data->secure['hash']):
                        \Library\Tools\Communicator::throw_error( $ucp_error[2] ); // same password
                    endif;
                    \Library\Tools\SQL::query("UPDATE `users` SET `password` = '$password' WHERE `id` = '$handle'"); // update password
                    
                    $subject = "Account Update Confirmation";
                    $message = "We&#39;re sending you this message as confirmation that you have updated your password.";
                    \Library\Application\User::Email( $user, $subject, $message );
                    
                    \Library\Application\User::Log( $handle, 4 ); // log user profile update
                    
                    \Library\Tools\Communicator::throw_result( $ucp_result[0] );
                endif;
            endif;
            break;
        case 'update-key-1':
            if(!$user->data->guard['key_1'] || (int) $user->data->guard['key_1_time'] < time() ):
                $key = $_POST['update'];
                if(strlen($key) !== 8 || $key == $user->data->guard['key_1']):
                    \Library\Tools\Communicator::throw_error( $ucp_error[4] ); // invalid key input
                else:
                    \Library\Tools\SQL::query("UPDATE `users` SET `key_1` = '$key', `key_1_updated` = CURRENT_TIMESTAMP WHERE `id` = '$handle'"); // update key
                    
                    $subject = "Account Update Confirmation";
                    $message = "We&#39;re sending you this message as confirmation that you have updated your profile - <b>Gizmo Key 1</b>.";
                    \Library\Application\User::Email( $user, $subject, $message );
                    
                    \Library\Application\User::Log( $handle, 4 ); // log user profile update
                    
                    \Library\Tools\Communicator::throw_result( $ucp_result[1] );
                endif;
            else:
                \Library\Tools\Communicator::throw_error( $ucp_error[3] ); // user cannot update yet
            endif;
            break;
        case 'update-key-2':
            if(!$user->data->guard['key_2'] || (int) $user->data->guard['key_2_time'] < time() ):
                $key = $_POST['update'];
                if(strlen($key) !== 8 || $key == $user->data->guard['key_2']):
                    \Library\Tools\Communicator::throw_error( $ucp_error[4] ); // invalid key input
                else:
                    \Library\Tools\SQL::query("UPDATE `users` SET `key_2` = '$key', `key_2_updated` = CURRENT_TIMESTAMP WHERE `id` = '$handle'"); // update key
                    
                    $subject = "Account Update Confirmation";
                    $message = "We&#39;re sending you this message as confirmation that you have updated your profile - <b>Gizmo Key 2</b>.";
                    \Library\Application\User::Email( $user, $subject, $message );
                    
                    \Library\Application\User::Log( $handle, 4 ); // log user profile update
                    
                    \Library\Tools\Communicator::throw_result( $ucp_result[1] );
                endif;
            else:
                \Library\Tools\Communicator::throw_error( $ucp_error[3] ); // user cannot update yet
            endif;
            break;
        case 'update-forum-handle':
            $foro_username = $_POST['username'];
            $foro_password = $_POST['password'];
            $result = json_decode( file_get_contents("https://forum.neetgroup.net/guard/api/driver.php?mod=user&cmd=identify&a=$foro_username") ); // result as handle
            if( $result->result ):
                $f_handle = $result->result;
                $result = json_decode( file_get_contents("https://forum.neetgroup.net/guard/api/driver.php?mod=user&cmd=authenticate&a=$foro_username&b=$foro_password") );
                if( $result->result ):
                    $matched = \Library\Tools\SQL::fetch_row("SELECT * FROM `users` WHERE `f_id` = '$f_handle'");
                    if(!$matched):
                        $data = json_decode( file_get_contents( "https://forum.neetgroup.net/guard/api/driver.php?mod=user&cmd=data&a=$f_handle" ) );
                        if($data->message_count < 5):
                            \Library\Tools\Communicator::throw_error( $ucp_error[7] ); // user must have 5+ posts
                        else:
                            \Library\Tools\SQL::query("UPDATE `users` SET `f_id` = '$f_handle' WHERE `id` = '$handle'"); // update forum handle
                            
                            \Library\Application\User::Log( $handle, 4 ); // log forum handle update
                            \Library\Tools\Communicator::throw_result( $ucp_result[2] );
                        endif;
                    else:
                        \Library\Tools\Communicator::throw_error( $ucp_error[6] ); // forum handle already in use
                    endif;
                else:
                    \Library\Tools\Communicator::throw_error( $ucp_error[5] ); // forum authentication failed
                endif;
            else:
                \Library\Tools\Communicator::throw_error( $result->error ); // user does not exist?
            endif;
            break;
        case 'wash-forum-handle':
            \Library\Tools\SQL::query("UPDATE `users` SET `f_id` = 0 WHERE `id` = '$handle'"); // update forum handle
            \Library\Application\User::Log( $handle, 4 ); // log forum handle update
            \Library\Tools\Communicator::throw_result( $ucp_result[2] );
            break;
        case 'validate-forum-handle':
            \Library\Tools\Communicator::throw_result( $user->data->foro !== null );
            break;
        case 'subscribe':
            $tag = $_POST['tag'];
            $tag = \Library\Tools\SQL::fetch_row("SELECT * FROM `tags` WHERE `tag` = '$tag'");
            if( !$tag ):
                \Library\Tools\Communicator::throw_error( $ucp_error[15] ); // tag does not exist
            else:
                $nomenclature;
                
                foreach( str_split( $tag['tag'] ) as $c ):
                    if( $c !== '_' ):
                        $nomenclature .= $c;
                    else:
                        break;
                    endif;
                endforeach;
                
                $subscription;
    
                $subscriptions = \Library\Tools\SQL::query( "SELECT * FROM `subscriptions`" ); // query all subscriptions
                while( $row = \Library\Tools\SQL::fetch_row( $subscriptions, true ) ):
                    $s = (array) json_decode( $row['data'] );
                    if( $s['nomenclature'] !== $nomenclature ):
                        continue;
                    else:
                        $subscription = $row;
                        break;
                    endif;
                endwhile;
                
                if( !$subscription ):
                    \Library\Tools\Communicator::throw_error( $ucp_error[12] );
                else:
                    if( !$user->data->subscriptions[ $subscription['id'] ] OR !$user->data->subscriptions[ $subscription['id'] ]->access ):
                        $data = (array)json_decode( $subscription['data'] );
                        $n;
                        if( $data['expires'] ):
                            $expires_on = time() + ( $tag['exp_days'] * ( 60*60*24 ) );
                            $n = array(
                                'access' => true,
                                'expires_on' => $expires_on
                            );
                        else: // subscription does not expire
                            $n = array(
                                'access' => true
                            );
                        endif;
                        $user->data->subscriptions[ $subscription['id'] ] = $n;
                        $e =  json_encode( $user->data->subscriptions );
                        \Library\Tools\SQL::query("UPDATE `users` SET `sub_data` = '$e' WHERE `id` = '$handle'"); // set subscription status
                        $t = $tag['tag'];
                        \Library\Tools\SQL::query("DELETE FROM `tags` WHERE `tag` = '$t'"); // delete tag
                        
                        $mesh = str_split( $subscription['id'] );
			            $secure_id;
			            foreach( $mesh as $key=>$value ):
			                if( $key== 0 ):
			                    $secure_id .= $value . '#';
			                    continue;
			                elseif( $key >= 10 ):
			                    $secure_id .= $value;
			                endif;
			            endforeach;
                        
                        $subject = "Subscription Confirmation - $secure_id";
                        $message = "We&#39;re sending you this message as confirmation that you have subscribed to subscription <i>$secure_id</i> ; <b>$t</b>.";
                        \Library\Application\User::Email( $user, $subject, $message );
                        
                        \Library\Tools\Communicator::throw_result( $ucp_result[4] );
                    else:
                        \Library\Tools\Communicator::throw_error( $ucp_error[14] ); // user already subscribed
                    endif;
                endif;
            endif;
            break;
        case 'disable-email-use':
            if( $user->data->guard['use_email'] ):
                \Library\Tools\SQL::query("UPDATE `users` SET `use_email` = 0 WHERE `id` = '$handle'");
                \Library\Tools\Communicator::throw_result( $ucp_result[3] );
            else:
                \Library\Tools\Communicator::throw_error( $ucp_error[9] );
            endif;
            break;
        case 'enable-email-use':
            if( !$user->data->guard['use_email'] ):
                \Library\Tools\SQL::query("UPDATE `users` SET `use_email` = 1 WHERE `id` = '$handle'");
                \Library\Tools\Communicator::throw_result( $ucp_result[3] );
            else:
                \Library\Tools\Communicator::throw_error( $ucp_error[8] );
            endif;
            break;
        case 'get-cred-secret':
            if(!$user->data->foro):
                \Library\Tools\Communicator::throw_error( $ucp_error[0] ); // foro handle not linked
            endif;
            $foro_username = $user->data->foro['username'];
            $foro_password = $_POST['password'];
            $result = json_decode( file_get_contents("https://forum.neetgroup.net/guard/api/driver.php?mod=user&cmd=authenticate&a=$foro_username&b=$foro_password") );
            if( $result->result ):
                \Library\Tools\Communicator::throw_result( $user->data->guard['cred_secret'] ); // return cred secret
            else:
                \Library\Tools\Communicator::throw_error( $ucp_error[5] );
            endif;
            break;
        case 'phrase':
            $phrase_collect= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $phrase= \Library\Tools\Encoding::Encode( substr( str_shuffle( $phrase_collect ), 0, 8) . $user->data->secure['salt'] ); // unique 8 character alpha-numeric key
            \Library\Tools\SQL::query("UPDATE `users` SET `auth_phrase` = '$phrase' WHERE `id` = '$handle'"); // update phrase
            
            $subject = "Account Update Confirmation";
            $message = "We&#39;re sending you this message as confirmation that you have renewed your authentication credentials.";
            \Library\Application\User::Email( $user, $subject, $message );
                    
            \Library\Tools\Communicator::throw_result( $ucp_result[5] );
            break;
        default:
            \Library\Tools\Communicator::throw_error( $general_error[0] );
            break;
    endswitch;
