// Get the input field and the validation message elements
var jobTitleInput = document.getElementById('jobTitle');
var validationTitle = document.getElementById('validation-title');
var titleMessage = document.getElementById('title-message');

// Add an event listener to the input field
jobTitleInput.addEventListener('input', function () {
    if (this.value.trim() === '') {
        // If the input field is empty
        titleMessage.textContent = 'Please add job title';
        this.dataset.valid = '0';
        validationTitle.classList.remove('hide'); // Show the validation message
    } else {
        // If the input field is not empty
        titleMessage.textContent = '';
        this.dataset.valid = '1';
        validationTitle.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobTitleInput.dispatchEvent(event);
    }
});

// Get the input field and the validation message elements
var jobLocationIdInput = document.getElementById('jobLocationId');
var jobLocationInput = document.getElementById('jobLocation');
var validationLocation = document.getElementById('validation-location');
var locationMessage = document.getElementById('location-message');

// Function to validate the input
function validateJobLocation() {
    if (jobLocationIdInput.value === '0') {
        // If the value is '0'
        locationMessage.textContent = 'Please select a location';
        jobLocationIdInput.dataset.valid = '0';
        validationLocation.classList.remove('hide'); // Show the validation message
    } else {
        // If the value is not '0'
        locationMessage.textContent = '';
        jobLocationIdInput.dataset.valid = '1';
        validationLocation.classList.add('hide'); // Hide the validation message
    }
}

// Trigger the validation manually after the page loads if a jobPostID is present in the URL
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        validateJobLocation();
    }
});

// Create a MutationObserver instance
var positionobserver = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
        if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
            validateJobLocation();
        }
    });
});

// Start observing the input field for attribute changes
positionobserver.observe(jobLocationIdInput, { attributes: true });

// Get the input field and the validation message elements
var jobSpecialisationIdInput = document.getElementById('jobSpecialisationId');
var jobSpecialisationInput = document.getElementById('jobSpecialisation');
var validationSpecialisation = document.getElementById('validation-maincat');
var SpecialisationMessage = document.getElementById('maincat-message');
var jobRole = document.getElementById('JobRole');
var jobRoleInput = document.getElementById('jobRole');
var jobRoleIdInput = document.getElementById('jobRoleId');
var validationRole = document.getElementById('validation-subcat');
var RoleMessage = document.getElementById('subcat-message');

// Function to validate the input
function validateJobSpecialisation() {
    if (jobSpecialisationIdInput.value === '0') {
        // If the value is '0'
        SpecialisationMessage.textContent = 'Please select the job category';
        jobSpecialisationIdInput.dataset.valid = '0';
        validationSpecialisation.classList.remove('hide'); // Show the validation message
        jobRole.style.display = 'none';

    } else {
        // If the value is not '0'
        SpecialisationMessage.textContent = '';
        jobSpecialisationIdInput.dataset.valid = '1';
        validationSpecialisation.classList.add('hide'); // Hide the validation message
        jobRole.style.display = 'block';

    }
}

// Create a MutationObserver instance
var specialisationobserver = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
        if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
            validateJobSpecialisation();
        }
    });
});

// Start observing the input field for attribute changes
specialisationobserver.observe(jobSpecialisationIdInput, { attributes: true });

// Trigger the validation manually after the page loads if a jobPostID is present in the URL
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        validateJobSpecialisation();
    }
});

// Function to validate the input
function validateJobRole() {
    if (jobRoleIdInput.value === '0') {
        // If the value is '0'
        RoleMessage.textContent = 'Please select the job role';
        jobRoleIdInput.dataset.valid = '0';
        validationRole.classList.remove('hide'); // Show the validation message
    } else {
        // If the value is not '0'
        RoleMessage.textContent = '';
        jobRoleIdInput.dataset.valid = '1';
        validationRole.classList.add('hide'); // Hide the validation message
    }
}

// Create a MutationObserver instance
var roleobserver = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
        if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
            validateJobRole();
        }
    });
});

// Start observing the input field for attribute changes
roleobserver.observe(jobRoleIdInput, { attributes: true });

// Trigger the validation manually after the page loads if a jobPostID is present in the URL
window.addEventListener('load', function () {
    setTimeout(function () {
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('jobPostID')) {
            jobRole.style.display = 'block';
            validateJobRole();
        }
    }, 0);
});

