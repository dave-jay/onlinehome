<link href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#start_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});
        $("#end_date").datepicker({changeYear: true, changeMonth: true, dateFormat: 'yy-mm-dd'});

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
</script>