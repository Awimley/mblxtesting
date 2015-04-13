<div class="modal fade" id="contactsModal" data-current-custid="" tabindex="0" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="contactsModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="contactsModalForm" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label for="inputContactModal_name" class="col-xs-3 control-label">Contact Name</label>
                        <div class="col-xs-9">
                            <input id="inputContactModal_name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContactModal_customer" class="col-xs-3 control-label">Company</label>
                        <div class="col-xs-9">
                            <input id="inputContactModal_customer" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContactModal_phone" class="col-xs-3 control-label">Phone</label>
                        <div class="col-xs-9">
                            <input id="inputContactModal_phone" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContactModal_email" class="col-xs-3 control-label">Email</label>
                        <div class="col-xs-9">
                            <input id="inputContactModal_email" type="email" class="form-control" placeholder="" />
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
                        <button type="button" id="btnDeleteContact" class="btn btn-danger hideMe btn-block">Delete Contract</button>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" id="btnContactModal_save" class="btn btn-success btn-block">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
