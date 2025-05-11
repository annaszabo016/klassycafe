<?php
class Menu {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function index() {
        $stmt = $this->db->prepare("SELECT * FROM menu");
        $stmt->execute();
        //FETCH_ASSOC - vráti asociatívne pole
        //FETCH_OBJ - vráti objekty
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>