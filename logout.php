<?php
require_once("inc/autoload.php");

$db = new Database();
$auth = new Authenticate($db);
$auth->logout();

header("Location: login.php");
exit;
?>