<?php

if (!$_FILES) {
    die();
}

require_once 'parser/Excel/reader.php';
require_once '../fuway-core/db.php';
require_once '../fuway-core/dal.php';
require_once 'parser/parserTeacher.php';
require_once 'parser/parserStudent.php';

function startParse() {
    $teacherSchedule = get_teacher_schedule("file/TKB.xls");
    $studentSchedule = get_student_schedule("file/SDD.xls", $teacherSchedule);
    clear_data();
    foreach ($teacherSchedule as $s) {
        dal_insert_schedule($s);
    }
    foreach ($studentSchedule as $s) {
        dal_insert_schedule($s);
    }
    echo "Parse OK!";
}

if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br/>";

    if ($_FILES["file"]["type"] == "application/zip") {

        $filename = "file/" . $_FILES["file"]["name"];

        $files = glob('file/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }

        // Save file
        move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
        $zip = new ZipArchive;
        if ($zip->open($filename) === TRUE) {
            $zip->extractTo('file/');
            $zip->close();
            echo 'Unzip ok <br/>';
            unlink($filename);

            startParse();
        } else {
            echo 'Unzip failed';
        }
    } else {
        echo "Only allow zip file";
    }

}
