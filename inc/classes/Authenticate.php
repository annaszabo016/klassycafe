<?php
// Authenticate osztály - a felhasználók bejelentkeztetésének és kijelentkeztetésének kezelése
class Authenticate {
    private $db; // PDO adatbázis kapcsolat

     // Konstruktor - a Database objektumból kinyeri a PDO kapcsolatot
    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // login metódus - ellenőrzi a felhasználó e-mailjét és jelszavát
    public function login($email, $password){
        // Készítünk egy lekérdezést a "prihlasenie" táblából az adott email alapján
        $stmt = $this->db->prepare("SELECT * FROM prihlasenie WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        // Lekérjük az első találatot
        $user = $stmt->fetch();

        if ($user) {
            // Ha a felhasználó létezik, ellenőrizzük a jelszót a password_verify segítségével (hash ellenőrzés)
            if (password_verify($password, $user["password"])) {
                // Ha jó a jelszó, elindítjuk a munkamenetet és eltároljuk a felhasználói adatokat
                session_start();
                $_SESSION["idlogin"] = $user["idlogin"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["name"] = $user["name"];
                return true;
            }
            else {
                echo "Password verification failed.<br>";
            }
        }
        else {
            echo "User not found.<br>";
        }
        return false;
    }

    public function logout() {
        $_SESSION = [];  // Munkamenet adatok törlése
        session_destroy(); // Munkamenet megsemmisítése

        // Munkamenet cookie törlése is, ha be van állítva
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                "",
                time() - 42000, // Lejárt idő, így törlődik a cookie
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
    }

    // isLoggedIn metódus - ellenőrzi, hogy be van-e jelentkezve a felhasználó
    public function isLoggedIn() {
        return isset($_SESSION["idlogin"]);
    }

    // requireLogin metódus - ha nincs bejelentkezve a felhasználó, átirányítja a login oldalra
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header("Location: login.php");
            exit;

        }
    }
}
?>