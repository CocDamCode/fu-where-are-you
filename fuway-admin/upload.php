<?php
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";

    $filename = "file/" . $_FILES["file"]["name"];
    // Save file
    move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
    echo "Stored in: " . $filename;
}
