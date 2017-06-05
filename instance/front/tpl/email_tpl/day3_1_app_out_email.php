<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                My underwriter that specializes in funding your industry “<?= $org_name; ?>” will be in my office tomorrow. He will be able to get you approved for the best possible program and rate. Do you think you can have your application in tonight so I can work with this specific underwriter for you?
            </p>            
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                Please complete the application and send in the requested documents so I can help you take your business to the next level. We have a lot of clients so the sooner I have your complete application in front of one of my underwriters the better. 
            </p>         
            <?php $email_type = 'app_out'; ?>
            <?php include _PATH . 'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>