jQuery(document).ready(function () {
    try {
        var data_button_list = document.getElementsByName('btn_update_product');
        for (var j = 0; j < data_button_list.length; j++) {
            var value_ = '';
            var action_ = '';
//            alert(data_button_list[j]['id']);
            $('#' + data_button_list[j]['id']).click(function () {
                try {
                    action_ = this['id'].split("_")[0];

                    if (this['id'] === 'updateproductcode_btn') {
                        value_ = $('#productcode').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductname_btn') {
                        value_ = $('#productname').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === "updateproductorder_btn") {
                        value_ = $('#productorder').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductshortdescription_btn') {
                        value_ = $('#productshortdescription').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductretailprice_btn') {
                        value_ = $('#productretailprice').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductwholesaleprice_btn') {
                        value_ = $('#productwholesaleprice').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductdealerprice_btn') {
                        value_ = $('#productdealerprice').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductspecdescription_btn') {
                        value_ = $('#productspecdescription').val();
                        updateProductSpec(action_, value_);
                    } else if (this['id'] === 'updateproductspecmodel_btn') {
                        value_ = $('#productspecmodel').val();
                        updateProductSpec(action_, value_);
                    } else if (this['id'] === 'updateproductspecfeatures_btn') {
                        value_ = $('#productspecfeatures').val();
                        updateProductSpec(action_, value_);
                    } else if (this['id'] === 'updateproductspecreleaseondate_btn') {
                        value_ = $('#productspecreleaseondate').val();
                        updateProductSpec(action_, value_);
                    } else if (this['id'] === 'updateproducttype_btn') {
                        value_ = $('#producttype').val();
                        updateProduct(action_, value_);
                    } else if (this['id'] === 'updateproductbrand_btn') {
                        value_ = $('#productbrand').val();
                        updateProduct(action_, value_);
                    }

                } catch (errr) {
                    alert(errr);
                }
            });
        }
    } catch (err) {
        alert(err);
    }
});


function updateProductImages(formid) {
    try {
       
        var formData = new FormData($('#' + formid)[0]);
//        alert(JSON.stringify(formData));
        $.ajax({
            url: "./src/product_image_control.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
//                            alert(JSON.stringify(data));
                var jsondata = JSON.parse(data)
                if (jsondata['data']['success']) {
                    alert(jsondata['data']['message']);
                } else {
                    alert(jsondata['data']['message']);
                }
            },
            error: function (e, v, c) {
                alert(e + " > " + v + " > " + c);
            }
        });

    } catch (err) {
        alert(err);
    }

}
