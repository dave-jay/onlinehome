<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hi <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                Thanks for taking the time out to fill out the application for your business financing with Sprout. I have attempted to contact you in order to review your pre-approval options and start the funding process but have been unsuccessful.
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                If the information that you have already provided is not the best method in which to contact you immediately, please reply to this email with the best contact information so I can reach out to you today.
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                In the meantime, if you have any questions or concerns please feel free to contact me at <?= $agent_phone; ?> or just reply to this email with any question. Thank you again for giving us the opportunity to work with you!
            </p>
            <?php include _PATH.'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>