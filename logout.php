<?php
include ('classes.php');
session_start();
unset($_SESSION['logged']);
header("location: index.php");

?>
