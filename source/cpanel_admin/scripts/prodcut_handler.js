var product_handler = function () {
    var boolean_flag_once;
    var handleform = function () {
        var datafrom = $('#uploadimage');

        datafrom.validate({
            rules: {
                pcode: {
                    required: true,
                },
                pname: {
                    required: true,
                },
                pbrand: {
                    required: true,
                },
                psubcategory: {
                    required: true,
                },
                ptype: {
                    required: true,
                },
                pretail_price: {
                    required: true,
                    number: true
                },
                pwholesale_price: {
                    required: true,
                    number: true
                },
                pdealer_price: {
                    required: true,
                    number: true,
                }
            },
            submitHandler: function (e) {
                try {
                    var formData = new FormData($('#uploadimage')[0]);
                    $("#message").empty();
                    $('#loading').show();
                    $.ajax({
                        url: "./src/product_handler.php", // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data)   // A function to be called if request succeeds
                        {
//                            alert(JSON.stringify(data));
                            var jsondata = JSON.parse(data)
                            $('#submit_alert_box').removeClass("hidden");
                            $('#submit_alert_box').addClass("show");

                            if (jsondata['data']['success']) {
                                $('#submit_alert_box').addClass("alert-success");
                                $('#submit_alert_box').removeClass("alert-danger");
                            } else {
                                $('#submit_alert_box').addClass("alert-danger");
                                $('#submit_alert_box').removeClass("alert-success");
                            }
                            $('#from_data_submit_msg').html(jsondata['data']['message']);
                        },
                        error: function (e, v, c) {

                            alert(e + " > " + v + " > " + c);
                        }
                    });
//                    }));

                } catch (err) {
                    alert(err);
                }

            }

        });
    };

    var showimge = function () {
        $("#file").change(function () {
            $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src', 'noimage.png');
                $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                return false;
            }
            else
            {
                var reader = new FileReader();
                reader.onload = imgeload;
                reader.readAsDataURL(this.files[0]);
            }
        });
    };

    var imgeload = function () {
        alert('.net');
        $("#file").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };

    return {
        init: function () {
            handleform();
            boolean_flag_once = true;
//            showimge();
//            imgeload();
        }
    };
}();


jQuery(document).ready(function () {
    product_handler.init();
});


//$(document).ready(function (e) {

//    $("#uploadimage").on('submit', (function (e) {
//        e.preventDefault();
//        $("#message").empty();
//        $('#loading').show();
//        $.ajax({
//            url: "./src/product_handler.php", // Url to which the request is send
//            type: "POST", // Type of request to be send, called as method
//            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//            contentType: false, // The content type used when sending data to the server.
//            cache: false, // To unable request pages to be cached
//            processData: false, // To send DOMDocument or non processed data file it is set to false
//            success: function (data)   // A function to be called if request succeeds
//            {
//                alert(data);
////                $('#loading').hide();
////                $("#message").html(data);
//            }
//        });
//    }));
//
//



//// Function to preview image after validation

//    

//});




//                    e.preventDefault();
//                $("#message").empty();
//                $('#loading').show();
//                    $.ajax({
//                        url: "./src/product_handler.php", // Url to which the request is send
//                        type: "POST", // Type of request to be send, called as method
//                        data: new FormData($('#save_product')), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
//                        contentType: false, // The content type used when sending data to the server.
//                        cache: false, // To unable request pages to be cached
//                        processData: false, // To send DOMDocument or non processed data file it is set to false
//                        success: function (data)   // A function to be called if request succeeds
//                        {
//                            alert('success__ :' + data);
////                        $('#submit_alert_box').removeClass("hidden");
//                            $('#submit_alert_box').addClass("show");
//                            if (result['data']['success']) {
//                                $('#submit_alert_box').addClass("alert-success");
//                                $('#submit_alert_box').removeClass("alert-danger");
//                            } else {
//                                $('#submit_alert_box').addClass("alert-danger");
//                                $('#submit_alert_box').removeClass("alert-success");
//                            }
//                            $('#from_data_submit_msg').html(result['data']['message']);
//                        },
//                        error: function (e, v, c) {
//                            alert('eroor__');
//                        }
//
//                    });