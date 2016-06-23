<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    var last_fil_source;
    var last_fil_agent;
    var last_fil_daterange;
    var last_fil_startdate;
    var last_fil_enddate;
    var is_loading = '0';
    var has_more_records = '1';
    $(document).ready(function () {
        $("#start_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
        $("#end_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
        loadCounterDetail();
    });
    
    $(window).scroll(function () {
            if (($(window).height() + $(document).scrollTop()) >= ($(document).height()-20) && has_more_records=='1' && is_loading=='0') {                
                is_loading = '1';
                $("#divDataLoading").show();
                LoadDetail();
            }
        }); 
    
    function LoadDetail(){
        $.ajax({
            url: _U + 'call_report',
            data: {load_detail: 1,ddlSource:last_fil_source,txtAgent:last_fil_agent,ddlDateRange: last_fil_daterange, start_date: last_fil_startdate, end_date: last_fil_enddate,hidLastRecord:$("#hidLastRecord").val()},
            success: function (r) {
                is_loading = '0';
                var lastrec = parseInt($("#hidLastRecord").val());
                var totalrec = parseInt($("#hidTotalRecord").val());
                lastrec = lastrec + parseInt($("#hidPageSize").val());
                if(totalrec<=lastrec){
                    has_more_records = '0';
                }
                $("#hidLastRecord").val(lastrec.toString());
                $("#body_detail").append(r);
                $("#divDataLoading").hide();
            }
        });
    }
    function loadCounterDetail(){
        last_fil_source = $("#ddlSource").val();
        last_fil_agent = $("#txtAgent").val();
        last_fil_daterange = $("#ddlDateRange").val();
        last_fil_startdate = $("#start_date").val();
        last_fil_enddate = $("#end_date").val();
        $.ajax({
            url: _U + 'call_report',
            dataType: "json",
            data: {count_detail: 1, ddlSource: last_fil_source, txtAgent: last_fil_agent, ddlDateRange: last_fil_daterange, start_date: last_fil_startdate, end_date: last_fil_enddate},
            success: function (r) {
                if(parseInt(r.data.total_calls)<=parseInt($("#hidPageSize").val())){
                    has_more_records = '0';
                }
                $("#circle_no_call").html(r.data.total_calls);
                $("#circle_no_day").html(r.data.days);
                $("#circle_call_duration").html(r.data.call_duration);
                $("#hidTotalRecord").val(r.data.total_calls);
            }
        });
    }
    
    $("#ddlDateRange").change(function (e) {
        if ($("#ddlDateRange").val() == "CUSTOM") {
            $("#start_date").val('');
            $("#end_date").val('');
            $("#CustomDateBlock").slideDown();
        } else {
            $("#CustomDateBlock").slideUp();
        }
    });
    
    function ResetPage() {
        window.location.href = _U + "call_report";
    }
    
    function openAudioFile(id){
    //var path = "https://api.twilio.com/2010-04-01/Accounts/ACaa30ea6de17c65f4407de5a34cbe1efa/Recordings/RE338a2c7e3153c26600a45d42c6c4b358";
    var path = $("#hid_rec_" + id).val();

		$("#soundSrc").attr("src", path);
		$("#soundAudio").load();
                    $( "#soundDialog" ).dialog({
			resizable: false,
			height:220,
			width: 360,
			modal: true,
			buttons: {
				Close: function() {
					$(this).dialog("close");
				}
			},
			close: function(event, ui) {
				console.log("close..");
				$("#soundAudio")[0].pause();
				$("#soundAudio")[0].currentTime = 0;
			}
		});
}

function restart(){
    var oAudio = document.getElementById('soundAudio');    
    oAudio.currentTime = 0; 
    oAudio.play();
}
function fastbackward(){
    var oAudio = document.getElementById('soundAudio');
    oAudio.currentTime -= 10.0;
}

function backward(){
    var oAudio = document.getElementById('soundAudio');
    oAudio.currentTime -= 5.0;
}

function forward(){
    var oAudio = document.getElementById('soundAudio');
    oAudio.currentTime += 5.0;
}

function fastforward(){
    var oAudio = document.getElementById('soundAudio');
    oAudio.currentTime += 10.0;
}
function download_all(id){
    window.location = $("#hid_rec_" + id).val();
}
function download(){
    window.location = $("#soundSrc").attr("src");
}

$("#btnSearch").click(function (e) {
    var startDate = '';
    var endDate = '';
    if ($("#ddlDateRange").val() == "CUSTOM") {
        if ($("#start_date").val() == '' && $("#end_date").val().trim() == '') {
            alert('Please enter Start Date and End Date');
            return false;
        }
        else if ($("#start_date").val().trim() == '')
        {
            alert('Pleae enter start date');
            return false;
        }
        else if ($("#end_date").val().trim() == '') {
            alert('Please enter end date');
            return false;
        }
        startDate = $("#start_date").val();
        endDate = $("#end_date").val();
    }
    return true;
});

function openDetailLogPopup(Id){
    var dealId = $("#hid_deal_"+Id).val();
    $("#deal_nm").html($("#deal_name_"+Id).html());
    $("#TimelinePopup").modal("show");
    loadTimeLine(dealId);
}

function loadTimeLine(dealId){
    $.ajax({
            url: _U + 'call_report',
            dataType: "json",
            data: {loadTimeLine: 1, dealId: dealId},
            success: function (r) {
                
            }
        });
    }
</script>