<script type="text/javascript">
    $(document).ready(function () {

    });
    function openBlock(id) {
        $("#" + id + "_block").slideDown("fast");
        $("#" + id + "_header").attr("onclick", "javascript:closeBlock('" + id + "')");
        $("#" + id + "_icon").attr("class", "fa fa-minus");
        $("#" + id + "_header").css("border-radius", "5px 5px 0 0");
    }
    function closeBlock(id) {
        $("#" + id + "_block").slideUp("fast");
        $("#" + id + "_header").attr("onclick", "javascript:openBlock('" + id + "')");
        $("#" + id + "_header").css("border-radius", "5px");
        $("#" + id + "_icon").attr("class", "fa fa-plus");
    }

    $("#btnSend").click(function e() {
        if ($("#ddlPhone").val() == "0") {
            alert("Please select phone number!");
        } else if ($("#txtMessage").val().trim() == "") {
            alert("Please enter text message!");
        } else {
            $.ajax({
                url: _U + 'conversation_list',
                async: "false",
                data: {sendMessage: 1, ddlPhone: $("#ddlPhone").val(), txtMessage: $("#txtMessage").val(), hidDealId: $("#hidDealId").val()},
                success: function (r) {
                    if (r == "success") {
                        getConvList();
                        alert("Great! Message has been send successfully!");
                    }
                    console.log(r);
                }
            });
        }
    });
    
    function getConvList(){
        $.ajax({
                url: _U + 'conversation_list',
                async: "false",
                data: {conv_list: 1,dealId: $("#hidDealId").val()},
                success: function (r) {
                    $("#second_block").html(r);
                }
            });
    }
</script>