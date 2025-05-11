
<?php

include("partials/header.php");
require_once("inc/classes/Menu.php");
require_once("inc/classes/Chefs.php");

$db = new Database();
$menu = new Menu($db);
$menu_list = $menu->index();
$chefs = new Chefs($db);
$chefs_list = $chefs->index();
?>
<!-- ***** Menu Area Starts ***** -->
<section class="section" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Menu</h6>
                        <h2>Our selection of cakes with quality taste</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item-carousel">
            <div class="col-lg-12">
                <div class="owl-menu-item owl-carousel">
                    <?php
                        $counter = 0;
                        foreach ($menu_list as $item) {
                            $counter++;
                            echo "<div class=\"item\">";
                                echo "<div class=\"card card{$counter}\">";
                                    echo "<div class=\"price\"><h6>".$item["cena"]."€</h6></div>";
                                    echo "<div class=\"info\">";
                                        echo "<h1 class=\"title\">".$item["nazov_produktu"]."</h1>";
                                        echo "<p class=\"description\">".$item["popis"]."</p>";
                                        echo "<div class=\"main-text-button\">";
                                            echo "<div class=\"scroll-to-section\"><a href=\"#reservation\">Make Reservation <i class=\"fa fa-angle-down\"></i></a></div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Menu Area Ends ***** -->

    <!-- ***** Chefs Area Starts ***** -->
    <section class="section" id="chefs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Our Chefs</h6>
                        <h2>We offer the best ingredients for you</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $counter = 0;
                    foreach($chefs_list as $chef) {
                        $counter++;
                        echo "<div class=\"col-lg-4\">";
                            echo "<div class=\"chef-item\">";
                                echo "<div class=\"thumb\">";
                                    echo "<div class=\"overlay\"></div>";
                                    echo "<ul class=\"social-icons\">";
                                        echo "<li><a href=\"".(($chef["facebook"] != null) ? $chef["facebook"] : "#")."\"><i class=\"fa fa-facebook\"></i></a></li>";
                                        echo "<li><a href=\"".(($chef["twitter"] != null) ? $chef["twitter"] : "#")."\"><i class=\"fa fa-twitter\"></i></a></li>";
                                        echo "<li><a href=\"".(($chef["instagram"] != null) ? $chef["instagram"] : "#")."\"><i class=\"fa fa-instagram\"></i></a></li>";
                                    echo "</ul>";
                                    echo "<img src=\"assets/images/chefs-0{$counter}.jpg\" alt=\"Chef #{$counter}\">";
                                echo "</div>";
                                echo "<div class=\"down-content\">";
                                    echo "<h4>" . $chef["meno"] . " " . $chef["priezvisko"] . "</h4>";
                                    echo "<span>".$chef["odbor"]."</span>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** -->
     
<?php
include("partials/menu.php");
include("partials/footer.php");
?>
   

