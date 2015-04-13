var wharfDB = TAFFY();
$(document).ready(function () {
    getWharves();
    $("#btnWharfModal_save").click(function (event) {
        event.preventDefault();
        var currentId = $("#wharfModal").attr('data-current-wharfid');

        var wharfName = $("#inputWharfModal_name").val();
        var milePoint = $("#inputWharfModal_mile_point").val();
        var city = $("#inputWharfModal_city").val();
        var state = $("#inputWharfModal_state").val();
        var notes = $("#inputWharfModal_notes").val();

        var dataToSend = new Object();

        dataToSend.name = wharfName;
        dataToSend.mile_point = parseFloat(milePoint);
        dataToSend.city = city;
        dataToSend.state = state;
        dataToSend.notes = notes;

        if (currentId == "new") {

            console.log("new wharf");
            var promise = Mblx.Wharves.DataAccess.addWharf(dataToSend);
            promise.then(onUpdateAddorDeleteWharfComplete, onErrorFunction);
            console.log(dataToSend);
        } else {

            dataToSend.wharf_id = currentId;
            console.log("editing wharf " + currentId);
            var promise = Mblx.Wharves.DataAccess.updateWharf(dataToSend);
            promise.then(onUpdateAddorDeleteWharfComplete, onErrorFunction);
            console.log(dataToSend);
        }

        
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
        checkedServices = [];
    });
    $("#btnDeleteWharf").on('click', function (event) {
        event.preventDefault();
        var r = confirm("Are you sure you want to delete ?");
        if (r == true) {
            var thisWharfId = $("#wharfModal").attr('data-current-wharfid');

            var promise = Mblx.Wharves.DataAccess.deleteWharf(thisWharfId);
            promise.then(onDeleteWharfSuccess, onErrorFunction);
        } else {
            return true;
        }

    });
    $("#addWharfButton").on('click', function (event) {
        event.preventDefault();
        $(".wharfModal").val('');
        $("#wharfModal").attr('data-current-wharfId', "new");
        $("#btnDeleteWharf").addClass("hideMe");
        $("#wharfModal").modal('show');
    });
});

function getWharves() {
    $.when($('#wharfTable').empty()).done(function () {
        var promise = Mblx.Wharves.DataAccess.getWharves();
        promise.then(onGetWharvesComplete, onErrorFunction);
    });

}



function onUpdateAddorDeleteWharfComplete(dataz) {
    alert("Changes Saved");
    var data = dataz.status;
    console.log(data);
    if (data == "okay") {
        //alert('created new contract');
        $.when(getWharves()).done(function () {
            $("#wharfModal").modal('hide');
        });

    }
}

function onGetWharvesComplete(dataz) {
    var data = dataz.data;
    var cities = {};

    //console.log(data);
    var listItemString = "";
    var bottomListItemString = "";
    jQuery.each(data, function (q, r) {
        wharfDB.insert(r);
        if (r.city in cities) {
            cities[r.city].push(r);
        } else {
            cities[r.city] = [];
            cities[r.city].push(r);
        }


        /*if (r.active_status == 1) {
            listItemString += '<tr data-wharf-id="' + r.id + '">';
            listItemString += '<td><button type="button" onclick="showWharfModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
            listItemString += '<td>' + r.name + '</td>';
            listItemString += '<td>';
            listItemString +='<div class="checkbox"><label><input type="checkbox" checked></label></div>';
            listItemString += '</td>';
            listItemString += '</tr>';
        
        } else {
            bottomListItemString += '<tr data-wharf-id="' + r.id + '">';
            bottomListItemString += '<td><button type="button" onclick="showWharfModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
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
            nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisRow + '"><td>' + v.name + '</td><td>' + v.mile_point + '</td><td><button type="button" onclick="showWharfModal(' + v.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td></tr>';
        });
        tableString += nodeString;
    });
    //listItemString += bottomListItemString;
    //$("#wharfTbody").html(listItemString);
    //console.log(tableString);
    $("#wharfTable").append(tableString);
    $('.tree').treegrid({
        expanderExpandedClass: 'glyphicon glyphicon-minus',
        expanderCollapsedClass: 'glyphicon glyphicon-plus',
        initialState: 'collapsed'
    });
}

function showWharfModal(wharfID) {
    var selectedWharfData = wharfDB({
        id: {
            is: wharfID
        }
    }).get();
    $("#wharfModal").attr('data-current-wharfId', wharfID);
    $("#inputWharfModal_name").val(selectedWharfData[0].name);
    $("#inputWharfModal_contact_name").val(selectedWharfData[0].contact_name);
    $("#inputWharfModal_mile_point").val(selectedWharfData[0].mile_point);
    $("#inputWharfModal_river").val(selectedWharfData[0].river);
    $("#inputWharfModal_address").val(selectedWharfData[0].address);
    $("#inputWharfModal_city").val(selectedWharfData[0].city);
    $("#inputWharfModal_state").val(selectedWharfData[0].state);
    $("#inputWharfModal_zip").val(selectedWharfData[0].zip_code);
    $("#inputWharfModal_phone").val(selectedWharfData[0].phone);
    $("#inputWharfModal_fax").val(selectedWharfData[0].fax);
    $("#inputWharfModal_email").val(selectedWharfData[0].email);
    $("#inputWharfModal_notes").val(selectedWharfData[0].notes);
    //console.log(selectedWharfData[0]);

    $("#btnDeleteWharf").removeClass("hideMe");
    $("#wharfModal").modal('show');
}
//
function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
}