/// <reference path="../../public/js/taffy.js" />
/// <reference path="../../public/js/jquery-1.11.2.js" />
var custNames = [];
var vesselNames = [];
var vesselDB = TAFFY();
var terminalNames = [];
var contractInfo = [];
var brokerList = [];
var carrierList = [];
var bargeDB = TAFFY();
var bargeList = [];
var serviceList = [];
var stevedoreList = [];
var wharfList = [];
var agentList = [];
var originDB = TAFFY();
var originList = [];
var countryList = [];
var agentDB = TAFFY();
var vesselTripDB = TAFFY();
var vesselTripList = [];
var destinationList = [];
var carrierContractInfo = [];
var commDB = TAFFY();
//var carrierDB = TAFFY();
var custDB = TAFFY();
var carrierDB = TAFFY();
var contractDB = TAFFY();
var contractCommodityDB = TAFFY();
var brokerDB = TAFFY();
var serviceDB = TAFFY();
var destinationDB = TAFFY();
var terminalDB = TAFFY();
var stevedoreDB = TAFFY();
var wharfDB = TAFFY();
var countryDB = TAFFY();

//custDB({name:"Bob's Shipping Shack"}).select("id");
$(function () {
    $("#navTHings").children().removeClass("active");
    $("#newBookingNavButton").addClass("active");


    $('#contractSearchModalCustomerInput').bind('typeahead:selected', function (obj, datum, name) {
        
        var selectedCustomer = datum.value;
        var customerIds = custDB({ name: selectedCustomer }).select("id");
        var customerId = customerIds[0];
        selectCustomerForContractSearch(customerId);
    });

    $("#loadFromContractButton").click(function (event) {
        event.preventDefault();
        $("#contractSearchModal").modal('show');
    });
    $("#submitBookingButton").click(function (event) {
        if ($(this).hasClass("fadedButton")) {
            event.preventDefault();
            return false;
        }

        var selections = new Object();

        //customer input
        var inputCustText = $("#inputCustomer").val();
        var custSelect = custDB({ name: inputCustText }).select("id");
        selections.custId = custSelect[0];

        //booking dates
        selections.bookingDate = $("#inputBookingDate").val();
        selections.finalDate = $("#inputFinalDate").val();

        //as400 number
        selections.bookingNumber = $("#inputBookingNumber").val();

        //transportation 
        selections.transportation = $("#btnTransportation").text();

        //broker
        var inputBrokerText = $("#inputBroker").val();
        var brokerSelect = brokerDB({ name: inputBrokerText }).select("id");
        selections.brokerId = brokerSelect[0];



        //destination
        var inputDestinationText = $("#inputDestination").val();
        var destinationSelect = destinationDB({ name: inputDestinationText }).select("id");
        selections.destinationId = destinationSelect[0];

        //terminal
        var inputTerminalText = $("#inputTerminal").val();
        var terminalSelect = terminalDB({ name: inputTerminalText }).select("id");
        selections.terminalId = terminalSelect[0];

        //booking company
        var inputBookingCompanyText = $("#inputCarrier").val();
        selections.booking_company = inputBookingCompanyText;

        //service
        var inputServiceText = $("#inputService").val();
        var serviceSelect = serviceDB({ description: inputServiceText }).select("id");
        selections.serviceId = serviceSelect[0];

        //customer contract
        var inputContractText = $("#inputContract").val();
        var myregexpContract = /(\d*)\s-\s(.*)/m;
        var matchContract = myregexpContract.exec(inputContractText);
        if (matchContract != null) {
            var contractSelect = contractDB({ customer_name: matchContract[2], contract_number: matchContract[1] }).select("id");
            selections.customer_contractId = contractSelect[0];
        } else {
            alert("error");
        }

        //carrier contract
        var inputCarrierContractText = $("#inputCarrierContract").val();
        var myregexpCarrierContract = /(\d*)\s-\s(.*)/m;
        var matchCarrierContract = myregexpCarrierContract.exec(inputCarrierContractText);
        if (matchCarrierContract != null) {
            var carrierContractSelect = contractDB({ customer_name: matchContract[2], contract_number: matchContract[1] }).select("id");
            selections.carrier_contractId = carrierContractSelect[0];
        } else {
            alert("error");
        }
        //customer reference
        selections.customerReference = $("#inputCustomerReference").val();

        //status
        selections.status = $("#btnType").text();

      

        //vessel trip number
        var vesselTripNameText = $("#vesselTripSelectorButton").val();
        var vesselTripNameSelect = vesselTripDB({ name: vesselTripNameText }).select("id");
        selections.vesselTripId = vesselTripNameSelect[0];


        //console.log(selections);
        var promise = Mblx.Bookings.DataAccess.addBooking(selections);
        promise.then(onAddBookingComplete, onErrorFunction);
    });
    $(".newVesselTripInput").keyup(function () {
        if ($(this).parents(".form-group").hasClass("has-error")) {
            $(this).parents(".form-group").removeClass("has-error");
        }
    });
    $("#btnSaveNewVesselTrip").click(function (event) {
        event.preventDefault();
        if (!validateNewVesselTripForm()) {
            //console.log("NOT VAL");
        } else {
            //console.log("Val");
            
            //here we go

            var newVesselTrip = new Object();

            //vessel trip name
            var vesselTripNameText = $("#inputVesselTripName").val();
            newVesselTrip.name = vesselTripNameText;

            //voyage number
            var voyageNumberText = $("#inputVoyage").val();
            newVesselTrip.voyage_number = voyageNumberText;

            //vessel
            var inputVesselText = $("#inputVessel").val();
            var vesselSelect = vesselDB({ name: inputVesselText }).select("id");
            newVesselTrip.vesselId = vesselSelect[0];

            //eta date
            var etaDateText = $("#inputEtaDate").val();
            newVesselTrip.eta_date = etaDateText;

            //unload date
            var unloadDateText = $("#inputUnloadDate").val();
            newVesselTrip.unload_date = unloadDateText;


            //origin
            var inputCountryOfOriginText = $("#inputCountryOfOrigin").val();
            var countryOfOriginSelect = countryDB({ name: inputCountryOfOriginText }).select("id");
            newVesselTrip.country_of_origin_id = countryOfOriginSelect[0];

            //agent
            var inputAgentText = $("#inputAgent").val();
            var agentSelect = agentDB({ name: inputAgentText }).select("id");
            newVesselTrip.agentId = agentSelect[0];

            //stevedore
            var inputStevedoreText = $("#inputStevedore").val();
            var stevedoreSelect = stevedoreDB({ name: inputStevedoreText }).select("id");
            newVesselTrip.stevedoreId = stevedoreSelect[0];


            //wharf
            var  inputWharfText = $("#inputWharf").val();
            var wharfSelect = wharfDB({ name: inputWharfText }).select("id");
            newVesselTrip.wharfId = wharfSelect[0];

            newVesselTrip.barge_order_notes = "test";
            newVesselTrip.notes = "testNotes";
            //console.log(newVesselTrip);

            var promise = Mblx.Vessels.DataAccess.addVesselTrip(newVesselTrip);
            promise.then(onAddVesselTripComplete, onErrorFunction);

        }
    });
    $("#btnSelectExistingVesselTrip").click(function () {
        $("#btnSelectNewVesselTrip").removeClass("btn-success");
        $("#btnSelectExistingVesselTrip").addClass("btn-success");
        disableVesselTripForm();

    });

    $("#btnSelectNewVesselTrip").click(function () {

       
        $("#btnSelectExistingVesselTrip").removeClass("btn-success");
        $("#btnSelectNewVesselTrip").addClass("btn-success");
        enableVesselTripForm();
    });
    $("#btnCommodityTab").click(function () {
        $("div#vesselTab").addClass('hideMe');
        $("div#allocationsTab").addClass('hideMe');
        $("div#commodityTab").removeClass('hideMe');
        
    });
    $("#btnAllocationsTab").click(function () {
        $("div#vesselTab").addClass('hideMe');
        $("div#commodityTab").addClass('hideMe');
        $("div#allocationsTab").removeClass('hideMe');
    });
    $("#btnVesselTab").click(function () {
        $("div#vesselTab").removeClass('hideMe');
        $("div#commodityTab").addClass('hideMe');
        $("div#allocationsTab").addClass('hideMe');
    });
    $("a.transportListItem").click(function (event) {
        event.preventDefault();
        var selectedText = $(this).text();
        $("#btnTransportation").html(selectedText + '<span class="caret pull-right"></span>');
    });
    $("a.statusListItem").click(function (event) {
        event.preventDefault();
        var selectedText = $(this).text();
        $("#btnType").html(selectedText + '<span class="caret pull-right"></span>');
    });
    $("#btnDeletePickedCommodity").click(function () {
        var $selectedThing = $(".pickedCommodityItem.active");
        var selCommId = $selectedThing.attr('data-commodity-id');
        $selectedThing.remove();
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
        var pickedItemString = '<li id="selectedCommodityItem' + selCommId + '" data-commodity-id=' + selCommId + ' class="list-group-item pickedCommodityItem"><span class="badge">' + selPieceCount + ' Pieces</span><span class="badge">' + selTonnage + ' Tons</span><span class="badge">Bill ' + selBillLaden + '</span>' + selCommName + '</li>';
        $.when($("#pickedCommoditiesList").append(pickedItemString)).done(function () {
            $("#inputPieceCount").val('');
            $("#inputTonnage").val('');
            $("#inputBillLaden").val('');
            $("#commodityFilterInput").val('');
            $(".commodityListItem").addClass('hideMe');
        });
        ////console.log(selCommName);
    });
   
    $("#btnAddCustomerSave").click(function () {
        var custName = $("#inputAddCustomer_name").val();
        var custEmail = $("#inputAddCustomer_email").val();
        var custAddress = $("#inputAddCustomer_address").val();
        var custCity = $("#inputAddCustomer_city").val();
        var promise = Mblx.Customers.DataAccess.addCustomer(custName, custEmail, custAddress, custCity);
        promise.then(onAddCustomerSuccess, onErrorFunction);
    });
    $("#btnAddVesselSave").click(function () {
        var vesselName = $("#inputAddVessel_name").val();
        var promise = Mblx.Vessels.DataAccess.addVessel(vesselName);
        promise.then(onAddVesselSuccess, onErrorFunction);
    });
    $("#btnAddVesselTripSave").click(function () {
        var vesselID = $("#inputVesselModal option:selected").attr('data-vesselid');
        var vesselTripEta = $("#inputVesselTripEta").val();
        var promise = Mblx.Vessels.DataAccess.addVesselTrip(vesselID, vesselTripEta);
        promise.then(onAddVesselTripSuccess, onErrorFunction);
    });


    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy'
    });
    $("#inputBookingDate").val(getTodayFormattedDate());
    initialLoadTasks();
});

