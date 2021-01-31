<?php 

class Database {
    private $db_host = "localhost";
    private $db_name = "datasikkerhet_prosjekt";
    private $db_username = "root"; //placeholder
    private $db_password = ""; //placeholder
    private $mysqli;

    public function get_Connection() {
        $this->mysqli = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
        if($this->mysqli->connect_errno) {
            echo "Failed to connect";
            exit();
        }
        return $this->mysqli;
    }
    
    public function close_Connection() {
        if($this->mysqli) {
            $this->mysqli->close();
        }
        else {
            echo "No connection";
        }
    }
}

?>