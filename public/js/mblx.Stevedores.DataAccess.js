"use strict"
var Mblx = window.Mblx || {};
Mblx.Stevedores = Mblx.Stevedores || {};
Mblx.Stevedores.DataAccess = function () {
     var addStevedore = function (bookingData) {
        var requestUri = "/Functions/stevedores/addStevedores.php";

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

    var getStevedores = function () {
        var requestUri = "/Functions/stevedores/getStevedores.php";
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
        getStevedores: getStevedores,
        addStevedore: addStevedore
    };
}();