<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                We can't reach you! We have been trying to reach you to see how you are doing with the application process. Have you had the chance to get the documents we need together? Are you finding that you need more time with the application? Please contact me today and let me know where you are at. Chances are I can help!
            </p>            
            <?php include _PATH.'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>