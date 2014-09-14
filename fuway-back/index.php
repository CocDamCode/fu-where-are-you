<?php
require_once '../fuway-core/db.php';
require_once '../fuway-core/api.php';

if (isset($_GET['search'])) {
    echo json_encode(search_person($_GET['search']));
}

if (isset($_GET['email']) && isset($_GET['date'])) {
    $result = [];
    try {
        $datetime = date_create($_GET['date']);
        $result = get_person_schedule($_GET['email'], $datetime);
    } catch (Exception $e) {

    }

    echo json_encode($result);

}