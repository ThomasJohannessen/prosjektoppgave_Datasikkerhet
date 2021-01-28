<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "datasikkerhet_prosjekt";
    private $username = "DBuser";
    private $password = "DBpassord";
    public $mysqli;
  
    // get the database connection
    public function getConnection(){

        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if($this->mysqli->connect_errno){
            echo "Connection Failed";
        }
        return $this->mysqli;
    }
}
?>

