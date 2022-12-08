<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Register Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/tenantregister.css') }}">
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Registration For Tenant</span>

                <form  method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input type="text" placeholder="Enter domain name" name="name" id="tname" value ="" required>
                        {{-- <span>localhost:8000</span> --}}
                    </div>
                    <div class="input-field button">
                        <input type="button" id="register" value="Register">
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
<script>
    $(document).ready(function(){
       $('#register').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
             }
         });
          $.ajax({
             url: "{{ url('tenant/register') }}",
             method: 'post',
             data: {
                name: $('#tname').val(),
             },
               success: function(result) {
                   alert("Successfully Register");
                   window.location.href = "tenant/domain/login";
               },
               error: function(error) {
                   alert("Register is wrong,Please try again!");
               }
           });
       });
       $('#login').click(function(){
                window.location.href = "tenant/domain/login";
            })
   });
</script>
