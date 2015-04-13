"use strict"

var Mblx = window.Mblx || {};

Mblx.Agents = Mblx.Agents || {};

Mblx.Agents.DataAccess = function () {
    var addAgent = function (bookingData) {
        var requestUri = "/Functions/agents/addAgent.php";

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

    var getAgents = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/agents/getAgents.php";

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
    
    var updateAgent = function() {
        var requestUri = "/Functions/agents/updateAgent.php";

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
    var deleteAgent = function() {

    };

    return {
        getAgents: getAgents,
        addAgent: addAgent,
        updateAgent: updateAgent,
        deleteAgent: deleteAgent
    };
}();