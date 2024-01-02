// Get the file input, the validation message elements, and the hidden input field
var logoInput = document.getElementById('logoInput');
var validationLogo = document.getElementById('validation-joblogo');
var logoMessage = document.getElementById('joblogo-message');
var logoDiv = document.getElementById('upload_logo');
var logoPresent = document.getElementById('logoPresent');

// Add an event listener to the file input
logoInput.addEventListener('change', function () {
    if (this.files.length === 0 && logoPresent.value === '0') {
        // If the file input is empty and no logo is present
        logoMessage.textContent = 'Please add a logo';
        this.dataset.valid = '0';
        validationLogo.classList.remove('hide'); // Show the validation message
    } else {
        // If a file is selected or a logo is already present
        logoMessage.textContent = '';
        this.dataset.valid = '1';
        validationLogo.classList.add('hide'); // Hide the validation message
    }
});

var replaceLogo = document.getElementById('replace_logo');
var previewlogo = document.getElementById('previewlogo');

window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        // Function to run when the image is loaded
        var event = new Event('change');
        logoInput.dispatchEvent(event);

        var imageLoaded = function () {
            if (previewlogo.src != '' && previewlogo.src != window.location.href) {
                replaceLogo.style.display = 'flex';
                previewlogo.style.display = 'flex';
                logoDiv.style.display = 'none';
            }
        };

        // Function to run when the image fails to load
        var imageError = function () {
            replaceLogo.style.display = 'none';
            previewlogo.style.display = 'none';
            logoDiv.style.display = 'flex';
        };

        // Check if the image is already loaded
        if (previewlogo.complete) {
            if (previewlogo.naturalWidth !== 0) {
                imageLoaded();
            } else {
                imageError();
            }
        } else {
            // If not, wait for the 'load' event
            previewlogo.addEventListener('load', imageLoaded);
            // And handle the 'error' event
            previewlogo.addEventListener('error', imageError);
        }
    }
});

var coverInput = document.getElementById('coverInput');
var uploadButton = document.getElementById('uploadCover');
var removeCover = document.getElementById('remove_cover');
var previewcover = document.getElementById('previewcover');
var coverimgbox = document.getElementById('add_cover_img_box');

window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        
        // Function to run when the image is loaded
        var imageLoaded = function () {
            removeCover.style.display = 'flex';
            uploadButton.style.display = 'none';
            coverimgbox.style.height = 'auto';
        };

        // Function to run when the image fails to load
        var imageError = function () {
            removeCover.style.display = 'none';
            uploadButton.style.display = 'flex';
            coverimgbox.style.height = '200px';
        };

        // Check if the image is already loaded
        if (previewcover.complete) {
            if (previewcover.naturalWidth !== 0) {
                imageLoaded();
            } else {
                imageError();
            }
        } else {
            // If not, wait for the 'load' event
            previewcover.addEventListener('load', imageLoaded);
            // And handle the 'error' event
            previewcover.addEventListener('error', imageError);
        }
    }
});

// Get the textarea and the validation message elements
var jobDescriptionInput = document.getElementById('jobDescription');
var validationDescription = document.getElementById('validation-jobdescription');
var descriptionMessage = document.getElementById('jobdescription-message');
var descriptionDiv = document.getElementById('Description');

// Add an event listener to the textarea
jobDescriptionInput.addEventListener('input', function () {
    if (this.value.trim() === '') {
        // If the textarea is empty
        descriptionMessage.textContent = 'Please add job description';
        this.dataset.valid = '0';
        validationDescription.classList.remove('hide'); // Show the validation message
    } else if (this.value.length > 15000) {
        // If the textarea contains more than 15000 characters
        descriptionMessage.textContent = '15000 characters or less';
        this.dataset.valid = '0';
        validationDescription.classList.remove('hide'); // Show the validation message
    } else {
        // If the textarea is not empty and contains 15000 characters or less
        descriptionMessage.textContent = '';
        this.dataset.valid = '1';
        validationDescription.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobDescriptionInput.dispatchEvent(event);
    }
});

// Get the textarea and the validation message elements
var jobResponsibilitiesInput = document.getElementById('jobResponsibilities');
var validationResponsibilities = document.getElementById('validation-jobresponsibilities');
var responsibilitiesMessage = document.getElementById('jobresponsibilities-message');
var responsibilitiesDiv = document.getElementById('Responsibilities');

// Add an event listener to the textarea
jobResponsibilitiesInput.addEventListener('input', function () {
    if (this.value.trim() === '') {
        // If the textarea is empty
        responsibilitiesMessage.textContent = 'Please add job responsibilities';
        this.dataset.valid = '0';
        validationResponsibilities.classList.remove('hide'); // Show the validation message
    } else if (this.value.length > 15000) {
        // If the textarea contains more than 15000 characters
        responsibilitiesMessage.textContent = '15000 characters or less';
        this.dataset.valid = '0';
        validationResponsibilities.classList.remove('hide'); // Show the validation message
    } else {
        // If the textarea is not empty and contains 15000 characters or less
        responsibilitiesMessage.textContent = '';
        this.dataset.valid = '1';
        validationResponsibilities.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobResponsibilitiesInput.dispatchEvent(event);
    }
});

// Get the textarea and the validation message elements
var jobBenefitsInput = document.getElementById('jobBenefits');
var validationBenefits = document.getElementById('validation-jobbenefits');
var benefitsMessage = document.getElementById('benefits-message');
var benefitsDiv = document.getElementById('Benefits');

// Add an event listener to the textarea
jobBenefitsInput.addEventListener('input', function () {
    if (this.value.trim() === '') {
        // If the textarea is empty
        benefitsMessage.textContent = 'Please add job benefits';
        this.dataset.valid = '0';
        validationBenefits.classList.remove('hide'); // Show the validation message
    } else if (this.value.length > 15000) {
        // If the textarea contains more than 15000 characters
        benefitsMessage.textContent = '15000 characters or less';
        this.dataset.valid = '0';
        validationBenefits.classList.remove('hide'); // Show the validation message
    } else {
        // If the textarea is not empty and contains 15000 characters or less
        benefitsMessage.textContent = '';
        this.dataset.valid = '1';
        validationBenefits.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobBenefitsInput.dispatchEvent(event);
    }
});

// Get the submit buttons
var continueButton = document.querySelector('.cont-button');
var saveDraftButton = document.querySelector('.save-button');

// Function to validate the form
function validateForm(event) {
    var invalidInputs = [];

    if (logoInput.dataset.valid !== '1') {
        invalidInputs.push({ div: logoDiv, validation: validationLogo });
    }
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

