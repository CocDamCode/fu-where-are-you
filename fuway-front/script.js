/**
 * Created by HaiNNT on 9/14/2014.
 */

var timeout;
function search() {
    timeout = setTimeout(function () {
        var param = $("#searchInput").val();
        var search = $.ajax({
            type: "GET",
            url: "../fuway-back/index.php?search=" + param
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
        url: "../fuway-back/index.php",
        data: { email: email, date: $( "#datepicker").val()}
    }).done(function (result) {
        showDetail(result);
    });
}

function showResult(result) {
    $('header').slideUp();
    $('#user-guide').slideUp();
    var persons = JSON.parse(result);
    var ul = $("#resultUl");
    var html = "";
    if (persons.length > 0) {
        for (var i = 0; i < persons.length; i++) {
            var color = persons[i]["Role"] == "teacher" ? "rgb(221, 105, 105)" : "rgb(28, 103, 238)";
            html +=
                "<li id=\"" + persons[i]["Code"] + "\" " +
                "onclick='" +
                "loadDetail(\"" + persons[i]["Email"] + "\", \"" + persons[i]["Code"] + "\")' " +
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
    } else {
        html = 'Không tìm thấy kết quả nào!';
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
Date.prototype.yyyymmdd = function() {
    var yyyy = this.getFullYear().toString();
    var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
    var dd  = this.getDate().toString();
    return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
};
function get_current_date() {
    var d = new Date();
    return d.yyyymmdd();
}

function showDetail(result) {
    var persons = JSON.parse(result);
    var info = $("#infoDiv");
    var html = "";
    if (persons.length > 0) {
        html += "<div style='padding-top: 15px'>Lịch trong ngày của <b>"+persons[0]["Person"]["Name"]+"</b></div>" +
            "<div class='bigText'>" + date_format(persons[0]["Date"]) + "</div>" +
            "<table width='100%' border='1' style='text-align: center;'><tr>" +
            "<td>Slot</td>" +
            "<td>Phòng</td>" +
            "<td>Lớp</td>" +
            "<td>Môn</td>" +
            "</tr>";

        for (var i = 0; i < persons.length; i++) {
            var person = persons[i];
            html += "<tr><td>" + person["Slot"] + "</td>"
            html += "<td>" + person["Room"] + "</td>"
            html += "<td>" + person["Class"] + "</td>"
            html += "<td>" + person["Course"] + "</td></tr>"
        }

        html += "</table><div style='height: 20px'></div>";
    } else {
        html = "<div style='padding: 15px'>Không có lịch trong ngày " + $('#datepicker').val() + "</div>";
    }
    info.html(html);
}

function checkKeyword() {
    if ($('#searchInput').val().length == 0) {
        $('header').slideDown();
        $('#user-guide').slideDown();
        $("#resultUl").html('');
        $('#infoDiv').html('');
    }
}

function startSearch() {
    clearTimeout(timeout);
    $("#resultUl").html('');
    $('#infoDiv').html('')
    if ($("#searchInput").val().length > 2) {
        search();
    } else {

    }
}

$(document).ready(function () {
    $("#searchInput").keyup(function () {
        startSearch();
    });
});