"use strict"

var Mblx = window.Mblx || {};

Mblx.Destinations = Mblx.Destinations || {};

Mblx.Destinations.DataAccess = function () {
    var addDestination = function (data) {
        var requestUri = "/Functions/destinations/addDestinationData.php";

        var jsonSubmit = JSON.stringify(data);
        console.log(data);



        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();
    };

    var getDestinations = function () {

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

    var deleteDestination = function(destinationID) {
      console.log('deleting: ' + destinationID)
    }

    return {
        getDestinations: getDestinations,
        addDestination: addDestination,
        updateDestination: updateDestination
    };
}();