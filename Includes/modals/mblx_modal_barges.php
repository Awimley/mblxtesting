<div class="modal fade" id="bargesModal" data-current-bargeid="" tabindex="-2" role="dialog" data-aria-labelledby="bargesModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="bargeModalLabel">Add Barge</h4>
            </div>
            <div class="modal-body">
                <form id="bargeModalForm" class="form-horizontal" role="form">

                    <div class="form-group">
                        <label for="selectBargeModal_bargeLine" class="col-sm-2 control-label">Barge Line</label>
                        <div class="col-sm-10">
                            <select id="selectBargeModal_bargeLine" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBargeModal_bargeNumber" class="col-sm-2 control-label">Barge Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control termModal" id="inputBargeModal_bargeNumber" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectBargeModal_bargeType" class="col-sm-2 control-label">Barge Type</label>
                        <div class="col-sm-10">
                            <select id="selectBargeModal_bargeType" class="form-control">
                                <option value="Rake">Rake</option>
                                <option value="Box">Box</option>
                                <option value="Other">Other</option>
                                <option value="FlatDeck">Flat Deck</option>
                                <option value="LASH">LASH</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectBargeModal_bargeCoverType" class="col-sm-2 control-label">Cover Type</label>
                        <div class="col-sm-10">
                            <select id="selectBargeModal_bargeCoverType" class="form-control">
                                <option value="LC">LC: Lift Covered Barge</option>
                                <option value="RC">RC: Roll Covered Barge</option>
                                <option value="C">C: Covered Barge (Lift Or Roll)</option>
                                <option value="O">O: Open Hopper</option>
                                <option value="OTHER">Other</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBargeModal_maxDraftFeet" class="col-sm-2 control-label">Max Draft</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control termModal" id="inputBargeModal_maxDraftFeet" />
                                <span class="input-group-addon" id="basic-addon1">Feet</span>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control termModal" id="inputBargeModal_maxDraftInches" placeholder="inches" />
                                <span class="input-group-addon" id="basic-addon2">Inches</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputBargeModal_emptyDraftFeet" class="col-sm-2 control-label">Empty Draft</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control termModal" id="inputBargeModal_emptyDraftFeet" />
                                <span class="input-group-addon" id="basic-addon3">Feet</span>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control termModal" id="inputBargeModal_emptyDraftInches" />
                                <span class="input-group-addon" id="basic-addon4">Inches</span>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <caption>Drafts</caption>
                        <thead>
                            <tr>
                                <th>Feet</th>
                                <th>Inches</th>
                                <th>Tonnage</th>
                            </tr>
                        </thead>
                        <tbody id="bargeModalDraftTbody">
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <button id="addDraftButton" class="btn-primary btn-block">Add New Draft</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>


                </form>
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
                        <button type="button" id="btnBargeModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