function initialLoadTasks() {
    getCustomers();
    //updateLoadingProgress((1 / 15) * 100);
    getAgents();
    //updateLoadingProgress((2 / 15) * 100);
    getStevedores();
    //updateLoadingProgress((3 / 15) * 100);
    getWharves();
    //updateLoadingProgress((4 / 15) * 100);
    getBrokers();
    //updateLoadingProgress((5 / 15) * 100);
    getServices();
    //updateLoadingProgress((6 / 15) * 100);
    getCarriers();
    //updateLoadingProgress((7 / 15) * 100);
    getDestinations();
    //updateLoadingProgress((8 / 15) * 100);
    getVessels();
    //updateLoadingProgress((9 / 15) * 100);

    //updateLoadingProgress((10 / 15) * 100);
    getCommodities();
    //updateLoadingProgress((11 / 15) * 100);
    getTerminals();
    //updateLoadingProgress((12 / 15) * 100);
    getContractCommodities();
    getCustomerContracts();
    getBarges();
    getCarrierContracts();

    getCountries();
    //updateLoadingProgress((15 / 15) * 100);
    getVesselTrips();
    
}

function enableVesselTripForm() {
    //$("#vesselTripSelectorButton").attr("disabled", "disabled");
    //$("#inputVesselTrip").attr("disabled", "disabled");
    $("#vesselTripSelectorButton").addClass("hideMe");
    $("#inputVoyage").removeAttr("disabled");
    $("#inputVesselTripName").removeClass('hideMe');
    $("#vesselButton").removeAttr("disabled");
    $("#agentButton").removeAttr("disabled");
    $("#stevedoreButton").removeAttr("disabled");
    $("#wharfButton").removeAttr("disabled");
    $("#inputVessel").removeAttr("disabled");
    $("#originButton").removeAttr("disabled");
    $("#inputOrigin").removeAttr("disabled");
    $("#inputAgent").removeAttr("disabled");
    $("#inputStevedore").removeAttr("disabled");
    $("#inputWharf").removeAttr("disabled");
    $("#inputEtaDate").removeAttr("disabled");
    $("#inputUnloadDate").removeAttr("disabled");
}
function disableVesselTripForm() {
    //$("#vesselTripSelectorButton").removeAttr("disabled");
    $("#vesselTripSelectorButton").removeClass("hideMe");
    //$("#inputVesselTrip").removeAttr("disabled");
    $("#inputVoyage").attr("disabled", "disabled");
    $("#inputVesselTripName").addClass('hideMe');
    $("#vesselButton").attr("disabled", "disabled");
    $("#agentButton").attr("disabled", "disabled");
    $("#stevedoreButton").attr("disabled", "disabled");
    $("#originButton").attr("disabled", "disabled");
    $("#wharfButton").attr("disabled", "disabled");
    $("#inputVessel").attr("disabled", "disabled");
    $("#inputAgent").attr("disabled", "disabled");
    $("#inputOrigin").attr("disabled", "disabled");
    $("#inputStevedore").attr("disabled", "disabled");
    $("#inputWharf").attr("disabled", "disabled");
    $("#inputEtaDate").attr("disabled", "disabled");
    $("#inputUnloadDate").attr("disabled", "disabled");
    
}

