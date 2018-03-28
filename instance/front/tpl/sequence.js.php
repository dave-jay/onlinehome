
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">    
    $(document).ready(function () {
        $(".first_box .my_box_body").animate({height: "toggle"}); 
        $(".first_box .my_box_heading .fade_icon i").toggleClass("fa-minus").toggleClass("fa-plus");
    });
    
    $(".radio_group").change(function (){
        var id=$(this).data("id");
        var type=$(this).data("type");
        if(type=="fixed"){
            $("#"+id+"_sent").show();
            $("#"+id+"_sent_dynamic_time").hide();
        }else{
            $("#"+id+"_sent").hide();
            $("#"+id+"_sent_dynamic_time").show();
        }
    })
    
    $(".my_box_heading").click(function () { 
        $(this).parent().find(".my_box_body").animate({height: "toggle"}); 
        $(this).find(".fade_icon i").toggleClass("fa-minus").toggleClass("fa-plus");
    });
</script>