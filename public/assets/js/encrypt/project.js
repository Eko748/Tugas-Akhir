$("#top-home-tab").on("click", function () {
    $("#project-load").show();
    $("#doing-load").hide();
    $("#done-load").hide();
});

$(document).on("click", ".pagination a", function (event) {
    event.preventDefault();
    let page = $(this).attr("href").split("page=")[1];
    let type = "projects";
    getData(page, type);
});

$("#top-doing-tab").on("click", function () {
    $("#doing-load").show();
    $("#done-load").hide();
    $("#project-load").hide();
    $(document).ready(function () {
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            let type = "doing";
            getData(page, type);
        });
    });
});

$("#top-done-tab").on("click", function () {
    $("#done-load").show();
    $("#doing-load").hide();
    $("#project-load").hide();
    $(document).ready(function () {
        $(document).on("click", ".pagination a", function (event) {
            event.preventDefault();
            let page = $(this).attr("href").split("page=")[1];
            let type = "done";
            getData(page, type);
        });
    });
});

function getData(page, type) {
    $.ajax({
        type: "GET",
        data: {},
        url: '{{ Auth::user()->role_id == 1 ? route("management.project.index") : route("project.index") }}' +
            '?page=' +
            page +
            '&type=' +
            type,
        success: function (data) {
            if (type == "projects") {
                $("#project-load").html(data);
            } else if (type == "doing") {
                $("#doing-load").html(data);
            } else if (type == "done") {
                $("#done-load").html(data);
            }
        },
    });
}
