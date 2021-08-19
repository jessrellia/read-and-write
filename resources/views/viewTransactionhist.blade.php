{{-- Transaction History Page (#10) --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
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
        .pagination{
            margin-top: 10px;
            clear:left;
        }
        nav{
            margin-bottom: 20px;
        }
        .log-reg{
            margin: 5px;
        }
        .log-reg a{
            color: gray;
        }
        .not-found{
           background-image: url('{{asset('others/no-transaction.png')}}');
           background-size: cover;
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           z-index: -1;
        }
        nav .btn-primary{
            width: 100px;
            margin: 2px;
        }
        .btn-primary{
            width:100px
        }
        .btn-danger{
            width:100px
        }
        .btn-lg{
            width:200px
        }
        .form-inline{
            width: 31.8vw;
        }
        table th{
            padding: 5px;
        }
        .tbl-container{
            padding: 10px;
        }
        @media screen and (max-width: 800px) {
            .container{
                background-color: rgba(255, 255, 255, 0.4)
            }
        }

    </style>
</head>
<body>
    {{-- nav class from app.blade.php + search bar--}}
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
                            <button type="button" class="btn btn-primary"onclick="window.location.href='/view-transaction-history'">History</button>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class ="container tbl-container">
        @if (!$gabungan->isEmpty())
        <table class="table table-light table-hover table-striped col-lg-12">
            @foreach ($datetime as $datetime)
            <?php $DateTime = $datetime->date?>
            <?php $totalprice =0 ?>
            
            <?php foreach ($gabungan as $products){
                if ($products->date == $DateTime) {
                    $totalprice = $totalprice + ($products->quantity*$products->price);
                }
            }?>
                <thead>
                    <tr class="transaction-header table-primary">
                        <th>{{$datetime->date}}</th>
                        <th colspan = 3 class="text-right">Total : {{$totalprice}} </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gabungan as $products)
                    <tr>
                        @if($products->date==$DateTime)
                            <td>{{$products->name}}</td>
                            <td>{{$products->price}}</td>
                            <td>Quantity : {{$products->quantity}}</td>
                            <td>Sub Total : {{$products->quantity*$products->price}}</td>
                        @endif
                    </tr>
                </tbody>
                @endforeach
            @endforeach
        </table>
        @else
            <div class="not-found">There is no transaction history!</div>
        @endif 
</div>
</body>
</html>