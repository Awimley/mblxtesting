"use strict"

var Mblx = window.Mblx || {};

Mblx.Services = Mblx.Services || {};

Mblx.Services.DataAccess = function() {
     var addService = function (bookingData) {
        var requestUri = "/Functions/services/addServices.php";

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

    var getServices = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/services/getServices.php";

        // create object for request headers
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }

        // send call across network
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });

        return deferred.promise();
    };
   

    return {
        getServices: getServices,
        addService: addService
       
    };
}();