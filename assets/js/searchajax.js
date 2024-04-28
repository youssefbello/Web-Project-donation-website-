function search() {
    var searchValue = $("#search").val();

    $.ajax({
        type: "POST",
        url: "eventa.php",
        data: { search: searchValue },
        success: function (data) {
            $("#search-results").html(data);
        }
    });
}