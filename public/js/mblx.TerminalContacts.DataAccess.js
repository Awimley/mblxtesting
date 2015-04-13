"use strict"

var Mblx = window.Mblx || {};

Mblx.TerminalContacts = Mblx.TerminalContacts || {};

Mblx.TerminalContacts.DataAccess = function() {
    var getTerminalContacts = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/terminal/getTerminalContacts.php";

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
        getTerminalContacts: getTerminalContacts
       
    };
}();