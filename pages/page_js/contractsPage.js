/// <reference path="../../public/js/jquery-1.11.2.js" />
/// <reference path="../../public/js/taffy.js" />


var custNames = [];
var serviceList = [];
var destinationList = [];
var originList = [];
var equipmentList = [];
var terminalList = [];
var custDB = TAFFY();
var originDB = TAFFY();
var serviceDB = TAFFY();
var destinationDB = TAFFY();
var contractDB = TAFFY();
var equipmentDB = TAFFY();
var commDB = TAFFY();
var terminalDB = TAFFY();
var rateTableDB = TAFFY();
var spotRowCounter = 1;
var spotColCounter = 1;
var annualRowCounter = 1;
var checkedServices = [];


//////////////////// spotToggle = false means annual
var spotToggle = false;


var selectedServices = new Array();

$(document).ready(function () {

    initialLoadTasks();
    $("input[name=spotAnnualToggle]:radio").change(function () {
        console.log($(this).val());
        /////
    });





    $("#servicesDropdown").on('click', 'li', function (event) {

        //console.log($(this));
        selectedServices.push($(this).attr('data-service-id'));

    });
    $("#btnAddAnnualRateRow").click(function (event) {
        event.preventDefault();

        var rateInputColString = "";
        for (var b = 0; b < 8; b++) {
            rateInputColString += '<td class="rateTableEmptyRateCell"><input class="rateInput form-control" placeholder="N/A" data-sequence="' + b + '"/></td>';
        }
        var rowString = '<tr class="rateTableRow"><td><div class="btn-group col-xs-12"><button id="annualOriginButton' + annualRowCounter + '" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">New Orleans</button><ul class="originDropdown dropdown-menu" role="menu"><li class="divider"></li></ul></div></td><td><div class="btn-group col-xs-12"><button type="button" id="annualDestinationButton' + annualRowCounter + '" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button><ul class="destinationDropdown dropdown-menu" role="menu"><li><a href="pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a> </li><li class="divider"></li></ul></div></td>' + rateInputColString + '</tr>';
        annualRowCounter++;

        $.when($("#annualRateTableTbody").append(rowString)).done(function () {
            getOriginsDestinationsAndTerminals();
        });
    });
    $("#btnAddSpotRateRow").click(function (event) {
        event.preventDefault();

        var rateInputColString = "";
        console.log(spotColCounter);
        for (var b = 0; b < spotColCounter; b++) {
            rateInputColString += '<td class="rateTableEmptyRateCell"><input class="rateInput form-control" placeholder="N/A" data-sequence="' + b + '"/></td>';
        }
        var rowString = '<tr class="rateTableRow">\
                        <td> \
                            <div class="btn-group col-xs-12"> \
                            <button id="spotOriginButton' + spotRowCounter + '" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">New Orleans</button> \
                            <ul class="originDropdown dropdown-menu" role="menu"></ul></div> \
                        </td> \
                        <td> \
                            <div class="btn-group col-xs-12"> \
                            <button type="button" id="spotDestinationButton' + spotRowCounter + '" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span></button> \
                            <ul class="destinationDropdown dropdown-menu" role="menu"></ul></div> \
                        </td> \
                        <td> \
                            <div class="btn-group col-xs-12"> \
                            <button type="button" id="terminalButton' + spotRowCounter + '" class="btn btn-primary dropdown-toggle btn-block btnTerm" data-toggle="dropdown">Terminal &nbsp;<span class="caret pull-right"></span></button> \
                            <ul id="terminalDropdown' + spotRowCounter + '" class="terminalDropdown dropdown-menu" role="menu"></ul></div> \
                        </td> ' + rateInputColString + '</tr>';



        spotRowCounter++;
        $.when($("#spotRateTableTbody").append(rowString)).done(function () {
            getOriginsDestinationsAndTerminals();
        });
    });
    $("#btnShowExpiredContracts").click(function (event) {
        $('tr.expiredContract').toggleClass('hideMe');
        $("#btnHideExpiredContracts").toggleClass('hideMe');
        $("#btnShowExpiredContracts").toggleClass('hideMe');      
    });

    $("#btnHideExpiredContracts").click(function (event) {
        $('tr.expiredContract').toggleClass('hideMe');
        $("#btnHideExpiredContracts").toggleClass('hideMe');
        $("#btnShowExpiredContracts").toggleClass('hideMe');      
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
        checkedServices = [];
   });

    $("#btnAddFreeDayRow").click(function (event) {
        event.preventDefault();

        var rowString = '<tr><td><select class="form-control"><option>Origin</option><option>Destiation</option><option>All Purpose</option></select></td><td><select class="form-control"><option>0 - 400</option><option>401 - 800</option><option>801 - 1200</option><option>1201 - over</option></select></td><td><input type="text" class="form-control" aria-describedby="sizing-addon3"></td></tr>';
        $("#freeDayTableTbody").append(rowString);
    });

    $("#btnAddSpotFreeDayRow").click(function (event) {
        event.preventDefault();

        var rowString = '<tr><td><select class="form-control"><option>All Purpose</option><option>Origin</option><option>Destiation</option></select></td><td><input type="text" class="form-control" aria-describedby="sizing-addon3"></td></tr>';
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

   $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
   });

    $("#btnAddSpotRateCol").click(function (event) {
        event.preventDefault();



        $("#rateTableHeadRow").append('<th><select class="form-control firstMinimum" data-sequence="' + spotColCounter + '"><option value="AQ">AQ</option><option value="300">300</option><option value="500">500</option><option value="800">800</option><option value="1000">1000</option><option value="1200">1200</option><option value="1400">1400</option><option value="1600">1600</option><option value="Flat">Flat Charge</option></select></th>');
        /*for (var x = 0; x <= colsToAdd; x++) {
            console.log(x);*/
        $(".rateTableRow").append('<td class="rateTableEmptyRateCell"><input class="rateInput form-control" placeholder="N/A" data-sequence="' + spotColCounter + '"/></td>');
        //}

        spotColCounter++;
        //$(".firstMinimum").val('1400')

    });
    //generate contract number with initials,

    $("#inputContractModal_initials").on('change', function (e) {
        var d = new Date();
        e.preventDefault();
        $("#inputContractModal_contractNumber").val($("#inputContractModal_initials").val() + '-' + (d.getMonth()+1) + '-' + d.getDate() + '-' + d.getFullYear());
    });

    $("#inputContractModal_initials_annual").on('change', function (e) {
        var d = new Date();
        e.preventDefault();
        $("#inputContractModal_contractNumber_annual").val($("#inputContractModal_initials_annual").val() + '-' + (d.getMonth()+1) + '-' + d.getDate() + '-' + d.getFullYear());
    });

    $('#inputContractModal_rate').number(true, 2);
    $('#inputContractModal_demurrage').number(true, 2);
    $('#inputContractModal_demurrage_Annual').number(true, 2);
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

    $("#btnAddAnnualContract").click(function () {
        $.when(clearAnnualModalStuff()).done(function () {
            $("#annualContractModal").modal('show');
        });
    });
    $("#btnAddSpotContract").click(function () {
        $.when(clearSpotModalStuff()).done(function () {
            $("#spotContractModal").modal('show');
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

        dataObj.services = selectedServices;





        dataObj.equipment = $("#inputContractModal_equipment").val();
        var inputEquipmentText = $("#inputContractModal_equipment").val();
        var equipmentSelect = equipmentDB({
            name: inputEquipmentText
        }).select("id");
        dataObj.EquipmentId = equipmentSelect[0];

        dataObj.demurrage = $("#inputContractModal_demurrage").val();
        dataObj.start_date = $("#inputContractModal_startDate").val();
        dataObj.end_date = $("#inputContractModal_endDate").val();       


        var pickedCommodities = [];

        $(".pickedCommodityItem").each(function () {
            var pickedId = $(this).attr("data-commodity-id");
            //var pickedPieces = $(this).attr("data-pieceCount");
            var pickedTonnage = $(this).attr("data-tonnage");
            var pickedNetOrMetric = $(this).attr("data-net-or-metric");

            //var pickedBill = $(this).attr("data-billLaden");
            var pickedObject = {
                "id": pickedId,
               // "pieces": pickedPieces,
                "tonnage": pickedTonnage,
                "netOrMetric" : pickedNetOrMetric
               // "bill_lading": pickedBill
            };
            pickedCommodities.push(pickedObject);


            //console.log(pickedId);
        });
        dataObj.commodities = pickedCommodities;



        dataObj.notes = $("#inputContractModal_notes").val();

        dataObj.rateData = getRateData();

        if (currentId == "new") {

            console.log("new contract");
            var promise = Mblx.Contracts.DataAccess.addContract(dataObj);
            promise.then(onAddContractComplete, onErrorFunction);
            console.log(dataObj);
        } else {
            var promise = Mblx.Contracts.DataAccess.updateContract(dataObj);
            promise.then(onUpdateContractComplete, onErrorFunction);

            console.log("editing contract " + currentId);
            console.log(dataObj);
        }
    });
    
    $("#btnContractModal_save_Annual").click(function () {
        var dataObj = new Object();

        dataObj.type = "CUST";

        var currentId = $("#contractsModal").attr('data-current-contractId');

        dataObj.customerName = $("#inputContractModal_customer_Annual").val();
        var inputCustText = $("#inputContractModal_customer_Annual").val();
        var custSelect = custDB({
            name: inputCustText
        }).select("id");
        dataObj.customerId = custSelect[0];

        dataObj.contractNumber = $("#inputContractModal_contractNumber_Annual").val();

        dataObj.services = selectedServices;





        dataObj.equipment = $("#inputContractModal_equipment_Annual").val();
        var inputEquipmentText = $("#inputContractModal_equipment_Annual").val();
        var equipmentSelect = equipmentDB({
            name: inputEquipmentText
        }).select("id");
        dataObj.EquipmentId = equipmentSelect[0];


        dataObj.demurrage = $("#inputContractModal_demurrage_Annual").val();
        dataObj.start_date = $("#inputContractModal_startDate_Annual").val();
        dataObj.end_date = $("#inputContractModal_endDate_Annual").val();
       


        var pickedCommodities = [];

        $(".pickedCommodityItem").each(function () {
            var pickedId = $(this).attr("data-commodity-id-annual");
            //var pickedPieces = $(this).attr("data-pieceCount");
            var pickedTonnage = $(this).attr("data-tonnage");
            var pickedNetOrMetric = $(this).attr("data-net-or-metric-annual");

            //var pickedBill = $(this).attr("data-billLaden");
            var pickedObject = {
                "id": pickedId,
               // "pieces": pickedPieces,
                "tonnage": pickedTonnage,
                "netOrMetric" : pickedNetOrMetric
               // "bill_lading": pickedBill
            };
            pickedCommodities.push(pickedObject);


            //console.log(pickedId);
        });
        dataObj.commodities = pickedCommodities;



        dataObj.notes = $("#inputContractModal_notes_Annual").val();

        dataObj.rateData = getRateData();

        if (currentId == "new") {

            console.log("new contract");
            var promise = Mblx.Contracts.DataAccess.addContract(dataObj);
            promise.then(onAddContractComplete, onErrorFunction); 
            console.log(dataObj);
        } else {
           var promise = Mblx.Contracts.DataAccess.updateContract(dataObj);
            promise.then(onUpdateContractComplete, onErrorFunction);

            console.log("editing contract " + currentId);
            console.log(dataObj);
        }
    });

//Spot Modal Commod
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
//Annual Modal Commod    
    $("#commoditiesList_Annual").on("click", "a", function () {
        var $selectedThing = $(this);
        var selCommId = $selectedThing.attr('data-commodity-id-annual');
        var selCommUom = commDB({
            id: parseInt(selCommId)
        }).select('uom');
        $.when($(".commodityListItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });
        $("#pieceCountUOMLabel_Annual").html(selCommUom);
    });


//Spot Modal Commod
    $("#pickedCommoditiesList").on("click", "li", function () {
        var $selectedThing = $(this);
        var pickedCommId = $selectedThing.attr('data-commodity-id');
        $.when($(".pickedCommodityItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });
    });
    


//  Spot Modal Commod Filter
    $("#commodityFilterInput").keyup(function () {
        if ($("#commodityFilterInput").val() == 0) {$('.commodityListItem').addClass('hideMe')}
       else {
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
    } });

// Annual Modal Commod Filter
        $("#commodityFilterInput_Annual").keyup(function () {
        if ($("#commodityFilterInput_Annual").val() == "showall") {$('.commodityListItem').removeClass('hideMe')}
    else {
        var filterString = $("#commodityFilterInput_Annual").val();
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
                $(".commodityListItem[data-commodity-id-annual='" + valu + "']").removeClass('hideMe');
            });
        });
    }});

    $("#commodityFilterInput_Annual").keyup(function () {
        if ($("#commodityFilterInput_Annual").val() == 0) {$('.commodityListItem').addClass('hideMe')}
        else return
})
   
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
        //var selPieceCount = $("#inputPieceCount").val();
        var selTonnage = $("#inputTonnage").val();
        // var selBillLaden = $("#inputBillLaden").val();
        var netOrMetricBadge = ($("#netTonsRadio").is(':checked')) ? 'Net' : 'Metric';
        var pickedItemString = '<li id="selectedCommodityItem' + selCommId + '" data-commodity-id=' + selCommId + ' data-net-or-metric=' + netOrMetricBadge + ' data-tonnage=' + selTonnage + ' class="list-group-item pickedCommodityItem"><a style="color: red; margin-right: 1.5em;" onclick="removeCommodityItem(' + selCommId + ')" class="pull-left"><span class="glyphicon glyphicon-minus-sign"></span></a><span class="badge">' + selTonnage + ' ' + netOrMetricBadge + ' Tons</span>' + selCommName + '</li>';
        $.when($("#pickedCommoditiesList").append(pickedItemString)).done(function () {
            //$("#inputPieceCount").val('');
            $("#inputTonnage").val('');
            //$("#inputBillLaden").val('');
            $("#commodityFilterInput").val('');
            $(".commodityListItem").addClass('hideMe');
        });
        //console.log(selCommName);
    });

    $("#selectCommodityButton_Annual").click(function () {
        var $selectedThing = $(".commodityListItem.active");
        var selCommId = $selectedThing.attr('data-commodity-id-annual');
        var selCommName = commDB({
            id: parseInt(selCommId)
        }).select('name');
        var selCommDesc = commDB({
            id: parseInt(selCommId)
        }).select('desc');
        var selCommUom = commDB({
            id: parseInt(selCommId)
        }).select('uom');
        //var selPieceCount = $("#inputPieceCount").val();
        var selTonnage = $("#inputTonnage_Annual").val();
        // var selBillLaden = $("#inputBillLaden").val();
        var netOrMetricBadge = ($("#netTonsRadio_Annual").is(':checked')) ? 'Net' : 'Metric';
        var pickedItemString = '<li id="selectedCommodityItem' + selCommId + '" data-commodity-id-annual=' + selCommId + ' data-net-or-metric-annual=' + netOrMetricBadge + ' data-tonnage-annual=' + selTonnage + ' class="list-group-item pickedCommodityItem"><a style="color: red; margin-right: 1.5em;" onclick="removeCommodityItem(' + selCommId + ')" class="pull-left"><span class="glyphicon glyphicon-minus-sign"></span></a><span class="badge">' + selTonnage + ' ' + netOrMetricBadge + ' Tons</span>' + selCommName + '</li>';
        $.when($("#pickedCommoditiesList_Annual").append(pickedItemString)).done(function () {
            //$("#inputPieceCount").val('');
            $("#inputTonnage_Annual").val('');
            //$("#inputBillLaden").val('');
            $("#commodityFilterInput_Annual").val('');
            $(".commodityListItem").addClass('hideMe');
        });
        //console.log(selCommName);
    });


});

