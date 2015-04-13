<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CATS &middot; Barge Lines</title>

    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.darkly.min.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.0/cosmo/bootstrap.min.css" rel="stylesheet">
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

    </style>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css" type="text/css" />
    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>

    <script src="/public/js/taffy.js" type="text/javascript"></script>
    <script src="/public/js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script src="../Includes/js/commonJS.js" type="text/javascript"></script>

    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="/public/js/mblx.BargeLines.DataAccess.js" type="text/javascript"></script>
    
    <script src="page_js/bargeLinePage.js" type="text/javascript"></script>



    <script>
        /*function delContact() {
            var r = confirm("Are you sure you want to delete ?");
            if (r == true) {
                delbargeLine();
            }
            console.log(r);
        }
        function delbargeLine() {
            var seldContactId = $("#inputbargeLineModal_contacts option:selected").val();
            console.log(seldContactId);
        }*/
    </script>
</head>

<body >

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Barge Lines</h1>
            </div>
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            <div class="col-xs-1">
            </div>
            <div class="col-xs-5">
                <button id="addBargeLineButton" ng-click="vm.testClick()" class="btn btn-block btn-primary">Add New Barge Line</button>
            </div>
            <div class="col-xs-6">
            </div>
        </div>
        <br />
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
        </div>
        <div class="row">
            <div class="col-xs-1">
            </div>
            <div class="col-xs-10">
                <table id="bargeLineTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zip</th>
                        </tr>

                    </thead>
                    <tbody id="bargeLineTbody">
                    </tbody>
                </table>
            </div>
            <div class="col-xs-1">
            </div>

        </div>
        <hr />
        <br />


    </div>

    <?php include( '../Includes/modals/mblx_modal_bargelines.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
