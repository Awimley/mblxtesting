<div class="modal fade" id="customerModal" data-current-custId="" tabindex="-1" role="dialog" data-aria-labelledby="customerModalLabel" data-aria-hidden="true"  >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="customerModalLabel">Add Customer</h4>
            </div>
            <div class="modal-body" style=" max-height: 600px; overflow-y: scroll;">
                <form id="customerModalForm" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="inputCustomerModal_code" class="col-xs-2 control-label">Customer Code</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_code" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_name" class="col-xs-2 control-label">Customer Name</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_name" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_phone" class="col-xs-2 control-label">Phone</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_phone" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_fax" class="col-xs-2 control-label">Fax</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_fax" type="tel" class="form-control" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputCustomerModal_contacts" class="col-xs-2 control-label">Contacts</label>
                        <div class="col-xs-8">
                            <select id="inputCustomerModal_contacts" multiple class="form-control">

                            </select>
                        </div>
                        <div class="col-xs-2">
                            <div class="row">
                                <a id="addContactLink" href="#"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                            </div>
                            <br />
                            <div class="row">
                                <a id="editContactLink" href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                            </div>
                            <br />
                            <div class="row">
                                <a id="delContactLink" href="#"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
                            </div>
                            </div>

                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_email" class="col-xs-2 control-label">Primary Email</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_email" type="email" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_address" class="col-xs-2 control-label">Address</label>
                        <div class="col-xs-10">
                            <textarea id="inputCustomerModal_address" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_city" class="col-xs-2 control-label">City</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_city" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_state" class="col-xs-2 control-label">State</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_state" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_postCode" class="col-xs-2 control-label">Post Code</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_postCode" type="text" class="form-control" placeholder="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_country" class="col-xs-2 control-label">Country</label>
                        <div class="col-xs-10">
                            <input id="inputCustomerModal_country" type="text" class="form-control" placeholder="United States" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerModal_active_status" class="col-xs-2 control-label">Status</label>
                        <div class="col-xs-10">
                            <select id="inputCustomerModal_active_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteCustomer" onClick="delContact()" class="btn btn-danger hideMe">Delete Customer</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="btnCloseModal" class="btn btn-default btn-cancel">Cancel</button>
                    </div>
                     <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="btnCustomerModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

