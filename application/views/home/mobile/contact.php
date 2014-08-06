<div class="top-title-area">
    <div class="container">
        <h1 class="title-page">Contact Us</h1>
    </div>
</div>

<!-- END PAGE TITLE -->

<div class="gap"></div>

<!-- //////////////////////////////////
//////////////END MAIN HEADER//////////
////////////////////////////////////-->


<!-- //////////////////////////////////
//////////////PAGE CONTENT/////////////
////////////////////////////////////-->


<div class="container">
    <div class="row row-wrap">
        <div class="span9">
            <form method="post" action="contact">
                <fieldset>
                    <div class="row-fluid">
                        <label>Full Name <i style="font-size: smaller">*</i></label>
                        <div class="alert form-alert" id="form-alert-name">Please enter your name</div>
                        <input name="name" class="span12" id="name" type="text" required placeholder="Enter Your name here" />
                    </div>
                    <div class="row-fluid">
                        <label>Email <i style="font-size: smaller">*</i></label>
                        <div class="alert form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                        <input class="span12" name="email" id="email" type="email" required placeholder="You E-mail Address" />
                    </div>
                    <div class="row-fluid">
                        <label>Mobile Number</label>
                        <div class="alert form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                        <input class="span12" name="phone" id="phone" type="text" placeholder="You E-mail Address" />
                    </div>
                    <div class="row-fluid">
                        <label>Subject <i style="font-size: smaller">*</i></label>
                        <div class="alert form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                        <input class="span12" name="subject" id="subject" type="text" required placeholder="You E-mail Address" />
                    </div>
                    <div class="row-fluid">
                        <label>Message <i style="font-size: smaller">*</i></label>
                        <div class="alert form-alert" id="form-alert-message">Please enter message</div>
                        <textarea class="span12" name="message" id="message" required placeholder="Your message" style="height: 300px;"></textarea>
                    </div>
                    <div class="alert alert-success form-alert" id="form-success">Your message has been sent successfully!</div>
                    <div class="alert alert-error form-alert" id="form-fail">Sorry, error occured this time sending your message</div>
                    <?php
                    $publickey = "6LfXEfgSAAAAAJwej_jO_C2mLzfAiHLXlhq7GwwL"; // you got this from the signup page
                    echo recaptcha_get_html($publickey);
                    ?>
                    <input type="submit" class="btn btn-primary" value="Send Message" />
                </fieldset>
            </form>
        </div>
        <div class="span3">
            <h5>Contact Info</h5>
            <p>Be rest assured you can always reach us using our contact info here:</p>
            <ul class="list">
                <li><i class="icon-map-marker"></i> Location:1 Victoria Arobieke Street Lekki Phase 1, Lagos</li>
                <li><i class="icon-phone"></i> Phone: 08060518576</li>
                <li><i class="icon-envelope"></i> E-mail: <a href="mailto:support@couponcity.com.ng">support@couponcity.com.ng</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="gap gap-small"></div>
</div>


<!-- //////////////////////////////////
//////////////END PAGE CONTENT/////////
////////////////////////////////////-->

<!-- //////////////////////////////////
//////////////MAIN FOOTER//////////////
////////////////////////////////////-->
<?= partial('partials/_footer_nav', array()); ?>
<!-- //////////////////////////////////
//////////////END MAIN  FOOTER/////////
////////////////////////////////////-->