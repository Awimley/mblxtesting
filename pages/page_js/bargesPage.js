
var bargeDB = TAFFY();
var bargeLineDB = TAFFY();


$(document).ready(function () {
    initialLoadTasks();
    $("#addBargeButton").click(function (event) {
        event.preventDefault();
        $("#bargesModal").attr('data-current-bargeid', 'new');
        $("#bargeModalLabel").text("Add New Barge");
        clearBargeModal();
        $('#bargesModal').modal('show');
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
   });

    $("#addDraftButton").click(function (event) {
        event.preventDefault();
        var rowString = '<tr><td><input class="inputFeet"/></td><td><input class="inputInches"/></td><td><input class="inputValue"/></td>';
        $("#bargeModalDraftTbody").append(rowString);
    });

    $("#btnBargeModal_save").on('click', function (event) {
        event.preventDefault();

       var currentId = $("#bargesModal").attr('data-current-bargeid');

        var dataToSend = new Object();
        var bargeLineId = $("#selectBargeModal_bargeLine option:selected").val();
        
        dataToSend.barge_line_id = bargeLineId;
        dataToSend.barge_number = $("#inputBargeModal_bargeNumber").val();
        dataToSend.barge_type = $("#selectBargeModal_bargeType option:selected").val();
        dataToSend.cover_type = $("#selectBargeModal_bargeCoverType option:selected").val();
        dataToSend.maxDraftFeet = $("#inputBargeModal_maxDraftFeet").val();
        dataToSend.maxDraftInches = $("#inputBargeModal_maxDraftInches").val();
        dataToSend.emptyDraftFeet = $("#inputBargeModal_emptyDraftFeet").val();
        dataToSend.emptyDraftInches = $("#inputBargeModal_emptyDraftInches").val();
        var draftData = new Array();
        $("#bargeModalDraftTbody tr").each(function (qq, rr) {
            var draftDataRow = new Object();
            draftDataRow.feet = $(this).find(".inputFeet").val();
            draftDataRow.inches = $(this).find(".inputInches").val();
            draftDataRow.value = $(this).find(".inputValue").val();
            console.log($(this).find(".inputFeet").val());
            draftData.push(draftDataRow);
        });
        dataToSend.drafts = draftData;
        //console.log(dataToSend);
        if (currentId == "new") {

            console.log("new barge");
            var promise = Mblx.Barges.DataAccess.addBarge(dataToSend);
            promise.then(onAddBargeComplete, onErrorFunction);
            console.log(dataToSend);
        } else {
            
             dataToSend.bargeId = currentId;
            console.log("editing contract " + currentId);
            console.log(dataToSend);
        }
    });
});
function onAddBargeComplete(dataz) {
    var data = dataz.status;
    console.log(data);
    if (data == "okay") {
        $('#bargeTable').html('');
        //alert('created new contract');
        $.when(getBarges()).done(function () {
            $("#bargesModal").modal('hide');
        });

    };
}
function clearBargeModal() {
    $("#selectBargeModal_bargeLine").val('');
    $('#inputBargeModal_bargeNumber').val('');
    $("#selectBargeModal_bargeType").val('');
    $("#selectBargeModal_bargeCoverType").val('');
    $("#bargeModalDraftTbody").empty();
    $("#inputBargeModal_emptyDraftFeet").val('');
    $("#inputBargeModal_emptyDraftInches").val('');

    $("#inputBargeModal_maxDraftFeet").val('');
    $("#inputBargeModal_maxDraftInches").val('');
}
function showBargeModal(bargeId) {
    clearBargeModal();
    var selectedBargeData = bargeDB({
        id: {
            is: bargeId
        }
    }).get();
    $("#bargesModal").attr('data-current-bargeid', bargeId);
    $("#bargeModalLabel").text("Editing: " + selectedBargeData[0].barge_number + " &middot; " + selectedBargeData[0].barge_line_name);
    var bargeLineName = stripQuotesAndWhitespace(selectedBargeData[0].barge_line_name);
    $("#selectBargeModal_bargeLine").val(bargeLineName);
    $('#inputBargeModal_bargeNumber').val(selectedBargeData[0].barge_number);
    $("#selectBargeModal_bargeType").val(stripQuotesAndWhitespace(selectedBargeData[0].barge_type));
    $("#selectBargeModal_bargeCoverType").val(selectedBargeData[0].cover_type);
    var draftData = selectedBargeData[0].draft_data;


    var draftTableRows = "";
    jQuery.each(draftData, function (q, r) {
        console.log(r);
        if (r.is_empty == 1) {
            $("#inputBargeModal_emptyDraftFeet").val(r.feet);
            $("#inputBargeModal_emptyDraftInches").val(r.inches);
        } else if (r.is_max == 1) {
            $("#inputBargeModal_maxDraftFeet").val(r.feet);
            $("#inputBargeModal_maxDraftInches").val(r.inches);
        } else {
            draftTableRows += '<tr data-feet-inches="' + r.feet + '-' + r.inches + '"><td><input class="inputFeet" value="' + r.feet + '"></input></td><td><input class="inputInches" value="' + r.inches + '"></input></td><td><input class="inputValue" value="' + r.value + '"></input></td></tr>';
        }
    });
    $("#bargeModalDraftTbody").append(draftTableRows);
    $('#bargesModal').modal('show');
}
var initialLoadTasks = function () {
    getBargeLines();
    getBarges();
}

