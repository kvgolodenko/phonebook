<div class="container">
    <form id="reg_form" method="post" action="#" role="form">
        <div class="messages"></div>
        <div class="controls">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_name">Firstname *</label>
                        <input id="form_name" type="text" name="name" class="form-control"
                               placeholder="Please enter your firstname *" required="required"
                               data-error="Firstname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_lastname">Lastname *</label>
                        <input id="form_lastname" type="text" name="surname" class="form-control"
                               placeholder="Please enter your lastname *" required="required"
                               data-error="Lastname is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_email">Email *</label>
                        <input id="form_email" type="email" name="email" class="form-control"
                               placeholder="Please enter your email *" required="required"
                               data-error="Valid email is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="form_phone">Phone</label>
                        <input id="form_phone" type="tel" name="phone" class="form-control"
                               placeholder="Please enter your phone">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="form_pass">Password *</label>
                        <input id="password" type="password" name="password" class="form-control"
                               placeholder="Please enter your password" required>
                        <div class="help-block with-errors"></div>
                        <label for="form_rep_pass">Repeat password *</label>
                        <input id="rep_password" type="password" name="rep_password" class="form-control"
                               placeholder="Please repeat your password" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <!-- Replace data-sitekey with your own one, generated at https://www.google.com/recaptcha/admin -->
<!--                        <div class="g-recaptcha" data-sitekey="6Lcp_soZAAAAAIH7P_X70gyxS3NbOaxkiqS7vW-t"></div>-->
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" class="btn btn-success btn-send" value="Register">
                </div>
                <div class=col-md-12>
                    Already registered? <a href="/login">Login</a>
                </div>
            </div>
        </div>
    </form>
</div>
