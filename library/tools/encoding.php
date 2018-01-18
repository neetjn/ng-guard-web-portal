<?php namespace Library\Tools;

    class Encoding {
        
        private static $key = 'MezX4563KJan7Wv';
        
        private static function md5($hash) {
            return strtoupper( md5( $hash ) );
        }

        private static function sha1($hash) {
            return strtoupper( sha1( $hash ) );
        }
        
        public static function Encode($string) {
            $key = self::sha1( self::$key );
            $strLen = strlen( $string );
            $keyLen = strlen( $key );
            for ( $i = 0; $i < $strLen; $i++ ):
                $ordStr = ord( substr( $string, $i, 1 ) );
                if ($j == $keyLen):
                    $j = 0;
                endif;
                $ordKey = ord( substr( $key, $j, 1 ) );
                $j++;
                $hash .= strrev( base_convert( dechex( $ordStr + $ordKey ), 16, 36 ) );
            endfor;
            return $hash;
        }

        public static function Decode($string) {
            $key = self::sha1( self::$key );
            $strLen = strlen( $string );
            $keyLen = strlen( $key );
            for ( $i = 0; $i < $strLen; $i+=2 ):
                $ordStr = hexdec( base_convert( strrev( substr( $string, $i, 2) ), 36, 16 ) );
                if ( $j == $keyLen ):
                    $j = 0;
                endif;
                $ordKey = ord( substr( $key, $j, 1 ) );
                $j++;
                $hash .= chr( $ordStr - $ordKey );
            endfor;
            return $hash;
        }

        public static function __secure($str, $salt) {
            $text = self::Encode( self::sha1( $str . $salt ) );
            return $text;
        }
        
        public static function __secure_match($str, $salt, $result) {
            $text = self::Encode( self::sha1( $str . $salt ) );
            return $result == $text;
        }

        public static function __password($password, $salt) {
            $password = self::md5(
                            self::sha1(
                                self::md5($password).$salt
                            )
                        );
            return $password;
        }

    }

?>