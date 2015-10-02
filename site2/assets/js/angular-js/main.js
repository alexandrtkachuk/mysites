var App=angular.module('mysite',['ngResource']);


App.constant('myConfig', {
  baseUrl: '/databases/',
  dbName: 'ascrum',
  url:'http://localhost:3080/mysites/panel/index.php/Rest',
  idUser: 1
});


App.service('sResource', function($resource) {
	
	
	
});