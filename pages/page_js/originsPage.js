var originsDB = TAFFY();
var hasItRun = 0;
$(function () {


    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    getOrigins();

    $("#addOriginButton").click(function () {
        $("#originModal").attr('data-current-originId', "new");
        $("#originModalLabel").html("Add New Origin");
        $("#inputOriginModal_city").val('');
        $("#inputOriginModal_country").val('');
        $("#originModal").modal('show');
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
   });

    $("#btnOriginModal_save").click(function () {
        var dataObj = new Object();
        dataObj.type = "OR";
        var currentId = $("#originModal").attr("data-current-originId");

        $("#originModal").modal('hide');
        dataObj.city = $("#inputOriginModal_city").val();
        dataObj.country = $("#inputOriginModal_country").val();
        dataObj.activeStatus = 1;
        dataObj.originId = currentId;

        if (currentId == 'new') {
            console.log('this is a new barge line');
            var promise = Mblx.Origins.DataAccess.addOrigin(dataObj);
            promise.then(onAddOriginComplete, onErrorFunction);
            console.log(dataObj);
        } else {
            var promise = Mblx.Origins.DataAccess.updateOrigin(dataObj);
            promise.then(onUpdateOriginComplete, onErrorFunction);
            console.log('edit barge line: ' + currentId);
            console.log(dataObj);
        }

        window.location.reload();
    });

    $("#btnDeleteOrigin").click(function (event) {
        event.preventDefault();
        var r = confirm("Are you sure you want to delete ?");
        if (r == true) {
            var thisOriginId = $("#originModal").attr('data-current-originId');
            var promise = Mblx.Origins.DataAccess.deleteOrigin(thisOriginId);

            // use promise to implement what happens when OData result is ready
            promise.then(onDeleteOriginComplete, onErrorFunction);
          
            

        } else {
            return true;
        }
    });
});

function getOrigins() {

    // clear results and add spinning gears icon
    $.when($('#OriginTableBody').empty()).done(function () {
        var promise = Mblx.Origins.DataAccess.getOrigins();

        // use promise to implement what happens when OData result is ready
        promise.then(onGetOriginsComplete, onErrorFunction);
    });

    // call view-model function which returns promise
}
function onAddOriginComplete() {
    console.log('you added a barge');
};
function onUpdateOriginComplete(id) {
    console.log('you updated barge: ' + id);
};
function onDeleteOriginComplete(dataz) {
    console.log(dataz);
    $("#originModal").modal('hide');
    hasItRun = 1;
    getOrigins();
}
function onGetOriginsComplete(dataz) {
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
    var listItemString = "";
    //var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {
        if (hasItRun == 0) {
            originsDB.insert(r);
            console.log(hasItRun);
        }
        ////console.log(q);


        listItemString += '<tr data-origin-id="' + r.id + '"><td><button type="button" onClick="showOriginModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
        listItemString += '<td>' + r.name + '</td>';
        listItemString += '<td>' + r.country + '</td>';
        listItemString += '</tr>';


        ////console.log(r);
    });
    ////console.log(listItemString);
    $("#originTableBody").append(listItemString);
    console.log(data);
}


function showOriginModal(originId) {
    console.log(originId);
    var selectedOriginData = originsDB({ id: originId }).get();
    $("#originModal").attr('data-current-originId', originId);
    $("#originModalLabel").html("Editing " + selectedOriginData[0].name + ', ' + selectedOriginData[0].country);
    $("#inputOriginModal_city").val(selectedOriginData[0].name);
    $("#inputOriginModal_country").val(selectedOriginData[0].country);
    $("#btnDeleteOrigin").removeClass('hideMe');
    $("#originModal").modal('show');
}
function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
    //location.reload();
}