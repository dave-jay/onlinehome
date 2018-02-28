<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
   
    $("#autocomplete").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?php echo _U ?>common_search",
                dataType: "json",
                data: {
                    search: 1,
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.label,
                            value: item.label,
                            dataURL: item.url
                        }
                    }));
                }
            })
        },
        select: function(a, b) {
            var PageURL = b.item.dataURL;
            window.open('<?php echo _U ?>' + PageURL,'_blank');
        }
    });
</script>