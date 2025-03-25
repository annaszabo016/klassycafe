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
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          $name = $_POST['name'];
          $email = $_POST['email'] ?? '';
          $phone = $_POST['phone'] ?? '';
          $date = $_POST['date'] ?? '';
          $time = $_POST['time'] ?? '';
          $guests = $_POST['number-guests'] ?? '';
          $message = $_POST['message'] ?? '';
    
          if (!empty($name)){
            echo "<h2>$name dakujeme za vyplnenie formulara</h2>";
          } else{
            echo "<h2>Dakujeme za vyplnenie formulara</h2>";
          }
        }
          
        
        
          echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Email:</strong> $email</p>";
            echo "<p style='font-size: 1.2rem; line-height: 1.6;'><strong>Telefón:</strong> $phone</p>";
            echo "<pstyle='font-size: 1.2rem; line-height: 1.6;'><strong>Dátum rezervácie:</strong> $date</p>";
            echo "<pstyle='font-size: 1.2rem; line-height: 1.6;'><strong>Čas rezervácie:</strong> $time</p>";
            echo "<pstyle='font-size: 1.2rem; line-height: 1.6;'><strong>Počet hostí:</strong> $guests</p>";

            if (!empty($message)) {
                echo "<p><strong>Správa:</strong> $message</p>";
            }
            ?>
      </div>
    </div>
  </section>


</main>
    
<?php
  include('partials/footer.php');
?>