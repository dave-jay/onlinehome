<?php if ($error || (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '')): ?>
    <?php
    if (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != '') {
        $error = $_SESSION['error_msg'];
        $_SESSION['error_msg'] = '';
        unset($_SESSION['error_msg']);
    }
    ?>
    <div class="bottom-message alert-error" id="error_msg_div">
        <strong>Sorry!</strong> &nbsp;&nbsp;<?php print $error ?>
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
    <div class="bottom-message alert-success" id="success_msg_div">
        <strong>Success!</strong> &nbsp;&nbsp;<?php print $greetings ?>
    </div>
<?php endif; ?>


<div style="display:none;" class="bottom-message alert-error" id="error_msg_jquery">
    <strong>Sorry!</strong> &nbsp;&nbsp;<span id="error_msg_content"></span>
</div>
<div style="display:none;" class="bottom-message alert-success" id="success_msg_jquery">
    <strong>Success!</strong> &nbsp;&nbsp;<span id="success_msg_content"></span>
</div>






<div class="modal fade" id="PleaseWaitModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="process_message" class="please_wait_progress_bar">Please Wait....</div>
                <div id="result_message" style="display:none;">
                    <div class="alert alert-success-rectangle" style="display:none;">
                        <div id="success_res_msg"></div>
                    </div>
                    <div class="alert alert-error-rectangle" style="display:none;">
                        <div id="error_res_msg"></div>
                    </div>
                    </br>
                    <div style="text-align:right;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

