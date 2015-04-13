var custDB = TAFFY();
var contDB = TAFFY();

$(function () {
    ///input masks
    $('#inputCustomerModal_phone').mask("999-999-9999");
    $('#inputCustomerModal_fax').mask("999-999-9999");

    ////datepickers
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
     

    getCustomers();

    $("#btnAddCustomer").on('click', function () {
        $("#customerModal").attr('data-current-custId', "NEW");

        $("#customerModalLabel").html("Add New Customer");

        $("[id^='inputCustomerModal']").val('');

        $("#btnDeleteCustomer").addClass('hideMe');
        $("#customerModal").modal('show');
    });

    $("#addContactLink").on('click', function () {
        event.preventDefault();
        var seldCustId = $("#customerModal").attr('data-current-custId');
        console.log(seldCustId);
        $("#contactsModal").attr('data-current-custId', seldCustId);
        var seldCustomerName;
        seldCustomerName = custDB({ id: parseInt(seldCustId) }).select('name');

        $("#contactsModal").attr('data-current-contId', "NEW");
        console.log(seldCustomerName);
        $.when($("[id^='inputContactModal']").val('')).done(function () {
            $("input#inputContactModal_customer").val(seldCustomerName);
            $("input#inputContactModal_customer").attr('readonly', '');
            $("#contactsModalLabel").html("New Contact &middot; " + seldCustomerName);
            $("#contactsModal").modal('show');
        });


    });
    /*$("#delContactLink").on('click', function () {
    var r = confirm("Are you sure you want to delete ?");
    console.log(r);

        
    var seldContactId = $("#inputCustomerModal_contacts option:selected").val();
    var promise = Mblx.Contacts.DataAccess.deleteContact(seldContactId);
    promise.then(onDeleteContactSuccess, onErrorFunction);


    });*/
   


    $("#editContactLink").on('click', function () {
        var seldContactId = $("#inputCustomerModal_contacts option:selected").val();
        var seldContactName = contDB({ id: parseInt(seldContactId) }).select('name');
        var seldContactEmail = contDB({ id: parseInt(seldContactId) }).select('email');
        var seldContactPhone = contDB({ id: parseInt(seldContactId) }).select('phone');
        $("#contactsModal").attr('data-current-contId', seldContactId);
        var seldCustId = $("#customerModal").attr('data-current-custId');
        console.log(seldCustId);
        $("#contactsModal").attr('data-current-custId', seldCustId);
        var seldCustomerName;
        seldCustomerName = custDB({ id: parseInt(seldCustId) }).select('name');



        console.log(seldContactId);
        $.when($("[id^='inputContactModal']").val('')).done(function () {
            $("input#inputContactModal_customer").val(seldCustomerName);
            $("input#inputContactModal_customer").attr('readonly', '');
            $("#contactsModalLabel").html("Edit Contact &middot; " + seldContactName);

            $("input#inputContactModal_name").val(seldContactName);
            $("input#inputContactModal_email").val(seldContactEmail);
            $("input#inputContactModal_phone").val(seldContactPhone);
            $("#contactsModal").modal('show');
        });



    });


    $("#btnContactModal_save").on('click', function () {
        var thisCustId = $("#contactsModal").attr('data-current-custId');
        var thisContactId = $("#contactsModal").attr('data-current-contId');
        var newContactName = $("input#inputContactModal_name").val();
        var newContactPhone = $("input#inputContactModal_phone").val();
        var newContactEmail = $("input#inputContactModal_email").val();

        if (thisContactId == 'NEW') {
            var promise = Mblx.Contacts.DataAccess.addContact(thisCustId, newContactName, newContactPhone, newContactEmail);
            promise.then(onAddContactSuccess, onErrorFunction);
        } else {
            var promise = Mblx.Contacts.DataAccess.editContact(thisContactId, newContactName, newContactPhone, newContactEmail);
            promise.then(onEditContactSuccess, onErrorFunction);
        }

    });

    $("#btnDeleteCustomer").on('click', function () {
        var thisCustId = $("#customerModal").attr('data-current-custId');

        var promise = Mblx.Customers.DataAccess.deleteCustomer(thisCustId);
        promise.then(onDeleteCustomerSuccess, onErrorFunction);
    });
    $("#btnCustomerModal_save").on('click', function () {
        var thisCustId = $("#customerModal").attr('data-current-custId');

        var newCode = $("#inputCustomerModal_code").val();
        var newName = $("#inputCustomerModal_name").val();
        var newPhone = $("#inputCustomerModal_phone").val();
        var newFax = $("#inputCustomerModal_fax").val();
        var newAddress = $("#inputCustomerModal_address").val();
        var newCity = $("#inputCustomerModal_city").val();
        var newState = $("#inputCustomerModal_state").val();
        var newPostCode = $("#inputCustomerModal_postCode").val();
        var newCountry = $("#inputCustomerModal_country").val();
        var newEmail = $("#inputCustomerModal_email").val();
        var newStatus = $("#inputCustomerModal_active_status option:selected").val();


        /////////////////// Adding Or Updating? When cust is new, thisCustId = 'NEW'
        if (thisCustId == 'NEW') {
            var promise = Mblx.Customers.DataAccess.addCustomer(newCode, newName, newPhone, newFax, newAddress, newCity, newState, newPostCode, newCountry, newEmail);
            promise.then(onAddCustomerSuccess, onErrorFunction);
        } else {
            var promise = Mblx.Customers.DataAccess.updateCustomer(thisCustId, newCode, newName, newPhone, newFax, newAddress, newCity, newState, newPostCode, newCountry, newEmail, newStatus);
            promise.then(onUpdateCustomerSuccess, onErrorFunction);
        }

    });

});

