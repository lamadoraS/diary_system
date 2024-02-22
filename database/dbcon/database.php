<?php
class Db{
    protected $conn;
    public $dbName = 'diary_system';

    public function db_connect() {
        $this->conn = new mysqli('localhost', 'root', '', $this->dbName);
        if($this->conn){
            return json_encode(
                [
                    'message' => 'Database is succesfully created!'
                ]
                );
    }
}
}
?>