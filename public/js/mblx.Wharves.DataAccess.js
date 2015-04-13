"use strict"
var Mblx = window.Mblx || {};
Mblx.Wharves = Mblx.Wharves || {};
Mblx.Wharves.DataAccess = function () {
    var addWharf = function (submitData) {
        var requestUri = "/Functions/wharves/addWharf.php";


        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };
    var updateWharf = function (submitData) {
        var requestUri = "/Functions/wharves/updateWharf.php";


        var jsonSubmit = JSON.stringify(submitData);
        var deferred = $.ajax({
            url: requestUri,
            type: "POST",
            //contentType: "application/json;odata=verbose",

            data: jsonSubmit
        });

        return deferred.promise();

    };
    var getWharves = function () {
        var requestUri = "/Functions/wharves/getWharves.php";
        var requestHeaders = {
            "accept": "application/json;odata=verbose"
        }
        var deferred = $.ajax({
            url: requestUri,
            headers: requestHeaders
        });
        return deferred.promise();
    };
    return {
        addWharf: addWharf,
        updateWharf: updateWharf,
        getWharves: getWharves
    };
}();