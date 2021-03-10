function managePriceListFormControls(formid, EntryType) {
    try {


        var formData = new FormData($('#' + formid)[0]);
//        alert(JSON.stringify(formData));
        formData.append("EntryType", EntryType);
        $.ajax({
            url: "./src/price_list_control.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
//                alert(JSON.stringify(data));
                var jsondata = JSON.parse(data);
                if (jsondata['data']['success']) {
                    alert(jsondata['data']['message']);
                    window.location.href = "manage_price_list.php";
                } else {
                    alert(jsondata['data']['message']);
                }
            },
            error: function (e, v, c) {
                alert('err');
                alert(e + " > " + v + " > " + c);
            }
        });

    } catch (err) {
        alert(err);
    }

}

function updateProductImages(formid) {
    try {

        var formData = new FormData($('#' + formid)[0]);
//        alert(JSON.stringify(formData));
        $.ajax({
            url: "./src/price_list_control.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                alert(JSON.stringify(data));
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