function validateNewVesselTripForm() {
    var returnThis = true;
    $.each($(".newVesselTripInput"), function (q, r) {
        var thisId = $(this).attr("id");
        if (typeof thisId != 'undefined') {
            //console.log(thisId);
            if (!$("#" + thisId).val()) {
                $("#" + thisId).parents(".form-group").addClass("has-error");
                //console.log("marking " + thisId);
                returnThis = false;
                return true;
            }
        }

    });
    return returnThis;
}


//name
//vesselTripSelections.friendlyName = $("#inputFinalDate").val();
//selections.finalDate = $("#inputFinalDate").val();

function updateLoadingProgress(widthz) {

    var widthString = Math.ceil(widthz).toString() + '%';
    $("#loadingProgressBar").attr("style", "width : " + widthString + ";");

    $("#loadingProgressBar").text(widthString);

}
function getCustomers() {
    $.when($('.customerListItem').remove()).done(function () {
        var promise = Mblx.Customers.DataAccess.getCustomers();
        promise.then(onGetCustomersComplete, onErrorFunction);
    });
}

function getContractCommodities() {
   
        var promise = Mblx.Contracts.DataAccess.getContractCommodities();
        promise.then(getContractCommoditiesComplete, onErrorFunction);
   
}
function getAgents() {
    $.when($('.agentListItem').remove()).done(function () {
        var promise = Mblx.Agents.DataAccess.getAgents();
        promise.then(onGetAgentsComplete, onErrorFunction);
    });
}
function getWharves() {
    $.when($('.wharfListItem').remove()).done(function () {
        var promise = Mblx.Wharves.DataAccess.getWharves();
        promise.then(onGetWharvesComplete, onErrorFunction);
    });
}

