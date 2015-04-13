<?php

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CATS &middot; Spot Contracts</title>

    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.darkly.min.css" rel="stylesheet" />
    <link href="/public/css/bootstrap.cosmo.css" rel="stylesheet" />
    <!-- Custom styles for this template -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='//fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/public/css/pageCustomerStyle.css" />
    <link rel="stylesheet" href="/public/css/dropdowns-enhancement.min.css" type="text/css" />
    <style type="text/css">
        body {
            min-height: 2000px;
            padding-top: 100px;
        }

        .container {
            min-width: 80%;
        }

        .datepicker {
            z-index: 1151 !important;
        }

        .popover {
            width: 1000px;
        }

        #contactsModalForm > .form-group {
            margin-bottom: 8px;
        }

        ul.dropdown-menu {
            min-width: 300px;
            max-height: 300px;
            overflow-y: scroll;
        }

        #servicesDropdown {
            min-width: 300px;
            max-height: 300px;
            overflow-y: scroll;
        }


        .twitter-typeahead {
            width: 100% !important;
        }

        .expiredContract {
            color: #FF8080;
        }

        .moreSpaceBetweenButtons > button {
            margin-bottom: 5px;
        }

        .serviceListItem {
            padding: 2px 3px;
        }

        .oddStripeRow {
            background-color: whitesmoke;
        }

       
       /* body {
    background-image: url("http://blogs.technet.com/cfs-file.ashx/__key/communityserver-blogs-components-weblogfiles/00-00-01-01-35/e8nZC.gif");
    background-repeat: repeat;
}
       */
       
    </style>
    <link rel="stylesheet" href="/public/css/jquery.dataTables.css" type="text/css" />
    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="/public/js/bootstrap.js" type="text/javascript"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <script src="../Includes/js/commonJS.js" type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

     <!-- jquery autocomplete stuff -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="/public/css/jquery-ui.css" rel="stylesheet" />
</head>

<script src="/public/js/taffy.js" type="text/javascript"></script>
<!--script src="/public/js/jquery.maskedinput.min.js" type="text/javascript"></script-->
<script src="/public/js/jquery.number.min.js" type="text/javascript"></script>
<script src="/public/js/jquery.dataTables.js"></script>


<script src="/public/js/mblx.Customers.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Contacts.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Contracts.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Services.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Commodities.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.OriginsDestinations.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Equipment.DataAccess.js" type="text/javascript"></script>
<script src="/public/js/mblx.Terminals.DataAccess.js" type="text/javascript"></script>

