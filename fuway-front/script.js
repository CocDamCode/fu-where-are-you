/**
 * Created by HaiNNT on 9/14/2014.
 */

var timeout;
function search() {
    timeout = setTimeout(function () {
        var param = $("#searchInput").val();
        var search = $.ajax({
            type: "GET",
            url: "http://localhost/fu-where-are-you/fuway-back/index.php?search=" + param
        }).done(function (result) {
            showResult(result);
        });
    }, 500)
}

function loadDetail(email, id) {
    $('.result-ul li ').removeClass('selected');
    $('#' + id).addClass('selected');
    var date = new Date();
    var month = date.getMonth() > 8 ? date.getMonth() + 1 : "0" + (date.getMonth() + 1);
    var strDate = date.getFullYear() + "-" +
        month + "-" +
        date.getDate();
    var load = $.ajax({
        type: "GET",
        url: "http://localhost/fu-where-are-you/fuway-back/index.php",
        data: { email: email, date: "2014-09-11"}
    }).done(function (result) {
        showDetail(result);
    });
}

function showResult(result) {
    $('header').slideUp();
    var persons = JSON.parse(result);
    var ul = $("#resultUl");
    var html = "";
    for (var i = 0; i < persons.length; i++) {
        var color = persons[i]["Role"] == "student" ? "rgb(221, 105, 105)" : "rgb(28, 103, 238)";
        html +=
            "<li id=\""+persons[i]["Code"]+"\" " +
            "onclick='" +
            "loadDetail(\"" + persons[i]["Email"] + "\", \""+persons[i]["Code"]+"\")' " +
            "style='color:" + color + " '" +
            ">" +
            "<span class='person-code'>" +
            persons[i]["Code"] +
            "</span>" +
            "<span class='person-name'>" +
            persons[i]["Name"] +
            "</span>" +
            "<span class='person-email'>" +
            persons[i]["Email"] +
            "</span>" +
            "</li>"
    }
    ul.html(html);
}

function getDayName(date) {
    switch (date.getDay()) {
        case 1: return "Thứ 2";
        case 2: return "Thứ 3";
        case 3: return "Thứ 4";
        case 4: return "Thứ 5";
        case 5: return "Thứ 6";
        case 6: return "Thứ 7";
        case 0: return "Chủ Nhật";
    }
}

function date_format(d) {
    var date = new Date(d * 1000);
    return date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear() + " ("+ getDayName(date)+")";
}

function showDetail(result) {
    var persons = JSON.parse(result);
    var info = $("#infoDiv");
    var html = "";
    if (persons.length > 0) {
        var person = persons[0];
        html += "<div>Vào ngày</div>" +
            "<div class='result-date'>" + date_format(person["Date"]) + "</div>" +
            "<div>Vào Slot</div>" +
            "<div class='result-slot'>" + person["Slot"] + "</div>" +
            "<div>Tại Phòng</div>" +
            "<div class='result-room'>" + person["Room"] + "</div>" +
            "<div>Thầy/Cô</div>" +
            "<div class='result-name'>" + person["Person"]["Name"] + "</div>" +
            "<div>Dạy Lớp</div>" +
            "<div class='result-class'>" + person["Class"] + "</div>" +
            "<div>Dạy Môn</div>" +
            "<div class='result-course'>" + person["Course"] + "</div>"
//            + person["Person"]["Name"] + "|||"
//            + person["Person"]["Code"] + "|||"
//            + person["Person"]["Email"] + "|||"
//            + person["Person"]["Role"] + "|||"
    }
    info.html(html);
}

function checkKeyword() {
    if ($('#searchInput').val().length == 0) {
        $('header').slideDown();
        $("#resultUl").html('');
    }
}

$(document).ready(function () {
    $("#searchInput").keyup(function () {
        clearTimeout(timeout);
        if ($("#searchInput").val().length > 2) {
            search();
        } else {

        }
    });
});