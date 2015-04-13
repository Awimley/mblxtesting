angular.module('stevedoreApp', [])

 // inject $http into our controller
 .controller('mainController', function ($http) {

     var vm = this;


     // make an API call
     $http.get('/Functions/stevedores/getStevedores.php')
     .then(function (dataz) {
         //console.log(dataz);
         // bind the users we receive to vm.users
         vm.stevedores = dataz.data.data;

     });
     vm.showModal = function (stevedoreId) {
         console.log(stevedoreId);
     }
 });