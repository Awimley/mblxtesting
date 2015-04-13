<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CATS &middot; Customers</title>

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

    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="/public/js/mblx.Customers.DataAccess.js" type="text/javascript"></script>
    <script src="/public/js/mblx.Contacts.DataAccess.js" type="text/javascript"></script>
    <script src="page_js/customerPage.js" type="text/javascript"></script>
    <script type="text/javascript">
        /*function delContact() {
            var r = confirm("Are you sure you want to delete ?");
            if (r == true) {
                delCustomer();
            }
            console.log(r);
        }
        function delCustomer() {
            var seldContactId = $("#inputCustomerModal_contacts option:selected").val();
            console.log(seldContactId);
        }*/
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<body>

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Customer Page</h1>
            </div>
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">

            <div class="col-xs-1">
            </div>
            <div class="col-xs-5">
                <button id="btnAddCustomer" class="btn btn-block btn-primary">Add New Customer</button>
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
                <table id="customerTable" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Code</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Post Code</th>
                            <th>Country</th>
                            <th>Contacts</th>
                            <th>Primary Email</th>
                            <th>Active?</th>
                        </tr>

                    </thead>
                    <tbody id="custTbody">
                    </tbody>
                </table>
            </div>
            <div class="col-xs-1">
            </div>

        </div>
        <hr />


        <br />


    </div>
    <?php include( '../Includes/modals/mblx_modal_customer.php'); ?>
    <?php include( '../Includes/modals/mblx_modal_contacts.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>

</html>
