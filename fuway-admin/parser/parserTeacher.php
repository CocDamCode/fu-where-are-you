<?php
function get_teacher_schedule($filename)
{
    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('UTF8');
    $data->setUTFEncoder('mb');
    $data->read($filename);
    return get_result_teacher($data);
}



function get_Cham_cong_sheet($dataTKB)
{
    for ($num_sheet = 0; $num_sheet < 100; $num_sheet++) {
        if (isset($dataTKB->sheets[$num_sheet])) {
            if (isset($dataTKB->sheets[$num_sheet]['cells'][2][1]) &&
                $dataTKB->sheets[$num_sheet]['cells'][2][1] == "Stt") {
                return $num_sheet;
            }
        }
    }
    return 0;
}

function get_LichGV_sheet($dataTKB)
{
    for ($num_sheet = 0; $num_sheet < 100; $num_sheet++) {
        if (isset($dataTKB->sheets[$num_sheet])) {
            if ($dataTKB->sheets[$num_sheet]['cells'][8][1] == "Date") {
                return $num_sheet;
            }
        }
    }
    return 0;
}


function get_persons_teacher($dataTKB)
{
    $persons = array();
    //Use sheet Cham_cong
    $sheet_num = get_Cham_cong_sheet($dataTKB);
    // echo "+++++++++++".$sheet_num;
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    for ($i = 3; $i < $dataTKB->sheets[$sheet_num]['numRows']; $i++) {
        // echo "Reading $i <br/>";
        $person["Code"] = $sheet[$i][2];
        $person["Name"] = $sheet[$i][3];
        $person["Email"] = $sheet[$i][19];
        $person["Role"] = "teacher";
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
    date_default_timezone_set('UTC');

    $START_COL = 5;
    $TEACHER_NAME_ROW = 8;
    $SCHEDULE_SLOT_ROW_START = 9;

    $results = array();
    $result = array();
    //Sheet LichGV
    $sheet_num = get_LichGV_sheet($dataTKB);
    $sheet = $dataTKB->sheets[$sheet_num]['cells'];
    $persons = get_persons_teacher($dataTKB);
    // print_r($persons);
    for ($j = $START_COL; $j <= $dataTKB->sheets[$sheet_num]['numCols']; $j++) {
        if (!isset($sheet[$TEACHER_NAME_ROW][$j]) ||
            $sheet[$TEACHER_NAME_ROW][$j] == "" ||
            $sheet[$TEACHER_NAME_ROW][$j] == "EOF"
        ) continue;
        $person = get_person_teacher($sheet[$TEACHER_NAME_ROW][$j], $persons);
        //print_r($person);
        // echo "<br/>-----------------------------------<br/><br/>";
        for ($i = $SCHEDULE_SLOT_ROW_START; $i < $dataTKB->sheets[$sheet_num]['numRows']; $i++) {

            if (!isset($sheet[$i][$j]) || $sheet[$i][$j] == "EOF") continue;
            // echo "Reading $i-$j <br/>";
            if ($sheet[$i][$j] != "") {
                $string = explode("-", $sheet[$i][$j]);
                $result["Person"] = $person;
                $result["Date"] = date("Y-m-d", ((int) $dataTKB->sheets[$sheet_num]['cellsInfo'][$i][1]['raw'])-86400);

                //$result["Date"] = $dataTKB->sheets[$sheet_num]['cellsInfo'][$i][1]['raw'];
                $result["Slot"] = $sheet[$i][3];
                $result["Room"] = $string[2];
                $result["Class"] = $string[1];
                $result["Course"] = $string[0];
                array_push($results, $result);
            }
        }
    }
    //print_r($results);
    return $results;
}

?>