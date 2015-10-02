App.controller('Index',function($resource, myConfig){
	
	
	
	this.temp =99;
	
	var User = $resource('http://localhost:3080/mysites/panel/index.php/Rest/info/:userId', {userId:'@id'} );
	
	this.me = User.get({userId:1});
	
	console.log(myConfig.baseUrl);
});