<div class="MyPageHeader">
    Call Distribution Settings
    <div class="TopRight" onclick="syncSources()">
        <i class="glyphicon glyphicon-refresh"></i>
        Sync Sources With Pipedrive
    </div>
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <table id="tblAgents" class="table" border='0' style="width:100%;">
                <?php include _PATH . 'instance/front/tpl/call_distribution_data.php'; ?>
            </table>

            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>
             
        </form>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_account_sid: "required"
            },
            messages: {
                txt_account_sid: "Please enter api key"

            }
        });

        $("#btn_cancel").click(function () {
            $("#txt_account_sid").val($("#hid_sid").val());
            $("#txt_auth_token").val($("#hid_token").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>
</div>

<div class="modal fade" id="selectAgentPopup" >
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Agent For <span id="deal_nm"></span></h4>

            </div>
            <div class="modal-body" style="height:350px;overflow: auto;" >
                <div id="user_selection_area" style="width:505px;margin:0px auto;">

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="source_pk_id" id="source_pk_id" value="" />
                <button type="button" class="btn btn-success process_cls_submit" onclick="SubmitAgent()" >Update</button>
                <button type="button" class="btn btn-success submit_wait_process_btn" style="display:none;cursor:none;">Please Wait..</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-header, .modal-footer{
        background-color: #e4f3e5;
    }
    .modal-header{
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
    .modal-footer{
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
    }
    .btn-success{
        background-color: #5cb85c;
    }
    .tooltip-inner{
        color: white !important;
    }
    .TopRight{
        position: absolute; 
        top: 12px; 
        cursor: pointer; 
        padding: 1px 8px; 
        border-radius: 3px; 
        background-color: yellowgreen; 
        right: 10px; 
        color: white; 
        font-weight: bold; 
        font-size: 12px;
    }
</style>