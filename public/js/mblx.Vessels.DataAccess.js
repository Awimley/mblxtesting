"use strict"

var Mblx = window.Mblx || {};

Mblx.Vessels = Mblx.Vessels || {};

Mblx.Vessels.DataAccess = function() {
    var getVessels = function() {
        // parse target URI for customer list in app web
        var requestUri = "/Functions/getVesselData.php";

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
    var getVesselTrips = function() {
        // parse target URI for customer list in app web
        var requestUri = "/Functions/vessel_trip/getVesselTripData.php";

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
    var addVessel = function(vesselName) {
        var requestUri = "/Functions/postVesselData.php";
        var submitData = {
            name: vesselName
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
    var addVesselTrip = function(vesselTripData) {
        var requestUri = "/Functions/vessel_trip/addVesselTrip.php";
        
        var jsonSubmit = JSON.stringify(vesselTripData);
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
        getVessels: getVessels,
        getVesselTrips: getVesselTrips,
        addVessel: addVessel,
        addVesselTrip: addVesselTrip
    };
}();