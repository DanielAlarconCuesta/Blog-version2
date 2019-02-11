function validateSignUpForm() {
	var emailReg = /^\w+[@]\w+[.]\w+$/;

	var email = document.forms["signUpForm"]["emailSignUp"].value;
	var email2 = document.forms["signUpForm"]["email2SignUp"].value;

	var password = document.forms["signUpForm"]["passwordSignUp"].value;
	var password2 = document.forms["signUpForm"]["password2SignUp"].value;

	if (email==email2 && password==password2 && emailReg.test(email)) {
		return true;

	} else if (email!=email2) {
		alert("Emails does not match");
		document.forms["signUpForm"]["email2SignUp"].value='';
		return false;
		exit();

	} else if (!emailReg.test(email)) {
		alert("Email isn't right");
		document.forms["signUpForm"]["emailSignUp"].style.color='';
		document.forms["signUpForm"]["email2SignUp"].value='';
		return false;
		exit();

	} else if (password!=password2) {
		alert("Passwords re not the same");
		document.forms["signUpForm"]["password2SignUp"].value='';
		return false;
		exit();
	}
}

function validateLogInForm() {
	var emailReg = /^\w+[@]\w+[.]\w+$/;
	var email = document.forms["logInForm"]["emailLogIn"].value;
	var password = document.forms["logInForm"]["passwordLogIn"].value;

	if (!emailReg.test(email)) {
		alert("The emal is not right");
		document.forms["logInForm"]["emailLogIn"].style.color="red";

		return false;

	} else {
		return true;
	}
}
