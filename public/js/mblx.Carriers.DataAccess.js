"use strict"
var Mblx = window.Mblx || {};
Mblx.Carriers = Mblx.Carriers || {};
Mblx.Carriers.DataAccess = function() {
        var addCarrier = function (bookingData) {
        var requestUri = "/Functions/carriers/addCarrier.php";

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

    var getCarriers = function() {
        var requestUri = "/Functions/carriers/getCarriers.php";
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });
        return deferred.promise();
    };

    var updateCarrier = function() {
        var requestUri = "/Functions/carriers/updateCarrier.php";
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });
        return deferred.promise();
    };

    var deleteCarrier = function() {

    };

    return {
        addCarrier: addCarrier,
        getCarriers: getCarriers,
        updateCarrier: updateCarrier,
        deleteCarrier: deleteCarrier
    };
}();