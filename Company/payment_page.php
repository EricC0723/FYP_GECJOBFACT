<!DOCTYPE html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
include("C:/xampp/htdocs/FYP/dataconnection.php");
session_start(); // Start the session at the beginning

if (isset($_SESSION['job_post_ID'])) {
    $job_post_ID = $_SESSION['job_post_ID'];
    $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$job_post_ID' ");
    $row = mysqli_fetch_assoc($result);
    echo "<script>
        var jobPostData = " . json_encode($row) . ";
        </script>";
}

$CompanyID = null;
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";

    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="company_creditcard.css">
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="payment_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>

<body class="postjob_body">
    <header class="postjob_header">
        <div class="container">
            <div class="logo">
                <a href="company_landing.php" class="postjob_link"><img src="logo.png" alt="Logo"></a>
            </div>
            <div class="logo-nav">
                <nav style="display:flex">
                    <span class="header-link"><a href="company_landing.php" class="company_nav_active">Home</a></span>
                    <span class="header-link"><a href="job-listing.php">Jobs</a></span>
                    <span class="header-link"><a href="#products">Products</a></span>
                </nav>
            </div>
            <div style="flex:1 1 auto;"></div>

            <div style="padding:0 20px">
                <div class="flex-container">
                    <div class="dropdown">
                        <div style="display: flex; align-items: center;">
                            <a href="#profile" onclick="toggleDropdown(event)" class="dropdown-title">
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?> <svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve"
                                    focusable="false" fill="currentColor" width="16" height="16"
                                    class="uatjxz0 bpnsn50 t0qjk721 chw1r94y ygcmz4c _140w0y32" aria-hidden="true"
                                    id="dropdown-icon"
                                    style="width:24px;height:24px;padding-left:10px;transform-origin:65% 50%;transition: transform .3s ease;">
                                    <path
                                        d="M20.7 7.3c-.4-.4-1-.4-1.4 0L12 14.6 4.7 7.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l8 8c.2.2.5.3.7.3s.5-.1.7-.3l8-8c.4-.4.4-1 0-1.4z">
                                    </path>
                                </svg>
                            </a>

                        </div>
                        <div class="dropdown-content" id="dropdownContent">
                            <span class="companyName">
                                <?php echo isset($row['CompanyName']) ? $row['CompanyName'] : 'User Profile'; ?>
                            </span>
                            <div style="padding-top:10px;">
                                <span class="contactPerson">
                                    <?php echo isset($row['ContactPerson']) ? $row['ContactPerson'] : 'Contact Person'; ?>
                                </span>
                            </div>
                            <div style="padding-top: 10px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="company_profile.php" class="dropdown-link">Accounts
                                    details</a></div>
                            <div style="padding-top: 12px;"><a href="#team" class="dropdown-link">Your team</a></div>
                            <div style="padding-top: 12px;"><a href="company_creditcard.php" class="dropdown-link">Card
                                    Payment</a></div>

                            <div style="padding-top: 12px;"><a href="#logos" class="dropdown-link">Logos & Brands</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="#adprice" class="dropdown-link">Ad price lookup</a>
                            </div>
                            <div style="padding-top: 20px;border-bottom: 1px solid #d2d7df;"><span></span></div>
                            <div style="padding-top: 12px;"><a href="#contact" class="dropdown-link">Contact us</a>
                            </div>
                            <div style="padding-top: 12px;"><a href="company_signout.php" class="dropdown-link">Sign
                                    out</a></div>
                        </div>
                    </div>
                    <div class="add_button">
                        <a href="post-job-classify.php" class="create_job_link">Create a job ad</a>
                    </div>
                </div>
            </div>
    </header>

    <div class="form-container" style="margin-top:10px;padding-top:32px">

        <?php
        if (isset($_GET['jobPostID'])) {
            $postid = $_GET["jobPostID"];
            $result = mysqli_query($connect, "SELECT * FROM job_post WHERE Job_Post_ID = '$postid' ");
            $row = mysqli_fetch_assoc($result);
        }
        ?>

        <form method="POST" style="display:flex;flex-direction:column" id="paymentForm">
            <div style="width: 110px;">
                <a class="employee_sentence"
                    style="height: 28px;display: flex;align-items: center;border:none;background:none;cursor:pointer"><svg
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" xml:space="preserve" focusable="false"
                        fill="currentColor" width="16" height="16" class="backsvg" aria-hidden="true">
                        <path
                            d="M20.7 7.3c-.4-.4-1-.4-1.4 0L12 14.6 4.7 7.3c-.4-.4-1-.4-1.4 0s-.4 1 0 1.4l8 8c.2.2.5.3.7.3s.5-.1.7-.3l8-8c.4-.4.4-1 0-1.4z">
                        </path>
                    </svg> Back</a>
            </div>

            <div style="padding-top:24px;">
                <h2 class="landing_sentence3">Pay & post</h2>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <h3 class="landing_sentence1">Post Duration</h3>
                <div class="form-group">
                    <label class="question" style="padding-bottom: 8px;">How many months would you like your job post to
                        be active?</label>
                    <select class="input-box" name="postDuration" id="postDuration" style="height:46px;">
                        <option value="" selected disabled>Select a duration for your job post.</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo $i; ?>">
                                <?php echo $i; ?> month(s)
                            </option>
                        <?php endfor; ?>
                    </select>
                    <div style="padding-top:4px;" id="validation-postDuration" class="hide"><span
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
                                </svg></span><span><span id="postDuration-message" class="validation_sentence">Please
                                    select the duration of your job post</span></span></span></div>
                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <h3 class="landing_sentence1">Order summary</h3>
                <div style="padding-top:24px;">
                    <div style="display:flex;flex-direction:row;justify-content:space-between">
                        <div>
                            <h4 class="landing_sentence1" style="font-size:18px;">Items</h4>
                        </div>
                        <div>
                            <h4 class="landing_sentence1" style="font-size:18px;">Cost</h4>
                        </div>
                    </div>
                </div>
                <div style="padding-top:10px"><span style="position:relative;display:block;"><span
                            style="position:absolute;height:1px;background:#2e3849;width:100%;"></span></span></div>
                <div style="padding-top:24px">
                    <div style="display:flex;flex-direction:row;justify-content:space-between;">
                        <div style=""><span class="landing_sentence2">Basic ad (one month)</span></div>
                        <div style=""><span class="landing_sentence2">RM 98.00</span></div>
                    </div>
                </div>
                <div style="padding-top:24px">
                    <div style="margin: 0 calc(20px * -1);padding:20px;background:#eaecf1;">
                        <div style="display:flex;flex-direction:row;justify-content:space-between;">
                            <div style=""><span class="landing_sentence2" style="font-weight:600;">Subtotal</span></div>
                            <div style=""><span class="landing_sentence2" id="subtotal_price"
                                    style="font-weight:600;">RM 0.00</span></div>
                        </div>
                        <div style="display:flex;flex-direction:row;justify-content:space-between;padding-top:20px;">
                            <div style=""><span class="landing_sentence2" style="font-weight:600;">SST (6%)</span></div>
                            <div style=""><span class="landing_sentence2" id="sst_price" style="font-weight:600;">RM
                                    0.00</span></div>
                        </div>
                    </div>
                </div>
                <div style="padding-top:24px">
                    <div style="display:flex;flex-direction:row;justify-content:space-between;">
                        <div style=""><span class="landing_sentence1">Total </span><span class="landing_sentence2">incl.
                                SST</span></div>
                        <div style=""><span class="landing_sentence1" id="total_price" style="font-weight:600;">RM
                                0.00</span></div>
                        <input type="hidden" id="totalPrice" name="totalPrice">
                    </div>
                </div>
            </div>

            <div class="form-style" style="margin-top:22px;">
                <h3 class="landing_sentence1">Payment method</h3>
                <div style="padding-top:24px;">
                    <div style="display:flex;flex-direction:row;">
                        <div style="padding-top:2px;">
                            <input type="radio" id="existcardRadio" checked name="payment_type" value="existcardRadio"
                                onchange="showHideCards()">

                        </div>
                        <div style="padding-left:10px;width:100%;">
                            <span class="landing_sentence2">Pay by card</span>
                            <div style="padding-top:12px;" id="existcard">
                                <div style="padding:24px;border:0.5px solid #d2d7df;border-radius:4px">
                                    <div class="form-group" style="padding-top:0px;">
                                        <label for="cardSelect" class="landing_sentence2"
                                            style="padding-bottom:10px;">Select a card:</label>
                                        <div
                                            style="height: 500px; overflow-y: auto;border: 0.5px solid #d2d7df;border-radius: 4px;padding: 10px;">

                                            <?php

                                            if (isset($_SESSION['companyID'])) {
                                                $sql = "SELECT * FROM credit_card WHERE CompanyID = $CompanyID AND CreditCard_isDeleted = 0";
                                                $result = mysqli_query($connect, $sql);
                                                while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <div class="card">
                                                        <input type="radio" name="cardSelect"
                                                            value="<?php echo $row['CreditCardID']; ?>"
                                                            id="cardSelect<?php echo $row['CreditCardID']; ?>">
                                                        <div style="display:flex;flex-direction:column;">
                                                            <div
                                                                style="display:flex;flex-direction:row;justify-content:space-between;">
                                                                <span class="landing_sentence1" style="font-weight:400;">
                                                                    <?php echo $row['CreditCard_Number']; ?>
                                                                </span>
                                                                <?php
                                                                if ($row['CreditCard_Type'] == 'amex') {
                                                                    $imgSrc = "/FYP/Company/creditcardimg/amex.png";
                                                                } elseif ($row['CreditCard_Type'] == 'discover') {
                                                                    $imgSrc = "/FYP/Company/creditcardimg/discover.png";
                                                                } elseif ($row['CreditCard_Type'] == 'mastercard') {
                                                                    $imgSrc = "/FYP/Company/creditcardimg/mastercard.png";
                                                                } elseif ($row['CreditCard_Type'] == 'troy') {
                                                                    $imgSrc = "/FYP/Company/creditcardimg/troy.png";
                                                                } elseif ($row['CreditCard_Type'] == 'visa') {
                                                                    $imgSrc = "/FYP/Company/creditcardimg/visa.png";
                                                                }
                                                                ?>
                                                                <img src="<?php echo $imgSrc; ?>" alt="Card logo"
                                                                    style="height: 40px;">
                                                            </div>
                                                            <div
                                                                style="display:flex;flex-direction:row;padding-top:10px;justify-content:space-between;">
                                                                <span class="landing_sentence2">
                                                                    <?php echo $row['CreditCard_Holder']; ?>
                                                                </span>
                                                                <span class="landing_sentence2">
                                                                    <?php echo ($row['CreditCard_ExpMonth']) . ' / ' . substr(($row['CreditCard_ExpYear']), -2); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile;
                                            }
                                            ?>
                                        </div>
                                        <div style="padding-top:4px;width:299px;" id="validation-cardSelect"
                                            class="hide">
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
                                                    </svg></span><span><span id="cardSelect-message"
                                                        class="validation_sentence">Please select a
                                                        card</span></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="padding-top:24px;">
                    <div style="display:flex;flex-direction:row;">
                        <div style="padding-top:2px;">
                            <input type="radio" id="newcardRadio" name="payment_type" value="newcardRadio"
                                onchange="showHideCards()">
                        </div>
                        <div style="padding-left:10px;width:100%;">
                            <span class="landing_sentence2">Pay by new card</span>
                            <div style="padding-top:12px;" id="newcard" style="display:none;">
                                <div style="padding:24px;border:0.5px solid #d2d7df;border-radius:4px">
                                    <div class="form-group" style="padding-top:0px;">
                                        <label for="cardSelect" class="landing_sentence2"
                                            style="padding-bottom:10px;">Add new card:</label>
                                        <div id="addcreditcard">
                                            <div class="wrapper" id="app" style="padding:15px;">
                                                <div class="card-form">
                                                    <div class="card-list">
                                                        <div class="card-item"
                                                            v-bind:class="{ '-active' : isCardFlipped }">
                                                            <div class="card-item__side -front">
                                                                <div class="card-item__focus"
                                                                    v-bind:class="{'-active' : focusElementStyle }"
                                                                    v-bind:style="focusElementStyle" ref="focusElement">
                                                                </div>
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
                                                                                    v-if="getCardType"
                                                                                    v-bind:key="getCardType" alt=""
                                                                                    class="card-item__typeImg">
                                                                            </transition>
                                                                        </div>
                                                                    </div>
                                                                    <label for="cardNumber" class="card-item__number"
                                                                        ref="cardNumber"
                                                                        style="box-sizing: border-box;margin-bottom:30px">
                                                                        <template v-if="getCardType === 'amex'">
                                                                            <span v-for="(n, $index) in amexCardMask"
                                                                                :key="$index">
                                                                                <transition name="slide-fade-up">
                                                                                    <div class="card-item__numberItem"
                                                                                        v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''">
                                                                                        *</div>
                                                                                    <div class="card-item__numberItem"
                                                                                        :class="{ '-active' : n.trim() === '' }"
                                                                                        :key="$index"
                                                                                        v-else-if="cardNumber.length > $index">
                                                                                        {{cardNumber[$index]}}
                                                                                    </div>
                                                                                    <div class="card-item__numberItem"
                                                                                        :class="{ '-active' : n.trim() === '' }"
                                                                                        v-else :key="$index + 1">
                                                                                        {{n}}</div>
                                                                                </transition>
                                                                            </span>
                                                                        </template>

                                                                        <template v-else>
                                                                            <span v-for="(n, $index) in otherCardMask"
                                                                                :key="$index">
                                                                                <transition name="slide-fade-up">
                                                                                    <div class="card-item__numberItem"
                                                                                        v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''">
                                                                                        *</div>
                                                                                    <div class="card-item__numberItem"
                                                                                        :class="{ '-active' : n.trim() === '' }"
                                                                                        :key="$index"
                                                                                        v-else-if="cardNumber.length > $index">
                                                                                        {{cardNumber[$index]}}
                                                                                    </div>
                                                                                    <div class="card-item__numberItem"
                                                                                        :class="{ '-active' : n.trim() === '' }"
                                                                                        v-else :key="$index + 1">
                                                                                        {{n}}</div>
                                                                                </transition>
                                                                            </span>
                                                                        </template>
                                                                    </label>
                                                                    <div class="card-item__content">
                                                                        <label for="cardName" class="card-item__info"
                                                                            ref="cardName"
                                                                            style="box-sizing: border-box;">
                                                                            <div class="card-item__holder">Card
                                                                                Holder</div>
                                                                            <transition name="slide-fade-up">
                                                                                <div class="card-item__name"
                                                                                    v-if="cardName.length" key="1">
                                                                                    <transition-group
                                                                                        name="slide-fade-right">
                                                                                        <span
                                                                                            class="card-item__nameItem"
                                                                                            v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')"
                                                                                            v-if="$index === $index"
                                                                                            v-bind:key="$index + 1">{{n}}</span>
                                                                                    </transition-group>
                                                                                </div>
                                                                                <div class="card-item__name" v-else
                                                                                    key="2">Full Name
                                                                                </div>
                                                                            </transition>
                                                                        </label>
                                                                        <div class="card-item__date" ref="cardDate"
                                                                            style="box-sizing: border-box;width:100px;">
                                                                            <label for="cardMonth"
                                                                                class="card-item__dateTitle">Expires</label>
                                                                            <label for="cardMonth"
                                                                                class="card-item__dateItem">
                                                                                <transition name="slide-fade-up">
                                                                                    <span v-if="cardMonth"
                                                                                        v-bind:key="cardMonth">{{cardMonth}}</span>
                                                                                    <span v-else key="2">MM</span>
                                                                                </transition>
                                                                            </label>
                                                                            /
                                                                            <label for="cardYear"
                                                                                class="card-item__dateItem">
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
                                                                        <span v-for="(n, $index) in cardCvv"
                                                                            :key="$index">
                                                                            *
                                                                        </span>

                                                                    </div>
                                                                    <div class="card-item__type">
                                                                        <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'"
                                                                            v-if="getCardType"
                                                                            class="card-item__typeImg">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-form__inner">
                                                        <div class="card-input">
                                                            <label for="cardNumber" class="card-input__label">Card
                                                                Number</label>
                                                            <input type="text" id="cardNumberInput"
                                                                class="card-input__input"
                                                                v-mask="generateCardNumberMask" v-model="cardNumber"
                                                                v-on:focus="focusInput" v-on:blur="blurInput"
                                                                data-ref="cardNumber" autocomplete="off"
                                                                style="box-sizing: border-box;" name="cardNumberInput">
                                                            <div style="padding-top:4px;" id="validation-cardNumber"
                                                                class="hide"><span style="display:flex"><span
                                                                        style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" xml:space="preserve"
                                                                            focusable="false" fill="currentColor"
                                                                            width="16" height="16" aria-hidden="true"
                                                                            style="color:#b91e1e">
                                                                            <path
                                                                                d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                                            </path>
                                                                            <circle cx="12" cy="17" r="1"></circle>
                                                                            <path
                                                                                d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                                            </path>
                                                                        </svg></span><span><span id="cardNumber-message"
                                                                            class="validation_sentence">Required
                                                                            field</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="card-input">
                                                            <label for="cardName" class="card-input__label">Card
                                                                Holders</label>
                                                            <input type="text" id="cardNameInput"
                                                                class="card-input__input" v-model="cardName"
                                                                v-on:focus="focusInput" v-on:blur="blurInput"
                                                                data-ref="cardName" autocomplete="off"
                                                                style="box-sizing: border-box;" name="cardNameInput">
                                                            <div style="padding-top:4px;" id="validation-cardName"
                                                                class="hide"><span style="display:flex"><span
                                                                        style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 24 24" xml:space="preserve"
                                                                            focusable="false" fill="currentColor"
                                                                            width="16" height="16" aria-hidden="true"
                                                                            style="color:#b91e1e">
                                                                            <path
                                                                                d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                                            </path>
                                                                            <circle cx="12" cy="17" r="1"></circle>
                                                                            <path
                                                                                d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                                            </path>
                                                                        </svg></span><span><span id="cardName-message"
                                                                            class="validation_sentence">Required
                                                                            field</span></span></span>
                                                            </div>
                                                        </div>
                                                        <div class="card-form__row">
                                                            <div class="card-form__col">
                                                                <div class="card-form__group">
                                                                    <label for="cardMonth"
                                                                        class="card-input__label">Expiration
                                                                        Date</label>
                                                                    <div>
                                                                        <select class="card-input__input -select"
                                                                            id="cardMonthInput" name="cardMonthInput"
                                                                            v-model="cardMonth" v-on:focus="focusInput"
                                                                            v-on:blur="blurInput" data-ref="cardDate"
                                                                            style="width:120px;">
                                                                            <option value="" disabled selected>Month
                                                                            </option>
                                                                            <option v-bind:value="n < 10 ? '0' + n : n"
                                                                                v-for="n in 12"
                                                                                v-bind:disabled="n < minCardMonth"
                                                                                v-bind:key="n">
                                                                                {{n < 10 ? '0' + n : n}} </option>
                                                                        </select>
                                                                        <div style="padding-top:4px;"
                                                                            id="validation-cardMonth" class="hide">
                                                                            <span style="display:flex"><span
                                                                                    style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 24 24"
                                                                                        xml:space="preserve"
                                                                                        focusable="false"
                                                                                        fill="currentColor" width="16"
                                                                                        height="16" aria-hidden="true"
                                                                                        style="color:#b91e1e">
                                                                                        <path
                                                                                            d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                                                        </path>
                                                                                        <circle cx="12" cy="17" r="1">
                                                                                        </circle>
                                                                                        <path
                                                                                            d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                                                        </path>
                                                                                    </svg></span><span><span
                                                                                        id="cardMonth-message"
                                                                                        class="validation_sentence">Required
                                                                                        field</span></span></span>
                                                                        </div>
                                                                    </div>
                                                                    <div style="width:120px;">
                                                                        <select class="card-input__input -select"
                                                                            id="cardYearInput" name="cardYearInput"
                                                                            v-model="cardYear" v-on:focus="focusInput"
                                                                            v-on:blur="blurInput" data-ref="cardDate">
                                                                            <option value="" disabled selected>Year
                                                                            </option>
                                                                            <option v-bind:value="$index + minCardYear"
                                                                                v-for="(n, $index) in 12"
                                                                                v-bind:key="n">
                                                                                {{$index + minCardYear}}
                                                                            </option>
                                                                        </select>
                                                                        <div style="padding-top:4px;"
                                                                            id="validation-cardYear" class="hide">
                                                                            <span style="display:flex"><span
                                                                                    style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 24 24"
                                                                                        xml:space="preserve"
                                                                                        focusable="false"
                                                                                        fill="currentColor" width="16"
                                                                                        height="16" aria-hidden="true"
                                                                                        style="color:#b91e1e">
                                                                                        <path
                                                                                            d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                                                        </path>
                                                                                        <circle cx="12" cy="17" r="1">
                                                                                        </circle>
                                                                                        <path
                                                                                            d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                                                        </path>
                                                                                    </svg></span><span><span
                                                                                        id="cardYear-message"
                                                                                        class="validation_sentence">Required
                                                                                        field</span></span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-form__col -cvv">
                                                                <div class="card-input">
                                                                    <label for="cardCvv"
                                                                        class="card-input__label">CVV</label>
                                                                    <input type="text" class="card-input__input"
                                                                        id="cardCvvInput" v-mask="'###'" maxlength="3"
                                                                        v-model="cardCvv" v-on:focus="flipCard(true)"
                                                                        v-on:blur="flipCard(false)" autocomplete="off"
                                                                        style="box-sizing: border-box;"
                                                                        name="cardCvvInput">
                                                                    <div style="padding-top:4px;"
                                                                        id="validation-cardCvv" class="hide">
                                                                        <span style="display:flex"><span
                                                                                style="padding-right: 5px;width: 20px;height: 20px;justify-content: center;display: flex;align-items: center;"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24"
                                                                                    xml:space="preserve"
                                                                                    focusable="false"
                                                                                    fill="currentColor" width="16"
                                                                                    height="16" aria-hidden="true"
                                                                                    style="color:#b91e1e">
                                                                                    <path
                                                                                        d="M12 1C5.9 1 1 5.9 1 12s4.9 11 11 11 11-4.9 11-11S18.1 1 12 1zm0 20c-5 0-9-4-9-9s4-9 9-9 9 4 9 9-4 9-9 9z">
                                                                                    </path>
                                                                                    <circle cx="12" cy="17" r="1">
                                                                                    </circle>
                                                                                    <path
                                                                                        d="M12 14c.6 0 1-.4 1-1V8c0-.6-.4-1-1-1s-1 .4-1 1v5c0 .6.4 1 1 1z">
                                                                                    </path>
                                                                                </svg></span><span><span
                                                                                    id="cardCvv-message"
                                                                                    class="validation_sentence">Required
                                                                                    field</span></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="cardType" name="cardTypeInput"
                                                            v-model="cardType">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- partial -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" style="display: block;">

                <input type="submit" value="Post my ad" class="create_btn" name="submitbtn">
                <!-- <input type="submit" value="Save draft" class="save-button" style="margin-left:4px"> -->
            </div>
        </form>

    </div>

    <script>
        window.onload = function () {
            showHideCards();
        };

        function showHideCards() {
            var existcardRadio = document.getElementById('existcardRadio');
            var newCardRadio = document.getElementById('newcardRadio');
            var existCardDiv = document.getElementById('existcard');
            var newCardDiv = document.getElementById('newcard');

            if (existcardRadio.checked) {
                existCardDiv.style.display = 'block';
                newCardDiv.style.display = 'none';

                var cardSelectRadios = document.getElementsByName('cardSelect');
                var validationcardSelect = document.getElementById('validation-cardSelect');
                var cardSelectMessage = document.getElementById('cardSelect-message');

                // Function to check if any radio button is selected
                function isAnyRadioChecked() {
                    for (var i = 0; i < cardSelectRadios.length; i++) {
                        if (cardSelectRadios[i].checked) {
                            return true;
                        }
                    }
                    return false;
                }

                // Add an event listener to each radio button
                for (var i = 0; i < cardSelectRadios.length; i++) {
                    if (cardSelectRadios[i]) {
                        cardSelectRadios[i].addEventListener('change', function () {
                            if (isAnyRadioChecked()) {
                                // If a radio button is selected
                                cardSelectMessage.textContent = '';
                                validationcardSelect.classList.add('hide'); // Hide the validation message
                                validationcardSelect.dataset.valid = '1'; // Set dataset.valid to 1
                            } else {
                                // If no radio button is selected
                                cardSelectMessage.textContent = 'Please select a job type';
                                validationcardSelect.classList.remove('hide'); // Show the validation message
                                validationcardSelect.dataset.valid = '0'; // Set dataset.valid to 0
                            }
                        });
                    }
                }

                // Function to validate the form
                function validateFormExistCard(event) {
                    var invalidInputs = [];

                    if (validationcardSelect.dataset.valid !== '1') {
                        invalidInputs.push({ input: cardSelectRadios[0], validation: validationcardSelect });
                    }

                    handleInvalidInputs(invalidInputs, event);
                }

                continueButton.addEventListener('click', validateFormExistCard); // Add the event listener for the existing card

            } else if (newCardRadio.checked) {
                existCardDiv.style.display = 'none';
                newCardDiv.style.display = 'block';

                // Get the submit buttons

                // Get the input field and the validation message elements
                var cardNumberInput = document.getElementById('cardNumberInput');
                var validationcardNumber = document.getElementById('validation-cardNumber');

                // Add an event listener to the input field
                cardNumberInput.addEventListener('input', function () {
                    var cardNumberMessage = document.getElementById('cardNumber-message');
                    var cardType = document.getElementById('cardType').value; // Fetch the cardType
                    var companyId = "<?php echo $_SESSION['companyID']; ?>";
                    if (this.value.trim() === '') {
                        // If the input field is empty
                        cardNumberMessage.textContent = 'Required field';
                        this.dataset.valid = '0';
                        validationcardNumber.classList.remove('hide'); // Show the validation message
                    } else if ((cardType === 'amex' && this.value.trim().length !== 17) ||
                        (cardType !== 'amex' && this.value.trim().length !== 19)) {
                        // If the card type is 'amex' and the input field does not contain 15 characters
                        // or if the card type is not 'amex' and the input field does not contain 19 characters
                        cardNumberMessage.textContent = 'Invalid card number';
                        this.dataset.valid = '0';
                        validationcardNumber.classList.remove('hide'); // Show the validation message
                    } else {
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
                    }
                });

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

                // Function to validate the form
                function validateFormNewCard(event) {
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

                    handleInvalidInputs(invalidInputs, event);
                }

                continueButton.addEventListener('click', validateFormNewCard); // Add the event listener for the new card

            }

            // Add an event listener to the existcardRadio element
            existcardRadio.addEventListener('change', function () {
                if (existcardRadio.checked) {
                    // Add the event listener for the existing
                    continueButton.removeEventListener('click', validateFormNewCard);

                    continueButton.addEventListener('click', validateFormExistCard);
                } else {
                    // Remove the event listener for the existing card
                    continueButton.removeEventListener('click', validateFormExistCard);
                }
            });

            // Add an event listener to the newCardRadio element
            newCardRadio.addEventListener('change', function () {
                if (newCardRadio.checked) {
                    // Remove the event listener for the existing card
                    continueButton.removeEventListener('click', validateFormExistCard);
                    // Add the event listener for the new card
                    continueButton.addEventListener('click', validateFormNewCard);
                } else {
                    // Remove the event listener for the new card
                    continueButton.removeEventListener('click', validateFormNewCard);
                }
            });
        }

    </script>
    <script>
        // Get all the card elements
        var cards = document.querySelectorAll('.card');

        // Add a click event listener to each card
        cards.forEach(function (card) {
            card.addEventListener('click', function () {
                // Remove the selected class from all cards
                cards.forEach(function (c) {
                    c.classList.remove('selected');
                });

                // Add the selected class to the clicked card
                this.classList.add('selected');

                // Check the radio button inside the clicked card
                var radioButton = this.querySelector('input[type="radio"]');
                radioButton.checked = true;

                // Manually trigger the change event
                var event = new Event('change');
                radioButton.dispatchEvent(event);
            });
        });
    </script>
    <script>
        // Get the select element and the price element
        var selectElement = document.getElementById('postDuration');
        var priceElement = document.getElementById('total_price');
        var subtotalElement = document.getElementById('subtotal_price');
        var sstElement = document.getElementById('sst_price');

        // Listen for changes on the select element
        selectElement.addEventListener('change', function () {
            // Get the selected month
            var selectedMonth = this.value;

            // Calculate the price
            var price = selectedMonth * 98;

            // Calculate the SST as 6% of the price
            var sst = price * 0.06;

            // Add the SST to the price
            var totalPrice = price + sst;

            // Update the price element
            priceElement.textContent = 'RM ' + totalPrice.toFixed(2);
            subtotalElement.textContent = 'RM ' + price.toFixed(2);
            sstElement.textContent = 'RM ' + sst.toFixed(2);

            document.getElementById('totalPrice').value = totalPrice.toFixed(2);
        });

        var continueButton = document.querySelector('.cont-button');

        // Get the select field and the validation message elements
        var validationpostDuration = document.getElementById('validation-postDuration');
        var postDurationMessage = document.getElementById('postDuration-message');

        // Add an event listener to the select field
        selectElement.addEventListener('change', function () {
            var value = this.value;

            // Check if the select field has a valid value
            if (value === '') {
                postDurationMessage.textContent = 'Required field';
                this.dataset.valid = '0';
                validationpostDuration.classList.remove('hide'); // Show the validation message
            } else {
                // If the select field has a valid value
                postDurationMessage.textContent = '';
                this.dataset.valid = '1';
                validationpostDuration.classList.add('hide'); // Hide the validation message
            }
        });

        // Function to validate the form
        function validateFormGeneral(event) {
            var invalidInputs = [];

            // Check each input field
            if (selectElement.dataset.valid !== '1') {
                invalidInputs.push({ input: selectElement, validation: validationpostDuration });
            }

            handleInvalidInputs(invalidInputs, event);
        }

        // Function to handle invalid inputs
        function handleInvalidInputs(invalidInputs, event) {
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
        continueButton.addEventListener('click', validateFormGeneral);

        document.getElementById('paymentForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from being submitted immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to proceed with the payment. Please note that this action cannot be reversed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData(this);

                    // Append the CompanyID and job_post_ID from the session
                    formData.append('CompanyID', <?php echo $_SESSION['companyID']; ?>);
                    formData.append('job_post_ID', <?php echo $_SESSION['job_post_ID']; ?>);
                    $.ajax({
                        url: 'process_payment.php',
                        type: 'POST',
                        data: formData,
                        processData: false, // Necessary for FormData
                        contentType: false, // Necessary for FormData
                        success: function (response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: "Success",
                                    text: "Payment received! Thank you for your purchase.",
                                    icon: "success",
                                }).then(function () {
                                    window.location.href = "company_landing.php";
                                });
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Payment unsuccessful. Please check your details and try again.",
                                    icon: "error",
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
    <script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
    <script src="company_creditcard.js"></script>
    <script src="post-job.js"></script>
</body>

</html>



<?php
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (!isset($_SESSION['job_post_ID'])) {
    ?>
    <script>
        Swal.fire({
            title: "Error",
            text: "Invalid Action. You have already completed your payment.",
            icon: "error",
            backdrop: `lightgrey`,
        }).then(function () {
            window.location.href = "company_landing.php";
        });
    </script>
    <?php
    exit;
}

if (!isset($_SESSION['companyID'])) {
    ?>
    <script>
        Swal.fire({
            title: "Error",
            text: "You haven\'t logged in",
            icon: "error",
            backdrop: `lightgrey`,
        }).then(function () {
            window.location.href = "company_login.php";
        });
    </script>
    <?php
    exit;
} else if ($row['CompanyStatus'] == 'Verify') {
    // Show swal box
    ?>
        <script>
            Swal.fire({
                title: 'Error',
                text: 'Please verify your email first.',
                icon: 'error',
            }).then(function () {
                window.location = "company_signout.php";
            });
        </script>
    <?php
} else if ($row['CompanyStatus'] == 'Block') {
    // Show swal box
    ?>
            <script>
                Swal.fire({
                    title: 'Error',
                    text: 'Your account has been blocked.',
                    icon: 'error',
                }).then(function () {
                    window.location = "company_signout.php";
                });
            </script>
    <?php
}
?>

<?php
mysqli_free_result($result);
mysqli_close($connect);
?>