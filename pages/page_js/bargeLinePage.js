var bargeLineDB = TAFFY();

$(document).ready(function () {
    initialLoadTasks();
    $("#addBargeLineButton").click(function (event) {
        event.preventDefault();
        $("#bargeLineModal").attr('data-current-bargeLineId', 'new');
        $("#bargeLineModalLabel").text("Add New Barge Line");
        clearBargeLineModal();
        $('#bargeLineModal').modal('show');
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
        checkedServices = [];
    });
    $('#btnBargeModal_save').click(function () {
        var dataObj = new Object();

        dataObj.type = "BL";

        var currentId = $('#bargeLineModal').attr('data-current-bargelineid');

        dataObj.bargeLineName = $('#inputBargeLineModal_name').val();
        var inputBargeLineName = $('#inputBargeLineModal_name').val();
        var bargeLineSelect = bargeLineDB({
            name : inputBargeLineName
        }).select('id');
        
        dataObj.bargeLineID = currentId;
        dataObj.bargeLineContact = $('#inputBargeLineModal_contact').val();
        dataObj.bargeLineAddress = $('#inputBargeLineModal_address').val();
        dataObj.bargeLineCity = $('#inputBargeLineModal_city').val();
        dataObj.bargeLineState = $('#inputBargeLineModal_state').val();
        dataObj.bargeLineZip = $('#inputBargeLineModal_zip').val();
        dataObj.bargeLinePhone = $('#inputBargeLineModal_phone').val();
        dataObj.bargeLineFax = $('#inputBargeLineModal_fax').val();
        dataObj.bargeLineNotes = $('#inputBargeLineModal_notes').val();
        
        console.log(dataObj.bargeLineNotes);

        if (currentId == 'new') {
            console.log('this is a new barge line');
            var promise = Mblx.BargeLines.DataAccess.addBargeLine(dataObj);
            promise.then(onAddBargeLineComplete, onErrorFunction);
            console.log(dataObj);
        } else {

            //active is always going to be 1, needed for update function
            dataObj.active_status = 1;


            var promise = Mblx.BargeLines.DataAccess.updateBargeLine(dataObj);
            promise.then(onUpdateBargeLineComplete, onErrorFunction);
            console.log('edit barge line: ' + currentId);
            console.log(dataObj);
        }
        //console.log()
    });
});

function onUpdateBargeLineComplete (data) {
    console.log(data);
    alert('Updated A Barge Line');
    $('#bargeLineModal').modal('hide');
    $("#bargeLineTbody").empty();
    getBargeLines();
}

function onAddBargeLineComplete (data) {
    console.log(data);
    alert('Added A New Barge Line');
    $('#bargeLineModal').modal('hide');
    $("#bargeLineTbody").empty();
    getBargeLines();

}

function initialLoadTasks() {
    var promise = Mblx.BargeLines.DataAccess.getBargeLines();
    promise.then(onGetBargeLinesComplete, onErrorFunction);
    getBargeLines();

}

function getBargeLines() {
    var promise = Mblx.BargeLines.DataAccess.getBargeLines();
    promise.then(onGetBargeLinesComplete, onErrorFunction);
}

function clearBargeLineModal() {
    $("#selectBargeLineModal_name").val('');
    $("#selectBargeLineModal_contact").val('');
    $("#selectBargeLineModal_address").val('');
    $("#selectBargeLineModal_city").val('');
    $("#selectBargeLineModal_state").val('');
    $("#selectBargeLineModal_zip").val('');
    $("#selectBargeLineModal_phone").val('');
    $("#selectBargeLineModal_fax").val('');
    $("#selectBargeLineModal_notes").val('');

    $("#bargeLineModalDraftTbody").empty();

    $("#inputBargeLineModal_name").val('');
    $("#inputBargeLineModal_contact").val('');
    $("#inputBargeLineModal_address").val('');
    $("#inputBargeLineModal_city").val('');
    $("#inputBargeLineModal_state").val('');
    $("#inputBargeLineModal_zip").val('');
    $("#inputBargeLineModal_phone").val('');
    $("#inputBargeLineModal_fax").val('');
    $("#inputBargeLineModal_notes").val('');

}

function onGetBargeLinesComplete(dataz) {

    var data = dataz.data;
    
    data.sort(function (a, b) {
        if (a.name > b.name) {
            return 1;
        }
        if (a.name < b.name) {
            return -1;
        }
        return 0;
    });

 console.log(data);
    
    var listItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {

        bargeLineDB.insert(r);

        listItemBuildConter++;
        listItemString += '<tr> \
                    <td><button type="button" onClick="showBargeLineModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                    <td>' + r.name + '</td> \
                   <td>' + r.contact + '</td> \
                   <td>' + r.address + '</td> \
                   <td>' + r.city + '</td> \
                   <td>' + r.state + '</td> \
                   <td>' + r.zip + '</td> \
                                </tr>';
    });

    $("#bargeLineTbody").append(listItemString);
}

function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
}

function showBargeLineModal(bargeLineId) {
    clearBargeLineModal();
    var selectedBargeLineData = bargeLineDB({
        id: {
            is: bargeLineId
        }
    }).get();
        var bargeLineName = stripQuotesAndWhitespace(selectedBargeLineData[0].name);

        $("#bargeLineModal").attr('data-current-bargelineid', bargeLineId);
        $("#bargeLineModalLabel").text("Editing: " + selectedBargeLineData[0].name);

        $("#selectBargeLineModal_name").val(bargeLineName);    

        $('#inputBargeLineModal_name').val(bargeLineName);
        $('#inputBargeLineModal_contact').val(stripQuotesAndWhitespace(selectedBargeLineData[0].contact));
        $('#inputBargeLineModal_address').val(selectedBargeLineData[0].address);
        $('#inputBargeLineModal_city').val(selectedBargeLineData[0].city);
        $('#inputBargeLineModal_state').val(selectedBargeLineData[0].state);
        $('#inputBargeLineModal_zip').val(selectedBargeLineData[0].zip);
        $('#inputBargeLineModal_phone').val(selectedBargeLineData[0].phone);
        $('#inputBargeLineModal_fax').val(selectedBargeLineData[0].fax);
        $('#inputBargeLineModal_notes').val(selectedBargeLineData[0].notes);

        //placeholder draft data
        var draftDataSample = [10, 11, 12];
        $('#inputDraftFeet').val(draftDataSample[0]);
        $('#inputDraftInches').val(draftDataSample[1]);
        $('#inputDraftTonnage').val(draftDataSample[2]);

        $('#bargeLineModal').modal('show');
    
    }

    var initialLoadTasks = function () {
        getBargeLines();
    }

