/// <reference path="../../public/js/taffy.js" />
/// <reference path="../../public/js/jquery-1.11.2.js" />
var promiseCount = 0;
var custNames = [];
var vesselNames = [];
var vesselDB = TAFFY();
var terminalNames = [];
var contractInfo = [];
var contractNames = [];
var carrierContractNames = [];
var brokerList = [];
var carrierList = [];
var bargeDB = TAFFY();
var bargeList = [];
var bargeLineList = [];
var serviceList = [];
var stevedoreList = [];
var wharfList = [];
var agentList = [];
var originDB = TAFFY();
var originList = [];
var countryList = [];
var agentDB = TAFFY(); 
var vesselTripDB = TAFFY();
var vesselTripList = {};
var vesselTripNames = [];
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
var selectedCommodityDB = TAFFY();
var checkedServices = [];
var badges = {};
var selectedBargeList = new Array();
var NOPE=0;

var rotationCount = 1;
var totalBargeNumber = 0;

var bargeDraftLookup = new Object();

var bargeDraftFinder = new Object();

//custDB({name:"Bob's Shipping Shack"}).select("id");
$(function () {

    $('.maxDraftControl').keyup(function () {
        var riverFeet = parseInt($("#riverFeet").val());
        //ain't no feets?
        if (!riverFeet) {return true};
        var riverInches = parseInt($("#riverInches").val());
        //ain't no inches?
        if (!riverInches) { return true };
        var totalRiverInches = (riverFeet * 12) + riverInches;
        console.log(totalRiverInches);
        /*for (var i = 0; i <= totalBargeNumber; i++) {
            var datMax = getMaxDrafts(i);
            $("#calculatedMaxTonsBarge" + i + "").html(datMax);
        }*/

        //WORKS
        //var bargeIdList = Object.keys(bargeDraftLookup)

        //HOPEFULLY WORKS
        var bargeIdList = bargeDB().select("id");
        $.each(bargeIdList, function (q, r) {
            
            var inchesList = Object.keys(bargeDraftFinder[r]);
            //console.log(inchesList);
            var closestInches = closest_number(inchesList, totalRiverInches, 'floor');
            console.log(r + ' ' + closestInches);

            $("#calculatedMaxTonsBarge" + r + "").html((bargeDraftFinder[r][closestInches]).toFixed(2));
        });
            
    });

    $('#commoditiesFilter').keyup(function () {

        var rex = new RegExp($(this).val(), 'i');
        $('#commodList div').hide();
        $('#commodList div').filter(function () {
            return rex.test($(this).text());
        }).show();

    })

    $("#allocatedCommoditiesTBody").kendoDraggable({
        filter: ".dragMe", //specify which items will be draggable
        hint: function (element) { //create a UI hint, the `element` argument is the dragged item
            return element.clone().css({
                "opacity": 0.1,
                "background-color": "#0cf"
            });
        }
    });
    $.datepicker.setDefaults({
        formatDate : 'mm/dd/yy'
    });

    //service checkbox handler
    $('#serviceDropdown').on('change', 'input', function(e) {
        var check = ($(this).parent().text());
        if ($(this).is(':checked')) {
            checkedServices.push(check);
        } else {
            checkedServices.splice((checkedServices.indexOf(check)), 1);
        }
        $('#inputService').val((checkedServices.join()));
        //if cs is empty, we can't use .each
    });


    $("#commodList").kendoDraggable({
        group: "step1",
        filter: ".list-group-item", //specify which items will be draggable
        dragstart: function() {
            $('#commodSelectedList').addClass('blink-me');
        },
        dragend: function () {
            $('#commodSelectedList').removeClass('blink-me');
        },
        hint: function (element) { //create a UI hint, the `element` argument is the dragged item
            var hintElement = $("<div id='hint' >\
                <span class='badge' style='font-size: x-large;'>" + $(element.find('h4')[0]).text() +"</div>");
            hintElement.css({
            });
            return hintElement;
        },
        cursor: "url('/public/images/grabbing.cur'), default",
        cursorOffset: {
            top: -10,
            left: -50
        }
    });

    $("#commodSelectedList").kendoDropTarget({
        group: "step1",
        drop: function (e) {
            var itemDragged = e.draggable.currentTarget;
            //get the commodity id from the dragged element (stored in attributes)
            //has to be parsefloat to work with taffy
            var commodityId = parseFloat($(itemDragged).attr("data-commodity-id"));
            //get the full story on the commodity from taffy
            var commodityToAdd = commDB({ id: commodityId }).get();
            //use commodityToAdd[0] because returns from taffy are arrays
            var addedCommodityItemString = '<div id="addedCommodityItem' + commodityToAdd[0].id + '" class="list-group-item addedCommodityItem" data-commodity-id="' + commodityToAdd[0].id + '"> \
                                                <h4 class="list-group-item-heading">' + commodityToAdd[0].name + '</h4> \
                                                <form class="form-inline"> \
                                                    <div class="form-group"> \
                                                       <div class="input-group input-group-sm"> \
                                                            <span class="input-group-addon">Pcs</span> \
                                                            <input id= "commodItemInputPcs" type="text" class="commodItemInput form-control input-sm" id="exampleInputAmount" data-current-id="'+commodityToAdd[0].id+'"> \
                                                        </div>\
                                                        <div class="input-group input-group-sm"> \
                                                            <span class="input-group-addon">Tons</span> \
                                                            <input id= "commodItemInputTons" type="text" class="commodItemInput form-control input-sm" id="exampleInputAmount" data-current-id="'+commodityToAdd[0].id+'"> \
                                                        </div>\
                                                       <div class="input-group input-group-sm"> \
                                                            <span class="input-group-addon">BL</span> \
                                                            <input id= "commodItemInputBL" type="text" class="commodItemInput form-control input-sm" id="exampleInputAmount" data-current-id="'+commodityToAdd[0].id+'"> \
                                                        </div>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <button id="lock'+ commodityToAdd[0].id +'" type="button" onclick="saveAddedCommodityItem(' + commodityToAdd[0].id + ')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-ok"></button>\
                                                        <button id="edit'+ commodityToAdd[0].id +'"type="button" onclick="editAddedCommodityItem('+ commodityToAdd[0].id +')" class="btn btn-default btn-xs hideMe"><span class="glyphicon glyphicon-pencil"></button>\
                                                        <button id="delete'+ commodityToAdd[0].id +'"type="button" onclick="deleteAddedCommodityItem('+ commodityToAdd[0].id +')" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></button>\
                                                    </div>\
                                                </form> \
                                            </div>';
            jQuery.each($('#commodSelectedList').children("div"), function (r, t) {
                if ($(t).attr('data-commodity-id') == commodityId) {
                    console.log("NOPE");
                    NOPE = 1;
                    return false;
                }
            });
            
            if (NOPE == 1) {  NOPE = 0; return false;}
            $("#commodSelectedList").append(addedCommodityItemString);

            $($('#addedCommodityItem' + commodityId).find('.input-sm')).keyup(function(e) {
                if (e.keyCode == 13) {
                    console.log('you pressed enter');
                    var commodityId = $(e.target).attr('data-current-id');
                    saveAddedCommodityItem(commodityId);
                    $(e.target).blur();
                }
            });
            //this works well but wasn't awesome enough
            //$("#commodSelectedList").append($(itemDragged)[0].outerHTML);
        }
    });

    $("#bargeListAlloc").kendoDropTarget({
        drop: function (e) {
            
        }
    });
    $('#btnSaveAllocation').on('click', function () {
        var badgesExport;
        jQuery.each(badges, function (s, t) {
            //s is bargeId
            jQuery.each(t, function (q, r) {
                console.log(q);
                console.log($(r).text());
            });
        })
    });
    //setInterval(blink, 700);
    $("#bargeListAlloc").kendoSortable({
        hint: function (element) {
            return element.clone().addClass("hint");
        },
        placeholder: function (element) {
            return element.clone().addClass("placeholder").text("drop here");
        },
        cursor: "url('/public/images/grabbing.cur'), default",
        cursorOffset: {
            top: -10,
            left: -230
        }
    });

    //Making selected barges not show upon reopening the table.
    $("#addBargeButton").click(function (event) {
        event.preventDefault();
        var bargeIdArray = $('#bargeListAlloc').find('li');
        $("#bargeSearchModal").modal('show');
        jQuery.each(bargeIdArray, function (s,t) {
            var bargeId = $(t).attr('data-barge-id');
            $('#bargeSearchRow' + bargeId).addClass('hideMe');
            $('#bargeSearchCheck' + bargeId).prop('checked', false);
        });
    });
    $("#inputParcelRotation").val(rotationCount);
    $("#commoditiesToAllocateList").kendoSortable({
        hint: function (element) {
            return element.clone().addClass("hint");
        },
        placeholder: function (element) {
            return element.clone().addClass("placeholder").text("drop here");
        },
        cursor: "url('/public/images/grabbing.cur'), default",
        cursorOffset: {
            top: -10,
            left: -10
        }
    });

    $(document).on("change", "input[id^='bargeSearchCheck']", function () {
        var thing = $(this);
        var bargeId = thing.attr('data-barge-id');


        if (thing[0].checked == true) {

            $("#bargeSearchRow" + bargeId + "").addClass('success');
            selectedBargeList.push(bargeId);

        } else {

            $("#bargeSearchRow" + bargeId + "").removeClass('success');
            var bargeIndex = selectedBargeList.indexOf(bargeId);
            if (bargeIndex > -1) {
                selectedBargeList.splice(bargeIndex, 1);
            }
        }
    });
    
    $('.btn-vessel-cancel').on('click', function (e) {
        $('#vesselTab input').val('');
        $('#vesselTab input:checkbox').attr('checked', false);
    });

    $("#addSelectedBargesButton").click(function (event) {
        event.preventDefault();
        //console.log(selectedBargeList);
        var bargeListAllocItemString = "";
        var progressBarString = "";
        var count = 0;
        $.each(selectedBargeList, function (q, r) {
            count++;
            var dex = parseInt(r);
            var bargeSelect = bargeDB({
                id: dex
            }).get();

            ////////////////////////FOR TESTING////////////////////////

            var tonnageMax = Math.floor(Math.random() * 2381) + 1168;

            
            
            bargeListAllocItemString += '<li id="bargeListAllocItem' + r + '" data-barge-id="' + r + '" data-current-tons="0" data-maxTons="' + tonnageMax + '" class="sortable bargeListAllocItem">'+
                                            '<div class="row"><div class="col-xs-8"><h4>' + bargeSelect[0].barge_line_name + '</h4></div><div class="col-xs-4">' +
                                                '<span>' + bargeSelect[0].barge_number + '</span></div></div>'+ 
                                                '<div class="row"> <div class="col-xs-4"><h4 data-current-id=' + r + '>0/' + tonnageMax + 
                                            '</h4></div>'+
                                            '<div class="col-xs-8" id="progressbar' + r + '"></div></div>'//closes col-xs-8 and row
                                        '</li>';
        });
        //$("#bargeListProgressBars").prepend(progressBarString);
        $("#bargeListAlloc").prepend(bargeListAllocItemString);

        $.each(selectedBargeList, function (s, t) {
            $("#bargeListAllocItem" + t + "").kendoDropTarget({
                drop: droptargetOnDrop
            });
            $('#bargeSearchCheck' + t).prop('checked', false);
        });
        selectedBargeList = [];
        $("#bargeSearchModal").modal('hide');
        //bargeListAlloc
    });
    $("#navTHings").children().removeClass("active");
    $("#newBookingNavButton").addClass("active");

    $("#inputVesselTripNameExisting").bind('typeahead:selected', function (obj, datum, name) {
        var selectedTripName = datum.value;
        var vesselTripIdSelect = vesselTripDB({ name: selectedTripName }).select("id");
        populateVesselTripFields(vesselTripIdSelect[0]);
    });

    $('#contractSearchModalCustomerInput').bind('typeahead:selected', function (obj, datum, name) {

        var selectedCustomer = datum.value;
        var customerIds = custDB({ name: selectedCustomer }).select("id");
        var customerId = customerIds[0];
        selectCustomerForContractSearch(customerId);
    });



    $("#btnLaunchVesselTripModal").click(function (event) {
        event.preventDefault();
        $('.vesselTripForm').toggleClass('hideMe');
        $('.modal-content').toggleClass('hideMe');
        $('#btnHideVesselTripModal').toggleClass('hideMe');
        $('#btnLaunchVesselTripModal').toggleClass('hideMe');
    });
    $("#btnHideVesselTripModal").click(function (event) {
        event.preventDefault();
        $('.vesselTripForm').toggleClass('hideMe');
        $('.modal-content').toggleClass('hideMe');
        $('#btnHideVesselTripModal').toggleClass('hideMe');
        $('#btnLaunchVesselTripModal').toggleClass('hideMe');
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
        //selections.status = $("#btnType").text();



        //vessel trip number
        var vesselTripNameText = $("#vesselTripSelectorButton").val();
        var vesselTripNameSelect = vesselTripDB({ name: vesselTripNameText }).select("id");
        selections.vesselTripId = vesselTripNameSelect[0];


        ////console.log(selections);
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
            ////console.log("NOT VAL");
        } else {
            ////console.log("Val");

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
            var inputWharfText = $("#inputWharf").val();
            var wharfSelect = wharfDB({ name: inputWharfText }).select("id");
            newVesselTrip.wharfId = wharfSelect[0];

            newVesselTrip.barge_order_notes = "test";
            newVesselTrip.notes = "testNotes";
            ////console.log(newVesselTrip);

            var promise = Mblx.Vessels.DataAccess.addVesselTrip(newVesselTrip);
            promise.then(onAddVesselTripComplete, onErrorFunction);

        }
    });
    $("#btnSelectExistingVesselTrip").click(function () {
        $("#btnSelectNewVesselTrip").removeClass("btn-success");
        $("#btnSelectExistingVesselTrip").addClass("btn-success");
        //disableVesselTripForm();

    });

    $("#btnSelectNewVesselTrip").click(function () {


        $("#btnSelectExistingVesselTrip").removeClass("btn-success");
        $("#btnSelectNewVesselTrip").addClass("btn-success");
        $("#btnLaunchVesselTripModal").removeClass("hideMe");
        // enableVesselTripForm();
    });
    
    $("#btnAllocationsTab").click(function () {
        $("div#vesselTab").addClass('hideMe');
       
        $("#allocationsTab").removeClass('hideMe');
        $("div#inTransitTab").addClass('hideMe');
        $("#btnAllocationsTab").addClass('active active-button');
        $("#btnVesselTab").removeClass('active active-button');
    });

    $("#btnVesselTab").click(function () {
        $("div#vesselTab").removeClass('hideMe');
       
        $("div#allocationsTab").addClass('hideMe');
        $("div#inTransitTab").addClass('hideMe');
        $("#btnAllocationsTab").removeClass('active active-button');
        $("#btnVesselTab").addClass('active active-button');
    });

    $("#btnInTransitTab").click(function () {
        $("div#vesselTab").addClass('hideMe');
       
        $("div#allocationsTab").addClass('hideMe');
        $("div#inTransitTab").removeClass('hideMe');
    });
    $("a.transportListItem").click(function (event) {
        event.preventDefault();
        var selectedText = $(this).text();
        $("#btnTransportation").html(selectedText + '<span class="caret pull-right"></span>');
    });
    $("a.statusListItem").click(function (event) {
        event.preventDefault();
        var selectedText = $(this).text();
        $("#inputStatus").val(selectedText);
    });
    $("#btnDeletePickedCommodity").click(function () {
        var $selectedThing = $(".pickedCommodityItem.active");
        var selCommId = $selectedThing.attr('data-commodity-id');
        $selectedThing.remove();

        $("#pickedCommoditiesList").find("[data-commodity-id=\"" + selCommId + "\"]").remove();

        selectedCommodityDB({ id: selCommId }).remove();
    });
    $("#commoditiesList").on("click", "a", function () {
        var $selectedThing = $(this);


        $.when($(".commodityListItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });

        $("#commoditiesTable").addClass("hideMe");
        $("#commodityToBooking").removeClass("hideMe");
        $("#selectCommodityButton").removeClass("hideMe");
    });
    


    $("#pickedCommoditiesList").on("click", "li", function () {
        var $selectedThing = $(this);
        var pickedCommId = $selectedThing.attr('data-commodity-id');
        $.when($(".pickedCommodityItem").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });


        var pickedCommDesc = commDB({
            id: parseInt(pickedCommId)
        }).select('desc');
        //console.log(pickedCommDesc);
        $("#inputParcelCommodityCell").html(pickedCommDesc[0]);
    });
    /*$("#commoditiesToAllocateList").on("click", "li", function () {
        var $selectedThing = $(this);
        var pickedCommId = $selectedThing.attr('data-commodity-id');
        $.when($(".pickedItemStringForAllocations").removeClass('active')).done(function () {
            $selectedThing.addClass('active');
        });
        var pickedCommDesc = commDB({
            id: parseInt(pickedCommId)
        }).select('desc');
        //console.log(pickedCommDesc);
        $("#inputParcelCommodityCell").html(pickedCommDesc[0]);

    });*/
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

        var commodityObject = new Object();

        commodityObject.id = selCommId;
        commodityObject.piece_count = selPieceCount;
        commodityObject.tonnage = selTonnage;
        commodityObject.bill_laden = selBillLaden;
        commodityObject.name = selCommName[0];

        selectedCommodityDB.insert(commodityObject);

        var pieceSum = 0;
        $.each(selectedCommodityDB().select("piece_count"), function (q, r) {
            //console.log(r);
            var pc = parseFloat(r);
            pieceSum += pc;

        });

        var tonSum = 0;
        $.each(selectedCommodityDB().select("tonnage"), function (qq, rr) {
            //console.log(rr);
            var tc = parseFloat(rr);
            tonSum += tc;

        });
        $("#pieceTotalCountBadge").html(pieceSum + " Pieces Remaining");

        $("#tonnageTotalBadge").html(tonSum + " Tons Remaining");

        var pickedItemString = '<li id="selectedCommodityItem' + selCommId + '" data-commodity-id="' + selCommId + '" class="list-group-item pickedCommodityItem"><span class="badge" id="pieceCountBadge' + selCommId + '">' + selPieceCount + ' Pieces</span><span class="badge" id="tonnageBadge' + selCommId + '">' + selTonnage + ' Tons</span><span class="badge">Bill ' + selBillLaden + '</span>' + selCommName + '</li>';

        //var pickedItemStringForAllocations = '<li id="selectedCommodityItemForAllocations' + selCommId + '" data-commodity-id="' + selCommId + '" class="list-group-item pickedItemStringForAllocations sortable"><span class="badge" id="pieceCountBadge' + selCommId + '">' + selPieceCount + ' Pieces</span><span class="badge" id="tonnageBadge' + selCommId + '">' + selTonnage + ' Tons</span>' + selCommName + '</li>';

        $("#pickedCommoditiesList").append(pickedItemString);
        //$("#commoditiesToAllocateList").prepend(pickedItemStringForAllocations);
        $("#inputPieceCount").val('');
        $("#inputTonnage").val('');
        $("#inputBillLaden").val('');
        $("#commodityFilterInput").val('');
        $(".commodityListItem").addClass('hideMe');

        //////console.log(selCommName);
    });
    $("#addParcelButton").click(function (event) {
        event.preventDefault();
        //var $selectedThing = $(".pickedItemStringForAllocations.active");
        var $selectedThing = $(".pickedCommodityItem.active");
        var selCommId = $selectedThing.attr('data-commodity-id');
        //get qty, tons from selectedCOmm db

        var commoditySelectedInfo = selectedCommodityDB({
            id: selCommId
        }).get();
        var selCommUom = commDB({
            id: parseInt(selCommId)
        }).select('uom');

        //console.log(selCommUom);
        var totalTons = parseFloat(commoditySelectedInfo[0].tonnage);
        var totalQty = parseFloat(commoditySelectedInfo[0].piece_count);
        //console.log(totalTons.toString() + ' ' + totalQty.toString());




        var rotationVal = parseFloat($("#inputParcelRotation").val());
        var quantityVal = parseFloat($("#inputParcelQuantity").val());
        var tonnageVal = parseFloat($("#inputParcelTonnage").val());

        var rowString = '<tr class="dragMe" data-tons="' + tonnageVal + '"><td>' + rotationVal + '</td><td>' + commoditySelectedInfo[0].name + '</td><td>' + quantityVal + '</td><td>' + tonnageVal + '</td></tr>';
        $("#allocatedCommoditiesTBody").append(rowString);


        //clear inputs

        $("#inputParcelQuantity").val('');
        $("#inputParcelTonnage").val('');
        $("#inputParcelCommodityCell").html('');

        //subtract qty and tons from commodities to allocate

        var tonsRemaining = totalTons - tonnageVal;
        var qtyRemaining = totalQty - quantityVal;

        //console.log(tonsRemaining);
        //console.log(qtyRemaining);
        //console.log(totalTons);
        //console.log(totalQty);
        //console.log(tonnageVal);
        //console.log(quantityVal);


        selectedCommodityDB({
            id: selCommId
        }).update({
            piece_count: qtyRemaining.toString()
        });

        selectedCommodityDB({
            id: selCommId
        }).update({
            tonnage: tonsRemaining.toString()
        });

        //console.log("updated selCOmDB for item" + commoditySelectedInfo[0].name);

        $('#pieceCountBadge' + selCommId + "").html(qtyRemaining + ' Piece(s)');
        $('#tonnageBadge' + selCommId + "").html(tonsRemaining + ' Ton(s)');

        rotationCount++;

        $("#inputParcelRotation").val(rotationCount);

        var pieceSum = 0;
        $.each(selectedCommodityDB().select("piece_count"), function (q, r) {
            //console.log(r);
            var pc = parseFloat(r);
            pieceSum += pc;

        });

        var tonSum = 0;
        $.each(selectedCommodityDB().select("tonnage"), function (qq, rr) {
            //console.log(rr);
            var tc = parseFloat(rr);
            tonSum += tc;

        });
        $("#pieceTotalCell").html(pieceSum);

        $("#tonnageTotalCell").html(tonSum);
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

function droptargetOnDrop(e) {
    var commodityButton = $(e.target).children()[0];
    var commodityId = $(commodityButton).attr('data-commodity-id');
    var bargeId = $(e.dropTarget).attr("data-barge-id");
    var tonsAllocated = 0;
    var displayString = '';
    var commodityName = $($('#addedCommodityItem' + commodityId).find('h4')[0]).text();
    var badgesHtml = '';

    //if the object dropped is a barge QUIT EVERYTHING
    if (!commodityId) {console.log('BARGE ON BARGE'); return 1;}

    //if the badges array is empty, initialize as array
    //badges[bargeId][commodityId] -> [number, name]
    if (!badges[bargeId]) {
        badges[bargeId] = new Array();
        $('#bargeListAllocItem' + bargeId).closest('h3').html(bargeId + '<div id="progressbar' + bargeId + '" </div>');
    }
    
    //if the commodity tonnage is zero QUIT EVERYTHING
    if (Number($($('#addedCommodityItem' + commodityId).find('#commodItemInputTons')[0]).val()) == 0) {return 1;}
    //if the barge is full QUIT EVERYTHING
    if (Number($('#bargeListAllocItem' + bargeId).attr('data-current-tons')) == Number($('#bargeListAllocItem' + bargeId).attr('data-maxtons'))) {return 1;}
    
    //If the barge is not going to be full
    if (Number($($('#addedCommodityItem' + commodityId).find('#commodItemInputTons')[0]).val()) <= Number($('#bargeListAllocItem' + bargeId).attr('data-maxtons')) - Number($('#bargeListAllocItem' + bargeId).attr('data-current-tons'))) 
        tonsAllocated = Number($($('#addedCommodityItem' + commodityId).find('#commodItemInputTons')[0]).val());

    // the barge is going to be full
    else tonsAllocated = Number($('#bargeListAllocItem' + bargeId).attr('data-maxtons')) - Number($('#bargeListAllocItem' + bargeId).attr('data-current-tons'));

    //new current tons = old current tons + tons allocated
    $('#bargeListAllocItem' + bargeId).attr('data-current-tons', Number($('#bargeListAllocItem' + bargeId).attr('data-current-tons')) + tonsAllocated);

    //remove that tonnage from the input field
    $($('#addedCommodityItem' + commodityId).find('#commodItemInputTons')[0]).val(Number($($('#addedCommodityItem' + commodityId).find('#commodItemInputTons')[0]).val()) - tonsAllocated);

    //Update the string with tonnages and display it
    displayString = $('#bargeListAllocItem' + bargeId).attr('data-current-tons') + '/' + $('#bargeListAllocItem' + bargeId).attr('data-maxtons') + '&nbsp';
    $('h4[data-current-id="' + bargeId + '"]').html(displayString);

    //Check if the commodity is already on the barge, if it is update entry, and remove the old badge
    if (badges[bargeId][commodityId]) {
        badges[bargeId][commodityId][0] += tonsAllocated;
        $('#progressbar' + bargeId).find('span[data-current-id="'+commodityId+'"]').remove();
        console.log(badges[bargeId][commodityId]);
    } else {//else create a new badge
        badges[bargeId][commodityId] = [tonsAllocated, commodityName];
    }
    $('#progressbar' + bargeId).append('<span class="badge commBadge" style="color:white; z-index: 1000;" onClick="editCommBadge(event)" data-current-id="'+commodityId+'" data-current-bargeId="'+ bargeId + '">' + badges[bargeId][commodityId][0] + '&nbsp' + commodityName + '</span>');
    console.log(badges);
    

    //Update the label with tonnage
    $('#allocationProgress' + bargeId).html($('#progressLabelBarge' + bargeId).html() + '&nbsp' + $('#bargeListAllocItem' + $(e.dropTarget).attr("data-barge-id")).attr('data-current-tons') + '/' + $('#progressLabelBarge' + bargeId).html() + '&nbsp' + $('#bargeListAllocItem' + $(e.dropTarget).attr("data-barge-id")).attr('data-maxtons'));

    //Highlight full barges, check on every drop
    $.each($('#bargeListAlloc').find('li'), function (r, t) {
        if ($(t).attr('data-current-tons') == $(t).attr('data-maxtons')) {
            $(t).css({
                "background-color" : "#bbbbbb"
            });
        }
    });
    $.each($('#commodSelectedList').find('.addedCommodityItem'), function(r, t) {
        if ($(t).find('#commodItemInputTons').val() == 0) {
            $(t).addClass('emptyCommodity');
            $(t).removeAttr('data-role');//Removes the dragability.
        }
    });
}

function editCommBadge(e) {

    //commodInput = $($("#addedCommodityItem" + id + " #commodItemInputTons")[0]);
    var bargeId = $(e.target).attr('data-current-bargeId');

    //reconstruct the badge object for specific barge here. DOESNT HAPPEN HERE, we just add the event handler first.
    $("#btnBadgeModal_save").on('click', function (e) {
        
    });
    var commModalString = '<div data-current-id="' + bargeId + '">';
        commModalString += '<form>';
        commModalString += '<ul id="badgeUl">'
    $('#badgesModal').modal('show');

    jQuery.each(badges[bargeId], function(s, t) {
        console.log(t);
        if(t) {
            console.log(s);
            commAmount = t[0];
            commName = t[1];
            commModalString +='<li class="commSortLi" data-current-id="'+ s +'" data-current-commName="'+commName+'" data-current-tons="'+commAmount+'">';
            commModalString += '<div class="row form-group badgeFormGroup" style="margin: 7px;" data-current-id="'+ s +'">';
            commModalString +=  '<div class="col-xs-4"><label class="form-control commodityLabel" for="' + commName +'">' + commName + ': </label></div>';
            commModalString +=  '<div class="col-xs-8"><input class="form-control" for="' + commName +'" value="'+ commAmount +'" /></div>';
            commModalString += '</div></li>';
        }
    });
    
    commModalString += '</ul></form></div>';
    $(".badges-modal-body").html(commModalString);
    $("#badgeUl").kendoSortable({
        hint: function (element) {
            console.log(element);
            hintElement = $("\
                <div id='hint'>\
                    <button id='commodityButton" + $(element).attr('data-current-id') + "' data-commodity-id='" + $(element).attr('data-current-id') + "' class='btn btn-success'>\
                    <span class='badge'>"+ $(element).attr('data-current-commName') +"</span><br\>\
                    " + $(element).attr('data-current-tons') + " Tons <br\>\
                    </button>\
                </div>"
            );
            return hintElement;
        },
        placeholder: function (element) {
            return element.clone().addClass("placeholder").text("drop here");
        },
        cursor: "url('/public/images/grabbing.cur'), default",
        cursorOffset: {
            top: -10,
            left: -20
        }
    });
};

function saveBadges() {
    console.log('saving badges BRO');
};

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

    

    getVesselTrips();


}

function enableVesselTripForm() {
    //$("#vesselTripSelectorButton").attr("disabled", "disabled");
    //$("#inputVesselTrip").attr("disabled", "disabled");
    $("#existingVesselTripGroup").addClass("hideMe");
    $("#inputVoyage").removeAttr("disabled");
    $("#newVesselTripGroup").removeClass('hideMe');
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

//call disable when selecting existing

function disableVesselTripForm() {
    //$("#vesselTripSelectorButton").removeAttr("disabled");
    $("#existingVesselTripGroup").removeClass("hideMe");
    $("#newVesselTripGroup").addClass("hideMe");
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
            ////console.log(thisId);
            if (!$("#" + thisId).val()) {
                $("#" + thisId).parents(".form-group").addClass("has-error");
                ////console.log("marking " + thisId);
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
function blink() {
    $('.blink-me').fadeOut(350).fadeIn(350);
}


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

function getMaxDrafts(bargeId) {
    var promise = Mblx.BargeDrafts.DataAccess.getMaxDrafts(bargeId);
    promise.then(onGetMaxDraftsComplete, onErrorFunction);
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

function getCountries() {
    $.when($('.countryListItem').remove()).done(function(){
        var promise = Mblx.Countries.DataAccess.getCountries();
        promise.then(onGetCountriesComplete, onErrorFunction);
    });
}

function getVesselTrips() {

    $.when($('.vesselTripListItem').remove()).done(function () {
        var promise = Mblx.Vessels.DataAccess.getVesselTrips();
        promise.then(onGetVesselTripsComplete, onErrorFunction);

    });

    return 'HAPPY';

}

function onGetMaxDraftsComplete(data) {
    console.log(data);
}

function getContractCommoditiesComplete(dataz) {
    var data = dataz.data;
    $.each(data, function (q, r) {
        contractCommodityDB.insert(r);

        ////console.log(r);
    });
}
function onAddVesselTripComplete(dataz) {

    ////console.log(dataz);

    $("#btnSelectNewVesselTrip").removeClass("btn-success");
    $("#btnSelectExistingVesselTrip").addClass("btn-success");
    getVesselTrips();
    disableVesselTripForm();
}

function selectCustomerForContractSearch(customerIdString) {
    var numberOfContracts = 0;
    var customerId = parseInt(customerIdString);
    var customerNames = custDB({ id: customerId }).select("name");
    var customerName = customerNames[0];
    $("#inputCustomer").val(customerName);
    var contractList = contractDB({ customer_id: customerId, type: "CUST" }).get();
    var listItemString = "";
    $.each(contractList, function (q, r) {
        numberOfContracts++;
        listItemString += '<li role="presentation"><a href="#" onClick="populateFromContract(' + r.id + ')">' + r.contract_number + '<p class="pull-right">' + r.start_date + ' to ' + r.end_date + '</p></a></li>';
        //console.log("ran this");
    });
    /*$("#contractModalFoundContracts").empty();
    $("#contractModalFoundContracts").append(listItemString);*/
    $("#customerContractsFound").empty();
    $("#customerContractsFound").html(listItemString);
    $("#customerContractsCount").empty();
    $("#customerContractsCount").html(numberOfContracts + " Contracts Found");
}

function removeLoadMessage() {
    var recentContracts = $.cookie('mblxrecentlist') || "~";


    var recentContractsList = recentContracts.split(/~/m);
    if (recentContractsList.length < 5) {
        recentContractsList = contractDB({ type: "CUST" }).select("id");
    }
    ////console.log(recentContractsList);
    //$.removeCookie('mblxrecentlist');
    var recentContractsListString = "";
    $.each(recentContractsList, function (q, r) {
        ////console.log(r);
        var contractCompany = contractDB({ id: parseInt(r), type: "CUST" }).select("customer_name");
        var contractNumber = contractDB({ id: parseInt(r), type: "CUST" }).select("contract_number");
        recentContractsListString += ' <a href="#" class="list-group-item" onClick="populateFromContract(' + r + ')">' + contractCompany[0] + '<p class="pull-right">' + contractNumber[0] + '</p></a>';
    });
    $("#recentContractListGroup").html(recentContractsListString);

    $("#loadJumbo").addClass('hideMe');
    $("#theContainer").removeClass('hideMe');
    ////console.log("done loading");
}

function onAddBookingComplete(dataz) {
    ////console.log(dataz);
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
    $('#inputAgent').autocomplete({
        source: agentList
    });
}

function onGetBargesComplete(dataz) {
    var data = dataz.data;
    data.sort(function (a, b) {
        if (a.barge_line_name > b.barge_line_name) {
            return 1;
        }
        if (a.barge_line_name < b.barge_line_name) {
            return -1;
        }
        return 0;
    });
    var listItemString = "";
    var bargeAllocationListItemString = "";

    var bargeLineListItemString = "";

    var bargeSearchTableRowString = "";

    var count = 0;

    jQuery.each(data, function (q, r) {
        count++;
        totalBargeNumber++;
        bargeDB.insert(r);
        bargeList.push(r.barge_number + ' - ' + r.barge_line_name);

        var draftz = r.draft_data;

        var draftObject = new Object();

        $.each(draftz, function (aa, bb) {
            if (bb.is_empty == 0 && bb.is_max == 0) {
                var totalInches = ((parseInt(bb.feet) * 12) + parseInt(bb.inches));
                draftObject[totalInches] = bb.value;

                
            }
        })
        console.log(draftObject);
        bargeDraftFinder[r.id] = draftObject;
        if ($.inArray(r.barge_line_name, bargeLineList) < 0) {
            bargeLineList.push(r.barge_line_name);
            bargeLineListItemString += '<li class="bargeLineListItem"><a class="bargeLineListItemLink" onClick="populateField(\'inputBargeSearchModalBargeLine\',\'' + jsSafe(r.barge_line_name) + '\');">' + r.barge_line_name + '</a></li>';
        }

        var emptyString = "";
        var maxString = "";

        $.each(r.draft_data, function (s, t) {
            if (t.is_empty === 1) {
                emptyString += t.feet + '\'' + t.inches + '"';

            }
            if (t.is_max === 1) {
                maxString += t.feet + '\'' + t.inches + '"';

            }
        });

        listItemString += '<li class="bargeListItem"><a class="bargeListItemLink" onClick="populateField(\'inputBarge\',\'' + r.barge_number + '\'); populateField(\'inputBargeFileNumber\',\'' + r.barge_file_number + '\');">' + r.barge_number + ' - ' + r.barge_line_name + '</a></li>';
        // bargeAllocationListItemString += '<li class="sortable"><h3>' + count + '</h3> ' + r.barge_line_name + '<span>' + r.barge_number + '</span></li>';

        //bargeSearchTableRowString += '<tr id="bargeSearchRow' + r.id + '"><td><input type="checkbox" class="bargeSearchCheck" id="bargeSearchCheck' + r.id + '" data-barge-id="' + r.id + '"></td><td>' + r.barge_line_name + '</td><td>' + r.barge_number + '</td><td>' + emptyString + '</td><td>' + maxString + '</td></tr>';//finish
        bargeSearchTableRowString += '<tr id="bargeSearchRow' + r.id + '"><td><input type="checkbox" class="bargeSearchCheck" id="bargeSearchCheck' + r.id + '" data-barge-id="' + r.id + '"></td><td>' + r.barge_line_name + '</td><td>' + r.barge_number + '</td><td id="calculatedMaxTonsBarge' + r.id + '"></td></tr>';//finish
        var randomNumber = Math.floor(Math.random() * 2000) + 1000;

        bargeDraftLookup[r.id] = randomNumber;
    });
    $("#bargeDropdown").append(listItemString);
    //$("#allocationsBargeList").append(bargeAllocationListItemString);

    $("#bargeLineSearchDropdown").append(bargeLineListItemString);
    $("#bargeSearchTableTBody").append(bargeSearchTableRowString);


    $('#inputBarge').autocomplete({
        source: bargeList
    });
    updateLoadingProgress((14 / 15) * 100);

}

function ongetCarrierContractsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        contractDB.insert(r);
        contractInfo.push(r.customer_name + ' - ' + r.contract_number);
        carrierContractNames.push(r.contract_number);
        listItemString += '<li class="carrierContractListItem"><a class="carrierContractListItemLink" onClick="populateField(\'inputCarrierContract\',\'' + r.contract_number + ' - ' + jsSafe(r.customer_name) + '\')">' + r.contract_number + ' - ' + r.customer_name + '</a></li>';
    });
    $("#carrierContractDropdown").append(listItemString);
    $('#inputCarrierContract').autocomplete({
        source: carrierContractInfo
    });
    $('#inputCarrierContract').autocomplete({
        source: carrierContractNames
    })


}

function ongetCustomerContractsComplete(dataz) {
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        r.type = "CUST";
        contractDB.insert(r);
        contractInfo.push(r.customer_name + ' - ' + r.contract_number);
        contractNames.push(r.contract_number);
        listItemString += '<li class="contractListItem"><a class="contractListItemLink" onClick="populateField(\'inputContract\',\'' + r.contract_number + ' - ' + jsSafe(r.customer_name) + '\')">' + r.contract_number + ' - ' + r.customer_name + '</a></li>';
    });
    $("#contractDropdown").append(listItemString);
    $('#inputCustomerContract').autocomplete({
        source: contractNames
    });
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
    $('#inputBroker').autocomplete({
        source: brokerList
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
    $('#inputWharf').autocomplete({
        source: wharfList
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
    $('#inputStevedore').autocomplete({
        source: stevedoreList
    });
}
function onGetCarriersComplete(dataz) {
    //////console.log("GOT carriers");
    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        carrierDB.insert(r);
        carrierList.push(jsSafe(r.name));

        listItemString += '<li class="carrierListItem"><a class="carrierListItemLink" onClick="populateField(\'inputCarrier\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#carrierDropdown").append(listItemString);
    $('#inputCarrier').autocomplete({
        source: carrierList
    });
}

function onGetServicesComplete(dataz) {

    var data = dataz.data;
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        serviceDB.insert(r);
        serviceList.push(jsSafe(r.name));
        listItemString += '<li class="serviceListItem"><a class="serviceListItemLink"><input type="checkbox" value="">&nbsp' + r.name + '</a></li>';
    });
    $("#serviceDropdown").append(listItemString);
}

function onGetDestinationsComplete(dataz) {
    var data = dataz.data;

    data.sort(function (a, b) {
        if (a.name < b.name) return -1;
        if (a.name > b.name) return 1;
        return 0;
    });
    
    var listItemString = "";
    jQuery.each(data, function (q, r) {
        destinationDB.insert(r);
        destinationList.push(r.name);
        listItemString += '<li class="destinationListItem"><a class="destinationListItemLink" onClick="populateField(\'inputDestination\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });
    $("#destinationDropdown").append(listItemString);
    $('#inputDestination').autocomplete({
        source: destinationList
    });
}

function onGetCountriesComplete(dataz) {
    var data = dataz.data;
  /*  var countries = ['Afghanistan', 'Åland Islands', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bangladesh', 'Barbados', 'Bahamas', 'Bahrain', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'British Indian Ocean Territory', 'British Virgin Islands', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burma', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo-Brazzaville', 'Congo-Kinshasa', 'Cook Islands', 'Costa Rica', 'Cote d\'Ivore', 'Croatia', 'Curaçao', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'East Timor', 'Ecuador', 'El Salvador', 'Egypt', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland Islands', 'Faroe Islands', 'Federated States of Micronesia', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern Lands', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Heard and McDonald Islands', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iraq', 'Ireland', 'Isle of Man', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jersey', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macau', 'Macedonia', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco', 'Mozambique', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn Islands', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Réunion', 'Romania', 'Russia', 'Rwanda', 'Saint Barthélemy', 'Saint Helena', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Martin', 'Saint Pierre and Miquelon', 'Saint Vincent', 'Samoa', 'San Marino', 'São Tomé and Príncipe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Sint Maarten', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia', 'South Korea', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen', 'Sweden', 'Swaziland', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Togo', 'Tokelau', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Vietnam', 'Venezuela', 'Wallis and Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe']; */
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
    $('#inputOrigin').autocomplete({
        source: countryList
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
    $('#inputOrigin').autocomplete({
        source: originList
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

        terminalNames.push(jsSafe(r.name));
        listItemString += '<li id="terminalListItem' + r.id + '" class="terminalListItem"><a class="terminalListItemLink" onClick="populateField(\'inputTerminal\',\'' + jsSafe(r.name) + '\')">' + r.name + '</a></li>';
    });

    $("#terminalDropdown").append(listItemString);
    /*$('#inputTerminal').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'terminalNames',
        displayKey: 'value',
        source: substringMatcher(terminalNames)
    });*/
    $('#inputTerminal').autocomplete({
        source: terminalNames
    })
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
            //listItemString += '<li class="customerListItem"><a class="customerListItemLink" onClick="selectCustomerForContractSearch(\'' + r.id + '\');" data-toggle="dropdown" data-target="customerDropdown" data-customerId="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';
            secondListItemString += '<li><a href="#" onClick="selectCustomerForContractSearch(\'' + r.id + '\')">' + r.name + '</a></li>';
        }
    });
    //$("#customerDropdown").append(listItemString);
    $("#customerDropdown").append(secondListItemString);
    $('#inputCustomer').autocomplete({
        source: custNames
    });
}

function populateField(field, value) {
    event.preventDefault();

    if (field === "inputDestination") {
        limitTerminals(value);
    }

    $("#" + field).val(value);
}

function limitTerminals(dest_name) {
    var terminals = terminalDB({ destination_city: dest_name }).select("id");
    

    $("li[id^='terminalListItem']").each(function () {
        $(this).addClass('hideMe')
    });
    $.each(terminals, function (q, r) {
        var terminalListSelector = $("#terminalListItem" + r + "");
        $(terminalListSelector).removeClass('hideMe');
    });
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
        var unloadDate = new Date(r.unload_date);
        var etaDate = new Date(r.eta_date);
        ////console.log(unloadDate);
        vesselTripNames.push(r.name);
        var qs = new Date();
        var m = qs.getMonth();
        var d = qs.getDate();
        var y = qs.getFullYear();

        var date = new Date(y, m, d);

        if (unloadDate > date) {

            // //console.log("date smaller");
            vesselTripDB.insert(r);
            vesselTripList[r.id] = jsSafe(r.name);
            var vesselNameForTripSelect = vesselDB({ id: r.vessel_id }).select("name");
            var vesselName = vesselNameForTripSelect[0];

            //////console.log(vesselName);
            listItemBuildConter++;
            listItemString += '<a class="vesselTripListItemLink list-group-item" onClick="populateVesselTripFields(' + r.id + ')" "> <h3 class="list-group-item-heading">' + r.name + '</h3><h4 class="list-group-item-heading pull-right" style="font-weight:bold;">' + vesselName + '</h4><p class="list-group-item-text">Arriving <span style="padding-left:1.5em;">' + etaDate.toLocaleDateString() + '</span></p><p class="list-group-item-text">Unloading <span style="padding-left:0.5em;">' + unloadDate.toLocaleDateString() + '</span></p></a>';
        }
    });






    $("#vesselTripDropdown").append(listItemString);
    console.log(vesselTripNames);
    $('#inputVesselTripNameExisting').autocomplete({
        source: vesselTripNames
    });

    updateLoadingProgress((15 / 15) * 100);
    removeLoadMessage();



}

function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    var listString2 = "";

    $.each(data, function (q, r) {
        commDB.insert(r);
        listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h4 class="list-group-item-heading">' + r.name + '</h4><p class="list-group-item-text">' + r.desc + '</p></a>';
        listString2 += '<div class="list-group-item" data-commodity-id="' + r.id + '"> \
                        <h4 class="list-group-item-heading">' + r.name + '</h4> \
                        <p class="list-group-item-text">' + r.desc + '</p> \
                    </div>';
    });
    $.when($("#commoditiesList").html(listString)).done(function () {
        //////console.log("typeahead time");
    });
    $.when($("#commodList").html(listString2)).done(function () {
        //////console.log("typeahead time");
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
    $('.vesselTypeahead').autocomplete({
        source: vesselNames
    });
}

function onAddCustomerSuccess(data) {
    $('#customerEditModal').modal('hide');
    showMainAlert("Added New Customer");
}

function onAddVesselTripSuccess(data) {
    //////console.log(data);
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
    ////console.log("error performing operation");
    ////console.log(error);
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
    $("#inputVesselTripNameExisting").val(vesselTripFriendlyName);

    $("#submitBookingButton").text("Submit");
    $("#submitBookingButton").removeClass("fadedButton");
}


function populateFromContract(contractId) {
    ////console.log(contractId);
    var theseContracts = contractDB({ id: contractId, type: "CUST" }).get();
    var thisContract = theseContracts[0];
    ////console.log(thisContract);
    $("#panelTitleAfterLoad").removeClass('hideMe');
    $("#panelTitleAfterLoad").html(thisContract.customer_name + ' ' + thisContract.contract_number + '<a id="expandPanel" class="hideMe pull-right panel-title" data-toggle="collapse" href="#collapsePanel" aria-expanded="true" aria-controls="collapsePanel">Expand&nbsp;<span class="glyphicon glyphicon-circle-arrow-down"></span</a></h4>');
    $("#inputCustomer").val(thisContract.customer_name);
    var service = serviceDB({ id: parseInt(thisContract.service_id) }).select("description");
    $("#inputCustomerContract").val(thisContract.contract_number);
    var commoditiesToRemove = contractCommodityDB({ contract_id: contractId }).select("commodity_id");
    ////console.log(commoditiesToRemove);
    $.each(commoditiesToRemove, function (a, r) {
        $("a[data-commodity-id='" + r + "']").removeClass('hideMe');
    });
    $("#expandPanel").removeClass('hideMe');
    $("#initialPanelTitle").addClass('hideMe');
    $("#collapsePanel").collapse('hide');
    // $("#customerContractFormGroup").addClass("hideMe");
    // $("#loadFromContractGroup").addClass("hideMe");
    // $("#contractSearchModal").modal('hide');
}

function deleteAddedCommodityItem(commodityId) {
    $("#addedCommodityItem" + commodityId + "").remove();
}

function editAddedCommodityItem(commodityId) {
    //show lock button, remove 'success' class, enable inputs
    $('#edit' + commodityId).addClass('hideMe');
    $('#lock' + commodityId).removeClass('hideMe');
    $("#addedCommodityItem" + commodityId + "").removeClass('list-group-item-success');
        $("#addedCommodityItem" + commodityId + "").off();
    $("#addedCommodityItem" + commodityId + ">" + ".form-group>" + "input").removeAttr("disabled");
    $("#addedCommodityItem" + commodityId).removeClass('emptyCommodity');
};

function saveAddedCommodityItem(commodityId) {
    var myDiv = $('#addedCommodityItem' + commodityId);
    var pcs = $($(myDiv).find('#commodItemInputPcs')[0]).val(),
        tons = $($(myDiv).find('#commodItemInputTons')[0]).val(),
        BL = $($(myDiv).find('#commodItemInputBL')[0]).val();

    $('#lock' + commodityId).addClass('hideMe');
    $('#edit' + commodityId).removeClass('hideMe');

    $("#addedCommodityItem" + commodityId + "").addClass('list-group-item-success');
    //and disable the inputs
    $("#addedCommodityItem" + commodityId + ">" + ".form-group>" + "input").prop('disabled', true);

    $("#addedCommodityItem" + commodityId + "").kendoDraggable({
        dragstart: function () {
            $('.barge-panel').addClass('blink-me');
        },
        dragend: function () {
            $('.barge-panel').removeClass('blink-me');
        },
        hint: function (e) {
            hintElement = $("\
                <div id='hint'>\
                    <button id='commodityButton" + commodityId + "' data-commodity-id='" + commodityId + "' class='btn btn-success'>\
                    <span class='badge'>"+ e.find('h4').text() +"</span><br\>\
                    " + pcs + " Pcs <br\>\
                    " + tons + " Initial Tons <br\>\
                    " + BL + " BL <br\>\
                    </button>\
                </div>"
            );
            hintElement.css({
                "border-style" : "ridge",
                "border-width" : "3px",
                "border-color" : "green aqua"
            });
            return hintElement;
        },
        cursor: "url('/public/images/grabbing.cur'), default",
        cursorOffset: {
            top: 0,
            left: -95
        }
    });
}

//courtesy of some badass from Russia on stackoverflow


function closest_number(quantities, number, closest_factor) {
    if (closest_factor == 'ceil') {
        quantities.sort(function (a, b) {
            return a - b
        }
        );

        for (var i = 0; i < quantities.length; i++) {
            if (quantities[i] >= number) {
                return quantities[i];
            }

            last_value = quantities[i];
        }

        return last_value;
    }
    else if (closest_factor == 'floor') {
        quantities.sort(function (a, b) {
            return a - b
        }
        );

        min_value = quantities[0];

        for (var i = 0; i < quantities.length; i++) {
            if (number == quantities[i]) {
                return number;
            }
            else if (quantities[i] < number) {
                min_value = quantities[i];
            }
            else if (quantities[i] > number) {
                return min_value;
            }
        }

        return min_value;
    }
    else {
        return false;
    }
};