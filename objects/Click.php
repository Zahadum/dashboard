<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class Click{

    // database connection and table name
    private $conn;
    private $table_name = "click";

    // object properties
    public $id;
    public $andarAccountNumber;
    public $linkId;
    public $issue_article;
    public $ipAddress;
    public $createdAt;
    public $updatedAt;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read clicks
    function read(){
        // select all query
        $query = "SELECT * FROM click,link WHERE click.link_id=link.id";

        // prepare query statement
        //$stmt = $this->conn->prepare($query);

        // execute query
        $rows = $this->conn->select($query);

        return $rows;
    }
}