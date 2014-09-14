/**
 * Created by HaiNNT on 9/14/2014.
 */

function search() {
    var param = $("#searchInput").val();
    var search = $.ajax({
            type: "GET",
            url: "http://localhost/fu-where-are-you/fuway-back/index.php?search=" + param
//            data: { search: param }
        }
    ).done(function (result) {
            showResult(result);
        });
}

function loadDetail() {

}

function showResult(result) {
    var persons = JSON.parse(result);
    var ul = $("#resultUl");
    var html = "";
        for (i = 0; i < persons.length; i++) {
            var color = persons[i]["Role"] == "teacher" ? "red" : "blue";
            html +=
                "<li style='color:" + color + " '>" +
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

function showDetail() {

}