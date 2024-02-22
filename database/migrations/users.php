<?php
include '../dbcon/database.php';
header('Content-Type:application/json; charset= UTF-8');

class Users extends Db {
    public $tableName ='users';

    public function TableCreate() {
        $this->db_connect();

    $created = $this->conn->query("CREATE TABLE IF NOT EXISTS $this->tableName
    (  
        id int auto_increment primary key,
        first_name varchar(200) not null,
        last_name varchar(200) not null,
        email_address varchar(50) not null UNIQUE,
        password varchar(255) not null  
    )engine=Innodb

    ");

    if($created){
        return json_encode(['message' => 'table created']);
    } 
}   
public function Register($data) {
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email_address = $data['email_address'];
    $password = $data['password'];

    
    $isEmail = $this->conn->query("SELECT * FROM $this->tableName WHERE email_address = '$email_address'");
    if($isEmail->num_rows > 0){
        return json_encode(['message' => 'Email Already Exists']);
    }
    
    $isInserted = $this->conn->query("INSERT INTO $this->tableName(first_name, last_name, email_address, password)
     VALUES('$first_name', '$last_name', '$email_address', '$password')");
     
     if($isInserted) {
        header('Location:http://localhost/diary_system/dashboard/dashboard.html');
     }
     else {
        return json_encode(['message' => 'Failed to Load!']);
     }

  
    }
    public function logIn($data) {
        $email_address = $data['email_address'];
        $password = $data['password'];

        $logIn = $this->conn->query("SELECT * FROM $this->tableName WHERE email_address = '$email_address' AND password = '$password' ");
        if( $logIn-> num_rows > 0 ) {
            header('Location: http://localhost/diary_system/dashboard/dashboard.html');
        }
        else {
            return json_encode(
                [
                    'message' => 'Email or Password is Invalid'
                ]
                );
        }
}
}


  
?>