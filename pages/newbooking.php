<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>MBLX &middot; New Booking</title>

    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.darkly.min.css" rel="stylesheet" />
    <link href="/public/css/bootstrap.cosmo.css" rel="stylesheet" />

    <!-- Custom styles for this template -->

        
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href='//fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/public/css/pageCustomerStyle.css" />
    <link rel="stylesheet" href="/public/css/dropdowns-enhancement.min.css" type="text/css" />
    <link rel="stylesheet" href="/public/css/buttons.css" type="text/css" />
    <style type="text/css">
        body {
            /*min-height: 2000px;*/
            background-image: url(/Images/smbg.png);
            padding-top: 70px;
        }

        .container {
            min-width: 80%;
        }

        .datepicker {
            z-index: 1151 !important;
        }

        #commoditiesList {
            max-height: 300px;
            overflow-y: scroll;
        }

        #serviceDropdown {
            max-height: 300px;
            overflow-y: scroll;
        }

        #customerDropdown {
            min-width: 300px;
            max-height: 300px;
            overflow-y: scroll;
        }

        ul.dropdown-menu {
            min-width: 300px;
            max-height: 300px;
            max-width: 500px;
            overflow-y: scroll;
        }

        input.form-control {
            height: 34px;
        }

        .twitter-typeahead {
            width: 100% !important;
        }

        .control-label {
            white-space: nowrap;
        }
        /*.triForm {
                    padding-left: 5px;
                    padding-right: 5px;
                }*/

        .progress {
            height: 21px;
        }

        #loadingProgressBar {
            font-family: "Courier New", "Courier", monospace !important;
            font-size: 18px !important;
            padding-top: 10px;
        }

        .fadedButton {
            opacity: 0.25;
        }

        .menuPill {
            background-color: #5C95C5;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            box-sizing: border-box;
            cursor: auto;
            display: block;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin-bottom: 10px;
            position: relative;
            text-align: left;
            text-decoration: none;
        }

        .nav > li.menuPill > a:hover,
        .nav > li.menuPill > a:focus {
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 4px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            background-color: #BED5E8;
            color: black;
        }

        .menuPill > a {
            color: white;
        }

        li.sortable {
            list-style-type: none;
            padding: 6px 8px;
            margin: 0;
            color: #666;
            font-size: 1.2em;
            cursor: url('/public/images/grab.cur'), default;
        }

            li.sortable:last-child {
                border-bottom: 0;
                border-radius: 0 0 4px 4px;
            }

            li.sortable span {
                display: block;
                float: right;
                color: #666;
            }

            li.sortable:hover {
                background-color: #dceffd;
            }

        li.hint {
            display: block;
            width: 200px;
            background-color: #52aef7;
            color: #fff;
        }

            li.hint:after {
                content: "";
                display: block;
                width: 0;
                height: 0;
                border-top: 6px solid transparent;
                border-bottom: 6px solid transparent;
                border-left: 6px solid #52aef7;
                position: absolute;
                left: 216px;
                top: 8px;
            }

            li.hint:last-child {
                border-radius: 4px;
            }

            li.hint span {
                color: #fff;
            }

        li.placeholder {
            background-color: #dceffd;
            color: #52aef7;
            text-align: right;
        }

        .form-group > .control-label {
            text-align: right;
        }

        #example {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        #playlist {
            margin: 30px auto;
            width: 300px;
            background-color: #f3f5f7;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, .1);
        }

        #playlist-title {
            height: 80px;
            border-radius: 4px 4px 0 0;
            border-bottom: 1px solid rgba(0, 0, 0, .1);
        }

        #allocationsBargeList {
            padding: 0;
            margin: 0;
        }

            #allocationsBargeList > li.sortable {
                list-style-type: none;
                padding: 6px 8px;
                margin: 0;
                color: #666;
                font-size: 1.2em;
                cursor: url('/public/images/grab.cur'), default;
            }

                #allocationsBargeList > li.sortable:last-child {
                    border-bottom: 0;
                    border-radius: 0 0 4px 4px;
                }

                #allocationsBargeList > li.sortable span {
                    display: block;
                    float: right;
                    color: #666;
                }

                #allocationsBargeList > li.sortable:hover {
                    background-color: #dceffd;
                }

            #allocationsBargeList > li.hint {
                display: block;
                width: 200px;
                background-color: #52aef7;
                color: #fff;
            }

                #allocationsBargeList > li.hint:after {
                    content: "";
                    display: block;
                    width: 0;
                    height: 0;
                    border-top: 6px solid transparent;
                    border-bottom: 6px solid transparent;
                    border-left: 6px solid #52aef7;
                    position: absolute;
                    left: 216px;
                    top: 8px;
                }

                #allocationsBargeList > li.hint:last-child {
                    border-radius: 4px;
                }

                #allocationsBargeList > li.hint span {
                    color: #fff;
                }

            #allocationsBargeList > li.placeholder {
                background-color: #dceffd;
                color: #52aef7;
                text-align: right;
            }

        #theContainer {
            width: 95%;
            margin: 0 auto;
        }

        #commodList {
            max-height: 300px;
            overflow-y: scroll;
        }

        .commodItemInput {
            max-width: 100px;
        }
        tbody {
            z-index: 10;
        }
    </style>
    <link rel="stylesheet" href="/public/css/kendo.common.min.css" />
    <link rel="stylesheet" href="/public/css/kendo.metro.min.css" />
    <link rel="stylesheet" href="/public/css/kendo.dataviz.min.css" />
    <link rel="stylesheet" href="/public/css/kendo.dataviz.metro.min.css" />


    <script src="/public/js/jquery-1.11.2.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/es6-shim/0.27.1/es6-sham.min.js"></script>
    <script src="/public/js/kendo/kendo.all.min.js"></script>


    <script src="/public/js/taffy.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap.js" type="text/javascript"></script>
    <script src="/public/js/buttons.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>
    <script src="/public/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Customers.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Vessels.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Commodities.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Terminals.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Brokers.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Services.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.OriginsDestinations.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Contracts.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Carriers.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Stevedores.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Wharves.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Agents.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Bookings.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Barges.DataAccess.js" type="text/javascript"></script>
     <script src="/public/js/mblx.Countries.DataAccess.js" type="text/javascript"></script>

    <!-- jquery autocomplete stuff -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="/public/css/jquery-ui.css" rel="stylesheet" />

    <script src="/pages/page_js/newBooking.js" type="text/javascript"></script>
    <!--script type="text/javascript">
        $( '#topLeft' ).garlic();
        $( '#topRight' ).garlic();
        $( '#bottomLeft' ).garlic();
        $( '#addCustomerForm' ).garlic();

    </script-->

