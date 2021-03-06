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

var field={};

document.addEventListener("DOMContentLoaded", function() {
 fields.name = document.getElementById('name');
 fields.email = document.getElementById('email');
 fields.comments = document.getElementById('comments');
})

function isNotEmpty(value) {
 if (value == null || typeof value == 'undefined' ) return false;
 return (value.length > 0);
}



function isValid() {
 var valid = true;
 
 valid &= fieldValidation(fields.name, isNotEmpty);
 valid &= fieldValidation(fields.email, isNotEmpty);
 valid &= fieldValidation(fields.comments, isNotEmpty);
 
 valid &= arePasswordsEqual();

 return valid;
}

class User {
 constructor(name, email, comments) {
 this.name = name;
 this.email = email;
 this.comments = comments;
 }
}

function sendComment(){
if(isValid()){
	let usr = new User(name.value, email.value, comments.value);

	alert(`${usr.name}` Thanks for your comments)
}else{
	alert("There was an error")
}
};




//Moving Letter Script
// Wrap every letter in a span
