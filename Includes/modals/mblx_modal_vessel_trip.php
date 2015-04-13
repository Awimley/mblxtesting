<div id="vesselTripModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h3 class="modal-title" id="myModalLabel">Create Vessel Trip</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" role="form">
                        <div class="form-group" id="newVesselTripGroup">
                            <label for="inputVesselTripName" class="col-xs-5 control-label" style="font-size: medium;">Vessel Trip Name </label>
                            <!--button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown" style="white-space: nowrap;"> Voyage Number &nbsp;<span class="caret pull-right" style="white-space: nowrap;"></span> </button> <ul id="voyageDropdown" class="dropdown-menu noclose" role="menu"> <li> <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#voyageEditModal"> <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Voyage &nbsp;<span class="caret pull-right"></span> </button> </li> <li class="divider"></li> <li> <div class="well well-sm">Search: <input id="inputVoyageDropTypeahead" type="text" class="typeahead voyageTypeahead" /> </div> </li> </ul> </div-->
                            <div class="col-xs-7">
                                <input id="inputVesselTripName" type="text" class="form-control newVesselTripInput" placeholder="Name Vessel Trip" />
                            </div>
                        </div>


                        <!-- Shown when Selecting Existing -->

                       

                        <!--div class="form-group">
                        <div class="btn-group col-xs-12">

                            <button id="vesselTripSelectorButton" type="button" class="btn btn-primary dropdown-toggle btn-block hideMe" data-toggle="dropdown">Select Vessel Trip<span class="caret pull-right"></span></button>
                            <ul id="vesselTripDropdown" class="dropdown-menu" role="menu">
                            </ul>
                        </div>
                    </div-->
                        <div class="form-group">
                            <label for="inputVoyage" class="col-xs-5 control-label" style="font-size: medium;">Voyage Number </label>
                            <!--button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown" style="white-space: nowrap;"> Voyage Number &nbsp;<span class="caret pull-right" style="white-space: nowrap;"></span> </button> <ul id="voyageDropdown" class="dropdown-menu noclose" role="menu"> <li> <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#voyageEditModal"> <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Voyage &nbsp;<span class="caret pull-right"></span> </button> </li> <li class="divider"></li> <li> <div class="well well-sm">Search: <input id="inputVoyageDropTypeahead" type="text" class="typeahead voyageTypeahead" /> </div> </li> </ul> </div-->
                            <div class="col-xs-7">
                                <input type="text" class="form-control typeahead voyageTypeahead newVesselTripInput" id="inputVoyage" placeholder="Voyage Number" />
                            </div>
                        </div>




                        <div class="form-group form-group-sm">
                            <label for="inputEtaDate" class="col-xs-5 control-label" style="font-size: medium;">ETA Date </label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control datepicker newVesselTripInput" id="inputEtaDate" placeholder="" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label for="inputUnloadDate" class="col-xs-5 control-label" style="font-size: medium;">Unload Date </label>
                            <div class="col-xs-7">
                                <input type="text" class="form-control datepicker newVesselTripInput" id="inputUnloadDate" placeholder="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputVessel" class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Vessel </label>

                            <div class="col-xs-6 input-group">
                                <input type="text" class="form-control typeahead vesselTypeahead newVesselTripInput" style="width: 100%;" id="inputVessel" placeholder="Start Typing Vessel Name" />

                                <div class="input-group-btn">
                                    <button id="vesselButton" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="margin-left: 0px; height: 34px; margin-top: -4px;"><span class="caret pull-right"></span></button>
                                    <ul id="vesselDropdown" class="dropdown-menu" role="menu">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Here was voyage-->


                        <div class="form-group">
                            <label for="inputCountryOfOrigin" class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Country of Origin </label>

                            <div class="col-xs-6 input-group">
                                <input type="text" class="form-control typeahead originTypeahead newVesselTripInput" style="width: 100%;" id="inputCountryOfOrigin" placeholder="Start Typing Origin Name" />
                                <div class="input-group-btn">
                                    <button id="originButton" style="margin-left: 0px; height: 34px; margin-top: 0px;" type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown"><span class="caret pull-right"></span></button>
                                    <ul id="originDropdown" class="dropdown-menu" role="menu">

                                        <li class="divider"></li>

                                    </ul>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="inputAgent" class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Agent </label>

                            <div class="col-xs-6 input-group">
                                <input type="text" class="form-control typeahead agentTypeahead newVesselTripInput" style="width: 100%;" id="inputAgent" placeholder="Start Typing Agent Name" />
                                <div class="input-group-btn">
                                    <button id="agentButton" type="button" class="btn btn-primary dropdown-toggle" style="margin-left: 0px; height: 34px; margin-top: -4px;" data-toggle="dropdown"><span class="caret pull-right"></span></button>
                                    <ul id="agentDropdown" class="dropdown-menu" role="menu">

                                        <li class="divider"></li>

                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputStevedore" class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Stevedore </label>


                            <div class="col-xs-6 input-group">
                                <input type="text" class="form-control typeahead stevedoreTypeahead newVesselTripInput" style="width: 100%;" id="inputStevedore" placeholder="Start Typing Stevedore Name" />
                                <div class="input-group-btn">
                                    <button id="stevedoreButton" style="margin-left: 0px; height: 34px; margin-top: -4px;" type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown"><span class="caret pull-right"></span></button>

                                    <ul id="stevedoreDropdown" class="dropdown-menu noclose" role="menu">

                                        <li class="divider"></li>

                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputWharf" class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Wharf </label>
                            <div class="col-xs-6 input-group">
                                <input type="text" class="form-control typeahead wharfTypeahead newVesselTripInput" style="width: 100%;" id="inputWharf" placeholder="Start Typing Wharf Name" />
                                <div class="input-group-btn">
                                    <button id="wharfButton" type="button" class="btn btn-primary dropdown-toggle btn-block " style="margin-left: 0px; height: 34px; margin-top: -4px;" data-toggle="dropdown"><span class="caret pull-right"></span></button>
                                    <ul id="wharfDropdown" class="dropdown-menu noclose" role="menu">

                                        <li class="divider"></li>

                                    </ul>
                                </div>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">

                        <button id="btnSaveNewVesselTrip" style="width: 98%;" class="btn btn-success">Save Vessel Trip</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" data-dismiss="modal" class="btn btn-default btn-cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

