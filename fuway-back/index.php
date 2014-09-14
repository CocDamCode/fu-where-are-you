<?php

    if (isset($_GET['search'])) {
        $persons = array();
        $person1 = [];
        $person1["Email"] = "trungdqse60994@fpt.edu.vn";
        $person1["Code"] = "SE60994";
        $person1["Name"] = "Đinh Quang Trung";

        $person2 = [];
        $person2["Email"] = "tuanbtse60824@fpt.edu.vn";
        $person2["Code"] = "SE60824";
        $person2["Name"] = "Bùi Tiến Tuân";

        $person3 = [];
        $person3["Email"] = "hainntse60916@fpt.edu.vn";
        $person3["Code"] = "SE60916";
        $person3["Name"] = "Nguyễn Ngọc Thanh Hải";

        array_push($persons, $person1);
        array_push($persons, $person2);
        array_push($persons, $person3);

        echo json_encode($persons);
    }

    if (isset($_GET['email'])) {
        $result = [];
        $person1 = [];
        $person1["Email"] = "trungdqse60994@fpt.edu.vn";
        $person1["Code"] = "SE60994";
        $person1["Name"] = "Đinh Quang Trung";

        $result["Person"] = $person1;
        $result["Date"] = time();
        $result["Slot"] = 6;
        $result["Room"] = "408";
        $result["Class"] = "SE0770";
        $result["Course"] = "HCI";

        echo json_encode($result);
    }