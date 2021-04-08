<?php

class Database {
    private $db_host = "localhost";
    private $db_name = "datasikkerhet_prosjekt";

    private $db_username = ""; 
    private $db_password = "";

    private $conn;
    
    public function get_Connection($usertype) {
        if ($usertype == "foreleser") {
            $this->db_username = "foreleser";
            $this->db_password = "b3stLecturer1nDawuRld";
        }
        else if ($usertype == "student") {
            $this->db_username = "student";
            $this->db_password = "justAP3asantBr0kestuD3nt";
        }
        else if ($usertype == "guest") {
            $this->db_username = "guest";
            $this->db_password = "t0tallyUn1nv1tedguesT";
        }
        else if ($usertype == "admin") {
            $this->db_username = "softsec";
            $this->db_password = "bullshitbruker99";
        }
        
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
