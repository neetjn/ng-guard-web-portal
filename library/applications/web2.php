<?php namespace Library\Application; 

    use \stdClass;
    
    class Web {
        
        public $cmd, $utility;
        
        public function __construct() {
            $this->cmd = new stdClass();
            $this->cmd->page = function($page) {

                /*
                 * $web = new \Library\Application\Web();
                 * $page = $web->cmd->page('login');
                 * $title = $page->title; // Login
                 * $page->load();
                 */
                
                define (PAGE, $page);
                
                $load = function() {
                    include( get_include_path() . '/source/header.php' );
                    include( get_include_path() . '/source/' . PAGE . '.php' );
                    include( get_include_path() . '/source/footer.php' );
                };

                switch($page):
                    case 'offline':
                        $title = 'Offline';
                        break;
                    case 'maintenance':
                        $title = 'Under Maintenance';
                        break;
                    case 'home':
                        $title = 'Home';
                        break;
                    case 'login':
                        $title = 'Login';
                        break;
                    case 'logout':
                        $title = 'Signing Out';
                        break;
                    case 'register':
                        $title = 'Registration';
                        break;
                    case 'profile':
                        $title = 'Profile';
                        break;
                    case 'activity':
                        $title = 'Activity';
                        break;
                    case 'settings':
                        $title = 'Settings';
                        break;
					case 'developers':
                        $title = 'Developers';
                        break;
                    case 'developer-tools':
                        $title = 'Developer Tools';
                        break;
                    default:
                        $title = 'Web Portal';
                        $load = function() {
                            include( get_include_path() . '/source/header.php' );
                            include( get_include_path() . '/source/404.php' );
                            include( get_include_path() . '/source/footer.php' );
                        };
                        break;
                endswitch;
                
                $data = new stdClass();
                
                $data->name = $page;
                $data->title = $title;
                $data->load = $load;
                
                return $data;
            };
            
            $this->utility = new stdClass();
            $this->utility->filtered = function() {
                $ip_address = $_SERVER['REMOTE_ADDR'];
                $result = \Library\Tools\SQL::fetch_row( "SELECT * FROM `ip_filter` WHERE `ip` = '$ip_address'" );
                if( $result ):
                    return true;
                else:
                    return false;
                endif;
            };
            $this->utility->online = function() {
                $config = simplexml_load_file( get_include_path() . '/config.xml' );
                return \Library\Tools\Utility::str_to_bool( $config->settings->online );
            };
            $this->utility->maintenance = function() {
                $config = simplexml_load_file( get_include_path() . '/config.xml' );
                return \Library\Tools\Utility::str_to_bool( $config->settings->maintenance );
            };
            $this->utility->debug = function() {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);  
            };
        }
        
    }
    
?>