function getBargeLines() {
    var promise = Mblx.BargeLines.DataAccess.getBargeLines();
    promise.then(onGetBargeLinesComplete, onErrorFunction);
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
    bargeLineOptionString = '';
    jQuery.each(data, function (s, t) {
        bargeLineDB.insert(t);
        //bargeLineOptionString += '<option value="' + stripQuotesAndWhitespace(t.name) + '">' + t.name + '</option>';
        bargeLineOptionString += '<option value="' + t.id + '">' + t.name + '</option>';
    });
    $("#selectBargeModal_bargeLine").append(bargeLineOptionString);

}

/*
function getBargeTypes() {
    var promise = Mblx.Barges.DataAccess.getBargeTypes();
    promise.then(onGetBargeTypesComplete, onErrorFunction);
}
function onGetBargeTypesComplete(dataz) {
    var data = dataz.data;
    var selectString = "";
    jQuery.each(data, function (q, r) {
        selectString += '<option value="' + stripQuotesAndWhitespace(r) + '">' + r + '</option>';
    });
    $("#selectBargeModal_bargeType").append(selectString);
}*/


function getBarges() {
    $.when($('#bargeTbody').empty()).done(function () {
        var promise = Mblx.Barges.DataAccess.getBarges();
        promise.then(onGetBargesComplete, onErrorFunction);
    });

}


function onGetBargesComplete(dataz) {
    var data = dataz.data;
    var bargeLines = {};

    //console.log(data);
    var listItemString = "";
    var bottomListItemString = "";
    jQuery.each(data, function (q, r) {
        bargeDB.insert(r);
        if (r.barge_line_name in bargeLines) {
            bargeLines[r.barge_line_name].push(r);
        } else {
            bargeLines[r.barge_line_name] = [];
            bargeLines[r.barge_line_name].push(r);
        }



    });
    var bargeLinesInThere = Object.keys(bargeLines);
    bargeLinesInThere.sort();
    var count = 0;
    var tableString = "";
    
    jQuery.each(bargeLinesInThere, function (s, t) {
        ///handle barge lines for modal dropdown

        

        //handle table


        count++;
        //console.log(t);
        var thisRow = count;
        var nodeString = '<tr class="treegrid-' + count + '"><td><span class="badge">' + t + '</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
        // console.log(cities[t]);
        jQuery.each(bargeLines[t], function (r, v) {
            count++;
            var thisOtherRow = count;
            //console.log(r);
            //console.log(v);
            nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisRow + '"><td><small>Show Drafts</small></td><td><b>' + v.barge_number + '</b></td><td>' + v.barge_type + '</td><td>' + v.cover_type + '</td><td>&nbsp;</td><td><button type="button" onclick="showBargeModal(' + v.id + ')" class="btn btn-block btn-primary">Edit</button></td></tr>';
            jQuery.each(v.draft_data, function (w, x) {
                count++;
                if (x.is_empty == 1) {
                    nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisOtherRow + '"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>Empty Draft</td><td>' + x.feet + '\'' + x.inches + '"</td><td>&nbsp;</td>';

                } else if (x.is_max == 1) {
                    nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisOtherRow + '"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>Max Draft</td><td>' + x.feet + '\'' + x.inches + '"</td><td>&nbsp;</td>';

                } else {
                    nodeString += '<tr class="treegrid-' + count + ' treegrid-parent-' + thisOtherRow + '"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>' + x.feet + '\'' + x.inches + '"</td><td>' + x.value + '</td><td>&nbsp;</td>';

                }


            });
        });
        tableString += nodeString;
    });
    //listItemString += bottomListItemString;
    //$("#terminalTbody").html(listItemString);
    //console.log(tableString);
    $("#bargeTable").append(tableString);
    $('.tree').treegrid({
        expanderExpandedClass: 'glyphicon glyphicon-minus',
        expanderCollapsedClass: 'glyphicon glyphicon-plus',
        initialState: 'collapsed'
    });
}

function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
}