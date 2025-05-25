<?php
include("partials/header.php");

  $db = new Database();
  $contact = new Contact($db);


  // Ellenőrizzük, hogy a GET kérés tartalmaz-e egy 'id' paramétert 
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Lekérdezzük az adott ID-hoz tartozó adatokat (pl. foglalás részletei)
    $contactData = $contact->show($id);
  }

  // Ellenőrizzük, hogy POST kérés érkezett-e
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $meno = trim($_POST["name-edit"] ?? "");
    $email = trim($_POST["email-edit"] ?? "");
    $tel = trim($_POST["phone-edit"] ?? "");
    $pocethosti = trim($_POST["number-guests-edit"] ?? "");
    $datum = trim($_POST["date-edit"] ?? "");
    $cas = trim($_POST["time-edit"] ?? "");
    $popis = trim($_POST["message-edit"] ?? "");


    // Meghívjuk az 'edit' metódust a Contact osztályban, hogy frissítsük az adatbázisban a megadott ID-hoz tartozó rekordot
    if ($contact->edit($id, $meno, $email, $tel, $pocethosti, $datum, $cas, $popis)) {
        header("Location: admin.php");
        exit;
    }
    else {
        echo "Nepodarilo sa updatnúť záznam";
    }
  }
?>

<section class="section" id="edit">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-form">
                        <form id="contact-edit" action="" method="post">
                          <div class="row">
                            <div class="col-lg-12">
                                <h4>Editovanie rezervacie</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input name="name-edit" type="text" id="name-edit" placeholder="Your Name*" value="<?php echo $contactData["meno"] ?>" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <input name="email-edit" type="text" id="email-edit" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" value="<?php echo $contactData["email"] ?>" required="">
                            </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input name="phone-edit" type="text" id="phone-edit" placeholder="Phone Number*" value="<?php echo $contactData["tel"] ?>" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <select name="number-guests-edit" id="number-guests-edit">
                                    <option value="">Number Of Guests</option>
                                    <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $selected = ($contactData["pocethosti"] == $i) ? "selected" : "";
                                            echo "<option value=\"$i\" $selected>$i</option>";
                                        }
                                    ?>
                                </select>
                              </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <div id="filterDate2">    
                                  <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <input  name="date-edit" id="date-edit" type="text" class="form-control" placeholder="dd/mm/yyyy" value="<?php echo $contactData["datum"] ?>">
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>   
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                              <select name="time-edit" id="time-edit">
                                <option value="">Time</option>
                                <?php
                                    $times = ["Breakfast", "Lunch", "Dinner"];
                                    foreach ($times as $t) {
                                        $selected = ($contactData["cas"] == $t) ? "selected" : "";
                                        echo "<option value=\"$t\" $selected>$t</option>";
                                    }
                                ?>
                                </select>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message-edit" rows="6" id="message-edit" placeholder="Message" required=""><?php echo $contactData["popis"] ?></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="submit-edit" class="main-button-icon">Update Reservation</button>
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