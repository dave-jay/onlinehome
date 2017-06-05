<html>
    <head></head>
    <body>
        <div style="font-size: 16px; padding: 50px 50px 0px;">   
            <p style="color: #888888;font-family: verdana;font-weight: bold;margin-bottom: 10px;">
                Hello <?= $fname; ?>,
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                I just sent you the application that you requested through docusign. Please complete the application and send me the following statements so I can have your application processed right away.
            </p>            
            <p style="color: #888888;font-family: verdana; line-height: 1.6;"></p>
            <ul style="color: #888888;font-family: verdana;padding-left: 10px;">
                <li>Completed Application</li>
                <li>Last <?= $no_of_month; ?> months of business bank statements</li>
                <li>Last 4 months of merchant processing statements (if applicable)</li>
                <li>Last year’s business tax return-(if you have it, if not just send in the statements and application)</li>
            </ul>
            <?php /* <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                Prior to funding we will need the following:            
            </p>
            <ul style="color: #888888;font-family: verdana;padding-left: 10px;">
                <li>Driver’s license</li>
                <li>Voided business check</li>
                <li>Copy of your lease</li>
                <li>Proof of ownership (Last year's business tax return, Articles of Incorporation, Business License or your Fed tax ID letter)</li>
            </ul> */ ?>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                I look forward to working with you. Please call me immediately if you have any questions.
            </p>
            <p style="color: #888888;font-family: verdana; line-height: 1.6;">
                P.S. The faster you get the application in the faster I can go to work to get you into the best program possible!
            </p>
            <?php $email_type = 'app_out'; ?>
            <?php include _PATH . 'instance/front/tpl/email_tpl/email_signature.php'; ?>
        </div>        
    </body>
</html>