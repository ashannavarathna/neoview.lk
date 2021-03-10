function changeproductfeaturedstatus(id, value) {
    var action = "changeprodcutreafuredsatus";
//    alert(id + " >> " + value + " >>>");
    $.ajax({
        url: "../src/controls/JsonAction.php",
        type: "POST",
        data: {'id': id, 'value': value, 'action': action},
        dataType: 'json',
        success: function (data) {
//            alert('success');
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'product_list.php';
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (param1, param2, param3) {
            alert('request faild >>> : ' + JSON.stringify(param1) + " >> " + param2 + " >> " + param3);
        }
    });
}

function removeProduct(id) {
    var action = "removeproduct";
    var value = '';
//    alert(id + " >> " + value + " >>>");
    $.ajax({
        url: "../src/controls/JsonAction.php",
        type: "POST",
        data: {'id': id, 'action': action, 'value': value},
        dataType: 'json',
        success: function (data) {
//            alert('success');
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'product_list.php';
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (param1, param2, param3) {
            alert('request faild >>> : ' + JSON.stringify(param1) + " >> " + param2 + " >> " + param3);
        }
    });
}

function updateProduct(action_, value_) {
    var id = $('#productid_').val();
//    alert(value_);
//    if (!value) {
//        alert('value is not valid!');
//        return false;
//    } else {
//        alert('value ok');
//        return false;
//    }
    $.ajax({
        url: "../src/controls/JsonAction.php",
        type: "POST",
        data: {'id': id, 'action': action_, 'value': value_},
        dataType: 'json',
        success: function (data) {
//            alert('success');
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'product_management.php?pid=' + id;
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (param1, param2, param3) {
            alert('request faild >>> : ' + JSON.stringify(param1) + " >> " + param2 + " >> " + param3);
        }
    });
}
function updateProductStatus(id, value) {
    try {
        var action = 'updateproductstatus';
        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'product_list.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (Error) {
        alert(Error);
    }

}



function updateProductSpec(action_, value_) {
    var id = $('#productspecid_').val(); // product spec id for update data
    var pid = $('#productid_').val(); // product id for reload page
//    alert(value_ + " >> " + action_);

//    if (!value) {
//        alert('value is not valid!');
//        return false;
//    } else {
//        alert('value ok');
//        return false;
//    }
    $.ajax({
        url: "../src/controls/JsonAction.php",
        type: "POST",
        data: {'id': id, 'action': action_, 'value': value_},
        dataType: 'json',
        success: function (data) {
//            alert('success');
            if (data['data']['success']) {
                alert(data['data']['message']);
                window.document.location.href = 'product_management.php?pid=' + pid;
            } else {
                alert(data['data']['message']);
            }

        },
        error: function (param1, param2, param3) {
            alert('request faild >>> : ' + JSON.stringify(param1) + " >> " + param2 + " >> " + param3);
        }
    });
}


function updateProductCategory(id) {
    try {
        var code = $('#productmaincatcode_' + id).val().trim();
        var name = $('#productmaincatname_' + id).val().trim();
        var action = "updatemaincategory";
        var value = '';

        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'code': code, 'name': name, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_category.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (error) {
        alert(error);
    }
}

function removeMainCategory(id) {
    try {
        var value = '';
        var action = 'removemaincategory';
        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_category.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (Error) {
        alert(Error);
    }
}

function updateProductSubCategory(id) {
    try {
        var code = $('#productsubcatcode_' + id).val().trim();
        var name = $('#productsubcatname_' + id).val().trim();
        var action = "updateproductsubcategory";
        var value = '';

        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'code': code, 'name': name, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_category.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (error) {
        alert(error);
    }
}

function removeSubCategory(id) {
    try {
        var value = '';
        var action = 'removeproductsubcategory';
        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_category.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (Error) {
        alert(Error);
    }
}

function updateProductBrand(id) {
    try {
        var code = $('#productbrandcode_' + id).val().trim();
        var name = $('#productbrandname_' + id).val().trim();
        var action = "updateproductbrand";
        var value = '';

        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'code': code, 'name': name, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_brand.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (error) {
        alert(error);
    }
}

function removeProductBrand(id) {
    try {
        var value = '';
        var action = 'removeproductbrand';
        $.ajax({
            url: "../src/controls/JsonAction.php",
            type: "POST",
            data: {'id': id, 'action': action, 'value': value},
            dataType: 'json',
            success: function (data) {
//            alert('success');
                if (data['data']['success']) {
                    alert(data['data']['message']);
                    window.document.location.href = 'manage_product_brand.php';
                } else {
                    alert(data['data']['message']);
                }

            }
        });

    } catch (Error) {
        alert(Error);
    }
}

