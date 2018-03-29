<?php
if (!isset($_SESSION['user']['tenant_id'])) {
    _R(lr('login'));
}
$tenant_data = qs("select *,id as tenant_id from admin_users where `id` = '{$_SESSION['user']['tenant_id']}'");
$GLOBALS['tenant_id'] = $tenant_data['tenant_id'];
$GLOBALS['unique_code'] = $tenant_data['unique_code'];
?>
<table>
    <tr>
        <th>Event</th>
        <th style='width:500px;'>URL</th>
        <th>Action</th>
    </tr>
    <tr>
        <td>Deal - Added</td>
        <td> 
            <input style="width:100%;" type='text' id='myInput1' value='https://leadpropel.com/admin/captureOnlyLeads?unique_code=<?= $GLOBALS['unique_code'] ?>' />
        </td>
        <td><button onclick="myFunction(1)" onmouseout="outFunc()">                
                Copy Link
            </button>
        </td>
    </tr>
    <tr>
        <td>Deal - Added</td>
        <td> 
            <input style="width:100%;" type='text' id='myInput2' value='https://leadpropel.com/admin/campaignpush?unique_code=<?= $GLOBALS['unique_code'] ?>' />
        </td>
        <td><button onclick="myFunction(2)" onmouseout="outFunc()">                
                Copy Link
            </button>
        </td>
    </tr>
    <tr>
        <td>Deal - Updated</td>
        <td> 
            <input style="width:100%;" type='text' id='myInput3' value='https://leadpropel.com/admin/campaignupdate?unique_code=<?= $GLOBALS['unique_code'] ?>' />
        </td>
        <td><button onclick="myFunction(3)" onmouseout="outFunc()">                
                Copy Link
            </button>
        </td>
    </tr>
</table>

<script>
    function myFunction(id) {
        var copyText = document.getElementById("myInput"+id);
        copyText.select();
        document.execCommand("Copy");

    }

    function outFunc() {
    }
</script>
<?php
die;
