var destinationDB = TAFFY();

$(function () {
    $("#btnAddDestination").click(function (event) {
        event.preventDefault();
        $("#destinationModal").attr('data-current-destinationid', 'new');
        clearDestinationModal();
        $('#destinationModal').modal('show');
    });

    getDestinations();



    $("#btnDestinationModal_save").click(function () {
        var dataObj = new Object();
        dataObj.type = "DEST";

        var currentId = $("#destinationModal").attr('data-current-destinationid');
        destinationName = $("#inputDestinationModal_name").val();

        var destSelect = destinationDB({
            name: destinationName
        }).select("id");

        if ($('#radioActive').attr('checked') == true) {
            dataObj.activeStatus = 1;
        } else {
            dataObj.activeStatus = 0;
        }
            

        dataObj.destinationId = currentId;
        dataObj.name = destinationName;

        if (currentId == "new") {

            console.log("new destination");
            var promise = Mblx.Destinations.DataAccess.addDestination(dataObj);
            promise.then(onAddDestinationComplete, onErrorFunction);
            console.log(dataObj);
        } else {
            var promise = Mblx.Destinations.DataAccess.updateDestination(dataObj);
            promise.then(onUpdateDestinationComplete, onErrorFunction);

            console.log("editing destination " + currentId);
            console.log(dataObj);
        }
    });

    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
    });

    
});
        
function getDestinations() {

    // clear results and add spinning gears icon
    $.when($('#destinationTableBody').empty()).done(function () {
        var promise = Mblx.Destinations.DataAccess.getDestinations();
        // use promise to implement what happens when OData result is ready
        promise.then(onGetDestinationsComplete, onErrorFunction);
    });

    // call view-model function which returns promise
}


function clearDestinationModal() {
    $("#inputDestinationModal_name").val('');
    $("#inputDestinationModal_active").val('');
}

function onGetDestinationsComplete(dataz) {
    var data = dataz.data;

    var listItemString = "";
    //var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {
        ////console.log(q);
        destinationDB.insert(r);


        listItemString += '<tr data-dest-id="' + r.id + '"><td><a href="#" onClick="showDestinationModal(' + r.id + ')"><span class="glyphicon glyphicon-pencil pull-left"></span></a></td>';
        listItemString += '<td>' + r.name + '</td></tr>';


        ////console.log(r);
    });
    ////console.log(listItemString);
    $("#destinationTableBody").append(listItemString);
    console.log(data);
}

function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
    //location.reload();
}
function showDestinationModal(destinationID) {
    clearDestinationModal();
    var selectedDestinationData = destinationDB({
        id: {
            is: parseInt(destinationID)
        }
    }).get();
    console.log(selectedDestinationData);
    var destinationName = stripQuotesAndWhitespace(selectedDestinationData[0].name);

    $('#inputDestinationModal_name').val(destinationName);
    $('#inputDestinationModal_active_status').val(selectedDestinationData[0].active);
    if (selectedDestinationData[0].active == 1) {
        $('#radioActive').attr('checked', 'checked');
    } else {
        $('#radioInactive').attr('checked', 'checked');
    }

    $("#destinationModal").attr('data-current-commodityid', destinationID);
    //placeholder draft data

    $('#destinationModal').modal('show');
}

function onAddDestinationComplete() {
    console.log('we added a destination!');
    $("#destinationModal").hide();
}