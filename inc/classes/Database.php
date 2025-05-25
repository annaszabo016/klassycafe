<?php
class Database {
    private $host = "localhost";
    private $db = "klassy_kafe";
    private $user = "root";
    private $pass = "";
    private $charset = "utf8";
    private $pdo;

    // Konstruktor - megpróbál csatlakozni az adatbázishoz
    public function __construct() {
        // DSN (Data Source Name) összeállítása az adatbázis kapcsolat létrehozásához
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            // Új PDO objektum létrehozása az adatbázis kapcsolathoz
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

    // Destruktor - amikor a példány megszűnik, bontja az adatbázis kapcsolatot
    public function __destruct() {
        $this->pdo = null;
    }

    // Metódus, amely visszaadja a PDO kapcsolatot más osztályok számára
    public function getConnection() {
        return $this->pdo;
    }
}

?>