<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning


?>

<div id="personal_details">
    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-start;">
        <div style="width:600px;">
            <div><span class="landing_sentence1">Contact Person</span></div>
            <div>
                <span class="landing_sentence2">
                    <?php echo isset($_SESSION['companyData']['ContactPerson']) ? $_SESSION['companyData']['ContactPerson'] : 'Contact Person'; ?>
                </span>
            </div>
        </div>
        <div><button id="edit-personal-button" class="employee_sentence"
                style="height: 28px;width:27px;display: flex;align-items: center;border:none;background:none;cursor:pointer">Edit</button>
        </div>
    </div>
    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-end;">
        <div style="width:600px;">
            <div><span class="landing_sentence1">Contact Number</span></div>
            <div>
                <span class="landing_sentence2">
                    +60
                    <?php echo isset($_SESSION['companyData']['CompanyPhone']) ? $_SESSION['companyData']['CompanyPhone'] : 'Contact Number'; ?>
                </span>
            </div>
        </div>
    </div>
</div>
<div id="personal_edit_form" style="display:none;width:627px;">
    <form method="get">
        <div class="form-group">
            <label class="landing_sentence1" style="padding-bottom: 8px;">Contact Person</label>
            <input class="register_input" type="text" name="companyPerson" id="person"
                value="<?php echo isset($_SESSION['companyData']['ContactPerson']) ? $_SESSION['companyData']['ContactPerson'] : ''; ?>">
            <div style="padding-top:4px;" id="validation-person" class="hide">
                <span style="display:flex"><span
                        style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                            focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                            style="color:#b91e1e">
                            <path
                                d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                            </path>
                            <circle cx="12" cy="17" r="1"></circle>
                            <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                            </path>
                        </svg></span><span><span id="person-message" class="validation_sentence">Required
                            field</span></span></span>
            </div>
        </div>
        <div class="form-group">
            <label class="landing_sentence1" style="padding-bottom: 8px;">Contact Number</label>
            <div style="position: relative;">
                <label class="phone_label" style="display: flex; align-items: center;">
                    <span class="question" style="padding:0;font-weight: 400;color: rgb(90, 104, 129);">+60</span>
                    <div style="padding:12px 0 12px 12px;height:24px;">
                        <div style="background:#838fa5;opacity: 0.4;width:1px;height:100%;">
                        </div>
                    </div>
                </label>
                <input class="register_input" type="text" name="companyContact" id="contact"
                    style="padding-left: 65px;width:439px;"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                    value="<?php echo isset($_SESSION['companyData']['CompanyPhone']) ? $_SESSION['companyData']['CompanyPhone'] : ''; ?>">
            </div>
            <div style="padding-top:4px;" id="validation-contact" class="hide">
                <span style="display:flex"><span
                        style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                            focusable="false" fill="currentColor" width="16" height="16" aria-hidden="true"
                            style="color:#b91e1e">
                            <path
                                d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                            </path>
                            <circle cx="12" cy="17" r="1"></circle>
                            <path d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                            </path>
                        </svg></span><span><span id="contact-message" class="validation_sentence">Required
                            field</span></span></span>
            </div>
            <div class="form-group" style="display: block;">
                <input type="submit" value="Save" class="cont-button" name="savepersonal" id="savepersonal">
                <button class="save-button" id="close-personal" style="margin-left:4px">Cancel</button>
            </div>
        </div>
    </form>
</div>

<script>

    $(document).ready(function () {
        $('#edit-personal-button').click(function () {
            $('#personal_details').hide();
            $('#personal_edit_form').show();
        });
    });

    $(document).ready(function () {
        $('#close-personal').click(function () {
            event.preventDefault();

            $('#personal_details').show();
            $('#personal_edit_form').hide();
        });
    });


    var submitpersonal = document.getElementById('savepersonal');
    // Get the input field and the validation message elements
    var personInput = document.getElementById('person');
    var validationPerson = document.getElementById('validation-person');
    var personMessage = document.getElementById('person-message');

    // Define the validation function
    function validatePersonInput() {
        if (personInput.value.trim() === '') {
            // If the input field is empty
            personMessage.textContent = 'Required field';
            personInput.dataset.valid = '0';
            validationPerson.classList.remove('hide'); // Show the validation message
        } else {
            // If the input field is not empty
            personMessage.textContent = '';
            personInput.dataset.valid = '1';
            validationPerson.classList.add('hide'); // Hide the validation message
        }
    }

    // Add an event listener to the input field
    personInput.addEventListener('input', validatePersonInput);

    // Call the validation function when the page loads
    window.onload = validatePersonInput;

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

            contactMessage.textContent = '';
            contactInput.dataset.valid = '1';
            validationContact.classList.add('hide'); // Hide the validation message

        }
    });

    // Modify the event listener for the submit button
    submitpersonal.addEventListener('click', function (event) {
        var invalidInputs = [];

        if (personInput.dataset.valid !== '1') {
            invalidInputs.push({ input: personInput, validation: validationPerson });
        }
        if (contactInput.dataset.valid !== '1') {
            invalidInputs.push({ input: contactInput, validation: validationContact });
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
</script>

<?php

$CompanyID = null;
if (isset($_SESSION['companyData']['CompanyID'])) {
    $CompanyID = $_SESSION['companyData']['CompanyID'];
}

?>