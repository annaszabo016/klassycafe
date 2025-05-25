<?php
  include('partials/header.php');
?>


<main>
  <section class="banner">
    <div class="container text-white">
      <h1>Ďakujeme</h1>
    </div>
  </section>
  <section class="container" style="padding-top: 80px;">
    <div class="row">
    <div class="col-100 text-center" style="background-color: #f4f4f4; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
      <div class="col-100 text-center">
        <?php
        $db = new Database();
        $contact = new Contact($db);
      

        // Ellenőrizzük, hogy az űrlapot POST metódussal küldték-e el
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //lekerjuk az ertekeket ha ures akkor ures ""
          $meno = trim($_POST["name"] ?? "");
          $email = trim($_POST["email"] ?? "");
          $tel = trim($_POST["phone"] ?? "");
          $pocethosti = trim($_POST["number-guests"] ?? "");
          $datum = trim($_POST["date"] ?? "");
          $cas = trim($_POST["time"] ?? "");
          $popis = trim($_POST["message"] ?? "");
      

          // Megpróbáljuk létrehozni az új kapcsolatot (foglalást) a megadott adatokkal
          if ($contact->create($meno, $email, $tel, $pocethosti, $datum, $cas, $popis)) {
            if (!empty($name)){
              echo "<h2>$name dakujeme za vyplnenie formulara</h2>";
            } else{
              echo "<h2>Dakujeme za vyplnenie formulara</h2>";
            }


            // Megjelenítjük a megadott adatokat szépen formázva
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Email:</strong> $email</p>";
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Telefón:</strong> $tel</p>";
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Dátum rezervácie:</strong> $datum</p>";
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Čas rezervácie:</strong> $cas</p>";
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Počet hostí:</strong> $pocethosti</p>";


            // Ha a felhasználó adott meg üzenetet, azt is megjelenítjük
            if (!empty($message)) {
              echo "<p><strong>Správa:</strong> $message</p>";
            }
          }
          else {
            // Ha a rekord létrehozása sikertelen, hibaüzenetet írunk ki JavaScript alerttel
            echo "<script>alert('Nepodarilo sa odoslať formulár!');</script>";
            header("Location: reservation.php");
            exit;
          }
        }
          
        
        
          
            ?>
      </div>
    </div>
  </section>


</main>
    
<?php
  include('partials/footer.php');
?>