<style>
    .top_msg{
        padding: 20px; 
        text-align: center; 
        z-index: 1; 
        font-size: 15px;
        position: absolute;
        width: 100%; 
        top:0;
        left:0;
    }
    .top_msg_success{        
        background-color: #B4FFB4; 
        color: green;
        border-bottom: 2px solid green;                    
    }
    .top_msg_error{        
        background-color: #ffcbcb; 
        color: #ff0000;
        border-bottom: 2px solid #ff0000;                    
    }

    .msg_content{
        float:left;
        width:95%;
    }
    .msg_close{
        float:right;
        width:5%;
        font-size: 11px;
        cursor: pointer;
    }
</style>
<?php if ($error || (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '')): ?>
    <?php
    if (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '') {
        $error = $_SESSION['error_msg'];
        $_SESSION['error_msg'] = '';
        unset($_SESSION['error_msg']);
    }
    ?>    
<div class="top_msg_error top_msg"  id="error_msg_div_new" style="z-index: 10000;">
    <div class="msg_content"><i class="fa fa-exclamation-triangle"></i>&nbsp;Sorry!&nbsp;<?php print $error ?></div>
    <div class="msg_close" onclick="closeMessage();"><i class="glyphicon glyphicon-remove"></i></div>
    <div style="clear:both;"></div>
</div>
<?php endif; ?>

<?php if ($greetings || (isset($_SESSION['greetings_msg']) && $_SESSION['greetings_msg'] != '')): ?>
    <?php
    if (isset($_SESSION['greetings_msg']) && $_SESSION['greetings_msg'] != '') {
        $greetings = $_SESSION['greetings_msg'];
        $_SESSION['greetings_msg'] = '';
        unset($_SESSION['greetings_msg']);
    }
    ?>    
    <div class="top_msg_success top_msg"  id="success_msg_div_new" style="z-index: 10000;">
        <div class="msg_content"><i class="fa fa-check-square-o"></i>&nbsp;Success!&nbsp;<?php print $greetings; ?></div>
        <div class="msg_close" onclick="closeMessage();"><i class="glyphicon glyphicon-remove"></i></div>
        <div style="clear:both;"></div>
    </div>
<?php endif; ?>



<div class="top_msg_success top_msg"  id="success_msg_jquery" style="display: none;z-index: 10000;">
    <div class="msg_content"><i class="fa fa-check-square-o"></i>&nbsp;Success!&nbsp;<span id="success_msg_content"></span></div>
    <div class="msg_close" onclick="closeMessage();"><i class="glyphicon glyphicon-remove"></i></div>
    <div style="clear:both;"></div>
</div>
<div class="top_msg_error top_msg"  id="error_msg_jquery" style="display: none;z-index: 10000;">
    <div class="msg_content"><i class="fa fa-exclamation-triangle"></i>&nbsp;Sorry!&nbsp;<span id="error_msg_content">There is error!</span></div>
    <div class="msg_close" onclick="closeMessage();"><i class="glyphicon glyphicon-remove"></i></div>
    <div style="clear:both;"></div>
</div>
<script>
    function closeMessage() {
        $(".top_msg").slideUp();
    }
</script>