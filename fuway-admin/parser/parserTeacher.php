<meta charset="UTF-8">
<?php
require_once '../../fuway-core/db.php';
require_once '../../fuway-core/dal.php';

require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('UTF8');
$data->setUTFEncoder('mb');
$data->read('ex.xls');


$result = get_result_teacher($data);
print_r($result);
//dal_insert_schedule($schedule);

function get_persons_teacher($dataTKB)
{
    $persons = [];
    //Use sheet Cham_cong
    $sheet_num = 1;
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    for ($i = 3; $i < $dataTKB->sheets[$sheet_num]['numRows']; $i++) {
        $person["Code"] = $sheet[$i][2];
        $person["Name"] = $sheet[$i][3];
        $person["Email"] = $sheet[$i][19];
        $person["Role"] = "Teacher";
        // echo "Reading row $i - " . $sheet[$i][2] . " - " .$sheet[$i][3] ." - " .$sheet[$i][19] ." <br/>";
        array_push($persons, $person);
    }
    return $persons;
}

function get_person_teacher($teacher_code, $persons)
{
    for ($i = 0; $i < count($persons); $i++) {
        if ($teacher_code == $persons[$i]['Code']) {
            return $persons[$i];
        }
    }
}

function get_result_teacher($dataTKB)
{
    $START_COL = 5;
    $TEACHER_NAME_ROW = 8;
    $SCHEDULE_SLOT_ROW_START = 9;

    $results = [];
    $result = [];
    //Sheet LichGV
    $sheet_num = 2;
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    $persons = get_persons_teacher($dataTKB);
    for ($j = $START_COL; $j <= $dataTKB->sheets[$sheet_num]['numCols']; $j++) {
        if (!isset($sheet[$TEACHER_NAME_ROW][$j]) ||
            $sheet[$TEACHER_NAME_ROW][$j] == "" ||
            $sheet[$TEACHER_NAME_ROW][$j] == "EOF"
        ) continue;
        $person = get_person_teacher($sheet[$TEACHER_NAME_ROW][$j], $persons);
        // print_r($person);
        // echo "<br/>-----------------------------------<br/><br/>";
        for ($i = $SCHEDULE_SLOT_ROW_START; $i < $dataTKB->sheets[$sheet_num]['numRows']; $i++) {

            if (!isset($sheet[$i][$j]) || $sheet[$i][$j] == "EOF") continue;
            // echo "Reading $i-$j <br/>";
            if ($sheet[$i][$j] != "") {
                $string = explode("-", $sheet[$i][$j]);
                $result["Person"] = $person;
                $result["Date"] = date("Y-m-d", $dataTKB->sheets[$sheet_num]['cellsInfo'][$i][1]['raw']);
                $result["Slot"] = $sheet[$i][3];
                $result["Room"] = $string[2];
                $result["Class"] = $string[1];
                $result["Course"] = $string[0];
                // print_r($result);
                // dal_insert_schedule($result);
                array_push($results, $result);
            }
        }
    }
    //print_r($results);
    return $results;
}

?>