function queryDB(queryColumn, compareColumn, compareVal) {
    var result;
    result = custDB({compareColumn:compareVal}).select(queryColumn);
    return result;
}

function getCustomers() {

  
    $.when($('.customerListItem').remove()).done(function() {
        var promise = Mblx.Customers.DataAccess.getCustomers();

  
        promise.then(onGetCustomersComplete, onErrorFunction);
    });




}

function getContactsByCustomer(custId) {
    var promise = Mblx.Customers.DataAccess.getCustomerContacts(custId);

    var returnString = "";
    promise.then(function (data) {
        $.each(data, function (q, r) {
            returnString += "<a href=\"mailto:" + r.email + "\">" + r.name + "</a>&emsp;" + r.phone + "<br />";
        });
    }, onErrorFunction).done(function () {
        $("a#contactsShowButton_" + custId).attr("data-content", returnString);
         $("a#contactsShowButton_" + custId).popover({
            html: returnString,
            placement: 'right'
        }); 
        console.log(returnString);
    });
   
}
function populateContacts(custId) {
    $("#inputCustomerModal_contacts").empty();

    var promise = Mblx.Customers.DataAccess.getCustomerContacts(custId);

  
        promise.then(onGetCustomerContactsComplete, onErrorFunction);
}

function onGetCustomerContactsComplete(data) {
    //console.log(data);
    contDB().remove();
    var optionString = "";
    jQuery.each(data, function (q, r) {
        contDB.insert(r);

        optionString += "<option value=\"" + r.id + "\">" + r.name + "</option>";
    });
    $("#inputCustomerModal_contacts").html(optionString);

}

function onDeleteContactSuccess(data) {
    console.log(data);
   
    $("#customerModal").css("overflow-y", "auto");
    var thisCustId = $("#customerModal").attr('data-current-custId');
    populateContacts(thisCustId);
    
}
function onEditContactSuccess(data) {
    console.log(data);
    $("#contactsModal").modal('hide');
    $("#customerModal").css("overflow-y", "auto");
    var thisCustId = $("#contactsModal").attr('data-current-custId');
    populateContacts(thisCustId);
    
}
function onAddContactSuccess(data) {
    console.log(data);
    $("#contactsModal").modal('hide');
    $("#customerModal").css("overflow-y", "auto");
    var thisCustId = $("#contactsModal").attr('data-current-custId');
    populateContacts(thisCustId);
    
}
function onDeleteCustomerSuccess(data) {
    console.log(data);
    custDB().remove();
    var theTable = $('#customerTable').DataTable();
    theTable.destroy();


    $.when($("#custTbody").empty()).done(function() {
        $("#customerModal").modal('hide');
        getCustomers();
        showMainAlert("deleted customer");
    });

}

