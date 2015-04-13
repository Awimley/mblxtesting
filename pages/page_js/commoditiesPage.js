var commodityDB = TAFFY();

$(document).ready(function () {
    getCommodities();
    $("#btnAddCommodity").click(function (event) {
        event.preventDefault();
        $("#commoditiesModal").attr('data-current-commodityId', 'new');
        clearCommodityModal();
        $('#commoditiesModal').modal('show');
    });
    $('.btn-cancel').on('click', function (e) {
        $('input').val('');
        $('input:checkbox').attr('checked', false);
    });
    $("#btnCommodityModal_save").on('click', function (e) {
        var dataObj = new Object();

        dataObj.type = "COMM";
        dataObj.CommId = $("#commoditiesModal").attr('data-current-commodityid');
        dataObj.name = $("#inputCommodityModal_name").val();
        dataObj.desc = $("#inputCommodityModal_description").val();
        dataObj.uom = $("#inputCommodityModal_uom").val();
        currentId = $("#commoditiesModal").attr('data-current-commodityid');

        if (currentId == 'new') {
            console.log('this is a new barge line');
            var promise = Mblx.Commodities.DataAccess.addCommodity(dataObj);
            promise.then(onAddCommodityComplete, onErrorFunction);
            console.log(dataObj);
        } else {

            //active is always going to be 1, needed for update function
            dataObj.active_status = 1;

            var promise = Mblx.Commodities.DataAccess.updateCommodity(dataObj);
            promise.then(onUpdateCommodityComplete, onErrorFunction);
            console.log('edit commodity: ' + currentId);
            console.log(dataObj);
        }
    });
});

    function getCommodities() {
        $.when($('#commodityTbody').empty()).done(function() {
            var promise = Mblx.Commodities.DataAccess.getCommodities();
            promise.then(onGetCommoditiesComplete, onErrorFunction);
        });
    }

    function clearCommodityModal() {
        $("#selectCommodityModal_name").val('');
        $("#selectCommodityModal_description").val('');
        $("#selectCommodityModal_uom").val('');

        $("#inputCommodityModal_name").val('');
        $("#inputCommodityModal_description").val('');
        $("#inputCommodityModal_uom").val('');
    }

    function onGetCommoditiesComplete(dataz) {
        var data = dataz.data;
        
        var listItemString = "";
        var listItemBuildConter = 0;
        jQuery.each(data, function (q, r) {
            commodityDB.insert(r);
            listItemBuildConter++;
            listItemString += '<tr> \
                        <td><button type="button" onClick="showCommodityModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                        <td>' + r.name + '</td> \
                       <td>' + r.desc + '</td> \
                       <td>' + r.uom + '</td> \
                                    </tr>';

        });

        $.when($("#commodityTbody").append(listItemString)).done(function () {
            
            $('#commodityTable').DataTable({
                "dom": '<"row"<"col-xs-4"l><"col-xs-4"><"col-xs-4 fylter"fr>>t<"row"<"col-xs-4"i><"col-xs-4"><"col-xs-4"p>>'
            });
        });
    }

    function onErrorFunction(error) {
       alert("error performing operation");
    }

    function showCommodityModal(commodityID) {
        clearCommodityModal();
        var selectedCommodityData = commodityDB({
            id: {
                is: parseInt(commodityID)
            }
        }).get();
        console.log(selectedCommodityData);
        var commodityName = stripQuotesAndWhitespace(selectedCommodityData[0].name);

        $('#inputCommodityModal_name').val(commodityName);
        $('#inputCommodityModal_description').val(selectedCommodityData[0].desc);
        $('#inputCommodityModal_uom').val(selectedCommodityData[0].uom);

        $("#commoditiesModal").attr('data-current-commodityid', commodityID);
        //placeholder draft data
        var draftDataSample = [10, 11, 12];
        $('#inputDraftFeet').val(draftDataSample[0]);
        $('#inputDraftInches').val(draftDataSample[1]);
        $('#inputDraftTonnage').val(draftDataSample[2]);

        $('#commoditiesModal').modal('show');
    }
    function onAddCommodityComplete(data) {
        console.log(data);
        alert('you added a commodity!');

        $('#commoditiesModal').modal('hide');
        $('#commodityTable').DataTable().Destroy();
        getCommodities();

    };
    function onUpdateCommodityComplete(data) {
        $('#commoditiesModal').modal('hide');
        alert('you updated commodity');

        console.log(data);
        $('#commodityTable').DataTable().Destroy();
        getCommodities();


    };
