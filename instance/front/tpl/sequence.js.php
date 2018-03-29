
<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?= _MEDIA_URL."ckeditor2/ckeditor.js" ?>"></script>
<script type="text/javascript">    
    $(document).ready(function () {
        $(".first_box .my_box_body").animate({height: "toggle"}); 
        $(".first_box .my_box_heading .fade_icon i").toggleClass("fa-minus").toggleClass("fa-plus");
        
        CKEDITOR.replace( 'day1_1_sent_email' );
        CKEDITOR.replace( 'day2_1_sent_email' );
        CKEDITOR.replace( 'day3_1_sent_email' );
        CKEDITOR.replace( 'day4_1_sent_email' );
        CKEDITOR.replace( 'day5_1_sent_email' );

    });
    
    function addDefaultText(id,text) {
        var text_area = jQuery("#"+id);
        var caretPos = text_area[0].selectionStart;
        var textAreaTxt = text_area.val();
        var txtToAdd = text;
        text_area.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    }
    
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