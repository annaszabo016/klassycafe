<?php
class Authenticate {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function login($email, $password){
        $stmt = $this->db->prepare("SELECT * FROM prihlasenie WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user["password"])) {
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
        $_SESSION = [];
        session_destroy();

        
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION["idlogin"]);
    }

    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header("Location: login.php");
            exit;

        }
    }
}
?>