</head>

<body>

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>
    <div id="loadJumbo" class="jumbotron container">
        <h2>Loading...</h2>
        <div class="row">
            <div class="progress col-xs-6">
                <div id="loadingProgressBar" class="progress-bar " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">60% Complete</span>
                </div>
            </div>
            <div class="col-xs-6">
                <img id="bookingLoadingGif" src="/Images/719.gif" style="width: 100px;" alt="Loading..." />
            </div>
        </div>



    </div>

    <div id="theContainer" class="container-lg hideMe">
        <div class="row">
            <div class="col-xs-12 text-center">                
                <h1 style="margin-top: 0.5em; margin-bottom: 0.5em;">New Booking</h1>
            </div>
        </div>
        

        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>

            <div class="col-lg-1"></div>
            <div class="col-lg-5 triForm">
                <!--form id="topLeft" class="form-horizontal" data-persist="garlic" role="form"-->
                <form id="topLeft" class="form-horizontal" role="form">
                    <div class="form-group">
                        <!--label  type="button" class="btn btn-primary btn-lg col-xs-3 control-label"> Customer </label-->
                        <!-- Single button -->
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Customer </label>

                        <div class="col-xs-6 input-group">
                            <input type="text" class="form-control typeahead customerTypeahead" style="width: 100%" id="inputCustomer" placeholder="Start Typing Customer Name" />
                            <div class="input-group-btn">

                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="customerDropdown" class="dropdown-menu" role="menu">

                                    <li class="divider"></li>

                                    <!--li> <div class="well well-sm">City: <input id="inputCustomerDropTypeahead" type="text" class="typeahead customerTypeahead" /> </div> </li> <li> <div class="well well-sm">State: <input id="inputCustomerDropTypeahead" type="text" class="typeahead customerTypeahead" /> </div> </li-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                                  <div id="customerContractFormGroup" class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Customer Contract </label>

                        <div class="col-xs-6 input-group">
                            <input type="text" class="form-control typeahead customerTypeahead" style="width: 100%" id="inputCustomerContract" placeholder="Customer Contract No." />
                            <div class="input-group-btn">

                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="customerContractsFound" class="dropdown-menu dropdown-right" role="menu">

                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                     
                    <!-- Booking Date Group -->
                    <div class="form-group form-group-sm">
                        <label class="col-xs-5 control-label" style="font-size: medium;">Booking Date </label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" id="inputBookingDate" placeholder="" />
                        </div>
                    </div>
                    <!--div class="form-group form-group-sm">
                        <label  class="col-xs-5 control-label" style="font-size: medium;">Final Date </label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" id="inputFinalDate" placeholder="" />
                        </div>
                    </div-->
                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium;">Booking Number</label>
                        <div class="col-xs-7">
                            <input type="tel" class="form-control" id="inputBookingNumber" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-5" style="font-size: medium;">Customer Reference</label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control" id="inputCustomerReference" placeholder="Customer Reference" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Services </label>
                        <div class="col-xs-6 input-group">
                            <input type="text" class="form-control" id="inputService" placeholder="Service" style="width: 100%; z-index: 0;" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="serviceDropdown" class="dropdown-menu noclose" role="menu">

                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                   
                </form>
            </div>

            <div class="col-lg-5 triForm">
                <!--form id="topRight" data-persist="garlic" class="form-horizontal" role="form"-->
                <form id="topRight" class="form-horizontal" role="form">
                     <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Broker </label>

                        <div class="input-group col-xs-6">
                            <input type="text" class="form-control" id="inputBroker" placeholder="Broker Name" style="width: 100%; z-index: 0;" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="brokerDropdown" class="dropdown-menu dropdown-left" role="menu">

                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
       

                  
                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Carrier Contract</label>
                        <div class="input-group col-xs-6">
                            <input type="text" class="form-control" id="inputCarrierContract" placeholder="Carrier Contract No." style="width: 100%" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="carrierContractDropdown" class="dropdown-menu dropdown-left" role="menu">

                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Destination</label>
                        <div class="input-group col-xs-6">
                            <input type="text" class="form-control" id="inputDestination" placeholder="Destination" style="width: 100%" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="destinationDropdown" class="dropdown-menu dropdown-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Terminal</label>
                        <div class="input-group col-xs-6">
                            <input type="text" class="form-control" id="inputTerminal" placeholder="Terminal" style="width: 100%" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="terminalDropdown" class="dropdown-menu no-close dropdown-left" role="menu">

                                    <li class="divider"></li>
                                    <!--li> <div class="col-xs-12 list-group terminalGroup"> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City One, LA</a> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City Two, LA</a> <a href="#" class="list-group-item disabled"><span class="glyphicon glyphicon-pencil pull-left"></span>Inactive Terminal City, LA</a> <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil pull-left"></span>Terminal City Three, LA</a> </div> </li-->
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--TODO-->
                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Booking Company</label>
                        <div class="input-group col-xs-6">
                            <input type="text" class="form-control" id="inputCarrier" value="MBLX" style="width: 100%" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="carrierDropdown" class="dropdown-menu dropdown-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Status </label>
                        <div class="col-xs-6 input-group">
                            <input type="text" class="form-control" id="inputStatus" placeholder="Status" style="width: 100%" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary dropdown-toggle caret-toggle" type="button" id="btnType" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-left" role="menu" data-aria-labelledby="inputStatus">
                                    <li role="presentation"><a class="statusListItem" role="menuitem" tabindex="0" href="#">New</a> </li>
                                    <li role="presentation"><a class="statusListItem" role="menuitem" tabindex="-1" href="#">Loading</a> </li>
                                    <li role="presentation"><a class="statusListItem" role="menuitem" tabindex="-1" href="#">En Route</a> </li>
                                    <li role="presentation"><a class="statusListItem" role="menuitem" tabindex="-1" href="#">Waiting to Unload</a> </li>
                                    <li role="presentation"><a class="statusListItem" role="menuitem" tabindex="-1" href="#">Complete</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-1"></div>
        </div>

        <div class="row">
            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button id="btnVesselTab" type="button" class="btn btn-green">Vessel Trip</button>
                </div>
                <div class="btn-group">
                    <button id="btnAllocationsTab" type="button" class="btn btn-turq">Commodities / Allocations</button>
                </div>

            </div>
        </div>
        <br />
    <div id="vesselTab">
        <div class="modal-content" style="z-index:2;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-xs-4">
                        <h3 class="modal-title" id="myModalLabel" style="margin-top: 15px;">Vessel Trip</h3>
                    </div>
                    <div class="col-xs-8" style="margin-top: 20px;">
                        <form>
                            <div class="form-group" id="existingVesselTripGroup">
                                <label class="col-xs-5 control-label" style="font-size: medium; margin-right: 15px;">Select Existing Vessel Trip</label>
                                <div class="col-xs-6 input-group">
                                    <input type="text" class="form-control typeahead" style="width: 100%;" id="inputVesselTripNameExisting" placeholder="Search Vessel Trips " />
                                    <div class="input-group-btn">
                                        <button id="vesselTripSelectorButton" type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul id="vesselTripDropdown" class="dropdown-menu list-group dropdown-left" role="menu">
                                            <li class="divider"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>              
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form class="form-horizontal vesselTripForm" role="form">
                    <!--div class="form-group">
                    <div class="btn-group col-xs-12">

                        <button id="vesselTripSelectorButton" type="button" class="btn btn-primary dropdown-toggle btn-block hideMe" data-toggle="dropdown">Select Vessel Trip<span class="caret pull-right"></span></button>
                        <ul id="vesselTripDropdown" class="dropdown-menu" role="menu">
                        </ul>
                    </div>
                </div-->
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="inputVoyage" class="col-xs-3 control-label" style="font-size: medium;">Voyage Number </label>
                        <!--button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown" style="white-space: nowrap;"> Voyage Number &nbsp;<span class="caret pull-right" style="white-space: nowrap;"></span> </button> <ul id="voyageDropdown" class="dropdown-menu noclose" role="menu"> <li> <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#voyageEditModal"> <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Voyage &nbsp;<span class="caret pull-right"></span> </button> </li> <li class="divider"></li> <li> <div class="well well-sm">Search: <input id="inputVoyageDropTypeahead" type="text" class="typeahead voyageTypeahead" /> </div> </li> </ul> </div-->
                        <div class="col-xs-8 no-caret">
                            <input type="text" class="form-control typeahead voyageTypeahead newVesselTripInput" id="inputVoyage" style="width: 109%;" placeholder="Voyage Number" />
                        </div>
                    </div>

                    <div class="form-group col-xs-6" style=" margin-bottom : 15px;">
                        <label for="inputEtaDate" class="col-xs-3 control-label" style="font-size: medium;">ETA Date </label>
                        <div class="col-xs-8 no-caret">
                            <input type="text" class="form-control datepicker newVesselTripInput" id="inputEtaDate" style="width: 109%;" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="inputUnloadDate" class="col-xs-3 control-label" style="font-size: medium;">Unload Date </label>
                        <div class="col-xs-8 no-caret">
                            <input type="text" class="form-control datepicker newVesselTripInput" id="inputUnloadDate" style="width: 109%;" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="inputVessel" class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Vessel </label>
                        <div class="col-xs-8 input-group">
                            <input type="text" class="form-control typeahead vesselTypeahead newVesselTripInput" id="inputVessel" placeholder="Start Typing Vessel Name" />
                            <div class="input-group-btn">
                                <button id="vesselButton" type="button" class="btn btn-primary dropdown-toggle caret-toggle " data-toggle="dropdown" style="margin-left: 0px; height: 34px; margin-top: -4px;"><span class="caret"></span></button>
                                <ul id="vesselDropdown" class="dropdown-menu drop-left" role="menu">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="inputCountryOfOrigin" class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Country of Origin </label>
                        <div class="col-xs-8 input-group">
                            <input type="text" class="form-control typeahead originTypeahead newVesselTripInput" style="width: 100%;" id="inputCountryOfOrigin" placeholder="Start Typing Origin Name" />
                            <div class="input-group-btn">
                                <button id="originButton" style="margin-left: 0px; height: 34px; margin-top: 0px;" type="button" class="btn btn-primary dropdown-toggle btn-block caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="originDropdown" class="dropdown-menu drop-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="inputAgent" class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Agent </label>
                        <div class="col-xs-8 input-group">
                            <input type="text" class="form-control typeahead agentTypeahead newVesselTripInput" style="width: 100%;" id="inputAgent" placeholder="Start Typing Agent Name" />
                            <div class="input-group-btn">
                                <button id="agentButton" type="button" class="btn btn-primary dropdown-toggle caret-toggle" data-toggle="dropdown" ><span class="caret"></span></button>
                                <ul id="agentDropdown" class="dropdown-menu drop-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="inputStevedore" class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Stevedore </label>
                        <div class="col-xs-8 input-group">
                            <input type="text" class="form-control typeahead stevedoreTypeahead newVesselTripInput" style="width: 100%;" id="inputStevedore" placeholder="Start Typing Stevedore Name" />
                            <div class="input-group-btn">
                                <button id="stevedoreButton" style="margin-left: 0px; height: 34px; margin-top: -4px;" type="button" class="btn btn-primary dropdown-toggle btn-block caret-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="stevedoreDropdown" class="dropdown-menu noclose drop-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="inputWharf" class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Wharf </label>
                        <div class="col-xs-8 input-group">
                            <input type="text" class="form-control typeahead wharfTypeahead newVesselTripInput" style="width: 100%;" id="inputWharf" placeholder="Start Typing Wharf Name" />
                            <div class="input-group-btn">
                                <button id="wharfButton" type="button" class="btn btn-primary dropdown-toggle btn-block caret-toggle" style="margin-left: 0px; height: 34px; margin-top: -4px;" data-toggle="dropdown"><span class="caret"></span></button>
                                <ul id="wharfDropdown" class="dropdown-menu noclose drop-left" role="menu">
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group">
                <div class="btn-group" role="group">
                    <button type="button" data-dismiss="modal" class="btn btn-default btn-vessel-cancel" style="height: 43px;">Clear</button>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnSaveNewVesselTrip" style="width: 98%;" class="btn btn-success">Save Vessel Trip</button>
                </div>
            </div>
        </div>
    </div>
