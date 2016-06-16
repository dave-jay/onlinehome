<?php 
    include _PATH."instance/front/tpl/pipedrive-dashboard-source-outer.php";
?>
<script>
    var last_source = 'ALL';
    function changeGraph(source){
        last_source = source;
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
    function changeDashboard(duration){
        
        $.ajax({
            url: _U + 'pipedrive-dashboard-source',
            async: "false",
            //dataType: "json",
            data: {changeDashboard: 1, duration:duration, source:last_source},
            success: function (r) {     
                $(".div-duration").hide();
                $("#div-duration-"+duration).show();
                $(".duration-btn").attr("class","btn btn-default duration-btn");
                $("#btn-"+duration).attr("class","btn btn-info duration-btn");
                $('#container').html(r);
                changeMatrix();                
            }
        });
    }
    function changeMatrix(){
        
        $.ajax({
            url: _U + 'pipedrive-dashboard-source',
            async: "false",
            //dataType: "json",
            data: {changeMatrix: 1, source:last_source},
            success: function (r) {     
                $("#graphMatrix").html(r);
                
            }
        });
    }
</script>
