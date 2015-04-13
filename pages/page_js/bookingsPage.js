var bookingsTableDB = TAFFY();

$(document).ready(function () {
    initialLoadTasks();
    var dateString = writeDate();

    $("#tableTitleSchedule").append(' - ' + dateString);

    $("#btnDeleteBooking").on('click', function () {
        //console.log('clicked');
        var currentId = $("#bookingModal").attr("data-current-bookingid");
        console.log(currentId);
    });
});

var initialLoadTasks = function () {
    getBookingsTableData();

}

function getBookingsTableData() {
    $.when($('#bookingsTableTbody').empty()).done(function () {
        var promise = Mblx.Bookings.DataAccess.getBookingsTableData();
        promise.then(getBookingsTableDataComplete, onErrorFunction);
    });
}

function writeDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    today = mm + '/' + dd + '/' + yyyy;
    return today;
}



function getBookingsTableDataComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    //console.log(data);
    jQuery.each(data, function (q, r) {
        var commod = r.commodities;

        if (commod.length > 1) {
            //console.log(commod.length);
            for (var i = 0; i < commod.length; i++) {
                listItemString += '<tr data-booking-id="' + r.id + '">';
                listItemString += '<td><a href="#" onclick="showBookingModal(' + r.id + ');" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
                listItemString += '<td>' + r.booking_company + '</td>';
                listItemString += '<td>' + r.booking_number + '</td>';
                listItemString += '<td>' + r.customer_name + '</td>';

                listItemString += '<td>' + r.commodities[i].piece_count + '</td>';
                listItemString += '<td>' + r.commodities[i].commodity_name + '</td>';
                listItemString += '<td>' + r.commodities[i].tonnage + '</td>';

                listItemString += '<td>' + r.agent_name + '</td>';
                listItemString += '<td>' + r.vessel_name + '</td>';
                listItemString += '<td>' + r.eta_date + '</td>';
                listItemString += '<td>' + r.wharf_name + '</td>';
                listItemString += '<td>' + r.stevedore_name + '</td>';
                listItemString += '<td>' + r.destination_name + '</td>';
                listItemString += '<td>' + r.terminal_name + '</td>';
                listItemString += '<td>' + r.service_name + '</td>';
              
                listItemString += '<td>' + getSelectStatusHtml(r.id, r.booking_status) + '</td>';
                listItemString += '</tr>';
            }
        } else {
            //console.log(r);
            listItemString += '<tr data-booking-id="' + r.id + '">';
            listItemString += '<td><a href="#" onclick="showBookingModal(' + r.id + ');" type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>';
            listItemString += '<td>' + r.booking_company + '</td>';
            listItemString += '<td>' + r.booking_number + '</td>';
            listItemString += '<td>' + r.customer_name + '</td>';

            listItemString += '<td>' + r.commodities[0].piece_count + '</td>';
            listItemString += '<td>' + r.commodities[0].commodity_name + '</td>';
            listItemString += '<td>' + r.commodities[0].tonnage + '</td>';

            listItemString += '<td>' + r.agent_name + '</td>';
            listItemString += '<td>' + r.vessel_name + '</td>';
            listItemString += '<td>' + r.eta_date + '</td>';
            listItemString += '<td>' + r.wharf_name + '</td>';
            listItemString += '<td>' + r.stevedore_name + '</td>';
            listItemString += '<td>' + r.destination_name + '</td>';
            listItemString += '<td>' + r.terminal_name + '</td>';
            listItemString += '<td>' + r.service_name + '</td>';
           
            listItemString += '<td>' + getSelectStatusHtml(r.id, r.booking_status) + '</td>';
            //listItemString += '<td><select id="statusSelect' + r.id + '"><option value="New">New</option><option value="Loading">Loading</option><option value="EnRoute">En Route</option><option value="Waiting">Waiting to Unload</option><option value="Complete">Complete</option></select></td>';
            listItemString += '</tr>';
        }
        bookingsTableDB.insert(r);
       
        //console.log(r.id);
        //$("#statusSelect" + r.id + " option[value=" + result + "]").attr('selected', 'selected');;
    });
    $.when($("#bookingsTableTbody").append(listItemString)).done(function () {
        $('#bookingsTable').DataTable({
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "/public/js/copy_csv_xls_pdf.swf"
            }
        });
    });
    // $("#contractLoadingGif").addClass('hideMe');
    // $("#theContainer").removeClass('hideMe');
    ////console.log(data);
}

function getSelectStatusHtml(id, status) {
    var result = status.replace(/\s/g, "");
    //console.log(result);
    var htmlString = '<select id="statusSelect' + id + '"> ';
    htmlString += (result == "New") ? '<option value="New" selected>New</option>' : '<option value="New">New</option>';
    htmlString += (result == "Loading") ? '<option value="Loading" selected>Loading</option>' : '<option value="Loading">Loading</option>';
    htmlString += (result == "EnRoute") ? '<option value="EnRoute" selected>En Route</option>' : '<option value="EnRoute">En Route</option>';
    htmlString += (result == "Waiting") ? '<option value="Waiting" selected>Waiting</option>' : '<option value="Waiting">Waiting</option>';
    htmlString += (result == "Complete") ? '<option value="Complete" selected>Complete</option>' : '<option value="Complete">Complete</option>';
    htmlString += '</select>';
    //console.log(htmlString);
    return htmlString;

}

function showBookingModal(bookingId) {

    var selectedBookingData = bookingsTableDB({
        id: {
            is: bookingId
        }
    }).get();
    ////console.log(selectedBookingData);
    var r = selectedBookingData[0];
    $("#btnDeleteBooking").removeClass('hideMe');
    $("#bookingModal").attr('data-current-bookingid', bookingId);

    $("#bookingModalLabel").html("Editing " + selectedBookingData[0].customer_name + ' ' + selectedBookingData[0].booking_number);
    /*$("#inputBookingModal_Booking_Company").val(selectedBookingData[0].booking_company);
    $("#inputBookingModal_Booking_Number").val(selectedBookingData[0].booking_number);
    $("#inputBookingModal_Customer").val(selectedBookingData[0].customer_name);
    $("#inputBookingModal_Quantity").val(selectedBookingData[0].commodities[0].piece_count);*/


    var statusSelectHtml = getSelectStatusHtml('Modal' + bookingId, r.booking_status);
    //'<select id="statusSelectModal' + r.id + '" "><option value="New">New</option><option value="Loading">Loading</option><option value="EnRoute">En Route</option><option value="Waiting">Waiting to Unload</option><option value="Complete">Complete</option></select></td>';
    $("#modalPanelBody").html(statusSelectHtml);
    //console.log(statusSelectHtml);

   // if (bookingId == 'New') {
        $("#bookingModal").modal('show');
   // }
}


function onErrorFunction(error) {
    //console.log("error performing operation");
    //console.log(error);
}