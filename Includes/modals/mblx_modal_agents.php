<div class="modal fade" id="agentsModal" data-current-agentid="" tabindex="0" role="dialog" data-aria-labelledby="agentsModalLabel" data-aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="agentsModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="agentsModalForm" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label for="inputAgentModal_name" class="col-xs-3 control-label">Agent Name</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_contact_name" class="col-xs-3 control-label">Contact Name</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_contact_name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_address" class="col-xs-3 control-label">Address</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_address" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_city" class="col-xs-3 control-label">City</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_city" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_state" class="col-xs-3 control-label">State</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_state" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_zip" class="col-xs-3 control-label">Zip</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_zip" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_phone" class="col-xs-3 control-label">Phone</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_phone" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_fax" class="col-xs-3 control-label">Fax</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_fax" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_email" class="col-xs-3 control-label">Email</label>
                        <div class="col-xs-9">
                            <input id="inputAgentModal_email" type="email" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAgentModal_notes" class="col-xs-3 control-label">Notes</label>
                        <div class="col-xs-9">
                            <textarea id="inputAgentModal_notes" class="form-control" placeholder=""></textarea>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    

                    <div class="col-xs-4">
                        <button type="button" data-dismiss="modal" class="btn btn-inverse btn-block">Cancel</button>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btnDeleteAgent" class="btn btn-danger hideMe btn-block">Delete Contract</button>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btnAgentModal_save" class="btn btn-success btn-block">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
