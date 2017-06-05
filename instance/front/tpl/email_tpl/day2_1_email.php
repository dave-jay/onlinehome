<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                I am contacting you because you expressed some interest in a recent online inquiry in regards to getting some funding for your business. Please contact me or let me know the best time to talk. I would love to discuss some more about your business and what we can offer you here at Sprout. I look forward to hearing from you!
            </p>  
            <?php $email_type = ''; ?>
            <?php include _PATH.'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>