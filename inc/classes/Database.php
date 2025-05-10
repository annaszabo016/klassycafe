<?php
class Database {
    private $host = "localhost";
    private $db = "klassy_kafe";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8";
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //ERRMODE_EXCEPTION - ak nastane chyba, vyhodí výnimku (ideálne)
            //ERRMODE_WARNING - vyhodí veľký warning
            //ERRMODE_SILENT - nevypíše nič
        }
        catch (PDOException $e) {
            die ("Connection failed: " . $e->getMessage());
        }
    }

    public function __destruct() {
        $this->pdo = null;
    }

    public function getConnection() {
        return $this->pdo;
    }
}

?>