function onUpdateCustomerSuccess(data) {
    console.log(data);
    custDB().remove();
    var theTable = $('#customerTable').DataTable();
    theTable.destroy();


    $.when($("#custTbody").empty()).done(function() {
        $("#customerModal").modal('hide');
        getCustomers();
        showMainAlert("updated customer");
    });

}

function onAddCustomerSuccess(data) {
    console.log(data);
     custDB().remove();
    var theTable = $('#customerTable').DataTable();
    theTable.destroy();


    $.when($("#custTbody").empty()).done(function () {
        $("#customerModal").modal('hide');
        getCustomers();
        showMainAlert("added customer");
    });

}

function onGetCustomersComplete(dataz) {
    var data = dataz.data;
    data.sort(function(a, b) {
        if (a.active_status > b.active_status) {
            return -1;
        }
        if (a.active_status < b.active_status) {
            return 1;
        }
        return 0;
    });

    var listItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {

        custDB.insert(r);

        listItemBuildConter++;
        listItemString += '<tr> \
                    <td><button type="button" onClick="showCustomerModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                    <td>' + r.code + '</td> \
                   <td>' + r.name + '</td> \
                   <td>' + r.phone + '</td> \
                   <td>' + r.fax + '</td> \
                   <td>' + r.address + '</td> \
                   <td>' + r.city + '</td> \
                   <td>' + r.state + '</td> \
                   <td>' + r.postCode + '</td> \
                   <td>' + r.country + '</td> \
                    <td><a href="#" tabindex="0" class="btn btn-xs btn-default" role="button" data-toggle="popover" title="Contacts : ' + r.name + '" id="contactsShowButton_' + r.id + '" class="btn btn-block btn-primary">Show Contacts</a></td> \
                    <td>' + r.email + '</td> \
                     <td>' + r.active_status + '</td> \
                                </tr>';
        

    });

    $.when($("#custTbody").append(listItemString)).done(function () {
        jQuery.each(data, function (q, r) {
            getContactsByCustomer(r.id);
        });
        $('#customerTable').DataTable({
            "dom": '<"row"<"col-xs-6"l><"col-xs-6"fr>>t<"row"<"col-xs-6"i><"col-xs-6"p>>'
        });
    });

  
}

function showCustomerModal(customerId) {

    var selectedCustData = custDB({
        id: {
            is: customerId
        }
    }).get();
    populateContacts(customerId);
    $("#btnDeleteCustomer").removeClass('hideMe');
    $("#customerModal").attr('data-current-custId', customerId);

    $("#customerModalLabel").html("Editing " + selectedCustData[0].name);
    $("#inputCustomerModal_code").val(selectedCustData[0].code);
    $("#inputCustomerModal_name").val(selectedCustData[0].name);
    $("#inputCustomerModal_phone").val(selectedCustData[0].phone);
    $("#inputCustomerModal_fax").val(selectedCustData[0].fax);
    $("#inputCustomerModal_address").val(selectedCustData[0].address);
    $("#inputCustomerModal_city").val(selectedCustData[0].city);
    $("#inputCustomerModal_state").val(selectedCustData[0].state);
    $("#inputCustomerModal_postCode").val(selectedCustData[0].postCode);
    $("#inputCustomerModal_country").val(selectedCustData[0].country);
    $("#inputCustomerModal_email").val(selectedCustData[0].email);

    $("#customerModal").modal('show');
}

function onErrorFunction(error) {
    showMainAlert("error performing operation : <br />" + error);
    console.log(error);

}

function showMainAlert(message) {
    $.when($("div#mainAlert").empty()).done(function() {
        $("div#mainAlert").append("<h3>" + message + "</h3>");
        $("div#mainAlert").removeClass('hideMe');
        setTimeout(function() {
            $("div#mainAlert").addClass('hideMe')
        }, 3000);
    });


}
