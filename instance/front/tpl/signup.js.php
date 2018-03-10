
<script type="text/javascript" >
    $(document).ready(function () {
        $("#signupform").validate({
            rules: {
               email: {required: true,email:true},
                password: {required: true},
                cpassword: {required: true,equalTo:'#password'}

            },
            messages: {
               email: {required: '<span style="color:red;font-size:11px;">Please enter email address</span>',email: '<span style="color:red;font-size:11px;">Please enter a valid email address</span>'},
                password: {required: '<span style="color:red;font-size:11px;">Please enter password</span>'},
                cpassword: {required: '<span style="color:red;font-size:11px;">Please enter confirm password</span>',equalTo: '<span style="color:red;font-size:11px;">confirm password doesn\'t match.</span>'}
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

</script>

<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>