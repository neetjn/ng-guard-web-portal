<?php namespace Library\Application\Web;

    require_once( get_include_path() . '/library/tools/sql.php' );
    require_once( get_include_path() . '/library/tools/utility.php' );

    class Page {

        public static function Title($page) {

            switch($page):
                case 'offline':

                    return 'Offline';
                case 'maintenance':

                    return 'Under Maintenance';
                case 'home':

                    return 'Home';
                case 'login':

                    return 'Login';
                case 'logout':

                    return 'Signing Out';
                case 'register':

                    return 'Registration';
                case 'profile':

                    return 'Profile';
                case 'activity':

                    return 'Activity';
                case 'settings':

                    return 'Settings';
                default:

                    return 'Web Portal';
            endswitch;
        }

        public static function Load($page) {

            include( get_include_path() . '/source/header.php' );

            switch($page):
                case 'offline':

                    include( get_include_path() . '/source/offline.php' );
                    break;
                case 'maintenance':

                    include( get_include_path() . '/source/maintenance.php' );
                    break;
                case 'home':

                    include( get_include_path() . '/source/home.php' );
                    break;
                case 'login':

                    include( get_include_path() . '/source/login.php' );
                    break;
                case 'logout':

                    include( get_include_path() . '/source/logout.php' );
                    break;
                case 'register':

                    include( get_include_path() . '/source/register.php' );
                    break;
                case 'profile':

                    include( get_include_path() . '/source/profile.php' );
                    break;
                case 'activity':

                    include( get_include_path() . '/source/activity.php' );
                    break;
                case 'settings':

                    include( get_include_path() . '/source/settings.php' );
                    break;
                default:

                    include( get_include_path() . '/source/404.php' );
                    break;
            endswitch;

            include( get_include_path() . '/source/footer.php' );
        }

    }

    class Utility {

        public static function Online() {

            $config = simplexml_load_file( get_include_path() . '/config.xml' );
            return \Library\Tools\Utility::str_to_bool( $config->setting[0]->value );
        }

        public static function Maintenance() {

            $config = simplexml_load_file( get_include_path() . '/config.xml' );
            return \Library\Tools\Utility::str_to_bool( $config->setting[1]->value );
        }

        public static function Announcement() {
            
            $announcement = \Library\Tools\SQL::fetch_row( "SELECT * FROM `announcements` WHERE `id` = ( SELECT MAX(`id`) FROM `announcements` )" );
            $data = array(
                'title' => $announcement['title'],
                'content' => $announcement['content']
            );
            return $data;
        }

    }

?>