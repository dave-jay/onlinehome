<script type="text/javascript">
    $(document).ready(function () {

    });

    function change_phone_number(user, id, phone_no) {
        if (user == 'agent') {

        } else {
            $("#hidCustPhone").val(phone_no);
            $(".cust_phone").attr("class", "cust_phone click_to_call_phone_extra");
            $("#" + id).attr("class", "cust_phone click_to_call_phone fa fa-phone");
        }
    }
    $("#call_btn_enabled").click(function () {
        click_to_call();
    });

    function click_to_call() {
        if ($("#hidAgentPhone").val() == '' || $("#hidCustPhone").val() == '' || $("#hidDealId").val() == '') {
            if ($("#hidAgentPhone").val() == '') {
                alert("Sorry, We have not your phone number.");
            } else if ($("#hidCustPhone").val() == '') {
                alert("Sorry, We have not customer number.");
            } else {
                alert("Sorry, something being wrong. Please try again.");
            }
        } else {
            $("#call_btn_enabled").hide();
            $("#connecting_icon").show();
            $.ajax({
                url: _U + 'click_to_call',
                dataType: "json",
                data: {click_to_call: 1, agent_name: $("#hidAgentName").val(), agent_phone: $("#hidAgentPhone").val(), customer_phone: $("#hidCustPhone").val(), dealId: $("#hidDealId").val()},
                success: function (r) {
                    setTimeout(function () {
                        $("#connecting_icon").hide();
                        $("#connected_icon").show();
                    }, 2000);

                }
            });
        }
    }

    function ManualAgentNo() {
        $("#divManualAgent").toggle();
    }
</script>