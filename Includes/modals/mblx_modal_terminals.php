<div class="modal fade" id="terminalModal" data-current-terminalId="" tabindex="-2" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="terminalModalLabel">Add/Edit Terminal</h4>
            </div>
            <div class="modal-body">
                <form id="terminalModalForm" class="form-horizontal" role="form">
             
                    <div class="form-group">
                        <label for="inputTerminalModal_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_contact_name" class="col-sm-2 control-label">Contact Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_contact_name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_mile_point" class="col-sm-2 control-label">Mile Point</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_mile_point" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputTerminalModal_river" class="col-sm-2 control-label">River</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_river" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputTerminalModal_address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_address" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputTerminalModal_city" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_city" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputTerminalModal_state" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_state" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_zip" class="col-sm-2 control-label">Zip Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_zip" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_phone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_phone" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_fax" class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_fax" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputTerminalModal_email" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTerminalModal_notes" class="col-sm-2 control-label">Notes</label>
                        <div class="col-sm-10">
                            <textarea rows="2"  class="form-control termModal" id="inputTerminalModal_notes" ></textarea>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteTerminal" class="btn btn-danger hideMe">Delete Terminal</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-cancel">Cancel</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="btnTerminalModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
