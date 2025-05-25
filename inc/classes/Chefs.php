<?php
class Chefs {
    private $db; // PDO adatbázis kapcsolat

    // Konstruktor - fogad egy Database objektumot, és eltárolja a PDO kapcsolatot
    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    
    // index() - lekéri az összes séfet a "chefs" táblából
    public function index() {
        $stmt = $this->db->prepare("SELECT * FROM chefs");
        $stmt->execute();
        //FETCH_ASSOC - vráti asociatívne pole
        //FETCH_OBJ - vráti objekty
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>