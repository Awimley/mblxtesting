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
        .datepicker{z-index:1151 !important;}
    </style>

    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>

    <script src="/public/js/mblx.Customers.DataAccess.js" type="text/javascript"></script>
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
<?php include('../Includes/mblx_navbar.php'); ?>

    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Contract Page</h1>
            </div>
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            <div id="mainAlert" class="alert alert-success hideMe" role="alert"></div>
            <div class="col-xs-2">
   
            </div>
            <div class="col-xs-8">
            <form class="form-horizontal" role="form">
               <div class="form-group">
                        <!--label for="inputCustomer" type="button" class="btn btn-primary btn-lg col-xs-3 control-label"> Customer
            </label-->

                        <!-- Single button -->
                        <div class="btn-group col-xs-3">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Customer
                            </button>
                            <ul id="customerDropdown" class="dropdown-menu noclose" role="menu">

                                <li>
                                    <!--a href="#"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Customer</a-->
                                    <button type="button" data-toggle="modal" class="btn btn-default btn-block" data-target="#customerEditModal">
                                        <span class="glyphicon glyphicon-plus" data-aria-hidden="true">&nbsp;</span>Add Customer &nbsp;<span class="caret"></span>
                                    </button>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="well well-sm">Search:
                                        <input id="inputCustomerDropTypeahead" type="text" class="typeahead customerTypeahead" />
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <div class="col-xs-9">
                            <input type="text" class="form-control typeahead customerTypeahead" id="inputCustomer" placeholder="Start Typing Customer Name" />
                        </div>
                    </div>
              <div class="form-group">
                <label for="inputContractNumber" class="col-sm-2 control-label">Contract Number</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="inputPassword3" placeholder="">
                </div>
              </div>
                <div class="form-group">
                        <label for="inputBookingDate" class="col-xs-3 control-label"> Origin
                        </label>
                        <div class="btn-group col-xs-3">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Origin &nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " role="menu">

                                <li><a href="/pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Lake Charles, LA</a>
                                </li>
                                <li><a href="#">Morgan City, LA</a>
                                </li>
                                <li><a href="#">New Orleans, LA</a>
                                </li>

                            </ul>
                        </div>
                        <label for="inputFinalDate" class="col-xs-3 control-label"> Destination
                        </label>
                        <div class="btn-group col-xs-3">
                            <button type="button" class="btn btn-primary dropdown-toggle btn-block " data-toggle="dropdown">
                                Destination &nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu " role="menu">

                                <li><a href="/pages/destination.php"><span class="glyphicon glyphicon-plus"></span>&nbsp; Add Destination</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Lake Charles, LA</a>
                                </li>
                                <li><a href="#">Morgan City, LA</a>
                                </li>
                                <li><a href="#">New Orleans, LA</a>
                                </li>

                            </ul>
                        </div>
                    </div>
              <div class="form-group">
              
                <div class="col-sm-12"> 
                 <button type="button" data-toggle="modal" data-target="#selectServicesModal" class="btn btn-block btn-primary">Select Services</button>
                </div>
              </div>
             <div class="form-group">
                <label for="inputContractNumber" class="col-sm-2 control-label">Rate</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="inputPassword3" placeholder="">
                </div>
              </div>
                  <div class="form-group">
                <label for="inputContractNumber" class="col-sm-2 control-label">Demurrage Rate</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="inputPassword3" placeholder="">
                </div>
              </div>
                  <div class="form-group">
                <label for="inputContractNumber" class="col-sm-2 control-label">Free Days</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="inputPassword3" placeholder="">
                </div>
              </div>
                <div class="form-group">
                        <label for="inputBookingDate" class="col-xs-3 control-label"> Start Date
                        </label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control datepicker" id="inputBookingDate" placeholder="">
                        </div>
                        <label for="inputFinalDate" class="col-xs-3 control-label"> End Date
                        </label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control datepicker" id="inputFinalDate" placeholder="">
                        </div>
                    </div>
                <hr />
                 <div class="form-group">
                        
                        <div class="col-xs-12">
                            <button style="height:100px;" class="btn btn-block btn-primary" >Submit</button>
                        </div>
                    </div>
            </form>
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
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>

</html>