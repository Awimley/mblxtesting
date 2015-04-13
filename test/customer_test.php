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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css" type="text/css" />
    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="/public/js/dropdowns-enhancement.js" type="text/javascript"></script>
    <script src="/public/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/public/js/typeahead.jquery.min.js" type="text/javascript"></script>

    <script src="/public/js/taffy.js" type="text/javascript"></script>

    <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
 
   
    <script type="text/javascript">
        var custs = TAFFY();
        $(function () {


            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#customerTable tbody').on( 'click', 'button', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[0] +"'s salary is: "+ data[ 5 ] );
    } );

            getCustomers();
        });

        function getCustomers() {

            // clear results and add spinning gears icon
            $.when($('.customerListItem').remove()).done(function () {
                var promise = getCustomerData();

                // use promise to implement what happens when OData result is ready
                promise.then(onGetCustomersComplete, onErrorFunction);
            });

            // call view-model function which returns promise


        }

        function getCustomerData() {
            // parse target URI for customer list in app web
            var requestUri = "../../Functions/getCustomerPageData.php";

            // create object for request headers
            var requestHeaders = {
                "accept": "application/json;odata=verbose"
            }

            // send call across network
            var deferred = $.ajax({
                url: requestUri,
                headers: requestHeaders
            });

            return deferred.promise();
        };

        function onGetCustomersComplete(dataz) {
            var data = dataz.data;
            console.log(data);
            data.sort(function (a, b) {
                if (a.rank > b.rank) {
                    return 1;
                }
                if (a.rank < b.rank) {
                    return -1;
                }
                return 0;
            });
            ////console.log(data);
            var listItemString = "";
            var listItemBuildConter = 0;
            jQuery.each(data, function (q, r) {
                ////console.log(q);
                custs.insert(r);


                /*custs.insert({
                id: r.id,
                code: r.code,
                name: r.name,
                phone: r.phone,
                address: r.address
                })

                listItemBuildConter++;
                listItemString += '<tr> \
                <td><button type="button" onClick="showEditModal(' + r.id + ')" class="btn btn-block btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td> \
                <td>' + r.code + '</td> \
                <td>' + r.name + '</td> \
                <td>' + r.phone + '</td> \
                <td>' + r.address + '</td> \
                <td>' + r.city + '</td> \
                <td>' + r.state + '</td> \
                <td>' + r.postCode + '</td> \
                <td>' + r.country + '</td> \
                <td><a href="#">Conctacts</a></td> \
                <td>' + r.email + '</td> \
                </tr>';

                ////console.log(r);*/

            });


           
          var tableData = custs({ active_status: { is: "1"} }).get();


            $('#customerTable').DataTable({
                "data" : tableData,
                "columns" : [
                   {"defaultContent": "<button class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></button>"},
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "phone" },
                    { "data": "address" },
                    { "data": "city" },
                    { "data": "state" },
                    { "data": "postCode" },
                    { "data": "country" },
                    {"defaultContent": "<button class=\"btn btn-primary\">Contacts</button>"},
                    { "data": "email" },
                  ],
                  "dom": '<"row"<"col-xs-6"l><"col-xs-6"fr>>t<"row"<"col-xs-6"i><"col-xs-6"p>>'
            });
            ////console.log(listItemString);
            /*$.when($("#custTbody").append(listItemString)).done(function () {
            $('#customerTable').DataTable({
            "dom": '<"row"<"col-xs-6"l><"col-xs-6"fr>>t<"row"<"col-xs-6"i><"col-xs-6"p>>'
            });
            });*/

            //console.log("loaded dem types");
        }

        function showEditModal(customerId) {
            //populate modal fields
            $("#customerEditModal").modal('show');
        }

        function onErrorFunction(error) {
            console.log("error performing operation");
            console.log(error);
            //location.reload();
        }
    </script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>

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
            <div class="col-xs-4">
                <button data-toggle="modal" data-target="#customerEditModal" class="btn btn-block btn-primary">Add New Customer</button>
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-4">
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
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Post Code</th>
                            <th>Country</th>
                            <th>Contacts</th>
                            <th>Email</th>
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
    <div class="modal fade" id="customerEditModal" tabindex="-1" role="dialog" data-aria-labelledby="customerEditModalLabel" data-aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span data-aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="customerEditModalLabel">Add Customer</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="inputCustomerModal" class="col-xs-2 control-label">Customer</label>
                            <div class="col-xs-10">
                                <input id="inputAddCustomer_name" type="text" class="form-control" id="inputCustomerModal" placeholder="Abellon Clean Energy" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputContactsModal" class="col-xs-2 control-label">Contacts</label>
                            <div class="col-xs-10">
                                <select multiple class="form-control">
                                    <option>Bill Jasper</option>
                                    <option>Steve Elliot</option>
                                    <option>Contact Manns</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-xs-2 control-label">Email</label>
                            <div class="col-xs-10">
                                <input id="inputAddCustomer_email" type="email" class="form-control" id="inputEmail3" placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddressModal" class="col-xs-2 control-label">Address</label>
                            <div class="col-xs-10">
                                <textarea id="inputAddCustomer_address" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-xs-2 control-label">City</label>
                            <div class="col-xs-10">
                                <input id="inputAddCustomer_city" type="text" class="form-control" id="inputEmail3" placeholder="Northumbria" />
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button id="btnAddCustomerSave" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>

</html>