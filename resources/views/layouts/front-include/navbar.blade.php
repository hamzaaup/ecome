<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container py-1 px-3">
        <nav aria-label="breadcrumb">
          <h6 class="font-weight-bolder mb-0">E-SHOP</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Search here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center ">
              <a href="{{url('/')}}" class="nav-link text-body font-weight-bold px-0">
                <span class="d-sm-inline ">Home</span>
              </a>
            </li>&nbsp;&nbsp;
            <li class="nav-item d-flex align-items-center ">
              <a href="{{url('/category')}}" class="nav-link text-body font-weight-bold px-0">
                <span class="d-sm-inline ">Category</span>
              </a>
            </li>&nbsp;&nbsp;
            @if (Route::has('login'))
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">
                                    My profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                        <a href="{{ route('login') }}" class="nav-link underline">Log in</a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link underline">Register</a>
                        @endif
                @endauth
              @endif
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->