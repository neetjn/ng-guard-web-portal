<?php namespace Library\Struct;

    class Tag {
        
        public $data;
        
        public function __construct($tag) {
            $tag = \Library\Tools\SQL::fetch_row( "SELECT * FROM `tags` WHERE `tag` = '$tag'" );
			
			$mesh = str_split( $tag['subscription'] );
            $secure_id;
            foreach( $mesh as $key=>$value ):
                if( $key== 0 ):
                    $secure_id .= $value . '#';
                    continue;
                elseif( $key >= 10 ):
                    $secure_id .= $value;
                endif;
            endforeach;
            
            $data = array(
                'tag' => $tag['tag'],
                'secure_id' => $secure_id,
                'span' => $tag['exp_days']
            );
            
            $this->data = $data;
        }
        
    }