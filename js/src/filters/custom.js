jQuery(document).ready(function ($) {
    $('#year-select, #month-select').change(function () {
        var selectedYear = $('#year-select').val();
        var selectedMonth = $('#month-select').val();

        $.ajax({
            type: 'POST',
            url: window.ajax_params.ajax_url, // Access ajax_params from window object
            data: {
                action: 'filter_posts', // This is the action hook we'll use in PHP.
                year: selectedYear,
                month: selectedMonth
            },
            success: function (response) {
                $('.posts.block .block__content').html(response); // Replace the posts block content with the response
                return false;
            }
        });
    });
});