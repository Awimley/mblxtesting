/// <reference path="../../public/js/jquery-1.11.2.js" />
/// <reference path="../../public/js/taffy.js" />


var custDB = TAFFY();
var originDB = TAFFY();
var serviceDB = TAFFY();
var destinationDB = TAFFY();
var contractDB = TAFFY();
var equipmentDB = TAFFY();
var commDB = TAFFY();
var terminalDB = TAFFY();

$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy'
    });
});

