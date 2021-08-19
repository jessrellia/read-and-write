{{-- Add Product (#7) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
        input{
            margin-bottom: 10px;
        }
        .browse-label{
            margin-left: 18px;
            margin-right: 18px;
        }
        #image_show[src=""] {
            display: none;
        }
        #image_show{
            margin-bottom: 20px;
        }
        .errors{
            color: red;
            font-size: small;
            margin-bottom: 10px;
        }
        .form-container{
            margin: auto;
            width: 80%;
            background:rgba(255, 255, 255, 0.4);
            padding: 20px;
        }
        .form-inline{
            width: 31.8vw;
        }
        nav .btn-primary{
            width: 100px;
            margin: 2px;
        }
        @media screen and (max-width: 800px) {
            html{
                height: 100%;
                background-position: center;
            }
        }
    </style>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_show')
                        .attr('src', e.target.result)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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
    <div class="container">
        <div class="form-container">
            <form action="/add-product" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                {{-- Upload image --}}
                <div class="form-group">
                    <br><img id="image_show" src="">
                    <div class="form-group row">
                        <label for="upload-file" class="browse-label">Browse photos</label>
                        <div class="">
                            <input type="file" class="form-control-file x" id="upload-file" name="image" onchange="readURL(this)">
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('image'))}}</div>
                    @endif

                    {{-- Stationary Name --}}
                    <input type="text" class="form-control" id="stat_name" name="name" placeholder="Stationary Name">
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('name'))}}</div>
                    @endif

                    {{-- Stationary description --}}
                    <input type="text" class="form-control" id="stat_desc" name="description" placeholder="Stationary Description">
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('description'))}}</div>
                    @endif

                    {{-- Stationary type --}}
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Types</div>
                        </div>
                        <select class="custom-select" name="stationary_type_id">
                            <option selected value=0>Stationary Type</option>
                            @foreach ($stationary_types as $type)
                                <option value={{$type->id}}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('stationary_type_id'))}}</div>
                    @endif
                    
                    {{-- Stationary stock --}}
                    <input type="number" class="form-control" id="stat_stock" name="stock" placeholder="Stationary Stock">
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('stock'))}}</div>
                    @endif

                    {{-- Stationary price --}}
                    <input type="number" class="form-control price" id="stat_price" name="price" placeholder="Stationary Price">
                    @if($errors->any())
                        <div class="errors">{{ implode('', $errors->get('price'))}}</div>
                    @endif
                    
                    <button type="submit" class="btn btn-primary">Add New Stationary</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>