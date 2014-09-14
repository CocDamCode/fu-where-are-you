<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinhquangtrung
 * Date: 9/14/14
 * Time: 10:03 AM
 */

$username = "root";
$password = "";
$hostname = "localhost";
$db_name   = "fuway_data";

//connection to the database
$db = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
mysql_set_charset('utf8',$db);
$selected = mysql_select_db($db_name,$db)
or die("Could not select " . $db_name);


function execute_query($query) {
    global $db;
    $result = mysql_query($query) or die(mysql_error($db));
    return $result;
}