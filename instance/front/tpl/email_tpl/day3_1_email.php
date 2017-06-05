<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                We have been trying to reach you in regards to your interest in funding for your business. We work with 50 different lenders including companies backed by Google Ventures and Goldman Sachs which allows us to approve over 90% of our clients. Call me today so we can discuss the opportunities we have available for your business.
            </p>     
            <?php $email_type = ''; ?>
            <?php include _PATH.'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>