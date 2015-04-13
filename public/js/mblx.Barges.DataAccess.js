"use strict"

var Mblx = window.Mblx || {};

Mblx.Barges = Mblx.Barges || {};

Mblx.Barges.DataAccess = function () {
    var addBarge = function (submitData) {
        var requestUri = "/Functions/barges/addBarge.php";


        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };
    var getBarges = function () {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/barges/getBarges.php";

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

    var getBargeTypes = function () {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/barges/getBargeTypes.php";

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
        addBarge: addBarge,
        getBarges: getBarges,
        getBargeTypes: getBargeTypes

    };
}();