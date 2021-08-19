{{-- Page to notify users that they either must login or have the role of an admin --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReadAndWArite</title>
    <script>
        setTimeout(function(){
           window.location.href = '/';
        }, 3000);
    </script>
    <style>
        .must-login{
           background-image: url('{{asset('others/redirect.png')}}');
           background-size: cover;
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           z-index: -1;
        }
    </style>
</head>
<body>
    <div class="must-login"></div>
</body>
</html>