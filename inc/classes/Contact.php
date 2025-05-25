<?php
class Contact {
    private $db;

    // Konstruktor - fogad egy Database objektumot, és eltárolja a PDO kapcsolatot
    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // index() - lekéri az összes foglalást a "reservation" táblából
    public function index() {
        $stmt = $this->db->prepare("SELECT * FROM reservation");
        $stmt->execute();
        //FETCH_ASSOC - vráti asociatívne pole
        //FETCH_OBJ - vráti objekty
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     // destroy($id) - töröl egy foglalást az adott azonosító alapján
    public function destroy($id) {
        $stmt = $this->db->prepare("DELETE FROM reservation WHERE idreservation = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT); //PDO::PARAM_INT - nepovinné
        return $stmt->execute();
    }


    // create(...) - új foglalás létrehozása a megadott adatokkal
    public function create($meno, $email, $tel, $pocethosti, $datum, $cas, $popis) {
        $stmt = $this->db->prepare("INSERT INTO reservation (meno ,email, tel, pocethosti, datum, cas, popis) values(:meno, :email, :tel, :pocethosti, :datum, :cas, :popis)");
        // Paraméterek kötése az SQL lekérdezéshez
        $stmt->bindParam(":meno", $meno, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":tel", $tel, PDO::PARAM_STR);
        $stmt->bindParam(":pocethosti", $pocethosti, PDO::PARAM_INT);
        $stmt->bindParam(":datum", $datum, PDO::PARAM_STR);
        $stmt->bindParam(":cas", $cas, PDO::PARAM_STR);
        $stmt->bindParam(":popis", $popis, PDO::PARAM_STR);
        return $stmt->execute(); //Toto vykoná dotaz
    }
    // show($id) - lekér egy konkrét foglalást az ID alapján
    public function show($id) {
        $stmt = $this->db->prepare("SELECT * FROM reservation WHERE idreservation = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // edit(...) - egy meglévő foglalás adatainak frissítése az ID alapján
    public function edit($id, $meno, $email, $tel, $pocethosti, $datum, $cas, $popis) {
        $stmt = $this->db->prepare("UPDATE reservation SET meno = :meno, email = :email, tel = :tel, pocethosti = :pocethosti, datum = :datum, cas = :cas, popis = :popis WHERE idreservation = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":meno", $meno, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":tel", $tel, PDO::PARAM_STR);
        $stmt->bindParam(":pocethosti", $pocethosti, PDO::PARAM_INT);
        $stmt->bindParam(":datum", $datum, PDO::PARAM_STR);
        $stmt->bindParam(":cas", $cas, PDO::PARAM_STR);
        $stmt->bindParam(":popis", $popis, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // updateStatus($id, $status) - frissíti egy foglalás státuszát (pl. accepted, denied, pending)
    public function updateStatus($id, $status) {
    $stmt = $this->db->prepare("UPDATE reservation SET status = :status WHERE idreservation = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":status", $status, PDO::PARAM_STR);
    return $stmt->execute();
}
}
?>