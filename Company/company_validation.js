// Add jQuery library for AJAX
var script = document.createElement('script');
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js';
document.head.appendChild(script);

// Select the email input field, the submit button, and the validation message container
var emailInput = document.getElementById('email-input');
var submitButton = document.querySelector('.register_login_btn');
var validationEmail = document.getElementById('validation-email');

// Add an event listener to the email input field
emailInput.addEventListener('input', function () {
    var emailMessage = document.getElementById('email-message');
    if (this.value.trim() === '') {
        // If the input field is empty
        emailMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationEmail.classList.remove('hide'); // Show the validation message
    } else if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(this.value)) {
        // If the input is not a valid email address
        emailMessage.textContent = 'Invalid email address, use format example@domain.com';
        this.dataset.valid = '0';
        validationEmail.classList.remove('hide'); // Show the validation message
    } else {
        // If the input is a valid email address
        // Check if the email exists in the database
        $.ajax({
            url: 'check_data.php',
            type: 'post',
            data: { email: this.value },
            success: function (response) {
                if (response == 1) {
                    emailMessage.textContent = 'Email already exists';
                    emailInput.dataset.valid = '0';
                    validationEmail.classList.remove('hide'); // Show the validation message
                } else {
                    emailMessage.textContent = '';
                    emailInput.dataset.valid = '1';
                    validationEmail.classList.add('hide'); // Hide the validation message
                }
            }
        });
    }
});

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

// Get the input field and the validation message elements
var personInput = document.getElementById('person');
var validationPerson = document.getElementById('validation-person');
var personMessage = document.getElementById('person-message');

// Add an event listener to the input field
personInput.addEventListener('input', function () {
    if (this.value.trim() === '') {
        // If the input field is empty
        personMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationPerson.classList.remove('hide'); // Show the validation message
    } else {
        // If the input field is not empty
        personMessage.textContent = '';
        this.dataset.valid = '1';
        validationPerson.classList.add('hide'); // Hide the validation message
    }
});

// Get the input field and the validation message elements
var contactInput = document.getElementById('contact');
var validationContact = document.getElementById('validation-contact');
var contactMessage = document.getElementById('contact-message');

// Add an event listener to the phone input field
contactInput.addEventListener('input', function () {
    var contactMessage = document.getElementById('contact-message');
    if (this.value.trim() === '') {
        // If the input field is empty
        contactMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationContact.classList.remove('hide'); // Show the validation message
    } else if (!/^\d{9,10}$/.test(this.value)) {
        // If the input is not a valid phone number
        contactMessage.textContent = 'The phone number should contain between 9 to 10 digits.';
        this.dataset.valid = '0';
        validationContact.classList.remove('hide'); // Show the validation message
    } else {
        // If the input is a valid phone number
        // Check if the phone number exists in the database
        $.ajax({
            url: 'check_data.php',
            type: 'post',
            data: { phone: this.value },
            success: function (response) {
                if (response == 1) {
                    contactMessage.textContent = 'Phone number already exists';
                    contactInput.dataset.valid = '0';
                    validationContact.classList.remove('hide'); // Show the validation message
                } else {
                    contactMessage.textContent = '';
                    contactInput.dataset.valid = '1';
                    validationContact.classList.add('hide'); // Hide the validation message
                }
            }
        });
    }
});
// Get the input field and the validation message elements
var businessNameInput = document.getElementById('businessnname');
var validationBusinessName = document.getElementById('validation-businessname');
var businessNameMessage = document.getElementById('business-message');

// Add an event listener to the input field
businessNameInput.addEventListener('input', function () {
    var value = this.value.trim();

    // Check if the input field is empty
    if (value === '') {
        businessNameMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationBusinessName.classList.remove('hide'); // Show the validation message
    } else {
        // If the input field is not empty
        businessNameMessage.textContent = '';
        this.dataset.valid = '1';
        validationBusinessName.classList.add('hide'); // Hide the validation message
    }
});

