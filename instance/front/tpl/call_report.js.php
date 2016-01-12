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
</script>