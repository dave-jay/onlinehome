
<script type="text/javascript" >
    $(document).ready(function () {
        $("#loginform").validate({
            rules: {
               username: {required: true},
                password: {required: true}

            },
            messages: {
               username: {required: '<span style="color:red;font-size:11px;">Please input username</span>'},
                password: {required: '<span style="color:red;font-size:11px;">Please input password</span>'}
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

</script>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>