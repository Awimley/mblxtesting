<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.1.318/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="http://cdn.kendostatic.com/2014.1.318/styles/kendo.silver.min.css" />
    <script src="/public/js/jquery-1.11.2.js"></script>
    <script src="http://cdn.kendostatic.com/2014.1.318/js/kendo.all.min.js"></script>
    <script>
        var customerPageDataSource = new kendo.data.DataSource({
            transport: {
                read: {
                    url: "/Functions/getCustomerPageData.php",
                    dataType: "json"
                },
                create: {
                    url: "/Functions/postCustomerData.php",
                    dataType: "json",
                    type: "POST"
                },
                parameterMap: function(options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models)
                        };
                    }
                }
            },
            batch: true,

            schema: {
                data: "data",
                model: {
                    id: "id",
                    fields: {


                        name: {
                            type: "text"
                        },
                        email: {
                            type: "text"
                        },
                         address: {
                            type: "text"
                        },
                         city: {
                            type: "text"
                        }

                    }
                }
            }
        });
        $(document).ready(function() {
            $("#grid").kendoGrid({
                dataSource: customerPageDataSource,
                columns: [{
                    field: "name",
                    title: "Customer Name"
                }, {
                    field: "email",
                    title: "Customer Email"
                }, {
                    field: "address",
                    title: "Customer address"
                }, {
                    field: "city",
                    title: "Customer city"
                } ],
                editable: true,
                 toolbar: ["create", "save", "cancel"]
               


            });
        });
    </script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script></head>

<body>
    <div id="grid"></div>
</body>

</html>