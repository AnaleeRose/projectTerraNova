<?php
require './assets/includes/config.inc.php';
require './assets/includes/form_functions.inc.php';


// contact form handling
$contact_errors = [];
$c_options = ['required' => '', 'contactPage' => ''];



$page = 'contact';
if ($page = 'contact') {
?>
<style type="text/css">
  :root {
      --pageColor: var(--contact);
      --pageColor-shade: var(--contact-shade);
      --pageColor-link: var(--contact-link);
  }
</style>
<?php
}
require './assets/includes/head.php';
?>

<body class="">
<!------ Header ------------>
<?php require './assets/includes/header.inc.php'; ?>

<!-- Main body content -->
<article id="mainContent" class="multiContentPage mainContent contactPage">
    <header class="mainHeading_Container">
       <h2 class="mainHeading">Contact Us</h2>
    </header>

    <div class="mainContent-wrapper">
        <section class="quoteHeading-container">
            <!-- <p class="quote contact-quote">We value your feedback, feel free to reach out!</p> -->
            <p class="quote contact-quote">We value your feedback!</p>
        </section>

        <section class="contactSidebar-container">
            <h3 class="contactSidebar-header">Our Contact Info</h3>

            <div class="contactSidebar-IconText contactSidebar-home-container">
                <svg class="contactSidebar-icon contactSidebar-houseIcon" id="contactSidebar-houseIcon" data-name="Group 2" xmlns="http://www.w3.org/2000/svg" width="47.689" height="37.952" viewBox="0 0 47.689 37.952">
                  <path id="Path_3" data-name="Path 3" d="M82.736,120.939,65.728,134.96a.4.4,0,0,1-.015.089.4.4,0,0,0-.015.088v14.2a1.921,1.921,0,0,0,1.893,1.894H78.949V139.87h7.573v11.359H97.881a1.923,1.923,0,0,0,1.894-1.894v-14.2a.416.416,0,0,0-.03-.177Z" transform="translate(-58.891 -113.278)" />
                  <path id="Path_4" data-name="Path 4" d="M47.36,65.482,40.882,60.1V48.03a.912.912,0,0,0-.947-.946H34.256a.911.911,0,0,0-.947.946V53.8l-7.217-6.034a3.669,3.669,0,0,0-4.5,0L.328,65.482A.859.859,0,0,0,0,66.117a.958.958,0,0,0,.207.7L2.044,69a1.009,1.009,0,0,0,.621.326,1.1,1.1,0,0,0,.71-.207L23.844,52.052,44.313,69.12a.912.912,0,0,0,.621.206h.089A1.01,1.01,0,0,0,45.645,69l1.834-2.189a.957.957,0,0,0,.206-.7A.862.862,0,0,0,47.36,65.482Z" transform="translate(0.001 -46.994)" />
                </svg>
                <p class="contactSidebar-text">12777 N Rockwell Ave<span class="contactSidebar-secondLineText">Oklahoma City, OK 73142</span></p>
            </div>

            <div class="contactSidebar-IconText contactSidebar-phone-container">
                <svg class="contactSidebar-icon contactSidebar-phoneIcon" id="contactSidebar-phoneIcon" xmlns="http://www.w3.org/2000/svg" width="29.422" height="50" viewBox="0 0 29.422 50">
                  <g id="smartphone-call" transform="translate(-7.334)">
                    <path id="Path_1" data-name="Path 1" d="M33.335,0H10.755A3.409,3.409,0,0,0,7.334,3.377V46.621A3.41,3.41,0,0,0,10.755,50h22.58a3.408,3.408,0,0,0,3.421-3.377V3.377A3.409,3.409,0,0,0,33.335,0Zm-14.9,2.434h7.224a.409.409,0,1,1,0,.819H18.433a.409.409,0,1,1,0-.819Zm3.612,45.877a1.689,1.689,0,1,1,1.71-1.69A1.7,1.7,0,0,1,22.045,48.311ZM34.376,43.75H9.714V5.356H34.376Z"/>
                  </g>
                </svg>
                <p class="contactSidebar-text">1-888-867-5309</p>
            </div>

            <div class="contactSidebar-IconText contactSidebar-email-container">
                <svg class="contactSidebar-icon contactSidebar-emailIcon" id="contactSidebar-emailIcon" xmlns="http://www.w3.org/2000/svg" width="45.919" height="31.943" viewBox="0 0 45.919 31.943">
                  <g id="email-envelope-outline" transform="translate(188 179.889)">
                    <path id="Path_2" data-name="Path 2" d="M45.42,59.111H.5a.5.5,0,0,0-.5.5V90.556a.5.5,0,0,0,.5.5H45.42a.5.5,0,0,0,.5-.5V59.61A.5.5,0,0,0,45.42,59.111Zm-7.6,3.993L22.96,74,8.1,63.1Zm4.1,23.957H3.993V65.048L22.664,78.74a.5.5,0,0,0,.592,0L41.927,65.048V87.061Z" transform="translate(-188 -239)"/>
                  </g>
                </svg>
                <p class="contactSidebar-text"><?= EMAIL_LINK ?></p>
            </div>

        </section>
        <form class="cf-container form-container">
            <?php
                create_form_input('c_name', 'text', 'Name', $contact_errors, $c_options + ['placeholder' => 'your name', 'addtl_div_classes' => 'equalWidthContainer']);

                create_form_input('c_email', 'email', 'Email', $contact_errors, $c_options + ['placeholder' => 'your email', 'addtl_div_classes' => 'equalWidthContainer']);
            ?>
            <div class="cf_inputLabel-container cf_joinNewsletter-container">
                <label for="cf_joinNewsletter">Join Our Newsletter?
                    <p class="requiredWarning cf_requiredWarning">required</p>
                </label>
                <div class="cf_joinChoice-container">
                    <div class="cf_joinChoice-indiContainer">
                        <input class="cf_joinChoice-input" type="radio" name="cf_joinNewsletter" value="0">
                        <span class="customRadioBtn" data-value="0"></span>
                        <p class="cf_joinChoice-text">Sure, I'm in!</p>
                    </div>
                    <div class="cf_joinChoice-indiContainer">
                        <input class="cf_joinChoice-input" type="radio" name="cf_joinNewsletter" value="1" checked>
                        <span class="customRadioBtn"  data-value="1"></span>
                        <p class="cf_joinChoice-text">No, thank you...</p>
                    </div>
                </div>
            </div>

            <?php
                create_form_input('c_msg', 'textarea', 'Message', $contact_errors, $c_options + ['placeholder' => 'What do you have to say?', 'addtl_div_classes' => 'cf_msgCounter-container']);
            ?>
            <input name="cf_submit" id="cf_submit" type="submit" value="Send Email" class="btn cf_btn">
        </form>
