<?php
/**
 * Created by IntelliJ IDEA.
 * User: dinhquangtrung
 * Date: 9/14/14
 * Time: 12:46 PM
 */

function dal_insert_schedule($schedule) {
    $code   = mysql_real_escape_string($schedule["Person"]["Code"]);
    $name   = mysql_real_escape_string($schedule["Person"]["Name"]);
    $email  = mysql_real_escape_string($schedule["Person"]["Email"]);
    $role   = mysql_real_escape_string($schedule["Person"]["Role"]);
    $date   = mysql_real_escape_string($schedule["Date"]);
    $slot   = (int) ($schedule["Slot"]);
    $room   = mysql_real_escape_string($schedule["Room"]);
    $class  = mysql_real_escape_string($schedule["Class"]);
    $course = mysql_real_escape_string($schedule["Course"]);

    execute_query("INSERT INTO fuway_data.fuway_schedule".
        " (id, slotdate, slot, person_name, person_code, role, email, room, course, class)".
        " VALUES (NULL, '".
        $date.
        " ', '".
        $slot.
        " ', '".
        $name.
        " ', '".
        $code.
        " ', '".
        $role.
        " ', '".
        $email.
        " ', '".
        $room.
        " ', '".
        $course.
        " ', '".
        $class.
        " ');");
}

function dal_insert_data_version($data) {
    $date = mysql_real_escape_string($data["Date"]);
    $tkb_filename = mysql_real_escape_string($data["TKB"]);
    $sdd_filename = mysql_real_escape_string($data["SDD"]);

    execute_query("INSERT INTO fuway_data.fuway_data_version ".
        "(id, date, tkb_filename, sdd_filename) ".
        "VALUES (NULL, '".
        $date.
        "', '".
        $tkb_filename.
        "', '".
        $sdd_filename.
        "');");
}

function clear_data() {
    execute_query("TRUNCATE TABLE fuway_schedule");
}