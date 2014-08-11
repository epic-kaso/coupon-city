
<div class="inner-pad">

    <div class="static-wrapper">

        <h1 class="static-header">Contact Us</h1>

        <div class="contact-form clearfix">
            <p>Use our contact form or details and we'll get back to you as soon as possible.</p>

            <div class="alert alert-success form-alert" id="form-success">Your message has been sent successfully!</div>
            <div class="alert alert-error form-alert" id="form-fail">Sorry, error occured this time sending your message</div>

            <form class="left">             
                <li>
                    <label>Name *</label>
                    <input name="name" id="name" type="text" required />
                    <div class="alert form-alert" id="form-alert-name">Please enter your name</div>
                </li>

                <li>
                    <label>Email *</label>
                    <input name="email" id="email" type="email" required />
                    <div class="alert form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                </li>

                <li>
                    <label>Mobile No:</label>
                    <input name="phone" id="phone" type="text" />
                </li>

                <li>
                    <label>Message:</label>
                    <textarea name="message" id="message" required ></textarea>
                    <div class="alert form-alert" id="form-alert-message">Please enter message</div>
                </li>

                <li>  
                    <?php
                    $publickey = "6LfXEfgSAAAAAJwej_jO_C2mLzfAiHLXlhq7GwwL"; // you got this from the signup page
                    echo recaptcha_get_html($publickey);
                    ?>
                </li>

                <li><input type="submit" value="Submit" class="text-button"></li>
            </form>

            <div class="contact-details right">
                <h3>Contact Details</h3>

                <ul>
                    <li class="address">1, Victoria Arobieke Str, Lekki 1</li>
                    <li class="phone-no">070312345678</li>
                    <li class="phone-no">070312345678</li>
                    <li class="phone-no">070312345678</li>
                    <li class="email-add">hello@couponcity.ng</li>
                </ul>

                <h3>Be Social</h3>
                <ul class="clearfix social">
                    <li class="gplus"><a href=""></a></li>
                    <li class="twitr"><a href=""></a></li>
                    <li class="facebk"><a href=""></a></li>
                </ul>
            </div>

        </div>

    </div>

</div>




