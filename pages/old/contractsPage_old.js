var custNames = [];
var serviceList = [];
var destinationList = [];
var originList = [];
var equipmentList = [];
var custDB = TAFFY();
var originDB = TAFFY();
var serviceDB = TAFFY();
var destinationDB = TAFFY();
var contractDB = TAFFY();
var equipmentDB = TAFFY();
var commDB = TAFFY();
var rowCounter = 1;
var colCounter = 1;
$(document).ready(function () {

    initialLoadTasks();

    $(".firstMinimum").val('1400');

    $("#btnAddRateRow").click(function (event) {
        event.preventDefault();

        var rateInputColString = "";
        console.log(colCounter);
        for (var b = 0; b < colCounter; b++) {
            rateInputColString += '<td class="rateTableEmptyRateCell"><input placeholder="N/A" /></td>';
        }
        var rowString = '<tr class="rateTableRow"><td><div class="btn-group col-xs-12"><button id="originButton' + rowCounter + '" type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">Origin &nbsp;<span class="caret pull-right"></span> </button><ul class="originDropdown dropdown-menu" role="menu"><li class="divider"></li></ul></div></td><td><div class="btn-group col-xs-12"><button type="button" id="destinationButton' + rowCounter + '" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button><ul class="destinationDropdown dropdown-menu" role="menu"><li><a href="pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a> </li><li class="divider"></li></ul></div></td>' + rateInputColString + '</tr>';
        rowCounter++;
        $.when($("#rateTableTbody").append(rowString)).done(function () {
            getOriginsAndDestinations();
        });
    });

    $("#btnAddFreeDayRow").click(function (event) {
        event.preventDefault();

        var rowString = '<tr><td><select class="form-control"><option>Origin</option><option>Destiation</option><option>All Purpose</option></select></td><td><select class="form-control"><option>0 - 400</option><option>401 - 800</option><option>801 - 1200</option><option>1201 - over</option></select></td><td><input type="text" class="form-control" aria-describedby="sizing-addon3"></td></tr>';
        $("#freeDayTableTbody").append(rowString);
    });
    /*$(".rateTableEmptyODPairCell").click(function () {
        $(this).removeClass("rateTableEmptyODPairCell")
        var htmlString = '';
        $(this).html(htmlString);
    });*/
    /*$(".rateTableEmptyRateCell").click(function () {
        //$(this).removeClass("rateTableEmptyRateCell")
        $(this).html('<input type="text"></input>');
    });*/

    /*$(".firstMinimum").change(function () {
        $(this).removeClass("firstMinimum");
        console.log("Dang select changed");

        $("#rateTableHeadRow").append('<th><select class="form-control firstMinimum"><option value="0">0</option><option value="0">400</option><option value="0">800</option><option value="0">1200</option><option value="0">1400</option><option value="0">1600</option></select></th>');
        $(".rateTableRow").append('<td class="rateTableEmptyRateCell"><input /></td>');
    });*/

    $("#btnAddRateCol").click(function (event) {
        event.preventDefault();

       

        $("#rateTableHeadRow").append('<th><select class="form-control firstMinimum"><option value="AQ">AQ</option><option value="300">300</option><option value="500">500</option><option value="800">800</option><option value="1000">1000</option><option value="1200">1200</option><option value="1400">1400</option><option value="1600">1600</option><option value="Flat">Flat Charge</option></select></th>');
        /*for (var x = 0; x <= colsToAdd; x++) {
            console.log(x);*/
            $(".rateTableRow").append('<td class="rateTableEmptyRateCell"><input /></td>');
        //}

        colCounter++;
        //$(".firstMinimum").val('1400')

    });

    $('#inputContractModal_rate').number(true, 2);
    $('#inputContractModal_demurrage').number(true, 2);
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#btnAddContract").click(function () {
        $.when(clearModalStuff()).done(function () {
            $("#inputContractModal_bargeMinimum").val("1400");
            $("#contractsModal").modal('show');
        });
    });
    $("#btnContractModal_save").click(function () {
        var dataObj = new Object();

        dataObj.type = "CUST";

        var currentId = $("#contractsModal").attr('data-current-contractId');

        dataObj.customerName = $("#inputContractModal_customer").val();
        var inputCustText = $("#inputContractModal_customer").val();
        var custSelect = custDB({
            name: inputCustText
        }).select("id");
        dataObj.customerId = custSelect[0];

        dataObj.contractNumber = $("#inputContractModal_contractNumber").val();

        dataObj.services = $("#inputContractModal_services").val();
        var inputServiceText = $("#inputContractModal_services").val();
        var serviceSelect = serviceDB({
            name: inputServiceText
        }).select("id");
        dataObj.ServiceId = serviceSelect[0];


        dataObj.origin = $("#inputContractModal_origin").val();
        var inputOriginText = $("#inputContractModal_origin").val();
        var originSelect = originDB({
            name: inputOriginText
        }).select("id");
        dataObj.OriginId = originSelect[0];

        dataObj.destination = $("#inputContractModal_destination").val();
        var inputDestinationText = $("#inputContractModal_destination").val();
        var destinationSelect = destinationDB({
            name: inputDestinationText
        }).select("id");
        dataObj.DestinationId = destinationSelect[0];


        dataObj.equipment = $("#inputContractModal_equipment").val();
        var inputEquipmentText = $("#inputContractModal_equipment").val();
        var equipmentSelect = equipmentDB({
            name: inputEquipmentText
        }).select("id");
        dataObj.EquipmentId = equipmentSelect[0];

        dataObj.bargeMinimum = $("#inputContractModal_bargeMinimum").val();

        dataObj.rate = $("#inputContractModal_rate").val();
        dataObj.demurrage = $("#inputContractModal_demurrage").val();
        dataObj.start_date = $("#inputContractModal_startDate").val();
        dataObj.end_date = $("#inputContractModal_endDate").val();
        dataObj.free_days = $("#inputContractModal_free_days").val();

        var pickedCommodities = [];

        $(".pickedCommodityItem").each(function () {
            var pickedId = $(this).attr("data-commodity-id");
            var pickedPieces = $(this).attr("data-pieceCount");
            var pickedTonnage = $(this).attr("data-tonnage");
            var pickedBill = $(this).attr("data-billLaden");
            var pickedObject = {
                "id": pickedId,
                "pieces": pickedPieces,
                "tonnage": pickedTonnage,
                "bill_lading": pickedBill
            };
            pickedCommodities.push(pickedObject);


            //console.log(pickedId);
        });
        dataObj.commodities = pickedCommodities;

        dataObj.notes = $("#inputContractModal_notes").val();


        if (currentId == "new") {

            //console.log("new contract");
            var promise = Mblx.Contracts.DataAccess.addContract(dataObj);
            promise.then(onAddContractComplete, onErrorFunction);
            ////console.log(dataObj);
        } else {
            var promise = Mblx.Contracts.DataAccess.addContract(dataObj);
            promise.then(onAddContractComplete, onErrorFunction);
            //var customerSelect = contractDB({ id: currentId }).select("customer_id");
            //dataObj.customerId = customerSelect[0];
            //console.log("editing contract " + currentId);
            //console.log(dataObj);
        }
    });
    $("#commoditiesList").on("click", "a", function () {
        var $selectedThing = $(this);
        var selCommId = $selectedThing.attr('data-commodity-id');
        var selCommUom = commDB({
            id: parseInt(selCommId)
        }).select('uom');
        $.when($(".commodityListItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });
        $("#pieceCountUOMLabel").html(selCommUom);
    });
    $("#pickedCommoditiesList").on("click", "li", function () {
        var $selectedThing = $(this);
        var pickedCommId = $selectedThing.attr('data-commodity-id');
        $.when($(".pickedCommodityItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });
    });
    $("#commodityFilterInput").keyup(function () {
        var filterString = $("#commodityFilterInput").val();
        var matchedIds = commDB([{
            name: {
                likenocase: filterString
            }
        }, {
            desc: {
                likenocase: filterString
            }
        }]).select("id");
        $.when($(".commodityListItem").addClass('hideMe')).done(function () {
            $.each(matchedIds, function (indeks, valu) {
                $(".commodityListItem[data-commodity-id='" + valu + "']").removeClass('hideMe');
            });
        });
    });
    $("#selectCommodityButton").click(function () {
        var $selectedThing = $(".commodityListItem.active");
        var selCommId = $selectedThing.attr('data-commodity-id');
        var selCommName = commDB({
            id: parseInt(selCommId)
        }).select('name');
        var selCommDesc = commDB({
            id: parseInt(selCommId)
        }).select('desc');
        var selCommUom = commDB({
            id: parseInt(selCommId)
        }).select('uom');
        var selPieceCount = $("#inputPieceCount").val();
        var selTonnage = $("#inputTonnage").val();
        var selBillLaden = $("#inputBillLaden").val();
        var pickedItemString = '<li id="selectedCommodityItem' + selCommId + '" data-commodity-id=' + selCommId + ' data-pieceCount=' + selPieceCount + ' data-tonnage=' + selTonnage + ' data-billLaden=' + selBillLaden + ' class="list-group-item pickedCommodityItem"><span class="badge">' + selPieceCount + ' Pieces</span><span class="badge">' + selTonnage + ' Tons</span><span class="badge">Bill ' + selBillLaden + '</span>' + selCommName + '</li>';
        $.when($("#pickedCommoditiesList").append(pickedItemString)).done(function () {
            $("#inputPieceCount").val('');
            $("#inputTonnage").val('');
            $("#inputBillLaden").val('');
            $("#commodityFilterInput").val('');
            $(".commodityListItem").addClass('hideMe');
        });
        //console.log(selCommName);
    });
});

var initialLoadTasks = function () {
    $("#inputContractModal_demurrage").text("130.00");

    getCustomers();
    getServices();
    getOriginsAndDestinations();

    getCommodities();
    getEquipment();
    getCustomerContracts();

}

function getCommodities() {
    $.when($('.commodityListItem').remove()).done(function () {
        var promise = Mblx.Commodities.DataAccess.getCommodities();
        promise.then(onGetCommoditiesComplete, onErrorFunction);
    });
}

function getCustomers() {
    $.when($('.customerListItem').remove()).done(function () {
        var promise = Mblx.Customers.DataAccess.getCustomers();
        promise.then(onGetCustomersComplete, onErrorFunction);
    });
}

function getEquipment() {
    $.when($('.equipmentListItem').remove()).done(function () {
        var promise = Mblx.Equipment.DataAccess.getEquipment();
        promise.then(onGetEquipmentComplete, onErrorFunction);
    });
}

function clearModalStuff() {
    $("#contractsModal").attr('data-current-contractId', "new");
    $(".modalInput").val("");
    $("#contractsModalLabel").html("Add New Contract");
}

function getCustomerContracts() {
    $.when($('#contractTbody').empty()).done(function () {
        var promise = Mblx.Contracts.DataAccess.getContracts(true);
        promise.then(ongetCustomerContractsComplete, onErrorFunction);
    });
}

function getServices() {
    $.when($('.serviceListItem').remove()).done(function () {
        var promise = Mblx.Services.DataAccess.getServices();
        promise.then(onGetServicesComplete, onErrorFunction);
    });
}

function getOriginsAndDestinations() {
    $.when($('.destinationListItem').remove()).done(function () {
        var promise = Mblx.Destinations.DataAccess.getDestinations();
        promise.then(onGetDestinationsComplete, onErrorFunction);
    });
    $.when($('.originListItem').remove()).done(function () {
        var promise2 = Mblx.Origins.DataAccess.getOrigins();
        promise2.then(onGetOriginsComplete, onErrorFunction);
    });
}


function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    $.each(data, function (q, r) {
        commDB.insert(r);
        listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h4 class="list-group-item-heading">' + r.name + '</h4><p class="list-group-item-text">' + r.desc + '</p></a>';
    });
    $.when($("#commoditiesList").html(listString)).done(function () {
        //console.log("typeahead time");
    });
}

function onAddContractComplete(dataz) {
    var data = dataz.status;
    //console.log(data);
    if (data == "okay") {
        //alert('created new contract');
        $.when(getCustomerContracts()).done(function () {
            $("#contractsModal").modal('hide');
        });

    }
}

function onGetServicesComplete(dataz) {

    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        serviceDB.insert(r);
        serviceList.push(jsSafe(r.name));
        listItemString += '<li class="serviceListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_services\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.description + '</span></a></li>';
    });
    $("#servicesDropdown").append(listItemString);
    $('#inputService').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'serviceList',
        displayKey: 'value',
        source: substringMatcher(serviceList)
    });
}

