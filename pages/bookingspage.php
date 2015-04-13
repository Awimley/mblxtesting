<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CATS &middot; Origin Schedule</title>
  
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
    <link href='//fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <style type="text/css">
        @font-face {
            font-family: 'bebasregular';
            src: url('BEBAS___-webfont.eot');
            src: url('BEBAS___-webfont.eot?#iefix') format('embedded-opentype'), url('../public/fonts/BEBAS___-webfont.woff2') format('woff2'), url('../public/fonts/BEBAS___-webfont.woff') format('woff'), url('../public/fonts/BEBAS___-webfont.ttf') format('truetype'), url('../public/fonts/BEBAS___-webfont.svg#bebasregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'playbold';
            src: url('../public/fonts/Play-Bold-webfont.eot');
            src: url('../public/fonts/Play-Bold-webfont.eot?#iefix') format('embedded-opentype'), url('../public/fonts/Play-Bold-webfont.woff2') format('woff2'), url('../public/fonts/Play-Bold-webfont.woff') format('woff'), url('../public/fonts/Play-Bold-webfont.ttf') format('truetype'), url('../public/fonts/Play-Bold-webfont.svg#playbold') format('svg');
            font-weight: normal;
            font-style: normal;
        }


.DTTT_Print .pdfButton {
display:none;
}

.DTTT_Print th:first-of-type {
    display:none;
}

.DTTT_Print td:first-of-type {
    display:none;
}


        @media print {
            @page {
                size: landscape;
            }

            .DTTT_Print {
                padding-top: 10px;
                margin-top: 0px;
            }

            .DTTT_print_info {
                display: none;
            }

            .container {
                margin: 0 auto;
                min-width: 95%;
            }
        }

        @media screen {
            .container {
                margin: 0 auto;
                min-width: 80%;
            }
        }

        #titleWell {
            max-width: 75%;
            padding: 0px 0px 0px 0px;
            margin: 0 auto;
        }

        #tableTitleMBLX {
            font-family: playbold, serif;
            font-size: 24px;
            color: black;
            margin: 0;
        }

        #tableTitleSchedule {
            font-family: playbold, serif;
            font-size: 18px;
            color: #808080;
            margin: 0;
        }

        body {
            padding-top: 100px;
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
    </style>
    <link rel="stylesheet" href="/public/css/jquery.dataTables.css" type="text/css" />
    <link href="/public/css/dataTables.tableTools.css" rel="stylesheet" />
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
    <script type="text/javascript" src="/public/js/dataTables.tableTools.js"></script>
    <script src="/public/js/mblx.Bookings.DataAccess.js" type="text/javascript"></script>
    <script src="/pages/page_js/bookingsPage.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>


<body>

    <!-- Fixed navbar -->
    <?php include( '../Includes/mblx_navbar.php'); ?>

    <div class="row">
        <div class="col-xs-1">
        </div>
        <div class="col-xs-5">
            
        </div>
        <div class="col-xs-6">
        </div>
    </div>
    
    <div class="container">
        <div class="row">
           
            <!--div class="page-header" style="margin-top: 5px;">
                <h1>New Booking</h1><img id="bookingLoadingGif" class="pull-right hideMe" src="/Images/719.gif" width="100px" height="auto" alt="Loading..." />
            </div-->
        </div>
        <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            
            <div class="col-xs-12">
                <table id="bookingsTable" class="table table-bordered table-hover table-striped">
                    <caption>
                        <div class="col-xs-2" style="float : left;">
                            <a href="/Functions/test/testSchedulePDF/bookingPdf.php" class="btn btn-warning pdfButton">View PDF</a>
                        </div>
                        <div id="titleWell" class="well well-sm col-xs-8">
                            <p id="tableTitleMBLX" class="text-center">MBLX, Inc./MBLX Resources</p>
                            <p id="tableTitleSchedule" class="text-center">Origin Schedule</p>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th class="editHide">Edit</th>
                            <th>Booking Company</th>
                            <th>Booking Number</th>
                            <th>Customer</th>
                            <th>Qty</th>
                            <th>Commodities</th>
                            <th>Tons</th>
                            <th>Agent</th>
                            <th>Vessel</th>
                            <th>ETA</th>
                            <th>Wharf</th>
                            <th>Stevedore</th>
                            <th>Destination</th>
                            <th>Terminal</th>
                            <th>Services</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody id="bookingsTableTbody">
                    </tbody>
                </table>

            </div>

        </div>
    </div>
      <?php include( '../Includes/modals/mblx_modal_bookings.php'); ?>
</body>

</html>
