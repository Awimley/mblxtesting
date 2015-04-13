$(document).ready(function () {
    getTerminalContacts();
});

function getTerminalContacts() {

  
    $.when($('#terminalContactTbody').empty()).done(function() {
        var promise = Mblx.TerminalContacts.DataAccess.getTerminalContacts();

  
        promise.then(onGetTerminalContactsComplete, onErrorFunction);
    });




}

function onGetTerminalContactsComplete(dataz) {
    var data = dataz.data;
    
    var listItemString = "";
    var listItemBuildConter = 0;
    jQuery.each(data, function (q, r) {

        //custDB.insert(r);

        listItemBuildConter++;
        listItemString += '<tr> \
                    <td><button type="button" onClick="showTerminalContactModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                    <td>' + r.terminal_name + '</td> \
                   <td>' + r.name + '</td> \
                   <td>' + r.phone + '</td> \
                   <td>' + r.email + '</td> \
                                </tr>';
        

    });

    $.when($("#terminalContactTbody").append(listItemString)).done(function () {
        
        $('#terminalContactTable').DataTable({
            "dom": '<"row"<"col-xs-4"l><"col-xs-4"><"col-xs-4 fylter"fr>>t<"row"<"col-xs-4"i><"col-xs-4"><"col-xs-4"p>>'
        });
    });

  
}

function onErrorFunction(error) {
   alert("error performing operation");
    console.log(error);

}