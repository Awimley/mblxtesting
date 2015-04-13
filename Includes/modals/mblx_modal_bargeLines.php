<div class="modal fade" id="bargeLineModal" data-current-bargelineid="" tabindex="-2" role="dialog" data-aria-labelledby="bargeLineModalLabel" data-aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="bargeModalLabel">Add Barge Line</h4>
      </div>
      <div class="modal-body">
        <form id="bargeLineModalForm" class="form-horizontal" role="form">

          <div class="form-group">
              <label for="selectBargeLineModal_name" class="col-sm-2 control-label">Name:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_name" />
              </div>
              <label for="selectBargeLineModal_contact" class="col-sm-2 control-label">Contact:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_contact" />
              </div>
          </div>
          <div class="form-group">
              <label for="selectBargeLineModal_address" class="col-sm-2 control-label">Address:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_address" />
              </div>
              <label for="selectBargeLineModal_city" class="col-sm-2 control-label">City:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_city" />
              </div>
          </div>
          <div class="form-group">
              <label for="selectBargeLineModal_state" class="col-sm-2 control-label">State:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_state" />
              </div>
          
              <label for="selectBargeLineModal_zip" class="col-sm-2 control-label">Zip:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_zip" />
              </div>
          </div>
          <div class="form-group">
              <label for="selectBargeLineModal_phone" class="col-sm-2 control-label">Phone:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_phone" />
              </div>
              <label for="selectBargeLineModal_fax" class="col-sm-2 control-label">Fax:</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control termModal" id="inputBargeLineModal_fax" />
              </div>
          </div>
          <div class="form-group">
              <label for="selectBargeLineModal_notes" class="col-sm-2 control-label">Notes:</label>
              <div class="col-sm-10">
                  <textarea type="text" default="" class="form-control" id="inputBargeLineModal_notes"></textarea>
              </div>
          </div>


        </form>
        
        <table class="table">
          <caption>Drafts</caption>
          <thead>
              <tr>
                  <th>Feet</th>
                  <th>Inches</th>
                  <th>Tonnage</th>
              </tr>
          </thead>
          <tbody >
            <tr>
              <td class = "col-xs-4" id="inputDraftFeet"> 1 </td>
              <td class = "col-xs-4" id="inputDraftInches">2</td>
              <td class = "col-xs-4" id="inputDraftTonnage">3</td>
            </tr>
          </tbody>
      </table>
      <div class="modal-footer">
          <div class="btn-group btn-group-justified" role="group">
              <div class="btn-group" role="group">
                  <button type="button" id="btnDeleteBarge" class="btn btn-danger hideMe">Delete Barge</button>
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
                  <button type="button" id="btnBargeModal_save" class="btn btn-success">Save changes</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>