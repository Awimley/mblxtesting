<div class="modal fade" id="originModal" data-current-originid="" tabindex="-2" role="dialog" data-aria-labelledby="originsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="originModalLabel">Add/Edit Origin</h4>
            </div>
            <div class="modal-body">
                <form id="originModalForm" class="form-horizontal" role="form">
             
                    <div class="form-group">
                        <label for="inputOriginModal_city" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputOriginModal_city" placeholder="City" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOriginModal_country" class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputOriginModal_country" placeholder="Country"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteOrigin" class="btn btn-danger hideMe">Delete Origin</button>
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
                        <button type="button" id="btnOriginModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
