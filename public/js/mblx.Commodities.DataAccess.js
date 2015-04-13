"use strict"

var Mblx = window.Mblx || {};

Mblx.Commodities = Mblx.Commodities || {};

Mblx.Commodities.DataAccess = function() {
    var addCommodity = function (data) {
        var requestUri = "/Functions/commodities/addCommodities.php";

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

    var getCommodities = function() {
        // parse target URI for Commoditie list in app web

        //////////////////////var requestUri = "/Functions/getCommoditieData.php";
        var requestUri = "/Functions/commodities/getCommodities.php";

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

    var updateCommodity = function () {
        var requestUri = "/Functions/commodities/updateCommodity.php";

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
        getCommodities: getCommodities,
        addCommodity: addCommodity,
        updateCommodity: updateCommodity
    };
}();