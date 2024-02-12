// Select the password input field, the confirm password input field, and the validation message containers
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('confirm_password');
var validationPassword = document.getElementById('validation-password');
var validationConfirm = document.getElementById('validation-confirm');
var passwordrequirement = document.getElementById('password-requirement');

// Add an event listener for the 'focus' event
passwordInput.addEventListener('focus', function () {
    passwordrequirement.classList.remove('hide'); // Show the validation-password2 message
    validationPassword.classList.add('hide');
});

// Add an event listener for the 'blur' event
passwordInput.addEventListener('blur', function () {
    if (this.value.trim() === '') {
        // If the password input field is empty
        validationPassword.classList.remove('hide'); // Show the validation-password message
        this.dataset.valid = '0';
        passwordrequirement.classList.add('hide'); // Hide the validation-password2 message
    } else if (this.dataset.valid === '1') {
        passwordrequirement.classList.add('hide'); // Hide the validation-password2 message
    }
});

// Add an event listener to the password input field
passwordInput.addEventListener('input', function () {
    var validationPassword2 = document.getElementById('validation-password2');
    var svgElement = validationPassword2.querySelector('svg');
    var spanElements = validationPassword2.querySelectorAll('span');
    var passwordMessage2 = document.getElementById('password-message2');

    var regexLength = /^.{8,15}$/; // Regular expression to check if the password is between 8 and 15 characters long

    if (regexLength.test(this.value)) {
        // If the password is between 8 and 15 characters long
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"  aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><path d="M15.3 9.3 11 13.6l-1.3-1.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l2 2c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4s-1-.4-1.4 0z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#12784f');
        passwordMessage2.style.color = '#12784f'; // Change the color of the password-message2 span
    } else {
        // If the password is not between 8 and 15 characters long
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#b91e1e');
        passwordMessage2.style.color = '#b91e1e'; // Change the color of the password-message2 span
    }

    var validationPassword3 = document.getElementById('validation-password3');
    var svgElement = validationPassword3.querySelector('svg');
    var spanElements = validationPassword3.querySelectorAll('span');
    var passwordMessage3 = document.getElementById('password-message3');

    var regexNumber = /[0-9]/; // Regular expression to check if the password contains a number

    if (regexNumber.test(this.value)) {
        // If the password contains a numeric number
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"  aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><path d="M15.3 9.3 11 13.6l-1.3-1.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l2 2c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4s-1-.4-1.4 0z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#12784f');
        passwordMessage3.style.color = '#12784f'; // Change the color of the password-message3 span
    } else {
        // If the password does not contain a numeric number
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#b91e1e');
        passwordMessage3.style.color = '#b91e1e'; // Change the color of the password-message3 span
    }

    var validationPassword4 = document.getElementById('validation-password4');
    var svgElement = validationPassword4.querySelector('svg');
    var spanElements = validationPassword4.querySelectorAll('span');
    var passwordMessage4 = document.getElementById('password-message4');

    var regexLowercase = /[a-z]/; // Regular expression to check if the password contains a lowercase letter

    if (regexLowercase.test(this.value)) {
        // If the password contains a lowercase letter
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"  aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><path d="M15.3 9.3 11 13.6l-1.3-1.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l2 2c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4s-1-.4-1.4 0z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#12784f');
        passwordMessage4.style.color = '#12784f'; // Change the color of the password-message4 span
    } else {
        // If the password does not contain a lowercase letter
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#b91e1e');
        passwordMessage4.style.color = '#b91e1e'; // Change the color of the password-message4 span
    }

    var validationPassword5 = document.getElementById('validation-password5');
    var svgElement = validationPassword5.querySelector('svg');
    var spanElements = validationPassword5.querySelectorAll('span');
    var passwordMessage5 = document.getElementById('password-message5');

    var regexUppercase = /[A-Z]/; // Regular expression to check if the password contains an uppercase letter

    if (regexUppercase.test(this.value)) {
        // If the password contains an uppercase letter
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"  aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><path d="M15.3 9.3 11 13.6l-1.3-1.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l2 2c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4s-1-.4-1.4 0z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#12784f');
        passwordMessage5.style.color = '#12784f'; // Change the color of the password-message5 span
    } else {
        // If the password does not contain an uppercase letter
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#b91e1e');
        passwordMessage5.style.color = '#b91e1e'; // Change the color of the password-message5 span
    }

    var validationPassword6 = document.getElementById('validation-password6');
    var svgElement = validationPassword6.querySelector('svg');
    var spanElements = validationPassword6.querySelectorAll('span');
    var passwordMessage6 = document.getElementById('password-message6');

    var regexSymbol = /[!@#$%^&*(),.?":{}|<>]/; // Regular expression to check if the password contains a symbol

    if (regexSymbol.test(this.value)) {
        // If the password contains a symbol
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16"  aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><path d="M15.3 9.3 11 13.6l-1.3-1.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l2 2c.2.2.5.3.7.3s.5-.1.7-.3l5-5c.4-.4.4-1 0-1.4s-1-.4-1.4 0z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#12784f');
        passwordMessage6.style.color = '#12784f'; // Change the color of the password-message6 span
    } else {
        // If the password does not contain a symbol
        svgElement.outerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"><path d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z"></path><circle cx="12" cy="17" r="1"></circle><path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z"></path></svg>';
        spanElements.forEach(span => span.style.color = '#b91e1e');
        passwordMessage6.style.color = '#b91e1e'; // Change the color of the password-message6 span
    }

    if (regexLowercase.test(this.value) && regexUppercase.test(this.value) && regexNumber.test(this.value) && regexSymbol.test(this.value) && regexLength.test(this.value)) {
        // If all requirements are met
        this.dataset.valid = '1'; // Set the valid data attribute to "1"
    } else {
        // If not all requirements are met
        this.dataset.valid = '0'; // Set the valid data attribute to "0"
    }
});

var validationSamepassword = document.getElementById('validation-samepassword');
// Add an event listener to the confirm password input field
passwordInput.addEventListener('input', function () {
    var samepasswordMessage = document.getElementById('samepassword-message');
    var confirmMessage = document.getElementById('confirm-message');

    if (this.value === companyOldpassword) {
        // If the confirm password input is not the same as the password input
        samepasswordMessage.textContent = 'This is your current password';
        this.dataset.valid = '0';
        validationSamepassword.classList.remove('hide'); // Show the validation message
    } else if (this.value !== confirmPasswordInput.value.trim()) {
        // If the confirm password input is not the same as the password input
        confirmMessage.textContent = 'The passwords are not the same';
        confirmPasswordInput.dataset.valid = '0';
        validationConfirm.classList.remove('hide'); // Show the validation message
    } else if (this.value === confirmPasswordInput.value.trim()) {
        // If the confirm password input is not the same as the password input
        confirmMessage.textContent = '';
        confirmPasswordInput.dataset.valid = '1';
        validationConfirm.classList.add('hide'); // Show the validation message
    }else {
        // If the confirm password input is the same as the password input
        samepasswordMessage.textContent = '';
        this.dataset.valid = '1';
        validationSamepassword.classList.add('hide'); // Hide the validation message
    }
});


// Add an event listener to the confirm password input field
confirmPasswordInput.addEventListener('input', function () {
    var confirmMessage = document.getElementById('confirm-message');
    if (this.value.trim() === '') {
        // If the confirm password input field is empty
        confirmMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationConfirm.classList.remove('hide'); // Show the validation message
    } else if (this.value !== passwordInput.value) {
        // If the confirm password input is not the same as the password input
        confirmMessage.textContent = 'The passwords are not the same';
        this.dataset.valid = '0';
        validationConfirm.classList.remove('hide'); // Show the validation message
    } else {
        // If the confirm password input is the same as the password input
        confirmMessage.textContent = '';
        this.dataset.valid = '1';
        validationConfirm.classList.add('hide'); // Hide the validation message
    }
});

var oldPasswordInput = document.getElementById('oldpassword');
var validationOldpassword = document.getElementById('validation-oldpassword');

// Add an event listener to the confirm password input field
oldPasswordInput.addEventListener('input', function () {
    var oldpasswordMessage = document.getElementById('oldpassword-message');
    if (this.value.trim() === '') {
        // If the confirm password input field is empty
        oldpasswordMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationOldpassword.classList.remove('hide'); // Show the validation message
    } else if (this.value !== companyOldpassword) {
        // If the input is the same as the CompanyEmail
        oldpasswordMessage.textContent = 'Please enter the correct current password';
        this.dataset.valid = '0';
        validationOldpassword.classList.remove('hide'); // Show the validation message
    } else {
        // If the confirm password input is the same as the password input
        oldpasswordMessage.textContent = '';
        this.dataset.valid = '1';
        validationOldpassword.classList.add('hide'); // Hide the validation message
    }
});

var submitButton = document.querySelector('.register_login_btn');

// Modify the event listener for the submit button
submitButton.addEventListener('click', function (event) {
    var invalidInputs = [];

    if (oldPasswordInput.dataset.valid !== '1') {
        invalidInputs.push({ input: oldPasswordInput, validation: validationOldpassword });
    }
    if (passwordInput.dataset.valid !== '1') {
        invalidInputs.push({ input: passwordInput, validation: passwordrequirement });
    }
    if (confirmPasswordInput.dataset.valid !== '1') {
        invalidInputs.push({ input: confirmPasswordInput, validation: validationConfirm });
    }
    
    if (invalidInputs.length > 0) {
        // If there are invalid inputs, prevent the form submission
        event.preventDefault();

        // Focus on the first invalid input
        invalidInputs[0].input.focus();

        // Show validation messages for all invalid inputs
        invalidInputs.forEach(function (invalidInput) {
            invalidInput.validation.classList.remove('hide');
        });
    }
    // If all inputs are valid, the form will submit normally
});
