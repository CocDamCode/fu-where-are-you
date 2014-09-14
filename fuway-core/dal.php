<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinhquangtrung
 * Date: 9/14/14
 * Time: 10:41 AM
 */

require_once 'db.php';
function search_person($str)
{
    $keyword = mysql_real_escape_string("%" . $str . "%");
    $result = execute_query("SELECT DISTINCT person_name, person_code, role, email FROM fuway_schedule WHERE person_name LIKE \"$keyword\" OR email LIKE \"$keyword\"");

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
    if (!$date) return [];
    $email = mysql_real_escape_string($str);
    $query_date = date_format($date, 'Y-m-d');
    $result = execute_query("SELECT * FROM fuway_schedule WHERE email = \"$email\" AND slotdate = \"$query_date\"");

    $slots = [];
    if ($result) {
        while ($row = mysql_fetch_array($result)) {
            $slot = [];
            $person = [];
            $person["Email"] = $row["email"];
            $person["Code"] = $row["person_code"];
            $person["Name"] = $row["person_name"];
            $person["Role"] = $row["role"];

            $slot["Person"] = $person;
            $slot["Date"] = strtotime($row["slotdate"]);
            $slot["Slot"] = (int) $row["slot"];
            $slot["Room"] = $row["room"];
            $slot["Class"] = $row["class"];
            $slot["Course"] = $row["course"];
            array_push($slots, $slot);
        }
    }
    return $slots;
}