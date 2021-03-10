function saveProductCategory() {
    var code = $('#productcategory_code').val().trim();
    var name = $('#productcategory_name').val().trim();


    $.ajax({
        url: './src/product_option_handler.php',
        type: 'POST',
        data: {'submit_type': 'productcategory', 'code': code, 'name': name},
        dataType: 'json',
        success: function (data) {
            console.log(data);
//            alert(JSON.stringify(data));
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'manage_product_category.php';
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
            alert('request faild >>> : ' + JSON.stringify(xhr) + " >> " + resp + " >> " + text);
        }

    });

}

function saveProductSubCategory() {
    var mcatid = $('#maincategorycombo').val().trim();
    if (mcatid === '') {
        alert('select product category form comobo box');
        return false;
        
    }
    var code = $('#productsubcategory_code').val().trim();
    var name = $('#productsubcategory_name').val().trim();


    $.ajax({
        url: './src/product_option_handler.php',
        type: 'POST',
        data: {'submit_type': 'productsubcategory', 'code': code, 'name': name, 'mcatid': mcatid},
        dataType: 'json',
        success: function (data) {
            console.log(data);
//            alert(JSON.stringify(data));
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'manage_product_category.php';
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
            alert('request faild >>> : ' + JSON.stringify(xhr) + " >> " + resp + " >> " + text);
        }

    });

}

function saveBrand() {
    var code = $('#brand_code').val().trim();
    var name = $('#brand_name').val().trim();


    $.ajax({
        url: './src/product_option_handler.php',
        type: 'POST',
        data: {'submit_type': 'productbrand', 'code': code, 'name': name},
        dataType: 'json',
        success: function (data) {
            console.log(data);
//            alert(JSON.stringify(data));
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'manage_product_brand.php';
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (xhr, resp, text) {
            console.log(xhr, resp, text);
            alert('request faild >>> : ' + JSON.stringify(xhr) + " >> " + resp + " >> " + text);
        }

    });

}
