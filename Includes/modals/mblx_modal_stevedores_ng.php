<div class="modal fade" id="stevedoreModal" data-current-stevedoreid="" tabindex="-2" role="dialog" data-aria-labelledby="stevedoresModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="stevedoreModalLabel">Add/Edit Stevedore</h4>
            </div>
            <div class="modal-body">
                <form id="stevedoreModalForm" class="form-horizontal" role="form">
             
                    <div class="form-group">
                        <label for="inputStevedoreModal_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_name" ng-model="main.selectedStevedore.name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_contact_name" class="col-sm-2 control-label">Contact Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_contact_name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input class="form-control termModal" id="inputStevedoreModal_address" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputStevedoreModal_city" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_city" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_state" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_state" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_zip_code" class="col-sm-2 control-label">Zip Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_zip_code" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_phone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_phone" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_fax" class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control termModal" id="inputStevedoreModal_fax" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStevedoreModal_email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputStevedoreModal_email" />
                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteStevedore" class="btn btn-danger hideMe">Delete Stevedore</button>
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
                        <button type="button" id="btnStevedoreModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>