<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class DBConnection {
    protected static $connection;
    public function connect() {
        // Try and connect to the database

        if(!isset(self::$connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $url=$_SERVER['DOCUMENT_ROOT'].'/read/includes/config/config.ini';
            $config = parse_ini_file($url);
            self::$connection = mysqli_connect($config['dbserver'],$config['dbuser'],$config['dbpass'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    /**
     * Fetch the last error from the database
     *
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }


}