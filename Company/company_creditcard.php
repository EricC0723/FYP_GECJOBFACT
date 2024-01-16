<!DOCTYPE html>
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="post-job.css">
    <link rel="stylesheet" type="text/css" href="company_register.css">
    <link rel="stylesheet" type="text/css" href="company_creditcard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
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
                            <div style="padding-top: 12px;"><a href="#invoicehistory" class="dropdown-link">Invoice
                                    history</a></div>
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

    <div style="padding-top:48px;padding-bottom:48px;">

        <div style="margin:0 auto;max-width:960px;width:100%;">
            <div style="padding-top:20px;">
                <div style="display:flex;flex-direction:row;align-items:center">
                    <h2 class="landing_sentence3">Company Payment</h2>
                </div>
            </div>

            <div style="padding-top:20px;">
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
                                                                :class="{ '-active' : n.trim() === '' }" v-else
                                                                :key="$index + 1">{{n}}</div>
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
                                                                :class="{ '-active' : n.trim() === '' }" v-else
                                                                :key="$index + 1">{{n}}</div>
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
                                                                    v-if="$index === $index"
                                                                    v-bind:key="$index + 1">{{n}}</span>
                                                            </transition-group>
                                                        </div>
                                                        <div class="card-item__name" v-else key="2">Full Name</div>
                                                    </transition>
                                                </label>
                                                <div class="card-item__date" ref="cardDate"
                                                    style="box-sizing: border-box;">
                                                    <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                                                    <label for="cardMonth" class="card-item__dateItem">
                                                        <transition name="slide-fade-up">
                                                            <span v-if="cardMonth"
                                                                v-bind:key="cardMonth">{{cardMonth}}</span>
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
                                    <input type="text" id="cardNumber" class="card-input__input"
                                        v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput"
                                        v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off"
                                        style="box-sizing: border-box;" name="cardNumber">
                                </div>
                                <div class="card-input">
                                    <label for="cardName" class="card-input__label">Card Holders</label>
                                    <input type="text" id="cardName" class="card-input__input" v-model="cardName"
                                        v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName"
                                        autocomplete="off" style="box-sizing: border-box;" name="cardName">
                                </div>
                                <div class="card-form__row">
                                    <div class="card-form__col">
                                        <div class="card-form__group">
                                            <label for="cardMonth" class="card-input__label">Expiration Date</label>
                                            <select class="card-input__input -select" id="cardMonth" name="cardMonth"
                                                v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput"
                                                data-ref="cardDate">
                                                <option value="" disabled selected>Month</option>
                                                <option v-bind:value="n < 10 ? '0' + n : n" v-for="n in 12"
                                                    v-bind:disabled="n < minCardMonth" v-bind:key="n">
                                                    {{n < 10 ? '0' + n : n}} </option>
                                            </select>
                                            <select class="card-input__input -select" id="cardYear" name="cardYear"
                                                v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput"
                                                data-ref="cardDate">
                                                <option value="" disabled selected>Year</option>
                                                <option v-bind:value="$index + minCardYear" v-for="(n, $index) in 12"
                                                    v-bind:key="n">
                                                    {{$index + minCardYear}}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-form__col -cvv">
                                        <div class="card-input">
                                            <label for="cardCvv" class="card-input__label">CVV</label>
                                            <input type="text" class="card-input__input" id="cardCvv" v-mask="'###'"
                                                maxlength="3" v-model="cardCvv" v-on:focus="flipCard(true)"
                                                v-on:blur="flipCard(false)" autocomplete="off"
                                                style="box-sizing: border-box;" name="cardCvv">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="cardType" name="cardType" v-model="cardType">
                                <input type="submit" value="Add Card" class="cont-button" name="submitbtn"
                                    style="width:100%;">

                            </div>
                        </div>


                    </div>
                    <!-- partial -->

                </form>

            </div>





        </div>
    </div>

    <script src="post-job.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
    <script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
    <script src="company_creditcard.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        let cardType = getCardType();
        document.getElementById('cardType').value = cardType;
    </script>

</body>

</html>




<?php
if (isset($_SESSION['companyID'])) {
    $CompanyID = $_SESSION['companyID'];
    $sql = "SELECT * FROM companies WHERE CompanyID = $CompanyID";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_GET['submitbtn'])) {
    $cardNumber = $_GET['cardNumber'];
    $cardName = $_GET['cardName'];
    $cardType = $_GET['cardType'];
    $cardMonth = $_GET['cardMonth'];
    $cardYear = $_GET['cardYear'];
    $cardCvv = $_GET['cardCvv'];

    $sql = "INSERT INTO credit_card (CompanyID, CreditCard_Type, CreditCard_Number, CreditCard_Holder, CreditCard_ExpMonth, CreditCard_ExpDate, CreditCard_CVV) VALUES ('$CompanyID', '$cardType', '$cardNumber', '$cardName', '$cardMonth', '$cardYear', '$cardCvv')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "Credit card added successfully",
                icon: "success",
                backdrop: `lightgrey`,
            }).then(function () {
                window.location.href = "company_creditcard.php";
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "Credit card added failed",
                icon: "error",
                backdrop: `lightgrey`,
            });
        </script>
        <?php
    }
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