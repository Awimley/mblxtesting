"use strict"
var Mblx = window.Mblx || {};
Mblx.Equipment = Mblx.Equipment || {};
Mblx.Equipment.DataAccess = function() {
     var addEquipment = function (bookingData) {
        var requestUri = "/Functions/equpiment/addEquipment.php";

        var jsonSubmit = JSON.stringify(bookingData);
        console.log(bookingData);



        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };

    var getEquipment = function() {
        var requestUri = "/Functions/equipment/getEquipment.php";
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });
        return deferred.promise();
    };
    return {
        getEquipment: getEquipment,
        addEquipment: addEquipment
    };
}();