
function validateForm() {
    let image = document.forms["recordForm"]["profile"].value;
    let name = document.forms["recordForm"]["name"].value;
    let age = document.forms["recordForm"]["age"].value;
    let contact = document.forms["recordForm"]["contact"].value;
    let email = document.forms["recordForm"]["email"].value;
    let password = document.forms["recordForm"]["password"].value;
    var name_regex = /^[a-zA-Z_\s]{3,100}$/;
    var age_regex = /^[0-9]{1,3}$/;
    var contact_regex = /^[7-9][0-9]{9}$/;

    if(!image){
        document.getElementById("output_image").style.border = "5px solid #bd2130";
        return false;
    }
    else if (name_regex.test(name) == false) {
        document.getElementById("name_error").innerHTML = "Name must be in alphabets only and atlest 3 alphabets.";
        document.forms["recordForm"]["name"].focus();
        return false;
    }
    else if (age_regex.test(age) == false) {
        document.getElementById("name_error").innerHTML= "";
        document.getElementById("age_error").innerHTML = "Enter correct age and number only."
        document.forms["recordForm"]["age"].focus();
        return false;
    }
    else if (contact_regex.test(contact) == false) {
        document.getElementById("name_error").innerHTML= "";
        document.getElementById("age_error").innerHTML="";
        document.getElementById("contact_error").innerHTML = "Enter correct contact number and 10 digits only.";
        document.forms["recordForm"]["contact"].focus();
        return false;
    }
    else if (!email) {
        document.getElementById("name_error").innerHTML= "";
        document.getElementById("age_error").innerHTML="";
        document.getElementById("contact_error").innerHTML = "";
        document.getElementById("email_error").innerHTML = "Email can\'t be empty!";
        document.forms["recordForm"]["contact"].focus();
        return false;
    }
    else if (password =="" || password <8) {
        document.getElementById("name_error").innerHTML= "";
        document.getElementById("age_error").innerHTML="";
        document.getElementById("contact_error").innerHTML = "";
        document.getElementById("email_error").innerHTML = "";
        document.getElementById("password_error").innerHTML = "Enter atlest 8 character password";
        document.forms["recordForm"]["contact"].focus();
        return false;
    }
    else {
        document.getElementById("name_error").innerHTML= "";
        document.getElementById("age_error").innerHTML="";
        document.getElementById("contact_error").innerHTML="";
        document.getElementById("email_error").innerHTML="";
        document.getElementById("password_error").innerHTML="";
        return true;
    }
}

var loadFile = function(event) {
	var image = document.getElementById('output_image');
	image.src = URL.createObjectURL(event.target.files[0]);
};