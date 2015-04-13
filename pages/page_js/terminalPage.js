var terminalDB = TAFFY();
$(document).ready(function () {
    getTerminals();
    $("#btnTerminalModal_save").click(function (event) {
        event.preventDefault();
        alert("saving terminal");
        $("#terminalModal").modal('hide');
    });
    $("#btnDeleteTerminal").on('click', function (event) {
        event.preventDefault();
        var r = confirm("Are you sure you want to delete ?");
        if (r == true) {
            var thisTerminalId = $("#terminalModal").attr('data-current-terminalId');

            var promise = Mblx.Terminals.DataAccess.deleteTerminal(thisTerminalId);
            promise.then(onDeleteTerminalSuccess, onErrorFunction);
        } else {
            return true;
        }
        
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
        checkedServices = [];
    });
    $("#addTerminalButton").on('click', function (event) {
        event.preventDefault();
        $(".termModal").val('');
        $("#terminalModal").attr('data-current-terminalId', "new");
        $("#btnDeleteTerminal").addClass("hideMe");
        $("#terminalModal").modal('show');
    });
});

function getTerminals() {
    $.when($('#terminalTable').empty()).done(function () {
        var promise = Mblx.Terminals.DataAccess.getTerminals();
        promise.then(onGetTerminalsComplete, onErrorFunction);
    });
    
}
function onDeleteTerminalSuccess(dataz) {
    console.log(dataz);
    $("#terminalModal").modal('hide');
    getTerminals();
}
function onGetTerminalsComplete(dataz) {
    var data = dataz.data;
    var cities = {};

    //console.log(data);
    var listItemString = "";
    var bottomListItemString = "";
    jQuery.each(data, function (q, r) {
        terminalDB.insert(r);
        if (r.destination_city in cities) {
            cities[r.destination_city].push(r);
        } else {
            cities[r.destination_city] = [];
            cities[r.destination_city].push(r);
        }
            
       
        /*if (r.active_status == 1) {
            listItemString += '<tr data-terminal-id="' + r.id + '">';
            listItemString += '<td><button type="button" onclick="showTerminalModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
            listItemString += '<td>' + r.name + '</td>';
            listItemString += '<td>';
            listItemString +='<div class="checkbox"><label><input type="checkbox" checked></label></div>';
            listItemString += '</td>';
            listItemString += '</tr>';
        
        } else {
            bottomListItemString += '<tr data-terminal-id="' + r.id + '">';
            bottomListItemString += '<td><button type="button" onclick="showTerminalModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
            bottomListItemString += '<td>' + r.name + '</td>';
            bottomListItemString += '<td>';
            bottomListItemString += '<div class="checkbox"><label><input type="checkbox"></label></div>';
            bottomListItemString += '</td>';
            bottomListItemString += '</tr>';
        }*/
    });
    var citiesInThere = Object.keys(cities);
    citiesInThere.sort();
    var count = 0;
    var tableString = "";
    jQuery.each(citiesInThere, function (s, t) {
        count++;
        //console.log(t);
        var thisRow = count;
        var nodeString = '<tr class="treegrid-' + count + '"><td>' + '&nbsp;&nbsp;<span class="badge">' + t + '</span></td><td>&nbsp;</td><td>&nbsp;</td></tr>';
       // console.log(cities[t]);
        jQuery.each(cities[t], function (r, v) {
            count++;
            //console.log(r);
            //console.log(v);
            nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisRow + '"><td>' + v.name + '</td><td>' + v.contact_name + '</td><td><button type="button" onclick="showTerminalModal(' + v.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td></tr>';
        });
        tableString += nodeString;
    });
    //listItemString += bottomListItemString;
    //$("#terminalTbody").html(listItemString);
    //console.log(tableString);
    $("#terminalTable").append(tableString);
    $('.tree').treegrid({
        expanderExpandedClass: 'glyphicon glyphicon-arrow-down',
        expanderCollapsedClass: 'glyphicon glyphicon-plus',
        initialState: 'collapsed'
    });
}

function showTerminalModal(terminalID) {
    var selectedTerminalData = terminalDB({
        id: {
            is: terminalID
        }
    }).get();
    $("#terminalModal").attr('data-current-terminalId', terminalID);
    $("#inputTerminalModal_name").val(selectedTerminalData[0].name);
    $("#inputTerminalModal_contact_name").val(selectedTerminalData[0].contact_name);
    $("#inputTerminalModal_mile_point").val(selectedTerminalData[0].mile_point);
    $("#inputTerminalModal_river").val(selectedTerminalData[0].river);
    $("#inputTerminalModal_address").val(selectedTerminalData[0].address);
    $("#inputTerminalModal_city").val(selectedTerminalData[0].city);
    $("#inputTerminalModal_state").val(selectedTerminalData[0].state);
    $("#inputTerminalModal_zip").val(selectedTerminalData[0].zip_code);
    $("#inputTerminalModal_phone").val(selectedTerminalData[0].phone);
    $("#inputTerminalModal_fax").val(selectedTerminalData[0].fax);
    $("#inputTerminalModal_email").val(selectedTerminalData[0].email);
    $("#inputTerminalModal_notes").val(selectedTerminalData[0].notes);
    //console.log(selectedTerminalData[0]);

    $("#btnDeleteTerminal").removeClass("hideMe");
    $("#terminalModal").modal('show');
}
//
function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
}
