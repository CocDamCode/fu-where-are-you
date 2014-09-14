/**
 * Created by HaiNNT on 9/14/2014.
 */

var timeout;
function search() {
     timeout = setTimeout(function(){
        var param = $("#searchInput").val();
        var search = $.ajax({
                type: "GET",
                url: "http://localhost/fu-where-are-you/fuway-back/index.php?search=" + param
//            data: { search: param }
            }
        ).done(function (result) {
                showResult(result);
            });
    },500)
}

function loadDetail(email) {
    var date = new Date();
    var month = date.getMonth() > 8 ? date.getMonth()+1 : "0"+ (date.getMonth()+1);
    var strDate = date.getFullYear()+"-"+
        month +"-"+
        date.getDate();
    var load = $.ajax({
            type: "GET",
            url: "http://localhost/fu-where-are-you/fuway-back/index.php",
            data: { email: email, date: "2014-09-11"}
        }
    ).done(function (result) {
            showDetail(result);
        });
}

function showResult(result) {
    var persons = JSON.parse(result);
    var ul = $("#resultUl");
    var html = "";
        for (i = 0; i < persons.length; i++) {
            var color = persons[i]["Role"] == "teacher" ? "red" : "blue";
            html +=
                "<li "+
                "onclick='"+
                    "loadDetail(\""+ persons[i]["Email"] +"\")' " +
                    "style='color:" + color + " '"+

                    ">" +
                "<span>" +
                persons[i]["Code"] +
                "</span>" +
                "<span>" +
                persons[i]["Name"] +
                "</span>" +
                "<span>" +
                persons[i]["Email"] +
                "</span>" +
                "</li>"
        }
    ul.html(html);
}

function showDetail(result) {
    var persons = JSON.parse(result);
    var info = $("#infoDiv");
    var html = "";
    if(persons.length > 0) {
        var person = persons[0];
        html += person["Date"] + "|||"
            + person["Slot"] + "|||"
            + person["Room"] + "|||"
            + person["Class"] + "|||"
            + person["Course"] + "|||"
            + person["Person"]["Name"] + "|||"
            + person["Person"]["Code"] + "|||"
            + person["Person"]["Email"] + "|||"
            + person["Person"]["Role"] + "|||"
    }
    info.html(html);
}

$(document).ready(
    function (){
        $("#searchInput").keyup(function(){
            clearTimeout(timeout);
            if($("#searchInput").val().length > 2){
                search();
            }else{

            }
        });
    }
);