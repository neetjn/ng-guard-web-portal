<?php namespace Library\Application;

    use \stdClass;
    
    class User {
        
        public static $general_error = array(
            0 => 'Insufficient Parameter(s)'
        );
        
        public static $logging_error = array(
            0 => 'Event Does Not Exist'
        );
        
        public static $registration_error = array(
            0 => 'Invalid Username Input',
            1 => 'Invalid Password Input',
            2 => 'Username Already In Use',
            3 => 'Registration Request Not Valid'
        );
    
        public static $registration_result = array(
            0 => 'Registration Successful'
        );
        
        public static $authentication_error = array(
            0 => 'User Does Not Exist',
            1 => 'Authentication Failure',
            2 => 'This User Is Banned From Guard Services',
            4 => 'User Authentication Timed Out',
            5 => 'User Is Currently Timed Out',
            6 => 'This Account Has Been Disabled',
            7 => 'Authentication Request Not Valid',
            8 => 'Password Mismatch'
        );
        
        public static $login_error = array(
            0 => 'User Already Logged In'
        );
        
        public static $login_result = array(
            0 => 'Login Successful'
        );
        
        public static $loading_error = array(
            0 => 'User Not Found'
        );
        
        public static function Email($user, $subject, $input)
        {
            
            if( $user->data->guard['use_email'] && $user->data->foro ):
                
                $alias = $user->data->guard['alias'];
                $to = $user->data->foro['email'];
                $message = "
                <center>
                    <div class='body' style='display:block; background-color:#fff; width:600px; overflow:auto; margin:0; padding:0;'>
                        <img src='http://s28.postimg.org/av4fsnya5/wrapper.png' style='display:block; margin:0; padding:0;' />
                        <div class='wrapper' style='cursor:default; display:block; margin:0; padding:0;'>
                            <p class='message' style='display:block; margin:0; padding:15px; text-align:left; border-bottom:2px solid #3b3d3e; border-left:3px solid #3b3d3e; border-right:3px solid #3b3d3e;'>
                            Hello `<b><u>$alias</u></b>`,<br />
                            $input
                            </p>
                        </div>
                    </div>
                </center>
                ";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: do-not-reply@neetgroup.net' . "\r\n";
                $headers .= "Cc: $to" . "\r\n";
                mail( $to, $subject, $message, $headers );
                return true;
                
            else:
                return false;
            endif;
            
        } // user param as user struct
        
        public static function Log($handle, $event, $silent = true)
        {
            
            /*
            
                $event =
                {
                    
                    0: 'UNDEFINED'
                    1: 'AUTHENTICATION FAILURE',
                    2: 'DRV => AUTHENTICATION',
                    3: 'GWP => AUTHENTICATION',
                    4: 'GWP => PROFILE UPDATE',
                    5: 'GWP => ACCOUNT DISABLED',
                    6: 'ADM => ACCOUNT DISABLED',
                    7: 'ADM => ACCOUNT BANNEDK',\

                }
            
             */
             
            if( !is_numeric( $event ) || $event > 7 || $event < 0 ):
                if( !$silent ):
                    \Library\Tools\Communicator::throw_error( self::$logging_error[0] ); // log event does not exist
                endif;
            endif;
               
            $ip_address = $_SERVER['HTTP_CF_CONNECTING_IP'] === $_SERVER['SERVER_ADDR'] ? 'localhost' : $_SERVER['HTTP_CF_CONNECTING_IP']; // using cloudflare to find visitor ip
            if( is_numeric( $handle ) && $handle !== 0 ):
                \Library\Tools\SQL::query( "INSERT INTO `user_log` (`user_id`, `ip`, `event`, `time`) VALUES ('$handle', '$ip_address', '$event', CURRENT_TIMESTAMP)" ); // log user
            endif;
            
        } // handle as user id
        
        public static function Register($username, $password)
        {
            
            if( !$username || !$password ):
                \Library\Tools\Communicator::throw_error( self::$general_error[0] ); // parameters not set
            endif;
			
			if( strpos($username, ' ') ):
				$username = str_replace( ' ', '', $username );
			endif;
			
			if( strlen($username) < 3 || \Library\Tools\Utility::str_has_special_char($username) ):
				\Library\Tools\Communicator::throw_error( self::$registration_error[0] ); // invalid username input
			endif;
			
			if( strlen($password) <= 5 || \Library\Tools\Utility::str_has_special_char($password) ):
                \Library\Tools\Communicator::throw_error( self::$registration_error[1] ); // invalid password input
            endif;
    
            $user_exists = \Library\Tools\SQL::fetch_row( "SELECT * FROM `users` WHERE `username` = '$username'" );
            if( $user_exists ):
                \Library\Tools\Communicator::throw_error( self::$registration_error[2] ); // user with username already exists
            endif;
    
            $salt = substr( str_shuffle( 'ABCD@@EF*GHIJKLMNOPQRSTU##V@W!XYZa&bc(def)gh^ij!klmn!op&qrstu%vwxyz01&2%34%56789' ), 0, 8 );
    
            $password = \Library\Tools\Encoding::__password( $password, $salt );
            $phrase = \Library\Tools\Encoding::Encode( substr( str_shuffle( 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789' ), 0, 8) . $salt ); // unique 8 character alpha-numeric key
            $cred_secret = \Library\Tools\Encoding::Encode( substr( str_shuffle( 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789' ), 0, 12 ) . $salt ); // unique 12 character alpha-numeric key
    
            $default_bit_data = '{"eRAxg6u39DEgwJa":{"foo":"bar"}}';
    		
            \Library\Tools\SQL::query
            (
            	"INSERT INTO `users` (`id`, `f_id`, `username`, `alias`, `password`, `auth_phrase`, `cred_secret`, `salt`, `bit_data`, `key_1`, `key_2`, `admin`, `developer`, `dev_key`, `disabled`, `banned`, `key_1_updated`, `key_2_updated`, `last_login`, `use_email`) VALUES (NULL, '0', '$username', 'Guest', '$password', '$phrase', '$cred_secret', '$salt', '$default_bit_data', '0', '0', '0', '0', NULL, '0', '0', NULL, NULL, NULL, '0')"
    		); // create user
    		
            \Library\Tools\Communicator::throw_result( self::$registration_result[0] );
            
        }
        
        public static function Authenticate($username, $password, $silent = false) {
            
            function locked($handle) {
                $count = 0;
                $failed_logins = \Library\Tools\SQL::query("SELECT * FROM `failed_logins` WHERE `user_id`='$handle'");
                while ($row = \Library\Tools\SQL::fetch_row($failed_logins, true)):
                    $time = $row['time'];
                    if (strtotime($time) + (60 * 5) > time()): // 60 seconds * 5 = 5 minutes, if failed within the past 5 mins
                        $count++; // increment failed logins
                        if ($count >= 10): // if failed 10+ times, return false
                            \Library\Tools\SQL::query("INSERT INTO `timeout` ( `user_id`, `time` ) VALUES ( '$user_id', CURRENT_TIMESTAMP )");
                            return false;
                        endif;
                    endif;
                endwhile;
                return true;
            } // handle as user id
    
            function timed_out($handle) {
                $timeout_data = \Library\Tools\SQL::fetch_row("SELECT * FROM `timeout` WHERE `time` = ( SELECT MAX(time) from `timeout` WHERE `user_id` = '$handle' )");
                if (!$timeout_data):
                    return false; // assume never timed out
                endif;
                $timeout = $timeout_data['time'];
                return strtotime($timeout) + (60 * (5)) > time(); // 60 seconds * 5 = 5 minutes, if timed out within past 5 mins
            } // handle as user id
            
            function auth_finish($silent, $result, $message = false) {
                if( !$silent ):
                    if( $result ):
                        \Library\Tools\Communicator::throw_result( $message );
                    else:
                        \Library\Tools\Communicator::throw_error( $message );
                    endif;
                else:
                    return result;
                endif;
            } // use to end authentication
            
            if( !$username || !$password ):
                return auth_finish( $silent, false, self::$general_error[0] ); // parameters not set
            endif;
    
            if( strlen($password) <= 5 || \Library\Tools\Utility::str_has_special_char($password) ):
                return auth_finish( $silent, false, self::$general_error[0] ); // invalid password input
            endif;
    
            $user = \Library\Tools\SQL::fetch_row( "SELECT * FROM `users` WHERE `username` = '$username'" );
            if( !$user ):
                return auth_finish( $silent, false, self::$authentication_error[0] );
            endif;
        
            $disabled = (int) $user['disabled'] === 1 ? true : false;
            if ($disabled):
                 return auth_finish( $silent, false, self::$authentication_error[6] ); // account is disabled
            endif;
            
            $banned = (int) $user['banned'] === 1 ? true : false;
            if ($banned):
                return auth_finish( $silent, false, self::$authentication_error[2] ); // user is banned
            endif;
    
            $uID = (int) $user['id'];
            
            if(!timed_out($uID)):
                if (!locked($uID)):
                     return auth_finish( $silent, false, self::$authentication_error[4] ); // user has been timed out
                endif;
            else:
                return auth_finish( $silent, false, self::$authentication_error[5] ); // user is currently timed out
            endif;
    
            $salt = $user['salt'];
            $password = \Library\Tools\Encoding::__password($password, $salt);
            
            $ip_address = $_SESSION['LOCAL_ADDR'];
            if( !$ip_address ):
                return auth_finish( $silent, false, self::$general_error[0] );
            endif;
            
            if( $password !== $user['password'] ):
                self::Log( $uID, 1, true ); // only disable silence when debugging
                \Library\Tools\SQL::query( "INSERT INTO `failed_logins` (`user_id`, `ip`, `time`) VALUES ('$uID', '$ip_address', CURRENT_TIMESTAMP)" ); // log failed login
                return false;
            else:
                self::Log( $uID, 3, true ); // only disable silence when debugging
                return true;
            endif;
            
        }
        
        public static function Login($username, $password)
        {
            
            if( $_SESSION['GUARD_SESHU'] ):
                \Library\Tools\Communicator::throw_error( $login_error[0] ); // user already logged in
            endif;
               
            if( self::Authenticate( $username, $password, false ) ):
				\Library\Tools\SQL::query( "UPDATE `users` SET `last_login` = CURRENT_TIMESTAMP WHERE `username` = '$username'" ); // set last login
                $_SESSION['GUARD_SESHU'] = $username;
                \Library\Tools\Communicator::throw_result( self::$login_result[0] );
            else:
                \Library\Tools\Communicator::throw_error( self::$authentication_error[8] );
            endif;
            
        }
        
        public static function Logout()
        {
            
            session_destroy();
            
        }
        
        public static function Load($silent = false)
        {
            
            $username = $_SESSION['GUARD_SESHU'];
            if( !$username ):
                if( !$silent ):
                    \Library\Tools\Communicator::throw_error( self::$loading_error[0] ); // no user logged in
                endif;
            endif;
            return new \Library\Struct\User( $username );
            
        } // expected only to be used in action scripts, silent default at false
        
    }

?>