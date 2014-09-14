<meta charset="utf-8">
<?php
include_once 'utils/dal.php';

if (isset($_GET['search'])) {
    echo json_encode(search_person($_GET['search']));
}

if (isset($_GET['email'])) {

}