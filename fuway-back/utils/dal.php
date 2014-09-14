<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinhquangtrung
 * Date: 9/14/14
 * Time: 10:41 AM
 */

include_once 'db.php';
function search_person($str)
{
    $keyword = mysql_real_escape_string("%" . $str . "%");
    $result = mysql_query("SELECT DISTINCT person_name, person_code, role, email FROM fuway_schedule WHERE person_name LIKE \"$keyword\" OR email LIKE \"$keyword\"") or die(mysql_error($db));

    $persons = [];
    if ($result) {
        while ($row = mysql_fetch_array($result)) {
            $person = [];
            $person["Email"] = $row["email"];
            $person["Code"] = $row["person_code"];
            $person["Name"] = $row["person_name"];
            $person["Role"] = $row["role"];
            array_push($persons, $person);
        }
    }
    return $persons;
}

function get_person_schedule($str, $date) {
    $email = mysql_real_escape_string($str);
    $query_date = date_format($date, 'Y-m-d');
    $result = mysql_query("SELECT * FROM fuway_schedule WHERE email = \"$email\" slotdate = \"$query_date\"");


    if ($result) {
        while ($row = mysql_fetch_array($result)) {
            $person = [];
            $person["Email"] = $row["email"];
            $person["Code"] = $row["person_code"];
            $person["Name"] = $row["person_name"];
            $person["Role"] = $row["role"];
            array_push($persons, $person);
        }
    }
    // return $slots;
}