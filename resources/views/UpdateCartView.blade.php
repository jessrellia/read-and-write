{{-- Update Shopping Cart (#12)--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='maximum-scale=1.0, initial-scale=1.0, width=device-width' name='viewport'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReadAndWArite</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
        .prod-details{
            background:rgba(255, 255, 255, 0.4);
            margin: auto;
            padding: 20px;
            margin-top: 10.5%;
        }
        .align-self-end{
            margin-bottom: 20px;
        }
        .qty{
            width: 108px;
            padding-bottom: 5px;
            margin-bottom: 2px;
        }
        .btn-primary, .btn-danger, .btn-secondary{
            width: 100px;
            margin: 2px;
        }
        .content{
            margin:auto;
        }
        .form-inline{
            width: 31.8vw;
        }
        .btns{
            margin-right: auto;
            margin-left: auto;
        }
        .errors{
            color: red;
            font-size: small;
        }
        img{
            height: 300px;
            margin: auto;
        }
        @media screen and (max-width: 800px) {
            .btns{
                display: inline;
                margin-top: 10px;
                text-align: center;
            }
            html{
                height: 100%;
                background-position: center;
            }
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

    <div class="container prod-details">
        <div class="row justify-content-md-center">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 justify-content-start content">
            {{-- <img src="{{asset('storage/'.$product_details->image)}}"> --}}
            <?php $url = "https://readandwriteassets.s3.amazonaws.com/".$product_details->image?>
            <img src={{$url}}>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-4 col-xs-8 align-self-center content">
            <span>Stationary Name: {{$product_details->name}}</span>
            <span><br>Stationary Price: {{$product_details->price}}</span>
            <span><br>Quantity: {{$cart_details->quantity}}</span>
            <span><br>Stationary Type: {{$stationary_type->name}}</span>
            <span><br>Description: {{$product_details->description}}</span>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 align-self-end justify-content-end btns">
              @guest
              @else
                @if(\Auth::user()->role_id == 1)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Delete</button>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Delete Product</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              This product will be deleted and this process cannot be undone.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <form action="/delete" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="id" value="{{$product_details->id}}">
                                <input type="submit" class="btn btn-danger" value="Delete"></button>
                              </form>  
                            </div>
                          </div>
                        </div>
                      </div>
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/product-update/{{$product_details->id}}'">Edit</button>
                @elseif(\Auth::user()->role_id == 2)
                    <form action="/update-cart" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name = "id" value="{{$product_details->id}}">
                        <input type="number" class="qty" name="quantity"  value="1" >
                        @if($errors->any())
                            <div class ="errors">stock is not enough</div>
                        @endif
                        <button type="submit" class="btn btn-dark">Update Cart</button>
                    </form>
                @endif
              @endguest
          </div>
        </div>
    </div>
</body>
</html>