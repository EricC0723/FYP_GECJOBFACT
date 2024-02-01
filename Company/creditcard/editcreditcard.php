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
<?php
// Get the credit card ID from the query parameter
$id = $_GET['id'];

// Fetch the credit card details from the database
$query = "SELECT * FROM credit_card WHERE CreditCardID = $id AND CreditCard_isDeleted = 0";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
?>

<div id="editcreditcard">
    <div style="width: 50px;position: relative;top: 25px;left: 25px;"><button id="close-editcreditcard"
            class="employee_sentence"
            style="height: 28px;width:27px;display: flex;align-items: center;border:none;background:none;cursor:pointer">Back</button>
    </div>
    <form action="" method="GET">
        <div class="wrapper" id="app">
            <div class="card-form">
                <div class="card-list">
                    <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
                        <div class="card-item__side -front">
                            <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }"
                                v-bind:style="focusElementStyle" ref="focusElement"></div>
                            <div class="card-item__cover">
                                <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'"
                                    class="card-item__bg">
                            </div>

                            <div class="card-item__wrapper">
                                <div class="card-item__top">
                                    <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png"
                                        class="card-item__chip">
                                    <div class="card-item__type">
                                        <transition name="slide-fade-up">
                                            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'"
                                                v-if="getCardType" v-bind:key="getCardType" alt=""
                                                class="card-item__typeImg">
                                        </transition>
                                    </div>
                                </div>
                                <label for="cardNumber" class="card-item__number" ref="cardNumber"
                                    style="box-sizing: border-box;">
                                    <template v-if="getCardType === 'amex'">
                                        <span v-for="(n, $index) in amexCardMask" :key="$index">
                                            <transition name="slide-fade-up">
                                                <div class="card-item__numberItem"
                                                    v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''">
                                                    *</div>
                                                <div class="card-item__numberItem"
                                                    :class="{ '-active' : n.trim() === '' }" :key="$index"
                                                    v-else-if="cardNumber.length > $index">
                                                    {{cardNumber[$index]}}
                                                </div>
                                                <div class="card-item__numberItem"
                                                    :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">
                                                    {{n}}</div>
                                            </transition>
                                        </span>
                                    </template>

                                    <template v-else>
                                        <span v-for="(n, $index) in otherCardMask" :key="$index">
                                            <transition name="slide-fade-up">
                                                <div class="card-item__numberItem"
                                                    v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''">
                                                    *</div>
                                                <div class="card-item__numberItem"
                                                    :class="{ '-active' : n.trim() === '' }" :key="$index"
                                                    v-else-if="cardNumber.length > $index">
                                                    {{cardNumber[$index]}}
                                                </div>
                                                <div class="card-item__numberItem"
                                                    :class="{ '-active' : n.trim() === '' }" v-else :key="$index + 1">
                                                    {{n}}</div>
                                            </transition>
                                        </span>
                                    </template>
                                </label>
                                <div class="card-item__content">
                                    <label for="cardName" class="card-item__info" ref="cardName"
                                        style="box-sizing: border-box;">
                                        <div class="card-item__holder">Card Holder</div>
                                        <transition name="slide-fade-up">
                                            <div class="card-item__name" v-if="cardName.length" key="1">
                                                <transition-group name="slide-fade-right">
                                                    <span class="card-item__nameItem"
                                                        v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')"
                                                        v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                                                </transition-group>
                                            </div>
                                            <div class="card-item__name" v-else key="2">Full Name
                                            </div>
                                        </transition>
                                    </label>
                                    <div class="card-item__date" ref="cardDate" style="box-sizing: border-box;">
                                        <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                                        <label for="cardMonth" class="card-item__dateItem">
                                            <transition name="slide-fade-up">
                                                <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                                                <span v-else key="2">MM</span>
                                            </transition>
                                        </label>
                                        /
                                        <label for="cardYear" class="card-item__dateItem">
                                            <transition name="slide-fade-up">
                                                <span v-if="cardYear"
                                                    v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                                                <span v-else key="2">YY</span>
                                            </transition>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-item__side -back">
                            <div class="card-item__cover">
                                <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'"
                                    class="card-item__bg">
                            </div>
                            <div class="card-item__band"></div>
                            <div class="card-item__cvv">
                                <div class="card-item__cvvTitle">CVV</div>
                                <div class="card-item__cvvBand">
                                    <span v-for="(n, $index) in cardCvv" :key="$index">
                                        *
                                    </span>

                                </div>
                                <div class="card-item__type">
                                    <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'"
                                        v-if="getCardType" class="card-item__typeImg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-form__inner">
                    <div class="card-input">
                        <label for="cardNumber" class="card-input__label">Card Number</label>
                        <input type="text" id="cardNumberInput" class="card-input__input"
                            v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput"
                            v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off"
                            style="box-sizing: border-box;" name="cardNumberInput">
                        <input type="hidden" id="hiddenCardNumber"
                            value="<?php echo htmlspecialchars($row['CreditCard_Number']); ?>">
                        <div style="padding-top:4px;" id="validation-cardNumber" class="hide"><span
                                style="display:flex"><span
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
                                    </svg></span><span><span id="cardNumber-message"
                                        class="validation_sentence">Required
                                        field</span></span></span>
                        </div>
                    </div>
                    <div class="card-input">
                        <label for="cardName" class="card-input__label">Card Holders</label>
                        <input type="text" id="cardNameInput" class="card-input__input" v-model="cardName"
                            v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off"
                            style="box-sizing: border-box;" name="cardNameInput">
                        <input type="hidden" id="hiddenCardHolder"
                            value="<?php echo htmlspecialchars($row['CreditCard_Holder']); ?>">
                        <div style="padding-top:4px;" id="validation-cardName" class="hide"><span
                                style="display:flex"><span
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
                                    </svg></span><span><span id="cardName-message" class="validation_sentence">Required
                                        field</span></span></span>
                        </div>
                    </div>
                    <div class="card-form__row">
                        <div class="card-form__col">
                            <div class="card-form__group">
                                <label for="cardMonth" class="card-input__label">Expiration
                                    Date</label>
                                <div>
                                    <input type="hidden" id="hiddenCardMonth"
                                        value="<?php echo htmlspecialchars($row['CreditCard_ExpMonth']); ?>">
                                    <select class="card-input__input -select" id="cardMonthInput" name="cardMonthInput"
                                        v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput"
                                        data-ref="cardDate" style="width:150px;">
                                        <option value="" disabled selected>Month</option>
                                        <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12"
                                            v-bind:disabled="n < minCardMonth" v-bind:key="n">
                                            {{n < 10 ? '0' + n : n}} </option>
                                    </select>
                                    <div style="padding-top:4px;" id="validation-cardMonth" class="hide">
                                        <span style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="cardMonth-message"
                                                    class="validation_sentence">Required
                                                    field</span></span></span>
                                    </div>
                                </div>
                                <div style="width:150px;">
                                    <input type="hidden" id="hiddenCardYear"
                                        value="<?php echo htmlspecialchars($row['CreditCard_ExpYear']); ?>">
                                    <select class="card-input__input -select" id="cardYearInput" name="cardYearInput"
                                        v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput"
                                        data-ref="cardDate">
                                        <option value="" disabled selected>Year</option>
                                        <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12"
                                            v-bind:key="n">
                                            {{$index + minCardYear}}
                                        </option>
                                    </select>
                                    <div style="padding-top:4px;" id="validation-cardYear" class="hide">
                                        <span style="display:flex"><span
                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    xml:space="preserve" focusable="false" fill="currentColor"
                                                    width="16" height="16" aria-hidden="true" style="color:#b91e1e">
                                                    <path
                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                    </path>
                                                    <circle cx="12" cy="17" r="1"></circle>
                                                    <path
                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                    </path>
                                                </svg></span><span><span id="cardYear-message"
                                                    class="validation_sentence">Required
                                                    field</span></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-form__col -cvv">
                            <div class="card-input">
                                <label for="cardCvv" class="card-input__label">CVV</label>
                                <input type="hidden" id="hiddenCardCvv"
                                    value="<?php echo htmlspecialchars($row['CreditCard_CVV']); ?>">
                                <input type="text" class="card-input__input" id="cardCvvInput" v-mask="'###'"
                                    maxlength="3" v-model="cardCvv" v-on:focus="flipCard(true)"
                                    v-on:blur="flipCard(false)" autocomplete="off" style="box-sizing: border-box;"
                                    name="cardCvvInput">
                                <div style="padding-top:4px;" id="validation-cardCvv" class="hide">
                                    <span style="display:flex"><span
                                            style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                xml:space="preserve" focusable="false" fill="currentColor" width="16"
                                                height="16" aria-hidden="true" style="color:#b91e1e">
                                                <path
                                                    d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                </path>
                                                <circle cx="12" cy="17" r="1"></circle>
                                                <path
                                                    d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                </path>
                                            </svg></span><span><span id="cardCvv-message"
                                                class="validation_sentence">Required
                                                field</span></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="cardType" name="cardTypeInput" v-model="cardType"
                        value="<?php echo htmlspecialchars($row['CreditCard_Type']); ?>">
                    <div style="padding-top:10px;">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                        <input type="submit" value="Save Card" class="cont-button" name="savebtn" style="width:100%;">
                    </div>


                </div>
            </div>


        </div>
        <!-- partial -->

    </form>
