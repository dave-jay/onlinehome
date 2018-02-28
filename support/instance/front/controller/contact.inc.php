<?php
if (isset($_REQUEST['submit'])) {
    
//    d($_REQUEST);
//    die;
//    $fields = array();
    $fields['name'] = $_REQUEST['name'];
    $fields['email'] = $_REQUEST['email'];
    $fields['question'] = _escape($_REQUEST['question']);
    $fields['comment'] = _escape($_REQUEST['comments']);
    qi("contact_support", $fields);
    
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $question = _escape($_REQUEST['question']);
    $comment = _escape($_REQUEST['comments']);
    $dt = date("m-d-Y h:i A");
    $content = "<html>";
    $content .= "<body>";
    $content .= "<div style = 'font-family:verdana; background-color: #02B3E4; text-align: center ;min-height: 100px;color: white;'><div style='font-size: 36px;line-height: 90px;'>Sprout Lending- Support Doc</div></div>";
    $content .= "<div style = 'font-family:verdana; background-color: white;border: lightskyblue 1px solid;'>";
    $content .= "<p style = 'font-family: verdana; border-bottom: 1px solid #8E9BA5;margin:0px 20px 20px;padding-bottom: 10px;padding-top: 10px;'> <big>Hi Admin</big>,<br/>";
    $content .= "<small>questions asked by customer <b style='text-transform: capitalize'>" . $name . "</b> from " . $email . " at " . $dt . " ,<br/> please answer the question.</small></p>";
    $content .= "<p style = 'font-family: verdana;font-size:20px;margin:0px 20px 20px;padding: 10px; background-color:#e5e5e5'><b>" . $question . "</b>";
    $content .= "<br/><span style='font-size:14px;padding: 0px;'>" . $comment . "</span></p>";
    $content .= "</div>";
//    echo $content;
    $content .= "</body>";
    $content .= "</html>";
    try {
        _mail("testaccts001@gmail.com", "questions asked", $content);
    } catch (Exception $ex) {
        echo "ERROR:" . $ex->getMessage();
//        die;
    }
//    _R('contact');
//    die;
}
$jsInclude="common_search.js.php";
?>