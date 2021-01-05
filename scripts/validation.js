function loginFormValidation() {

    var email = document.login.email;
    var password = document.login.password;

    if (validateEmail(email) && validatePassword(password)) {
        
        var emailVal = $('#email').val();
        var passwordVal = $('#password').val();

        $.post('login.php', {email:emailVal, password:passwordVal, submit:"submit"}, 
            function(data) {
                console.log(data);
                console.log(data.length);
                if (data.length === 1) {
                    window.location.href = 'home.php?id=' + data;
                } 
                else {
                    $("#feedback-text").val(data);
                }
            });

        return true;
    }
    return false;
}


function signupFormValidation() {

    var email = document.signup.email;
    var name = document.signup.name;
    var password = document.signup.password;
    var passwordConfirmation = document.signup.confirm_password;

    if (!validateName(name))
        return false;

    if (!validateEmail(email))
        return false;

    if (!validatePassword(password))
        return false;

    if (!validatePasswordsMatching(password, passwordConfirmation))
        return false;

    return true;
}

function validateEmail(email) {
    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (email.value.match(mailformat)) {
        return true;
    }
    else {
        document.getElementById("feedback-text").innerText = "Invalid email!";
        email.focus();
        return false;
    }
}

function validatePassword(password) {
    p_text = password.value; // text of the password
    p_len = p_text.length;  // length of the password

    if (p_len < 8) {
        document.getElementById("feedback-text").innerText = "Password must be atleast 8 character long!";
        password.focus();
        return false;
    }

    return true;
}

function validateName(name) {
    var alphabet = /^[A-Za-z\s]+$/;

    if (name.value.match(alphabet)) {
        return true;
    } 
    else {
        document.getElementById("feedback-text").innerText = "Name must contain characters only!";
        name.focus();
        return false;
    }

}

function validatePasswordsMatching(password, passwordConfirmation) {
    if (password.value === passwordConfirmation.value) {
        return true;
    }
    else {
        document.getElementById("feedback-text").innerText = "Password and confirmation not matching!";
        password.focus();
        return false;
    }

}