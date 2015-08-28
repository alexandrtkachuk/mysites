App.directive('myHeader', function() {
  return {
      restrict: 'AE',
      replace: 'true',
      templateUrl: "partials/header.html"
  };
});