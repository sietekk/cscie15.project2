$(document).ready(function() {

    $("#passGenForm").validate({
        rules: {
            inputNumberOfWords: {
                min: 1,
                max: 10
            }
        },
        wrapper: "span",
        errorPlacement: function(error, element) {
            error.addClass('alert alert-danger');
            error.appendTo("#errorElement");
        },
        focusCleanup: true
    });

});
