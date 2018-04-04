awoApp = angular.module('awoApp', []);
awoApp.controller('wreCtrl', function($scope, $http) {
	$http.get("http://realestate.vnartiz.com/properties/angular_get_properties").success(function(response) {$scope.data = response;});
});

awoApp.controller('viCtrl', function($scope, $http) {
	$http.get("http://recruit.vnartiz.com/employee/top/angular_get_job").success(function(response) {$scope.vi = response;});
});

awoApp.controller('iphotoCtrl', function($scope, $http) {
	$http.get("http://color.vnartiz.com/top/angular_get_album").success(function(response) {$scope.iphoto = response;});
});

awoApp.controller('movieCtrl', function($scope, $http) {
	$http.get("http://color.vnartiz.com/top/angular_get_movie").success(function(response) {$scope.movie = response;});
});

awoApp.controller('musicCtrl', function($scope, $http) {
	$http.get("http://color.vnartiz.com/top/angular_get_music").success(function(response) {$scope.music = response;});
});