function getStevedores() {
    $.when($('.stevedoreListItem').remove()).done(function () {
        var promise = Mblx.Stevedores.DataAccess.getStevedores();
        promise.then(onGetStevedoresComplete, onErrorFunction);
    });
}
function getBrokers() {
    $.when($('.brokerListItem').remove()).done(function () {
        var promise = Mblx.Brokers.DataAccess.getBrokers();
        promise.then(onGetBrokersComplete, onErrorFunction);
    });
}

function getBarges() {
    $.when($('.bargeListItem').remove()).done(function () {
        var promise = Mblx.Barges.DataAccess.getBarges();
        promise.then(onGetBargesComplete, onErrorFunction);
    });
}


function getServices() {
    $.when($('.serviceListItem').remove()).done(function () {
        var promise = Mblx.Services.DataAccess.getServices();
        promise.then(onGetServicesComplete, onErrorFunction);
    });
}

function getCarriers() {
    $.when($('.carrierListItem').remove()).done(function () {
        var promise = Mblx.Carriers.DataAccess.getCarriers();
        promise.then(onGetCarriersComplete, onErrorFunction);

    });
}

function getCountries() {
    $.when($('.originListItem').remove()).done(function () {
        var promise = Mblx.Countries.DataAccess.getCountries();
        promise.then(onGetCountriesComplete, onErrorFunction);
    });
}
function getOrigins() {
    $.when($('.originListItem').remove()).done(function () {
        var promise = Mblx.Origins.DataAccess.getOrigins();
        promise.then(onGetOriginsComplete, onErrorFunction);
    });
}
function getDestinations() {
    $.when($('.destinationListItem').remove()).done(function () {
        var promise = Mblx.Destinations.DataAccess.getDestinations();
        promise.then(onGetDestinationsComplete, onErrorFunction);
    });
}
function getCustomerContracts() {
    $.when($('.contractListItem').remove()).done(function () {
        var promise = Mblx.Contracts.DataAccess.getContracts(true);
        promise.then(ongetCustomerContractsComplete, onErrorFunction);
    });
}
function getCarrierContracts() {
    $.when($('.carrierContractListItem').remove()).done(function () {
        var promise = Mblx.Contracts.DataAccess.getContracts(false);
        promise.then(ongetCarrierContractsComplete, onErrorFunction);
    });
}

