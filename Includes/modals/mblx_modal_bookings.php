<div class="modal fade" id="bookingModal" data-current-bookingid="" tabindex="-2" role="dialog" data-aria-labelledby="contactsModalLabel" data-aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="bookingModalLabel">Add/Edit Booking</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">Panel heading without title</div>
                            <div id="modalPanelBody" class="panel-body">
                                <!--div class="btn-group-vertical" role="group" data-toggle="buttons">
                                    <label id="inputStatusNew" class="btn btn-primary btn-block ">
                                        <input type="checkbox" autocomplete="off">
                                        New
                                    </label>
                                    <label id="inputStatusLoading" class="btn btn-primary btn-block ">
                                        <input type="checkbox" autocomplete="off">
                                        Loading
                                    </label>
                                    <label id="inputStatusEn_Route" class="btn btn-primary btn-block ">
                                        <input type="checkbox" autocomplete="off">
                                        En Route
                                    </label>
                                    <label id="inputStatusWaiting_To_Unload" class="btn btn-primary btn-block ">
                                        <input  type="checkbox" autocomplete="off">
                                        Waiting To Unload
                                    </label>
                                    <label id="inputStatusComplete" class="btn btn-primary btn-block ">
                                        <input  type="checkbox" autocomplete="off">
                                        Complete
                                    </label>
                                </div-->
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2"></div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnDeleteBooking" class="btn btn-danger hideMe">Delete Booking</button>
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
                        <button type="button" id="btnBookingModal_save" class="btn btn-success">Save changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

