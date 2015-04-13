var custNames = [];
var custDB = TAFFY();
var originDB = TAFFY();
var serviceDB = TAFFY();
var destinationDB = TAFFY();
var destinationList = [];
var originList = [];
var terminalList = [];


var commDB = TAFFY();
var terminalDB = TAFFY();



$(document).ready(function () {
    initialLoadTasks();
    $(".datepicker").datepicker({
        format: "mm/dd/yyyy"
    });

    $("#addNewButton").click(function (event) {
        event.preventDefault();
       
    });

});

function initialLoadTasks() {
    console.log('loading');
    getCustomers();
    getOriginsDestinationsAndTerminals();
    getCommodities();

}

function getCustomers() {
    $.when($('.customerListItem').remove()).done(function () {
        var promise = Mblx.Customers.DataAccess.getCustomers();
        promise.then(onGetCustomersComplete, onErrorFunction);
    });
}
function getCommodities() {
    $.when($('.commodityListItem').remove()).done(function () {
        var promise = Mblx.Commodities.DataAccess.getCommodities();
        promise.then(onGetCommoditiesComplete, onErrorFunction);
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
        $("#inputCustomer").autocomplete({
            source: custNames 
        });

        listItemString += '<li class="customerListItem"><a class="customerListItemLink" onClick="populateField(\'inputCustomer\',\'' + jsSafe(r.name) + '\')" data-toggle="dropdown" data-target="customerDropdown" data-customerId="' + r.id + '">' + r.name + ' <span class="pull-right"> ' + r.city + ' ' + r.state + '</span></a></li>';
    });
    $("#customerDropdown").append(listItemString);
    
}



function onGetCommoditiesComplete(dataz) {
    var data = dataz.data;
    var listString = "";
    var listString2 = "";

    $.each(data, function (q, r) {
        commDB.insert(r);
        /*listString += '<a data-commodity-id="' + r.id + '" class="commodityListItem list-group-item hideMe"><span class="badge">' + r.uom + '</span><h4 class="list-group-item-heading">' + r.name + '</h4><p class="list-group-item-text">' + r.desc + '</p></a>';*/
        listString2 += '<div class="list-group-item" data-commodity-id="' + r.id + '"> \
                        <h4 class="list-group-item-heading">' + r.name + '</h4> \
                        <a class="list-group-item-text" onClick="populateButton(\'commodityButton0\',\'' + jsSafe(r.name) + '\')">' + r.desc + '</a> \
                    </div>';
    });
    /*$.when($("#commoditiesList").html(listString)).done(function () {
        //////console.log("typeahead time");
    });*/
    $.when($(".commodityDropdown").html(listString2)).done(function () {
        //////console.log("typeahead time");
    });
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















function jsSafe(stringToFix) {
    var name_noSingleQuotes = stringToFix.replace(/'/mg, "\\'");
    var name_jsSafe = name_noSingleQuotes.replace(/"/mg, '\\"');
    return name_jsSafe;
}

function onErrorFunction(error) {
    console.log("error performing operation");
    console.log(error);
}

function populateField(field, value) {
    event.preventDefault();

    if (field === "inputDestination") {
        limitTerminals(value);
    }

    $("#" + field).val(value);
}

function populateButton(buttonId, value) {
    event.preventDefault();
    if (buttonId.match(/spotDestinationButton/)) {
        console.log('limiting ' + buttonId + ' to ' + value);
        limitTerminals(buttonId, value);
    }
    $("#" + buttonId).text(value);
}