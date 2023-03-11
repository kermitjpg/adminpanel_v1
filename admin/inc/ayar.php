<?php
error_reporting(0);
$host     = 'localhost'; //localhost
$user     = 'kullaniciadigiriniz';
$pass     = 'kullanicisifresigiriniz';
$db        = 'dbnamegiriniz';
$baglan = mysqli_connect($host, $user, $pass, $db) or die(mysqli_Error());
mysqli_query($baglan, "SET CHARACTER SET 'utf8'");
mysqli_query($baglan, "SET NAMES 'utf8'");
