<?php
// Menu osztály - az "menu" adatbázis tábla adatainak kezelésére szolgál
class Menu {
    private $db;

    // Konstruktor, amely megkap egy Database objektumot és eltárolja az adatbázis kapcsolatot
    public function __construct(Database $database) {
        // Lekéri a PDO kapcsolatot a Database osztályból
        $this->db = $database->getConnection();
    }

     // index() metódus - visszaadja az összes menüelemet a "menu" táblából
    public function index() {
        // Előkészít egy SQL lekérdezést
        $stmt = $this->db->prepare("SELECT * FROM menu");
        $stmt->execute();
        //FETCH_ASSOC - vráti asociatívne pole
        //FETCH_OBJ - vráti objekty
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>