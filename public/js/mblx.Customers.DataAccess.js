"use strict"

var Mblx = window.Mblx || {};

Mblx.Customers = Mblx.Customers || {};

Mblx.Customers.DataAccess = function() {
    var getCustomers = function() {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/customer/getCustomerPageData.php";

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
    var getCustomerContacts = function(custId) {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/customer/getCustomerContacts.php";
        var submitData = {
            custId: custId
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
    var addCustomer = function(custCode, custName, custPhone, custFax, custAddress, custCity, custState, custPost, custCountry, custEmail) {
        var requestUri = "/Functions/customer/addCustomer.php";
        var submitData = {
            code: custCode,
            name: custName,
            phone: custPhone,
            fax: custFax,
            address: custAddress,
            city: custCity,
            state: custState,
            postCode: custPost,
            country: custCountry,
            email: custEmail
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

    var updateCustomer = function(custId, custCode, custName, custPhone, custFax, custAddress, custCity, custState, custPost, custCountry, custEmail, activeStatus) {
        var requestUri = "/Functions/customer/updateCustomerData.php";
        var submitData = {
            custId: custId,
            code: custCode,
            name: custName,
            phone: custPhone,
            fax: custFax,
            address: custAddress,
            city: custCity,
            state: custState,
            postCode: custPost,
            country: custCountry,
            email: custEmail,
            active_status: activeStatus
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

    var deleteCustomer = function(custId) {
        var requestUri = "/Functions/customer/deleteCustomer.php";
        var submitData = {
            custId: custId

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
        getCustomers: getCustomers,
        getCustomerContacts: getCustomerContacts,
        addCustomer: addCustomer,
        updateCustomer: updateCustomer,
        deleteCustomer: deleteCustomer
    };
}();