</div>
</article>

<!------ Footer ------------>
​<?php require './assets/includes/footer.inc.php'; ?>

</body>
<script defer>
    // updates the join the newletter input so it can have custom checkboxes
    const allJoinChoices = document.body.querySelectorAll('.cf_joinChoice-input')
    const allJoinText = document.body.querySelectorAll('.cf_joinChoice-text')
    const allJoinCustomBtns = document.body.querySelectorAll('.customRadioBtn');
    const intialCheckedJoinChoice = document.body.querySelector('.cf_joinChoice-input:checked ~ span')
    const characterLimit = 1200

    const c_msg = document.body.querySelector("#c_msg");
    const characterCounter = document.body.querySelector("#characterCounter");
    if (characterCounter) {
        characterCounter.innerHTML = "Characters Remaining: <span id=\"cc_currentNum\">" + characterLimit + "</span>";
        let cc_currentNum = document.body.querySelector("#cc_currentNum");
        c_msg.addEventListener('keydown', function(e) {
            updateCharacterCount(e)
        })
    }

    allJoinCustomBtns.forEach(function(e){
        e.addEventListener('click', function(){
            updateInput(e);
        })
    })

    allJoinText.forEach(function(e) {
        e.addEventListener('click', function() {
            updateInput(e.previousElementSibling);
        })
    })

    function updateCharacterCount(e) {
        let textarea = e.srcElement
        let c_length = textarea.value.length
        let c_limit =  characterLimit - c_length
        cc_currentNum.innerHTML = c_limit;
    }

    function updateInput(e) {
        let value = e.getAttribute("data-value")
        let checkedJoinChoice = document.body.querySelector('.cf_joinChoice-input[value="' + value + '"]')
        let checkedJoinChoice_text = document.body.querySelector('.cf_joinChoice-input[value="' + value + '"] ~ p')
        allJoinCustomBtns.forEach(function(e) {
            if (e.classList.contains("checkedCustomRadioBtn")) {
                e.classList.remove("checkedCustomRadioBtn")
            }
        })

        allJoinText.forEach(function(e) {
            e.style.color = 'inherit';
        })
        checkedJoinChoice_text.style.color = "var(--pageColor)";
        e.classList.add("checkedCustomRadioBtn")
        checkedJoinChoice.checked = true;
    }

     window.onload = updateInput(intialCheckedJoinChoice);
</script>
</html>
