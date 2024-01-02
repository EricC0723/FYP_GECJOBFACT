var jobDescriptionInput = document.getElementById('jobDescription');
var validationDescription = document.getElementById('validation-jobdescription');
var DescriptionMessage = document.getElementById('jobdescription-message');
var descriptionDiv = document.getElementById('Description');

function validateJobDescription(data) {
    if (data.trim() === '') {
        DescriptionMessage.textContent = 'Please add job description';
        jobDescriptionInput.dataset.valid = '0';
        validationDescription.classList.remove('hide');
    } else if (data.length > 15000) {
        DescriptionMessage.textContent = '15000 characters or less';
        jobDescriptionInput.dataset.valid = '0';
        validationDescription.classList.remove('hide');
    } else {
        jobDescriptionInput.dataset.valid = '1';
        validationDescription.classList.add('hide');
    }
}

var jobResponsibilitiesInput = document.getElementById('jobResponsibilities');
var validationResponsibilities = document.getElementById('validation-jobresponsibilities');
var ResponsibilitiesMessage = document.getElementById('jobresponsibilities-message');
var responsibilitiesDiv = document.getElementById('Responsibilities');

function validateJobResponsibilities(data) {
    if (data.trim() === '') {
        ResponsibilitiesMessage.textContent = 'Please add job responsibilities';
        jobResponsibilitiesInput.dataset.valid = '0';
        validationResponsibilities.classList.remove('hide');
    } else if (data.length > 15000) {
        ResponsibilitiesMessage.textContent = '15000 characters or less';
        jobResponsibilitiesInput.dataset.valid = '0';
        validationResponsibilities.classList.remove('hide');
    } else {
        jobResponsibilitiesInput.dataset.valid = '1';
        validationResponsibilities.classList.add('hide');
    }
}

var jobBenefitsInput = document.getElementById('jobBenefits');
var validationBenefits = document.getElementById('validation-jobbenefits');
var BenefitsMessage = document.getElementById('benefits-message');
var benefitsDiv = document.getElementById('Benefits');

function validateJobBenefits(data) {
    if (data.trim() === '') {
        BenefitsMessage.textContent = 'Please add job benefits';
        jobBenefitsInput.dataset.valid = '0';
        validationBenefits.classList.remove('hide');
    } else if (data.length > 15000) {
        BenefitsMessage.textContent = '15000 characters or less';
        jobBenefitsInput.dataset.valid = '0';
        validationBenefits.classList.remove('hide');
    } else {
        jobBenefitsInput.dataset.valid = '1';
        validationBenefits.classList.add('hide');
    }
}

// Get the submit buttons
var continueButton = document.querySelector('.cont-button');
var saveDraftButton = document.querySelector('.save-button');

// Function to validate the form
function validateForm(event) {
    var invalidInputs = [];

    if (jobDescriptionInput.dataset.valid !== '1') {
        invalidInputs.push({ div: descriptionDiv, validation: validationDescription });
    }
    if (jobResponsibilitiesInput.dataset.valid !== '1') {
        invalidInputs.push({ div: responsibilitiesDiv, validation: validationResponsibilities });
    }
    if (jobBenefitsInput.dataset.valid !== '1') {
        invalidInputs.push({ div: benefitsDiv, validation: validationBenefits });
    }

    if (invalidInputs.length > 0) {
        // If there are invalid inputs, prevent the form submission
        event.preventDefault();

        // Scroll to the first invalid div
        $('html, body').animate({
            scrollTop: $(invalidInputs[0].div).offset().top
        }, 1000);

        // Show validation messages for all invalid inputs
        invalidInputs.forEach(function (invalidInput) {
            invalidInput.validation.classList.remove('hide');
        });
    }
    // If all inputs are valid, the form will submit normally
}

// Add event listeners to the submit buttons
continueButton.addEventListener('click', validateForm);
saveDraftButton.addEventListener('click', validateForm);