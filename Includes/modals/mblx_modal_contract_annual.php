<!-- added _Annual to value of id tags & -Annual to custom attributes (example: attribute data-current-contractId became data-current-contractId-Annual) that were the same as tags on new spot contract modal -->
<!-- Again, that was only for ids and attributes that were the same for both modals, there are still ids which do not have this structure that I left the same, cpcb --> 

<div class="modal fade" id="annualContractModal" data-current-contractId-annual="" tabindex="-2" role="dialog" data-aria-labelledby="contractsModalLabel_Annual" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="contractsModalLabel_Annual">Add/Edit Annual Contract</h4>
            </div>
            <div class="modal-body">
                <form id="contractsModalForm_Annual" class="form-horizontal" role="form">

                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Customer<span class="caret pull-right"></span>
                            </button>
                            <ul id="customerDropdown_Annual" class="dropdown-menu noclose" role="menu">

                                <li>

                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Customer &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_customer_Annual" type="text" class="form-control modalInput" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputContractModal_initials_annual" class="col-xs-2 control-label inputContractModal_initials">User Initials</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_initials_annual" type="tel" class="form-control modalInput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_contractNumber_annual" class="col-xs-2 control-label">Contract Number</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_contractNumber_annual" type="tel" class="form-control modalInput" />
                        </div>
                    </div>
<!-- 
                    <div class="form-group">
                        <label for="servicesListLeft_Annual" class="col-xs-2 control-label">Services</label>
                        <ul id="servicesListLeft_Annual" class="list-group col-xs-5" role="menu">
                        </ul>
                        <ul id="servicesListRight_Annual" class="list-group col-xs-5" role="menu">
                        </ul>
                    </div> -->
                    <!--div class="col-xs-10">

                            <input id="inputContractModal_services" type="text" class="form-control modalInput" />
                        </div-->

                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Equipment
                            </button>
                            <ul id="equipmentDropdown_Annual" class="dropdown-menu" role="menu">
                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_equipment_Annual" type="text" class="form-control modalInput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_startDate_Annual" class="col-xs-2 control-label" style="font-size: medium;">Start Date </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control datepicker" id="inputContractModal_startDate_Annual" />
                        </div>

                        <label for="inputContractModal_endDate_Annual" class="col-xs-2 control-label" style="font-size: medium;">End Date </label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control datepicker" id="inputContractModal_endDate_Annual" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputContractModal_demurrage_Annual" class="col-xs-2 control-label">Demurrage</label>
                        <div class="col-xs-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">$</span>
                                <input id="inputContractModal_demurrage_Annual" type="text" class="form-control modalInput" />
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
                                        <thead id="rateTableHead_Annual">
                                            <tr id="rateTableHeadRow_Annual">
                                                <th>Origin</th>
                                                <th>Destination</th>
                                                <th>1400/1600</th>
                                                <th>1200</th>
                                                <th>1000</th>
                                                <th>800</th>
                                                <th>500</th>
                                                <th>300</th>
                                                <th>AQ</th>
                                                <th>MIN</th>
                                            </tr>
                                        </thead>
                                        <tbody class="rateTableTbody" id="annualRateTableTbody">
                                            <tr class="rateTableRow">
                                                <td>
                                                    <div class="btn-group col-xs-12">
                                                        <button id="annualOriginButton0" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">New Orleans</button>
                                                        <ul class="originDropdown dropdown-menu" role="menu">
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group col-xs-12">
                                                        <button type="button" id="annualDestinationButton0" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button>
                                                        <ul class="destinationDropdown dropdown-menu" role="menu">
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="0" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="1" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="2" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="3" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="4" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="5" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="6" placeholder="N/A" />
                                                </td>
                                                <td class="rateTableEmptyRateCell">
                                                    <input class="rateInput form-control" style="padding:10px 10px;" data-sequence="7" placeholder="N/A" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button id="btnAddAnnualRateRow" class="btn btn-block btn-inverse">Add New Row</button>
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
                                                        <option>All Purpose</option>
                                                        <option>Origin</option>
                                                        <option>Destiation</option>
                                                    </select>
                                                </td>
                                                <td>
                                                        0 - 400
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" aria-describedby="sizing-addon3" value="2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select class="form-control">
                                                        <option>All Purpose</option>
                                                        <option>Origin</option>
                                                        <option>Destiation</option>
                                                    </select>
                                                </td>
                                                <td>
                                                        401 - 800
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" aria-describedby="sizing-addon3" value="3">
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <select class="form-control">
                                                        <option>All Purpose</option>
                                                        <option>Origin</option>
                                                        <option>Destiation</option>
                                                    </select>
                                                </td>
                                                <td>
                                                        801 - 1200
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" aria-describedby="sizing-addon3" value="4">
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <select class="form-control">
                                                        <option>All Purpose</option>
                                                        <option>Origin</option>
                                                        <option>Destiation</option>
                                                    </select>
                                                </td>
                                                <td>
                                                        1201 - over

                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" aria-describedby="sizing-addon3" value="5">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--button id="btnAddFreeDayRow" class="btn btn-block btn-inverse">Add New Row</!--button-->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="commoditiesTab">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <input style="padding:10px 5px;" id="commodityFilterInput_Annual" type="text" class="form-control" placeholder="Search (type 'showall' for full list)" />
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="input-group">
                                                <div class="input-group-addon" style="width: 113px;">Tonnage</div>
                                                <input type="email" class="form-control" id="inputTonnage_Annual" />
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <ul id="pickedCommoditiesList_Annual" class="list-group"></ul>
                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                            <div class="col-xs-4">
                                            <ul class="list-group" id="commoditiesList_Annual" style="max-height: 250px; overflow-y: scroll;"></ul>
                                            </div>
                                            <div class="col-xs-4">
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="netTonsRadio_Annual" value="net" checked>
                                                Net
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="metricTonsRadio_Annual" value="metric">
                                                Metric
                                            </label>
                                            <button id="selectCommodityButton_Annual" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button>
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
                        <label for="inputContractModal_notes_Annual" class="col-xs-2 control-label">Notes</label>
                        <div class="col-xs-10">
                            <textarea id="inputContractModal_notes_Annual" class="form-control modalInput" rows="3"></textarea>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteContract_Annual" class="btn btn-danger hideMe">Delete Contact</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" data-dismiss="modal" id="btnContractModal_cancel_Annual" class="btn btn-default btn-cancel">Cancel</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn hideMe"></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="btnContractModal_save_Annual" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
