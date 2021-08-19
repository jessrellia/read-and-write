{{-- Update Product (#6) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReadAndWArite</title>
    <style>
        body{
            background-image: url('{{asset('others/bg.png')}}');
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        nav{
            position: absolute;
            z-index: 2;
            margin-bottom: 20px;
        }
        .form-container{
            margin: auto;
            width: 80%;
            background:rgba(255, 255, 255, 0.4);
            padding: 20px;
        }
        button{
            margin-top: 10px;
        }
        .errors{
            color: red;
            font-size: small;
        }
        label{
            font-weight: bold;
            margin-top: 10px;
        }
        .price{
            margin-bottom: 10px;
        }
        .form-inline{
            width: 31.8vw;
        }
        nav .btn-primary{
            width: 100px;
            margin: 2px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                ReadAndWArite
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <form class="form-inline col-lg-12" action="/product/search" method="GET">
                        <input class="form-control mr-sm-2 col-lg-8" type="text" placeholder="Search" id="search" name="search" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        {{-- show extra buttons if the user is a member --}}
                        @if(\Auth::user()->role_id == 2)
                            <button type="button" class="btn btn-primary mr-sm-2" onclick="window.location.href='/view-cart'">Cart</button>
                            <button type="button" class="btn btn-primary" onclick="window.location.href='/view-transaction-history'">History</button>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="form-container align-middle">
        <form action="/product-update/{{$stationary->id}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input type="hidden" name="id" value="{{$stationary->id}}">
                <label for="stat_name">Stationary Name</label>
                <input type="text" class="form-control" id="stat_name" name="name" placeholder="{{$stationary->name}}">
                @if($errors->any())
                    <div class="errors">{{ implode('', $errors->get('name'))}}</div>
                @endif

                <label for="stat_desc">Stationary Description</label>
                <input type="text" class="form-control" id="stat_desc" name="description" placeholder="{{$stationary->description}}">
                @if($errors->any())
                    <div class="errors">{{ implode('', $errors->get('description'))}}</div>
                @endif

                <label for="stat_desc">Stationary Stock</label>
                <input type="number" class="form-control" id="stat_stock" name="stock" placeholder="{{$stationary->stock}}">
                @if($errors->any())
                    <div class="errors">{{ implode('', $errors->get('stock'))}}</div>
                @endif

                <label for="stat_desc">Stationary Price</label>
                <input type="number" class="form-control price" id="stat_price" name="price" placeholder="{{$stationary->price}}">
                @if($errors->any())
                    <div class="errors">{{ implode('', $errors->get('price'))}}</div>
                @endif
                
                <button type="submit" class="btn btn-primary">Update Stationary Data</button>
            </div>
        </form>
    </div>
</body>
</html>