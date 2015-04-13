<div class="modal fade" id="commoditiesModal" data-current-commodityId="" tabindex="-2" role="dialog" data-aria-labelledby="CommodityModalLabel" data-aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="bargeModalLabel">Add Commodity</h4>
      </div>
      <div class="modal-body">
        <form id="CommodityModalForm" class="form-horizontal" role="form">
          <div class="form-group">
          
            <label for="selectCommodityModal_name" class="col-sm-3 control-label">Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control termModal" id="inputCommodityModal_name"  />
            </div>
            <div class="row" style="padding-bottom : 15px;">
            </div>
          
            

            <label for="selectCommodityModal_description" class="col-sm-3 control-label">Description:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control termModal" id="inputCommodityModal_description" />
            </div>
            <div class="row" style="padding-bottom : 15px;">
            </div>

            <label for="selectCommodityModal_uom" class="col-sm-3 control-label">Unit of Measure:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control termModal" id="inputCommodityModal_uom" />
            </div>
          </div>
        </div>
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
                  <button type="button" id="btnCommodityModal_save" class="btn btn-success">Save changes</button>
              </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>