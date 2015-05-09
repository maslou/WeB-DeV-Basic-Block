<?php

namespace Lib;

class Database {

    private static $db = null;

    private function __construct() {
        // Read the includes/config.php db settings
        $host = DB_HOST;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $dbname = DB_DATABASE;

        $db = new \mysqli( $host, $username, $password, $dbname );

        self::$db = $db;
    }

    public static function get_instance() {
        static $instance = null;

        if( null === $instance ) {
            $instance = new static();
        }

        return $instance;
    }

    public static function get_db() {
        return self::$db;
    }
}
