<?php namespace Actions;
    
    require_once( '../library/lib.inc.php' );
    
    $general_error = array(
        0 => 'Insufficient Parameter(s)'
    );
	
	$tools_error = array(
		0 => 'Invalid Application Parameter(s)',
		1 => 'Developer Credibility Failure',
		2 => 'Nomenclature Already In Use',
		3 => 'Developer Has Reached Application Capacity',
		4 => 'Developer Has Reached Subscription Capacity'
	);
	
	$tools_result = array(
		0 => 'Application Created Successfully',
		1 => 'Application Updated Successfully',
		2 => 'Application Identifier Renewed Successfully',
		3 => 'Application Deleted Successfully',
		4 => 'Subscription Created Successfully',
		5 => 'Subscription Updated Successfully',
		6 => 'Subscription Identifier Renewed Successfully',
		7 => 'Subscription Deleted Successfully'
	);
    
    $action = $_POST['act'];
    if(!$action):
        \Library\Tools\Communicator::throw_error( $general_error[0] ); // command parameter not specified
    endif;
	
    $user = \Library\Application\User::Load();
	$developer = new \Library\Struct\Developer( $user->data->guard['developer_key'] );
	
	$key = $_POST['key'];
			
	if( $key !== $developer->key ):
		\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer credibility failure
	endif;

    switch ($action):
		case 'app-create':
			$apps = \Library\Tools\SQL::query( "SELECT * FROM `subscriptions` WHERE `key` = '$key'" ); // query all applications
			if( mysql_num_rows( $apps ) >= 6 ):
				\Library\Tools\Communicator::throw_error( $tools_error[3] );
			endif;
			
			$title = $_POST['title'];
			
			if( strlen( $title ) <= 0 || strlen( $title ) > 16 || \Library\Tools\Utility::str_has_special_char( $title ) || strpos($title, ' ') !== false ):
				\Library\Tools\Communicator::throw_error( $tools_error[0] );
			endif;
			
			$id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 20); // generate unique 20 char alphanumeric id
			
			$data = json_encode( array( 'title' => $title ) );
			
			\Library\Tools\SQL::query( "INSERT INTO `apps` (`id`, `key`, `data`) VALUES ('$id', '$key', '$data')" ); // create application
			
			\Library\Tools\Communicator::throw_result( $tools_result[0] );
			break;
		case 'app-update':
			$identifier = $_POST['app'];
			
			if( !$developer->apps[ $identifier ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own application
			endif;
			
			$title = $_POST['title'];
			
			if( strlen( $title ) <= 0 || strlen( $title ) > 16 || \Library\Tools\Utility::str_has_special_char( $title ) || strpos($title, ' ') !== false ):
				\Library\Tools\Communicator::throw_error( $tools_error[0] );
			endif;
			
			$developer->apps[ $identifier ]['title'] = $title;
			$data = json_encode( $developer->apps[ $identifier ] );
			
			\Library\Tools\SQL::query( "UPDATE `apps` SET `data` = '$data' WHERE `id` = '$identifier'" ); // update application data
			
			\Library\Tools\Communicator::throw_result( $tools_result[1] );
			break;
		case 'app-renew':
			$app = $_POST['app'];
			
			if( !$developer->apps[ $app ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own application
			endif;
			
			$identifier = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 20); // generate unique 20 char alphanumeric id
			
			\Library\Tools\SQL::query( "UPDATE `apps` SET `id` = '$identifier' WHERE `id` = '$app'" ); // update application identifier
			
			\Library\Tools\Communicator::throw_result( $tools_result[2] );
			break;
		case 'app-delete':
			$identifier = $_POST['app'];
			
			if( !$developer->apps[ $identifier ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own application
			endif;
			
			\Library\Tools\SQL::query( "DELETE FROM `apps` WHERE `id` = '$identifier'" ); // delete application
			
			\Library\Tools\Communicator::throw_result( $tools_result[3] );
			break;
		case 'sub-create':
			$subscriptions = \Library\Tools\SQL::query( "SELECT * FROM `subscriptions` WHERE `key` = '$key'" ); // query all subscriptions
			if( mysql_num_rows( $subscriptions ) >= 3 ):
				\Library\Tools\Communicator::throw_error( $tools_error[4] );
			endif;
			
			$nomenclature = $_POST['nomenclature'];
			
			if( strlen( $nomenclature ) < 2 || strlen( $nomenclature ) > 8 || \Library\Tools\Utility::str_has_special_char( $nomenclature ) || strpos($nomenclature, ' ') !== false ):
				\Library\Tools\Communicator::throw_error( $tools_error[0] );
			endif;
			
			$subscriptions = \Library\Tools\SQL::query( "SELECT * FROM `subscriptions`" ); // query all subscriptions
            while( $row = \Library\Tools\SQL::fetch_row( $subscriptions, true ) ):
                $data = (array) json_decode( $row['data'] );
                if( $data['nomenclature'] == $nomenclature ):
                    \Library\Tools\Communicator::throw_error( $tools_error[2] ); // if nomenclature already in use
                endif;
            endwhile;
			
			$id = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 20); // generate unique 20 char alphanumeric id
			
			$data = json_encode( array( 'public' => true, 'expires' => false, 'nomenclature' => $nomenclature ) );
			
			\Library\Tools\SQL::query( "INSERT INTO `subscriptions` (`id`, `key`, `data`) VALUES ('$id', '$key', '$data')" ); // create subscription
			
			\Library\Tools\Communicator::throw_result( $tools_result[4] );
			break;
		case 'sub-update':
		    $identifier = $_POST['sub'];
		    
		    if( !$developer->subs[ $identifier ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own subscription
			endif;
		    
		    $nomenclature = $_POST['nomenclature'];
			$public = \Library\Tools\Utility::str_to_bool( $_POST['pub'] );
		    $expires = \Library\Tools\Utility::str_to_bool( $_POST['expires'] );
		    
		    if( strlen( $nomenclature ) < 2 || strlen( $nomenclature ) > 8 || \Library\Tools\Utility::str_has_special_char( $nomenclature ) || strpos($nomenclature, ' ') !== false || gettype( $public ) !== 'boolean' || gettype( $expires ) !== 'boolean' ):
				\Library\Tools\Communicator::throw_error( $tools_error[0] );
			endif;
			
			if( $nomenclature !== $developer->subs[$identifier]['nomenclature'] ): // if nomenclature changed
				$subscriptions = \Library\Tools\SQL::query( "SELECT * FROM `subscriptions`" ); // query all subscriptions
	            while( $row = \Library\Tools\SQL::fetch_row( $subscriptions, true ) ):
	                $data = (array) json_decode( $row['data'] );
	                if( $data['nomenclature'] == $nomenclature ):
                        \Library\Tools\Communicator::throw_error( $tools_error[2] ); // if nomenclature already in use
                    endif;
	            endwhile;
	
	            $tags = \Library\Tools\SQL::query( "SELECT * FROM `tags`" ); // query all tags
	            while( $row = \Library\Tools\SQL::fetch_row( $tags, true ) ):
	                $tag = $row['tag'];
	                if( \Library\Tools\Utility::starts_with( $tag, $developer->subs[$identifier]['nomenclature'] . '_' ) ):
	                    $fixed = str_replace( $developer->subs[$identifier]['nomenclature'], $nomenclature, $tag );
	                    \Library\Tools\SQL::query( "UPDATE `tags` SET `tag` = '$fixed' WHERE `tag` = '$tag'" ); // update old tag with new prefix
	                endif;
	            endwhile;
			endif;
		    
		    $data = json_encode( array( 'public' => $public, 'expires' => $expires, 'nomenclature' => $nomenclature ) );
		    
		    \Library\Tools\SQL::query( "UPDATE `subscriptions` SET `data` = '$data' WHERE `id` = '$identifier'" );
		    
		    \Library\Tools\Communicator::throw_result( $tools_result[5] );
		    break;
		case 'sub-renew':
			$sub = $_POST['sub'];
			
			if( !$developer->subs[ $sub ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own subscription
			endif;
			
			$identifier = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 20); // generate unique 20 char alphanumeric id
			
			$tags = \Library\Tools\SQL::query("SELECT * FROM `tags`"); // query all tags
            while( $row = \Library\Tools\SQL::fetch_row( $tags, true ) ):
				if( $row['subscription'] == $sub ):
					$tag = $row['tag'];
					\Library\Tools\SQL::query( "UPDATE `tags` SET `subscription` = '$identifier' WHERE `tag` = '$tag'" ); // update tag subscription
				else:
					continue;
				endif;
			endwhile;
			
			$users = \Library\Tools\SQL::query("SELECT * FROM `users`"); // query all users
            while( $row = \Library\Tools\SQL::fetch_row( $users, true ) ):
                $data = (array) json_decode( $row['sub_data'] );
                if( $data[ $sub ] ): // subscription branch exists
                    $user_handle = (int) $row['id'];
                    $n = array(  );
                    foreach( $data as $i=>$f ): // i as subscription identifier, f as data
                        if($i !== $sub):
                            $n[$i] = $f;
                        else:
                            $n[$identifier] = $f; // set new identifier w/ existing data
                        endif;
                    endforeach;
                    $n = json_encode( $n );
                    \Library\Tools\SQL::query( "UPDATE `users` SET `sub_data` = '$n' WHERE `id` = '$user_handle'" );
                endif;
            endwhile;
			
			\Library\Tools\SQL::query( "UPDATE `subscriptions` SET `id` = '$identifier' WHERE `id` = '$sub'" ); // update subscription identifier
			
		    \Library\Tools\Communicator::throw_result( $tools_result[6] );
		    break;
		case 'sub-delete':
			$identifier = $_POST['sub'];
			
			if( !$developer->subs[ $identifier ] ):
				\Library\Tools\Communicator::throw_error( $tools_error[1] ); // developer does not own subscription
			endif;
			
			$users = \Library\Tools\SQL::query("SELECT * FROM `users`"); // query all users
            while( $row = \Library\Tools\SQL::fetch_row( $users, true ) ):
                $data = (array) json_decode( $row['sub_data'] );
                if( $data[ $identifier ] ): // subscription branch exists
                    $user_handle = (int) $row['id'];
                    unset( $data[ $identifier ] ); // wipe all data pertaining to subscription from user profile
					$n = json_encode( $data );
                    \Library\Tools\SQL::query( "UPDATE `users` SET `sub_data` = '$n' WHERE `id` = '$user_handle'" );
                endif;
            endwhile;
			
			\Library\Tools\SQL::query( "DELETE FROM `tags` WHERE `subscription` = '$identifier'" ); // wipe all existing tags
			
			\Library\Tools\SQL::query( "DELETE FROM `subscriptions` WHERE `id` = '$identifier'" ); // delete subscription
			
		    \Library\Tools\Communicator::throw_result( $tools_result[7] );
		    break;
		default:
			\Library\Tools\Communicator::throw_error( $general_error[0] );
			break;
	endswitch;