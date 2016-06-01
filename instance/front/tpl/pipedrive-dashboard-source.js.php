<?php 
    include _PATH."instance/front/tpl/pipedrive-dashboard-source-outer.php";
?>
<script>
    function changeGraph(source){
    $.ajax({
            url: _U + 'pipedrive-dashboard-source',
            async: "false",
            //dataType: "json",
            data: {changeGraph: 1,source:source},
            success: function (r) {     
                $('#container').html(r);
            }
        });
    }
</script>
