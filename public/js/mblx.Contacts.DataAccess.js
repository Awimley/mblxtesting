"use strict"

var Mblx = window.Mblx || {};

Mblx.Contacts = Mblx.Contacts || {};

Mblx.Contacts.DataAccess = function () {
    /*var getCustomers = function() {
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
    };*/
    var addContact = function (custId, newContactName, newContactPhone, newContactEmail) {
        var requestUri = "/Functions/contact/addContact.php";
        var submitData = {
            id: custId,
            name: newContactName,
            phone: newContactPhone,
            email: newContactEmail
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

    var editContact = function (contId, newContactName, newContactPhone, newContactEmail) {
        var requestUri = "/Functions/contact/updateContact.php";
        var submitData = {
            id: contId,
            name: newContactName,
            phone: newContactPhone,
            email: newContactEmail
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

    var deleteContact = function (contId) {
        var requestUri = "/Functions/contact/deleteContact.php";
        var submitData = {
            id: contId
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
        addContact: addContact,
        editContact: editContact,
        deleteContact: deleteContact

    };
}();