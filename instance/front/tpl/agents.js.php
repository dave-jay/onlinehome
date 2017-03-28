<script type="text/javascript">
    $(document).ready(function () {
        $('body').tooltip({
            selector: '.defaultOwner'
        });
    });
    function doSavePhone(value, id) {
        if (value == '') {
            return;
        }
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateAgent: id, value: value},
            success: function (r) {
                hideWait();
                _success("Agent phone updated successfully");

            }
        });
    }
    function doSaveCell(value, id) {
        if (value == '') {
            return;
        }
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateAgentCell: id, value: value},
            success: function (r) {
                hideWait();
                _success("Agent Cell Number updated successfully");

            }
        });
    }
    function syncUser() {
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {syncUser: 1},
            success: function (r) {
                updateUser();
            }
        });
    }
    function updateUser() {
        $.ajax({
            url: _U + 'agents',
            data: {updateUser: 1},
            success: function (r) {
                $("#tblAgents").html(r);
                hideWait();
                _success("Users sync with pipedrive successfully");

            }
        });
    }
    function doOpenEditPopup(id) {
        $("#pd_user_id").val(id);
        $("#txtAgentName").html($("#div_" + id + "_agent_name").html());
        $("#ddlGroup").val($("#div_" + id + "_group").html());
        $("#txtPhone").val($("#td_" + id + "_phone").html() == "-" ? '' : $("#td_" + id + "_phone").html());
        $("#txtCell").val($("#td_" + id + "_cell").html() == "-" ? '' : $("#td_" + id + "_cell").html());
        $("#selectAgentPopup").modal("show");

    }
    function SaveContact() {
        showWait();
        var id = $("#pd_user_id").val();
        var phone = $("#txtPhone").val();
        var cell = $("#txtCell").val();
        var group = $("#ddlGroup").val();
        var linkdin = $("#txtlinkdin").val();
        var role = $("#txtroleno").val();
  
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateContact: id, phone: phone, cell: cell, group: group, linkdin: linkdin, role: role},
            success: function (r) {
                hideWait();
                if (r.toString() == "1") {
                    $("#td_" + id + "_phone").html(phone == '' ? '-' : phone);
                    $("#td_" + id + "_cell").html(cell == '' ? '-' : cell);
                    $("#div_" + id + "_group").html(group);
                    $("#div_" + id + "_group").attr('class', 'group-' + group);
                    $("#selectAgentPopup").modal("hide");
                    _success("Agent Detail updated successfully");
                } else if (r.toString() == "0") {
                    $("#selectAgentPopup").modal("hide");
                    _error("No rows to update");
                } else {
                    $("#selectAgentPopup").modal("hide");
                    _error("Can not Update Agent Detail. Please Try Again.");
                }

            }
        });
    }

    function MarkAsDefault(id) {
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {MarkAsDefault: 1, user_id: id},
            success: function (r) {
                hideWait();
                $("#tblAgents").html(r);
            }
        });
    }
    function RemoceFromDefault(id) {
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {RemoceFromDefault: 1, user_id: id},
            success: function (r) {
                hideWait();
                $("#tblAgents").html(r);
            }
        });
    }


</script>