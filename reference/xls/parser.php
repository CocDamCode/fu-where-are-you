<?php
require_once 'Excel/reader.php';
error_reporting(0);
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('ex.xls');
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//get_result_teacher($data);

function get_persons_teacher($dataTKB)
{
    $persons = [];
    //Use sheet Cham_cong
    $sheet_num = 1;
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    for ($i = 3; $i <= $dataTKB->sheets[$sheet_num]['numRows']; $i++) {
        $teacherInfo = [];
        $person["Code"] = $sheet[$i][2];
        $person["Name"] = $sheet[$i][3];
        $person["Email"] = $sheet[$i][19];
        $person["Role"] = "Teacher";
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
    $results = [];
    $result = [];
    //Sheet LichGV
    $sheet_num = 2;
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    $persons = get_persons_teacher($dataTKB);
    for ($j = 5; $j <= $dataTKB->sheets[$sheet_num]['numCols']; $j++) {
        if($sheet[8][$j]=="" || $sheet[8][$j]=="EOF") return;
        $person = get_person_teacher($sheet[8][$j], $persons);
        for ($i = 9; $i <= $dataTKB->sheets[$sheet_num]['numRows']; $i++) {
            if($sheet[$i][$j]=="EOF") return;
            if ($sheet[$i][$j] != "") {
                $string = explode("-", $sheet[$i][$j]);
                $result["Person"] = $person;
                $result["Date"] = date("Y-m-d", $dataTKB->sheets[$sheet_num]['cellsInfo'][$i][1]['raw']);
                $result["Slot"] = $sheet[$i][3];
                $result["Room"] = $string[2];
                $result["Class"] = $string[1];
                $result["Course"] = $string[0];
                print_r($result);
                array_push($results, $result);
            }
        }
    }
    //print_r($results);
    return $results;
}

function get_result_student($dataSDD){
    $results = [];
    $result = [];
    //Sheet...
    //File SDD

    $sheet_num = 0;
    $sheet = $dataSDD->sheets[$sheet_num]['cells'];
    $class = $sheet[3][7];
    $subject=$sheet[4][7];
    $room=$sheet[5][7];
}

?>