function onGetEquipmentComplete(dataz) {

    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        equipmentDB.insert(r);
        equipmentList.push(jsSafe(r.name));
        listItemString += '<li class="equipmentListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_equipment\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#equipmentDropdown").append(listItemString);
    $('#inputService').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'equipmentList',
        displayKey: 'value',
        source: substringMatcher(equipmentList)
    });
}

function ongetCustomerContractsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        contractDB.insert(r);
        listItemString += '<tr data-contract-id="' + r.id + '">';
        listItemString += '<td><button type="button" onclick="showContractModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
        listItemString += '<td>' + r.customer_name + '</td>';
        listItemString += '<td>' + r.contract_number + '</td>';
        listItemString += '<td>' + r.service_name + '</td>';
        listItemString += '<td>' + r.origin_name + '</td>';
        listItemString += '<td>' + r.destination_name + '</td>';
        listItemString += '<td>' + r.equipment_name + '</td>';
        listItemString += '<td>' + r.barge_minimum + '</td>';
        listItemString += '<td>TODO</td>';
        listItemString += '<td>' + r.start_date + '</td>';
        listItemString += '<td>' + r.end_date + '</td>';
        listItemString += '<td>' + r.rate + '</td>';
        listItemString += '<td>' + r.demurrage + '</td>';
        listItemString += '<td>' + r.free_days + '</td>';
        listItemString += '<td>' + r.notes + '</td>';
        listItemString += '</tr>';
    });
    $("#contractTbody").append(listItemString);
    $("#contractLoadingGif").addClass('hideMe');
    $("#theContainer").removeClass('hideMe');
    //console.log(data);
}

