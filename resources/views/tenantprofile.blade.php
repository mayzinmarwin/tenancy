<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile </title>
</head>
<body>
    <div class="container">
        <div class="profile-title">
            <h2 class="user-title">User Profile {{$userInfo->name }} <span class="title">  {{tenant('id')}}</span> Tenant</h2>
        </div>
        <div class="upload">
            @if($userInfo->photo)
            <img src="{{ $userInfo->photo }}" alt="" id="image-preview">
            @else
            <img src="/images/user1.png" alt="" id="image-preview">
            @endif
            {{-- <input type="file" name="photo" id="photo"> --}}
            <label class="file">
                <input type="file" name="photo" id="photo" aria-label="File browser example">
                <span class="file-custom"></span>
            </label>
  
  
       </div>
         <input type="hidden" name="user_id" id ="user_id" value="{{ $userInfo->id }}">

        <form method="post" enctype="multipart/form-data" id="profile">
            @csrf
            <div class="input-box">
               <input type="text" name="name" id="uname" value=" {{$userInfo->name }}"  required>
           </div>
           <div class="input-box">
               <input type="email" name="email" id="uemail" value=" {{$userInfo->email }}" required>
           </div>
           <div class="input-submit-btn">
               <input type="submit" id="login-btn" value="Upload Image">
           </div>
        </form>
    </div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(function(){
        $("#photo").change(function(e){
            const file = e.target.files[0];
            let url =window.URL.createObjectURL(file);
            $("#image-preview").attr('src',url);
            let fd = new FormData();
            fd.append('photo',file);
            fd.append('user_id',$("#user_id").val());
            fd.append('_token','{{ csrf_token() }}');
            $.ajax({
                url: "{{ url('tenant/user/profile') }}",
                method: 'post',
                data: fd,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    // console.log(result);
                    alert("upload image success")
                }
            });
        });
        $('#profile').submit(function(e){
            e.preventDefault();
            let id = $('#user_id').val();
            // $('#login-btn').val('Updating...');
            $.ajaxSetup({
             headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
            url: "{{ url('tenant/user/update') }}",
             method: 'post',
             data:$('#profile').serialize()+ `&id=${id}`,
             success: function(result) {
                // $('#login-btn').val('Update');
                alert("success updated ")
                //    window.location.href = "/profile";
               },
               error: function(error) {
                   alert("User is wrong,Please try again!");
               }
            });
        });
    })


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
        max-width: 400px;
        background: #ffffff;
        padding:30px;
        text-align: center;
        border-top-left-radius: 30px;
        border-bottom-right-radius: 30px;
    }
    .profile-title{
        display: flex;
        flex-direction: column;
    }
    .user-title{
        text-align: center;
        color: #3c5549;
        padding-bottom: 10px;
    }
    .title{
        color:darkcyan;
    }
    .container .upload{
        width: 100% !important;
    }
    .upload img{
        /* width:100px; */
        height: 100px;
        border-radius: 50%;
    }
    .input-box{
        height: 50px;
        width: 100%;
        margin-top: 30px;
    }
    .input-box input{
        height: 40px;
        width: 100%;
        border-radius: 5px;
        border:1px solid gray;
        outline: none;
        padding: 0 20px;
    }
    .input-submit-btn input{
        width: 50%;
        margin-top:10px;
        font-size: 20px;
        padding:10px;
        border: none;
        letter-spacing: 1px;
        border-radius: 5px;
        background-color:darkcyan;
        color:#fff;
        cursor: pointer;

    }
    .file {
        position: relative;
        display: inline-block;
        cursor: pointer;
        width:100%;
        height: 2.5rem;
        }
        .file input {
        min-width: 14rem;
        margin: 0;
        filter: alpha(opacity=0);
        opacity: 0;
        }
        .file-custom {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 5;
        height: 2.5rem;
        padding: .5rem 1rem;
        line-height: 1.5;
        color: #555;
        background-color: #fff;
        border: .075rem solid #ddd;
        border-radius: .25rem;
        box-shadow: inset 0 .2rem .4rem rgba(0,0,0,.05);
        -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
        }
        .file-custom:after {
        content: "Choose file...";
        }
        .file-custom:before {
        position: absolute;
        top: -.075rem;
        right: -.075rem;
        bottom: -.075rem;
        z-index: 6;
        display: block;
        content: "Browse";
        height: 1.3rem;
        padding: .5rem 1rem;
        line-height: 1.5;
        color: #555;
        background-color: #eee;
        border: .075rem solid #ddd;
        border-radius: 0 .25rem .25rem 0;
        }
</style>