function getTerminals() {
    $.when($('.terminalListItem').remove()).done(function () {
        var promise = Mblx.Terminals.DataAccess.getTerminals();
        promise.then(onGetTerminalsComplete, onErrorFunction);
    });
}

function getVessels() {
    $.when($('.vesselListItem').remove()).done(function () {
        var promise = Mblx.Vessels.DataAccess.getVessels();
        promise.then(onGetVesselsComplete, onErrorFunction);
    });
}

function getCommodities() {
    $.when($('.commodityListItem').remove()).done(function () {
        var promise = Mblx.Commodities.DataAccess.getCommodities();
        promise.then(onGetCommoditiesComplete, onErrorFunction);
    });
}

function getVesselTrips() {
    $.when($('.vesselTripListItem').remove()).done(function () {
        var promise = Mblx.Vessels.DataAccess.getVesselTrips();
        promise.then(onGetVesselTripsComplete, onErrorFunction);
    });
}

function getContractCommoditiesComplete(dataz) {
    var data = dataz.data;
    $.each(data, function (q, r) {
        contractCommodityDB.insert(r);
        
        //console.log(r);
    });
}
function onAddVesselTripComplete(dataz) {
    
    //console.log(dataz);

    $("#btnSelectNewVesselTrip").removeClass("btn-success");
    $("#btnSelectExistingVesselTrip").addClass("btn-success");
    getVesselTrips();
    disableVesselTripForm();

}

function selectCustomerForContractSearch(customerIdString) {
   
    var customerId = parseInt(customerIdString);
    var customerNames = custDB({ id: customerId }).select("name");
    var customerName = customerNames[0];
    $("#contractSearchModalCustomerInput").val(customerName);
    var contractList = contractDB({ customer_id: customerId, type:"CUST" }).get();
    var listItemString = "";
    $.each(contractList, function (q, r) {
        listItemString += '<li class="menuPill" role="presentation"><a href="#" onClick="populateFromContract(' + r.id + ')">' + r.contract_number + '<p class="pull-right">' + r.start_date + ' to ' + r.end_date + '</p></a></li>';
        console.log("ran this");
    });
    $("#contractModalFoundContracts").empty();
    $("#contractModalFoundContracts").append(listItemString);
}
function populateFromContract(contractId) {
    //console.log(contractId);
    var theseContracts = contractDB({ id: contractId, type: "CUST" }).get();
    var thisContract = theseContracts[0];
    //console.log(thisContract);
    $("#inputCustomer").val(thisContract.customer_name);
    var service = serviceDB({ id: parseInt(thisContract.service_id) }).select("description");
    $("#inputService").val(service[0]);
    $("#inputContract").val(thisContract.contract_number);
    var commoditiesToRemove = contractCommodityDB({ contract_id: contractId }).select("commodity_id");
    //console.log(commoditiesToRemove);
    $.each(commoditiesToRemove, function (a, r) {
        $("a[data-commodity-id='" + r + "']").removeClass('hideMe');
    });
    $("#customerContractFormGroup").addClass("hideMe");
     $("#loadFromContractGroup").addClass("hideMe");
    $("#contractSearchModal").modal('hide');
}
function removeLoadMessage() {
    var recentContracts = $.cookie('mblxrecentlist') || "~";
    

    var recentContractsList = recentContracts.split(/~/m);
    if (recentContractsList.length < 5) {
        recentContractsList = contractDB({ type: "CUST" }).select("id");
    }
        //console.log(recentContractsList);
    //$.removeCookie('mblxrecentlist');
    var recentContractsListString = "";
    $.each(recentContractsList, function (q, r) {
        //console.log(r);
        var contractCompany = contractDB({ id: parseInt(r), type:"CUST" }).select("customer_name");
        var contractNumber = contractDB({ id: parseInt(r), type:"CUST"  }).select("contract_number");
        recentContractsListString += ' <a href="#" class="list-group-item" onClick="populateFromContract(' + r + ')">' + contractCompany[0] + '<p class="pull-right">' + contractNumber[0] + '</p></a>';
    });
    $("#recentContractListGroup").html(recentContractsListString);

    $("#loadJumbo").addClass('hideMe');
    $("#theContainer").removeClass('hideMe');
    //console.log("done loading");
    
     
}

