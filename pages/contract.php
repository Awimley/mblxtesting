<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CATS &middot; Customer Contracts</title>

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
    </style>
    <link rel="stylesheet" href="/public/css/jquery.dataTables.css" type="text/css" />
    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="/public/js/bootstrap.js" type="text/javascript"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>

    <script src="../Includes/js/commonJS.js" type="text/javascript"></script>

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

    <script src="/pages/page_js/contractsPage.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>


<body>

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>
    <div id="contractLoadingGif" class="jumbotron">
        <h1>Loading...</h1>
        <img id="loadingGif" class="pull-right" src="/Images/719.gif" style="width: 100px;" alt="Loading..." />
    </div>

    <div id="theContainer" class="container hideMe">
        <div class="row">
            <div class="page-header">
                <h1>Customer Contracts</h1>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-4">
                <!--button id="btnAddContract" class="btn btn-block btn-primary">Add New Contract-->
                <div class="btn-group-vertical moreSpaceBetweenButtons" style="width:100%;">
                    <button id="btnAddAnnualContract" type="button" class="btn btn-primary btn-block">New Annual Contract</button>
                    <button id="btnAddSpotContract" type="button" class="btn btn-primary btn-block">New Spot Contract</button>
                </div>
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
                <button id="btnShowExpiredContracts" type="button" class="btn btn-info" data-toggle="button" aria-pressed="false" >Show Expired Contracts</button>
                <button id="btnHideExpiredContracts" type="button" class="btn btn-info hideMe" data-toggle="button" aria-pressed="false" >Hide Expired Contracts</button>
            </div>
        </div>
        <br />
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
        </div>
        <div class="row">

            <table id="contractTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Edit</th>
                        <th>Customer Name</th>
                        <th>Contract Number</th>
                        <th>Eqipment</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Demurrage</th>
                        <th>Notes</th>
                    </tr>

                </thead>
                <tbody id="contractTbody">
                </tbody>
            </table>


        </div>
        <hr />


        <br />


    </div>
    <?php include( '../Includes/modals/mblx_modal_contract_spot.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_contract_annual.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_contracts.php'); ?>
    <script type="text/javascript">
        var checkedServices = [];
        $('#servicesListLeft, #servicesListRight').on('click', 'input', function (e) {
            var check = ($(this).parent().text());

            if ($(this).is(':checked')) {
                checkedServices.push(check);
            } else {
                checkedServices.splice((checkedServices.indexOf(check)), 1);
            }
            $('#inputContractModal_services').val(checkedServices.join());
            console.log(checkedServices.join());
            //if cs is empty, we can't use .each
        });
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>

</html>
