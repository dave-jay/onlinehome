<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths js-menubar" style="" lang="en"><head>

        <title> LySoft Media</title>


        <!-- Stylesheets -->
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/bootstrap.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/bootstrap-extend.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/site.css">

        <!-- Plugins -->

        <!-- Fonts -->
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/web-icons.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/brand-icons.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/css_002.css">
        <link href="<?php print _MEDIA_URL ?>loginDesignNew/css.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/font-awesome.css">

        <script>

        </script><link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/formValidation.css">   
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/login-v3.css">    



    </head>

    <body class="page-login-v3 layout-full">

        <!-- Page -->
        <div style="animation-duration: 0.8s; opacity: 1;" class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="page-content vertical-align-middle">
                <div class="panel" style="width:700px;">
                    <div class="panel-body">
                        <?php
                        if ($login_error != '') {
                            $set_brilliant_cookie = 0;
                            ?>
                            <div class="" style="padding:5px;color:red;">
                                <div style="float:left;"><img src="<?php print _MEDIA_URL ?>img/login-erroe.png" width="28" height="26" alt=" " /></div>
                                <div style="float:left;"><?= $error_msg ?></div>
                                <div style="clear:both;"></div>
                            </div>
                        <?php } ?>
                        <div class="brand">
                            <img class="brand-img" src="<?php print _MEDIA_URL ?>img/lead-propel-logo.png" alt="LeadPropel" style="width:330px;">

                        </div>


                        <form class="fv-form fv-form-bootstrap" method="POST" action="<?php print $login_action_url; ?>" id="signupform" autocomplete="on">
                            <div class="row">
                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="First Name" class="form-control" autofocus="autofocus" name="fname" type="text">
                                    <label class="floating-label">First Name</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="First Name" data-fv-validator="notEmpty" class="help-block" style="display: none;">The username is required</small>
                                </div>

                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="Last Name" class="form-control"  name="lname" value="" type="text">
                                    <label class="floating-label">Last Name</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="Last Name" data-fv-validator="notEmpty" class="help-block" style="display: none;">The password is required</small>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="email" class="form-control" autofocus="autofocus" name="email" type="email">
                                    <label class="floating-label">Email</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="email" data-fv-validator="notEmpty" class="help-block" style="display: none;">The username is required</small><small data-fv-result="NOT_VALIDATED" data-fv-for="email" data-fv-validator="emailAddress" class="help-block" style="display: none;">The email address is not valid</small>
                                </div>
                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="phone" class="form-control" autofocus="autofocus" name="phone" type="text">
                                    <label class="floating-label">Phone</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="phone" data-fv-validator="notEmpty" class="help-block" style="display: none;">The username is required</small><small data-fv-result="NOT_VALIDATED" data-fv-for="email" data-fv-validator="emailAddress" class="help-block" style="display: none;">The email address is not valid</small>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="password" class="form-control" id="password"  name="password" value="" type="password">
                                    <label class="floating-label">Password</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="password"  class="help-block" style="display: none;">The password is required</small>
                                </div>
                                <div class="col-lg-6 form-group form-material">
                                    <input data-fv-field="cpassword" class="form-control"  name="cpassword" value="" type="password">
                                    <label class="floating-label">Confirm Password</label>
                                    <small data-fv-result="NOT_VALIDATED" data-fv-for="cpassword"   class="help-block" style="display: none;">The password is not match</small>
                                </div>


                                <input type="submit" name="submit" value="Sign Up" class="btn btn-primary btn-block btn-lg margin-top-40"/>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="page-copyright page-copyright-inverse">
                    <p>© <?php print date('Y'); ?>. All RIGHT RESERVED LeadPropel</p>

                </div>
            </div>
        </div>
        <!-- End Page -->
    </body>
</html>
<script src="<?php print _MEDIA_URL ?>loginDesignNew/formValidation.js"></script>
<style>
    .floating-label{
        margin-left: 15px;
    }
</style>


