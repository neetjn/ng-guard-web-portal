<?php namespace Library\Tools;

    class Utility {

        public static function starts_with($haystack, $needle) {
            return $needle === "" || strpos($haystack, $needle) === 0;
        }

        public static function ends_with($haystack, $needle){
            return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
        }

        public static function str_has_special_char( $str ) {
            return preg_match('/[^a-zA-Z0-9]+/', $str);
        }

        public static function str_to_bool($str) {
            return strtolower($str) === 'true'?true:false;
        }

    }

?>