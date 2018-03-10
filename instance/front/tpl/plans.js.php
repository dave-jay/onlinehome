
<script type="text/javascript" >
    $(document).ready(function(){
       var box_height = $(".vertical-align-middle").height(); 
       var win_height = $(window).height(); 
       if(win_height>box_height){
           var remaining = ((win_height-box_height)/2)-100;
           $(".vertical-align-middle").css("margin-top",remaining+"px"); 
       }
    });
    function select_plan(id){
        $(".plan_block").removeClass("selected");
        $(".plan_block .fa-check-square-o").hide();
        $("#plan_block_"+id).addClass("selected");
        $("#plan_block_"+id+" .fa-check-square-o").show();
        if($("#plan_block_"+id).data("amount")=="0"){
            $("#pay_btn").html("CONTINUE")
        }else{
            $("#pay_btn").html("PAY $"+$("#plan_block_"+id).data("amount")+" & CONTINUE")            
        }
    }
</script>
