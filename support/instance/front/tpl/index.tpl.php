<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Support Doc | Sprout Lending</title>
        <link rel="icon" href="<?php echo _MEDIA_URL ?>faqTheme/assets/img/favicon.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
        <script src="<?php echo _MEDIA_URL ?>faqTheme/assets/js/jquery.js"></script>
        <link rel="stylesheet" href="<?php echo _MEDIA_URL ?>faqTheme/assets/css/main.css" />
        <script src="<?php echo _MEDIA_URL ?>faqTheme/assets/js/main.js"></script>

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    </head>
    <body>

        <div>
            <?php if ($no_visible_elements) : ?>
                <?php include $modulePage; ?>
            <?php else: ?>
                <?php if ($modulePage != 'home.php'): ?>
                    <?php include_once('left.php'); ?>
                <?php endif; ?>
                <div>
                    <?php if (!(@include $modulePage)) : ?>
                        <?php include "404.php"; ?>
                    <?php endif; ?>

                </div>	
            <?php endif; ?>
        </div>

        <!--Footer section -->
        <footer id="footer" class="uk-section uk-margin-remove uk-section-xsmall uk-text-small uk-text-muted border-top">
            <div class="uk-container">
                <div class="uk-child-width-1-2@m uk-text-center" uk-grid>
                    <div class="uk-text-right@m">
                        <a href="#" target="_blank" class="uk-icon-link uk-margin-small-right" uk-icon="icon: facebook"></a>
                    </div>
                    <div class="uk-flex-first@m uk-text-left@m">
                        <p class="uk-text-small">Copyright 2017 LeadPropel</p>
                    </div>
                </div>
            </div>
        </footer>
        <!--END Footer section -->

        <div id="offcanvas" uk-offcanvas="flip: true; overlay: true">
            <div class="uk-offcanvas-bar">
                <a class="uk-margin-small-bottom uk-logo uk-text-uppercase" href="index.html"><span class="uk-margin-small-right" uk-icon="icon: lifesaver"></span> Knowledge</a>
                <ul class="uk-nav uk-nav-default uk-text-uppercase">
                    <li><a href="index.html">Home</a></li>
                    <li class="uk-parent">
                        <a href="article.html">Article</a>
                        <ul class="uk-nav-sub">
                            <li><a href="article.html">Scrollspy</a></li>
                            <li><a href="article-narrow.html">Narrow</a></li>
                        </ul>
                    </li>
                    <li><a href="faq.html">Faq</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="components.html">Components</a></li>
                </ul>
                <a href="contact.html" class="uk-button uk-button-small uk-button-default uk-width-1-1 uk-margin">Support</a>
                <div class="uk-width-auto uk-text-center">
                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: facebook"></a>
<!--                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: google"></a>
                    <a href="#" class="uk-icon-link uk-margin-small-right" uk-icon="icon: twitter"></a>-->
                </div>            
            </div>
        </div>

        <script src="//code.jquery.com/jquery.js"></script>

        <?php include "scripts.php"; ?>
        <?php include $jsInclude; ?>

        <script src="<?php print _MEDIA_URL ?>bootstrap/js/bootstrap.min.js"></script>

        <?php if ($error): ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    setTimeout(function() {
                        $('#error_msg_div').fadeOut(1200);
                    }, 3500);	
                });   
            </script>
        <?php endif; ?>

        <?php if ($greetings): ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    setTimeout(function() {
                        $('#success_msg_div').fadeOut(1200);
                    }, 3500);
                });
            </script>
        <?php endif; ?>


    </body>
</html>










