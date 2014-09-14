<?php

    if (isset($_GET['search'])) {
        $persons = array();
        $person1 = array();
        $person1["Email"] = "trungdqse60994@fpt.edu.vn";
        $person1["Code"] = "SE60994";
        $person1["Name"] = "Đinh Quang Trung";
        $person1["Role"] = "student";

        $person2 = array();
        $person2["Email"] = "tuanbtse6[]0824@fpt.edu.vn";
        $person2["Code"] = "SE60824";
        $person2["Name"] = "Bùi Tiến Tuân";
        $person1["Role"] = "student";

        $person3 = array();
        $person3["Email"] = "hainntse60916@fpt.edu.vn";
        $person3["Code"] = "SE60916";
        $person3["Name"] = "Nguyễn Ngọc Thanh Hải";
        $person1["Role"] = "teacher";

        array_push($persons, $person1);
        array_push($persons, $person2);
        array_push($persons, $person3);

        echo json_encode($persons);
    }

    if (isset($_GET['email'])) {
        $results = array();
        $person1 = array();
        $person1["Email"] = "trungdqse60994@fpt.edu.vn";
        $person1["Code"] = "SE60994";
        $person1["Name"] = "Đinh Quang Trung";
        $person1["Role"] = "student";

        $person2 = array();
        $person2["Email"] = "tuanbtse6[]0824@fpt.edu.vn";
        $person2["Code"] = "SE60824";
        $person2["Name"] = "Bùi Tiến Tuân";
        $person1["Role"] = "student";

        $person3 = array();
        $person3["Email"] = "hainntse60916@fpt.edu.vn";
        $person3["Code"] = "SE60916";
        $person3["Name"] = "Nguyễn Ngọc Thanh Hải";
        $person1["Role"] = "teacher";

        $result1 = array();
        $result1["Person"] = $person1;
        $result1["Date"] = time();
        $result1["Slot"] = 6;
        $result1["Room"] = "408";
        $result1["Class"] = "SE0770";
        $result1["Course"] = "HCI";

        $result2 = array();
        $result2["Person"] = $person2;
        $result2["Date"] = time();
        $result2["Slot"] = 5;
        $result2["Room"] = "308";
        $result2["Class"] = "SE0772";
        $result2["Course"] = "POA";

        $result3 = array();
        $result3["Person"] = $person3;
        $result3["Date"] = time();
        $result3["Slot"] = 4;
        $result3["Room"] = "208";
        $result3["Class"] = "SE0771";
        $result3["Course"] = "I2DB";


        array_push($results, $result1);
        array_push($results, $result2);
        array_push($results, $result3);

        echo json_encode($results);
    }