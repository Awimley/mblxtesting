<div class="modal fade" id="destinationModal" data-current-destinationId="" tabindex="-2" role="dialog" data-aria-labelledby="bargeLineModalLabel" data-aria-hidden="true"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h3>Add a Destination</h3>
      </div>
      <div class="modal-body">
        <form id="bargeLineModalForm" class="form-horizontal" role="form">
          <div class="form-group">
          
            <label for="selectDestinationModal_name" class="col-sm-3 control-label">Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control termModal" id="inputDestinationModal_name"  />
            </div>
            <div class="row" style="padding-bottom : 15px;">
            </div>
          
            

            <label for="selectDestinationModal_description" class="col-sm-3 control-label">Active?:</label>
            <div class="col-sm-9" style="margin-top: 8px;">
              <input type="radio" id="radioActive" name="active_status" value="male">Active &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  
              <input type="radio" id="radioInactive" name="active_status" value="female">Inactive
            </div>
            <div class="row" style="padding-bottom : 15px;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="btn-group btn-group-justified" role="group">
              <div class="btn-group" role="group">
                  <button type="button" id="btnDeleteDestination" class="btn btn-danger hideMe">Delete Barge</button>
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
                  <button type="button" id="btnDestinationModal_save" class="btn btn-success">Save changes</button>
              </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>