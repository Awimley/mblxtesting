var stevedoresDB = TAFFY();

$(function () {


    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    getStevedores();

    $("#addStevedoreButton").click(function () {
        $("#stevedoreModal").attr('data-current-stevedoreId', "new");
        $("#stevedoreModalLabel").html("Add New Stevedore");
        $("#inputStevedoreModal_city").val('');
        $("#inputStevedoreModal_country").val('');
        $("#stevedoreModal").modal('show');
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
   });

    $("#btnStevedoreModal_save").click(function () {
        $("#stevedoreModal").modal('hide');
        window.location.reload();
    });

    $("#btnDeleteStevedore").click(function (event) {
        event.preventDefault();
        var r = confirm("Are you sure you want to delete ?");
        if (r == true) {
            var thisCustId = $("#stevedoreModal").attr('data-current-stevedoreId');
            $("#stevedoreModal").modal('hide');
            window.location.reload();

        } else {
            return true;
        }
    });
});

function getStevedores() {

    // clear results and add spinning gears icon
    $.when($('#StevedoreTableBody').empty()).done(function () {
        var promise = Mblx.Stevedores.DataAccess.getStevedores();

        // use promise to implement what happens when OData result is ready
        promise.then(onGetStevedoresComplete, onErrorFunction);
    });

    // call view-model function which returns promise


}

function onGetStevedoresComplete(dataz) {
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
        stevedoresDB.insert(r);
        ////console.log(q);


        listItemString += '<tr data-stevedore-id="' + r.id + '"><td><button type="button" onClick="showStevedoreModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
        listItemString += '<td>' + r.name + '</td>';
        listItemString += '<td>' + r.city + ', ' + r.state + '</td>';
        listItemString += '</tr>';


        ////console.log(r);
    });
    ////console.log(listItemString);
    $("#stevedoreTableBody").append(listItemString);
    console.log(data);
}


function showStevedoreModal(stevedoreId) {
    console.log(stevedoreId);
    var selectedStevedoreData = stevedoresDB({ id: stevedoreId }).get();
    $("#stevedoreModal").attr('data-current-stevedoreId', stevedoreId);
    $("#stevedoreModalLabel").html("Editing " + selectedStevedoreData[0].name);
    $("#inputStevedoreModal_name").val(selectedStevedoreData[0].name);
    $("#inputStevedoreModal_contact_name").val(selectedStevedoreData[0].contact_name);
    $("#inputStevedoreModal_address").val(selectedStevedoreData[0].address);
    $("#inputStevedoreModal_city").val(selectedStevedoreData[0].city);
    $("#inputStevedoreModal_state").val(selectedStevedoreData[0].state);
    $("#inputStevedoreModal_zip_code").val(selectedStevedoreData[0].zip_code);
    $("#inputStevedoreModal_phone").val(selectedStevedoreData[0].phone);
    $("#inputStevedoreModal_fax").val(selectedStevedoreData[0].fax);
    $("#inputStevedoreModal_email").val(selectedStevedoreData[0].email);

    $("#btnDeleteStevedore").removeClass('hideMe');
    $("#stevedoreModal").modal('show');
}
function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
    //location.reload();
}
