'use strict';

var sampleAppControllers = angular.module('sampleAppControllers', ['ngRoute']);

sampleAppControllers.controller('customerListCtrl', ['$scope', '$http',
    function ($scope, $http) {
        $http.get('/Functions/getCustomerData.php').success(function (data) {
            $scope.customers = data;
            console.log(data);
        });

        $scope.orderProp = 'rank';
    } ]);

    sampleAppControllers.controller('customerDetailCtrl', ['$scope', '$routeParams',
    function ($scope, $routeParams) {

        $scope.custId = $routeParams.custId;

    }]);