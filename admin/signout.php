<?php
require_once("dboperations.php");

session_destroy();
header("location: login.php");
exit;
?>