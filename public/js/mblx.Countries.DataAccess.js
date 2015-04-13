"use strict"

var Mblx = window.Mblx || {};

Mblx.Countries = Mblx.Countries || {};

Mblx.Countries.DataAccess = function () {
     var addCountries = function (bookingData) {
        var requestUri = "/Functions/countries/addCountries.php";

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

    var getCountries = function () {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/countries/getCountries.php";

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
        getCountries: getCountries,
        addCountries: addCountries
    };
}();