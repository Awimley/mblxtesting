<div class="modal fade" id="wharfModal" data-current-wharfId="" tabindex="-2" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="wharfModalLabel">Add/Edit Wharf</h4>
            </div>
            <div class="modal-body">
                <form id="wharfModalForm" class="form-horizontal" role="form">
             
                    <div class="form-group">
                        <label for="inputWharfModal_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control wharfModal" id="inputWharfModal_name" placeholder="Name">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="inputWharfModal_mile_point" class="col-sm-2 control-label">Mile Point</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control wharfModal" id="inputWharfModal_mile_point" >
                        </div>
                    </div>
                     
                     
                     <div class="form-group">
                        <label for="inputWharfModal_city" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control wharfModal" id="inputWharfModal_city" >
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputWharfModal_state" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control wharfModal" id="inputWharfModal_state" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputWharfModal_notes" class="col-sm-2 control-label">Notes</label>
                        <div class="col-sm-10">
                            <textarea rows="2"  class="form-control wharfModal" id="inputWharfModal_notes" ></textarea>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteWharf" class="btn btn-danger hideMe">Delete Wharf</button>
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
                        <button type="button" id="btnWharfModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
