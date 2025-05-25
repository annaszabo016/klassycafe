<?php
include("partials/header.php");

  $db = new Database();
  $auth = new Authenticate($db);


  // Ellenőrizzük, hogy a GET kérés tartalmaz-e 'id' paramétert
  if (isset($_GET["id"])) {
    //lekerjuk az id-t
    $id = $_GET["id"];
    $contactData = $contact->show($id);
  }


  // Ha az oldal POST kérésen keresztül lett elküldve (pl. bejelentkezési űrlap)
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Az e-mailt és jelszót lekérjük a POST adatokból, ha nem szerepelnek, akkor üres stringet használunk
    $email = $_POST["email-login"] ?? "";
    $password = $_POST["password-login"] ?? "";

    // Megpróbáljuk bejelentkeztetni a felhasználót a megadott e-maillel és jelszóval
    if ($auth->login($email, $password)) {
        header("Location: admin.php"); 
        exit;
    }
    else {
        $error = "Nesprávne meno alebo heslo";
    }
  }
?>

<section class="section" id="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <?php if (isset($error)): ?>
                            <div style="color:red;">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form id="login-form" action="" method="post">
                          <div class="row">
                            <div class="col-lg-12">
                                <h4>Login to your account</h4>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <fieldset>
                              <input name="email-login" type="text" id="email-login" pattern="[^ @]*@[^ @]*" placeholder="Email" required="">
                            </fieldset>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <fieldset>
                                <input name="password-login" type="password" id="password-login" placeholder="Password" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="submit-login" class="main-button-icon">Login</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Reservation Area Ends ***** -->

<?php
    include("partials/footer.php")
?>