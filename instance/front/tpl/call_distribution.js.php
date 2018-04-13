<script type="text/javascript">
    $(document).ready(function () {

    });

    function moveAllItems(origin, dest) {
        $(origin).children().appendTo(dest);
    }
    function moveItems(origin, dest) {
        $(origin).find(':selected').appendTo(dest);
    }

    function OpenEditPopup(id) {
        $("#deal_nm").html('');
        $("#source_pk_id").val('');
        $("#source_pk_id").val(id);
        $.ajax({
            url: _U + 'call_distribution',
            async: "false",
            dataType: "json",
            data: {edit_agent: 1, deal_id: id},
            success: function (r) {
                $("#deal_nm").html(r.data.deal_nm);
                $("#user_selection_area").html(r.data.selection_content);
                $("#selectAgentPopup").modal('show');
                $('#left').click(function () {
                    moveItems('#sbTwo', '#sbOne');
                });

                $('#right').on('click', function () {
                    moveItems('#sbOne', '#sbTwo');
                });

                $('#leftall').on('click', function () {
                    moveAllItems('#sbTwo', '#sbOne');
                });

                $('#rightall').on('click', function () {
                    moveAllItems('#sbOne', '#sbTwo');
                });
            }
        });
    }

    function SubmitAgent() {
        var source_pk_id = $("#source_pk_id").val();
        var user_list = new Array();
        $("#sbTwo option").map(function (i, el) {
            user_list.push($(el).val());
        });

        $.ajax({
            url: _U + 'call_distribution',
            async: "false",
            dataType: "json",
            data: {update_call: 1, source_pk_id: source_pk_id, user_list: user_list},
            success: function (r) {
                $("#selectAgentPopup").modal('hide');
                _success("Call Distribution Has Been Updated");
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        });
        return false;
    }
    
    function syncSources(){
        showWait();
        $.ajax({
            url: _U + 'call_distribution',
            data: {syncSources: 1},
            success: function (r) {
                hideWait();
                $("#tblAgents").html(r);
            }
        });
    }
    function AddtoActive(id) {
        showWait();
        $.ajax({
            url: _U + 'call_distribution',
            data: {AddtoActive: 1, source_id: id},
            success: function (r) {
                hideWait();
                $("#tblAgents").html(r);
            }
        });
    }
    function RemoveFromActive(id) {
        showWait();
        $.ajax({
            url: _U + 'call_distribution',
            data: {RemoveFromActive: 1, source_id: id},
            success: function (r) {
                hideWait();
                $("#tblAgents").html(r);
            }
        });
    }

</script>