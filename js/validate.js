$(document).ready(function() {

    var validator = $("#passGenForm").validate({
        rules: {
            inputNumberOfWords: {
                required: true,
                min: 1,
                max: 10
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        wrapper: "div",
        errorPlacement: function(error, element) {
            error.addClass('alert alert-danger');
            error.appendTo("#errorElement");
        },
        focusInvalid: false
    });

});
