$(function (){

	$("#navbarToggle").blur(function(event){
		var screenWidth = window.innerWidth;
		if(screenWidth < 600){
			$("#myNavbar").collapse('hide');
		}
	});
});

var frmvalidator = new Validator(“commentform”); 
frmvalidator.addValidation(“name”,”req”,”Please provide your name”); 
frmvalidator.addValidation(“email”,”req”,”Please provide your email”); 
frmvalidator.addValidation(“email”,”email”, “Please enter a valid email address”); 