// Get the select field and the validation message elements
var jobPositionInput = document.getElementById('jobposition');
var validationPosition = document.getElementById('validation-jobposition');
var PositionMessage = document.getElementById('position-message');

// Add an event listener to the select field
jobPositionInput.addEventListener('change', function () {
    var value = this.value;

    // Check if the select field has a valid value
    if (value === '') {
        PositionMessage.textContent = 'Please select a position';
        this.dataset.valid = '0';
        validationPosition.classList.remove('hide'); // Show the validation message
    } else {
        // If the select field has a valid value
        PositionMessage.textContent = '';
        this.dataset.valid = '1';
        validationPosition.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('change');
        jobPositionInput.dispatchEvent(event);
    }
});

// Get the radio buttons and the validation message elements
var jobTypeRadios = document.getElementsByName('jobType');
var validationJobType = document.getElementById('validation-jobtype');
var jobTypeMessage = document.getElementById('jobtype-message');

// Function to check if any radio button is selected
function isAnyRadioChecked() {
    for (var i = 0; i < jobTypeRadios.length; i++) {
        if (jobTypeRadios[i].checked) {
            return true;
        }
    }
    return false;
}

// Add an event listener to each radio button
for (var i = 0; i < jobTypeRadios.length; i++) {
    if (jobTypeRadios[i]) {
        jobTypeRadios[i].addEventListener('change', function () {
            if (isAnyRadioChecked()) {
                // If a radio button is selected
                jobTypeMessage.textContent = '';
                validationJobType.classList.add('hide'); // Hide the validation message
                validationJobType.dataset.valid = '1'; // Set dataset.valid to 1
            } else {
                // If no radio button is selected
                jobTypeMessage.textContent = 'Please select a job type';
                validationJobType.classList.remove('hide'); // Show the validation message
                validationJobType.dataset.valid = '0'; // Set dataset.valid to 0
            }
        });
    }
}

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('change');
        jobTypeRadios[0].dispatchEvent(event);
    }
});

// Get the input fields and the validation messages
var jobSalaryMinInput = document.getElementById('jobSalaryMin');
var jobSalaryMaxInput = document.getElementById('jobSalaryMax');
var minSalMessage = document.getElementById('minsal-message');
var maxSalMessage = document.getElementById('maxsal-message');
var validationMinSal = document.getElementById('validation-minsal');
var validationMaxSal = document.getElementById('validation-maxsal');

// Add an event listener to the min salary input field
jobSalaryMinInput.addEventListener('input', function () {
    var validationMinSal = document.getElementById('validation-minsal');
    if (this.value.trim() === '') {
        // If the input field is empty
        minSalMessage.textContent = 'Enter minimum pay';
        this.dataset.valid = '0';
        validationMinSal.classList.remove('hide'); // Show the validation message
    } else if (parseInt(this.value.trim()) <= 299) {
        // If the input value is less than or equal to 299
        minSalMessage.textContent = 'Minimum pay must be greater than or equal to RM 300.';
        this.dataset.valid = '0';
        validationMinSal.classList.remove('hide'); // Show the validation message
    } else if (parseInt(this.value.trim()) > parseInt(jobSalaryMaxInput.value.trim())) {
        // If the max salary is less than the min salary
        minSalMessage.textContent = 'Minimum pay must be equal to or below maximum pay.';
        this.dataset.valid = '0';
        validationMinSal.classList.remove('hide'); // Show the validation message
        validationMaxSal.classList.add('hide'); // Show the validation message
    } else {
        // If the input field is not empty and the value is greater than 299
        minSalMessage.textContent = '';
        this.dataset.valid = '1';
        jobSalaryMaxInput.dataset.valid = '1';
        validationMinSal.classList.add('hide'); // Hide the validation message
        validationMaxSal.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobSalaryMinInput.dispatchEvent(event);
    }
});

