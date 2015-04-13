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
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Customer
                            </button>
                            <ul id="customerDropdown" class="dropdown-menu noclose" role="menu">

                                <li>
                                    <!--a href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Customer</a-->
                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Customer &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_customer" type="text" class="form-control modalInput"   />
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputContractModal_contractNumber" class="col-xs-2 control-label">Contract Number</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_contractNumber" type="tel" class="form-control modalInput"   />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">Services &nbsp;<span class="caret pull-right"></span> </button>
                            <ul id="servicesDropdown" class="dropdown-menu" role="menu">
                                <li><a href="../../pages/services.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Service</a> </li>
                                <li class="divider"></li>

                            </ul>
                            <!--ul id="servicesDropdown" class="dropdown-menu noclose" role="menu">

                                <li>
                                   
                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Service &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="well well-sm">Search:
                                        <input id="inputCustomerDropTypeahead" type="text" class="typeahead customerTypeahead" />
                                    </div>
                                </li>


                            </ul-->
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_services" type="text" class="form-control modalInput"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Origin <span class="caret pull-right"></span>
                            </button>
                            <ul id="originDropdown" class="dropdown-menu noclose" role="menu">

                                <li><a href="../../pages/origins.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Origin</a> </li>
                                <li class="divider"></li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_origin" type="text" class="form-control modalInput"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Destination
                            </button>
                            <ul id="destinationDropdown" class="dropdown-menu noclose" role="menu">

                                <li>
                                    <!--a href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Customer</a-->
                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Destination &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_destination" type="text" class="form-control modalInput"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="btn-group col-xs-2">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Equipment
                            </button>
                            <ul id="equipmentDropdown" class="dropdown-menu noclose" role="menu">

                                <li>
                                    <!--a href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Customer</a-->
                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Equipment &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>



                            </ul>
                        </div>
                        <div class="col-xs-10">

                            <input id="inputContractModal_equipment" type="text" class="form-control modalInput"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_bargeMinimum" class="col-xs-2 control-label">Barge Minimum</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_bargeMinimum" type="text" class="form-control modalInput" />
                        </div>
                    </div>



                    <div class="form-group">

                        <button class="btn btn-default btn-block dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseCommodities">
                            Pick Commodities <span class="caret"></span>
                        </button>
                        <div class="collapse" id="collapseCommodities" style="min-height: 200px;" >
                            <table>
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>
                                        <div class="input-group">
                                            <input id="commodityFilterInput" type="text" class="form-control" placeholder="Start Typing Commodity" />

                                        </div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="5">
                                        <ul id="pickedCommoditiesList" class="list-group"></ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="4">
                                        <ul class="list-group" id="commoditiesList" style="max-height: 250px; overflow-y: scroll;">
                                        </ul>
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon" style="width: 113px;">Piece Count</div>
                                                <input type="email" class="form-control" id="inputPieceCount" />
                                                <span id="pieceCountUOMLabel" class="input-group-addon"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon" style="width: 113px;">Tonnage</div>
                                                <input type="email" class="form-control" id="inputTonnage" />
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon" style="width: 113px;">Bill Lading</div>
                                                <input type="email" class="form-control" id="inputBillLaden" />
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button id="selectCommodityButton" type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button>

                                    </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputContractModal_rate" class="col-xs-2 control-label">Rate</label>
                        <div class="col-xs-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input id="inputContractModal_rate" type="text" class="form-control modalInput"   />
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputContractModal_demurrage" class="col-xs-2 control-label">Demurrage</label>
                        <div class="col-xs-10">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">$</span>
                                <input id="inputContractModal_demurrage" type="text" class="form-control modalInput"   />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_startDate" class="col-xs-2 control-label" style="font-size: medium;">Start Date </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control datepicker" id="inputContractModal_startDate"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_endDate" class="col-xs-2 control-label" style="font-size: medium;">End Date </label>
                        <div class="col-xs-10">
                            <input type="text" class="form-control datepicker" id="inputContractModal_endDate"   />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputContractModal_free_days" class="col-xs-2 control-label">Free Days</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_free_days" type="tel" class="form-control modalInput"   />
                        </div>
                    </div>
                    <div id="hiddenBarges" class="hideMe form-group">
                        <label for="inputContractModal_number_barges" class="col-xs-2 control-label">Number of Barges</label>
                        <div class="col-xs-10">
                            <input id="inputContractModal_number_barges" type="tel" class="form-control modalInput"   />
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
                        <button type="button" id="btnDeleteContact" class="btn btn-danger hideMe">Delete Contact</button>
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
                        <button type="button" id="btnContractModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