</div>

<script src="post-job.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<script src="editcreditcard.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script>
    var closeeditbutton = document.getElementById('close-editcreditcard');

    // Add click event listener to the edit button
    closeeditbutton.addEventListener('click', function () {
        // Get the credit card ID from the data attribute
        var id = this.getAttribute('data-id'); // make sure your button has a 'data-id' attribute

        // Load the editcreditcard.php file into the editcreditcard div
        $('#creditcard').load('creditcard/creditcardlist.php');
    });

    // Get the input field, card type and the validation message elements
    var cardNumberInput = document.getElementById('cardNumberInput');
    var cardTypeInput = document.getElementById('cardType');
    var validationcardNumber = document.getElementById('validation-cardNumber');

    // Add an event listener to the input field
    cardNumberInput.addEventListener('input', function () {
        var cardNumberMessage = document.getElementById('cardNumber-message');
        var cardType = document.getElementById('cardType').value; // Fetch the cardType
        var companyId = "<?php echo $_SESSION['companyID']; ?>";
        var originalCardNumber = "<?php echo $row['CreditCard_Number']; ?>";

        if (this.value.trim() === '') {
            // If the input field is empty
            cardNumberMessage.textContent = 'Required field';
            this.dataset.valid = '0';
            validationcardNumber.classList.remove('hide'); // Show the validation message
        } else if ((cardType === 'amex' && this.value.trim().length !== 17) ||
            (cardType !== 'amex' && this.value.trim().length !== 19)) {
            // If the card type is 'amex' and the input field does not contain 17 characters
            // or if the card type is not 'amex' and the input field does not contain 19 characters
            cardNumberMessage.textContent = 'Invalid card number';
            this.dataset.valid = '0';
            validationcardNumber.classList.remove('hide'); // Show the validation message
        } else if (!new RegExp("^(4|34|37|5[1-5]|6011|9792)").test(this.value.trim())) {
            // If the card number does not start with the specified patterns
            cardNumberMessage.textContent = 'Invalid card number';
            this.dataset.valid = '0';
            validationcardNumber.classList.remove('hide'); // Show the validation message
        } else if (this.value.trim() !== originalCardNumber) {
            // If the input field is not empty and contains the correct number of characters
            // Check if the card number exists in the database for the same company
            $.ajax({
                url: 'check_data.php',
                type: 'post',
                data: {
                    cardNumber: this.value.trim(),
                    companyId: companyId
                },
                success: function (response) {
                    if (response == 1) {
                        cardNumberMessage.textContent = 'Card number already exists for this company';
                        cardNumberInput.dataset.valid = '0';
                        validationcardNumber.classList.remove('hide'); // Show the validation message
                    } else {
                        cardNumberMessage.textContent = '';
                        cardNumberInput.dataset.valid = '1';
                        validationcardNumber.classList.add('hide'); // Hide the validation message
                    }
                }
            });
        } else {
            // If the input field is not empty and contains the correct number of characters
            cardNumberMessage.textContent = '';
            this.dataset.valid = '1';
            validationcardNumber.classList.add('hide'); // Hide the validation message
        }
    });

    cardNumberInput.dispatchEvent(new Event('input'));

    // Get the input field and the validation message elements
    var cardNameInput = document.getElementById('cardNameInput');
    var validationcardName = document.getElementById('validation-cardName');

    // Add an event listener to the input field
    cardNameInput.addEventListener('input', function () {
        var cardNameMessage = document.getElementById('cardName-message');
        if (this.value.trim() === '') {
            // If the input field is empty
            cardNameMessage.textContent = 'Please enter the card holder';
            this.dataset.valid = '0';
            validationcardName.classList.remove('hide'); // Show the validation message
        } else {
            // If the input field is not empty and contains 16 characters
            cardNameMessage.textContent = '';
            this.dataset.valid = '1';
            validationcardName.classList.add('hide'); // Hide the validation message
        }
    });

    cardNameInput.dispatchEvent(new Event('input'));

    // Get the select field and the validation message elements
    var cardMonthSelect = document.getElementById('cardMonthInput');
    var validationcardMonth = document.getElementById('validation-cardMonth');

    // Add an event listener to the select field
    cardMonthSelect.addEventListener('change', function () {
        var value = this.value;
        var cardMonthMessage = document.getElementById('cardMonth-message');
        // Check if the select field has a valid value
        if (value === '') {
            cardMonthMessage.textContent = 'Required field';
            this.dataset.valid = '0';
            validationcardMonth.classList.remove('hide'); // Show the validation message
        } else {
            // If the select field has a valid value
            cardMonthMessage.textContent = '';
            this.dataset.valid = '1';
            validationcardMonth.classList.add('hide'); // Hide the validation message
        }
    });

    cardMonthSelect.dispatchEvent(new Event('change'));

    // Get the select field and the validation message elements
    var cardYearSelect = document.getElementById('cardYearInput');
    var validationcardYear = document.getElementById('validation-cardYear');

    // Add an event listener to the select field
    cardYearSelect.addEventListener('change', function () {
        var value = this.value;
        var cardYearMessage = document.getElementById('cardYear-message');
        // Check if the select field has a valid value
        if (value === '') {
            cardYearMessage.textContent = 'Required field';
            this.dataset.valid = '0';
            validationcardYear.classList.remove('hide'); // Show the validation message
        } else {
            // If the select field has a valid value
            cardYearMessage.textContent = '';
            this.dataset.valid = '1';
            validationcardYear.classList.add('hide'); // Hide the validation message
        }
    });

    cardYearSelect.dispatchEvent(new Event('change'));

    // Get the input field and the validation message elements
    var cardCvvInput = document.getElementById('cardCvvInput');
    var validationcardCvv = document.getElementById('validation-cardCvv');

    // Add an event listener to the input field
    cardCvvInput.addEventListener('input', function () {
        var cardCvvMessage = document.getElementById('cardCvv-message');
        if (this.value.trim() === '') {
            // If the input field is empty
            cardCvvMessage.textContent = 'Required field';
            this.dataset.valid = '0';
            validationcardCvv.classList.remove('hide'); // Show the validation message
        } else if (this.value.trim().length !== 3) {
            // If the input field does not contain 16 characters
            cardCvvMessage.textContent = 'Invalid card cvv';
            this.dataset.valid = '0';
            validationcardCvv.classList.remove('hide'); // Show the validation message
        } else {
            // If the input field is not empty and contains 16 characters
            cardCvvMessage.textContent = '';
            this.dataset.valid = '1';
            validationcardCvv.classList.add('hide'); // Hide the validation message
        }
    });

    cardCvvInput.dispatchEvent(new Event('input'));

    // Get the submit buttons
    var continueButton = document.querySelector('.cont-button');

    // Function to validate the form
    function validateForm(event) {
        var invalidInputs = [];

        // Check each input field
        if (cardNumberInput.dataset.valid !== '1') {
            invalidInputs.push({ input: cardNumberInput, validation: validationcardNumber });
        }
        if (cardNameInput.dataset.valid !== '1') {
            invalidInputs.push({ input: cardNameInput, validation: validationcardName });
        }
        if (cardMonthSelect.dataset.valid !== '1') {
            invalidInputs.push({ input: cardMonthSelect, validation: validationcardMonth });
        }
        if (cardYearSelect.dataset.valid !== '1') {
            invalidInputs.push({ input: cardYearSelect, validation: validationcardYear });
        }
        if (cardCvvInput.dataset.valid !== '1') {
            invalidInputs.push({ input: cardCvvInput, validation: validationcardCvv });
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


</script>

<?php

?>