<script src="/pages/page_js/spotContracts.js" type="text/javascript"></script>
<body>

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>


    <div id="theContainer" class="container">
        <div class="row">
            <div class="page-header">

                <h1>Create New Spot Contract</h1>
                
            </div>

        </div>

        <!--div class="row">
            <div class="col-xs-4">
               
                <div class="btn-group-vertical moreSpaceBetweenButtons" style="width: 100%;">
                    <button id="btnAddSpotContract" type="button" class="btn btn-primary btn-block">New Spot Contract (this button is useless)</button>
                </div>
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <button id="btnShowExpiredContracts" type="button" class="btn btn-info" data-toggle="button" aria-pressed="false">Show Expired Contracts</button>
                <button id="btnHideExpiredContracts" type="button" class="btn btn-info hideMe" data-toggle="button" aria-pressed="false">Hide Expired Contracts</button>
            </div>
        </div-->
        <br />
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
        </div>
        

         <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>

            <div class="col-lg-1"></div>
            <div class="col-lg-5 triForm">
                <!--form id="topLeft" class="form-horizontal" data-persist="garlic" role="form"-->
                <form id="topLeft" class="form-horizontal" role="form">
                   

                    <div class="form-group">
                        <!--label  type="button" class="btn btn-primary btn-lg col-xs-3 control-label"> Customer </label-->
                        <!-- Single button -->
                        <label class="col-xs-3 control-label" style="font-size: medium; margin-right: 15px;">Customer </label>

                        <div class="col-xs-8 input-group">
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
                    
                      <div class="form-group">
                        <label class="col-xs-3 control-label" style="font-size: medium;">Contract Number</label>
                        <div class="col-xs-9">
                            <input type="tel" class="form-control" id="inputContractNumber" placeholder="Contract Number">
                        </div>
                    </div>

                    <!-- Booking Date Group -->
                    <div class="form-group form-group-sm">
                        <label class="col-xs-3 control-label" for="inputETADate" style="font-size: medium;">ETA </label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control datepicker" id="inputETADate" placeholder="" />
                        </div>
                    </div>
                    <!--div class="form-group form-group-sm">
                        <label  class="col-xs-5 control-label" style="font-size: medium;">Final Date </label>
                        <div class="col-xs-7">
                            <input type="text" class="form-control datepicker" id="inputFinalDate" placeholder="" />
                        </div>
                    </div-->
                   
                </form>
            </div>

            <div class="col-lg-5 triForm">
                <!--form id="topRight" data-persist="garlic" class="form-horizontal" role="form"-->
                <form id="topRight" class="form-horizontal" role="form">
                  
                    <div class="form-group form-group-sm">
                        <label for="inputStartDate" class="col-xs-3 control-label" style="font-size: medium;">Start Date </label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control datepicker" id="inputStartDate" placeholder="" />
                        </div>
                    </div>
                    
                     <div class="form-group form-group-sm">
                        <label class="col-xs-3 control-label" for="inputEndDate" style="font-size: medium;">End Date </label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control datepicker" id="inputEndDate" placeholder="" />
                        </div>
                    </div>

                  

                </form>
            </div>
            <div class="col-lg-1"></div>
        </div>

        <div class="row">
            <table id="spotContractTable" class="table table-bordered table-striped">
                <caption>Rate Table</caption>
                <thead>
                    <tr>
                        <th>Origin</th>
                        <th>Destination</th>
                        <th>Terminal</th>
                        <th>Commodity</th>
                        <th>Rate Type</th>
                        <th>Rate Basis</th>
                        <th>Value of Rate Basis</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button id="spotOriginButton0" type="button" class="btn btn-primary dropdown-toggle btn-block btnOrigin" data-toggle="dropdown">New Orleans</button>
                                <ul class="originDropdown dropdown-menu" role="menu">
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button type="button" id="spotDestinationButton0" class="btn btn-primary dropdown-toggle btn-block btnDest" data-toggle="dropdown">Destination &nbsp;<span class="caret pull-right"></span> </button>
                                <ul class="destinationDropdown dropdown-menu" role="menu">
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button type="button" id="terminalButton0" class="btn btn-primary dropdown-toggle btn-block btnTerm" data-toggle="dropdown">Terminal &nbsp;<span class="caret pull-right"></span> </button>
                                <ul class="terminalDropdown dropdown-menu" role="menu">
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button type="button" id="commodityButton0" class="btn btn-primary dropdown-toggle btn-block btnTerm" data-toggle="dropdown">Commodities &nbsp;<span class="caret pull-right"></span> </button>
                                <ul class="commodityDropdown dropdown-menu" role="menu">
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button type="button" id="rateTypeButton0" class="btn btn-primary dropdown-toggle btn-block btnTerm" data-toggle="dropdown">Rate Type &nbsp;<span class="caret pull-right"></span> </button>
                                <ul class="rateDropdown dropdown-menu" role="menu">
                                     <li class="rateTypeListItem">
                                        <a class="rateTypeListItemLink" onclick="populateButton('rateTypeButton0', 'Flat Charge')">Flat Charge</a>
                                    </li>
                                    <li class="rateTypeListItem">
                                        <a class="rateTypeListItemLink" onclick="populateButton('rateTypeButton0', 'Per Net Ton')">Per Net Ton</a>
                                    </li>
                                    <li class="rateTypeListItem">
                                        <a class="rateTypeListItemLink" onclick="populateButton('rateTypeButton0', 'CWT')">CWT</a>
                                    </li>
                                    <li class="rateTypeListItem">
                                        <a class="rateTypeListItemLink" onclick="populateButton('rateTypeButton0', 'Gross Ton')">Gross Ton</a>
                                    </li>
                                    <li class="rateTypeListItem">
                                        <a class="rateTypeListItemLink" onclick="populateButton('rateTypeButton0', 'Metric Ton')">Metric Ton</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group col-xs-12">
                                <button type="button" id="rateBasisButton0" class="btn btn-primary dropdown-toggle btn-block btnTerm" data-toggle="dropdown">Rate Basis &nbsp;<span class="caret pull-right"></span> </button>
                                <ul class="rateBasisDropdown dropdown-menu" role="menu">
                                   <li class="rateBasisListItem">
                                        <a class="rateBasisListItemLink" onclick="populateButton('rateBasisButton0', 'Per Barge')">Per Barge</a>
                                    </li>
                                    <li class="rateBasisListItem">
                                        <a class="rateBasisListItemLink" onclick="populateButton('rateBasisButton0', 'Specified')">Specified</a>
                                    </li>
                                    <li class="rateBasisListItem">
                                        <a class="rateBasisListItemLink" onclick="populateButton('rateBasisButton0', 'Minimum')">Minimum</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <input id="rateBasisValueInput0" type="text" />
                        </td>
                        <td>
                            <input id="rateInput0" type="text" />
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <button id="addNewRow" class="btn btn-block">Add row</button>
    </div>
</body>
</html>