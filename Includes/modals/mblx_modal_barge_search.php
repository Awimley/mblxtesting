<div class="modal fade" id="bargeSearchModal" data-current-bargesearchid="" tabindex="-2" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h2 class="modal-title pull-right" id="bargeSearchModalLabel">Add Barges</h2>
                <h4 class="modal-title" id="riverHeightTitle">Max Draft Height:</h4>
                <hr />
                <form class="form-inline">
                    <div class="form-group">
                        <label for="riverFeet">Feet</label>
                        <input type="text" class="form-control maxDraftControl" id="riverFeet" placeholder="" />
                    </div>
                    <div class="form-group">
                        <label for="riverInches">Inches</label>
                        <input type="text" class="form-control maxDraftControl" id="riverInches" placeholder="" />
                    </div>
                </form>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Barge Line</label>
                            <div class="input-group col-xs-6">
                                <input type="text" class="form-control" id="inputBargeSearchModalBargeLine" placeholder="Barge Line" style="width: 100%" />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                    <ul id="bargeLineSearchDropdown" class="dropdown-menu no-close" role="menu">

                                        <li class="divider"></li>
                                        <!--li> <div class="col-xs-12 list-group terminalGroup"> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City One, LA</a> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City Two, LA</a> <a href="#" class="list-group-item disabled"><span class="glyphicon glyphicon-pencil pull-left"></span>Inactive Terminal City, LA</a> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City Three, LA</a> </div> </li-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Barge Line</th>
                                <th>Barge Number</th>
                                <th>Max Tons</th>
                            </tr>
                        </thead>
                        <tbody id="bargeSearchTableTBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">

                    <div class="btn-group" role="group">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-cancel">Cancel</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="addSelectedBargesButton" type="button" class="btn btn-success">Add Selected Barges</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
