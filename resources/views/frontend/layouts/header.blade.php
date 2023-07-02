<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my_cart') }}">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('my_order') }}">My Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('count_word')}}">Count word</a>
                    </li>

                    <li class="nav-item">

                    </li>
                </ul>
                <div class="d-flex">
                    @if (Auth::check())
                        @php
                            $auth_user = Auth::user();
                            $rewards = $auth_user->reward->where('is_active',1);
                         
                        @endphp
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <h5 class="dropdown-header">Reward Points: {{ $rewards->sum('amount') }}
                                    </h5>
                                </li>
                                <li><a class="dropdown-item" href="#" id="logout">LogOut</a></li>
                                <li>
                                    <h5 class="dropdown-header">Dropdown header 2</h5>
                                </li>
                                <li><a class="dropdown-item" href="#">Another link</a></li>
                            </ul>
                        </div>
                    @else
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModalHeader"><button
                                class="btn btn-primary" type="button">Login</button></a>
                    @endif



                </div>
            </div>
        </div>
    </nav>
    <div class="modal" id="loginModalHeader">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('post_login') }}" method="post">
                        @csrf
                        <div class="container">
                            <label for="uname"><b>email</b></label>
                            <input type="text" class="form-control" placeholder="Enter email" name="email"
                                required>

                            <label for="password"><b>Password</b></label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                required>

                        </div>

                        <div class="container mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Login</button>

                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            {{-- <span class="psw justify-content-end ms-5">Forgot <a class="text-danger text-decoration-none " href="#">password?</a></span> --}}
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#logout').on('click', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '{{ route('logout') }}',
                    success: function(result) {
                        alert(result.message);
                        window.location.replace('{{route("index")}}');
                    }
                });
            })
        })
    </script>
