<?php
session_start();

$dbhost = "localhost"; // this will ususally be 'localhost', but can sometimes differ
$dbname = "pce_app"; // the name of the database that you are going to use for this project
$dbuser = "pce_bobby"; // the username that you created, or were given, to access your database
$dbpass = "Petrochem3"; // the password that you created, or were given, to access your database

mysql_connect($dbhost, $dbuser, $dbpass) or die("MySQL Error: " . mysql_error());
mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
?>
