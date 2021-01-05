$(function (){

	$("#navbarToggle").blur(function(event){
		var screenWidth = window.innerWidth;
		if(screenWidth < 600){
			$("#myNavbar").collapse('hide');
		}
	});
});