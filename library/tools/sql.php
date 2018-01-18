<?php namespace Library\Tools;

    class SQL {

        public static function query($sql) {
            return mysql_query($sql);
        }

        public static function fetch_row($sql, $is_query = false) {
            if( !$is_query ):
                return mysql_fetch_assoc( mysql_query($sql) );
            else:
                return mysql_fetch_assoc( $sql );
            endif;
        }

        public static function valid_query($query) {
            return mysql_num_rows($query) > 0;
        }

    }

?>