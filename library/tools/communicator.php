<?php namespace Library\Tools;

    class Communicator {

        public static function throw_error($message) {

            $error = array();
            $error['error'] = $message;
            exit(json_encode($error));
        }

        public static function throw_result($message) {

            $result = array();
            $result['result'] = $message;
            exit(json_encode($result));
        }

        public static function throw_dump($dump) {

            exit(json_encode($dump));
        }
    }

?>