function onGetDestinationsComplete(dataz) {
    var data = dataz.data;

    var leftStringList = [];
    var rightStringList = [];
    var arrayCount = 0;
    jQuery.each(data, function (q, r) {

        destinationDB.insert(r);
        destinationList.push(r.name);
        leftStringList[arrayCount] = '<li class="destinationListItem"><a class="destinationListItemLink" onClick="populateButton(\'destinationButton';
        rightStringList[arrayCount] = '\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
        arrayCount++;
    });
    //console.log(listItemString);
    $.when($(".destinationDropdown").empty()).done(function () {
        var arrCount = 0;
        $(".destinationDropdown").each(function (j, k) {

            var stringToAppend = "";
            for (var q = 0; q < leftStringList.length; q++) {
                stringToAppend += leftStringList[q] + j + rightStringList[q];
            }
            $(this).append(stringToAppend);
            arrCount++;
        });
        $('.inputContractModal_destination').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'destinationList',
            displayKey: 'value',
            source: substringMatcher(destinationList)
        });
    });

}

function onGetOriginsComplete(dataz) {
    var data = dataz.data;
    var leftStringList = [];
    var rightStringList = [];
    var arrayCount = 0;
    jQuery.each(data, function (q, r) {
        originDB.insert(r);
        originList.push(r.name);
        leftStringList[arrayCount] = '<li class="originListItem"><a class="originListItemLink" onClick="populateButton(\'originButton';
        rightStringList[arrayCount] = '\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.country + '</span></a></li>';
        arrayCount++;
    });
    //console.log(listItemString);
    $.when($(".originDropdown").empty()).done(function () {
        var arrCount = 0;
        $(".originDropdown").each(function (j, k) {
            //console.log(j);
            //console.log(k);
            var stringToAppend = "";
            for (var q = 0; q < leftStringList.length; q++) {
                stringToAppend += leftStringList[q] + j + rightStringList[q];
            }
            $(this).append(stringToAppend);
            arrCount++;
        });
        $('.inputContractModal_origin').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'originList',
            displayKey: 'value',
            source: substringMatcher(originList)
        });
    });

}

