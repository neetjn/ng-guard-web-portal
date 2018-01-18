<?php namespace Library\Struct;

    class Statistics {

        public $data;

        public function __construct() {
            $this->data = array(
                'feed' => null,
                'users' => array (
                    'active' => null,
                    'administrators' => null
                )
            );

            $this->data['users']['active'] = array();
            $this->data['users']['administrators'] = array();

            $select_users = \Library\Tools\SQL::query( "SELECT * FROM `users`" );
            $users = array();
            while ( $row = \Library\Tools\SQL::fetch_row($select_users, true) ):
                $users[] = $row;
            endwhile;

            for ($i = 0; $i < sizeof($users); $i++) {

                $last_login = strtotime( $users[$i]['last_login'] );
                $last_week = time() - ( ( (60 * 60) * 24 ) * 7 );
                if ($last_login > $last_week) {

                    $this->data['users']['active'][] = $users[$i]['username'];
                }
                $admin = (int) $users[$i]['admin'] === 1 ? true : false;
                if ($admin) {

                    $this->data['users']['administrators'][] = $users[$i]['username'];
                }
            }

            $this->data['feed'] = \Library\Tools\SQL::fetch_row( "SELECT * FROM `announcements` ORDER BY `id` DESC" );
        }
    }

?>