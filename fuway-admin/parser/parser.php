<meta charset="UTF-8">
<?php

require_once 'Excel/reader.php';
require_once '../../fuway-core/db.php';
require_once '../../fuway-core/dal.php';
require_once 'parserTeacher.php';
require_once 'parserStudent.php';

$teacherSchedule = get_teacher_schedule("Fall 2014_TKB block 1_12.9.2014.xls");
$studentSchedule = get_student_schedule("01_Fall 2014_SDD chuyen nganh_Block1&6W1_start 09_09_2014_update 11_09_2014.xls", $teacherSchedule);

echo count($teacherSchedule) . "<br/>";
//print_r($teacherSchedule);
echo count($studentSchedule) . "<br/>";
print_r($studentSchedule);
?>