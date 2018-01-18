<?php namespace Library\Struct;

	use \stdClass;

    class User {
        
        public $data, $secure, $banned, $logs, $tags;
        
        /*
         * $data;
         * $data->guard( data array )
         * $data->foro( data array )
         * $data->secure( data array )
         */

        public function __construct($username) {
            $user = \Library\Tools\SQL::fetch_row( "SELECT * FROM `users` WHERE `username` = '$username'" );

            if(!$user):
                $this->data = null; // user does not exist
                return;
            endif;

            $guard_data = array(
                'id' => $user['id'],
                'username' => $username,
                'alias' => $user['alias'],
                'forum_id' => $user['f_id'],
                'auth_phrase' => str_replace( $user['salt'], null, \Library\Tools\Encoding::Decode( $user['auth_phrase'] ) ),
                'cred_secret' => str_replace( $user['salt'], null, \Library\Tools\Encoding::Decode( $user['cred_secret'] ) ),
                'last_login' => date( "D j/n/Y", strtotime( $user['last_login'] ) ),
                'key_1' => null,
                'key_1_time' => null,
                'key_2' => null,
                'key_2_time' => null,
                'disabled' => (int) $user['disabled'] === 1 ? true:false,
                'banned' => (int) $user['banned'] === 1 ? true:false,
                'admin' => (int) $user['admin'] === 1 ? true:false,
                'developer' => (int) $user['developer'] === 1 ? true:false,
                'developer_key' => null,
                'use_email' => (int) $user['use_email'] === 1 ? true:false
            );

            if( $user['key_1'] !== '0' ):
                $guard_data['key_1'] = $user['key_1'];
                $guard_data['key_1_time'] = strtotime( $user['key_1_updated'] ) + ( ( ( 60*60 ) * 24 ) * 7 );
            endif;

            if( $user['key_2'] !== '0' ):
                $guard_data['key_2'] = $user['key_2'];
                $guard_data['key_2_time'] = strtotime( $user['key_2_updated'] ) + ( ( ( 60*60 ) * 24 ) * 7 );
            endif;

            if( $guard_data['developer'] ):
                $guard_data['developer_key'] = $user['dev_key'];
            endif;
            
            $sub_data = (array) json_decode( $user['sub_data'] );
            
            $foro_data;
            if( ( (int) $guard_data['forum_id'] ) !== 0 ):
                $result = json_decode( file_get_contents( 'https://forum.neetgroup.net/guard/api/driver.php?mod=user&cmd=data&a=' . $guard_data['forum_id'] ) );
                $foro_data = array(
                    'avatar' => $result->avatar,
                    'username' => $result->username,
                    'email' => $result->email,
                    'message_count' => $result->message_count,
                    'conversations_unread' => $result->conversations_unread,
                    'alerts_unread' => $result->alerts_unread,
                    'register_date' => $result->register_date,
                    'last_activity' => $result->last_activity,
                    'staff_member' => $result->staff_member,
                    'moderator' => $result->moderator,
                    'administrator' => $result->administrator,
                    'warning_points' => $result->warning_points,
                    'trophy_points' => $result->trophy_points,
                    'credits' => $result->credits
                );
            endif;
            
            $secure_data = array(
                'hash' => $user['password'],
                'salt' => $user['salt']
            );
            
            $handle = $guard_data['id']; // handle as user id
            
            $logs = array(  );
            $select_logs = \Library\Tools\SQL::query( "SELECT * FROM `user_log` WHERE `user_id` = '$handle'" );
            if( $select_logs ):
                $event = array
                (
                    
                    0 => 'UNDEFINED',
                    1 => 'AUTHENTICATION FAILURE',
                    2 => 'DRV => AUTHENTICATION',
                    3 => 'GWP => AUTHENTICATION',
                    4 => 'GWP => PROFILE UPDATE',
                    5 => 'GWP => ACCOUNT DISABLED',
                    6 => 'ADM => ACCOUNT DISABLED',
                    7 => 'ADM => ACCOUNT BANNEDK'

                );
                while ( $row = \Library\Tools\SQL::fetch_row( $select_logs, true ) ):
                    $log = array
                    (
                        'ip' => $row['ip'],
                        'event' => $event[ (int) $row['event'] ],
                        'time' => date( 'D n/j g:i a', strtotime( $row['time'] ) )
                    );
                    $logs[] = $log;
                endwhile;
            endif;

            $tags = array(  );
            $select_tags = \Library\Tools\SQL::query( "SELECT * FROM `tags` WHERE `customer` = '$handle'" );
            if( $select_tags ):
                while ( $row = \Library\Tools\SQL::fetch_row( $select_tags, true ) ):
                    $tags[] = $row;
                endwhile;
            endif;

			$this->data = new stdClass();
            $this->data->guard = $guard_data;
            $this->data->subscriptions = $sub_data;
            $this->data->foro = $foro_data;
            $this->data->secure = $secure_data;
            $this->logs = $logs;
            $this->tags = $tags;
        }

    }

?>