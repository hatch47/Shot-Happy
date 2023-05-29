
<?php
class DBConnect {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "shothappy";
    private $conn;

    public function connect() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $this->conn;
    }

    public function close() {
        mysqli_close($this->conn);
    }
}

?>