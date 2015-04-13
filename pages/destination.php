<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Fixed Top Navbar Example for Bootstrap</title>

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
    </style>

    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>
    <script src="../Includes/js/commonJS.js"></script>

    <script src="/public/js/mblx.OriginsDestinations.DataAccess.js" type="text/javascript"></script>
    <script type="text/javascript" src="../public/js/taffy.js"></script>
    <script type="text/javascript" src="../pages/page_js/destinationsPage.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body>

    <!-- Fixed navbar -->
<?php include('../Includes/mblx_navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Destinations</h1>
            </div>
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">

            <div class="col-xs-2">
            </div>

            <div class="col-xs-4">
                <button id="btnAddDestination" class="btn btn-primary" style="width : 350px;">Add New Destination</button>
            </div>
            <div class="col-xs-6">
            </div>
        </div>
        <br />
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
            <div class="col-xs-2">

            </div>
            <div class="col-xs-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>City</th>
                            <!--th>State</th>
                            <th>Active?</th-->
                        </tr>
                    </thead>
                    <tbody id="destinationTableBody">
                        <!--tr>
                            <td><span class="glyphicon glyphicon-pencil pull-left"></span></td>
                            <td>Lake Charles</td>
                            <td>LA</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" checked>
                                    </label>
                                </div>
                            </td>
                        </tr>
                     <tr>
                            <td><span class="glyphicon glyphicon-pencil pull-left"></span></td>
                            <td>Morgan City</td>
                            <td>LA</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" checked>
                                    </label>
                                </div>
                            </td>
                        </tr>
                     <tr>
                            <td><span class="glyphicon glyphicon-pencil pull-left"></span></td>
                            <td>New Orleans</td>
                            <td>LA</td>
                            <td>
                                <div class="checkbox">
                                    <label>
                                      <input type="checkbox" checked>
                                    </label>
                                </div>
                            </td>
                        </tr-->
                    </tbody>
                </table>
            </div>
            <div class="col-xs-2">

            </div>

        </div>
        <hr />


        <br />
        <div class="modal fade" id="selectServicesModal" tabindex="-1" role="dialog" data-aria-labelledby="selectServicesLabel" data-aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="selectServicesLabel">Select Services</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> AB &middot; Service 1
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> CD &middot; Service 2
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> EF &middot; Service 3
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button id="btnAddVesselSave" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include('../Includes/modals/mblx_modal_destinations.php') ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>

</html>