function onAddBookingComplete(dataz) {
    //console.log(dataz);
}

function onGetAgentsComplete(dataz) {
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
    jQuery.each(data, function (q, r) {
        agentDB.insert(r);
        agentList.push(jsSafe(r.name));
        listItemString += '<li class="agentListItem"><a class="agentListItemLink" onClick="populateField(\'inputAgent\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.contact_name + '</span></a></li>';
    });
    $("#agentDropdown").append(listItemString);
    $('#inputAgent').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'agentList',
        displayKey: 'value',
        source: substringMatcher(agentList)
    });
}

function onGetBargesComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        bargeDB.insert(r);
        bargeList.push(r.barge_number + ' - ' + r.barge_line);
        listItemString += '<li class="bargeListItem"><a class="bargeListItemLink" onClick="populateField(\'inputBarge\',\'' + r.barge_number + '\'); populateField(\'inputBargeFileNumber\',\'' + r.barge_file_number + '\');">' + r.barge_number + ' - ' + r.barge_line_name + '</a></li>';
    });
    $("#bargeDropdown").append(listItemString);
    $('#inputBarge').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'bargeList',
        displayKey: 'value',
        source: substringMatcher(bargeList)
    });
    updateLoadingProgress((14 / 15) * 100);
    
}
function ongetCarrierContractsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        contractDB.insert(r);
        contractInfo.push(r.customer_name + ' - ' + r.contract_number);
        listItemString += '<li class="carrierContractListItem"><a class="carrierContractListItemLink" onClick="populateField(\'inputCarrierContract\',\'' + r.contract_number + ' - ' + jsSafe(r.customer_name) + '\')">' + r.contract_number + ' - ' + r.customer_name + '</a></li>';
    });
    $("#carrierContractDropdown").append(listItemString);
    $('#inputCarrierContract').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'carrierContractInfo',
        displayKey: 'value',
        source: substringMatcher(carrierContractInfo)
    });
    updateLoadingProgress((15 / 15) * 100);
    
}
function ongetCustomerContractsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        r.type = "CUST";
        contractDB.insert(r);
        contractInfo.push(r.customer_name + ' - ' + r.contract_number);
        listItemString += '<li class="contractListItem"><a class="contractListItemLink" onClick="populateField(\'inputContract\',\'' + r.contract_number + ' - ' + jsSafe(r.customer_name) + '\')">' + r.contract_number + ' - ' + r.customer_name + '</a></li>';
    });
    $("#contractDropdown").append(listItemString);
    $('#inputContract').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'contractInfo',
        displayKey: 'value',
        source: substringMatcher(contractInfo)
    });
    updateLoadingProgress((13 / 15) * 100);
    removeLoadMessage();
}
function onGetBrokersComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        brokerDB.insert(r);
        brokerList.push(r.name);
        listItemString += '<li class="brokerListItem"><a class="brokerListItemLink" onClick="populateField(\'inputBroker\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#brokerDropdown").append(listItemString);
    $('#inputBroker').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'brokerList',
        displayKey: 'value',
        source: substringMatcher(brokerList)
    });
}
function onGetWharvesComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        wharfDB.insert(r);
        wharfList.push(r.name);
        listItemString += '<li class="wharfListItem"><a class="wharfListItemLink" onClick="populateField(\'inputWharf\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.city + ',' + r.state + '</span></a></li>';
    });
    $("#wharfDropdown").append(listItemString);
    $('#inputWharf').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'wharfList',
        displayKey: 'value',
        source: substringMatcher(wharfList)
    });
}
function onGetStevedoresComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        stevedoreDB.insert(r);
        stevedoreList.push(r.name);
        listItemString += '<li class="stevedoreListItem"><a class="stevedoreListItemLink" onClick="populateField(\'inputStevedore\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#stevedoreDropdown").append(listItemString);
    $('#inputStevedore').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'stevedoreList',
        displayKey: 'value',
        source: substringMatcher(stevedoreList)
    });
}
function onGetCarriersComplete(dataz) {
    ////console.log("GOT carriers");
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        carrierDB.insert(r);
        carrierList.push(jsSafe(r.name));

        listItemString += '<li class="carrierListItem"><a class="carrierListItemLink" onClick="populateField(\'inputCarrier\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#carrierDropdown").append(listItemString);
    $('#inputCarrier').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'carrierList',
        displayKey: 'value',
        source: substringMatcher(carrierList)
    });
}
function onGetServicesComplete(dataz) {

    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        serviceDB.insert(r);
        serviceList.push(jsSafe(r.name));
        listItemString += '<li class="serviceListItem"><a class="serviceListItemLink" onClick="populateField(\'inputService\',\'' + jsSafe(r.description) + '\')">' + r.name + '<span class="pull-right"> ' + r.description + '</span></a></li>';
    });
    $("#serviceDropdown").append(listItemString);
    $('#inputService').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'serviceList',
        displayKey: 'value',
        source: substringMatcher(serviceList)
    });
    $("#inputService").val('Barging only');
}
function onGetDestinationsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        destinationDB.insert(r);
        destinationList.push(r.name);
        listItemString += '<li class="destinationListItem"><a class="destinationListItemLink" onClick="populateField(\'inputDestination\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#destinationDropdown").append(listItemString);
    $('#inputDestination').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'destinationList',
        displayKey: 'value',
        source: substringMatcher(destinationList)
    });
}

