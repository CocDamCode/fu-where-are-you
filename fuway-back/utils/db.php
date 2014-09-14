<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinhquangtrung
 * Date: 9/14/14
 * Time: 10:03 AM
 */

$username = "your_name";
$password = "your_password";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";
