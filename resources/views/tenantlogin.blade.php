<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tenant Login Form</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tenantregister.css') }}">
</head>
<body>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login For Tenant</span>

                <form  method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input type="text" placeholder="Enter domain name" name="name" id="tname" value ="" required>
                        {{-- <span>localhost:8000</span> --}}
                    </div>
                    <div class="input-field button">
                        <input type="button" id="login" value="Login">
                    </div>
                </form>
                {{-- <div class="login-signup">
                    <span class="text">Already a tanant member?
                        <a href="{{ url('tenant/login') }}" class="text login-link" id="login">Login Now</a>
                    </span>
                </div> --}}
            </div>

        </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       $('#login').click(function(e){
          e.preventDefault();
          $.ajaxSetup({
             headers: {
               'X-CSRF-TOKEN': "{{ csrf_token() }}"
             }
         });
          $.ajax({
             url: "{{ url('tenant/login') }}",
             method: 'post',
             data: {
                name: $('#tname').val(),
             },
               success: function(result) {
                let url = 'http://localhost:8000/tenant/';
                   var subdomain =$('#tname').val()+'.' + 'localhost:8000/register';
                   window.location.href = replaceSubdomain(url,subdomain)
               },
            //    error: function(error) {
            //        alert("Register is wrong,Please try again!");
            //    }
           });
       });
   });
   function replaceSubdomain(url, sub_domain){
            return url.replace(/^(https?:\/\/)(www\.)?([^.])*/, `$1$2${sub_domain}`);
        }
</script>
