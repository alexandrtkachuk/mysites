App.config(function($stateProvider, $urlRouterProvider) {
	  //
	  // For any unmatched url, redirect to /state1
	  //urlRouterProvider.otherwise("/");
	  $urlRouterProvider.otherwise("/");
	  
	
	
	
	
	$stateProvider
		.state('index', {
		  url: "/",
		  controller: "Index as cI",
		  templateUrl: "partials/index.html"
		})
	
		
		$stateProvider
		.state('contacts', {
		  url: "/contacts",
		  
		  template: "rrrrrrrrrrr"
		})
		

  });