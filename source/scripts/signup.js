var signup = function () {
    var handleform = function () {
        var form_ = $('#signupForm');

        form_.validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                dob_days: {
                    required: true,
                },
                dob_month: {
                    required: true,
                },
                dob_year: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
                password_cmf: {
                    required: true,
                    equalTo: '#password',
                },
                address_no: {
                    required: true,
                },
                address_line1: {
                    required: true,
                },
                address_line2: {
                    required: true,
                },
                address_line3: {
                    required: true,
                },
                postcode: {
                    required: true,
                },
                mobile_phone: {
                    required: true,
                }
            },
            submitHandler: function (form) {
//                    form.submit();
//                process the form

                $.ajax({
                    url: './src/scripts/signup.php', // url where to submit the request
                    type: "POST", // type of action POST || GET
                    dataType: 'json', // data type
                    data: form_.serialize(), // post data || get data
                    success: function (result) {
                        // you can see the result from the console
                        // tab of the developer tools
                        console.log(result);
                        try {
//                            alert(result['data']['success']);
                            $('#submit_alert_box').removeClass("hidden");
                            $('#submit_alert_box').addClass("show");
                            if (result['data']['success']) {
                                $('#submit_alert_box').addClass("alert-success");
                                $('#submit_alert_box').removeClass("alert-error");
                            } else {
                                $('#submit_alert_box').addClass("alert-error");
                                $('#submit_alert_box').removeClass("alert-success");
                            }
                            $('#from_data_submit_msg').html(result['data']['message']);
                        } catch (err) {
                            alert('err : ' + err)
                        }
                    },
                    error: function (xhr, resp, text) {
                        console.log(xhr, resp, text);
                        alert(resp);
                    }
                });


                // stop the form from submitting the normal way and refreshing the page
//                    form.preventDefault();
            },
        });

    };

    return {
        init: function () {
            handleform();
        }
    };
}();

jQuery(document).ready(function () {
    signup.init();
});