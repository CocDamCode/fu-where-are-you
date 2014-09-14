<?php
function get_student_schedule($filename, $teacherSchedule)
{
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('UTF8');
    $data->setUTFEncoder('mb');
    $data->read($filename);

    return get_result_student($data, $teacherSchedule);
}


function get_result($class, $course, $teacherResults)
{
    foreach ($teacherResults as &$Result) {
        if ($Result["Class"] == $class) {
            if ($Result["Course"] == $course) {
                return $Result;
            }
        }
    }
}

function get_result_student($dataSDD, $teacherResults)
{
    $STUDENT_NAME_ROW = 13;
    $STUDENT_NAME_MAX = 42;

    $results = [];
    for ($num = 0; $num <= 100; $num++) {
        if (isset($dataSDD->sheets[$num])) {
            //File SDD
            $sheet_num = $num;
            $sheet = $dataSDD->sheets[$sheet_num]['cells'];
            $class = $sheet[3][7];
            $course = $sheet[4][7];
            $room = $sheet[5][7];
            for ($i = $STUDENT_NAME_ROW; $i <= $STUDENT_NAME_MAX; $i++) {
                if (!isset($sheet[$i][2]) || $sheet[$i][2] == "") break;
                $person = [];
                $person["Code"] = $sheet[$i][2];
                $person["Name"] = $sheet[$i][3];
                $person["Email"] = $sheet[$i][3] . $sheet[$i][2];
                $person["Role"] = "student";
                $result = [];
                $result["Person"] = $person;
                $result["Room"] = $room;
                $result["Class"] = $class;
                $result["Course"] = $course;
                $student_result = get_result($class, $course, $teacherResults);
                $result["Date"] = $student_result["Date"];
                $result["Slot"] = $student_result["Slot"];
                array_push($results, $result);
            }
        }
    }
    //print_r($results);
    return $results;
}

?>