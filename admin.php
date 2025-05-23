<?php
include('partials/header.php');

$db = new Database();
$auth = new Authenticate($db);
$auth->requireLogin();
$contact = new Contact($db);
$contacts = $contact->index();

if (isset($_GET["delete"])) {
    $contact->destroy($_GET["delete"]);
    header("Location: admin.php");
    exit;
}
?>

<section class="section" id="contacts-table">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table-content">
                        <div class="section-heading">
                            <h2>Admin rozhranie</h2>
                        </div>
                            <table border="1">
                                <tr>
                                    <th>ID</th>
                                    <th>Meno</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th>Pocet hosti</th>
                                    <th>Datum</th>
                                    <th>Cas</th>
                                    <th>Popis</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>

                                <?php
                                    foreach($contacts as $con) {
                                        echo "<tr>";
                                        echo "<td>".$con["idreservation"]."</td>";
                                        echo "<td>".$con["meno"]."</td>";
                                        echo "<td>".$con["email"]."</td>";
                                        echo "<td>".$con["tel"]."</td>";
                                        echo "<td>".$con["pocethosti"]."</td>";
                                        echo "<td>".$con["datum"]."</td>";
                                        echo "<td>".$con["cas"]."</td>";
                                        echo "<td>".$con["popis"]."</td>";
                                        echo '<td><a href="contact-edit.php?id='.$con["idreservation"].'" target="_blank">Editovať</a></td>';
                                        echo '<td><a href="?delete='.$con["idreservation"].'"onclick="return confirm(\'Určite chcete vymazať túto správu?\')">Odstrániť</a></td>';
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include("partials/footer.php");
?>