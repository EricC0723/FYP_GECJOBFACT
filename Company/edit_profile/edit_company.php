<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];

    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>

<div>
    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-start;">
        <div style="width:600px;">
            <div><span class="landing_sentence1">Company Name</span></div>
            <div>
                <span class="landing_sentence2">
                    <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'Company Name'; ?>
                </span>
            </div>
        </div>
    </div>
    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-end;">
        <div style="width:600px;">
            <div><span class="landing_sentence1">Registration No.</span></div>
            <div>
                <span class="landing_sentence2">
                    <?php echo isset($row['RegistrationNo']) ? $row['RegistrationNo'] : 'Registration No.'; ?>
                </span>
            </div>
        </div>
    </div>
    <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-end;">
        <div style="width:600px;">
            <div><span class="landing_sentence1">Registration Date</span></div>
            <div>
                <span class="landing_sentence2">
                    <?php
                    if (isset($row['RegistrationDate'])) {
                        $timestamp = strtotime($row['RegistrationDate']);
                        echo 'Register at ' . date('d F Y', $timestamp);
                    } else {
                        echo 'Registration Date';
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div id="company_details">
        <div style="padding-top:20px;display:flex;flex-direction:row;align-items:flex-start;">
            <div style="width:600px;">
                <div><span class="landing_sentence1">Company Size</span></div>
                <div>
                    <span class="landing_sentence2">
                        <?php
                        if (isset($row['CompanySize'])) {
                            echo $row['CompanySize'] == '5000+' ? 'More than 5000 Employees' : $row['CompanySize'] . ' Employees';
                        } else {
                            echo 'CompanySize';
                        }
                        ?>
                    </span>
                </div>
            </div>
            <div><button id="edit-company-button" class="employee_sentence"
                    style="height: 28px;width:27px;display: flex;align-items: center;border:none;background:none;cursor:pointer">Edit</button>
            </div>
        </div>
    </div>
</div>
<div id="company_edit_form" style="display:none;width:627px;">
    <form method="get">
        <div class="form-group">
            <label class="question" style="padding-bottom: 8px;">Company Size</label>
            <select class="register_input" name="companySize" id="businesssize" style="height:46px;">
                <option value="" selected disabled>Select company size</option>
                <?php
                $companysizevalue = ["1 - 50", "51 - 200", "201 - 500", "501 - 1000", "1001 - 2000", "2001 - 5000", "5000+"];
                $companysizetext = ["1 - 50 Employees", "51 - 200 Employees", "201 - 500 Employees", "501 - 1000 Employees", "1001 - 2000 Employees", "2001 - 5000 Employees", "More than 5000 Employees"];
                foreach ($companysizevalue as $key => $value) {
                    echo '<option value="' . $value . '"';
                    if (isset($row['CompanySize']) && $row['CompanySize'] == $value) {
                        echo ' selected';
                    }
                    echo '>' . $companysizetext[$key] . '</option>';
                }
                ?>
            </select>
            <div style="padding-top:4px;" id="validation-businesssize" class="hide"><span style="display:flex"><span
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
                        </svg></span><span><span id="size-message" class="validation_sentence">Required
                            field</span></span></span></div>
        </div>
        <div class="form-group" style="display: block;">
            <input type="submit" value="Save" class="cont-button" name="savecompany" id="savecompany">
            <button class="save-button" id="close-company" style="margin-left:4px">Cancel</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#edit-company-button').click(function () {
            $('#company_details').hide();
            $('#company_edit_form').show();
        });
    });

    $(document).ready(function () {
        $('#close-company').click(function () {
            event.preventDefault();
            $('#company_details').show();
            $('#company_edit_form').hide();
        });
    });

    var submitcompany = document.getElementById('savecompany');

    // Get the select field and the validation message elements
    var companySizeSelect = document.getElementById('businesssize');
    var validationCompanySize = document.getElementById('validation-businesssize');
    var companySizeMessage = document.getElementById('size-message');

    function validateSizeInput() {
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
    }

    // Add an event listener to the select field
    companySizeSelect.addEventListener('change', validateSizeInput);

    // Modify the event listener for the submit button
    submitpersonal.addEventListener('click', function (event) {
        var invalidInputs = [];

        if (companySizeSelect.dataset.valid !== '1') {
            invalidInputs.push({ input: companySizeSelect, validation: validationCompanySize });
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

<script>
    $(document).ready(function () {
        validateSizeInput();
    });
</script>