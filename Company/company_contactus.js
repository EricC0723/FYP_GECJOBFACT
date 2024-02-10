// Select the email input field, the submit button, and the validation message container
var contactEmailInput = document.getElementById('contactEmail');
var validationcontactEmail = document.getElementById('validation-contactEmail');

// Add an event listener to the email input field
contactEmailInput.addEventListener('input', function () {
    var contactEmailMessage = document.getElementById('contactEmail-message');
    if (this.value.trim() === '') {
        // If the input field is empty
        contactEmailMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationcontactEmail.classList.remove('hide'); // Show the validation message
    } else if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(this.value)) {
        // If the input is not a valid email address
        contactEmailMessage.textContent = 'Invalid email address, use format example@domain.com';
        this.dataset.valid = '0';
        validationcontactEmail.classList.remove('hide'); // Show the validation message
    } else {
        contactEmailMessage.textContent = '';
        this.dataset.valid = '1';
        validationcontactEmail.classList.add('hide'); // Hide the validation message
    }
});

// Get the input field and the validation message elements
var contactSubjectInput = document.getElementById('contactSubject');
var validationcontactSubject = document.getElementById('validation-contactSubject');

// Add an event listener to the input field
contactSubjectInput.addEventListener('input', function () {
    var contactSubjectMessage = document.getElementById('contactSubject-message');
    if (this.value.trim() === '') {
        // If the input field is empty
        contactSubjectMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationcontactSubject.classList.remove('hide'); // Show the validation message
    } else if (this.value.length > 80) {
        // If the job title is more than 80 characters
        contactSubjectMessage.textContent = 'Subject cannot be more than 80 characters';
        this.dataset.valid = '0';
        validationcontactSubject.classList.remove('hide'); // Show the validation message
    } else {
        // If the input field is not empty and the job title is not more than 80 characters
        contactSubjectMessage.textContent = '';
        this.dataset.valid = '1';
        validationcontactSubject.classList.add('hide'); // Hide the validation message
    }
});

// Get the textarea and the validation message elements
var contactMessageInput = document.getElementById('contactMessage');
var validationcontactMessage = document.getElementById('validation-contactMessage');
var MessageDiv = document.getElementById('Message');

// Add an event listener to the textarea
contactMessageInput.addEventListener('input', function () {
    var contactMessageMessage = document.getElementById('contactMessage-message');
    if (this.value.trim() === '') {
        // If the textarea is empty
        contactMessageMessage.textContent = 'Required field';
        this.dataset.valid = '0';
        validationcontactMessage.classList.remove('hide'); // Show the validation message
    } else if (this.value.length > 1000) {
        // If the textarea contains more than 15000 characters
        contactMessageMessage.textContent = '1000 characters or less';
        this.dataset.valid = '0';
        validationcontactMessage.classList.remove('hide'); // Show the validation message
    } else {
        // If the textarea is not empty and contains 15000 characters or less
        contactMessageMessage.textContent = '';
        this.dataset.valid = '1';
        validationcontactMessage.classList.add('hide'); // Hide the validation message
    }
});

// Get the submit buttons
var continueButton = document.querySelector('.create_btn');

// Function to validate the form
function validateForm(event) {
    var invalidInputs = [];

    if (contactNameInput.dataset.valid !== '1') {
        invalidInputs.push({ input: contactNameInput, validation: validationcontactName });
    }
    if (contactEmailInput.dataset.valid !== '1') {
        invalidInputs.push({ input: contactEmailInput, validation: validationcontactEmail });
    }
    if (contactSubjectInput.dataset.valid !== '1') {
        invalidInputs.push({ input: contactSubjectInput, validation: validationcontactSubject });
    }
    if (contactMessageInput.dataset.valid !== '1') {
        invalidInputs.push({ div: MessageDiv, validation: validationcontactMessage });
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
}

// Add event listeners to the submit buttons
continueButton.addEventListener('click', validateForm);