function onGetCountriesComplete(dataz) {
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
    jQuery.each(data, function (q, r) {
        countryDB.insert(r);
        countryList.push(jsSafe(r.name));
        listItemString += '<li class="countryListItem"><a class="countryListItemLink" onClick="populateField(\'inputCountryOfOrigin\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#originDropdown").append(listItemString);
    $('#inputOrigin').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'countryList',
        displayKey: 'value',
        source: substringMatcher(countryList)
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
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        originDB.insert(r);
        originList.push(jsSafe(r.name));
        listItemString += '<li class="originListItem"><a class="originListItemLink" onClick="populateField(\'inputOrigin\',\'' + jsSafe(r.name) + '\')">' + r.name + '<span class="pull-right"> ' + r.country + '</span></a></li>';
    });
    $("#originDropdown").append(listItemString);
    $('#inputOrigin').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'originList',
        displayKey: 'value',
        source: substringMatcher(originList)
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
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        terminalDB.insert(r);
        /*if (parseInt(r.active_status) !== 1) {
            return false;
        } else {*/

        terminalNames.push(jsSafe(r.name));
        listItemString += '<li class="terminalListItem"><a class="terminalListItemLink" onClick="populateField(\'inputTerminal\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
        // }
    });
    $("#terminalDropdown").append(listItemString);
    $('#inputTerminal').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'terminalNames',
        displayKey: 'value',
        source: substringMatcher(terminalNames)
    });
    ////console.log(data);
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
    var secondListItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {
        custDB.insert(r);
        custNames.push(r.name);
        if (listItemBuildConter > 2) {
            return false;
        } else {
            listItemBuildConter++;
            listItemString += '<li class="customerListItem"><a class="customerListItemLink" onClick="populateField(\'inputCustomer\',\'' + jsSafe(r.name) + '\')" data-toggle="dropdown" data-target="customerDropdown" data-customerId="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';
            secondListItemString += '<li><a href="#" onClick="selectCustomerForContractSearch(\'' + r.id + '\')">' + r.name + '</a></li>';
        }
    });
    $("#customerDropdown").append(listItemString);
    $("#customerSearchModalList").append(secondListItemString);
    $('.customerTypeahead').typeahead({
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

function onGetVesselTripsComplete(dataz) {
    var data = dataz.data;
    data.sort(function (a, b) {
        if (a.eta_date > b.eta_date) {
            return 1;
        }
        if (a.eta_date < b.eta_date) {
            return -1;
        }
        return 0;
    });
    var listItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {
        vesselTripDB.insert(r);
        vesselTripList.push(jsSafe(r.name));
        var vesselNameForTripSelect = vesselDB({ id: r.vessel_id }).select("name");
        var vesselName = vesselNameForTripSelect[0];
        ////console.log(vesselName);
        listItemBuildConter++;
        listItemString += '<li class="vesselTripListItem"><a class="vesselTripListItemLink" onClick="populateVesselTripFields(' + r.id + ')" ">' + r.name + ' <span class="pull-right"> ' + vesselName + '</span></a></li>';


    });
    $("#vesselTripDropdown").append(listItemString);
    
}

function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    $.each(data, function (q, r) {
        commDB.insert(r);
        listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h4 class="list-group-item-heading">' + r.name + '</h4><p class="list-group-item-text">' + r.desc + '</p></a>';
    });
    $.when($("#commoditiesList").html(listString)).done(function () {
        ////console.log("typeahead time");
    });
}

