"use strict"

var Mblx = window.Mblx || {};

Mblx.BargeLines = Mblx.BargeLines || {};

Mblx.BargeLines.DataAccess = function () {
        var addBargeLine = function (bookingData) {
        var requestUri = "/Functions/barge_lines/addBargeLines.php";

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

    var getBargeLines = function () {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/barge_lines/getBargeLines.php";

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
    var updateBargeLine = function (bookingData) {
        var requestUri = "/Functions/barge_lines/updateBargeLines.php";

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

    return {
        getBargeLines: getBargeLines,
        addBargeLine: addBargeLine,
        updateBargeLine: updateBargeLine
    };
}();