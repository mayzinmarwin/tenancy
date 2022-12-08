<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Register Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tenantregister.css') }}">

</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registration User  For Tenant {{tenant('id')}}</span>
                <form  method="post" enctype="multipart/form-data"  id="register">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input type="text" placeholder="Enter user name" name="name" id="uname"  required>
                    </div>
                    <div class="input-field">
                        <input type="email" placeholder="Enter email" name="email" id="uemail"  required>
                    </div>
                    <div class="input-field">
                        <input type="password" placeholder="Enter password" name="password" id="upassword"  required>
                    </div>
                    <div class="input-field button">
                        <input type="submit"   value="Register">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text">Already a tanant member?
                        <input type="button" class="text login-link" id="login" value="Login">
                    </span>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
{{-- <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous"></script> --}}
<script>
    $(document).ready(function(){
        $('#register').on('submit',function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
             }
         });
         $.ajax({
             url: "{{ url('tenant/user/register') }}",
             method: 'post',
             data:$('#register').serialize(),
            //  $('#register').serialize(),
            //  data: {
            //     name: $('#uname').val(),
            //     email: $('#uemail').val(),
            //     password: $('#upassword').val(),
            //  },


               success: function(result) {
                   alert("Successfully User Register");
                //    window.location.href = "tenant/domain/login";
               },
               error: function(error) {
                   alert("User Register is wrong,Please try again!");
               }
           });
       });
   });
</script>
