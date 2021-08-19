{{-- Welcome Page (#1) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ReadAndWArite</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                z-index: 2;
                position: relative;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .images{
            width: 50%;
            align-content: center;
            }

            .search-form{
                width: 70%;
                align-content: center;
                text-align: center;
            }

            .types{
                margin-top: 5vw;
            }

            .container{
                margin: auto;
                position:absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }

            .form-control{
                padding: 20px;
            }

            .text-right{
                margin: 10px;
            }
            
            h1{
                color: gray;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class='container h-100 d-flex justify-content-center align-items-center'>
                <div class='row justify-content-center align-items-center'>
                    <h3 class='display-4'>ReadAndWArite</h3>
                    <form class='search-form col-12' action="/product/search" method="GET">
                    <!-- Search form -->
                    <input class="form-control" type="text" name="search" id="search" placeholder="Search for stationary" aria-label="Search">
                        <br><button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="types row justify-content-md-center">
                        @foreach($types as $type)
                            <div class="col-sm text-center">
                                <a href="/products/{{$type->name}}"><img class="images" src="{{asset('storage/'.$type->image)}}"></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
