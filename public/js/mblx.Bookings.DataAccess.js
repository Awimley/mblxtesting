"use strict"

var Mblx = window.Mblx || {};

Mblx.Bookings = Mblx.Bookings || {};

Mblx.Bookings.DataAccess = function () {
    var getBookings = function () {
        // parse target URI for customer list in app web
        var requestUri = "/Functions/bookings/getBookings.php";

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

    var getBookingsTableData = function () {
        // parse target URI for customer list in app web
        var requestUri = "/Functions/bookings/getBookingsTableData.php";

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
   

    var addBooking = function (bookingData) {
        var requestUri = "/Functions/bookings/addBooking.php";

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
    return {
        getBookings: getBookings,
        getBookingsTableData: getBookingsTableData,
        addBooking: addBooking
    };
}();