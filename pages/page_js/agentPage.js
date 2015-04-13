$(document).ready(function () {
    getAgents();
    $("#addAgentButton").click(function (event) {
        event.preventDefault();
        $("#agentsModalLabel").html('Add New Agent');
        $("#agentsModal").attr('data-current-agentid', 'new');
        $("#agentsModal").modal('show');
    });

    $("#btnAgentModal_save").click(function (event) {
        event.preventDefault();
        var postData = new Object();

        postData.name = $("#inputAgentModal_name").val();
        postData.contact_name = $("#inputAgentModal_contact_name").val();
        postData.address = $("#inputAgentModal_address").val();

        postData.city = $("#inputAgentModal_city").val();
        postData.state = $("#inputAgentModal_state").val();
        postData.zip = $("#inputAgentModal_zip").val();
        postData.phone = $("#inputAgentModal_phone").val();
        postData.fax = $("#inputAgentModal_fax").val();
        postData.email = $("#inputAgentModal_email").val();
        postData.notes = $("#inputAgentModal_notes").val();

        var newOrEditing = $("#agentsModal").attr('data-current-agentid');

        // be new agent
        if (newOrEditing == "new") {
            var promise = Mblx.Agents.DataAccess.addAgent(postData);


            promise.then(onAddAgentsComplete, onErrorFunction);
        }

        //be editin' 

        console.log(newOrEditing);
        console.log(postData);

    });
});

function getAgents() {

  
    $.when($('#agentTbody').empty()).done(function() {
        var promise = Mblx.Agents.DataAccess.getAgents();

  
        promise.then(onGetAgentsComplete, onErrorFunction);
    });




}

function onAddAgentsComplete(dataz) {
    console.log(dataz);
    $("#agentsModal").modal('hide');
    $('#agentTable').DataTable().destroy();
    getAgents();


}

function onGetAgentsComplete(dataz) {
    var data = dataz.data;
    
    var listItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {

        //custDB.insert(r);

        listItemBuildConter++;
        listItemString += '<tr> \
                    <td><button type="button" onClick="showAgentModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                    <td>' + r.name + '</td> \
                    <td>' + r.contact_name + '</td> \
                    <td>' + r.address + '</td> \
                    <td>' + r.city + '</td> \
                    <td>' + r.state + '</td> \
                    <td>' + r.phone + '</td> \
                    <td>' + r.fax + '</td> \
                    <td>' + r.email + '</td> \
                                </tr>';
        

    });

    $.when($("#agentTbody").append(listItemString)).done(function () {
        
        $('#agentTable').DataTable({
            "dom": '<"row"<"col-xs-4"l><"col-xs-4"><"col-xs-4 fylter"fr>>t<"row"<"col-xs-4"i><"col-xs-4"><"col-xs-4"p>>'
        });
    });

  
}

function onErrorFunction(error) {
   alert("error performing operation");
    //console.log(error);

}