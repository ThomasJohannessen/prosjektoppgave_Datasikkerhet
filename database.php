<?php

class Database {
    private $db_host = "localhost";
    private $db_name = "datasikkerhet_prosjekt";
    private $db_username = "webBruker"; 
    private $db_password = "webApp123#21"; 
    private $conn;

    public function get_Connection() {
        $this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
        if($this->conn->connect_errno) {
            echo "Failed to connect";
            exit();
        }
        return $this->conn;
    }
    
    public function close_Connection() {
        if($this->conn) {
            $this->conn->close();
        }
        else {
            echo "No connection";
        }
    }
}
?>