var initialLoadTasks = function () {
    $("#inputContractModal_demurrage, #inputContractModal_demurrage_Annual").val(130.00);

    getCustomers();
    getServices();
    getOriginsDestinationsAndTerminals();

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

function clearAnnualModalStuff() {
    $("#annualContractModal").attr('data-current-contractId-Annual', "new");
    $(".modalInput").val("");
    $("#contractsModalLabel").html("Add New Contract");
}

function clearSpotModalStuff() {
    $("#spotContractModal").attr('data-current-contractId', "new");
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

function getOriginsDestinationsAndTerminals() {
    $.when($('.destinationListItem').remove()).done(function () {
        var promise = Mblx.Destinations.DataAccess.getDestinations();
        promise.then(onGetDestinationsComplete, onErrorFunction);
    });
    $.when($('.originListItem').remove()).done(function () {
        var promise2 = Mblx.Origins.DataAccess.getOrigins();
        promise2.then(onGetOriginsComplete, onErrorFunction);
    });
    $.when($('.terminalListItem').remove()).done(function () {
        var promise3 = Mblx.Terminals.DataAccess.getTerminals();
        promise3.then(onGetTerminalsComplete, onErrorFunction);
    });
}

/*
function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    $.each(data, function (q, r) {
        commDB.insert(r);
        listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h5 class="list-group-item-heading">' + r.name + '</h5><p class="list-group-item-text">' + r.desc + '</p></a>';
    });
    $.when($("#commoditiesList").html(listString)).done(function () {
        //console.log("typeahead time");
    });
}
*/
function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    var listStringAnnual = "";

    $.each(data, function (q, r) {
        commDB.insert(r);
        listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h5 class="list-group-item-heading">' + r.name + '</h5><p class="list-group-item-text">' + r.desc + '</p></a>';
        listStringAnnual += '<a data-commodity-id-annual="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h5 class="list-group-item-heading">' + r.name + '</h5><p class="list-group-item-text">' + r.desc + '</p></a>'
    });
    $.when($("#commoditiesList").html(listString)).done(function () {
        //////console.log("typeahead time");
    });
    $.when($("#commoditiesList_Annual").html(listStringAnnual)).done(function () {
        //////console.log("typeahead time");
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
    console.log('on get services complete');
    var data = dataz.data;
    data.sort(function (a, b) {
        if (a.id > b.id) {
            return 1;
        }
        if (a.id < b.id) {
            return -1;
        }
        return 0;
    });
    var counter = 0;
    var leftListItemString = "";
    var rightListItemString = "";
    var leftListItemStringAnnual = "";
    var rightListItemStringAnnual = "";

    jQuery.each(data, function (q, r) {
        serviceDB.insert(r);
        serviceList.push(jsSafe(r.name));
        var stripeRowClassString = (counter % 2 === 0) ? "evenStripeRow" : "oddStripeRow";
        //listItemString += '<li class="serviceListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_services\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.description + '</span></a></li>';
        if (counter < 6) {
            leftListItemString += '<li id="serviceItem' + r.id + '" class="serviceListItem list-group-item ' + stripeRowClassString + ' " data-service-id="' + r.id + '"><input class="serviceCheck" type="checkbox" value="' + r.id + '">&nbsp' + r.name + '</li>';

        } else {
            rightListItemString += '<li id="serviceItem' + r.id + '" class="serviceListItem list-group-item ' + stripeRowClassString + ' " data-service-id="' + r.id + '"><input class="serviceCheck" type="checkbox" value="' + r.id + '">&nbsp' + r.name + '</li>';

        }
        counter++;
    });
    jQuery.each(data, function (q, r) {
        serviceDB.insert(r);
        serviceList.push(jsSafe(r.name));
        var stripeRowClassString = (counter % 2 == 0) ? "evenStripeRow" : "oddStripeRow";
        //listItemString += '<li class="serviceListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_services\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.description + '</span></a></li>';
        if (counter < 18) {
            leftListItemStringAnnual += '<li id="annual_serviceItem' + r.id + '" class="serviceListItem list-group-item ' + stripeRowClassString + ' " data-service-id-annual="' + r.id + '"><input class="serviceCheck" type="checkbox" value="' + r.id + '">' + r.name + '</li>';

        } else {
            rightListItemStringAnnual += '<li id="annual_serviceItem' + r.id + '" class="serviceListItem list-group-item ' + stripeRowClassString + ' " data-service-id-annual="' + r.id + '"><input class="serviceCheck" type="checkbox" value="' + r.id + '">' + r.name + '</li>';

        }
        counter++;
    });
    $("#servicesListLeft").append(leftListItemString);
    $("#servicesListRight").append(rightListItemString);
    $("#servicesListLeft_Annual").append(leftListItemStringAnnual);
    $("#servicesListRight_Annual").append(rightListItemStringAnnual);

}



function onGetEquipmentComplete(dataz) {

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
    var listItemStringAnnual = "";
    jQuery.each(data, function (q, r) {
        equipmentDB.insert(r);
        equipmentList.push(jsSafe(r.name));
        listItemString += '<li class="equipmentListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_equipment\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    listItemStringAnnual += '<li class="equipmentListItem"><a class="serviceListItemLink" onClick="populateField(\'inputContractModal_equipment_Annual\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#equipmentDropdown").append(listItemString);
    $("#equipmentDropdown_Annual").append(listItemStringAnnual);
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
    data.sort(function (a, b) {
        if (a.customer_name > b.customer_name) {
            return 1;
        }
        if (a.customer_name < b.customer_name) {
            return -1;
        }
        return 0;
    });
    var listItemString = "";
    jQuery.each(data, function (q, r) {

        contractDB.insert(r);


        var endDate = new Date(r.end_date);

        var todayDateBuilder = new Date();
        var mm = todayDateBuilder.getMonth();
        var dd = todayDateBuilder.getDate();
        var yy = todayDateBuilder.getFullYear();
        var todayDate = new Date(yy, mm, dd);

        listItemString += (endDate > todayDate) ? '<tr data-contract-id="' + r.id + '">' : '<tr class="expiredContract hideMe" data-contract-id="' + r.id + '">';
        listItemString += '<td><button type="button" onclick="showContractModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>';
        listItemString += '<td>' + r.customer_name + '</td>';
        listItemString += '<td>' + r.contract_number + '</td>';
        listItemString += '<td>' + r.equipment_name + '</td>';
        listItemString += '<td>' + r.start_date + '</td>';
        listItemString += '<td>' + r.end_date + '</td>';
        listItemString += '<td>' + r.demurrage + '</td>';

        if (r.notes) {
            listItemString += '<td>' + r.notes + '</td>';
        } else {
            listItemString += '<td>' + '' + '</td>';
        }
        
        listItemString += '</tr>';
    });
    $("#contractTbody").append(listItemString);
    $("#contractLoadingGif").addClass('hideMe');
    $("#theContainer").removeClass('hideMe');
}

function onGetDestinationsComplete(dataz) {
    var data = dataz.data;

    var leftStringList = [];
    var middleStringList = [];
    var rightStringList = [];
    var arrayCount = 0;

    data.sort(function (a, b) {
        if (a.name < b.name) return -1; 
        if (a.name < b.name) return 1;
        return 0;
    });
        console.log(data);
    jQuery.each(data, function (q, r) {

        destinationDB.insert(r);
        destinationList.push(r.name);
        leftStringList[arrayCount] = '<li class="destinationListItem"><a class="destinationListItemLink" onClick="populateButton(\'';
        middleStringList[arrayCount] = 'DestinationButton';
        rightStringList[arrayCount] = '\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
        arrayCount++;
    });
    //console.log(listItemString);
    $.when($(".destinationDropdown").empty()).done(function () {
        var arrCount = 0;
        $(".destinationDropdown").each(function (j, k) {
            var spotOrAnnualText = ($(this).closest('tbody').attr('id') == "annualRateTableTbody") ? 'annual' : 'spot';
             
            var iterator = ($(this).closest('tbody').attr('id') == "annualRateTableTbody") ? j - 1 : j;
            console.log(iterator)
            var stringToAppend = "";
            for (var q = 0; q < leftStringList.length; q++) {
                stringToAppend += leftStringList[q] + spotOrAnnualText + middleStringList[q] + iterator + rightStringList[q];
            }
            $(this).append(stringToAppend);
            arrCount++;
        });
        
    });
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
    var leftStringList = [];
    var middleStringList = [];
    var rightStringList = [];
    var arrayCount = 0;
    jQuery.each(data, function (q, r) {
        originDB.insert(r);
        originList.push(r.name);
        leftStringList[arrayCount] = '<li class="originListItem"><a class="originListItemLink" onClick="populateButton(\'';
        middleStringList[arrayCount] = 'OriginButton';
        rightStringList[arrayCount] = '\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.country + '</span></a></li>';
        arrayCount++;
    });
    //console.log(listItemString);
    $.when($(".originDropdown").empty()).done(function () {
        var arrCount = 0;
        $(".originDropdown").each(function (j, k) {
            //console.log(j);
            //console.log(k);
            var spotOrAnnualText = ($(this).closest('tbody').attr('id') == "annualRateTableTbody") ? 'annual' : 'spot';

            var iterator = ($(this).closest('tbody').attr('id') == "annualRateTableTbody") ? j - 1 : j;
            console.log(iterator)
            var stringToAppend = "";
            for (var q = 0; q < leftStringList.length; q++) {
                stringToAppend += leftStringList[q] + spotOrAnnualText + middleStringList[q] + iterator + rightStringList[q];
            }
            $(this).append(stringToAppend);
            arrCount++;
        });
        
    });

}



function onGetTerminalsComplete(dataz) {
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
    var leftStringList = [];
    var middleStringList = [];
    var rightStringList = [];
    var arrayCount = 0;
    jQuery.each(data, function (q, r) {
        terminalDB.insert(r);
        terminalList.push(r.name);

        ///////// terminalListItem_<dropdown#>_<terminalID>

        leftStringList[arrayCount] = '<li class="terminalListItem" id="terminalListItem_';
        middleStringList[arrayCount] = '_' + r.id + '"><a class="terminalListItemLink" onClick="populateButton(\'terminalButton';
        rightStringList[arrayCount] = '\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
        arrayCount++;
    });
    //console.log(listItemString);
    $.when($(".terminalDropdown").empty()).done(function () {
        var arrCount = 0;
        $(".terminalDropdown").each(function (j, k) {
            //console.log(j);
            //console.log(k);
            var stringToAppend = "";
            for (var q = 0; q < leftStringList.length; q++) {
                stringToAppend += leftStringList[q] + j + middleStringList[q] + j + rightStringList[q];
            }
            $(this).append(stringToAppend);
            arrCount++;
        });
        
    });

}

function showContractModal(contractID) {
    var selectedContractData = contractDB({
        id: {
            is: contractID
        }
    }).get();
    $("#spotContractModal").attr('data-current-contractId', contractID);
    $("#contractsModalLabel").html("Editing " + selectedContractData[0].contract_number + ' ' + selectedContractData[0].customer_name);
    $("#inputContractModal_customer").val(selectedContractData[0].customer_name);
    $("#inputContractModal_contractNumber").val(selectedContractData[0].contract_number);

    var servicesList = selectedContractData[0].services;

    $.each(servicesList, function (x, y) {
        console.log(y);
        var idToSelect = y.service_id;
        $("#serviceItem" + idToSelect + "").addClass('active');
    });
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

    var rateList = contractDB({ id: contractID }).select("rates");
    var rateArray = new Array();
    var numberOfDifferentRates = 0;
    var pairCount = 0;
    var ratesListed = new Array();
    $.each(rateList[0], function (a, b) {
        //console.log(a);
        //console.log(b);
        pairCount++;
        var rateObject = new Object();
        var rateStuff = Object.keys(b);
        rateObject["origin"] = b.origin_id;
        rateObject["destination"] = b.destination_id;
        var matchCount = 0;
        $.each(rateStuff, function (c, d) {
           
            if (b[d] !== null && d.match(/rate_value/mg)) {
                var myRate = "";
                var myregexp = /rate_value_(.*)/m;
                var match = myregexp.exec(d);
                if (match != null) {
                    myRate = match[1];
                    matchCount++;
                    if (ratesListed.indexOf(match[1]) == -1) {
                        ratesListed.push(match[1]);
                    }
                } 
                rateObject[myRate] = b[d];
                //console.log(myRate);
                //console.log(myRate + '=' + b[d]);
            }
           // rateArray.push(rateObject);
        });
        if (matchCount > numberOfDifferentRates) {
            numberOfDifferentRates = matchCount;
        }
        rateArray.push(rateObject);
    });
    console.log(rateArray);
    console.log(ratesListed);
    console.log(pairCount + " pairs");
    console.log("different Rates " + numberOfDifferentRates);
    var rateInputColString = "";
    var rateHeadString = "<th>Origin</th><th>Destination</th>";
  
    for (var b = 0; b < numberOfDifferentRates; b++) {
        rateHeadString += '<th><select class="form-control firstMinimum" data-sequence="' + b + '"><option value="AQ">AQ</option><option value="300">300</option><option value="500">500</option><option value="800">800</option><option value="1000">1000</option><option value="1200">1200</option><option value="1400">1400</option><option value="1600">1600</option><option value="FLAT">Flat Charge</option></select></th>';
        rateInputColString += '<td class="rateTableEmptyRateCell"><input class="rateInput form-control" placeholder="N/A" data-sequence="' + b + '"/></td>';
        spotColCounter++;
    }
    var rowCounter = 1;
    var rowString = "";
    for (var h = 0; h < pairCount; h++) {
        rowString += '<tr class="rateTableRow" data-row-sequence="' + h + '"><td><div class="btn-group col-xs-12"><button id="spotOriginButton' + h + '" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">Origin &nbsp;<span class="caret pull-right"></span> </button><ul class="originDropdown dropdown-menu" role="menu"><li class="divider"></li></ul></div></td><td><div class="btn-group col-xs-12"><button type="button" id="spotDestinationButton' + h + '" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button><ul class="destinationDropdown dropdown-menu" role="menu"><li><a href="pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a> </li><li class="divider"></li></ul></div></td>' + rateInputColString + '</tr>';
        rowCounter++;
    }

   

    $("#rateTableHeadRow").html(rateHeadString);



    $.when($("#spotRateTableTbody").html(rowString)).done(function () {
        getOriginsDestinationsAndTerminals();
    });

    for (var t = 0; t < numberOfDifferentRates; t++) {
        $("#rateTableHead").find("[data-sequence=\"" + t + "\"]").val(ratesListed[t]);
        
    }

    for (var x = 0; x < pairCount; x++) {
        for (var z = 0; z < numberOfDifferentRates; z++) {
            $('.rateTableRow[data-row-sequence="' + x + '"]').find("[data-sequence=\"" + z + "\"]").val(rateArray[x][ratesListed[z]]);
        }
        var originID = rateArray[x].origin;
        var originTexts = originDB({ id: originID }).select("name");
        var originText = originTexts[0];

        var destinationID = rateArray[x].destination;
        var destinationTexts = destinationDB({ id: destinationID }).select("name");
        var destinationText = destinationTexts[0];

        $("#spotOriginButton" + x).text(originText);

       
        $("#spotDestinationButton" + x).text(destinationText);
    }

    //$.each(rateArray, function (q, w) { });
    $("#spotContractModal").modal('show');
}


function showContractModal_Annual(contractID) {
    var selectedContractData = contractDB({
        id: {
            is: contractID
        }
    }).get();
    $("#annualContractModal").attr('data-current-contractid-annual', contractID);
    $("#contractsModalLabel_Annual").html("Editing " + selectedContractData[0].contract_number + ' ' + selectedContractData[0].customer_name);
    $("#inputContractModal_customer_Annual_Annual").val(selectedContractData[0].customer_name);
    $("#inputContractModal_contractNumber_Annual").val(selectedContractData[0].contract_number);

    var servicesList = selectedContractData[0].services;

    $.each(servicesList, function (x, y) {
        console.log(y);
        var idToSelect = y.service_id;
        $("#annual_serviceItem" + idToSelect + "").addClass('active');
    });
    $("#inputContractModal_services_Annual").val(selectedContractData[0].service_name);
    $("#inputContractModal_origin_Annual").val(selectedContractData[0].origin_name);
    $("#inputContractModal_destination_Annual").val(selectedContractData[0].destination_name);
    $("#inputContractModal_equipment_Annual").val(selectedContractData[0].equipment_name);
    $("#inputContractModal_bargeMinimum_Annual").val(selectedContractData[0].barge_minimum);
    $("#inputContractModal_rate_Annual").val(selectedContractData[0].rate);
    $("#inputContractModal_demurrage_Annual").val(selectedContractData[0].demurrage);
    $("#inputContractModal_startDate_Annual").val(selectedContractData[0].start_date);
    $("#inputContractModal_endDate_Annual").val(selectedContractData[0].end_date);
    $("#inputContractModal_free_days_Annual").val(selectedContractData[0].free_days);
    $("#inputContractModal_notes_Annual").val(selectedContractData[0].notes);

    var rateList = contractDB({ id: contractID }).select("rates");
    var rateArray = new Array();
    var numberOfDifferentRates = 0;
    var pairCount = 0;
    var ratesListed = new Array();
    $.each(rateList[0], function (a, b) {
        //console.log(a);
        //console.log(b);
        pairCount++;
        var rateObject = new Object();
        var rateStuff = Object.keys(b);
        rateObject["origin"] = b.origin_id;
        rateObject["destination"] = b.destination_id;
        var matchCount = 0;
        $.each(rateStuff, function (c, d) {
           
            if (b[d] !== null && d.match(/rate_value/mg)) {
                var myRate = "";
                var myregexp = /rate_value_(.*)/m;
                var match = myregexp.exec(d);
                if (match != null) {
                    myRate = match[1];
                    matchCount++;
                    if (ratesListed.indexOf(match[1]) == -1) {
                        ratesListed.push(match[1]);
                    }
                } 
                rateObject[myRate] = b[d];
                //console.log(myRate);
                //console.log(myRate + '=' + b[d]);
            }
           // rateArray.push(rateObject);
        });
        if (matchCount > numberOfDifferentRates) {
            numberOfDifferentRates = matchCount;
        }
        rateArray.push(rateObject);
    });
    console.log(rateArray);
    console.log(ratesListed);
    console.log(pairCount + " pairs");
    console.log("different Rates " + numberOfDifferentRates);
    var rateInputColString = "";
    var rateHeadString = "<th>Origin</th><th>Destination</th>";
  
    for (var b = 0; b < numberOfDifferentRates; b++) {
        rateHeadString += '<th><select class="form-control firstMinimum" data-sequence-annual="' + b + '"><option value="AQ">AQ</option><option value="300">300</option><option value="500">500</option><option value="800">800</option><option value="1000">1000</option><option value="1200">1200</option><option value="1400">1400</option><option value="1600">1600</option><option value="FLAT">Flat Charge</option></select></th>';
        rateInputColString += '<td class="rateTableEmptyRateCell"><input class="rateInput form-control" placeholder="N/A" data-sequence="' + b + '"/></td>';
        spotColCounter++;
    }
    var rowCounter = 1;
    var rowString = "";
    for (var h = 0; h < pairCount; h++) {
        // in rowString, buttons are setup in spot/annualDestination/Origin + id string
        rowString += '<tr class="rateTableRow" data-row-sequence-annual="' + h + '"><td><div class="btn-group col-xs-12"><button id="annualOriginButton' + h + '" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">Origin &nbsp;<span class="caret pull-right"></span> </button><ul class="originDropdown dropdown-menu" role="menu"><li class="divider"></li></ul></div></td><td><div class="btn-group col-xs-12"><button type="button" id="annualDestinationButton' + h + '" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button><ul class="destinationDropdown dropdown-menu" role="menu"><li><a href="pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a> </li><li class="divider"></li></ul></div></td>' + rateInputColString + '</tr>';
        rowCounter++;
    }

   

    $("#rateTableHeadRow_Annual").html(rateHeadString);



    $.when($("#annualRateTableTbody").html(rowString)).done(function () {
        getOriginsDestinationsAndTerminals();
    });

    for (var t = 0; t < numberOfDifferentRates; t++) {
        $("#rateTableHead_Annual").find("[data-sequence-annual=\"" + t + "\"]").val(ratesListed[t]);
        
    }

    for (var x = 0; x < pairCount; x++) {
        for (var z = 0; z < numberOfDifferentRates; z++) {
            $('.rateTableRow[data-row-sequence-annual="' + x + '"]').find("[data-sequence-annual=\"" + z + "\"]").val(rateArray[x][ratesListed[z]]);
        }
        var originID = rateArray[x].origin;
        var originTexts = originDB({ id: originID }).select("name");
        var originText = originTexts[0];

        var destinationID = rateArray[x].destination;
        var destinationTexts = destinationDB({ id: destinationID }).select("name");
        var destinationText = destinationTexts[0];

        $("#annualOriginButton" + x).text(originText);

       
        $("#annualDestinationButton" + x).text(destinationText);
    }

    //$.each(rateArray, function (q, w) { });
    $("#annualContractModal").modal('show');
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
    var listItemStringAnnual = "";

    jQuery.each(data, function (q, r) {
        custDB.insert(r);
        custNames.push(r.name);

        listItemString += '<li class="customerListItem"><a class="customerListItemLink" onClick="populateField(\'inputContractModal_customer\',\'' + jsSafe(r.name) + '\')" data-toggle="dropdown" data-target="customerDropdown" data-customerId="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';
        listItemStringAnnual += '<li class="customerListItem"><a class="customerListItemLink" onClick="populateField(\'inputContractModal_customer_Annual\',\'' + jsSafe(r.name) + '\')" data-toggle="dropdown" data-target="customerDropdown_Annual" data-customerId-Annual="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';
    });
    $("#customerDropdown").append(listItemString);
    $("#customerDropdown_Annual").append(listItemStringAnnual);
    $('#inputContractModal_customer').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
            name: 'custNames',
            displayKey: 'value',
            source: substringMatcher(custNames)
        });
     $('#inputContractModal_customer_Annual').typeahead({
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


function limitTerminals(field, dest_name) {
    var terminals = terminalDB({ destination_city: dest_name }).select("id");
    var myregexp = /spotDestinationButton(\d*)/;
    var match = myregexp.exec(field);
    if (match != null) {
        result = match[1];
        $("li[id^='terminalListItem_" + result + "']").each(function () {
            $(this).addClass('hideMe')
        });
        $.each(terminals, function (q, r) {
            var terminalListSelector = $("#terminalListItem_" + result + "_" + r + "");
            $(terminalListSelector).removeClass('hideMe');
        });
    } else {
        console.log("terminal digit getter didn't work");
    }
}


function populateButton(buttonId, value) {
    event.preventDefault();
    if (buttonId.match(/spotDestinationButton/)) {
        console.log('limiting ' + buttonId + ' to ' + value);
        limitTerminals(buttonId, value);
    }
    $("#" + buttonId).text(value);
}

function getRateData() {
    var rateDataArr = new Array();
    $(".rateTableTbody tr").each(function (qq, rr) {
        var rateDataObj = new Object();
        //console.log(qq);

        var originText = $(this).find(".btnOrigin").text();
        //console.log(originText);

        var destinationText = $(this).find(".btnDest").text();
        // console.log(destinationText);


        var originSelect = originDB({
            name: originText
        }).select("id");
        rateDataObj.originId = originSelect[0];

        // console.log(originId);


        var destinationSelect = destinationDB({
            name: destinationText
        }).select("id");
        rateDataObj.destinationId = destinationSelect[0];
        // console.log(destId);
        // var rateSequences = new Array();

        var rateInputs = $(this).find(".rateInput");
        $.each(rateInputs, function (g, a) {
            var seq = $(this).attr("data-sequence");
            var rateSelected = $("#rateTableHead").find("[data-sequence=\"" + seq + "\"]").val();
            var rateEntered = $(this).val();
            console.log("rate / value" + rateSelected + ' ' + rateEntered);
            //rateSequences[seq] = rateSelected;
            rateDataObj[rateSelected] = rateEntered;
        });

        rateDataArr.push(rateDataObj);
    });
    console.log(rateDataArr);
    return rateDataArr;
}
function onErrorFunction(error) {
    //console.log("error performing operation");
    //console.log(error);
}
function removeCommodityItem(commodityId) {
    console.log(commodityId);
    $("#selectedCommodityItem" + commodityId + "").remove();
}
var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substrRegex;
        matches = [];
        substrRegex = new RegExp(q, 'i');
        $.each(strs, function (i, str) {
            if (substrRegex.test(str)) {
                matches.push({
                    value: str
                });
            }
        });
        cb(matches);
    };
};