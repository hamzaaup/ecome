@include('layouts.include.header')
@include('layouts.include.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.include.navbar')
    <!-- End Navbar -->
    @yield('content')
  </main>
@include('layouts.include.script')
    
    