// Get the select field and the validation message elements
var companySizeSelect = document.getElementById('businesssize');
var validationCompanySize = document.getElementById('validation-businesssize');
var companySizeMessage = document.getElementById('size-message');

// Add an event listener to the select field
companySizeSelect.addEventListener('change', function () {
    var value = this.value;

    // Check if the select field has a valid value
    if (value === '') {
        companySizeMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationCompanySize.classList.remove('hide'); // Show the validation message
    } else {
        // If the select field has a valid value
        companySizeMessage.textContent = '';
        this.dataset.valid = '1';
        validationCompanySize.classList.add('hide'); // Hide the validation message
    }
});

// Get the input field and the validation message elements
var registrationNoInput = document.getElementById('registrationNo');
var validationRegistrationNo = document.getElementById('validation-registrationNo');
var registrationNoMessage = document.getElementById('registration-message');

// Add an event listener to the input field
registrationNoInput.addEventListener('input', function () {
    var value = this.value;

    // Check if the input field has a valid value
    if (value.trim() === '') {
        registrationNoMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationRegistrationNo.classList.remove('hide'); // Show the validation message
    } else {
        // If the input field has a valid value
        // Check if the registration number exists in the database
        $.ajax({
            url: 'check_data.php',
            type: 'post',
            data: { registrationNo: this.value },
            success: function (response) {
                if (response == 1) {
                    registrationNoMessage.textContent = 'Registration number already exists';
                    registrationNoInput.dataset.valid = '0';
                    validationRegistrationNo.classList.remove('hide'); // Show the validation message
                } else {
                    registrationNoMessage.textContent = '';
                    registrationNoInput.dataset.valid = '1';
                    validationRegistrationNo.classList.add('hide'); // Hide the validation message
                }
            }
        });
    }
});

// Get the checkbox and the validation message elements
var termsCheckbox = document.getElementById('checkbox1');
var validationTerms = document.getElementById('validation-terms');
var termsMessage = document.getElementById('terms-message');

// Add an event listener to the checkbox
termsCheckbox.addEventListener('click', function () {
    // Check if the checkbox is checked
    if (!this.checked) {
        termsMessage.textContent = 'To create an account, you must agree to the above terms.';
        this.dataset.valid = '0';
        validationTerms.classList.remove('hide'); // Show the validation message
    } else {
        // If the checkbox is checked
        termsMessage.textContent = '';
        this.dataset.valid = '1';
        validationTerms.classList.add('hide'); // Hide the validation message
    }
});


// Modify the event listener for the submit button
submitButton.addEventListener('click', function (event) {
    var invalidInputs = [];

    // Check each input field
    if (emailInput.dataset.valid !== '1') {
        invalidInputs.push({ input: emailInput, validation: validationEmail });
    }
    if (passwordInput.dataset.valid !== '1') {
        invalidInputs.push({ input: passwordInput, validation: passwordrequirement });
    }
    if (confirmPasswordInput.dataset.valid !== '1') {
        invalidInputs.push({ input: confirmPasswordInput, validation: validationConfirm });
    }
    if (personInput.dataset.valid !== '1') {
        invalidInputs.push({ input: personInput, validation: validationPerson });
    }
    if (contactInput.dataset.valid !== '1') {
        invalidInputs.push({ input: contactInput, validation: validationContact });
    }
    if (businessNameInput.dataset.valid !== '1') {
        invalidInputs.push({ input: businessNameInput, validation: validationBusinessName });
    }
    if (companySizeSelect.dataset.valid !== '1') {
        invalidInputs.push({ input: companySizeSelect, validation: validationCompanySize });
    }
    if (registrationNoInput.dataset.valid !== '1') {
        invalidInputs.push({ input: registrationNoInput, validation: validationRegistrationNo });
    }
    if (termsCheckbox.dataset.valid !== '1') {
        invalidInputs.push({ input: termsCheckbox, validation: validationTerms });
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

