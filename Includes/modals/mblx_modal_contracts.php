<div class="modal fade" id="contractsModal" data-current-contractid="" tabindex="-2" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="contractsModalLabel">Add/Edit Contract</h4>
            </div>
            <div class="modal-body">
                <form id="contactsModalForm" class="form-horizontal" role="form">
                    <div class="form-group">
                                            <div class="btn-group btn-group-justified" style="width : 350px; padding-left : 14px;" data-toggle="buttons">
                      <label class="btn btn-primary active">
                        <input type="radio" name="options" id="option1" autocomplete="off" checked> Spot
                      </label>
                      <label class="btn btn-primary">
                        <input type="radio" name="options" id="option2" autocomplete="off"> Annual
                      </label>
                            </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Customer<span class="caret pull-right"></span>
                            </button>
                            <ul id="customerDropdown" class="dropdown-menu noclose" role="menu">

                                <li>

                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Customer &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_customer" type="text" class="form-control modalInput" />
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputContractModal_contractNumber" class="col-xs-2 control-label">Contract Number</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_contractNumber" type="tel" class="form-control modalInput" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="servicesListLeft" class="col-xs-2 control-label">Services</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_services" type="text" class="form-control modalInput" />
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2">
                        </div>
                        <ul id="servicesListLeft" class="list-group col-xs-5" role="menu">

                        </ul>
                        <ul id="servicesListRight" class="list-group col-xs-5" role="menu">

                        </ul>
                    </div>
                        <!--div class="col-xs-10">

                            <input id="inputContractModal_services" type="text" class="form-control modalInput" />
                        </div-->
                 
                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Equipment
                            </button>
                            <ul id="equipmentDropdown" class="dropdown-menu noclose" role="menu">

                                <li>

                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Equipment &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_equipment" type="text" class="form-control modalInput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_startDate" class="col-xs-2 control-label" style="font-size: medium;">Start Date </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control datepicker" id="inputContractModal_startDate" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_endDate" class="col-xs-2 control-label" style="font-size: medium;">End Date </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control datepicker" id="inputContractModal_endDate" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputContractModal_demurrage" class="col-xs-2 control-label">Demurrage</label>
                        <div class="col-xs-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">$</span>
                                <input id="inputContractModal_demurrage" type="text" class="form-control modalInput" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">

                        <div role="tabpanel">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#rateTableTab" aria-controls="home" role="tab" data-toggle="tab">Rate Table</a>
                                </li>
                                <li role="presentation"><a href="#freeDayTableTab" aria-controls="profile" role="tab" data-toggle="tab">Free Days Table</a>
                                </li>
                                <li role="presentation"><a href="#commoditiesTab" aria-controls="profile" role="tab" data-toggle="tab">Commodities</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="rateTableTab">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead id="rateTableHead">
                                            <tr id="rateTableHeadRow">
                                                <th>Origin</th>
                                                <th>Destination</th>
                                                <th>
                                                    <select class="form-control firstMinimum" data-sequence="0">
                                                        <option value="AQ">AQ</option>
                                                        <option value="300">300</option>
                                                        <option value="500">500</option>
                                                        <option value="800">800</option>
                                                        <option value="1000">1000</option>
                                                        <option value="1200">1200</option>
                                                        <option value="1400">1400</option>
                                                        <option value="1600">1600</option>
                                                        <option value="FLAT">Flat Charge</option>
                                                    </select>
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody id="rateTableTbody">
                                            <tr class="rateTableRow">
                                                <td>
                                                    <div class="btn-group col-xs-12">
                                                        <button id="originButton0" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">New Orleans</button>
                                                        <ul class="originDropdown dropdown-menu" role="menu">

                                                            <li class="divider"></li>

                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group col-xs-12">
                                                        <button type="button" id="destinationButton0" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button>
                                                        <ul class="destinationDropdown dropdown-menu" role="menu">
                                                            <li><a href="pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a> </li>
                                                            <li class="divider"></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" data-sequence="0" placeholder="N/A" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button id="btnAddRateRow" class="btn btn-block btn-inverse">Add New Row</button>
                                        </div>
                                        <div class="col-xs-6">
                                            <button id="btnAddRateCol" class="btn btn-block btn-inverse">Add New Column</button>
                                        </div>
                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="freeDayTableTab">
                                    <table class="table table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Range</th>
                                                <th>Free Days</th>
                                            </tr>
                                        </thead>
                                        <tbody id="freeDayTableTbody">
                                            <tr>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Origin</option>
                                                        <option>Destiation</option>
                                                        <option>All Purpose</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>0 - 400</option>
                                                        <option>401 - 800</option>
                                                        <option>801 - 1200</option>
                                                        <option>1201 - over</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button id="btnAddFreeDayRow" class="btn btn-block btn-inverse">Add New Row</button>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="commoditiesTab">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <input id="commodityFilterInput" type="text" class="form-control" placeholder="Start Typing Commodity" />
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="input-group">
                                                <div class="input-group-addon" style="width: 113px;">Tonnage</div>
                                                <input type="email" class="form-control" id="inputTonnage" />
                                            </div>
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="netTonsRadio" value="net" checked>
                                                Net
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="metricTonsRadio" value="metric">
                                                Metric
                                            </label>
                                            <button id="selectCommodityButton" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button>
                                        </div>

                                        <div class="col-xs-4">
                                            <ul id="pickedCommoditiesList" class="list-group"></ul>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <ul class="list-group" id="commoditiesList" style="max-height: 250px; overflow-y: scroll;">
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="hiddenBarges" class="hideMe form-group">
                        <label for="inputContractModal_number_barges" class="col-xs-2 control-label">Number of Barges</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_number_barges" type="tel" class="form-control modalInput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_notes" class="col-xs-2 control-label">Notes</label>
                        <div class="col-xs-10">
                            <textarea id="inputContractModal_notes" class="form-control modalInput" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteContracts" class="btn btn-danger hideMe">Delete Contract</button>
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
