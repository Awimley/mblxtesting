<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Agent</title>

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
    <link rel="stylesheet" href="/public/css/pageAgentStyle.css" />
    <link rel="stylesheet" href="/public/css/dropdowns-enhancement.min.css" type="text/css" />
   

    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="/public/js/mblx.Agents.DataAccess.js" type="text/javascript"></script>

    <script src="/pages/page_js/agentPage.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>
<body>
    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Agent Page</h1>
            </div>
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            <div class="col-xs-4">
                <button id="addAgentButton" class="btn btn-block btn-primary">Add New Agent</button>
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
            </div>
        </div>
        <br />
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
            <div class="col-xs-12">


                <table id="agentTable" class="table table-bordered" style="max-width: 1250px;">
                    <thead>
                        <tr>
                            <th>Edit</th>
                            <th>Agent</th>
                            <th>Contact Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Phone</th>
                            <th>Fax</th>
                            <th>Email</th>

                        </tr>
                    </thead>
                    <tbody id="agentTbody">


                    </tbody>
                </table>
            </div>


        </div>
        <hr />


        <br />

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <?php include( '../Includes/modals/mblx_modal_agents.php'); ?>
</body>

</html>