function showContractModal(contractID) {
    var selectedContractData = contractDB({
        id: {
            is: contractID
        }
    }).get();
    $("#contractsModal").attr('data-current-contractId', contractID);
    $("#contractsModalLabel").html("Editing " + selectedContractData[0].contract_number + ' ' + selectedContractData[0].customer_name);
    $("#inputContractModal_customer").val(selectedContractData[0].customer_name);
    $("#inputContractModal_contractNumber").val(selectedContractData[0].contract_number);
    $("#inputContractModal_services").val(selectedContractData[0].service_name);
    $("#inputContractModal_origin").val(selectedContractData[0].origin_name);
    $("#inputContractModal_destination").val(selectedContractData[0].destination_name);
    $("#inputContractModal_equipment").val(selectedContractData[0].equipment_name);
    $("#inputContractModal_bargeMinimum").val(selectedContractData[0].barge_minimum);
    $("#inputContractModal_rate").val(selectedContractData[0].rate);
    $("#inputContractModal_demurrage").val(selectedContractData[0].demurrage);
    $("#inputContractModal_startDate").val(selectedContractData[0].start_date);
    $("#inputContractModal_endDate").val(selectedContractData[0].end_date);
    $("#inputContractModal_free_days").val(selectedContractData[0].free_days);
    $("#inputContractModal_notes").val(selectedContractData[0].notes);
    $("#contractsModal").modal('show');
}

function onGetCustomersComplete(dataz) {
    var data = dataz.data;
    data.sort(function (a, b) {
        if (a.rank > b.rank) {
            return 1;
        }
        if (a.rank < b.rank) {
            return -1;
        }
        return 0;
    });
    var listItemString = "";

    jQuery.each(data, function (q, r) {
        custDB.insert(r);
        custNames.push(r.name);

        listItemString += '<li class="customerListItem"><a class="customerListItemLink" onClick="populateField(\'inputContractModal_customer\',\'' + jsSafe(r.name) + '\')" data-toggle="dropdown" data-target="customerDropdown" data-customerId="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';

    });
    $("#customerDropdown").append(listItemString);
    $('#inputContractModal_customer').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'custNames',
        displayKey: 'value',
        source: substringMatcher(custNames)
    });
}


function populateField(field, value) {
    event.preventDefault();
    $("#" + field).val(value);
}

function populateButton(buttonId, value) {
    event.preventDefault();
    $("#" + buttonId).text(value);
}
function onErrorFunction(error) {
    //console.log("error performing operation");
    //console.log(error);
}