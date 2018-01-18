<?php namespace Library\Struct;

	use \stdClass;

    class Developer {
        
        public $key, $apps, $subs;
        
        public function __construct($key) {
            $this->key = $key;
            
            $apps = array(  ); // new array to be populated
            $subs = array(  ); // new array to be populated
            
            $applications = \Library\Tools\SQL::query("SELECT * FROM `apps` WHERE `key` = '$key'");
            while( $app = \Library\Tools\SQL::fetch_row( $applications, true ) ):
                $apps[ $app['id'] ] = (array) json_decode( $app['data'] );
            endwhile;
            
            if( sizeof( $apps ) > 0 ):
                $this->apps = $apps;
            endif;
            
            $subscriptions = \Library\Tools\SQL::query("SELECT * FROM `subscriptions` WHERE `key` = '$key'");
            while( $sub = \Library\Tools\SQL::fetch_row( $subscriptions, true ) ):
                $subs[ $sub['id'] ] = (array) json_decode( $sub['data'] );
            endwhile;
            
            if( sizeof( $subs ) > 0 ):
                $this->subs = $subs;
            endif;
        } // key as developer key
        
    }
    
?>