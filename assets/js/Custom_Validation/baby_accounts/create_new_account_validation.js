$(document).ready(function () {
    $('#loader').hide();
    //alert();
    $('#create_new_account').validate({// <- attach '.validate()' to your form
        // Rules for form validation
        rules: {
            account_no: {
                required: true
            },
            account_name: {
                required: true
            },
            account_address: {
                required: true
            },
            contact_no: {
                required: true,
                number: true,
                minlength: 11,
                maxlength: 11
            }
        },
        // Messages for form validation
        messages: {
            account_no: {
                required: 'Please enter your account number'
            },
            account_name: {
                required: 'Please enter your account name'
            },
            account_address: {
                required: 'Please enter your address'
            },
            contact_no: {
                required: 'Please enter your contact no'
            }
        },
        submitHandler: function (form) {

            var myData = new FormData($("#create_new_account")[0]);

            $.ajax({
                url: BASE_URL + 'admin/account_settings/create_new_account_process',
                type: 'POST',
                data: myData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#loader').show();
                    $("#submit").prop('disabled', true); // disable button
                },
                success: function (data) {

                    if (data.type === 'success') {
                        notify_view(data.type, data.message)
                      //  $("#status").html(data.message);
                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $("#create_new_account")[0].reset();

                    } else if (data.type === 'danger') {
                        notify_view(data.type, data.message);
                        if(data.errors){
                            $.each(data.errors, function (key, val) {
                                $('#error_' + key).html(val);
                            });
                        }
                       // $("#status").html(data.message);
                        $('#loader').hide();
                        $("#submit").prop('disabled', false); // disable button
                        $("html, body").animate({scrollTop: 0}, "slow");

                    }
                }
            });
        }
        // <- end 'submitHandler' callback
    });                    // <- end '.validate()'

});         