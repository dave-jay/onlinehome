<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                I'm sorry! I can't reach you! I would really like to discuss the options we have available for your business. Getting extra working capital for your business will be very difficult at any bank. I can promise you this though, with a 10 minute phone call I am sure we can help you get the funds that you need for your business. Call me.
            </p>            
            <?php $email_type = ''; ?>
            <?php include _PATH.'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>