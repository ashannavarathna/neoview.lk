// ===================>>>
//    $.post('../src/controls/JsonListControler.php', {
//        id: id,
//        action: 'getProductSubCatList'
//
//    }, function (data) {
//        alert('found : ' + data + " ff " + JSON.stringify(data.length));
//        $("#psubcategory").empty();
//        var txt = "";
//        txt = txt + "  <option value=''>Select</option>";
//        for (var k = 0; k < data.length; k++) {
//            txt = txt + "  <option value='" + data[k].id + "'>" + data[k].value + "</option>";
//        }
//        $("#psubcategory").append(txt);
//
//    }, 'json');

//==========================>>>>>>>>


function getProductSubCatByProductCatId() {
    var id = $('#pcategory').val();
    $.ajax({
        url: "../src/controls/JsonListControler.php",
        type: "POST",
        data: {'id': id, 'action': 'getProductSubCatList'},
        dataType: 'json',
        success: function (data) {
            $("#psubcategory").empty();
            var txt = "";
            txt = txt + "  <option value=''>-Select Sub Category-</option>";
            for (var k = 0; k < data.length; k++) {
                txt = txt + "  <option value='" + data[k].id + "'>" + data[k].value + "</option>";
            }
            $("#psubcategory").append(txt);
        },
        error: function () {
            alert('no data found');
        }
    });




}