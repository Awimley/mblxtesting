"use strict"
var Mblx = window.Mblx || {};
Mblx.Terminals = Mblx.Terminals || {};
Mblx.Terminals.DataAccess = function() {
     var addTerminal = function (bookingData) {
        var requestUri = "/Functions/terminal/addTerminal.php";

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

    var getTerminals = function() {
        var requestUri = "/Functions/terminal/getTerminals.php";
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });
        return deferred.promise();
    };
    var deleteTerminal = function (terminalId) {
        var requestUri = "/Functions/terminal/deleteTerminal.php";
        var submitData = {
            id: terminalId
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
        getTerminals: getTerminals,
        deleteTerminal: deleteTerminal,
        addTerminal: addTerminal
    };
}();