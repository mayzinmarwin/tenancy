<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Register Form</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/tenantregister.css') }}"> --}}

</head>
<body>
    <div class="container">
            <h2 class="user-title">Registration Tenant  Form <span class="title">{{tenant('id')}}</span></h2>
            <div class="register-form">
            <form method="post" enctype="multipart/form-data" id="register">
                {{ csrf_field() }}
                <div class="input-box">
                    <label for="name">User Name</label>
                    <input type="text" name="name" id="uname" placeholder="NAME" required>
                </div>
                <div class="input-box">
                    <label for="email"> Email</label>
                    <input type="email" name="email" id="uemail" placeholder="EMAIL" required>
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="upassword" placeholder="PASSWORD" required>
                </div>
                <div class="input-submit-btn">
                    <input type="submit" id="register-btn" value="Register">
                </div>
            </form>
        </div>
            <div class="login-signup">
                <span class="text">Already a tanant member?
                    <input type="button" class="text login-link" id="login" value="Login">
                </span>
            </div>
    </div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#register').on('submit',function(e){
          e.preventDefault();
          $('#register-btn').val('Please Wait...')
          $.ajaxSetup({
             headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
             }
         });
         $.ajax({
             url: "{{ url('tenant/user/register') }}",
             method: 'post',
             data:$('#register').serialize(),
               success: function(result) {
                   alert("Successfully User Register");
                   window.location.href = "/login";
               },
               error: function(error) {
                   alert("User Register is wrong,Please try again!");
               }
           });
       });
       $('#login').click(function(){
                window.location.href = "/login";
        });
   });
</script>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family:sans-serif;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: rgb(156,186,172);
        background: linear-gradient(76deg, rgba(156,186,172,1) 0%, rgba(170,199,186,1) 47%, rgba(60,85,73,1) 100%);
    }
    .container{
        width:100%;
        max-width: 500px;
        background: #ffffff;
        padding:30px;
        border-top-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    .user-title{
        text-align: center;
        color: #3c5549;
        padding-bottom: 10px;

    }
    .title{
        color: #9cbaac;
    }
    .register-form{
        padding:20px 0;
    }
    .input-box{
        display: flex;
        flex-direction: column;
        padding-bottom: 20px;

    }
    .input-box label{
        color: #ffff;
        margin:5px 0;

    }
    .input-box input{
        height: 40px;
        width: 100%;
        border-radius: 5px;
        border:1px solid gray;
        outline: none;
        padding: 0 20px;
    }
    .input-submit-btn{
        display: flex;
        justify-content: center;


    }

    .input-submit-btn input{
        width: 50%;
        margin-top:10px;
        font-size: 20px;
        padding:10px;
        border: none;
        letter-spacing: 1px;
        border-radius: 5px;
        background-color:#3c5549;
        color:#ffff;
        cursor: pointer;

    }
    .login-signup{
        margin-top: 10px;
        text-align: center;
    }
    .login-signup span{
        color: #333;
        font-size: 14px;
        border: none;
    }
    .login-signup input{
        width: 20%;
        padding:10px;
        /* border: none;
        border-radius: 5px;
        background-color:#3c5549; */
        cursor: pointer;
        border: 0;
    }
</style>
