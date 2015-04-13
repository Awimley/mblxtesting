"use strict"

var Mblx = window.Mblx || {};

Mblx.Destinations = Mblx.Destinations || {};

Mblx.Destinations.DataAccess = function() {
     var addDestination = function (bookingData) {
        var requestUri = "/Functions/destination/addDestination.php";

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

    var getDestinations = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/destination/getDestinations.php";

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
    var updateDestination = function(destinationID, name, activeStatus) {
        var requestUri = "/Functions/destination/updateDestinationData.php";
        var submitData = {
            destinationID: destinationID,
            name: name,
            active_status: activeStatus
        };

        var jsonSubmit = JSON.stringify(submitData);
        console.log(jsonSubmit);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",
            data: jsonSubmit
        });

        return deferred.promise();

    };
   

    return {
        getDestinations: getDestinations,
        addDestination: addDestination,
        updateDestination: updateDestination
       
    };
}();

Mblx.Origins = Mblx.Origins || {};

Mblx.Origins.DataAccess = function() {
     var addOrigin = function (bookingData) {
        var requestUri = "/Functions/origin/addOrigins.php";

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

    var getOrigins = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/origin/getOrigins.php";

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
    var deleteOrigin = function (originId) {
        var requestUri = "/Functions/origin/deleteOrigin.php";
        var submitData = {
            origin_id: originId

        };
        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };
    var updateOrigin = function (originId) {
        var requestUri = "/Functions/origin/updateOrigin.php";
        var submitData = {
            origin_id: originId
        };
        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();
    };

    return {
        getOrigins: getOrigins,
        deleteOrigin: deleteOrigin,
        addOrigin: addOrigin,
        updateOrigin: updateOrigin       
    };
}();