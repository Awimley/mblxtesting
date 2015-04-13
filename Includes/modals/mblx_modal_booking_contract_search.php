<div id="contractSearchModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h3 class="modal-title" id="myModalLabel">Select Contract</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="contractSearchModalCustomerInput" class="col-sm-4 control-label">Customer Name</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input id="contractSearchModalCustomerInput" type="text" class="form-control customerTypeahead" placeholder="Start Typing Customer Name" />
                                    <div class="input-group-btn">
                                        <button style="margin-bottom: 10px;" id="customerDropdownInModal" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                        <ul id="customerSearchModalList" class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <ul id="contractModalFoundContracts" class=" nav nav-pills nav-stacked"></ul>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Recent Contracts</h3>
                        </div>
                        <div class="panel-body">
                            <div id="recentContractListGroup" class="list-group">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-default" data-dismiss="modal">
                    <h5>Blank Booking</h5>
                </button>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
