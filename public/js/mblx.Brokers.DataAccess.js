"use strict"

var Mblx = window.Mblx || {};

Mblx.Brokers = Mblx.Brokers || {};

Mblx.Brokers.DataAccess = function() {
        var addBrokers = function (bookingData) {
        var requestUri = "/Functions/brokers/addBrokers.php";

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

    var getBrokers = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/brokers/getBrokers.php";

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
    var updateBroker = function(data) {
    var requestUri = "/Functions/brokers/updateBroker.php";

        var jsonSubmit = JSON.stringify(bookingData);
        console.log(bookingData);



        var deferred = $.ajax({
            url: requestUri,
            type: "POST",

            data: jsonSubmit
        });

        return deferred.promise();
    }

    return {
        getBrokers: getBrokers,
        addBrokers: addBrokers,
        updateBroker: updateBroker
       
    };
}();