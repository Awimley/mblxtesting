"use strict"

var Mblx = window.Mblx || {};

Mblx.Contracts = Mblx.Contracts || {};

Mblx.Contracts.DataAccess = function () {
    var getContracts = function (customerSwtich) {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = (customerSwtich) ? "/Functions/contracts/getContracts.php?type=CUST" : "/Functions/contracts/getContracts.php?type=CON";
       

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
    var addContract = function (submitData) {
        var requestUri = "/Functions/contracts/addContract.php";
      

        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };
    var getContractCommodities = function () {
        // parse target URI for customer list in app web

        //////////////////////var requestUri = "/Functions/getCustomerData.php";
        var requestUri = "/Functions/contracts/getContractCommodities.php";


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
        getContracts: getContracts,
        getContractCommodities: getContractCommodities,
        addContract: addContract

    };
} ();