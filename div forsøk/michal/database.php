<?php 

class Database {
    private $db_host = "localhost";
    private $db_name = "crysis";
    private $db_username = "root";
    private $db_password = "";
    private $mysqli;

    public function get_Connection() {
        $this->mysqli = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
        if($this->mysqli->connect_errno) {
            echo "Failed to connect";
            exit();
        }
        return $this->mysqli;
    }
}

?>