// Add an event listener to the max salary input field
jobSalaryMaxInput.addEventListener('input', function () {
    var validationMaxSal = document.getElementById('validation-maxsal');
    if (this.value.trim() === '') {
        // If the input field is empty
        maxSalMessage.textContent = 'Enter maximum pay';
        this.dataset.valid = '0';
        validationMaxSal.classList.remove('hide'); // Show the validation message
    } else if (parseInt(this.value.trim()) > 300000) {
        // If the input value is more than 300000
        maxSalMessage.textContent = 'Maximum pay must be less than or equal to RM 300,000.';
        this.dataset.valid = '0';
        validationMaxSal.classList.remove('hide'); // Show the validation message
    } else if (parseInt(this.value.trim()) < parseInt(jobSalaryMinInput.value.trim())) {
        // If the max salary is less than the min salary
        maxSalMessage.textContent = 'Maximum pay must be equal to or above minimum pay.';
        this.dataset.valid = '0';
        validationMaxSal.classList.remove('hide'); // Show the validation message
        validationMinSal.classList.add('hide'); // Show the validation message
    } else {
        // If the input field is not empty and the value is less than or equal to 300000 and greater than or equal to min salary
        maxSalMessage.textContent = '';
        this.dataset.valid = '1';
        jobSalaryMinInput.dataset.valid = '1';
        validationMaxSal.classList.add('hide'); // Hide the validation message
        validationMinSal.classList.add('hide'); // Hide the validation message
    }
});

// Trigger the 'input' event manually after the page loads
window.addEventListener('load', function () {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('jobPostID')) {
        var event = new Event('input');
        jobSalaryMaxInput.dispatchEvent(event);
    }
});

var validationTotalSal = document.getElementById('validation-totalsalary');
var totalSalMessage = document.getElementById('totalsalary-message');

// Add an event listener to both the min and max salary input fields
[jobSalaryMinInput, jobSalaryMaxInput].forEach(function (totalsalaryinput) {
    totalsalaryinput.addEventListener('input', function () {
        var validationTotalSal = document.getElementById('validation-totalsalary');
        var totalSalMessage = document.getElementById('totalsalary-message');
        var minSalary = parseInt(jobSalaryMinInput.value.trim());
        var maxSalary = parseInt(jobSalaryMaxInput.value.trim());

        if (minSalary < maxSalary / 3 * 2 || maxSalary > minSalary / 2 * 3) {
            // If the min salary is less than (max salary / 3 * 2) or the max salary is more than (min salary / 2 * 3)
            totalSalMessage.textContent = `The range is too wide. Make minimum at least RM ${Math.ceil(maxSalary / 3 * 2)} or maximum at most RM ${Math.ceil(minSalary / 2 * 3)}.`;
            validationTotalSal.classList.remove('hide'); // Show the validation message
        } else {
            // If the range is valid
            totalSalMessage.textContent = '';
            validationTotalSal.classList.add('hide'); // Hide the validation message
        }
    });
});


// Get the submit buttons
var continueButton = document.querySelector('.cont-button');
var saveDraftButton = document.querySelector('.save-button');

// Function to validate the form
function validateForm(event) {
    var invalidInputs = [];

    // Check each input field
    if (jobTitleInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobTitleInput, validation: validationTitle });
    }
    if (jobLocationIdInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobLocationInput, validation: validationLocation });
    }
    if (jobPositionInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobPositionInput, validation: validationPosition });
    }
    if (jobSpecialisationIdInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobSpecialisationInput, validation: validationSpecialisation });
    }
    if (jobRoleIdInput.dataset.valid !== '1' && window.getComputedStyle(jobRoleInput).display !== 'none') {
        invalidInputs.push({ input: jobRoleInput, validation: validationRole });
    }
    if (jobSalaryMinInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobSalaryMinInput, validation: validationMinSal });
    }
    if (jobSalaryMaxInput.dataset.valid !== '1') {
        invalidInputs.push({ input: jobSalaryMaxInput, validation: validationMaxSal });
    }
    if (validationJobType.dataset.valid !== '1') {
        invalidInputs.push({ input: jobTypeRadios[0], validation: validationJobType });
    }
    // Add new condition for salary range validation
    var minSalary = parseInt(jobSalaryMinInput.value.trim());
    var maxSalary = parseInt(jobSalaryMaxInput.value.trim());
    if (minSalary < maxSalary / 3 * 2 || maxSalary > minSalary / 2 * 3) {
        invalidInputs.push({ input: jobSalaryMinInput, validation: validationTotalSal });
        invalidInputs.push({ input: jobSalaryMaxInput, validation: validationTotalSal });
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
saveDraftButton.addEventListener('click', validateForm);