</div>

            
        <div id="allocationsTab" class="row hideMe">
            <div class="col-xs-3">
                <div class="input-group">
                    <span class="input-group-addon">Filter</span>
                    <input id="commoditiesFilter" type="text" class="form-control" placeholder="Type here...">
                </div>
                <div id="commodList" class="list-group">
                </div>
            </div>
            <div class="col-xs-1"></div>

            <div class="col-xs-4">
                <div class="row">
                    <label for="commod">Commodities:</label>
                    <div id="commodSelectedList" class="list-group" style="min-height: 300px;">
                    </div>

                </div>
                <div class="row">
                </div>
            </div>
            <div class="col-xs-1"></div>

            <div class="col-xs-3">
                <div class="row">
                    <h2 style="margin-top: 0px; margin-bottom: 10px; text-align: center;">Barges</h2>
                </div>
                <div class="row">
                    <div class="panel panel-default barge-panel">
                        <ul id="bargeListAlloc" class="list-group">
                        </ul>
                    <button id="addBargeButton" class="btn btn-block btn-green">Add Barge</button>
                    </div>

                </div>
                <div class="row">
                   
                </div>
            </div>
        </div>

        <hr />
        <button id="submitBookingButton" class="btn btn-block btn-success fadedButton">Please Complete Form To Continue</button>
        <hr />
    </div>
    <!-- Bootstrap core JavaScript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include( '../Includes/modals/mblx_modal_booking_contract_search.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_vessel_trip.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_barge_search.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_editBadges.php'); ?>

</body>

</html>