function onGetVesselsComplete(data) {
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
    var listItemSelectString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {
        vesselDB.insert(r);
        vesselNames.push(jsSafe(r.name));

        listItemBuildConter++;
        listItemString += '<li class="vesselListItem" role="presentation"><a onclick="populateField(\'inputVessel\', \'' + jsSafe(r.name) + '\');" href="#" data-vesselId="' + r.id + '">' + r.name + '</a></li>';
        listItemSelectString += '<option data-vesselId="' + r.id + '">' + r.name + '</option>';

    });
    $("#vesselDropdown").append(listItemString);
    $('#inputVesselModal').html(listItemSelectString);
    $('.vesselTypeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'vesselNames',
        displayKey: 'value',
        source: substringMatcher(vesselNames)
    });
}

function onAddCustomerSuccess(data) {
    $('#customerEditModal').modal('hide');
    showMainAlert("Added New Customer");
}

function onAddVesselTripSuccess(data) {
    ////console.log(data);
    $('#vesselTripEditModal').modal('hide');
    showMainAlert('Added Vessel Trip');
}

function showMainAlert(message) {
    $.when($("div#mainAlert").empty()).done(function () {
        $("div#mainAlert").append("<h3>" + message + "</h3>");
        $("div#mainAlert").removeClass('hideMe');
        setTimeout(function () {
            $("div#mainAlert").addClass('hideMe')
        }, 3000);
    });
}

function onAddVesselSuccess(data) {
    $("div#mainAlert").empty();
    $("div#mainAlert").append("<h3>Added New Vessel</h3>");
    $('#vesselEditModal').modal('hide');
    $("div#mainAlert").removeClass('hideMe');
    setTimeout(function () {
        $("div#mainAlert").addClass('hideMe')
    }, 3000);
    getVessels();
}

function sortByKey(array, key) {
    return array.sort(function (a, b) {
        var x = a[key];
        var y = b[key];
        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    });
}


function getTodayFormattedDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    var today = mm + '/' + dd + '/' + yyyy;
    return today;
}

function onErrorFunction(error) {
    //console.log("error performing operation");
    //console.log(error);
}

function jsSafe(stringToFix) {
    var name_noSingleQuotes = stringToFix.replace(/'/mg, "\\'");
    var name_jsSafe = name_noSingleQuotes.replace(/"/mg, '\\"');
    return name_jsSafe;
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

function populateVesselTripFields(vesselTripId) {

    var vessel_id = vesselTripDB({ id: vesselTripId }).select("vessel_id");
    var vesselNameForTripSelect = vesselDB({ id: vessel_id }).select("name");
    var vesselName = vesselNameForTripSelect[0];
    $("#inputVessel").val(vesselName);


    var countryOfOrigin_id = vesselTripDB({ id: vesselTripId }).select("country_of_origin_id");
    var countryNameForTripSelect = countryDB({ id: countryOfOrigin_id }).select("name");
    var countryName = countryNameForTripSelect[0];
    $("#inputCountryOfOrigin").val(countryName);

    var stevedore_id = vesselTripDB({ id: vesselTripId }).select("stevedore_id");
    var stevedoreNameForTripSelect = stevedoreDB({ id: stevedore_id }).select("name");
    var stevedoreName = stevedoreNameForTripSelect[0];
    $("#inputStevedore").val(stevedoreName);

    var wharf_id = vesselTripDB({ id: vesselTripId }).select("wharf_id");
    var wharfNameForTripSelect = wharfDB({ id: wharf_id }).select("name");
    var wharfName = wharfNameForTripSelect[0];
    $("#inputWharf").val(wharfName);

    var agent_id = vesselTripDB({ id: vesselTripId }).select("agent_id");
    var agentNameForTripSelect = agentDB({ id: agent_id }).select("name");
    var agentName = agentNameForTripSelect[0];
    $("#inputAgent").val(agentName);

    var voyage_number = vesselTripDB({ id: vesselTripId }).select("voyage_number");
    $("#inputVoyage").val(voyage_number);

    var eta_date = vesselTripDB({ id: vesselTripId }).select("eta_date");
    $("#inputEtaDate").val(eta_date);

    var unload_date = vesselTripDB({ id: vesselTripId }).select("unload_date");
    $("#inputUnloadDate").val(unload_date);

    var vesselTripFriendlyNameSelect = vesselTripDB({ id: vesselTripId }).select("name");
    vesselTripFriendlyName = vesselTripFriendlyNameSelect[0];
    $("#vesselTripSelectorButton").text(vesselTripFriendlyName);

    $("#submitBookingButton").text("Submit");
    $("#submitBookingButton").removeClass("fadedButton");

}