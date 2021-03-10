var manage_product_category = function () {
    var create_formproductcategory = function () {
        var _form = $('#form_product_category');
        var code = $('#productcategory_code').val();
        var name = $('#productcategory_name').val();
        _form.validate({
            rules: {
                productcategory_code: {
                    required: true,
                },
                productcategory_name: {
                    required: true,
                }
            },
            submitHandler: function (e) {
                $.ajax({
                    url: './src/manage_product_category.php',
                    type: 'POST',
                    data: {'submit_type': 'productcategory', 'code': code, 'name': name},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        try {
//                            alert(result['data']['success']);
                            $('#submit_alert_box_pcat').removeClass("hidden");
                            $('#submit_alert_box_pcat').addClass("show");
                            if (result['data']['success']) {
                                $('#submit_alert_box_pcat').addClass("alert-success");
                                $('#submit_alert_box_pcat').removeClass("alert-error");
                            } else {
                                $('#submit_alert_box_pcat').addClass("alert-error");
                                $('#submit_alert_box_pcat').removeClass("alert-success");
                            }
                            $('#from_data_submit_msg_pcat').html(result['data']['message']);
                        } catch (err) {
                            alert('err : ' + err)
                        }
                    },
                    error: function (xhr, resp, text) {
                        console.log(xhr, resp, text);
                        alert(resp);
                    }

                });
            }
        });
    };
    return{
        init:function(){
            create_formproductcategory();
        }
    }     
}();

jQuery(document).ready(function () {
    manage_product_category.init();
});

